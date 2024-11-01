<?php

/**
 * クイックタグ設定 ol
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// エディタにクイックタグ登録
add_filter( 'tcdce_qt_register_ol', function( $value, $quicktag ) {
  return array(
    'display' => $quicktag['label'],
    'tag' => '<ol class="' . esc_attr( $quicktag['class'] ) . '">' . "\n" .
              str_repeat( "\t" . '<li>' . __( 'Ordered list', 'tcd-classic-editor' ) . '</li>' . "\n", 3 ) .
              '</ol>',
  );
}, 10, 2 );


// データセット
add_action( 'tcdce_qt_fields_set_properties', function( $instance ) {

  // ラベルをセット
  $instance->set_label( 'ol', __( 'Ordered list', 'tcd-classic-editor' ) );

  // プレビュー情報をセット
  $instance->set_preview(
    'ol',
    '<ol class="tcdce-preview--ol js-tcdce-preview-target">' .
    /* translators: %s: quicktag ol label */
    str_repeat( '<li>' . sprintf( __( 'Sample %s', 'tcd-classic-editor' ), $instance->get_label( 'ol' ) ) . '</li>', 3 ) .
    '</ol>',
  );

  // 初期値をセット
  $instance->set_default( 'ol', array(
    'item' => 'ol',
    'show' => 1,
    'class' => 'custom_ol',
    /* translators: %s: quicktag ol label */
    'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), $instance->get_label( 'ol' ) ),
    'preset' => 'preset01',
    'style' => array(
      '--tcdce-ol-font-size-pc' => 16,
      '--tcdce-ol-font-size-sp' => 14,
      '--tcdce-ol-font-color' => '#000000',
      '--tcdce-ol-list-style' => 'outside decimal',
      '--tcdce-ol-marker-content' => 'none',
      '--tcdce-ol-marker-color' => '#000000',
      '--tcdce-ol-marker-offset' => '0',
      '--tcdce-ol-marker-radius' => '0',
      '--tcdce-ol-padding' => '0 0 0 1em',
      '--tcdce-ol-child-offset' => '1em',
      '--tcdce-ol-preset-color--bg' => '',
      '--tcdce-ol-preset-color--border' => '',
      '--tcdce-ol-background' => 'transparent',
      '--tcdce-ol-border-top' => 'none',
      '--tcdce-ol-border-left' => 'none',
      '--tcdce-ol-border-bottom' => 'none',
      '--tcdce-ol-border-right' => 'none',
      '--tcdce-ol-margin-top-pc' => 40,
      '--tcdce-ol-margin-top-sp' => 20,
      '--tcdce-ol-margin-bottom-pc' => 40,
      '--tcdce-ol-margin-bottom-sp' => 20,
    )
  ) );

  // プリセットデータをセット
  $instance->set_preset( 'ol', array(

    'preset01' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 1 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'outside decimal',
        '--tcdce-ol-marker-content' => 'none',
        '--tcdce-ol-marker-offset' => '0',
        '--tcdce-ol-marker-color' => '#000000',
        '--tcdce-ol-marker-radius' => '0',
        '--tcdce-ol-padding' => '0 0 0 1.2em',
        '--tcdce-ol-child-offset' => '1em',
        '--tcdce-ol-preset-color--bg' => '',
        '--tcdce-ol-preset-color--border' => '',
        '--tcdce-ol-background' => 'transparent',
        '--tcdce-ol-border-top' => 'none',
        '--tcdce-ol-border-left' => 'none',
        '--tcdce-ol-border-bottom' => 'none',
        '--tcdce-ol-border-right' => 'none',
      )
    ),
    'preset02' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 2 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'outside decimal',
        '--tcdce-ol-marker-content' => 'none',
        '--tcdce-ol-marker-offset' => '0',
        '--tcdce-ol-marker-color' => '#000000',
        '--tcdce-ol-marker-radius' => '0',
        '--tcdce-ol-padding' => '1em 1em 1em 2.7em',
        '--tcdce-ol-child-offset' => '1em',
        '--tcdce-ol-preset-color--bg' => '#f6f6f6',
        '--tcdce-ol-preset-color--border' => '',
        '--tcdce-ol-background' => 'var(--tcdce-ol-preset-color--bg)',
        '--tcdce-ol-border-top' => 'none',
        '--tcdce-ol-border-left' => 'none',
        '--tcdce-ol-border-bottom' => 'none',
        '--tcdce-ol-border-right' => 'none',
      )
    ),
    'preset03' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 3 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'outside decimal',
        '--tcdce-ol-marker-content' => 'none',
        '--tcdce-ol-marker-offset' => '0',
        '--tcdce-ol-marker-color' => '#000000',
        '--tcdce-ol-marker-radius' => '0',
        '--tcdce-ol-padding' => '1em 1em 1em 2.7em',
        '--tcdce-ol-child-offset' => '1em',
        '--tcdce-ol-preset-color--bg' => '',
        '--tcdce-ol-preset-color--border' => '#000000',
        '--tcdce-ol-background' => 'transparent',
        '--tcdce-ol-border-top' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-left' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-bottom' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-right' => '1px solid var(--tcdce-ol-preset-color--border)',
      )
    ),
    'preset04' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 4 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-offset' => '2.2em',
        '--tcdce-ol-marker-color' => '#118FC7',
        '--tcdce-ol-marker-radius' => '50%',
        '--tcdce-ol-padding' => '0',
        '--tcdce-ol-child-offset' => '0',
        '--tcdce-ol-preset-color--bg' => '',
        '--tcdce-ol-preset-color--border' => '',
        '--tcdce-ol-background' => 'transparent',
        '--tcdce-ol-border-top' => 'none',
        '--tcdce-ol-border-left' => 'none',
        '--tcdce-ol-border-bottom' => 'none',
        '--tcdce-ol-border-right' => 'none',
      )
    ),
    'preset05' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 5 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-offset' => '2.2em',
        '--tcdce-ol-marker-color' => '#118FC7',
        '--tcdce-ol-marker-radius' => '50%',
        '--tcdce-ol-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ol-child-offset' => '0',
        '--tcdce-ol-preset-color--bg' => '#eaf3fa',
        '--tcdce-ol-preset-color--border' => '',
        '--tcdce-ol-background' => 'var(--tcdce-ol-preset-color--bg)',
        '--tcdce-ol-border-top' => 'none',
        '--tcdce-ol-border-left' => 'none',
        '--tcdce-ol-border-bottom' => 'none',
        '--tcdce-ol-border-right' => 'none',
      )
    ),
    'preset06' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 6 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-offset' => '2.2em',
        '--tcdce-ol-marker-color' => '#118FC7',
        '--tcdce-ol-marker-radius' => '50%',
        '--tcdce-ol-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ol-child-offset' => '0',
        '--tcdce-ol-preset-color--bg' => '',
        '--tcdce-ol-preset-color--border' => '#118FC7',
        '--tcdce-ol-background' => 'transparent',
        '--tcdce-ol-border-top' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-left' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-bottom' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-right' => '1px solid var(--tcdce-ol-preset-color--border)',
      )
    ),
    'preset07' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 7 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-offset' => '2.2em',
        '--tcdce-ol-marker-color' => '#673202',
        '--tcdce-ol-marker-radius' => '0',
        '--tcdce-ol-padding' => '0',
        '--tcdce-ol-child-offset' => '0',
        '--tcdce-ol-preset-color--bg' => '',
        '--tcdce-ol-preset-color--border' => '',
        '--tcdce-ol-background' => 'transparent',
        '--tcdce-ol-border-top' => 'none',
        '--tcdce-ol-border-left' => 'none',
        '--tcdce-ol-border-bottom' => 'none',
        '--tcdce-ol-border-right' => 'none',
      )
    ),
    'preset08' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 8 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-offset' => '2.2em',
        '--tcdce-ol-marker-color' => '#673202',
        '--tcdce-ol-marker-radius' => '0',
        '--tcdce-ol-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ol-child-offset' => '0',
        '--tcdce-ol-preset-color--bg' => '#f0eae7',
        '--tcdce-ol-preset-color--border' => '',
        '--tcdce-ol-background' => 'var(--tcdce-ol-preset-color--bg)',
        '--tcdce-ol-border-top' => 'none',
        '--tcdce-ol-border-left' => 'none',
        '--tcdce-ol-border-bottom' => 'none',
        '--tcdce-ol-border-right' => 'none',
      )
    ),
    'preset09' => array(
      /* translators: %s: preset number */
      'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 9 ),
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-offset' => '2.2em',
        '--tcdce-ol-marker-color' => '#673202',
        '--tcdce-ol-marker-radius' => '0',
        '--tcdce-ol-padding' => '1em 1em 1em 1.5em',
        '--tcdce-ol-child-offset' => '0',
        '--tcdce-ol-preset-color--bg' => '',
        '--tcdce-ol-preset-color--border' => '#673202',
        '--tcdce-ol-background' => 'transparent',
        '--tcdce-ol-border-top' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-left' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-bottom' => '1px solid var(--tcdce-ol-preset-color--border)',
        '--tcdce-ol-border-right' => '1px solid var(--tcdce-ol-preset-color--border)',
      )
    )

  ) );

} );


// 専用フィールド
add_action( 'tcdce_qt_fields_repeater_options_ol', function( $instance, $base_name, $base_value ){

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
add_action( 'tcdce_qt_fields_repeater_preview_options_ol', function( $instance, $name, $value ) {

  $item_type = 'ol';
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
        '--tcdce-ol-font-size-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-ol-font-size-pc'],
        ),
        '--tcdce-ol-font-size-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-ol-font-size-sp'],
        ),
      ) ),
    ),
    array(
      'title' => __( 'Marker color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ol-marker-color' )
    ),
    array(
      'title' => __( 'Font color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ol-font-color' )
    ),
    array(
      'title' => __( 'Background color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ol-preset-color--bg' )
    ),
    array(
      'title' => __( 'Border color', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->color( $style_name, $style_value, '--tcdce-ol-preset-color--border' )
    ),
  ) );

  // margin
  $instance->fields( __( 'Margin', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Margin top', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-ol-margin-top-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-ol-margin-top-pc'],
        ),
        '--tcdce-ol-margin-top-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-ol-margin-top-sp'],
        ),
      ) ),
    ),
    array(
      'title' => __( 'Margin bottom', 'tcd-classic-editor' ),
      'field' => $instance->number( $style_name, $style_value, array(
        '--tcdce-ol-margin-bottom-pc' => array(
          'icon' => TCDCE_ICONS['pc'],
          'default' => $default['--tcdce-ol-margin-bottom-pc'],
        ),
        '--tcdce-ol-margin-bottom-sp' => array(
          'icon' => TCDCE_ICONS['sp'],
          'default' => $default['--tcdce-ol-margin-bottom-sp'],
        ),
      ) ),
    ),
  ) );

  // その他プレビューで使用するもの
  $instance->hiddens( $style_name, $style_value, array(
    '--tcdce-ol-list-style',
    '--tcdce-ol-marker-content',
    '--tcdce-ol-marker-offset',
    '--tcdce-ol-marker-radius',
    '--tcdce-ol-padding',
    '--tcdce-ol-child-offset',
    '--tcdce-ol-background',
    '--tcdce-ol-border-top',
    '--tcdce-ol-border-left',
    '--tcdce-ol-border-bottom',
    '--tcdce-ol-border-right'
  ) );

  // submit
  $instance->submit();

}, 10, 3 );



// バリデーション
add_filter( 'tcdce_qt_validation_ol', function( $value ) {

  $new_value = array(
    'item' => 'ol',
    'show' => absint( $value['show'] ),
    'class' => sanitize_text_field( $value['class'] ),
    'label' => sanitize_text_field( $value['label'] ),
    'preset' => sanitize_text_field( $value['preset'] ),
    'style' => array(
      '--tcdce-ol-font-size-pc' => absint( $value['style']['--tcdce-ol-font-size-pc'] ),
      '--tcdce-ol-font-size-sp' => absint( $value['style']['--tcdce-ol-font-size-sp'] ),
      '--tcdce-ol-font-color' => sanitize_hex_color( $value['style']['--tcdce-ol-font-color'] ),
      '--tcdce-ol-list-style' => sanitize_text_field( $value['style']['--tcdce-ol-list-style'] ),
      '--tcdce-ol-marker-content' => sanitize_text_field( $value['style']['--tcdce-ol-marker-content'] ),
      '--tcdce-ol-marker-color' => sanitize_hex_color( $value['style']['--tcdce-ol-marker-color'] ),
      '--tcdce-ol-marker-offset' => sanitize_text_field( $value['style']['--tcdce-ol-marker-offset'] ),
      '--tcdce-ol-preset-color--bg' => sanitize_hex_color( $value['style']['--tcdce-ol-preset-color--bg'] ),
      '--tcdce-ol-preset-color--border' => sanitize_hex_color( $value['style']['--tcdce-ol-preset-color--border'] ),
      '--tcdce-ol-marker-radius' => sanitize_text_field( $value['style']['--tcdce-ol-marker-radius'] ),
      '--tcdce-ol-padding' => sanitize_text_field( $value['style']['--tcdce-ol-padding'] ),
      '--tcdce-ol-child-offset' => sanitize_text_field( $value['style']['--tcdce-ol-child-offset'] ),
      '--tcdce-ol-background' => sanitize_text_field( $value['style']['--tcdce-ol-background'] ),
      '--tcdce-ol-border-top' => sanitize_text_field( $value['style']['--tcdce-ol-border-top'] ),
      '--tcdce-ol-border-left' => sanitize_text_field( $value['style']['--tcdce-ol-border-left'] ),
      '--tcdce-ol-border-bottom' => sanitize_text_field( $value['style']['--tcdce-ol-border-bottom'] ),
      '--tcdce-ol-border-right' => sanitize_text_field( $value['style']['--tcdce-ol-border-right'] ),
      '--tcdce-ol-margin-top-pc' => absint( $value['style']['--tcdce-ol-margin-top-pc'] ),
      '--tcdce-ol-margin-top-sp' => absint( $value['style']['--tcdce-ol-margin-top-sp'] ),
      '--tcdce-ol-margin-bottom-pc' => absint( $value['style']['--tcdce-ol-margin-bottom-pc'] ),
      '--tcdce-ol-margin-bottom-sp' => absint( $value['style']['--tcdce-ol-margin-bottom-sp'] ),
    )
  );

  return $new_value;

});