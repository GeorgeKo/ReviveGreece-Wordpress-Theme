<?php
get_header();
?>


<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
<div id="container">
    <div id="content" role="main">

        <h1 class="page-title"><?php echo $term->name; ?></h1>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <div class="post type-post hentry">
                    <h2 class="entry-title">
                        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="entry-summary">
                        <p>Κατηγορία: <?php echo get_post_meta(get_the_ID(), '_category_value_key', true); ?></p>
                        <p>Συγγραφέας: <?php echo get_post_meta(get_the_ID(), '_author_value_key', true); ?></p>
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                </div>

            <?php endwhile; ?>
        <?php endif; ?>

    </div><!-- #content -->
</div><!-- #container -->


<?php
get_footer();
?><