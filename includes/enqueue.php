<?php

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles', 100 );

function salient_child_enqueue_styles() {
  $v = nectar_get_theme_version();

  wp_enqueue_style( 'theme-custom-style', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array(), $v );
  wp_register_script( 'tlc-form-js', get_stylesheet_directory_uri() . '/assets/js/forms.js', array( 'jquery' ), '', true );

  if ( is_front_page() ) {
    wp_enqueue_style( 'tlc-homepage-style', get_stylesheet_directory_uri() . '/assets/css/home.min.css', array(), $v );
  }
  if ( is_page( 'contact' ) ) {
    wp_enqueue_style( 'tlc-contact-style', get_stylesheet_directory_uri() . '/assets/css/contact.min.css', array(), $v );
    wp_enqueue_script( 'tlc-form-js' );
  }
  if ( is_page( 'our-companies' ) ) {
    wp_enqueue_style( 'tlc-our-companies-style', get_stylesheet_directory_uri() . '/assets/css/our-companies.min.css', array(), $v );
  }
  if ( is_page( 'retail-solutions' ) ) {
    wp_enqueue_style( 'tlc-retail-solutions-style', get_stylesheet_directory_uri() . '/assets/css/retail-solutions.min.css', array(), $v );
  }
  if ( is_page( 'sports-and-events' ) ) {
    wp_enqueue_style( 'tlc-sports-and-events-style', get_stylesheet_directory_uri() . '/assets/css/sports-and-events.min.css', array(), $v );
  }
  if ( is_page( 'meet-our-team' ) ) {
    wp_enqueue_style( 'tlc-meet-our-team-style', get_stylesheet_directory_uri() . '/assets/css/meet-our-team.min.css', array(), $v );
  }
  if ( is_page( 'faq' ) ) {
    wp_enqueue_style( 'tlc-faq-style', get_stylesheet_directory_uri() . '/assets/css/faq.min.css', array(), $v );
  }
  if ( is_page( 'videos' ) || is_tax( 'video-category' ) ) {
    wp_enqueue_style( 'tlc-videos-style', get_stylesheet_directory_uri() . '/assets/css/videos.min.css', array(), $v );
  }
  if ( is_page( 'guides' ) ) {
    wp_enqueue_style( 'tlc-guides-style', get_stylesheet_directory_uri() . '/assets/css/guides.min.css', array(), $v );
  }
  if ( is_page( 'our-work' ) ) {
    wp_enqueue_style( 'tlc-our-work-style', get_stylesheet_directory_uri() . '/assets/css/our-work.min.css', array(), $v );
  }
  if ( is_page( 'brand-activations' ) ) {
    wp_enqueue_style( 'tlc-brand-activations-style', get_stylesheet_directory_uri() . '/assets/css/brand-activations.min.css', array(), $v );
  }
  if ( is_page( 'the-look-group' ) ) {
    wp_enqueue_style( 'tlc-the-look-group-style', get_stylesheet_directory_uri() . '/assets/css/the-look-group.min.css', array(), $v );
  }
  if ( is_page( 'careers' ) ) {
    wp_enqueue_style( 'tlc-careers-style', get_stylesheet_directory_uri() . '/assets/css/careers.min.css', array(), $v );
    wp_enqueue_script( 'tlc-form-js' );
  }
  if ( is_page( 'lightboxes' ) ) {
    wp_enqueue_style( 'tlc-lightboxes-style', get_stylesheet_directory_uri() . '/assets/css/lightboxes.min.css', array(), $v );
  }
  if ( is_page( 'fabric-and-frames' ) ) {
    wp_enqueue_style( 'tlc-fabric-and-frames-style', get_stylesheet_directory_uri() . '/assets/css/fabric-and-frames.min.css', array(), $v );
  }
  if ( is_page( 'display-systems' ) ) {
    wp_enqueue_style( 'tlc-display-systems-style', get_stylesheet_directory_uri() . '/assets/css/display-systems.min.css', array(), $v );
  }
  if ( is_page( 'signs-and-banners' ) ) {
    wp_enqueue_style( 'tlc-signs-and-banners-style', get_stylesheet_directory_uri() . '/assets/css/signs-and-banners.min.css', array(), $v );
  }
  if ( is_page( 'services' ) ) {
    wp_enqueue_style( 'tlc-services-style', get_stylesheet_directory_uri() . '/assets/css/services.min.css', array(), $v );
  }
  if ( is_page( 'thank-you' ) ) {
    wp_enqueue_style( 'tlc-thank-you-style', get_stylesheet_directory_uri() . '/assets/css/thank-you.min.css', array(), $v );
  }
  if ( is_home() || is_single() ) {
    wp_enqueue_style( 'tlc-blog-style', get_stylesheet_directory_uri() . '/assets/css/blog.min.css', array(), $v );
  }
  if ( is_category() || is_tag() ) {
    wp_enqueue_style( 'tlc-blog-category-style', get_stylesheet_directory_uri() . '/assets/css/blog-category.min.css', array(), $v );
  }
  if ( is_rtl() ) {
    wp_enqueue_style( 'salient-rtl', get_template_directory_uri() . '/rtl.css', array(), '1', 'screen' );
  }
}
