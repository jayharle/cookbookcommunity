<?php

/**
 * Enqueue child styles.
 */
 
function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), null );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function remove_global_css() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
}
add_action('init', 'remove_global_css');

/**
 * Add custom functions here
 */

// Shortcode for dynamic year - use [year] in footer or as needed
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

/* Update default GF error message gform_validation_message_FORMNUMBER */
add_filter( 'gform_validation_message_1', function ( $message, $form ) {
    if ( gf_upgrade()->get_submissions_block() ) {
        return $message;
    }
 
    $message = "<h2 class='gform_submission_error hide_summary'>Email address is required. Please use the test@example.com format</h2>";
   
 
    return $message;
}, 10, 2 );