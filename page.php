<?php get_header() ?>
<!-- The Loop -->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <article class="content">            
            <?php if (has_post_thumbnail()) : ?>
                <img class="post-img" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>">
            <?php endif; ?>
            
            <main> <?php the_content(); ?> </main>
            <div class="details">
            </div>
        </article>
    <?php endwhile; ?>
<?php endif; ?>
<!-- End Of Loop -->

<?php get_footer() ?>