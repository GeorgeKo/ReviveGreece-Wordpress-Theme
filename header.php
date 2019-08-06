<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>

        <title><?php my_title(); ?> &mdash; <?php bloginfo( 'name' ) ?></title>
        <meta charset="UTF-8">

        <?php wp_head(); ?>

    </head>
    <body <?php body_class( 'myclass' ); ?>>

        <header>
            <div class="header-container">
                <div class="description">
                <h1><?php bloginfo( 'name' ); ?> &mdash; <?php bloginfo( 'description' );?></h1>
                </div>
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-navigation',
                        'container'      => 'div', 
                        'menu_class'     => 'main-navigation', 
                        'menu_id'        => 'main-navigation'
                    ));
                ?>
            </div>
        </header>

        <div class="main-container">
            <main>