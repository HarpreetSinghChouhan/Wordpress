<?php

/**
 * Template Name: News Template
 */
get_header();
$search_query = get_search_query();
$args = array(
    'post_type'      => 'news',
    'posts_per_page' => 3,
    's' => $search_query
);

$news_query = new WP_Query($args);
?>

<main>
    <h1>Main News Template</h1>
    <form method="get" style="float: endk;" >
        <input type="text" name="s" style="width: 400px;" placeholder="Search news..." value="<?php echo esc_attr($search_query); ?>">
        <button type="submit">Search</button>
    </form>
    <?php if ($news_query->have_posts()) : ?>

        <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
             <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
        <?php endwhile; ?>

        <?php wp_reset_postdata(); // Always reset after custom query 
        ?>

    <?php else : ?>
        <p>No news found.</p>
    <?php endif; ?>

</main>

<?php //get_footer(); 
?>