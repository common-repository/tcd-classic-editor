<?php
/*
 *
 * TCDクラシックエディタークラス
 *
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'TCDCE_Editor' ) ) {
  class TCDCE_Editor {

		/**
		 * Dynamic css ajax action.
		 *
		 * @var string
		 */
    public $ajax_action = '';

		/**
		 * Dynamic css ajax url.
		 *
		 * @var string
		 */
    public $ajax_url = '';

		/**
     * Constructor.
     */
    public function __construct() {

			$this->ajax_action = 'tcd_quicktags_dynamic_css';

			$this->ajax_url = admin_url( 'admin-ajax.php?action=' . $this->ajax_action );

		}

		/**
     * エディター初期化.
     */
    public function init() {

			// フロント初期化
			add_action( 'after_setup_theme', array( $this, 'front_init' ) );

			// 管理画面初期化
			add_action( 'admin_init', array( $this, 'admin_init' ) );

		}


		/**
     * フロント 初期化.
     */
    public function front_init() {

			// TCDテーマ組み込みエディターを無効化
			remove_action( 'init', 'tcd_quicktag_front_init' );
			remove_action( 'admin_init', 'tcd_quicktag_admin_init' );

			// editor-stylesの有効化
			if( ! current_theme_supports( 'editor-styles' ) ){
				add_theme_support('editor-styles');
			}

			// エディターの本文をdivで囲むフィルター
			add_filter( 'the_content', array( $this, 'the_content' ) );

			// ショートコード登録
			add_shortcode( 'clink', array( $this, 'shortcode_clink' ) );
			add_shortcode( 'speech_bubble', array( $this, 'shortcode_sb' ) );
			add_shortcode( 'gmap', array( $this, 'shortcode_gmap' ) );
			add_shortcode( 'tcd_tab', array( $this, 'shortcode_tab' ) );

			// エディターのフロントスタイル
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

			// ギャラリーによって出力されるCSSを無効化
			add_filter( 'use_default_gallery_style', '__return_false' );

		}


		/**
     * the_contentフィルターの処理
		 *
		 * エディターの出力内容をdivで囲む.
		 *
     */
    public function the_content( $content ) {

			// tableをdivで囲む
			if( !has_blocks() ){
				$content = str_replace( '<table', '<div class="s_table"><table', $content );
				$content = str_replace( '</table>', '</table></div>', $content );
			}

			// フロントの改行をなくす
			$content = str_replace( '<p>&nbsp;</p>', '', $content );

			// ショートコードがpタグで囲まれるのを防ぐ
			$content = strtr( $content, array (
				'<p>[' => '[',
				']</p>' => ']',
				']<br />' => ']'
			) );

			// エディター用クラス
			$content = '<div class="tcdce-body">' . $content . '</div>';

			return $content;

		}


		/**
     * エディターのcss&jsを読み込む.
     */
    public function enqueue_assets() {

			// エディター基本スタイル
			wp_enqueue_style( 'tcdce-editor', TCDCE_URL . 'assets/css/editor.css', array(), filemtime( TCDCE_PATH . 'assets/css/editor.css' ) );

			// エディター（過去テーマ対応）
			wp_enqueue_style( 'tcdce-old-style', TCDCE_URL . 'assets/css/old-style.css', array(), filemtime( TCDCE_PATH . 'assets/css/old-style.css' ) );

			// TCDテーマに組み込まれているスタイル
			wp_enqueue_style( 'tcdce-utility', TCDCE_URL . 'assets/css/utility.css', array(), filemtime( TCDCE_PATH . 'assets/css/utility.css' ) );

			// クイックタグ用スタイル
			wp_add_inline_style( 'tcdce-editor', $this->render_quicktag_style() );

			// エディター用基本スクリプト
			wp_enqueue_script( 'tcdce-editor', TCDCE_URL . 'assets/js/editor.js', array(), filemtime( TCDCE_PATH . 'assets/js/editor.js' ), true );

		}


		/**
     * 管理画面の初期化.
     */
    public function admin_init() {

			// tinymceのスクリプト登録
			add_filter( 'mce_external_plugins', array( $this, 'mce_register_scripts' ), 10, 2 );

			// tinymceのボタン登録
			add_filter( 'mce_buttons', array( $this, 'mce_register_buttons' ), 10, 2 );

			// tinymceのタグ登録
			add_action( 'admin_print_footer_scripts', array( $this, 'mce_register_tags' ) );

			// tinymceのbodyにclass追加
			add_filter( 'tiny_mce_before_init', array( $this, 'mce_add_body_class' ), 10, 2 );

			// ビジュアルエディター用スタイル（ajax）
			add_action( 'wp_ajax_' . $this->ajax_action, array( $this, 'ajax_quicktag_dynamic_css' ) );

			// エディタースタイル
			add_editor_style( TCDCE_URL . 'assets/css/editor.css?d='.gmdate( 'YmdGis', filemtime( TCDCE_PATH . 'assets/css/editor.css' ) ) );
			add_editor_style( TCDCE_URL . 'assets/css/old-style.css?d='.gmdate( 'YmdGis', filemtime( TCDCE_PATH . 'assets/css/old-style.css' ) ) );
			add_editor_style( $this->ajax_url );

			// クラシックブロック対策
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_classic_block_assets' ) );

		}


		/**
     * tinymceのスクリプト登録
     */
    public function mce_register_scripts( $external_plugins, $editor_id ) {
			$external_plugins['table'] = TCDCE_URL . 'assets/js/tinymce-table.min.js';
			$external_plugins['tcdce_button'] = TCDCE_URL . 'assets/js/tinymce-button.js';
			return $external_plugins;
		}


		/**
     * tinymceのボタン登録
     */
    public function mce_register_buttons( $mce_buttons, $editor_id ) {
			array_push( $mce_buttons, 'table', 'tcdce_button' );
			return $mce_buttons;
		}


		/**
     * tinymceのタグ登録
     */
    public function mce_register_tags() {

			$tcdQuicktagsL10n = array(
				'pulldown_title' => array(
					'display' => __( 'Quicktag', 'tcd-classic-editor' ),
				),
			);

			$tcdce_quicktag = get_option( 'tcdce_quicktag' );
			if( !empty( $tcdce_quicktag ) ){
				foreach( $tcdce_quicktag as $key => $quicktag ){
					if( ! $quicktag['show'] ){
						continue;
					}
					$qt_key = 'qt-' . $key;
					$item = $quicktag['item'];
					$register_quicktag = apply_filters( "tcdce_qt_register_{$item}", array(), $quicktag, $key );
					if( ! empty( $register_quicktag ) ){
						$tcdQuicktagsL10n[$qt_key] = $register_quicktag;
					}
				}
			}

			echo '<script id="tcdce-register-quicktag" type="text/javascript">';

			// check if WYSIWYG is enabled
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				echo "var tcdQuicktagsL10n = " . wp_json_encode( $tcdQuicktagsL10n ) . ";\n";
			}

			if ( wp_script_is( 'quicktags' ) ) {

				// layout2c
				$tcdQuicktagsL10n['post_col-2'] = array(
					'display' => __( '2 column', 'tcd-classic-editor' ),
					'tag' => '<div class="post_row"><div class="post_col post_col-2">' . __( 'Text and image tags to display in the left column', 'tcd-classic-editor' ) . '</div><div class="post_col post_col-2">' . __( 'Text and image tags to display in the right column', 'tcd-classic-editor' ) . '</div></div>'
				);
				// layout3c
				$tcdQuicktagsL10n['post_col-3'] = array(
					'display' => __( '3 column', 'tcd-classic-editor' ),
					'tag' => '<div class="post_row"><div class="post_col post_col-3">' . __( 'Text and image tags to display in the left column', 'tcd-classic-editor' ) . '</div><div class="post_col post_col-3">' . __( 'Text and image tags to display in the center column', 'tcd-classic-editor' ) . '</div><div class="post_col post_col-3">' . __( 'Text and image tags to display in the right column', 'tcd-classic-editor' ) . '</div></div>'
				);
				// tab2
				$tcdQuicktagsL10n['tab'] = array(
					'display' => __( 'Tab', 'tcd-classic-editor' ),
					'tag' => __( '[tcd_tab tab1="Tab1 headline" img1="Tab1 image url" tab2="Tab2 headline" img2="Tab2 image url"]', 'tcd-classic-editor' )
				);

				foreach ( $tcdQuicktagsL10n as $key => $value ) {
					if ( is_numeric( $key ) || empty( $value['display'] ) ) {
						continue;
					}
					if ( empty( $value['tag'] ) && empty( $value['tagStart'] ) ) {
						continue;
					}
					if ( isset( $value['tag'] ) && ! isset( $value['tagStart'] ) ) {
						$value['tagStart'] = $value['tag'] . "\n\n";
					}
					if ( ! isset( $value['tagEnd'] ) ) {
						$value['tagEnd'] = '';
					}

					echo 'QTags.addButton(';
					echo wp_json_encode( $key ) . ',';
					echo wp_json_encode( $value['display'] ) . ',';
					echo wp_json_encode( $value['tagStart'] ) . ',';
					echo wp_json_encode( $value['tagEnd'] );
					echo ');';
				}

			}

			echo '</script>';

		}


		/**
     * tinymceのエディターにclass追加
     */
    public function mce_add_body_class( $mce_init, $editor_id ) {
			$mce_init['body_class'] = 'tcdce-body';
			return $mce_init;
		}


		/**
     * クイックタグスタイルをtinymceで読み込む
     */
    public function ajax_quicktag_dynamic_css() {
			header( 'Content-Type: text/css; charset=UTF-8' );
			add_filter( 'attribute_escape', 'tcdce_custom_attribute_escape', 10, 2 );
			echo esc_attr( $this->render_quicktag_style() );
			remove_filter( 'attribute_escape', 'tcdce_custom_attribute_escape', 10, 2 );
			exit;
		}


		/**
     * 追加したクイックタグのスタイルの読み込み
     */
    public function render_quicktag_style() {

			$css = '';
			$tcdce_quicktag = get_option( 'tcdce_quicktag' );
			if( !empty( $tcdce_quicktag ) ){
				foreach( $tcdce_quicktag as $key => $quicktag ){

					$class = $quicktag['class'] ?? '';

					// button（親に当たるが、要確認）
					if( $quicktag['item'] == 'button' ){
						$class = 'tcdce-button-wrapper:has(.' . $class . '), .q_button_wrap:has(.' . $class . ')';
					}

					$qt_style = $quicktag['style'] ?? array();
					if( ! empty( $qt_style ) ){

						$css .= '.' . $class . '{';
						foreach( $qt_style as $property => $value ){

							if(
								strpos( $property,'font-size') !== false ||
								strpos( $property,'-margin-') !== false ||
								strpos( $property,'-button-size-') !== false
							){
								$value = $value . 'px';
							}

							if( strpos( $property,'image-url') !== false ){
								$value = wp_get_attachment_url( $value ) ? 'url(' . wp_get_attachment_url( $value ) . ')' : '';
							}

							$css .= $property . ':' . $value . ';';
						}

						$css .= '}';

					}

					// custom tag
					if( $quicktag['item'] == 'custom_tag' && $quicktag['css'] ){
						$css .= $quicktag['css'];
					}

				}
			}

			return $css;

		}


		/**
     * クラシックブロック対策
     */
		public function enqueue_classic_block_assets() {

			// クラシックブロック用クイックタグajaxスタイル
			wp_enqueue_style( 'tcdce-classic-block', $this->ajax_url, array(), TCDCE_VER );

			// クラシックブロック用スクリプト（スタイルシートの上書き）
			wp_enqueue_script( 'tcdce-classic-block', TCDCE_URL . 'assets/js/classic-block.js', array(), TCDCE_VER, true );

		}


		/**
     * ショートコード「カードリンク」
		 *
		 * NOTE: 既存テーマのカードリンクを更新
     */
		public function shortcode_clink( $atts ) {

			if( ! class_exists( 'TCDCE_Open_Graph' ) ){
				require_once TCDCE_PATH . 'classes/class-tcdce-open-graph.php';
			}

			$atts = shortcode_atts(
				array(
					'url' => ''
				),
				$atts
			);

			if ( ! $atts['url'] ) {
				return '';
			}

			// URLからID取得
			$post_id = url_to_postid( $atts['url'] );

			// 内部リンク
			if( $post_id ){

				$post = get_post( $post_id );
				$image = get_the_post_thumbnail_url( $post_id );
				$title = get_the_title( $post );
				$date = get_the_date( 'Y.m.d', $post );
				$update_date = get_the_modified_date( 'Y.m.d', $post );
				$desc = $post->post_excerpt ? $post->post_excerpt : $post->post_content;

			// 外部リンク
			}else{

				$graph = TCDCE_Open_Graph::fetch( $atts['url'] );
				$image = $graph->image;
				$title = $graph->title;
				$date = '';
				$update_date = '';
				$desc = $graph->description;

			}

			ob_start();
?>
<div class="tcdce-card">
	<a class="tcdce-card__link" href="<?php echo esc_url( $atts['url'] ); ?>">
		<?php if( $image ){ ?>
		<div class="tcdce-card__image">
			<img class="tcdce-card__image-bg" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
		</div>
		<?php } ?>
		<div class="tcdce-card__content">
			<?php if( $date ){ ?>
			<div class="tcdce-card__meta">
				<span class="tcdce-card__meta-date tcdce-card__meta-date--publish">
					<?php echo esc_html( $date ); ?>
				</span>
				<span class="tcdce-card__meta-date tcdce-card__meta-date--modify">
					<?php echo esc_html( $update_date ); ?>
				</span>
			</div>
			<?php } ?>
			<div class="tcdce-card__title"><?php echo esc_html( $title ); ?></div>
<?php

	$desc = preg_replace( '/<!--more-->.+/is', '', $desc ); // moreタグ以降削除
	$desc = strip_shortcodes( $desc ); // ショートコード削除
	$desc = wp_strip_all_tags( $desc ); // タグの除去
	$desc = str_replace( '&nbsp;', '', $desc ); // 特殊文字の削除（今回はスペースのみ）
	$desc = mb_strimwidth( $desc, 0, 200, '...' ); // 文字列を指定した長さで切り取る

?>
			<div class="tcdce-card__desc"><?php echo esc_html( $desc ); ?></div>

		</div>
	</a>
</div>
<?php
			return ob_get_clean();

		}


		/**
     * ショートコード「吹き出し」
		 *
		 * NOTE: 旧テーマとは別で登録
		 * NOTE: 旧テーマのショートコードの互換性を保つ処理（/theme-suppot/tcd.php）
     */
		public function shortcode_sb( $atts, $content ) {

			$atts = shortcode_atts( array(
				'id' => null,
				'user_name' => '',
				'style' => '',
			), $atts );

			$sb_id = $atts['id'];
			$style = $atts['style'] ? $atts['style'] : '';

			if( $sb_id == null ){
				return;
			}

			$tcdce_quicktag = get_option( 'tcdce_quicktag' );
			$sb_name = $tcdce_quicktag[$sb_id]['user_name'] ?? '';
			$sb_name = $atts['user_name'] ? $atts['user_name'] : $sb_name;

			ob_start();
?>
<div class="tcdce-sb" data-key="<?php echo esc_attr( $sb_id ); ?>" style="<?php echo esc_attr( $style ); ?>">
	<div class="tcdce-sb-user">
		<div class="tcdce-sb-user-image"></div>
		<span class="tcdce-sb-user-name js-tcdce-preview-option--text-target"><?php echo esc_html( $sb_name ); ?></span>
	</div>
	<div class="tcdce-sb-content"><?php echo wp_kses_post( wpautop( $content ) ); ?></div>
</div>
<?php
			return ob_get_clean();
		}

		/**
     * ショートコード「Google Maps」
		 *
		 * NOTE: 旧テーマとは別で登録
		 * NOTE: 旧テーマのショートコードも利用できるが併用ｊは考慮していない
     */
		public function shortcode_gmap( $atts ) {

			$atts = shortcode_atts( array(
				'address' => '',
				'image' => '',
				'text' => '',
			), $atts );

			// address check
			if ( ! $atts['address'] ) {
				return '<div style="color:red;background: rgb(255 0 0 / 20%);padding: 0.5em 1em;">' . __( 'The address has not been entered.', 'tcd-classic-editor' ) . '</div>';
			}

			// api check
			$tcdce_gmap = get_option( 'tcdce_gmap' );
			$api_key = $tcdce_gmap['api'];
			if( ! $api_key ){
				return '<div style="color:red;background: rgb(255 0 0 / 20%);padding: 0.5em 1em;">' . __( 'Google Maps Platform API key not entered.', 'tcd-classic-editor' ) . '</div>';
			}

			if ( ! wp_script_is( 'qt_google_map_api', 'enqueued' ) ) {
				// Using Google Maps API to embed maps on the website
				$google_map_api_url = add_query_arg(
					array(
						'key' => esc_attr( $api_key ),
						'loading' => 'async'
					),
					'https://maps.googleapis.com/maps/api/js'
				);
				wp_enqueue_script( 'qt_google_map_api', $google_map_api_url, array(), TCDCE_VER, true );
			}

			// saturation
			$saturation = $tcdce_gmap['saturation'];

			// map style
			$style = '';

			// font & bg color
			$style .= '--tcdce-gmap-font-color:' . $tcdce_gmap['--tcdce-gmap-font-color'] . ';';
			$style .= '--tcdce-gmap-bg-color:' . $tcdce_gmap['--tcdce-gmap-bg-color'] . ';';

			// marker type
			switch( $tcdce_gmap['marker'] ){

				case 'text' :
					$use_ovarlay = 1;
					$text = $atts['text'] ? $atts['text'] : $tcdce_gmap['text'];
					$image = '';
					break;

				case 'image' :
					$use_ovarlay = 1;
					$text = '';
					$image = wp_get_attachment_url( $tcdce_gmap['--tcdce-gmap-image-url'] ) ? wp_get_attachment_url( $tcdce_gmap['--tcdce-gmap-image-url'] ) : '';
					if( $atts['image'] ){
						$image = $atts['image'];
					}
					if( $image ){
						$style .= '--tcdce-gmap-image-url:url(' . $image . ');';
					}
					break;

				default :
					$use_ovarlay = 0;
					$text = '';
					$image = '';

			}

			ob_start();
?>
<div class="tcdce-gmap" style="<?php echo esc_attr( $style ); ?>">
  <div class="tcdce-gmap-wrapper">
    <div
      class="tcdce-gmap__embed js-tcdce-gmap"
      data-address="<?php echo esc_attr( $atts['address'] ); ?>"
      data-saturation="<?php echo esc_attr( $saturation ); ?>"
      data-use-overlay="<?php echo esc_attr( $use_ovarlay ); ?>"
      data-marker-text="<?php echo esc_attr( $text ); ?>"
    ></div>
  </div>
</div>
<?php
			return ob_get_clean();
		}


		/**
     * ショートコード「タブ」
		 *
		 * NOTE: 旧テーマとは別で登録
		 * NOTE: 旧テーマのショートコードの互換性を保つ処理（/theme-suppot/tcd.php）
     */
		public function shortcode_tab( $atts ) {

			$atts = shortcode_atts( array(
				'tab1' => '',
				'img1' => '',
				'tab2' => '',
				'img2' => '',
				'tab3' => '',
				'img3' => '',
			), $atts );

			$output = '';
			$tab_label = '';
			$tab_field = '';
			$active_class = 'is-active';

			for ($i = 1; $i <= 3; $i++) {
				if( $atts['tab' . $i] ){
					$tab_label .= '<div class="tcdce-tab__label-item tcdce-tab__label-item' . $i . ' ' . $active_class . '">' . esc_html( $atts['tab' . $i] ) . '</div>';
					$tab_field .= '<div class="tcdce-tab__field tcdce-tab__field' . $i . '">';
					$image_id = attachment_url_to_postid( $atts['img' . $i] );
					if( $image_id ){
						$tab_field .= wp_get_attachment_image( $image_id, 'full' );
						if( wp_get_attachment_caption( $image_id ) ){
							$tab_field .= '<span class="tcdce-tab__field-caption">' . wp_get_attachment_caption( $image_id ) . '</span>';
						}
					}
					$tab_field .= '</div>';
					$active_class = '';
				}
			}

			$output .= '<div class="tcdce-tab">';
			$output .= '<div class="tcdce-tab__label">';
			$output .= $tab_label;
			$output .= '</div>';
			$output .= $tab_field;
			$output .= '</div>';

			return $output;

		}

	}

	// 初期化
	add_action( 'plugin_loaded', array( new TCDCE_Editor, 'init' ) );

}