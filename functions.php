<?php

    // MY CUSTOM TITLE
    function my_title () {

        if ( is_front_page() || is_singular() ) {
            the_title(); 
        } else {
            wp_title('');
        }

    }



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
        wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/css/normalize.css' );
        wp_enqueue_style( 'structure', get_stylesheet_directory_uri() . '/css/structure.css' );
        wp_enqueue_style( 'header',    get_stylesheet_directory_uri() . '/css/header.css' );
        wp_enqueue_style( 'content',   get_stylesheet_directory_uri() . '/css/content.css' );
        wp_enqueue_style( 'sidebar',   get_stylesheet_directory_uri() . '/css/sidebar.css' );
        wp_enqueue_style( 'footer',    get_stylesheet_directory_uri() . '/css/footer.css' );

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
?>