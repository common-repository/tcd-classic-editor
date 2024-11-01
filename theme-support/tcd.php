<?php

/**
 * TCDテーマ専用サポート
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// テーマ毎に特定のPHPファイルを呼び出す（ex: rehub_tcd099）
$current_template = get_template();
if( $current_template ){
	$current_template_dir = TCDCE_PATH . 'theme-support/' . $current_template . '.php';
	if( file_exists( $current_template_dir ) ){
		require_once $current_template_dir;
	}
}

// テーマ専用スタイル
add_action( 'wp_enqueue_scripts', 'tcdce_enqueue_inline_asset', 11 );
function tcdce_enqueue_inline_asset(){

  // inline style
  wp_add_inline_style(
    'tcdce-editor',
    apply_filters( 'tcdce_enqueue_inline_style', '' )
  );

  // inline script
  wp_add_inline_script(
    'tcdce-editor',
    apply_filters( 'tcdce_enqueue_inline_script', '' )
  );

}

// 旧テーマの吹き出し対応
add_action( 'after_setup_theme', function(){

  $old_sbs = array(
    1 => 'speech_balloon_left1',
    2 => 'speech_balloon_left2',
    3 => 'speech_balloon_right1',
    4 => 'speech_balloon_right2'
  );

  foreach( $old_sbs as $sb_key => $sb_name ){
    if( shortcode_exists( $sb_name ) ){
      add_shortcode( $sb_name, function( $atts, $content ) use( $sb_name, $sb_key ) {

        if( ! function_exists( 'get_design_plus_option' ) ){
          return;
        }

        $dp_options = get_design_plus_option();

        $image = $dp_options['qt_speech_balloon' . $sb_key . '_user_image'] ?? '';
        $image_url = wp_get_attachment_url( $image ) ? wp_get_attachment_url( $image ) : '';
        $font_color = $dp_options['qt_speech_balloon' . $sb_key . '_font_color'] ?? '';
        $bg_color = $dp_options['qt_speech_balloon' . $sb_key . '_bg_color'] ?? '';
        $border_color = $dp_options['qt_speech_balloon' . $sb_key . '_border_color'] ?? '';
        $user_name = $dp_options['qt_speech_balloon' . $sb_key . '_user_name'] ?? '';

        $style =
        '--tcdce-sb-font-color:' . $font_color . ';' .
        '--tcdce-sb-image-url:url(' . $image_url . ');' .
        '--tcdce-sb-preset-color--bg:' . $bg_color . ';' .
        '--tcdce-sb-preset-color--border:' . $border_color . ';' .
        '--tcdce-sb-background: var(--tcdce-sb-preset-color--bg);' .
        '--tcdce-sb-border-color: var(--tcdce-sb-preset-color--border);' .
        '--tcdce-sb-padding: 1em 1.5em;';

        if( $sb_key == 1 || $sb_key == 2 ){
          $style .=
          '--tcdce-sb-direction: row;' .
          '--tcdce-sb-triangle-before-offset: -10px;' .
          '--tcdce-sb-triangle-after-offset: -7px;' .
          '--tcdce-sb-triangle-path: polygon(100% 0, 0 50%, 100% 100%);';

        }elseif( $sb_key == 3 || $sb_key == 4 ){
          $style .=
          '--tcdce-sb-direction: row-reverse;' .
          '--tcdce-sb-triangle-before-offset: 100%;' .
          '--tcdce-sb-triangle-after-offset: calc(100% - 3px);' .
          '--tcdce-sb-triangle-path: polygon(0 0, 0% 100%, 100% 50%);';

        }

        $atts = array(
          'id' => $sb_name,
          'user_name' => $user_name,
          'style' => $style,
        );

        $tcdce_editor = new TCDCE_Editor();
        return $tcdce_editor->shortcode_sb( $atts, $content );

      } );
    }
  }

});