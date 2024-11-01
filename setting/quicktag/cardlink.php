<?php

/**
 * クイックタグ設定 cardlink
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// エディタにクイックタグ登録
add_filter( 'tcdce_qt_register_cardlink', function( $value, $quicktag ) {
  return array(
    'display' => $quicktag['label'],
    'tag' => '[clink url="' . __( 'Enter the article URL you want to display here', 'tcd-classic-editor' ) . '"]'
  );
}, 10, 2 );


// データセット
add_action( 'tcdce_qt_fields_set_properties', function( $instance ) {

  // ラベルをセット
  $instance->set_label( 'cardlink', __( 'Cardlink', 'tcd-classic-editor' ) );

  // プレビュー情報をセット
  $instance->set_preview( 'cardlink', null );

  // 初期値をセット
  $instance->set_default( 'cardlink', array(
    'item' => 'cardlink',
    'show' => 1,
    'label' => $instance->get_label( 'cardlink' ),
  ) );

  // プリセットなし

} );

// 専用フィールド
add_action( 'tcdce_qt_fields_repeater_options_cardlink', function( $instance, $base_name, $base_value ){

  $instance->fields( __( 'Quicktag setting', 'tcd-classic-editor' ), array(
    array(
      'title' => __( 'Registered name', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->text( $base_name, $base_value, 'label', 'js-tcdce-repeater-label js-tcdce-empty-validation' )
    ),
    array(
      'title' => __( 'Shortcode', 'tcd-classic-editor' ),
      'col' => 2,
      'field' => $instance->shortcode( '[clink url=""]' )
    ),
  ) );

	// submit
	$instance->submit();

}, 10, 3 );


// バリデーション
add_filter( 'tcdce_qt_validation_cardlink', function( $value ) {

  $new_value = array(
    'item' => 'cardlink',
    'show' => absint( $value['show'] ),
    'label' => sanitize_text_field( $value['label'] ),
  );

  return $new_value;

});