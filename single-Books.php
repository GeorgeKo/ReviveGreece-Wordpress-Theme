<?php get_header()?>

        <!-- The Loop -->
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <article class="content">
                <h1 class="book-title"><?php the_title(); ?></h1>
                <img class="book-cover" src="<?php the_post_thumbnail_url();?>" alt="<?php the_post_thumbnail_caption();?>">
                <main> <?php the_content(); ?> </main>
                <details>
                    <p>Συγγραφέας: <?php echo get_post_meta( get_the_ID(), '_author_value_key', true ); ?></p>
                    <p>Αριθμός σελίδων: <?php echo get_post_meta( get_the_ID(), '_pages_value_key', true ); ?></p>
                    <p>Γλώσσα: <?php echo get_post_meta( get_the_ID(), '_language_value_key', true ); ?></p>
                    <p>Κατηγορία: <?php echo get_post_meta( get_the_ID(), '_category_value_key', true ); ?></p>
                    <p>ISBN: <?php echo get_post_meta( get_the_ID(), '_ISBN_value_key', true ); ?></p>
                </details>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
    <!-- End Of Loop -->

<?php get_footer()?>
