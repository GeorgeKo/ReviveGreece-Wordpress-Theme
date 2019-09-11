<?php

    // MY CUSTOM TITLE
    function my_title () {

        if ( is_front_page() || is_singular() ) {
            the_title(); 
        } else {
            wp_title('');
        }

    }

    add_theme_support( 'custom-logo' );



    // REGISTER MENUS
    function my_register_custom_menus () {

        register_nav_menus( 
            array(
                'main-navigation'   => 'Main Navigation',
                'footer-navigation' => 'Footer Navigation'
            )
        );

    }
    add_action( 'init', 'my_register_custom_menus' );



    // REGISTER SIDEBARS
    function my_register_sidebars () {

        register_sidebar(array(
            'name' => 'Sidebar 1',
            'id'   => 'sidebar-1'
        ));

        register_sidebar(array(
            'name' => 'Sidebar 2',
            'id'   => 'sidebar-2'
        ));

    }
    add_action( 'init', 'my_register_sidebars' );



    // ADD CSS STYLES
    function my_add_theme_style_css() {

        wp_enqueue_style( 'main',      get_stylesheet_directory_uri() . '/style.css' );
        // wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/css/normalize.css' );
        // wp_enqueue_style( 'structure', get_stylesheet_directory_uri() . '/css/structure.css' );
        // wp_enqueue_style( 'header',    get_stylesheet_directory_uri() . '/css/header.css' );
        // wp_enqueue_style( 'content',   get_stylesheet_directory_uri() . '/css/content.css' );
        // wp_enqueue_style( 'sidebar',   get_stylesheet_directory_uri() . '/css/sidebar.css' );
        // wp_enqueue_style( 'footer',    get_stylesheet_directory_uri() . '/css/footer.css' );

    }
    add_action( 'wp_enqueue_scripts', 'my_add_theme_style_css' );



    //Customize Book Sidebar Output

add_filter( 'my_sidebar_output', 'my_widget_filter' );
function my_widget_filter( $sidebar_output ) { {
		return array(
			'posts_per_page' => 10,//set the number you want here 
			'no_found_rows' => true, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true,
			'cat' => 'Book'//the current category id
			 );
	}
    return $sidebar_output;
}


/**
 * Add HTML5 theme support for Search form
 */
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );




/*
* Custom Post Types
*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => ( 'Books' ),
            'singular_name'       => ( 'Book' ),
            'menu_name'           => ( 'Books' ),
            'parent_item_colon'   => ( 'Parent Book' ),
            'all_items'           => ( 'All Books') ,
            'view_item'           => ( 'View Book' ),
            'add_new_item'        => ( 'Add New Book'),
            'add_new'             => ( 'Add New' ),
            'edit_item'           => ( 'Edit Book' ),
            'update_item'         => ( 'Update Book' ),
            'search_items'        => ( 'Search Book' ),
            'not_found'           => ( 'Not Found' ),
            'not_found_in_trash'  => ( 'Not found in Trash' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => ( 'Books' ),
            'description'         => ( 'Book synopsis' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'post_tag'),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-book-alt',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
         
        // Registering your Custom Post Type
        register_post_type( 'books', $args );
     
    }
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'custom_post_type', 0 );




/****************  Create Book Meta Boxes  ***************/


/**** MetaBox Author ****/
    function Books_author_add_meta_box() {
        add_meta_box( 'book_author', 'Author', 'Books_author_callback', 'Books', 'normal', 'high' );
    }
    function Books_author_callback( $post ) {
        wp_nonce_field( 'Books_save_author_data', 'Books_author_meta_box_nonce' );
        
        $value = get_post_meta( $post->ID, '_author_value_key', true );
        
        echo '<label for="Books_author_field">Author&#039s Full Name (Name Surname): </lable>';
        echo '<input type="text" id="Books_author_field" name="Books_author_field" value="' . esc_attr( $value ) . '" size="50" />';
    }
    function Books_save_author_data( $post_id ) {
        
        if( ! isset( $_POST['Books_author_meta_box_nonce'] ) ){
            return;
        }
        
        if( ! wp_verify_nonce( $_POST['Books_author_meta_box_nonce'], 'Books_save_author_data') ) {
            return;
        }
        
        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
            return;
        }
        
        if( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if( ! isset( $_POST['Books_author_field'] ) ) {
            return;
        }
        
        $my_data = sanitize_text_field( $_POST['Books_author_field'] );
        
        update_post_meta( $post_id, '_author_value_key', $my_data );
        
    }
    
    add_action('add_meta_boxes', 'Books_author_add_meta_box');
    add_action('save_post', 'Books_save_author_data');


/**** MetaBox pages ****/
function Books_pages_add_meta_box() {
    add_meta_box( 'book_pages', 'Pages', 'Books_pages_callback', 'Books', 'normal', 'high' );
}
function Books_pages_callback( $post ) {
    wp_nonce_field( 'Books_save_pages_data', 'Books_pages_meta_box_nonce' );
    
    $value = get_post_meta( $post->ID, '_pages_value_key', true );
    
    echo '<label for="Books_pages_field">Page Number: </label>';
    echo '<input type="number" id="Books_pages_field" name="Books_pages_field" value="' . esc_attr( $value ) . '" size="5" />';
}
function Books_save_pages_data( $post_id ) {
    
    if( ! isset( $_POST['Books_pages_meta_box_nonce'] ) ){
        return;
    }
    
    if( ! wp_verify_nonce( $_POST['Books_pages_meta_box_nonce'], 'Books_save_pages_data') ) {
        return;
    }
    
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if( ! isset( $_POST['Books_pages_field'] ) ) {
        return;
    }
    
    $my_data = sanitize_text_field( $_POST['Books_pages_field'] );
    
    update_post_meta( $post_id, '_pages_value_key', $my_data );
    
}

add_action('add_meta_boxes', 'Books_pages_add_meta_box');
add_action('save_post', 'Books_save_pages_data');
add_theme_support( 'post-thumbnails' );      //Theme support for featured image to all post types.



/**** MetaBox Language ****/
function Books_language_add_meta_box() {
    add_meta_box( 'book_language', 'Language', 'Books_language_callback', 'Books', 'normal', 'high' );
}
function Books_language_callback( $post ) {
    wp_nonce_field( 'Books_save_language_data', 'Books_language_meta_box_nonce' );
    
    $value = get_post_meta( $post->ID, '_language_value_key', true );
    
    echo '<label for="Books_language_field">Language: </label>';
    echo '<input type="text" id="Books_language_field" name="Books_language_field" value="' . esc_attr( $value ) . '" size="15" />';
}
function Books_save_language_data( $post_id ) {
    
    if( ! isset( $_POST['Books_language_meta_box_nonce'] ) ){
        return;
    }
    
    if( ! wp_verify_nonce( $_POST['Books_language_meta_box_nonce'], 'Books_save_language_data') ) {
        return;
    }
    
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if( ! isset( $_POST['Books_language_field'] ) ) {
        return;
    }
    
    $my_data = sanitize_text_field( $_POST['Books_language_field'] );
    
    update_post_meta( $post_id, '_language_value_key', $my_data );
    
}

add_action('add_meta_boxes', 'Books_language_add_meta_box');
add_action('save_post', 'Books_save_language_data');


/**** MetaBox category ****/
function Books_category_add_meta_box() {
    add_meta_box( 'book_category', 'Category', 'Books_category_callback', 'Books', 'normal', 'high' );
}
function Books_category_callback( $post ) {
    wp_nonce_field( 'Books_save_category_data', 'Books_category_meta_box_nonce' );
    
    $value = get_post_meta( $post->ID, '_category_value_key', true );
    
    echo '<label for="Books_category_field">Category: </label>';
    echo '<input type="text" id="Books_category_field" name="Books_category_field" value="' . esc_attr( $value ) . '" size="30" />';
}
function Books_save_category_data( $post_id ) {
    
    if( ! isset( $_POST['Books_category_meta_box_nonce'] ) ){
        return;
    }
    
    if( ! wp_verify_nonce( $_POST['Books_category_meta_box_nonce'], 'Books_save_category_data') ) {
        return;
    }
    
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if( ! isset( $_POST['Books_category_field'] ) ) {
        return;
    }
    
    $my_data = sanitize_text_field( $_POST['Books_category_field'] );
    
    update_post_meta( $post_id, '_category_value_key', $my_data );
    
}

add_action('add_meta_boxes', 'Books_category_add_meta_box');
add_action('save_post', 'Books_save_category_data');


/**** MetaBox ISBN ****/
function Books_ISBN_add_meta_box() {
    add_meta_box( 'book_ISBN', 'ISBN', 'Books_ISBN_callback', 'Books', 'normal', 'high' );
}
function Books_ISBN_callback( $post ) {
    wp_nonce_field( 'Books_save_ISBN_data', 'Books_ISBN_meta_box_nonce' );
    
    $value = get_post_meta( $post->ID, '_ISBN_value_key', true );
    
    echo '<label for="Books_ISBN_field">ISBN: </label>';
    echo '<input type="number" id="Books_ISBN_field" name="Books_ISBN_field" value="' . esc_attr( $value ) . '" size="20" />';
}
function Books_save_ISBN_data( $post_id ) {
    
    if( ! isset( $_POST['Books_ISBN_meta_box_nonce'] ) ){
        return;
    }
    
    if( ! wp_verify_nonce( $_POST['Books_ISBN_meta_box_nonce'], 'Books_save_ISBN_data') ) {
        return;
    }
    
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if( ! isset( $_POST['Books_ISBN_field'] ) ) {
        return;
    }
    
    $my_data = sanitize_text_field( $_POST['Books_ISBN_field'] );
    
    update_post_meta( $post_id, '_ISBN_value_key', $my_data );
    
}

add_action('add_meta_boxes', 'Books_ISBN_add_meta_box');
add_action('save_post', 'Books_save_ISBN_data');


/************ Taxonomies for Books ***********/

 
// create a custom taxonomy name it "type" for your posts
function Books_custom_taxonomy() {
 
  $labels = array(
    'name' => 'Genres',
    'singular_name' => 'Genre',
    'search_items' =>  'Search Genres',
    'all_items' => 'All Genres' ,
    'parent_item' => 'Parent Genre' ,
    'parent_item_colon' => 'Parent Genre:' ,
    'edit_item' => 'Edit Genre' , 
    'update_item' => 'Update Genre' ,
    'add_new_item' => 'Add New Genre' ,
    'new_item_name' => 'New Genre Name' ,
    'menu_name' => 'Genre'
  ); 	
 
  register_taxonomy('genre',array('books'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genre' )
  ));
}

add_action( 'init', 'Books_custom_taxonomy' );