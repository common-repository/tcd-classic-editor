<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'TCDCE_Support' ) ) {

	class TCDCE_Support {

	private static $settings;

	private static $supported_post_types = array();

	private function __construct() {}

	// プラグイン読み込み直後に実行
	public static function init_actions() {

		// Also used in Gutenberg.
		add_filter( 'use_block_editor_for_post', array( __CLASS__, 'choose_editor' ), 100, 2 );

		// 投稿編集画面のURLを書き換え
		add_filter( 'get_edit_post_link', array( __CLASS__, 'get_edit_post_link' ) );

		// 投稿保存後にクラシックエディターを保持する
		add_filter( 'redirect_post_location', array( __CLASS__, 'redirect_location' ) );

		// 投稿保存後にクラシックエディターを保持するためのinput
		add_action( 'edit_form_top', array( __CLASS__, 'add_redirect_helper' ) );

		// クラシックエディターの利用状況を保持する
		add_action( 'edit_form_top', array( __CLASS__, 'remember_classic_editor' ) );

		// ver5.8以降
		add_filter( 'block_editor_settings_all', array( __CLASS__, 'remember_block_editor' ), 10, 2 );

		// edit.phpに表示するエディターの使用状況
		add_filter( 'display_post_states', array( __CLASS__, 'add_post_state' ), 10, 2 );

		// edit.phpに各エディターのリンクを追加
		add_filter( 'page_row_actions', array( __CLASS__, 'add_edit_links' ), 15, 2 );
		add_filter( 'post_row_actions', array( __CLASS__, 'add_edit_links' ), 15, 2 );

		// クラシックエディター用（エディタ切り替え）
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_box' ), 10, 2 );

		// ブロックエディター用（エディタ切り替え）
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_block_editor_scripts' ) );

	}

	private static function get_settings() {
		/**
		 * Can be used to override the plugin's settings. Always hides the settings UI when used (as users cannot change the settings).
		 *
		 * Has to return an associative array with two keys.
		 * The defaults are:
		 *   'editor' => 'classic', // Accepted values: 'classic', 'block'.
		 *
		 * @param boolean To override the settings return an array with the above keys.
		 */
		$settings = apply_filters( 'tcdce_classic_editor_plugin_settings', false );

		if ( is_array( $settings ) ) {
			return array(
				// block or classic
				'editor' => ( isset( $settings['editor'] ) && $settings['editor'] === 'block' ) ? 'block' : 'classic'
			);
		}

		if ( ! empty( self::$settings ) ) {
			return self::$settings;
		}

		self::$settings = array(
			'editor' => 'classic',
		);

		return self::$settings;

	}

	private static function is_classic( $post_id = 0 ) {

		if ( ! $post_id ) {
			$post_id = self::get_edited_post_id();
		}

		if ( $post_id ) {
			$settings = self::get_settings();

			if ( ! isset( $_GET['classic-editor__forget'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$which = get_post_meta( $post_id, 'classic-editor-remember', true );

				if ( $which ) {
					if ( 'classic-editor' === $which ) {
						return true;
					} elseif ( 'block-editor' === $which ) {
						return false;
					}
				}

			}
		}

		if ( isset( $_GET['classic-editor'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return true;
		}

		return false;
	}

	/**
	 * Get the edited post ID (early) when loading the Edit Post screen.
	 */
	private static function get_edited_post_id() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if (
			! empty( $_GET['post'] ) &&
			! empty( $_GET['action'] ) &&
			$_GET['action'] === 'edit' &&
			! empty( $GLOBALS['pagenow'] ) &&
			$GLOBALS['pagenow'] === 'post.php'
		) {
			return (int) $_GET['post']; // post_ID
		}
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		return 0;
	}

	/**
	 * Add a hidden field in edit-form-advanced.php
	 * to help redirect back to the classic editor on saving.
	 */
	public static function add_redirect_helper() {
		echo '<input type="hidden" name="classic-editor" value="" />';
	}

	/**
	 * Remember when the classic editor was used to edit a post.
	 */
	public static function remember_classic_editor( $post ) {
		$post_type = get_post_type( $post );
		if ( $post_type && post_type_supports( $post_type, 'editor' ) ) {
			self::remember( $post->ID, 'classic-editor' );
		}
	}

	/**
	 * Remember when the block editor was used to edit a post.
	 */
	public static function remember_block_editor( $editor_settings, $context ) {
		if ( is_a( $context, 'WP_Post' ) ) {
			$post = $context;
		} elseif ( ! empty( $context->post ) ) {
			$post = $context->post;
		} else {
			return $editor_settings;
		}

		$post_type = get_post_type( $post );

		if ( $post_type && use_block_editor_for_post_type( $post_type ) ) {
			self::remember( $post->ID, 'block-editor' );
		}

		return $editor_settings;
	}

	private static function remember( $post_id, $editor ) {
		if ( get_post_meta( $post_id, 'classic-editor-remember', true ) !== $editor ) {
			update_post_meta( $post_id, 'classic-editor-remember', $editor );
		}
	}

	/**
	 * Choose which editor to use for a post.
	 *
	 * Passes through `$which_editor` for block editor (it's sets to `true` but may be changed by another plugin).
	 *
	 * @uses `use_block_editor_for_post` filter.
	 *
	 * @param boolean $use_block_editor True for block editor, false for classic editor.
	 * @param WP_Post $post             The post being edited.
	 * @return boolean True for block editor, false for classic editor.
	 */
	public static function choose_editor( $use_block_editor, $post ) {

		$settings = self::get_settings();
		$editors = self::get_enabled_editors_for_post( $post );

		// If no editor is supported, pass through `$use_block_editor`.
		if ( ! $editors['block_editor'] && ! $editors['classic_editor'] ) {
			return $use_block_editor;
		}

		// Open the default editor when no $post and for "Add New" links,
		// or the alternate editor when the user is switching editors.
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( empty( $post->ID ) || $post->post_status === 'auto-draft' ) {
			if (
				( $settings['editor'] === 'classic' && ! isset( $_GET['classic-editor__forget'] ) ) ||  // Add New
				( isset( $_GET['classic-editor'] ) && isset( $_GET['classic-editor__forget'] ) ) // Switch to classic editor when no draft post.
			) {
				$use_block_editor = false;
			}
		} elseif ( self::is_classic( $post->ID ) ) {
			$use_block_editor = false;
		}
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		// Enforce the editor if set by plugins.
		if ( $use_block_editor && ! $editors['block_editor'] ) {
			$use_block_editor = false;
		} elseif ( ! $use_block_editor && ! $editors['classic_editor'] && $editors['block_editor'] ) {
			$use_block_editor = true;
		}

		return $use_block_editor;
	}

	/**
	 * Keep the `classic-editor` query arg through redirects when saving posts.
	 */
	public static function redirect_location( $location ) {
		if (
			isset( $_REQUEST['classic-editor'] ) || // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			( isset( $_POST['_wp_http_referer'] ) && strpos( $_POST['_wp_http_referer'], '&classic-editor' ) !== false ) // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.NonceVerification.Missing
		) {
			$location = add_query_arg( 'classic-editor', '', $location );
		}

		return $location;
	}

	/**
	 * Keep the `classic-editor` query arg when looking at revisions.
	 */
	public static function get_edit_post_link( $url ) {
		$settings = self::get_settings();
		if ( isset( $_REQUEST['classic-editor'] ) || $settings['editor'] === 'classic' ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$url = add_query_arg( 'classic-editor', '', $url );
		}
		return $url;
	}

	public static function add_meta_box( $post_type, $post ) {
		$editors = self::get_enabled_editors_for_post( $post );

		if ( ! $editors['block_editor'] || ! $editors['classic_editor'] ) {
			// Editors cannot be switched.
			return;
		}

		$id = 'classic-editor-switch-editor';
		$title = __( 'Editor', 'tcd-classic-editor' );
		$callback = array( __CLASS__, 'do_meta_box' );
		$args = array(
			'__back_compat_meta_box' => true,
    );

		add_meta_box( $id, $title, $callback, null, 'side', 'default', $args );
	}

	public static function do_meta_box( $post ) {
		$edit_url = get_edit_post_link( $post->ID, 'raw' );

		// Switching to block editor.
		$edit_url = remove_query_arg( 'classic-editor', $edit_url );
		// Forget the previous value when going to a specific editor.
		$edit_url = add_query_arg( 'classic-editor__forget', '', $edit_url );

		?>
		<p style="margin: 1em 0;">
			<a href="<?php echo esc_url( $edit_url ); ?>"><?php esc_html_e( 'Switch to block editor', 'tcd-classic-editor' ); ?></a>
		</p>
		<?php
	}

	public static function enqueue_block_editor_scripts() {
		// get_enabled_editors_for_post() needs a WP_Post or post_ID.
		if ( empty( $GLOBALS['post'] ) ) {
			return;
		}

		$editors = self::get_enabled_editors_for_post( $GLOBALS['post'] );

		if ( ! $editors['classic_editor'] ) {
			// Editor cannot be switched.
			return;
		}

		wp_enqueue_script(
			'classic-editor-plugin',
			plugins_url( 'block-editor-plugin.js', __FILE__ ),
			array( 'wp-element', 'wp-components', 'lodash' ),
			'1.4',
			true
		);

		wp_localize_script(
			'classic-editor-plugin',
			'classicEditorPluginL10n',
			array( 'linkText' => __( 'Switch to classic editor', 'tcd-classic-editor' ) )
		);

	}


	/**
	 * Checks which editors are enabled for the post type.
	 *
	 * @param string $post_type The post type.
	 * @return array Associative array of the editors and whether they are enabled for the post type.
	 */
	private static function get_enabled_editors_for_post_type( $post_type ) {

		if ( isset( self::$supported_post_types[ $post_type ] ) ) {
			return self::$supported_post_types[ $post_type ];
		}

		$classic_editor = post_type_supports( $post_type, 'editor' );
		$block_editor = use_block_editor_for_post_type( $post_type );

		$editors = array(
			'classic_editor' => $classic_editor,
			'block_editor'   => $block_editor,
		);

		/**
		 * Filters the editors that are enabled for the post type.
		 *
		 * @param array $editors    Associative array of the editors and whether they are enabled for the post type.
		 * @param string $post_type The post type.
		 */
		$editors = apply_filters( 'tcdce_classic_editor_enabled_editors_for_post_type', $editors, $post_type );
		self::$supported_post_types[ $post_type ] = $editors;

		return $editors;
	}

	/**
	 * Checks which editors are enabled for the post.
	 *
	 * @param WP_Post $post  The post object.
	 * @return array Associative array of the editors and whether they are enabled for the post.
	 */
	private static function get_enabled_editors_for_post( $post ) {
		$post_type = get_post_type( $post );

		if ( ! $post_type ) {
			return array(
				'classic_editor' => false,
				'block_editor'   => false,
			);
		}

		$editors = self::get_enabled_editors_for_post_type( $post_type );

		/**
		 * Filters the editors that are enabled for the post.
		 *
		 * @param array $editors Associative array of the editors and whether they are enabled for the post.
		 * @param WP_Post $post  The post object.
		 */
		return apply_filters( 'tcdce_classic_editor_enabled_editors_for_post', $editors, $post );
	}

	/**
	 * Adds links to the post/page screens to edit any post or page in
	 * the classic editor or block editor.
	 *
	 * @param  array   $actions Post actions.
	 * @param  WP_Post $post    Edited post.
	 * @return array Updated post actions.
	 */
	public static function add_edit_links( $actions, $post ) {
		// This is in Gutenberg, don't duplicate it.
		if ( array_key_exists( 'classic', $actions ) ) {
			unset( $actions['classic'] );
		}

		if ( ! array_key_exists( 'edit', $actions ) ) {
			return $actions;
		}

		$edit_url = get_edit_post_link( $post->ID, 'raw' );

		if ( ! $edit_url ) {
			return $actions;
		}

		$editors = self::get_enabled_editors_for_post( $post );

		// Do not show the links if only one editor is available.
		if ( ! $editors['classic_editor'] || ! $editors['block_editor'] ) {
			return $actions;
		}

		// Forget the previous value when going to a specific editor.
		$edit_url = add_query_arg( 'classic-editor__forget', '', $edit_url );

		// Build the edit actions. See also: WP_Posts_List_Table::handle_row_actions().
		$title = _draft_or_post_title( $post->ID );

		// Link to the block editor.
		$url = remove_query_arg( 'classic-editor', $edit_url );
		$text = __( 'Edit (block editor)', 'tcd-classic-editor' );
		/* translators: %s: post title */
		$label = sprintf( __( 'Edit &#8220;%s&#8221; in the block editor', 'tcd-classic-editor' ), $title );
		$edit_block = sprintf( '<a href="%s" aria-label="%s">%s</a>', esc_url( $url ), esc_attr( $label ), $text );

		// Link to the classic editor.
		$url = add_query_arg( 'classic-editor', '', $edit_url );
		$text = __( 'Edit (classic editor)', 'tcd-classic-editor' );
		/* translators: %s: post title */
		$label = sprintf( __( 'Edit &#8220;%s&#8221; in the classic editor', 'tcd-classic-editor' ), $title );
		$edit_classic = sprintf( '<a href="%s" aria-label="%s">%s</a>', esc_url( $url ), esc_attr( $label ), $text );

		$edit_actions = array(
			'classic-editor-block' => $edit_block,
			'classic-editor-classic' => $edit_classic,
		);

		// Insert the new Edit actions instead of the Edit action.
		$edit_offset = array_search( 'edit', array_keys( $actions ), true );
		array_splice( $actions, $edit_offset, 1, $edit_actions );

		return $actions;
	}

	/**
	 * Show the editor that will be used in a "post state" in the Posts list table.
	 */
	public static function add_post_state( $post_states, $post ) {
		if ( get_post_status( $post ) === 'trash' ) {
			return $post_states;
		}

		$editors = self::get_enabled_editors_for_post( $post );

		if ( ! $editors['classic_editor'] && ! $editors['block_editor'] ) {
			return $post_states;
		} elseif ( $editors['classic_editor'] && ! $editors['block_editor'] ) {
			// Forced to classic editor.
			$state = '<span style="font-style: italic;font-weight: 400;color: #72777c;font-size: small;">' . __( 'classic editor', 'tcd-classic-editor' ) . '</span>';
		} elseif ( ! $editors['classic_editor'] && $editors['block_editor'] ) {
			// Forced to block editor.
			$state = '<span style="font-style: italic;font-weight: 400;color: #72777c;font-size: small;">' . __( 'block editor', 'tcd-classic-editor' ) . '</span>';
		} else {
			$last_editor = get_post_meta( $post->ID, 'classic-editor-remember', true );

			if ( $last_editor ) {
				$is_classic = ( $last_editor === 'classic-editor' );
			} else {
				$settings = self::get_settings();
				$is_classic = ( $settings['editor'] === 'classic' );
			}

			$state = $is_classic ? __( 'Classic editor', 'tcd-classic-editor' ) : __( 'Block editor', 'tcd-classic-editor' );
		}

		// Fix PHP 7+ warnings if another plugin returns unexpected type.
		$post_states = (array) $post_states;
		$post_states['classic-editor-plugin'] = $state;

		return $post_states;
	}

}

add_action( 'setup_theme', array( 'TCDCE_Support', 'init_actions' ) );

}
