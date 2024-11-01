<?php

/**
 * クイックタグ設定 ul
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// エディタにクイックタグ登録
add_filter( 'tcdce_qt_register_ul', function( $value, $quicktag ) {
  return array(
    'display' => $quicktag['label'],
    'tag' => '<ul class="' . esc_attr( $quicktag['class'] ) . '">' . "\n" .
              str_repeat( "\t" . '<li>' . __( 'Unordered list', 'tcd-classic-editor' ) . '</li>' . "\n", 3 ) .
              '</ul>'
  );
}, 10, 2 );


// データセット
add_action( 'tcdce_qt_fields_set_properties', function( $instance ) {

  // ラベルをセット
  $instance->set_label( 'ul', __( 'Unordered list', 'tcd-classic-editor' ) );

  // プレビュー情報をセット
  $instance->set_preview(
    'ul',
    '<ul class="tcdce-preview--ul js-tcdce-preview-target">' .
    /* translators: %s: quicktag ul label */
    str_repeat( '<li>' . sprintf( __( 'Sample %s', 'tcd-classic-editor' ), $instance->get_label( 'ul' ) ) . '</li>', 3 ) .
    '</ul>',
  );

  // 初期値をセット
  $instance->set_default( 'ul', array(
    'item' => 'ul',
    'show' => 1,
    'class' => 'custom_ul',
    /* translators: %s: quicktag ul label */
    'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), $instance->get_label( 'ul' ) ),
    'preset' => 'preset01',
    'style' => array(
      '--tcdce-ul-font-size-pc' => 16,
      '--tcdce-ul-font-size-sp' => 14,
      '--tcdce-ul-font-color' => '#000000',
      '--tcdce-ul-list-style' => 'outside disc',
      '--tcdce-ul-marker-content' => 'none',
      '--tcdce-ul-marker-color' => '#000000',
      '--tcdce-ul-marker-offset' => '0',
      '--tcdce-ul-preset-color--bg' => '',
      '--tcdce-ul-preset-color--border' => '',
      '--tcdce-ul-padding' => '0 0 0 1em',
      '--tcdce-ul-child-offset' => '0 0 0 1em',
      '--tcdce-ul-background' => 'transparent',
      '--tcdce-ul-border-top' => 'none',
      '--tcdce-ul-border-left' => 'none',
      '--tcdce-ul-border-bottom' => 'none',
      '--tcdce-ul-border-right' => 'none',
      '--tcdce-ul-margin-top-pc' => 40,
      '--tcdce-ul-margin-top-sp' => 20,
      '--tcdce-ul-margin-bottom-pc' => 40,
      '--tcdce-ul-margin-bottom-sp' => 20,
    )
  ) );

  // プリセットデータをセット
  $instance->set_preset( 'ul', array(

    'preset01' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 1 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'outside disc',
        '--tcdce-ul-marker-content' => 'none',
        '--tcdce-ul-marker-offset' => '0',
        '--tcdce-ul-marker-color' => '#000000',
        '--tcdce-ul-padding' => '0 0 0 1em',
        '--tcdce-ul-child-offset' => '1em',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset02' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 2 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'outside disc',
        '--tcdce-ul-marker-content' => 'none',
        '--tcdce-ul-marker-offset' => '0',
        '--tcdce-ul-marker-color' => '#000000',
        '--tcdce-ul-padding' => '1em 1em 1em 2.5em',
        '--tcdce-ul-child-offset' => '1em',
        '--tcdce-ul-preset-color--bg' => '#f6f6f6',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'var(--tcdce-ul-preset-color--bg)',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset03' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 3 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'outside disc',
        '--tcdce-ul-marker-content' => 'none',
        '--tcdce-ul-marker-offset' => '0',
        '--tcdce-ul-marker-color' => '#000000',
        '--tcdce-ul-padding' => '1em 1em 1em 2.5em',
        '--tcdce-ul-child-offset' => '1em',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '#000000',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-left' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-bottom' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-right' => '1px solid var(--tcdce-ul-preset-color--border)',
      )
    ),
    'preset04' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 4 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e902\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#0085E6',
        '--tcdce-ul-padding' => '0',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset05' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 5 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e902\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#0085E6',
        '--tcdce-ul-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '#e9f2fd',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'var(--tcdce-ul-preset-color--bg)',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset06' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 6 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e902\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#0085E6',
        '--tcdce-ul-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '#0085E6',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-left' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-bottom' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-right' => '1px solid var(--tcdce-ul-preset-color--border)',
      )
    ),
    'preset07' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 7 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e900\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#3BC100',
        '--tcdce-ul-padding' => '0',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset08' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 8 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e900\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#3BC100',
        '--tcdce-ul-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '#edf8ea',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'var(--tcdce-ul-preset-color--bg)',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset09' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 9 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e900\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#3BC100',
        '--tcdce-ul-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '#3BC100',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-left' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-bottom' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-right' => '1px solid var(--tcdce-ul-preset-color--border)',
      )
    ),
    'preset10' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 10 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e901\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#FF0000',
        '--tcdce-ul-padding' => '0',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset11' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 11 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e901\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#FF0000',
        '--tcdce-ul-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '#ffe9e9',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-background' => 'var(--tcdce-ul-preset-color--bg)',
        '--tcdce-ul-border-top' => 'none',
        '--tcdce-ul-border-left' => 'none',
        '--tcdce-ul-border-bottom' => 'none',
        '--tcdce-ul-border-right' => 'none',
      )
    ),
    'preset12' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 12 ),
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e901\'',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-marker-color' => '#FF0000',
        '--tcdce-ul-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ul-child-offset' => '0',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '#FF0000',
        '--tcdce-ul-background' => 'transparent',
        '--tcdce-ul-border-top' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-left' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-bottom' => '1px solid var(--tcdce-ul-preset-color--border)',
        '--tcdce-ul-border-right' => '1px solid var(--tcdce-ul-preset-color--border)',
      )
    )

  ) );

} );


// 専用フィールド
add_action( 'tcdce_qt_fields_repeater_options_ul', function( $instance, $base_name, $base_value ){

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
add_action( 'tcdce_qt_fields_repeater_preview_options_ul', function( $instance, $name, $value ) {

  $item_type = 'ul';
  $default = $instance->default['ul']['style'];
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
        '--tcdce-ul-font-size-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-ul-font-size-pc'],
        ),
        '--tcdce-ul-font-size-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-ul-font-size-sp'],
        ),
      ) ),
    ),
    array(
      'title' => __( 'Marker color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ul-marker-color' )
    ),
    array(
      'title' => __( 'Font color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ul-font-color' )
    ),
    array(
      'title' => __( 'Background color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ul-preset-color--bg' )
    ),
    array(
      'title' => __( 'Border color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ul-preset-color--border' )
    ),
  ) );

  // margin
  $instance->fields( __( 'Margin', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Margin top', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-ul-margin-top-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-ul-margin-top-pc'],
        ),
        '--tcdce-ul-margin-top-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-ul-margin-top-sp'],
        ),
      ) ),
    ),
    array(
      'title' => __( 'Margin bottom', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-ul-margin-bottom-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-ul-margin-bottom-pc'],
        ),
        '--tcdce-ul-margin-bottom-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-ul-margin-bottom-sp'],
        ),
      ) ),
    ),
  ) );

  // その他プレビューで使用するもの
  $instance->hiddens( $style_name, $style_value, array(
    '--tcdce-ul-list-style',
    '--tcdce-ul-marker-content',
    '--tcdce-ul-marker-offset',
    '--tcdce-ul-padding',
    '--tcdce-ul-child-offset',
    '--tcdce-ul-background',
    '--tcdce-ul-border-top',
    '--tcdce-ul-border-left',
    '--tcdce-ul-border-bottom',
    '--tcdce-ul-border-right'
  ) );

  // submit
  $instance->submit();

}, 10, 3 );



// バリデーション
add_filter( 'tcdce_qt_validation_ul', function( $value ) {

  $new_value = array(
    'item' => 'ul',
    'show' => absint( $value['show'] ),
    'class' => sanitize_text_field( $value['class'] ),
    'label' => sanitize_text_field( $value['label'] ),
    'preset' => sanitize_text_field( $value['preset'] ),
    'style' => array(
      '--tcdce-ul-font-size-pc' => absint( $value['style']['--tcdce-ul-font-size-pc'] ),
      '--tcdce-ul-font-size-sp' => absint( $value['style']['--tcdce-ul-font-size-sp'] ),
      '--tcdce-ul-font-color' => sanitize_hex_color( $value['style']['--tcdce-ul-font-color'] ),
      '--tcdce-ul-list-style' => sanitize_text_field( $value['style']['--tcdce-ul-list-style'] ),
      '--tcdce-ul-marker-content' => sanitize_text_field( $value['style']['--tcdce-ul-marker-content'] ),
      '--tcdce-ul-marker-color' => sanitize_hex_color( $value['style']['--tcdce-ul-marker-color'] ),
      '--tcdce-ul-marker-offset' => sanitize_text_field( $value['style']['--tcdce-ul-marker-offset'] ),
      '--tcdce-ul-preset-color--bg' => sanitize_hex_color( $value['style']['--tcdce-ul-preset-color--bg'] ),
      '--tcdce-ul-preset-color--border' => sanitize_hex_color( $value['style']['--tcdce-ul-preset-color--border'] ),
      '--tcdce-ul-padding' => sanitize_text_field( $value['style']['--tcdce-ul-padding'] ),
      '--tcdce-ul-child-offset' => sanitize_text_field( $value['style']['--tcdce-ul-child-offset'] ),
      '--tcdce-ul-background' => sanitize_text_field( $value['style']['--tcdce-ul-background'] ),
      '--tcdce-ul-border-top' => sanitize_text_field( $value['style']['--tcdce-ul-border-top'] ),
      '--tcdce-ul-border-left' => sanitize_text_field( $value['style']['--tcdce-ul-border-left'] ),
      '--tcdce-ul-border-bottom' => sanitize_text_field( $value['style']['--tcdce-ul-border-bottom'] ),
      '--tcdce-ul-border-right' => sanitize_text_field( $value['style']['--tcdce-ul-border-right'] ),
      '--tcdce-ul-margin-top-pc' => absint( $value['style']['--tcdce-ul-margin-top-pc'] ),
      '--tcdce-ul-margin-top-sp' => absint( $value['style']['--tcdce-ul-margin-top-sp'] ),
      '--tcdce-ul-margin-bottom-pc' => absint( $value['style']['--tcdce-ul-margin-bottom-pc'] ),
      '--tcdce-ul-margin-bottom-sp' => absint( $value['style']['--tcdce-ul-margin-bottom-sp'] ),
    )
  );

  return $new_value;

});