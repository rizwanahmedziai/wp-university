<?php

// Enqueue styles and scripts
function wp_university_files() {
  wp_enqueue_script( 'main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL , microtime(), true );
  wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('wp_university_main_styles', get_stylesheet_uri(), NULL, microtime());
}

add_action( 'wp_enqueue_scripts', 'wp_university_files' );

// Add theme features
function wp_university_features() {
  // register_nav_menu( 'header-menu', 'Header Menu' );
  // register_nav_menu( 'footer-menu-1', 'Footer Menu 1' );
  // register_nav_menu( 'footer-menu-2', 'Footer Menu 2' );

  add_theme_support('title-tag');
}
add_action( 'after_setup_theme', 'wp_university_features');

 ?>
