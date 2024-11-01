<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * custom esc_attr filter
 */
function tcdce_custom_attribute_escape( $safe_text, $text ){
  $safe_text = str_replace( "&#039;", "'" , $safe_text );
  return $safe_text;
}

/**
 * custom allowed html
 */
function tcdce_kses_allowed_html( $allowedtags, $context ) {
  if( $context == 'tcdce' ){
    global $allowedposttags;
    $allowedtags = $allowedposttags;
    $allowedtags['select'] = array(
      'class' => true,
      'name' => true
    );
    $allowedtags['option'] = array(
      'value' => true,
      'selected' => true
    );
    $allowedtags['input'] = array(
      'type' => true,
      'name' => true,
      'id' => true,
      'value' => true,
      'class' => true,
      'style' => true,
      'placeholder' => true,
      'checked' => true,
      'disabled' => true,
      'readonly' => true,
      'required' => true,
      'autocomplete' => true,
      'autofocus' => true,
      'min' => true,
      'max' => true,
      'data-property' => true
    );
    $allowedtags['svg'] = array(
      'xmlns' => true,
      'width' => true,
      'height' => true,
      'viewbox' => true,
      'fill' => true
    );
    $allowedtags['path'] = array(
      'd' => true,
      'fill' => true,
      'stroke' => true,
      'stroke-width' => true
    );
    $allowedtags['circle'] = array(
      'cx' => true,
      'cy' => true,
      'r' => true,
      'fill' => true
    );
    $allowedtags['rect'] = array(
      'x' => true,
      'y' => true,
      'width' => true,
      'height' => true,
      'fill' => true
    );
    $allowedtags['line'] = array(
      'x1' => true,
      'x2' => true,
      'y1' => true,
      'y2' => true,
      'stroke' => true,
      'stroke-width' => true
    );
    $allowedtags['g'] = array(
      'transform' => true
    );

  }
  return $allowedtags;
}
add_filter( 'wp_kses_allowed_html', 'tcdce_kses_allowed_html', 10, 2 );