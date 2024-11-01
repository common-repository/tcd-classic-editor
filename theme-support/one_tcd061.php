<?php

/**
 * ONE support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * ・サイドバーが無い
 */

/**
 * Default Quicktag Setting
 */
add_filter( 'tcdce_quicktag_setting_default', function( $default ){

  if( ! function_exists( 'get_design_plus_option' ) ){
    return $default;
  }

  $dp_options = get_design_plus_option();

  $main_color = $dp_options['main_color'] ?? '#000000';

  /**
 * クイックタグ
 * ・カードリンク
 * ・広告（[s_ad]）
 */

  return array(

    // h2
    array(
      'item' => 'h2',
      'show' => 1,
      'class' => 'styled_h2',
      /* translators: %s: quicktag heading label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'H2', 'tcd-classic-editor' ) ),
      'preset' => 'preset07',
      'style' => array(
        '--tcdce-h2-font-size-pc' => 24,
        '--tcdce-h2-font-size-sp' => 20,
        '--tcdce-h2-text-align' => 'left',
        '--tcdce-h2-font-weight' => '600',
        '--tcdce-h2-line-height' => '1.5',
        '--tcdce-h2-font-color' => '#000000',
        '--tcdce-h2-preset-color--bg' => '#fafafa',
        '--tcdce-h2-preset-color--border' => '#000000',
        '--tcdce-h2-preset-color--gradation1' => '',
        '--tcdce-h2-preset-color--gradation2' => '',
        '--tcdce-h2-border-width' => '3px',
        '--tcdce-h2-padding' => '0.75em 0 0.75em 1em',
        '--tcdce-h2-background' => 'var(--tcdce-h2-preset-color--bg)',
        '--tcdce-h2-border-top' => 'none',
        '--tcdce-h2-border-right' => 'none',
        '--tcdce-h2-border-bottom' => 'none',
        '--tcdce-h2-border-left' => 'var(--tcdce-h2-border-width) solid var(--tcdce-h2-preset-color--border)',
        '--tcdce-h2-margin-top-pc' => 100,
        '--tcdce-h2-margin-top-sp' => 50,
        '--tcdce-h2-margin-bottom-pc' => 40,
        '--tcdce-h2-margin-bottom-sp' => 20,
      )
    ),
    // h3
    array(
      'item' => 'h3',
      'show' => 1,
      'class' => 'styled_h3',
      /* translators: %s: quicktag heading label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'H3', 'tcd-classic-editor' ) ),
      'preset' => 'preset09',
      'style' => array(
        '--tcdce-h3-font-size-pc' => 22,
        '--tcdce-h3-font-size-sp' => 18,
        '--tcdce-h3-text-align' => 'left',
        '--tcdce-h3-font-weight' => '600',
        '--tcdce-h3-line-height' => '1.5',
        '--tcdce-h3-font-color' => '#000000',
        '--tcdce-h3-preset-color--bg' => '',
        '--tcdce-h3-preset-color--border' => '#000000',
        '--tcdce-h3-preset-color--gradation1' => '',
        '--tcdce-h3-preset-color--gradation2' => '',
        '--tcdce-h3-border-width' => '1px',
        '--tcdce-h3-padding' => '0 0 0.7em',
        '--tcdce-h3-background' => 'transparent',
        '--tcdce-h3-border-top' => 'none',
        '--tcdce-h3-border-right' => 'none',
        '--tcdce-h3-border-bottom' => 'var(--tcdce-h3-border-width) solid var(--tcdce-h3-preset-color--border)',
        '--tcdce-h3-border-left' => 'none',
        '--tcdce-h3-margin-top-pc' => 80,
        '--tcdce-h3-margin-top-sp' => 50,
        '--tcdce-h3-margin-bottom-pc' => 40,
        '--tcdce-h3-margin-bottom-sp' => 20,
      )
    ),
    // h4
    array(
      'item' => 'h4',
      'show' => 1,
      'class' => 'styled_h4',
      /* translators: %s: quicktag heading label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'H4', 'tcd-classic-editor' ) ),
      'preset' => 'preset11',
      'style' => array(
        '--tcdce-h4-font-size-pc' => 20,
        '--tcdce-h4-font-size-sp' => 16,
        '--tcdce-h4-text-align' => 'left',
        '--tcdce-h4-font-weight' => '400',
        '--tcdce-h4-line-height' => '1.5',
        '--tcdce-h4-font-color' => '#000000',
        '--tcdce-h4-preset-color--bg' => '',
        '--tcdce-h4-preset-color--border' => '#000000',
        '--tcdce-h4-preset-color--gradation1' => '',
        '--tcdce-h4-preset-color--gradation2' => '',
        '--tcdce-h4-border-width' => '1px',
        '--tcdce-h4-padding' => '0 0 0.7em',
        '--tcdce-h4-background' => 'transparent',
        '--tcdce-h4-border-top' => 'none',
        '--tcdce-h4-border-right' => 'none',
        '--tcdce-h4-border-bottom' => 'var(--tcdce-h4-border-width) dotted var(--tcdce-h4-preset-color--border)',
        '--tcdce-h4-border-left' => 'none',
        '--tcdce-h4-margin-top-pc' => 60,
        '--tcdce-h4-margin-top-sp' => 40,
        '--tcdce-h4-margin-bottom-pc' => 40,
        '--tcdce-h4-margin-bottom-sp' => 20,
      )
    ),
    // box1
    array(
      'item' => 'box',
      'show' => 1,
      'class' => 'well',
      /* translators: %s: quicktag box label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Box', 'tcd-classic-editor' ) . 1 ),
      'preset' => 'preset01',
      'box_label' => '',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => 'none',
        '--tcdce-box-icon-offset' => '0',
        '--tcdce-box-preset-color--bg' => '#fafafa',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
        '--tcdce-box-margin-top-pc' => 40,
        '--tcdce-box-margin-top-sp' => 20,
        '--tcdce-box-margin-bottom-pc' => 40,
        '--tcdce-box-margin-bottom-sp' => 20,
      )
    ),
    // box2
    array(
      'item' => 'box',
      'show' => 1,
      'class' => 'well2',
      /* translators: %s: quicktag box label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Box', 'tcd-classic-editor' ) . 2 ),
      'preset' => 'preset06',
      'box_label' => 'NOTE',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => '\'\e904\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#000000',
        '--tcdce-box-preset-color--border' => '#000000',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-margin-top-pc' => 40,
        '--tcdce-box-margin-top-sp' => 20,
        '--tcdce-box-margin-bottom-pc' => 40,
        '--tcdce-box-margin-bottom-sp' => 20,
      )
    ),
    // box3
    array(
      'item' => 'box',
      'show' => 1,
      'class' => 'well3',
      /* translators: %s: quicktag box label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Box', 'tcd-classic-editor' ) . 3 ),
      'preset' => 'preset09',
      'box_label' => 'TIPS',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#EDB40A',
        '--tcdce-box-icon-content' => '\'\e908\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#fdf8ea',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
        '--tcdce-box-margin-top-pc' => 40,
        '--tcdce-box-margin-top-sp' => 20,
        '--tcdce-box-margin-bottom-pc' => 40,
        '--tcdce-box-margin-bottom-sp' => 20,
      )
    ),
    // button1
    array(
      'item' => 'button',
      'show' => 1,
      'class' => 'q_button',
      /* translators: %s: quicktag button label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Button', 'tcd-classic-editor' ) ),
      'preset' => 'preset01',
      'style' => array(
        '--tcdce-button-font-size-pc' => 16,
        '--tcdce-button-font-size-sp' => 14,
        '--tcdce-button-font-weight' => '400',
        '--tcdce-button-shape' => 'var(--tcdce-button-shape--round)',
        '--tcdce-button-size-width-pc' => 270,
        '--tcdce-button-size-width-sp' => 220,
        '--tcdce-button-size-height-pc' => 60,
        '--tcdce-button-size-height-sp' => 50,
        '--tcdce-button-preset-color--a' => $main_color,
        '--tcdce-button-preset-color--b' => '',
        '--tcdce-button-preset-color--gradation--a' => '',
        '--tcdce-button-preset-color--gradation--b' => '',
        '--tcdce-button-font-color' => '#ffffff',
        '--tcdce-button-font-color-hover' => '#ffffff',
        '--tcdce-button-background' => 'var(--tcdce-button-preset-color--a)',
        '--tcdce-button-background-hover' => 'var(--tcdce-button-preset-color--a)',
        '--tcdce-button-border' => 'none',
        '--tcdce-button-border-hover' => 'none',
        '--tcdce-button-transform' => 'none',
        '--tcdce-button-transform-hover' => 'none',
        '--tcdce-button-overlay' => '\'\'',
        '--tcdce-button-margin-top-pc' => 40,
        '--tcdce-button-margin-top-sp' => 20,
        '--tcdce-button-margin-bottom-pc' => 40,
        '--tcdce-button-margin-bottom-sp' => 20,
      )
    ),
    // cardlink
    array(
      'item' => 'cardlink',
      'show' => 1,
      'label' => __( 'Cardlink', 'tcd-classic-editor' )
    )

  );

  return $default;

});

/**
 * クイックタグ
 * ・YouTube（なくす）
 * ・カードリンク（引き継ぎ）
 * ・レイアウト2c, 3c（実装済み）
 * ・H2〜H4（引き継ぎ）
 * ・囲み枠a〜c（元デザインのまま？）
 * ・ボタン各種（引き継ぐ？）
 * ・広告（[s_ad]）
 * ・改ページ（これなくす）
 * ・縦書き（これ必要？）
 */


/**
 * current style
 */
add_filter( 'tcdce_enqueue_inline_style', function(){
  ob_start();
?>
@media not all and (max-width:767px) {
  .p-toc-open {
    display: none;
  }
  .p-toc-open {
    right: 30px;
    bottom: 35px;
  }
}
@media (max-width:767px) {
  .p-toc-open {
    right: 15px;
    bottom: 25px;
  }
  body:has(.dp-footer-bar) .p-toc-open {
    margin-bottom: 50px;
  }
}
<?php
  return ob_get_clean();
} );

/**
 * 目次
 *
 * オプションからサイドバーの選択肢をなくす
 */
add_filter( 'tcdce_toc_setting_display_options', function( $options ){
  unset($options[2]);
  unset($options[3]);
  return $options;
});


/**
 * message
 */
add_action( 'tcdce_top_menu', function(){

  // このテーマはサイドバーに目次を表示できない
  // このテーマはページビルダーとは併用できない
?>
<p class="p-guide-caution">
  <?php esc_html_e( 'The “Quick Tags” feature of the TCD theme is not available while this plugin is activated.', 'tcd-classic-editor' ); ?>
</p>
<?php
}, 9 );