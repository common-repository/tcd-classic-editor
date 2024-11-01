<?php

/**
 * クイックタグ設定 box
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// エディタにクイックタグ登録
add_filter( 'tcdce_qt_register_box', function( $value, $quicktag ) {
  $tag_start = '<p class="tcdce-box ' . esc_attr( $quicktag['class'] ) . '">';
  if( $quicktag['box_label'] ){
    $tag_start .= '<span class="tcdce-box-label">' . $quicktag['box_label'] . '</span>';
  }
  return array(
    'display' => $quicktag['label'],
    'tagStart' => $tag_start,
    'tagEnd' => '</p>'
  );

}, 10, 2 );


// データセット
add_action( 'tcdce_qt_fields_set_properties', function( $instance ) {

  // ラベルをセット
  $instance->set_label( 'box', __( 'Box', 'tcd-classic-editor' ) );

  // プレビュー情報をセット
  $instance->set_preview(
    'box',
    '<p class="tcdce-preview--box tcdce-box js-tcdce-preview-target">
      <span class="tcdce-box-label tcdce-preview--box-label js-tcdce-preview-option--text-target">__LABEL__</span>' .
      /* translators: %s: quicktag box label */
      sprintf( __( 'Sample %s', 'tcd-classic-editor' ), $instance->get_label( 'box' ) ) .
    '</p>'
  );

  // 初期値をセット
  $instance->set_default( 'box', array(
    'item' => 'box',
    'show' => 1,
    'class' => 'custom_box',
    /* translators: %s: quicktag box label */
    'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), $instance->get_label( 'box' ) ),
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
  ) );

  // プリセットデータをセット
  $instance->set_preset( 'box', array(

    'preset01' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 1 ),
      'box_label' => '',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => 'none',
        '--tcdce-box-icon-offset' => '0',
        '--tcdce-box-preset-color--bg' => '#f3f3f3',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset02' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 2 ),
      'box_label' => '',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => 'none',
        '--tcdce-box-icon-offset' => '0',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#000000',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset03' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 3 ),
      'box_label' => __( 'Label', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => 'none',
        '--tcdce-box-icon-offset' => '0',
        '--tcdce-box-preset-color--bg' => '#f3f3f3',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset04' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 4 ),
      'box_label' => __( 'Label', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => 'none',
        '--tcdce-box-icon-offset' => '0',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#000000',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset05' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 5 ),
      'box_label' => 'NOTE',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => '\'\e904\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#f3f3f3',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset06' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 6 ),
      'box_label' => 'NOTE',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#000000',
        '--tcdce-box-icon-content' => '\'\e904\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#000000',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset07' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 7 ),
      'box_label' => 'MEMO',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#673202',
        '--tcdce-box-icon-content' => '\'\e905\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#f0eae7',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset08' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 8 ),
      'box_label' => 'MEMO',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#673202',
        '--tcdce-box-icon-content' => '\'\e905\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#673202',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset09' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 9 ),
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
      )
    ),
    'preset10' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 10 ),
      'box_label' => 'TIPS',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#EDB40A',
        '--tcdce-box-icon-content' => '\'\e908\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#EDB40A',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset11' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 11 ),
      'box_label' => __( 'Caution', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#f50000',
        '--tcdce-box-icon-content' => '\'\e906\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#ffe9e7',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset12' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 12 ),
      'box_label' => __( 'Caution', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#f50000',
        '--tcdce-box-icon-content' => '\'\e906\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#f50000',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset13' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 13 ),
      'box_label' => __( 'Strengths', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#118FC7',
        '--tcdce-box-icon-content' => '\'\e90a\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#eaf3fa',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset14' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 14 ),
      'box_label' => __( 'Strengths', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#118FC7',
        '--tcdce-box-icon-content' => '\'\e90a\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#118FC7',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset15' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 15 ),
      'box_label' => __( 'Weaknesses', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#EF3C00',
        '--tcdce-box-icon-content' => '\'\e909\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#feece8',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset16' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 16 ),
      'box_label' => __( 'Weaknesses', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#EF3C00',
        '--tcdce-box-icon-content' => '\'\e909\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#EF3C00',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),
    'preset17' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 17 ),
      'box_label' => 'POINT',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#16AE05',
        '--tcdce-box-icon-content' => '\'\e903\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '#ebf6e9',
        '--tcdce-box-preset-color--border' => '',
        '--tcdce-box-background' => 'var(--tcdce-box-preset-color--bg)',
        '--tcdce-box-border-top' => 'none',
        '--tcdce-box-border-left' => 'none',
        '--tcdce-box-border-bottom' => 'none',
        '--tcdce-box-border-right' => 'none',
      )
    ),
    'preset18' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 18   ),
      'box_label' => 'POINT',
      'style' => array(
        '--tcdce-box-font-size-pc' => 16,
        '--tcdce-box-font-size-sp' => 14,
        '--tcdce-box-font-color' => '#000000',
        '--tcdce-box-font-weight' => '400',
        '--tcdce-box-label-color' => '#16AE05',
        '--tcdce-box-icon-content' => '\'\e903\'',
        '--tcdce-box-icon-offset' => '1.6em',
        '--tcdce-box-preset-color--bg' => '',
        '--tcdce-box-preset-color--border' => '#16AE05',
        '--tcdce-box-background' => 'transparent',
        '--tcdce-box-border-top' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-left' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-bottom' => '1px solid var(--tcdce-box-preset-color--border)',
        '--tcdce-box-border-right' => '1px solid var(--tcdce-box-preset-color--border)',
      )
    ),

  ) );

} );


// 専用フィールド
add_action( 'tcdce_qt_fields_repeater_options_box', function( $instance, $base_name, $base_value ){

  $instance->fields( __( 'Quicktag setting', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Registered name', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->text( $base_name, $base_value, 'label', 'js-tcdce-repeater-label js-tcdce-empty-validation' )
    ),
    array(
      'title' => __( 'Class name', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->text( $base_name, $base_value, 'class', 'js-tcdce-empty-validation' )
    ),
  ) );

}, 10, 3 );


// 専用フィールド（プレビュー用）
add_action( 'tcdce_qt_fields_repeater_preview_options_box', function( $instance, $name, $value ) {

  $item_type = 'box';
  $default = $instance->default[$item_type]['style'];
  $style_name = $name . '[style]';
  $style_value = $value['style'];

  // text
  $instance->fields( __( 'Preview', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Design Preset', 'tcd-classic-editor' ),
      'field' => $instance->preset( $name . '[preset]', $value['preset'], $item_type ),
    ),
    array(
      'title' => __( 'Font size', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-box-font-size-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-box-font-size-pc'],
        ),
        '--tcdce-box-font-size-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-box-font-size-sp'],
        ),
      ) ),
    ),
    array(
      'title' => __( 'Font weight', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->radio( $style_name, $style_value, '--tcdce-box-font-weight', array(
        '400' => TCDCE_ICONS['thick'],
        '600' => TCDCE_ICONS['bold'],
      ) ),
    ),
    array(
      'title' => __( 'Font color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-box-font-color' )
    ),
    array(
      'title' => __( 'Label', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->text( $name, $value, 'box_label', 'js-tcdce-preview-option js-tcdce-preview-target--text' )
    ),
    array(
      'title' => __( 'Label color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-box-label-color' )
    ),
    array(
      'title' => __( 'Background color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-box-preset-color--bg' )
    ),
    array(
      'title' => __( 'Border color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-box-preset-color--border' )
    ),
  ) );

  // margin
  $instance->fields( __( 'Margin', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Margin top', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-box-margin-top-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-box-margin-top-pc'],
        ),
        '--tcdce-box-margin-top-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-box-margin-top-sp'],
        ),
      ) ),
    ),
    array(
      'title' => __( 'Margin bottom', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-box-margin-bottom-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-box-margin-bottom-pc'],
        ),
        '--tcdce-box-margin-bottom-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-box-margin-bottom-sp'],
        ),
      ) ),
    ),
  ) );

  // その他プレビューで使用するもの
  $instance->hiddens( $style_name, $style_value, array(
    '--tcdce-box-icon-content',
    '--tcdce-box-icon-offset',
    '--tcdce-box-background',
    '--tcdce-box-border-top',
    '--tcdce-box-border-left',
    '--tcdce-box-border-bottom',
    '--tcdce-box-border-right'
  ) );

  // submit
  $instance->submit();

}, 10, 3 );


// バリデーション
add_filter( 'tcdce_qt_validation_box', function( $value ) {

  $new_value = array(
    'item' => 'box',
    'show' => absint( $value['show'] ),
    'class' => sanitize_text_field( $value['class'] ),
    'label' => sanitize_text_field( $value['label'] ),
    'preset' => sanitize_text_field( $value['preset'] ),
    'box_label' => sanitize_text_field( $value['box_label'] ),
    'style' => array(
      '--tcdce-box-font-size-pc' => absint( $value['style']['--tcdce-box-font-size-pc'] ),
      '--tcdce-box-font-size-sp' => absint( $value['style']['--tcdce-box-font-size-sp'] ),
      '--tcdce-box-font-color' => sanitize_hex_color( $value['style']['--tcdce-box-font-color'] ),
      '--tcdce-box-font-weight' => in_array( $value['style']['--tcdce-box-font-weight'], array( '600', '400' ), true ) ? $value['style']['--tcdce-box-font-weight'] : '600',
      '--tcdce-box-label-color' => sanitize_hex_color( $value['style']['--tcdce-box-label-color'] ),
      '--tcdce-box-icon-content' => sanitize_text_field( $value['style']['--tcdce-box-icon-content'] ),
      '--tcdce-box-icon-offset' => sanitize_text_field( $value['style']['--tcdce-box-icon-offset'] ),
      '--tcdce-box-preset-color--bg' => sanitize_hex_color( $value['style']['--tcdce-box-preset-color--bg'] ),
      '--tcdce-box-preset-color--border' => sanitize_hex_color( $value['style']['--tcdce-box-preset-color--border'] ),
      '--tcdce-box-background' => sanitize_text_field( $value['style']['--tcdce-box-background'] ),
      '--tcdce-box-border-top' => sanitize_text_field( $value['style']['--tcdce-box-border-top'] ),
      '--tcdce-box-border-left' => sanitize_text_field( $value['style']['--tcdce-box-border-left'] ),
      '--tcdce-box-border-bottom' => sanitize_text_field( $value['style']['--tcdce-box-border-bottom'] ),
      '--tcdce-box-border-right' => sanitize_text_field( $value['style']['--tcdce-box-border-right'] ),
      '--tcdce-box-margin-top-pc' => absint( $value['style']['--tcdce-box-margin-top-pc'] ),
      '--tcdce-box-margin-top-sp' => absint( $value['style']['--tcdce-box-margin-top-sp'] ),
      '--tcdce-box-margin-bottom-pc' => absint( $value['style']['--tcdce-box-margin-bottom-pc'] ),
      '--tcdce-box-margin-bottom-sp' => absint( $value['style']['--tcdce-box-margin-bottom-sp'] ),
    )
  );

  return $new_value;

});