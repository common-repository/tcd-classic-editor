<?php

/**
 * heading（h2〜h6）
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$headings = array(
  'h2' => __( 'H2', 'tcd-classic-editor' ),
  'h3' => __( 'H3', 'tcd-classic-editor' ),
  'h4' => __( 'H4', 'tcd-classic-editor' ),
  'h5' => __( 'H5', 'tcd-classic-editor' ),
  'h6' => __( 'H6', 'tcd-classic-editor' )
);

foreach( $headings as $tag => $label ){

  // エディタにクイックタグ登録
  add_filter( 'tcdce_qt_register_' . $tag, function( $value, $quicktag ) use ( $tag, $label ) {
    return array(
      'display' => $quicktag['label'],
      'tagStart' => '<' . $tag . ' class="' . esc_attr( $quicktag['class'] ) . '">',
      'tagEnd' => '</' . $tag . '>'
    );
  }, 10, 2 );

  // データセット
  add_action( 'tcdce_qt_fields_set_properties', function( $instance ) use ( $tag, $label ) {

    // ラベルをセット
    $instance->set_label( $tag, $label );

    // プレビュー情報をセット
    $instance->set_preview(
      $tag,
      '<' . $tag . ' class="tcdce-preview--' . $tag . ' js-tcdce-preview-target">' .
      /* translators: %s: quicktag heading label */
      sprintf( __( 'Sample %s', 'tcd-classic-editor' ), $label ) .
      '</' . $tag . '>'
    );

    switch( $tag ) {

      case 'h2' :
        $font_size_pc = 28;
        $font_size_sp = 22;
        $margin_top_pc = 100;
        $margin_top_sp = 50;
        $margin_bottom_pc = 40;
        $margin_bottom_sp = 20;
        break;

      case 'h3' :
        $font_size_pc = 24;
        $font_size_sp = 20;
        $margin_top_pc = 80;
        $margin_top_sp = 50;
        $margin_bottom_pc = 40;
        $margin_bottom_sp = 20;
        break;

      case 'h4' :
        $font_size_pc = 22;
        $font_size_sp = 18;
        $margin_top_pc = 60;
        $margin_top_sp = 40;
        $margin_bottom_pc = 40;
        $margin_bottom_sp = 20;
        break;

      case 'h5' :
        $font_size_pc = 20;
        $font_size_sp = 16;
        $margin_top_pc = 50;
        $margin_top_sp = 40;
        $margin_bottom_pc = 40;
        $margin_bottom_sp = 20;
        break;

      case 'h6' :
        $font_size_pc = 18;
        $font_size_sp = 16;
        $margin_top_pc = 50;
        $margin_top_sp = 40;
        $margin_bottom_pc = 40;
        $margin_bottom_sp = 20;
        break;

    }

    // 初期値をセット
    $instance->set_default( $tag, array(
      'item' => $tag,
      'show' => 1,
      'class' => 'custom_' . $tag,
      /* translators: %s: quicktag heading label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), $label ),
      'preset' => 'preset01',
      'style' => array(
        '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
        '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
        '--tcdce-' . $tag . '-text-align' => $tag == 'h2' ? 'center' : 'left',
        '--tcdce-' . $tag . '-font-weight' => '600',
        '--tcdce-' . $tag . '-line-height' => '1.5',
        '--tcdce-' . $tag . '-font-color' => '#000000',
        '--tcdce-' . $tag . '-preset-color--bg' => '',
        '--tcdce-' . $tag . '-preset-color--border' => '',
        '--tcdce-' . $tag . '-preset-color--gradation1' => '',
        '--tcdce-' . $tag . '-preset-color--gradation2' => '',
        '--tcdce-' . $tag . '-border-width' => 0,
        '--tcdce-' . $tag . '-padding' => '0px',
        '--tcdce-' . $tag . '-background' => 'transparent',
        '--tcdce-' . $tag . '-border-top' => 'none',
        '--tcdce-' . $tag . '-border-right' => 'none',
        '--tcdce-' . $tag . '-border-bottom' => 'none',
        '--tcdce-' . $tag . '-border-left' => 'none',
        '--tcdce-' . $tag . '-margin-top-pc' => $margin_top_pc,
        '--tcdce-' . $tag . '-margin-top-sp' => $margin_top_sp,
        '--tcdce-' . $tag . '-margin-bottom-pc' => $margin_bottom_pc,
        '--tcdce-' . $tag . '-margin-bottom-sp' => $margin_bottom_sp,
      )
    ) );

    // プリセットデータをセット
    $instance->set_preset( $tag, array(

      'preset01' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 1 ),
        'style' => array(
          '--tcdce$font_size_spfont-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 0,
          '--tcdce-' . $tag . '-padding' => '0px',
          '--tcdce-' . $tag . '-background' => 'transparent',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset02' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 2 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#ffffff',
          '--tcdce-' . $tag . '-preset-color--bg' => '#000000',
          '--tcdce-' . $tag . '-preset-color--border' => '',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 0,
          '--tcdce-' . $tag . '-padding' => '0.75em 1em',
          '--tcdce-' . $tag . '-background' => 'var(--tcdce-' . $tag . '-preset-color--bg)',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset03' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 3 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '#CEE4FD',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '#FFB5F9',
          '--tcdce-' . $tag . '-border-width' => 0,
          '--tcdce-' . $tag . '-padding' => '0.75em 1em',
          '--tcdce-' . $tag . '-background' => 'linear-gradient(90deg, var(--tcdce-' . $tag . '-preset-color--gradation1) 0%, var(--tcdce-' . $tag . '-preset-color--gradation2) 100%);',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset04' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 4 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '400',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '#ffffff',
          '--tcdce-' . $tag . '-preset-color--border' => '#000000',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 1,
          '--tcdce-' . $tag . '-padding' => '0.75em 1em',
          '--tcdce-' . $tag . '-background' => 'var(--tcdce-' . $tag . '-preset-color--bg)',
          '--tcdce-' . $tag . '-border-top' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-right' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-bottom' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-left' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
        )
      ),
      'preset05' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 5 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '#ffffff',
          '--tcdce-' . $tag . '-preset-color--border' => '#000000',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 3,
          '--tcdce-' . $tag . '-padding' => '0.75em 1em',
          '--tcdce-' . $tag . '-background' => 'var(--tcdce-' . $tag . '-preset-color--bg)',
          '--tcdce-' . $tag . '-border-top' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-right' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-bottom' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-left' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
        )
      ),
      'preset06' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 6 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '#000000',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 3,
          '--tcdce-' . $tag . '-padding' => '0.4em 0 0.4em 1em',
          '--tcdce-' . $tag . '-background' => 'transparent',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
        )
      ),
      'preset07' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 7 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '#fafafa',
          '--tcdce-' . $tag . '-preset-color--border' => '#000000',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 3,
          '--tcdce-' . $tag . '-padding' => '0.75em 0 0.75em 1em',
          '--tcdce-' . $tag . '-background' => 'var(--tcdce-' . $tag . '-preset-color--bg)',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
        )
      ),
      'preset08' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 8 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '#FF0000',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '#FFD41D',
          '--tcdce-' . $tag . '-border-width' => 3,
          '--tcdce-' . $tag . '-padding' => '0.4em 0 0.4em 1em',
          '--tcdce-' . $tag . '-background' => 'linear-gradient(180deg, var(--tcdce-' . $tag . '-preset-color--gradation1) 0%, var(--tcdce-' . $tag . '-preset-color--gradation2) 100%) no-repeat left / var(--tcdce-' . $tag . '-border-width) 100%',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset09' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 9 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '400',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#094D9D',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '#094D9D',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 1,
          '--tcdce-' . $tag . '-padding' => '0 0 0.7em',
          '--tcdce-' . $tag . '-background' => 'transparent',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset10' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 10 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#094D9D',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '#094D9D',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 3,
          '--tcdce-' . $tag . '-padding' => '0 0 0.7em',
          '--tcdce-' . $tag . '-background' => 'transparent',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'var(--tcdce-' . $tag . '-border-width) solid var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset11' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 11 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '400',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '#000000',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 1,
          '--tcdce-' . $tag . '-padding' => '0 0 0.7em',
          '--tcdce-' . $tag . '-background' => 'transparent',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'var(--tcdce-' . $tag . '-border-width) dotted var(--tcdce-' . $tag . '-preset-color--border)',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset12' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 12 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '#FF5ACD',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '#FBDA61',
          '--tcdce-' . $tag . '-border-width' => 3,
          '--tcdce-' . $tag . '-padding' => '0 0 0.7em',
          '--tcdce-' . $tag . '-background' => 'linear-gradient(90deg, var(--tcdce-' . $tag . '-preset-color--gradation1) 0%, var(--tcdce-' . $tag . '-preset-color--gradation2) 100%) no-repeat bottom / 100% var(--tcdce-' . $tag . '-border-width)',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset13' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 13 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'center',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '#1556AF',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 0,
          '--tcdce-' . $tag . '-padding' => '0 0 0.75em',
          '--tcdce-' . $tag . '-background' => 'linear-gradient(0deg, var(--tcdce-' . $tag . '-preset-color--border) , var(--tcdce-' . $tag . '-preset-color--border)) no-repeat var(--tcdce-' . $tag . '-text-align) bottom / 3em 0.2em',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),
      'preset14' => array(
        /* translators: %s: preset number */
        'label' => sprintf( __('Preset %s', 'tcd-classic-editor' ), 14 ),
        'style' => array(
          '--tcdce-' . $tag . '-font-size-pc' => $font_size_pc,
          '--tcdce-' . $tag . '-font-size-sp' => $font_size_sp,
          '--tcdce-' . $tag . '-text-align' => 'left',
          '--tcdce-' . $tag . '-font-weight' => '600',
          '--tcdce-' . $tag . '-line-height' => '1.5',
          '--tcdce-' . $tag . '-font-color' => '#000000',
          '--tcdce-' . $tag . '-preset-color--bg' => '',
          '--tcdce-' . $tag . '-preset-color--border' => '#f3b80a',
          '--tcdce-' . $tag . '-preset-color--gradation1' => '',
          '--tcdce-' . $tag . '-preset-color--gradation2' => '',
          '--tcdce-' . $tag . '-border-width' => 0,
          '--tcdce-' . $tag . '-padding' => '0 0 0 2em',
          '--tcdce-' . $tag . '-background' => 'linear-gradient(0deg, var(--tcdce-' . $tag . '-preset-color--border) , var(--tcdce-' . $tag . '-preset-color--border)) no-repeat left calc( 0.5em * var(--tcdce-' . $tag . '-line-height) - 0.075em) / calc(1em * var(--tcdce-' . $tag . '-line-height)) 0.15em',
          '--tcdce-' . $tag . '-border-top' => 'none',
          '--tcdce-' . $tag . '-border-right' => 'none',
          '--tcdce-' . $tag . '-border-bottom' => 'none',
          '--tcdce-' . $tag . '-border-left' => 'none',
        )
      ),

    ) );

  } );


  // 専用フィールド
  add_action( "tcdce_qt_fields_repeater_options_{$tag}", function( $instance, $base_name, $base_value ){

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
  add_action( "tcdce_qt_fields_repeater_preview_options_{$tag}", function( $instance, $name, $value ) use( $tag ) {

    $item_type = $tag;
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
          '--tcdce-' . $item_type . '-font-size-pc' => array(
            'icon' => TCDCE_ICONS['pc'],
            'default' => $default['--tcdce-' . $item_type . '-font-size-pc'],
          ),
          '--tcdce-' . $item_type . '-font-size-sp' => array(
            'icon' => TCDCE_ICONS['sp'],
            'default' => $default['--tcdce-' . $item_type . '-font-size-sp'],
          ),
        ) ),
      ),
      array(
        'title' => __( 'Text align', 'tcd-classic-editor' ),
        'field' => $instance->radio( $style_name, $style_value, '--tcdce-' . $item_type . '-text-align', array(
          'left' => TCDCE_ICONS['left'],
          'center' => TCDCE_ICONS['center'],
          'right' => TCDCE_ICONS['right'],
        ) ),
      ),
      array(
        'title' => __( 'Font weight', 'tcd-classic-editor' ),
        'col' => 2,
        'field' => $instance->radio( $style_name, $style_value, '--tcdce-' . $item_type . '-font-weight', array(
          '400' => TCDCE_ICONS['thick'],
          '600' => TCDCE_ICONS['bold'],
        ) ),
      ),
      array(
        'title' => __( 'Font color', 'tcd-classic-editor' ),
        'col' => 2,
        'field' => $instance->color( $style_name, $style_value, '--tcdce-' . $item_type . '-font-color' )
      ),

      array(
        'title' => __( 'Background color', 'tcd-classic-editor' ),
        'col' => 2,
        'field' => $instance->color( $style_name, $style_value, '--tcdce-' . $item_type . '-preset-color--bg' )
      ),
      array(
        'title' => __( 'Border color', 'tcd-classic-editor' ),
        'col' => 2,
        'field' => $instance->color( $style_name, $style_value, '--tcdce-' . $item_type . '-preset-color--border' )
      ),
      array(
        'title' => __( 'Gradation 1', 'tcd-classic-editor' ),
        'col' => 2,
        'field' => $instance->color( $style_name, $style_value, '--tcdce-' . $item_type . '-preset-color--gradation1' )
      ),
      array(
        'title' => __( 'Gradation 2', 'tcd-classic-editor' ),
        'col' => 2,
        'field' => $instance->color( $style_name, $style_value, '--tcdce-' . $item_type . '-preset-color--gradation2' )
      )

    ) );

    // margin
    $instance->fields( __( 'Margin', 'tcd-classic-editor' ), array(
      array(
        'title' => __( 'Margin top', 'tcd-classic-editor' ),
        'col' => 1,
        'field' => $instance->number( $style_name, $style_value, array(
          '--tcdce-' . $item_type . '-margin-top-pc' => array(
            'icon' => TCDCE_ICONS['pc'],
            'default' => $default['--tcdce-' . $item_type . '-margin-top-pc'],
          ),
          '--tcdce-' . $item_type . '-margin-top-sp' => array(
            'icon' => TCDCE_ICONS['sp'],
            'default' => $default['--tcdce-' . $item_type . '-margin-top-sp'],
          ),
        ) ),
      ),
      array(
        'title' => __( 'Margin bottom', 'tcd-classic-editor' ),
        'col' => 1,
        'field' => $instance->number( $style_name, $style_value, array(
          '--tcdce-' . $item_type . '-margin-bottom-pc' => array(
            'icon' => TCDCE_ICONS['pc'],
            'default' => $default['--tcdce-' . $item_type . '-margin-bottom-pc'],
          ),
          '--tcdce-' . $item_type . '-margin-bottom-sp' => array(
            'icon' => TCDCE_ICONS['sp'],
            'default' => $default['--tcdce-' . $item_type . '-margin-bottom-sp'],
          ),
        ) ),
      ),
    ) );

    // その他プレビューで使用するもの
    $instance->hiddens( $style_name, $style_value, array(
      '--tcdce-' . $item_type . '-line-height',
      '--tcdce-' . $item_type . '-padding',
      '--tcdce-' . $item_type . '-background',
      '--tcdce-' . $item_type . '-border-width',
      '--tcdce-' . $item_type . '-border-top',
      '--tcdce-' . $item_type . '-border-right',
      '--tcdce-' . $item_type . '-border-bottom',
      '--tcdce-' . $item_type . '-border-left',
    ) );

    // submit
    $instance->submit();

  }, 10, 3 );


  // バリデーション
  add_filter( "tcdce_qt_validation_{$tag}", function( $value ) use( $tag ) {

    $new_value = array(
      'item' => $tag,
      'show' => absint( $value['show'] ),
      'class' => sanitize_text_field( $value['class'] ),
      'label' => sanitize_text_field( $value['label'] ),
      'preset' => sanitize_text_field( $value['preset'] ),
      'style' => array(
        '--tcdce-' . $tag . '-font-size-pc' => absint( $value['style']['--tcdce-' . $tag . '-font-size-pc'] ),
        '--tcdce-' . $tag . '-font-size-sp' => absint( $value['style']['--tcdce-' . $tag . '-font-size-sp'] ),
        '--tcdce-' . $tag . '-text-align' => in_array( $value['style']['--tcdce-' . $tag . '-text-align'], array( 'left', 'center', 'right' ), true ) ? $value['style']['--tcdce-' . $tag . '-text-align'] : 'left',
        '--tcdce-' . $tag . '-font-weight' => in_array( $value['style']['--tcdce-' . $tag . '-font-weight'], array( '600', '400' ), true ) ? $value['style']['--tcdce-' . $tag . '-font-weight'] : '600',
        '--tcdce-' . $tag . '-line-height' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-line-height'] ),
        '--tcdce-' . $tag . '-font-color' => sanitize_hex_color( $value['style']['--tcdce-' . $tag . '-font-color'] ),
        '--tcdce-' . $tag . '-preset-color--bg' => sanitize_hex_color( $value['style']['--tcdce-' . $tag . '-preset-color--bg'] ),
        '--tcdce-' . $tag . '-preset-color--border' => sanitize_hex_color( $value['style']['--tcdce-' . $tag . '-preset-color--border'] ),
        '--tcdce-' . $tag . '-preset-color--gradation1' => sanitize_hex_color( $value['style']['--tcdce-' . $tag . '-preset-color--gradation1'] ),
        '--tcdce-' . $tag . '-preset-color--gradation2' => sanitize_hex_color( $value['style']['--tcdce-' . $tag . '-preset-color--gradation2'] ),
        '--tcdce-' . $tag . '-border-width' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-border-width'] ),
        '--tcdce-' . $tag . '-padding' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-padding'] ),
        '--tcdce-' . $tag . '-background' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-background'] ),
        '--tcdce-' . $tag . '-border-top' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-border-top'] ),
        '--tcdce-' . $tag . '-border-right' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-border-right'] ),
        '--tcdce-' . $tag . '-border-bottom' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-border-bottom'] ),
        '--tcdce-' . $tag . '-border-left' => sanitize_text_field( $value['style']['--tcdce-' . $tag . '-border-left'] ),
        '--tcdce-' . $tag . '-margin-top-pc' => absint( $value['style']['--tcdce-' . $tag . '-margin-top-pc'] ),
        '--tcdce-' . $tag . '-margin-top-sp' => absint( $value['style']['--tcdce-' . $tag . '-margin-top-sp'] ),
        '--tcdce-' . $tag . '-margin-bottom-pc' => absint( $value['style']['--tcdce-' . $tag . '-margin-bottom-pc'] ),
        '--tcdce-' . $tag . '-margin-bottom-sp' => absint( $value['style']['--tcdce-' . $tag . '-margin-bottom-sp'] ),
      )
    );

    return $new_value;

  });

}