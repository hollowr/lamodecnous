<?php if (get_option('paging_mode') == 'default') : ?>
    <section class="pagination">
        
        <?php next_posts_link(__('Articles anciens')); ?>
        <?php previous_posts_link(__('Articles récents')); ?>
        <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); ?>
    </section>
    <?php else : ?>
    

<?php endif; ?>