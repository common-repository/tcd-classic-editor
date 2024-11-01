<?php

/**
 * クイックタグ設定のUI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'TCDCE_Qt_Fields' ) ) {
  class TCDCE_Qt_Fields {

    /**
		 * Quicktag name.
		 *
		 * @var string
		 */
    public $name = '';

    /**
		 * Quicktag label.
		 *
		 * @var array
		 */
    public $label = array();

    /**
		 * Preview html.
		 *
		 * @var array
		 */
    public $preview = array();

    /**
		 * Default settings.
		 *
		 * @var array
		 */
    public $default = array();

    /**
		 * Preset.
		 *
		 * @var array
		 */
    public $preset = array();

    /**
     * Constructor.
     */
    public function __construct() {

      // 各種値をセット
      do_action( 'tcdce_qt_fields_set_properties', $this );

      // ajax登録
      add_action( 'wp_ajax_tcdce_repeater_add', array( $this, 'repeater_add' ) );

    }

    /**
     * Get label.
     */
    public function get_label( $key = null ) {
      if( $key !== null && array_key_exists( $key, $this->label ) ){
        return $this->label[$key];
      }else{
        return $this->label;
      }
    }

    /**
     * Set label.
     */
    public function set_label( $key, $value ) {
      $this->label[$key] = $value;
    }

    /**
     * Get preview.
     */
    public function get_preview( $key = null ) {
      if( $key !== null && array_key_exists( $key, $this->preview ) ){
        return $this->preview[$key];
      }else{
        return $this->preview;
      }
    }

    /**
     * Set preview.
     */
    public function set_preview( $key, $value ) {
      $this->preview[$key] = $value;
    }

    /**
     * Get default.
     */
    public function get_default( $key = null ) {
      if( $key !== null && array_key_exists( $key, $this->default ) ){
        return $this->default[$key];
      }else{
        return $this->default;
      }
    }

    /**
     * Set default.
     */
    public function set_default( $key, $value ) {
      $this->default[$key] = $value;
    }

    /**
     * Get preset.
     */
    public function get_preset( $key = null ) {
      if( $key !== null && array_key_exists( $key, $this->preset ) ){
        return $this->preset[$key];
      }else{
        return $this->preset;
      }
    }

    /**
     * Set preset.
     */
    public function set_preset( $key, $value ) {
      $this->preset[$key] = $value;
    }

    /**
     * Main fields.
     */
    public function fields( $title, $fields = array() ) {
      echo '<h3 class="tcdce-edit__options-title">' . esc_html( $title ) . '</h3>';
      echo '<div class="tcdce-edit__options-field">';
      foreach( $fields as $field ){
        $field = wp_parse_args( $field, array(
          'title' => '',
          'class' => '',
          'col' => 1,
          'field' => '',
        ) );
        echo '<div class="tcdce-edit__options-field__item ' . esc_attr( $field['class'] ) . '" data-col="' . esc_attr( $field['col'] ) . '">';
        echo '<span class="tcdce-edit__options-name">' . esc_html( $field['title'] ) . '</span>';
        echo wp_kses( $field['field'], wp_kses_allowed_html( 'tcdce' ) );
        echo '</div>';
      }
      echo '</div>';
    }

    /**
     * Submit button.
     */
    public function submit( $class = 'tcdce-submit-wrapper' ) {
      echo '<div class="' . esc_attr( $class ) . '">';
      echo '<button class="tcdce-submit js-tcdce-form-submit" type="button">';
      esc_html_e( 'Save Changes', 'tcd-classic-editor' );
      echo '</button>';
      echo '</div>';
    }

    /**
     * Reset button.
     */
    public function reset( $base_name, $class = '' ) {
      echo '<div class="tcdce-base-fields__reset">';
      echo '<span class="tcdce-base-fields__reset-action js-tcdce-reset">' . esc_html__( 'Reset settings', 'tcd-classic-editor' ) . '</span>';
      echo '<div class="tcdce-base-fields__reset-content">';
      echo '<div class="tcdce-base-fields__reset-inner">';
      echo '<p class="tcdce-base-fields__reset-desc">';
      echo esc_html__( 'Initialize settings.', 'tcd-classic-editor' ) . '<br>' . esc_html__( 'Please note that all current settings will be deleted.', 'tcd-classic-editor' );
      echo '</p>';
      echo '<button class="tcdce-base-fields__reset-button" name="' . esc_attr( $base_name ) .'[reset]" value="1" type="submit">' . esc_html__( 'Reset settings', 'tcd-classic-editor' ) . '</button>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }

    /**
     * Text field.
     */
    public function text( $base_name, $base_value, $property, $class = '', $placeholder = '' ) {
      $output = '<div class="tcdce-text">';
      $output .= '<input
                  class="tcdce-text__input ' . esc_attr( $class ) . '"
                  type="text"
                  name="' . esc_attr( $base_name . '[' . $property . ']' ) . '"
                  value="' . esc_attr( $base_value[$property] ?? '' ) . '"
                  placeholder="' . esc_attr( $placeholder ) . '"
                >';
      if( str_contains( $class, 'js-tcdce-empty-validation' ) ){
        $output .= '<div class="tcdce-text__input-error">' . __( 'This field is required.', 'tcd-classic-editor' ) . '</div>';
      }
      $output .= '</div>';
      return $output;
    }

    /**
     * Shortcode.
     */
    public function shortcode( $value ) {
      return
      '<div class="tcdce-text">
        <input
          class="tcdce-text__input"
          type="text"
          value="' . esc_attr( $value ) . '"
          readonly
        >
      </div>';
    }

    /**
     * textarea field.
     */
    public function textarea( $base_name, $base_value, $property, $rows = 5, $class = '' ) {
      return
      '<div class="tcdce-textarea">
        <textarea
          class="tcdce-textarea__value ' . esc_attr( $class ) . '"
          name="' . esc_attr( $base_name . '[' . $property . ']' ) . '"
          rows="' . esc_attr( $rows ) . '"
        >' .
        $base_value[$property] .
        '</textarea>
      </div>';
    }

    /**
     * hidden fields.
     */
    public function hiddens( $base_name, $base_value, $properties ) {
      foreach( $properties as $property ){
        echo
        '<input
          class="js-tcdce-preview-option"
          type="hidden"
          name="' . esc_attr( $base_name ) . '[' . esc_attr( $property ) . ']"
          value="' . esc_attr( $base_value[$property] ) . '"
          data-property="' . esc_attr( $property ) . '"
        >';
      }
    }

    /**
     * Number field.
     */
    public function number( $base_name, $base_value, $properties ) {
      $output = '<div class="tcdce-number">';
      foreach( $properties as $property => $property_info ){
        $output .= '<label class="tcdce-number__label">';
        if( isset( $property_info['icon'] ) && $property_info['icon'] ){
          $output .= '<span class="tcdce-number__icon">' . $property_info['icon'] . '</span>';
        }
        $output .= '<input
          class="tcdce-number__input js-tcdce-preview-option"
          type="number"
          name="' . esc_attr( $base_name . '[' . $property . ']' ) . '"
          value="' . esc_attr( $base_value[$property] ) . '"
          min="0"
          max="999"
          data-property="' . esc_attr( $property ) . '"
          placeholder="' . $property_info['default'] . '"
        />';
        $output .= '<span class="tcdce-number__unit">px</span>';
        $output .= '</label>';
      }
      $output .= '</div>';
      return $output;
    }

    /**
     * Color picker.
     */
    public function color( $base_name, $base_value, $property ) {
      return
      '<div class="js-tcdce-color-picker tcdce-color">
        <input
          class="js-tcdce-color-picker--value tcdce-color__input js-tcdce-preview-option"
          type="text"
          name="' . esc_attr( $base_name . '[' . $property . ']' ) . '"
          value="' . esc_attr( $base_value[$property] ?? '' ) . '"
          data-property="' . esc_attr( $property ) . '"
        >
      </div>';
    }

    /**
     * toggle button.
     */
    public function toggle( $name, $value, $property, $label ) {
      $output = '<div class="tcdce-toggle-wrapper">';
      $output .= '<label class="tcdce-toggle">';
      $output .= '<input type="hidden" name="' . esc_attr( $name . '[' . $property . ']' ) . '" value="0">';
      $output .= '<input class="tcdce-toggle__input" type="checkbox" name="' . esc_attr( $name . '[' . $property . ']' ) . '"' . checked( 1, esc_attr( $value[$property] ?? 0 ), false ) . ' value="1">';
      $output .= '<span class="tcdce-toggle__button"></span>';
      $output .= '<span class="tcdce-toggle__label">' . esc_html( $label ) . '</span>';
      $output .= '</label>';
      $output .= '</div>' . "\n";
      return $output;
    }

    /**
     * Radio button.
     */
    public function radio( $name, $value, $property, $options ) {
      $output = '<div class="tcdce-radio">';
      foreach( $options as $key => $icon ){
        $output .= '<label class="tcdce-radio__label">';
        $output .=
          '<input ' .
            'class="tcdce-radio__input js-tcdce-preview-option--radio" ' .
            'type="radio" ' .
            'name="' . esc_attr( $name . '[' . $property . ']' ) . '" ' .
            'value="' . esc_attr( $key ) . '" ' .
            checked( $key, esc_attr( $value[$property] ), false ) .
            ' data-property="' . esc_attr( $property ) . '"
          >';
        $output .= '<span class="tcdce-radio__icon">' . $icon . '</span>';
        $output .= '</label>';
      }
      $output .= '</div>';
      return $output;
    }

    /**
     * Select box.
     */
    public function select( $name, $value, $property, $options ) {
      $output = '<div class="tcdce-select">';
      $output .= '<select class="tcdce-select-box" name="' . esc_attr( $name . '[' . $property . ']' ) . '">';
      foreach( $options as $key => $label ){
        $output .= '<option
          value="' . esc_attr( $key ) . '"' .
          selected( $key, esc_attr( $value[$property] ), false ) .
          '>' . esc_html( $label ) . '</option>';
      }
      $output .= '</select>';
      $output .= '</div>';
      return $output;
    }

    /**
     * Image uploader.
     */
    public function image( $base_name, $base_value, $property ) {
      $image_url = wp_get_attachment_url( $base_value[$property] ?? '' ) ? 'url(' . wp_get_attachment_url( $base_value[$property] ?? '' ) . ')' : '';
      return
      '<div class="tcdce-image js-tcdce-image-closest">
        <input
          class="tcdce-image__value js-tcdce-image-id"
          type="text"
          name="' . esc_attr( $base_name . '[' . $property . ']' ) . '"
          value="' . esc_attr( $base_value[$property] ?? '' ) . '"
          placeholder=" "
        >
        <input class="js-tcdce-preview-option"
          type="hidden"
          value="' . esc_url( $image_url ) . '"
          data-property="' . esc_attr( $property ) . '"
        >
        <div class="tcdce-image__input js-tcdce-image">' .
        '<span class="tcdce-image__input-icon">' . TCDCE_ICONS['add_image'] . '</span>' . __( 'Add image', 'tcd-classic-editor' ) .
        '</div>
        <div class="tcdce-image__uploaded">
          <span class="tcdce-image__delete js-tcdce-image-delete">' . TCDCE_ICONS['close'] . '</span>
          <div class="tcdce-image__uploaded-image js-tcdce-image-preview" style="background-image:' . $image_url . ';"></div>
          <span class="tcdce-image__change js-tcdce-image">' . __( 'Change image', 'tcd-classic-editor' ) . '</span>
        </div>
      </div>';
    }

    /**
     * Preset field.
     */
    public function preset( $name, $value, $item_type, $preset = '' ) {
      return
      '<div class="tcdce-text js-tcdce-preset-open" data-preset-type="' . esc_attr( $item_type ) . '">
        <input
          class="js-tcdce-preset-target-value"
          type="hidden" name="' . esc_attr( $name ) . '"
          value="' . esc_attr( $value ) . '"
        >
        <input
          class="tcdce-text__input tcdce-preset js-tcdce-preset-target-label"
          type="text"
          value="' . esc_attr( $this->preset[$item_type][$value]['label'] ) . '"
          placeholder="' . __( 'Select Preset', 'tcd-classic-editor' ) . '"
          readonly
        >
      </div>';
    }

    /**
     * Repeater.
     */
    public function repeater( $item_type, $key, $base_name, $base_value ) {
?>
<div class="tcdce-repeater__item js-tcdce-repeater-item" data-key="<?php echo esc_attr( $key ); ?>">
  <?php $this->repeater_title( $item_type, $base_name, $base_value ); ?>
  <div class="tcdce-repeater__item-content">
    <input type="hidden" name="<?php echo esc_attr( $base_name . '[item]' ); ?>" value="<?php echo esc_attr( $item_type ); ?>">
<?php

    // setting
    do_action( "tcdce_qt_fields_repeater_options_{$item_type}", $this, $base_name, $base_value, $key );

    // preview
    if( $this->preview[$item_type] ){

?>
    <div class="tcdce-edit js-tcdce-preview-closest">
      <div class="tcdce-edit__preview tcdce-preview tcdce-body">
        <?php echo wp_kses( $this->preview[$item_type], wp_kses_allowed_html( 'tcdce' ) ); ?>
      </div>
      <div class="tcdce-edit__options">
        <?php do_action( "tcdce_qt_fields_repeater_preview_options_{$item_type}", $this, $base_name, $base_value ); ?>
      </div>
    </div>
<?php

    }

?>
  </div>
</div>
<?php
    }


    /**
     * Repeater title.
     */
    public function repeater_title( $item_type, $base_name, $base_value ) {
?>
  <div class="tcdce-repeater__item-title js-tcdce-repeater-title">
    <span class="tcdce-repeater__item-title__handle js-tcdce-repeater-sortable-handle">
      <?php echo wp_kses( TCDCE_ICONS['handle'], wp_kses_allowed_html( 'tcdce' ) ); ?>
    </span>
    <label class="tcdce-repeater__item-title__toggle tcdce-toggle">
      <input type="hidden" name="<?php echo esc_attr( $base_name . '[show]' ); ?>" value="0"/>
      <input class="tcdce-toggle__input" type="checkbox" name="<?php echo esc_attr( $base_name . '[show]' ); ?>" value="1" <?php checked( 1, esc_attr( $base_value['show'] ) ); ?>/>
      <span class="tcdce-toggle__button"></span>
    </label>
    <span class="tcdce-repeater__item-title__icon">
      <?php echo wp_kses( TCDCE_ICONS[$item_type], wp_kses_allowed_html( 'tcdce' ) ); ?>
    </span>
    <div class="tcdce-repeater__item-title__register">
      <span class="tcdce-repeater__item-title__register-label"><?php esc_html_e( 'Registered name', 'tcd-classic-editor' ); ?></span>
      <span class="tcdce-repeater__item-title__register-name js-tcdce-repeater-title-label"><?php echo esc_html( $base_value['label'] ); ?></span>
    </div>
    <div class="tcdce-repeater__item-title__delete js-tcdce-repeater-delete" data-msg="<?php esc_attr_e( 'Can I delete this Quicktag?', 'tcd-classic-editor' ); ?>">
      <?php echo wp_kses( TCDCE_ICONS['delete'], wp_kses_allowed_html( 'tcdce' ) ); ?>
    </div>
    <div class="tcdce-repeater__item-title__expand">
      <?php echo wp_kses( TCDCE_ICONS['expand'], wp_kses_allowed_html( 'tcdce' ) ); ?>
    </div>
  </div>
<?php
    }

    /**
     * Ajax repeater add.
     */
    public function repeater_add() {

      // nonce認証
      $nonce = check_ajax_referer( 'tcdce_ajax_action', 'nonce', false );
      if( ! $nonce ){
        echo 'nonce_error';
        wp_die();
      }

      // repeater item
      $item = sanitize_key( $_POST['item'] );

      // repeater keys
      $register_keys = array();
      if( isset( $_POST['register_keys'] ) && is_array( $_POST['register_keys'] ) && ! empty( $_POST['register_keys'] ) ){
        $register_keys = array_map( 'absint', $_POST['register_keys'] );
      }

      // 固有IDの発酵
      $new_key = wp_rand( 100, 999 );
      if( ! empty( $register_keys ) ){
        $register_keys = array_map( 'intval', $register_keys );
        while( true ){
          $tmp_key = wp_rand( 100, 999 );
          if( ! in_array( $tmp_key, $register_keys, true ) ){
            $new_key = $tmp_key;
            break;
          }
        }
      }

      $default = $this->get_default( $item );
      if( isset( $default['class'] ) ) {
        $default['class'] = $item . '-' . $new_key;
      }

      $this->repeater(
        $item,
        $new_key,
        'tcdce_quicktag[' . $new_key . ']',
        $default
      );

      wp_die();

    }


  }
}