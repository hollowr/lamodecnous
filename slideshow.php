<?php
    $args = array(
        'meta_key' => 'sgt_slide',
        'meta_value' => 'on',
        'numberposts' => -1,
        );
    $slides = get_posts($args);

    if ( !empty($slides) ) : $exl_posts = Array(); ?>

        <div class="slideshow"><div id="slideshow">

        <?php foreach( $slides as $post ) :
            setup_postdata($post);
            global $exl_posts;
            $exl_posts[] = $post->ID;


        ?>
        <div class="slide clear">
            <div class="posts">
                <?php if ( has_post_thumbnail() )
                    $slider_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'taille-slider');
                    echo '<a href="'.get_permalink().'" style="background:transparent url(' . $slider_image_url[0] . ') no-repeat; background-position: 50% 50%;  background-size: cover;" alt="'.trim(strip_tags( $post->post_title )).'"  title="'.trim(strip_tags( $post->post_title )).'"></a>';
                ?>
                <div class="fullsize" style="">
                    <?php $category = get_the_category();?>
                    <span class="slidecat" style=""><?php echo $category[1]->cat_name; ?></span>
                    <h2 style="padding:20px 13px;width: 90%;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-content"><?php if ( has_post_thumbnail() && function_exists('smart_excerpt') ) smart_excerpt(get_the_excerpt(), 20); else smart_excerpt(get_the_excerpt(), 100); ?></div>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>

        </div>
            <a href="javascript: void(0);" id="larr"></a>
            <a href="javascript: void(0);" id="rarr"></a>
        </div>
    <?php endif; ?>