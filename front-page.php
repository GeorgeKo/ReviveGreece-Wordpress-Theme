<?php

get_header();
?>
<section id="welcome-text">

    <!-- The Loop -->
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article class="content">
                <?php the_content(); ?>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
    <!-- End Of Loop -->

</section>
<?php get_sidebar(); ?>
<?php
get_footer();
?>