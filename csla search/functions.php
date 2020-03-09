<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), null, 'all' );
	wp_enqueue_style( 'financity-child-theme-style', get_stylesheet_directory_uri() . '/style.css', array('financity-custom-style','financity-style-core'), time(), 'all' );
	//wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/custom.css', array(), null, 'all' );

	// wp_register_script( 'child-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '', true );
	wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri() . '/slick/slick.css' );
	wp_enqueue_script( 'slick-script', get_stylesheet_directory_uri() . '/slick/slick.js', array ( 'jquery' ), 1.1, true);
	wp_enqueue_style( 'scrollbar-style', get_stylesheet_directory_uri() . '/custom-scrollbar/jquery.mCustomScrollbar.min.css' );
	wp_enqueue_script( 'scrollbar-script', get_stylesheet_directory_uri() . '/custom-scrollbar/jquery.mCustomScrollbar.js', array ( 'jquery' ), 1.1, true);
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);
}


add_filter( 'excerpt_length', function($length) {
    return 17;
} );

// //Exclude pages from WordPress Search
// if (!is_admin()) {
// function wpb_search_filter($query) {
// if ($query->is_search) {
// $query->set('post_type', 'post');
// }
// return $query;
// }
// add_filter('pre_get_posts','wpb_search_filter');
// }

// Product Custom Post Type
function advisor_init() {
    // set up product labels
    $labels = array(
        'name' => 'Advisors',
        'singular_name' => 'Advisor',
        'add_new' => 'Add New Advisor',
        'add_new_item' => 'Add New Advisor',
        'edit_item' => 'Edit Advisor',
        'new_item' => 'New Advisor',
        'all_items' => 'All Advisors',
        'view_item' => 'View Advisor',
        'search_items' => 'Search Advisors',
        'not_found' =>  'No Advisors Found',
        'not_found_in_trash' => 'No Advisors found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Advisors',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'advisor'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'advisor', $args );
    
    // register taxonomy
    register_taxonomy('advisor_category', 'advisor', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'advisor-category' )));
}
add_action( 'init', 'advisor_init' );



add_action('admin_init', 'admin_init_example_type');
 
/**
* hook the posts search if we're on the admin page for our type
*/
function admin_init_example_type() {
    global $typenow;
 
    if ($typenow === 'advisor') {
        add_filter('posts_search', 'posts_search_example_type', 10, 2);
    }
}



function template_chooser($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'advisor' )   
  {
    return locate_template('archive-search.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'template_chooser');  


 
/**
* add query condition for custom meta
* @param string $search the search string so far
* @param WP_Query $query
* @return string
*/
function posts_search_example_type($search, $query) {
    global $wpdb;
 
    if ($query->is_main_query() && !empty($query->query['s'])) {
        $sql    = "
            or exists (
                select * from {$wpdb->postmeta} where post_id={$wpdb->posts}.ID
                and meta_key in ('title','designation','client_specialities','address')
                and meta_value like %s
            )
        ";
        $like   = '%' . $wpdb->esc_like($query->query['s']) . '%';
        $search = preg_replace("#\({$wpdb->posts}.post_title LIKE [^)]+\)\K#",
            $wpdb->prepare($sql, $like), $search);
    }
 
    return $search;
}