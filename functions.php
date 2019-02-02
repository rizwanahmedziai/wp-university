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
// Code for themes
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

// /**
//  * Register a custom post type called "Events".
//
//  * @see Custom Post Types should be created in 'Must Use Plugins'
//  * Create a folder named 'mu-plugins' next to 'plugins' folder
//  * @see get_post_type_labels() for label keys.
//  */
function wp_university_custom_posts() {

  // Create the Events Custom Post type
  // Copied from wordpress codex

    $labels = array(
        'name'                  => _x( 'Events', 'Post type general name', 'events' ),
        'singular_name'         => _x( 'Event', 'Post type singular name', 'event' ),
        'menu_name'             => _x( 'Events', 'Admin Menu text', 'menu_events' ),
        'featured_image'        => _x( 'Event Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'add_new_item'          => __( 'Add New Event', 'add_new_event' ),
        'edit_item'             => __( 'Edit Event', 'edit-event' ),
        'all_items'             => __('All Events', 'all_events'),
        'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'admin_event' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-calendar',
        'rewrite'            => array( 'slug' => 'events' ),
        'supports'           => array('title', 'editor', 'excerpt'),
    );

    register_post_type( 'event', $args );
}

add_action( 'init', 'wp_university_custom_posts' );


 ?>
