<?php

/**
 * Start Guide
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'tcdce_top_menu', function(){

?>
<h1 class="tcdce-page__headline">
  <?php esc_html_e( 'Start guide', 'tcd-classic-editor' ); ?>
</h1>
<p class="tcdce-page__desc">
  <?php esc_html_e( 'This plugin supports the creation of web pages using the Classic Editor.', 'tcd-classic-editor' ); ?><br>
  <?php esc_html_e( 'First, please refer to the operation manuals for each function.', 'tcd-classic-editor' ); ?>
</p>
<?php

  $navs = array(
    'tcd_classic_editor_quicktag' => array(
      'title' => __( 'Quicktag', 'tcd-classic-editor' ),
      'image' => '',
      'desc' => __( 'Add quick tags such as headings and buttons to the classic editor', 'tcd-classic-editor' ),
      'manual_link' => '#',
    ),
    'tcd_classic_editor_gmap' => array(
      'title' => __( 'Google Maps', 'tcd-classic-editor' ),
      'image' => '',
      'desc' => __( 'Uses Google Maps API to generate designed maps', 'tcd-classic-editor' ),
      'manual_link' => '#',
    ),
    'tcd_classic_editor_toc' => array(
      'title' => __( 'Table of contents', 'tcd-classic-editor' ),
      'image' => '',
      'desc' => __( 'Automatic table of contents generation from headings entered in the classic editor', 'tcd-classic-editor' ),
      'manual_link' => '#',
    )
  );

?>
<ul class="p-guide-nav">
  <?php foreach( $navs as $nav_key => $nav_obj ){ ?>
  <li class="p-guide-nav__item">
    <h2 class="p-guide-nav__item-title">
      <?php echo esc_html( $nav_obj['title'] ); ?>
    </h2>
    <div class="p-guide-nav__item-image" style="background-image:url(<?php echo esc_url( $nav_obj['image'] ); ?>);"></div>
    <p class="p-guide-nav__item-desc">
      <?php echo esc_html( $nav_obj['desc'] ); ?>
    </p>
    <a class="p-guide-nav__item-link" href="<?php echo esc_url( add_query_arg( array( 'page' => $nav_key ), admin_url( 'admin.php' ) ) ); ?>">
      <?php
        /* translators: %s: admin menu page title */
        echo esc_html( sprintf( __( 'Open %s settings', 'tcd-classic-editor' ), $nav_obj['title'] ) );
      ?>
    </a>
    <a class="p-guide-nav__item-manual" href="<?php echo esc_url( $nav_obj['manual_link'] ); ?>">
      <?php esc_html_e( 'View Manual', 'tcd-classic-editor' ); ?>
    </a>
  </li>
  <?php } ?>
</ul>


<?php

} );