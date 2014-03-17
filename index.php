<?php get_header(); ?>

<?php query_posts(array(
        'post__not_in' => $exl_posts,
        'paged' => $paged,
    )
); ?>

<?php get_template_part('loop'); ?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>