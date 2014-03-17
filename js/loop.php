<div id="loadpostresult"></div>
<section id='post-container'>

<?php if ( have_posts() ) : ?>

  
	<?php
$size = array( 700, 700 );
$attr = array( 'class' => 'article' );
	while (have_posts()) : the_post();

	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size, false, '' );
			?>
		<div <?php post_class('article'); ?>>
			<article>
				<div id="articleContainer">
					<h2><a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p><?php the_excerpt() ?></p>
				</div>
			</article>
			<div class="imageContainer">
				<?php 
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'m1024', true);
					//echo $image_url[0];
				?>
				<a class="lazyload" href="<?php the_permalink() ?>" alt="<?php the_title(); ?>" style="background: transparent url('<?php echo $image_url[0]; ?>') no-repeat; background-size:cover; background-position: 50% 50%"><div class="innershadow" style="width:100%;height:100%;"></div>
				</a>
			</div>
			<p class="suite link"><a href="<?php the_permalink() ?>">Lire la suite</a></p><p class="partage link"><a href="">Partager cet article</a></p>
			</div>

			  <?php
	endwhile; ?>

<?php endif; ?>
<?php get_template_part('pagination'); ?>
</section>	
<?php if (is_category()) :?>
<script>
jQuery('.nav').css({'height':'84px'});
</script>
<?php endif;?>