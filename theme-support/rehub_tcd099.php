<?php

/**
 * REHUB support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Default Quicktag Setting
 */
add_filter( 'tcdce_quicktag_setting_default', function( $default ){

  if( ! function_exists( 'get_design_plus_option' ) ){
    return $default;
  }

  $dp_options = get_design_plus_option();

  $main_color = $dp_options['main_color'] ?? '#000000';

  return array(

    // h2
    100 => array(
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
    101 => array(
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
    102 => array(
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
    // h5
    103 => array(
      'item' => 'h5',
      'show' => 1,
      'class' => 'styled_h5',
      /* translators: %s: quicktag heading label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'H5', 'tcd-classic-editor' ) ),
      'preset' => 'preset02',
      'style' => array(
        '--tcdce-h5-font-size-pc' => 18,
        '--tcdce-h5-font-size-sp' => 16,
        '--tcdce-h5-text-align' => 'left',
        '--tcdce-h5-font-weight' => '400',
        '--tcdce-h5-line-height' => '1.5',
        '--tcdce-h5-font-color' => '#000000',
        '--tcdce-h5-preset-color--bg' => '#f6f6f6',
        '--tcdce-h5-preset-color--border' => '',
        '--tcdce-h5-preset-color--gradation1' => '',
        '--tcdce-h5-preset-color--gradation2' => '',
        '--tcdce-h5-border-width' => '0px',
        '--tcdce-h5-padding' => '0.75em 1em',
        '--tcdce-h5-background' => 'var(--tcdce-h5-preset-color--bg)',
        '--tcdce-h5-border-top' => 'none',
        '--tcdce-h5-border-right' => 'none',
        '--tcdce-h5-border-bottom' => 'none',
        '--tcdce-h5-border-left' => 'none',
        '--tcdce-h5-margin-top-pc' => 50,
        '--tcdce-h5-margin-top-sp' => 40,
        '--tcdce-h5-margin-bottom-pc' => 40,
        '--tcdce-h5-margin-bottom-sp' => 20,
      )
    ),
    // ul
    104 => array(
      'item' => 'ul',
      'show' => 1,
      'class' => 'q_styled_ul',
      /* translators: %s: quicktag ul label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Unordered list', 'tcd-classic-editor' ) ),
      'preset' => 'preset04',
      'style' => array(
        '--tcdce-ul-font-size-pc' => 16,
        '--tcdce-ul-font-size-sp' => 14,
        '--tcdce-ul-font-color' => '#000000',
        '--tcdce-ul-list-style' => 'none',
        '--tcdce-ul-marker-content' => '\'\e902\'',
        '--tcdce-ul-marker-color' => '#000000',
        '--tcdce-ul-marker-offset' => '1.5em',
        '--tcdce-ul-preset-color--bg' => '',
        '--tcdce-ul-preset-color--border' => '',
        '--tcdce-ul-padding' => '0',
        '--tcdce-ul-child-offset' => '0',
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
    ),
    // ol
    105 => array(
      'item' => 'ol',
      'show' => 1,
      'class' => 'q_styled_ol',
      /* translators: %s: quicktag ol label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Ordered list', 'tcd-classic-editor' ) ),
      'preset' => 'preset04',
      'style' => array(
        '--tcdce-ol-font-size-pc' => 16,
        '--tcdce-ol-font-size-sp' => 14,
        '--tcdce-ol-font-color' => '#000000',
        '--tcdce-ol-list-style' => 'none',
        '--tcdce-ol-marker-content' => 'counter(item)',
        '--tcdce-ol-marker-color' => $main_color,
        '--tcdce-ol-marker-offset' => '2.2em',
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
        '--tcdce-ol-margin-top-pc' => 40,
        '--tcdce-ol-margin-top-sp' => 20,
        '--tcdce-ol-margin-bottom-pc' => 40,
        '--tcdce-ol-margin-bottom-sp' => 20,
      )
    ),
    // box1
    106 => array(
      'item' => 'box',
      'show' => 1,
      'class' => 'q_frame1',
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
    107 => array(
      'item' => 'box',
      'show' => 1,
      'class' => 'q_frame2',
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
    108 => array(
      'item' => 'box',
      'show' => 1,
      'class' => 'q_frame3',
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
    // marker1
    109 => array(
      'item' => 'marker',
      'show' => 1,
      'class' => 'q_underline1',
      /* translators: %s: quicktag marker label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Marker', 'tcd-classic-editor' ) . 1 ),
      'preset' => 'preset04',
      'style' => array(
        '--tcdce-marker-font-weight' => '400',
        '--tcdce-marker-color' => '#fff799',
        '--tcdce-marker-weight' => '0.8em',
        '--tcdce-marker-animation' => 'none',
      )
    ),
    // marker2
    110 => array(
      'item' => 'marker',
      'show' => 1,
      'class' => 'q_underline2',
      /* translators: %s: quicktag marker label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Marker', 'tcd-classic-editor' ) . 2 ),
      'preset' => 'preset05',
      'style' => array(
        '--tcdce-marker-font-weight' => '400',
        '--tcdce-marker-color' => '#97c0f3',
        '--tcdce-marker-weight' => '0.8em',
        '--tcdce-marker-animation' => 'none',
      )
    ),
    // marker3
    111 => array(
      'item' => 'marker',
      'show' => 1,
      'class' => 'q_underline3',
      /* translators: %s: quicktag marker label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Marker', 'tcd-classic-editor' ) . 3 ),
      'preset' => 'preset06',
      'style' => array(
        '--tcdce-marker-font-weight' => '400',
        '--tcdce-marker-color' => '#ffbe8f',
        '--tcdce-marker-weight' => '0.8em',
        '--tcdce-marker-animation' => 'none',
      )
    ),
    // button1
    112 => array(
      'item' => 'button',
      'show' => 1,
      'class' => 'q_custom_button1',
      /* translators: %s: quicktag button label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Button', 'tcd-classic-editor' ) . 1 ),
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
    // button2
    113 => array(
      'item' => 'button',
      'show' => 1,
      'class' => 'q_custom_button2',
      /* translators: %s: quicktag button label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Button', 'tcd-classic-editor' ) . 2 ),
      'preset' => 'preset03',
      'style' => array(
        '--tcdce-button-font-size-pc' => 16,
        '--tcdce-button-font-size-sp' => 14,
        '--tcdce-button-font-weight' => '400',
        '--tcdce-button-shape' => 'var(--tcdce-button-shape--round)',
        '--tcdce-button-size-width-pc' => 270,
        '--tcdce-button-size-width-sp' => 220,
        '--tcdce-button-size-height-pc' => 60,
        '--tcdce-button-size-height-sp' => 50,
        '--tcdce-button-preset-color--a' => '#E6E5E5',
        '--tcdce-button-preset-color--b' => $main_color,
        '--tcdce-button-preset-color--gradation--a' => '',
        '--tcdce-button-preset-color--gradation--b' => '',
        '--tcdce-button-font-color' => '#000000',
        '--tcdce-button-font-color-hover' => '#ffffff',
        '--tcdce-button-background' => 'var(--tcdce-button-preset-color--a)',
        '--tcdce-button-background-hover' => 'var(--tcdce-button-preset-color--b)',
        '--tcdce-button-border' => 'none',
        '--tcdce-button-border-hover' => 'none',
        '--tcdce-button-transform' => 'none',
        '--tcdce-button-transform-hover' => 'none',
        '--tcdce-button-overlay' => 'none',
        '--tcdce-button-margin-top-pc' => 40,
        '--tcdce-button-margin-top-sp' => 20,
        '--tcdce-button-margin-bottom-pc' => 40,
        '--tcdce-button-margin-bottom-sp' => 20,
      )
    ),
    // button3
    114 => array(
      'item' => 'button',
      'show' => 1,
      'class' => 'q_custom_button3',
      /* translators: %s: quicktag button label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Button', 'tcd-classic-editor' ) . 3 ),
      'preset' => 'preset05',
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
        '--tcdce-button-preset-color--b' => $main_color,
        '--tcdce-button-preset-color--gradation--a' => '',
        '--tcdce-button-preset-color--gradation--b' => '',
        '--tcdce-button-font-color' => 'var(--tcdce-button-preset-color--a)',
        '--tcdce-button-font-color-hover' => '#ffffff',
        '--tcdce-button-background' => 'transparent',
        '--tcdce-button-background-hover' => 'var(--tcdce-button-preset-color--b)',
        '--tcdce-button-border' => '1px solid var(--tcdce-button-preset-color--a)',
        '--tcdce-button-border-hover' => '1px solid var(--tcdce-button-preset-color--b)',
        '--tcdce-button-transform' => 'none',
        '--tcdce-button-transform-hover' => 'none',
        '--tcdce-button-overlay' => 'none',
        '--tcdce-button-margin-top-pc' => 40,
        '--tcdce-button-margin-top-sp' => 20,
        '--tcdce-button-margin-bottom-pc' => 40,
        '--tcdce-button-margin-bottom-sp' => 20,
      )
    ),
    // sb1
    115 => array(
      'item' => 'sb',
      'show' => 1,
      'class' => 'tcdce-sb[data-key="115"]',
      /* translators: %s: quicktag speech bubble label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Speech bubble', 'tcd-classic-editor' ) . 1 ),
      'preset' => 'preset05',
      'user_name' => __( 'User name', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-sb-font-size-pc' => 16,
        '--tcdce-sb-font-size-sp' => 14,
        '--tcdce-sb-font-weight' => '400',
        '--tcdce-sb-font-color' => '#000000',
        '--tcdce-sb-image-url' => '',
        '--tcdce-sb-preset-color--bg' => '#ffffff',
        '--tcdce-sb-preset-color--border' => '#000000',
        '--tcdce-sb-background' => 'var(--tcdce-sb-preset-color--bg)',
        '--tcdce-sb-border-color' => 'var(--tcdce-sb-preset-color--border)',
        '--tcdce-sb-padding' => '1em 1.5em',
        '--tcdce-sb-direction' => 'row',
        '--tcdce-sb-triangle-before-offset' => '-10px',
        '--tcdce-sb-triangle-after-offset' => '-7px',
        '--tcdce-sb-triangle-path' => 'polygon(100% 0, 0 50%, 100% 100%)',
        '--tcdce-sb-margin-top-pc' => 40,
        '--tcdce-sb-margin-top-sp' => 20,
        '--tcdce-sb-margin-bottom-pc' => 40,
        '--tcdce-sb-margin-bottom-sp' => 20,
      )
    ),
    // sb2
    116 => array(
      'item' => 'sb',
      'show' => 1,
      'class' => 'tcdce-sb[data-key="116"]',
      /* translators: %s: quicktag speech bubble label */
      'label' => sprintf( __( 'Custom %s', 'tcd-classic-editor' ), __( 'Speech bubble', 'tcd-classic-editor' ) . 2 ),
      'preset' => 'preset06',
      'user_name' => __( 'User name', 'tcd-classic-editor' ),
      'style' => array(
        '--tcdce-sb-font-size-pc' => 16,
        '--tcdce-sb-font-size-sp' => 14,
        '--tcdce-sb-font-weight' => '400',
        '--tcdce-sb-font-color' => '#000000',
        '--tcdce-sb-image-url' => '',
        '--tcdce-sb-preset-color--bg' => '#ffffff',
        '--tcdce-sb-preset-color--border' => '#000000',
        '--tcdce-sb-background' => 'var(--tcdce-sb-preset-color--bg)',
        '--tcdce-sb-border-color' => 'var(--tcdce-sb-preset-color--border)',
        '--tcdce-sb-padding' => '1em 1.5em',
        '--tcdce-sb-direction' => 'row-reverse',
        '--tcdce-sb-triangle-before-offset' => '100%',
        '--tcdce-sb-triangle-after-offset' => 'calc(100% - 3px)',
        '--tcdce-sb-triangle-path' => 'polygon(0 0, 0% 100%, 100% 50%)',
        '--tcdce-sb-margin-top-pc' => 40,
        '--tcdce-sb-margin-top-sp' => 20,
        '--tcdce-sb-margin-bottom-pc' => 40,
        '--tcdce-sb-margin-bottom-sp' => 20,
      )
    ),
    // cardlink
    117 => array(
      'item' => 'cardlink',
      'show' => 1,
      'label' => __( 'Cardlink', 'tcd-classic-editor' )
    )
  );

});

/**
 * current style
 */
add_filter( 'tcdce_enqueue_inline_style', function(){
  ob_start();
?>
@media not all and (max-width:1240px) {
  .p-toc-open {
    display: none;
  }
}
@media (max-width:1240px) {
  .p-toc--sidebar,
  body:has(.p-toc-open) .p-return-top-button-wrapper {
    display: none;
  }
}
@media not all and (max-width:767px) {
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
  body:has(.p-review-footer-bar) .p-toc-open,
  body:has(.p-footer-bar) .p-toc-open {
    margin-bottom: 50px;
  }
}
<?php
  return ob_get_clean();
} );

/**
 * message
 */
add_action( 'tcdce_top_menu', function(){
?>
<p class="p-guide-caution">
  <?php esc_html_e( 'The “Quick Tags” feature of the TCD theme is not available while this plugin is activated.', 'tcd-classic-editor' ); ?>
</p>
<?php
}, 9 );