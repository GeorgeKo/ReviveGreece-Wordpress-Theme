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
<section id="side">
    <aside id="side-left"><?php dynamic_sidebar('sidebar-1'); ?></aside>
    <aside id="side-right"><?php dynamic_sidebar('sidebar-2'); ?></aside>
</section>
<?php get_footer(); ?>