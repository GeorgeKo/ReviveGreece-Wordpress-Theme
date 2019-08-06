<?php get_header(); ?>

<h1><?php wp_title(''); ?></h1>

<!-- The Loop -->
<?php if ( have_posts() ) : ?>
    <?php while( have_posts() ) : ?>
        <?php the_post(); ?>
        <article class="content">
            <h2><?php the_title(); ?></h2>
            <p class="date">
                <?php the_time('Y M d'); ?>
            </p>
            <?php the_excerpt(); ?>
            <p>
                <a href="<?php the_permalink(); ?>" title="Σύνδεσμος άρθρου">Σύνδεσμος άρθρου</a>
            </p>
            <p>Κατηγορίες</p>
            <?php the_category(); ?>
            <p>
                <?php the_tags(); ?>
            </p>
        </article>
    <?php endwhile; ?>
<?php endif; ?>
<!-- End Of Loop -->

<?php get_footer(); ?>