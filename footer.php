    
            </main>

<!-- <?php get_sidebar(); ?> -->

</div>

<footer>
<div class="footer-container">
    <?php
        wp_nav_menu( array(
            'theme_location' => 'footer-navigation',
            'container'      => 'div', 
            'menu_class'     => 'footer-navigation', 
            'menu_id'        => 'footer-navigation'
        ));
    ?>
</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>