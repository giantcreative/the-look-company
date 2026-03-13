<?php

/**
 * Force Salient transparent header on blog index, single posts, and video taxonomy pages.
 */
add_filter( 'nectar_activate_transparent_header', function ( $active ) {
  if ( is_home() || is_single() || is_tax( 'video-category' ) ) {
    return true;
  }
  return $active;
} );

/**
 * Force dark header colour on single posts via an inline style.
 *
 * Outputs a small <style> block in wp_head rather than filtering every
 * metadata read, which is significantly cheaper.
 */
add_action( 'wp_head', function () {
  if ( ! is_single() ) {
    return;
  }
  echo '<style>#header-outer.transparent { --nectar-header-color: dark; }</style>' . "\n";
} );

/**
 * Inject global section banner after outer wrap open on the blog index.
 *
 * NOTE: The ID 484 is a hardcoded Nectar Global Section post ID.
 * If the post is deleted or the DB is migrated, update this ID.
 */
add_action( 'nectar_hook_after_outer_wrap_open', function () {
  if ( is_home() ) {
    echo '<div class="container-wrap" style="padding-top: 0px; padding-bottom: 0px;"><div class="container main-content" role="banner"><div class="row">' . do_shortcode( '[nectar_global_section id="484"]' ) . '</div></div></div>';
  }
}, 20 );
