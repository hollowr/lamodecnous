<?php if ( have_posts() ) : ?> 
	<div id="news">
		<h2>NEWS</h2>
	</div>
<ul class="sidebar">
    <?php query_posts('category_name='.is_category().'&showposts=20'); ?>
    <?php while (have_posts()) : the_post(); ?>
		<?php
		$size = array( 150, 150 );
		$attr = array( 'class' => 'post-thumbnail' );
		 
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'menuSidebar-thumbnail', true);
					//echo $image_url[0];
				
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size, false, '' );
					?>
				<li <?php post_class('article'); ?>>
					<div class="imageContainer">
						<a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>" style="background: transparent url('<?php echo $image_url[0]; ?>') no-repeat; background-size:cover; background-position: 50% 50%"><div class="innershadow" style="width:100%;height:100%;"></div>
						</a>
					</div>
					<article>
						<div id="articleContainer">
							<span class="post-date"><?php the_time(__('j/m/Y')) ?></span>
							<p>
							<h2><?php the_title(); ?></h2>
						</p>
						</div>
					</article>
					
				</li>

					  <?php
			endwhile; ?>
       
</ul>
<?php endif; ?>
<script>
function titleSizeSidebar() {
	jQuery('#articleContainer h2').each(function(i, thisH2) {
		var thisH2 = jQuery(thisH2);

		if (thisH2.text().length > 50) {
			var trimtext = thisH2.text();
			thisH2.html(jQuery.trim(trimtext).substring(0, 40).split(" ").slice(0, -1).join(" ") + "...");
			thisH2.css({"font-size":10});
			
		}
	});
}
titleSizeSidebar()
</script>