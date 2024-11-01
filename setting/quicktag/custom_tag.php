<?php

/**
 * クイックタグ設定 custom tag
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// エディタにクイックタグ登録
add_filter( 'tcdce_qt_register_custom_tag', function( $value, $quicktag ) {
  return array(
    'display' => $quicktag['label'],
    'tagStart' => $quicktag['html_start'],
    'tagEnd' => $quicktag['html_end']
  );
}, 10, 2 );


// カスタムタグのCSS出力（フロントとエディタの両方に反映させる必要あり）


// データセット
add_action( 'tcdce_qt_fields_set_properties', function( $instance ) {

  // ラベルをセット
  $instance->set_label( 'custom_tag', __( 'Custom tag', 'tcd-classic-editor' ) );

  // プレビュー情報をセット
  $instance->set_preview( 'custom_tag', null );

  // 初期値をセット
  $instance->set_default( 'custom_tag', array(
    'item' => 'custom_tag',
    'show' => 1,
    'label' => $instance->get_label( 'custom_tag' ),
    'html_start' => '',
    'html_end' => '',
    'css' => ''
  ) );

} );

// 専用フィールド
add_action( 'tcdce_qt_fields_repeater_options_custom_tag', function( $instance, $base_name, $base_value ){

  $instance->fields( __( 'Quicktag setting', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Registered name', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->text( $base_name, $base_value, 'label', 'js-tcdce-repeater-label js-tcdce-empty-validation' )
    )
  ) );

  // HTML
  $instance->fields( __( 'HTML tag to register', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Start tag', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->textarea( $base_name, $base_value, 'html_start' ),
    ),
    array(
      'title' => __( 'End tag', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->textarea( $base_name, $base_value, 'html_end' ),
    ),
  ) );

  // HTML
  $instance->fields( __( 'Style to register', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'CSS entry field', 'tcd-classic-editor' ),
      'col' => 1,
      'field' => $instance->textarea( $base_name, $base_value, 'css', 10 ),
    ),
  ) );

  // submit
  $instance->submit();

}, 10, 3 );


// バリデーション
add_filter( 'tcdce_qt_validation_custom_tag', function( $value ) {

  $new_value = array(
    'item' => 'custom_tag',
    'show' => absint( $value['show'] ),
    'label' => sanitize_text_field( $value['label'] ),
    'html_start' => $value['html_start'],
    'html_end' => $value['html_end'],
    'css' => $value['css']
  );

  return $new_value;

});
