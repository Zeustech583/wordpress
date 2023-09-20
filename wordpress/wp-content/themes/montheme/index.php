<?php get_header(); ?>
<main>
        <h1><?php bloginfo( 'name' ) ?></h1>
        <?php while (have_posts()) : the_post(); ?>
        <article>
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('thumbnail'); ?>
            <h2><?php the_title(); ?></h2>
            </a>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>"> lire la suite  </a>
        </article>
        <?php endwhile; ?>
    </main>
<?php get_footer(); ?>
