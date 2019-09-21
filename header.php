<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <title><?php my_title(); ?> &mdash; <?php bloginfo('name') ?></title>
    <meta charset="UTF-8">

    <?php wp_head(); ?>

</head>

<body <?php body_class('myclass'); ?>>
    <div class="page-container">
        <header>
            <div class="header-container">
                <a class="header-logo" href="<?php echo get_home_url(); ?>"><?php
                                                        $custom_logo_id = get_theme_mod('custom_logo');
                                                        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                                                        ?>
                    <img src="<?php echo $image[0]; ?>" alt="Logo"></a>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-navigation',
                    'container'      => 'div',
                    'menu_class'     => 'main-navigation',
                    'menu_id'        => 'main-navigation'
                ));
                ?>
            </div>
            <div class="search-form"><?php get_search_form(); ?></div>
        </header>

        <div class="main-container">
            <main>
