<?php

/*** Theme setup ***/
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
function lamodecnous_setup() {
	add_image_size( 'mini-thumbnail', '80', '100', true );
	add_image_size( 'taille-slider', '1480', '1100', false );
	add_image_size( 'article', '1480', '1500', false );
	add_image_size( 'articlemobile', '300', '220', false );
	add_image_size( 'm1024', '1024', '800', true );
	add_image_size( 'slide', '1480', '800', true );
	add_image_size( 'single-post-thumbnail', 600, 600, false );
	update_option( 'paging_mode', 'default' );
}
function twitterFollowers() {
	require_once('TwitterAPIExchange.php'); //get it from https://github.com/J7mbo/twitter-api-php

	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
	'oauth_access_token' => "218284407-xEwPIJ2ph2yEiYQjwnUxBII0GQmAOCo8DAtMOJUR",
	'oauth_access_token_secret' => "7wbTuBnvY973hdXibhA9r8fozkCi7grrPR8xlm72o",
	'consumer_key' => "jVRroe32b7qUDB0Orq7yjA",
	'consumer_secret' => "zwnZ1iV8oIci8TyEjjdYAKJ8Rvobdevm92Ja05ok"
	);

	$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=lamodecnous';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$follow_count=$twitter->setGetfield($getfield)
	->buildOauth($ta_url, $requestMethod)
	->performRequest();
	$data = json_decode($follow_count, true);
	$followers_count=$data[0]['user']['followers_count'];
	echo $followers_count;
}

function get_tweets($url) {
 
    $json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
    $json = json_decode($json_string, true);
    if (isset($json['count'])){
 		echo intval( $json['count'] );
 	} else {
 		echo '0';
 	}
}


function fanpageLikes() {
	$json_string = file_get_contents('https://graph.facebook.com/147096955352121?access_token=108396566262|sQT8YSQC8zpgyd_wbcxtThxLH_g');
	$json = json_decode($json_string, true);
	if (isset($json['likes'])){
 		echo intval( $json['likes'] );
 	} else {
 		echo '0';
 	}
}

function get_likes($url) {

$json_string = file_get_contents('http://graph.facebook.com/?ids=?ids=' . rawurlencode($url));
$json = json_decode($json_string, true);

$total_count = 0;

if (isset($json[$url]['shares'])) $total_count += intval($json[$url]['shares']);
if (isset($json[$url]['likes'])) $total_count += intval($json[$url]['likes']);

echo $total_count;
}
/*** Navigation ***/

if ( !is_nav_menu('Navigation') || !is_nav_menu('Top menu') ) {
	$menu_id1 = wp_create_nav_menu('Navigation');
	$menu_id2 = wp_create_nav_menu('Top menu');
	wp_update_nav_menu_item($menu_id1, 1);
	wp_update_nav_menu_item($menu_id2, 1);
}

class description_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$prepend = '<strong>';
		$append = '</strong>';
		$description = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		if($depth != 0)
			{
				$description = $append = $prepend = "";
			}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
remove_filter('nav_menu_description', 'strip_tags');

/*** Slideshow ***/

$prefix = 'sgt_';

$meta_box = array(
	'id' => 'slide',
	'title' => 'Slideshow Options',
	'page' => 'post',
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' => 'Show in slideshow',
			'id' => $prefix . 'slide',
			'type' => 'checkbox'
		)
	)
);
add_action('admin_menu', 'lamodecnous_add_box');

// Add meta box
function lamodecnous_add_box() {
	global $meta_box;

	add_meta_box($meta_box['id'], $meta_box['title'], 'lamodecnous_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function lamodecnous_show_box() {
	global $meta_box, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="lamodecnous_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:50%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
		echo     '<td>',
			'</tr>';
	}

	echo '</table>';
}

add_action('save_post', 'lamodecnous_save_data');

// Save data from meta box
function lamodecnous_save_data($post_id) {
	global $meta_box;

	// verify nonce
	if (!wp_verify_nonce($_POST['lamodecnous_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

/*** Options ***/

function options_admin_menu() {
	// here's where we add our theme options page link to the dashboard sidebar
	add_theme_page("lamodecnous Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), 'options_page');
}
add_action('admin_menu', 'options_admin_menu');

function options_page() {
	if ( $_POST['update_options'] == 'true' ) { options_update(); }  //check options update
	?>
	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br /></div>
		<h2>lamodecnous Theme Options</h2>

		<form method="post" action="">
			<input type="hidden" name="update_options" value="true" />

			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="logo_url"><?php _e('Custom logo URL:'); ?></label></th>
					<td><input type="text" name="logo_url" id="logo_url" size="50" value="<?php echo get_option('logo_url'); ?>"/><br/><span
							class="description"> <a href="<?php bloginfo("url"); ?>/wp-admin/media-new.php" target="_blank">Upload your logo</a> (max 500px x 500px) using WordPress Media Library and insert its URL here </span><br/><br/><img src="<?php echo (get_option('logo_url')) ? get_option('logo_url') : bloginfo('template_url') . '/images/logo.png' ?>"
					 alt=""/></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="bg_color"><?php _e('Custom background color:'); ?></label></th>
					<td><input type="text" name="bg_color" id="bg_color" size="20" value="<?php echo get_option('bg_color'); ?>"/><span
							class="description"> e.g., <strong>#27292a</strong> or <strong>black</strong></span></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ss_disable"><?php _e('Disable slideshow:'); ?></label></th>
					<td><input type="checkbox" name="ss_disable" id="ss_disable" <?php echo (get_option('ss_disable'))? 'checked="checked"' : ''; ?>/></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ss_timeout"><?php _e('Timeout for slideshow (ms):'); ?></label></th>
					<td><input type="text" name="ss_timeout" id="ss_timeout" size="20" value="<?php echo get_option('ss_timeout'); ?>"/><span
							class="description"> e.g., <strong>7000</strong></span></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Pagination:'); ?></label></th>
					<td>
						<input type="radio" name="paging_mode" value="default" <?php echo (get_option('paging_mode') == 'default')? 'checked="checked"' : ''; ?>/><span class="description">WP Page-Navi support</span><br/>
						<input type="radio" name="paging_mode" value="infiniteScroll" <?php echo (get_option('paging_mode') == 'infiniteScroll')? 'checked="checked"' : ''; ?>/><span class="description">Infinite Scroll</span><br/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="ga"><?php _e('Google Analytics code:'); ?></label></th>
					<td><textarea name="ga" id="ga" cols="48" rows="18"><?php echo get_option('ga'); ?></textarea></td>
				</tr>
			</table>

			<p><input type="submit" value="Save Changes" class="button button-primary" /></p>
		</form>
	</div>
<?php
}

// Update options

function options_update() {
	update_option('logo_url', $_POST['logo_url']);
	update_option('bg_color', $_POST['bg_color']);
	update_option('ss_disable', $_POST['ss_disable']);
	update_option('ss_timeout', $_POST['ss_timeout']);
	update_option('paging_mode', $_POST['paging_mode']);
	update_option('ga', stripslashes_deep($_POST['ga']));
}

/*** Widgets ***/

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'=>'Site description',
		'before_widget' => '<div class="site-description">',
		'after_widget' => '</div>'
	));
	register_sidebar(array(
		'name'=>'Sidebar',
		'before_widget' => '<div id="%1$s" class="%2$s widget">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="widget-body clear">'
	));
	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 3',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

class GetConnected extends WP_Widget {

	function GetConnected() {
		parent::WP_Widget(false, $name = 'lamodecnous Social Links');
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		?>
			<?php echo $before_widget; ?>
				<?php if ( $title )
					echo $before_title . $title . $after_title;  else echo '<div class="widget-body clear">'; ?>

					<!-- RSS -->
					<div class="getconnected_rss">
					<a href="<?php echo ( get_option('feedburner_url') )? get_option('feedburner_url') : bloginfo('rss2_url'); ?>">RSS Feed</a>
					<?php echo (get_option('feedburner_url') && function_exists('feedcount'))? feedcount( get_option('feedburner_url') ) : ''; ?>
					</div>
					<!-- /RSS -->

					<!-- Twitter -->
					<?php if ( get_option('twitter_url') ) : ?>
					<div class="getconnected_twitter">
					<a href="<?php echo get_option('twitter_url'); ?>">Twitter</a>
					<span><?php if ( function_exists('twittercount') ) twittercount( get_option('twitter_url') ); ?> followers</span>
					</div>
					<?php endif; ?>
					<!-- /Twitter -->

					<!-- Facebook -->
					<?php if ( get_option('fb_url') ) : ?>
					<div class="getconnected_fb">
					<a href="<?php echo get_option('fb_url'); ?>">Facebook</a>
					<span><?php echo get_option('fb_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Facebook -->

					<!-- Flickr -->
					<?php if ( get_option('flickr_url') ) : ?>
					<div class="getconnected_flickr">
					<a href="<?php echo get_option('flickr_url'); ?>">Flickr group</a>
					<span><?php echo get_option('flickr_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Flickr -->

					<!-- Behance -->
					<?php if ( get_option('behance_url') ) : ?>
					<div class="getconnected_behance">
					<a href="<?php echo get_option('behance_url'); ?>">Behance</a>
					<span><?php echo get_option('behance_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Behance -->

					<!-- Delicious -->
					<?php if ( get_option('delicious_url') ) : ?>
					<div class="getconnected_delicious">
					<a href="<?php echo get_option('delicious_url'); ?>">Delicious</a>
					<span><?php echo get_option('delicious_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Delicious -->

					<!-- Stumbleupon -->
					<?php if ( get_option('stumbleupon_url') ) : ?>
					<div class="getconnected_stumbleupon">
					<a href="<?php echo get_option('stumbleupon_url'); ?>">Stumbleupon</a>
					<span><?php echo get_option('stumbleupon_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Stumbleupon -->

					<!-- Tumblr -->
					<?php if ( get_option('tumblr_url') ) : ?>
					<div class="getconnected_tumblr">
					<a href="<?php echo get_option('tumblr_url'); ?>">Tumblr</a>
					<span><?php echo get_option('tumblr_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Tumblr -->

					<!-- Vimeo -->
					<?php if ( get_option('vimeo_url') ) : ?>
					<div class="getconnected_vimeo">
					<a href="<?php echo get_option('vimeo_url'); ?>">Vimeo</a>
					<span><?php echo get_option('vimeo_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Vimeo -->

					<!-- Youtube -->
					<?php if ( get_option('youtube_url') ) : ?>
					<div class="getconnected_youtube">
					<a href="<?php echo get_option('youtube_url'); ?>">Youtube</a>
					<span><?php echo get_option('youtube_text'); ?></span>
					</div>
					<?php endif; ?>
					<!-- /Youtube -->

			<?php echo $after_widget; ?>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		update_option('feedburner_url', $_POST['feedburner_url']);
		update_option('twitter_url', $_POST['twitter_url']);
		update_option('fb_url', $_POST['fb_url']);
		update_option('flickr_url', $_POST['flickr_url']);
		update_option('behance_url', $_POST['behance_url']);
		update_option('delicious_url', $_POST['delicious_url']);
		update_option('stumbleupon_url', $_POST['stumbleupon_url']);
		update_option('tumblr_url', $_POST['tumblr_url']);
		update_option('vimeo_url', $_POST['vimeo_url']);
		update_option('youtube_url', $_POST['youtube_url']);

		update_option('fb_text', $_POST['fb_text']);
		update_option('flickr_text', $_POST['flickr_text']);
		update_option('behance_text', $_POST['behance_text']);
		update_option('delicious_text', $_POST['delicious_text']);
		update_option('stumbleupon_text', $_POST['stumbleupon_text']);
		update_option('tumblr_text', $_POST['tumblr_text']);
		update_option('vimeo_text', $_POST['vimeo_text']);
		update_option('youtube_text', $_POST['youtube_text']);

		return $instance;
	}

	function form($instance) {

		$title = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

			<script type="text/javascript">
				(function($) {
					$(function() {
						$('.social_options').hide();
						$('.social_title').toggle(
							function(){ $(this).next().slideDown(100) },
							function(){ $(this).next().slideUp(100) }
						);
					})
				})(jQuery)
			</script>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">FeedBurner</a>
				<p class="social_options">
					<label for="feedburner_url"><?php _e('FeedBurner feed url:'); ?></label>
					<input type="text" name="feedburner_url" id="feedburner_url" class="widefat"
						   value="<?php echo get_option('feedburner_url'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Twitter</a>
				<p class="social_options">
					<label for="twitter_url">Profile url:</label>
					<input type="text" name="twitter_url" id="twitter_url" class="widefat" value="<?php echo get_option('twitter_url'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Facebook</a>
				<p class="social_options">
					<label for="fb_url">Profile url:</label>
					<input type="text" name="fb_url" id="fb_url" class="widefat" value="<?php echo get_option('fb_url'); ?>"/>
					<label for="fb_text">Description:</label>
					<input type="text" name="fb_text" id="fb_text" class="widefat" value="<?php echo get_option('fb_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Flickr</a>
				<p class="social_options">
					<label for="flickr_url">Profile url:</label>
					<input type="text" name="flickr_url" id="flickr_url" class="widefat" value="<?php echo get_option('flickr_url'); ?>"/>
					<label for="flickr_text">Description:</label>
					<input type="text" name="flickr_text" id="flickr_text" class="widefat" value="<?php echo get_option('flickr_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Behance</a>
				<p class="social_options">
					<label for="behance_url">Profile url:</label>
					<input type="text" name="behance_url" id="behance_url" class="widefat" value="<?php echo get_option('behance_url'); ?>"/>
					<label for="behance_text">Description:</label>
					<input type="text" name="behance_text" id="behance_text" class="widefat" value="<?php echo get_option('behance_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Delicious</a>
				<p class="social_options">
					<label for="delicious_url">Profile url:</label>
					<input type="text" name="delicious_url" id="delicious_url" class="widefat" value="<?php echo get_option('delicious_url'); ?>"/>
					<label for="delicious_text">Description:</label>
					<input type="text" name="delicious_text" id="delicious_text" class="widefat" value="<?php echo get_option('delicious_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Stumbleupon</a>
				<p class="social_options">
					<label for="stumbleupon_url">Profile url:</label>
					<input type="text" name="stumbleupon_url" id="stumbleupon_url" class="widefat" value="<?php echo get_option('stumbleupon_url'); ?>"/>
					<label for="stumbleupon_text">Description:</label>
					<input type="text" name="stumbleupon_text" id="stumbleupon_text" class="widefat" value="<?php echo get_option('stumbleupon_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Tumblr</a>
				<p class="social_options">
					<label for="tumblr_url">Profile url:</label>
					<input type="text" name="tumblr_url" id="tumblr_url" class="widefat" value="<?php echo get_option('tumblr_url'); ?>"/>
					<label for="tumblr_text">Description:</label>
					<input type="text" name="tumblr_text" id="tumblr_text" class="widefat" value="<?php echo get_option('tumblr_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Vimeo</a>
				<p class="social_options">
					<label for="vimeo_url">Profile url:</label>
					<input type="text" name="vimeo_url" id="vimeo_url" class="widefat" value="<?php echo get_option('vimeo_url'); ?>"/>
					<label for="vimeo_text">Description:</label>
					<input type="text" name="vimeo_text" id="vimeo_text" class="widefat" value="<?php echo get_option('vimeo_text'); ?>"/>
				</p>
			</div>

			<div style="margin-bottom: 5px;">
				<a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Youtube</a>
				<p class="social_options">
					<label for="youtube_url">Profile url:</label>
					<input type="text" name="youtube_url" id="youtube_url" class="widefat" value="<?php echo get_option('youtube_url'); ?>"/>
					<label for="youtube_text">Description:</label>
					<input type="text" name="youtube_text" id="youtube_text" class="widefat" value="<?php echo get_option('youtube_text'); ?>"/>
				</p>
			</div>
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("GetConnected");'));

class Recentposts_thumbnail extends WP_Widget {

	function Recentposts_thumbnail() {
		parent::WP_Widget(false, $name = 'lamodecnous Recent Posts');
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title;  else echo '<div class="widget-body clear">'; ?>

			<?php
				global $post;
				if (get_option('rpthumb_qty')) $rpthumb_qty = get_option('rpthumb_qty'); else $rpthumb_qty = 5;
				$q_args = array(
					'numberposts' => $rpthumb_qty,
				);
				$rpthumb_posts = get_posts($q_args);
				foreach ( $rpthumb_posts as $post ) :
					setup_postdata($post);
			?>

				<a href="<?php the_permalink(); ?>" class="rpthumb clear">
					<?php if ( has_post_thumbnail() && !get_option('rpthumb_thumb') ) {
						the_post_thumbnail('mini-thumbnail');
						$offset = 'style="padding-left: 65px;"';
					}
					?>
					<span class="rpthumb-title" <?php echo $offset; ?>><?php the_title(); ?></span>
					<span class="rpthumb-date" <?php echo $offset; unset($offset); ?>><?php the_time(__('M j, Y')) ?></span>
				</a>

			<?php endforeach; ?>

			<?php echo $after_widget; ?>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		update_option('rpthumb_qty', $_POST['rpthumb_qty']);
		update_option('rpthumb_thumb', $_POST['rpthumb_thumb']);
		return $instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="rpthumb_qty">Number of posts:  </label><input type="text" name="rpthumb_qty" id="rpthumb_qty" size="2" value="<?php echo get_option('rpthumb_qty'); ?>"/></p>
			<p><label for="rpthumb_thumb">Hide thumbnails:  </label><input type="checkbox" name="rpthumb_thumb" id="rpthumb_thumb" <?php echo (get_option('rpthumb_thumb'))? 'checked="checked"' : ''; ?>/></p>
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("Recentposts_thumbnail");'));

/*** Comments ***/

function commentslist($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li>
		<div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<table>
				<tr>
					<td>
						<?php echo get_avatar($comment, 70, bloginfo('template_url').'/images/no-avatar.png'); ?>
					</td>
					<td>
						<div class="comment-meta">
							<?php printf(__('<p class="comment-author"><span>%s</span> says:</p>'), get_comment_author_link()) ?>
							<?php printf(__('<p class="comment-date">%s</p>'), get_comment_date('M j, Y')) ?>
							<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						</div>
					</td>
					<td>
						<div class="comment-text">
							<?php if ($comment->comment_approved == '0') : ?>
								<p><?php _e('Your comment is awaiting moderation.') ?></p>
								<br/>
							<?php endif; ?>
							<?php comment_text() ?>
						</div>
					</td>
				</tr>
			</table>
		 </div>
<?php
}

/*** Misc ***/

function feedcount($feedurl='http://feeds.feedburner.com/lamodecnous') {
	$feedid = explode('/', $feedurl);
	$feedid = end($feedid);
	$twodayago = date('Y-m-d', strtotime('-2 days', time()));
	$onedayago = date('Y-m-d', strtotime('-1 days', time()));
	$today = date('Y-m-d');

	$api = "https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=$feedid&dates=$twodayago,$onedayago";

	//Initialize a cURL session
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $api);
	$data = curl_exec($ch);
	$base_code = curl_getinfo($ch);
	curl_close($ch);

	if ($base_code['http_code']=='401'){
		$burner_count_circulation = 'This feed does not permit Awareness API access';
		$burner_date = $today;
	} else {

		$xml = new SimpleXMLElement($data); //Parse XML via SimpleXML Class
		$bis = $xml->attributes();  //Bis Contain first attribute, It usually is ok or fail in FeedBurner

		if ($bis=='ok'){
			foreach ($xml->feed as $feed) {
				if ($feed->entry[1]['circulation']=='0'){
					$burner_count_circulation = $feed->entry[0]['circulation'];
					$burner_date  =  $feed->entry[0]['date'];
				} else {
					$burner_count_circulation = $feed->entry[1]['circulation'];
					$burner_date  =  $feed->entry[1]['date'];
				}
			}
		}

		if ($bis=='fail'){
			switch ($xml->err['code']) {
				case 1:
					$burner_count_circulation = 'Feed Not Found';
					break;
				case 5:
					$burner_count_circulation = 'Missing required parameter (URI)';
					break;
				case 6:
					$burner_count_circulation = 'Malformed parameter (DATES)';
					break;
			}
			$burner_date = $today;
		}

	}
	if ( $bis != 'fail' && $burner_count_circulation != '' ) {
		echo '<span>'.$burner_count_circulation.' readers</span>';
	} else {
		echo '<span>'.$burner_count_circulation.'</span>';
	}
}

function twittercount($twitter_url='http://twitter.com/lamodecnous') {
	$twitterid = explode('/', $twitter_url);
	$twitterid = end($twitterid);
	$xml = @simplexml_load_file("http://twitter.com/users/show.xml?screen_name=$twitterid");
	echo $xml[0]->followers_count;
}

function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

function new_excerpt_length($length) {
	return 10;
}
add_filter('excerpt_length', 'new_excerpt_length');
function trim_excerpt($text) {
	return rtrim($text,'[Translate]');
}
//add_filter('get_the_excerpt', 'trim_excerpt');

function custom_wp_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		//Retrieve the post content.
		$text = get_the_content('');

		//Delete all shortcode tags from the content.
		$text = strip_shortcodes( $text );

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text);
		$allowed_tags = ''; /*** MODIFY THIS. Add the allowed HTML tags separated by a comma.***/
		$text = strip_tags($text, $allowed_tags);

		$excerpt_word_count = 5; /*** MODIFY THIS. change the excerpt word count to any integer you like.***/
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);

		/***$excerpt_end = '[...]';  MODIFY THIS. change the excerpt endind to something else.***/
		$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');


function getTinyUrl($url) {
	$tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
	return $tinyurl;
}

function smart_excerpt($string, $limit) {
	$dots = '';
	$words = explode(" ",$string);
	if ( count($words) >= $limit) $dots = '...';
	echo implode(" ",array_splice($words,0,$limit)).$dots;
}

function comments_link_attributes(){
	return 'class="comments_popup_link"';
}
add_filter('comments_popup_link_attributes', 'comments_link_attributes');

function next_posts_attributes(){
	return 'class="nextpostslink"';
}
add_filter('next_posts_link_attributes', 'next_posts_attributes');
function previous_posts_attributes(){
	return 'class="previouspostslink"';
}
add_filter('previous_posts_link_attributes', 'previous_posts_attributes');
require( get_stylesheet_directory() . '/customizer-boilerplate/customizer.php' );
/**
 * Options array for Theme Customizer Boilerplate
 *
 * @link    https://github.com/slobodan/WordPress-Theme-Customizer-Boilerplate
 * @return  array       Theme options
 */
add_filter( 'thsp_cbp_options_array', 'thsp_theme_options_array', 1 );
function thsp_theme_options_array() {
	// Using Customizer Boilerplate helper function to get default required capability
	$thsp_cbp_capability = thsp_cbp_capability();

	$options = array(
		// Section ID
		'thsp_typography_section' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Typography', 'cazuela' ),
				'description' => __( 'Select fonts', 'cazuela' ),
				'priority' => 20
			),
			'fields' => array(
				'body_font' => array(
					'setting_args' => array(
						'default' => 'open-sans',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args
					'control_args' => array(
						'label' => __( 'Body font', 'cazuela' ),
						'type' => 'select', // Select control
						'choices' => array(
							'arial' => array(
								'label' => 'Arial'
							),
							'open-sans' => array(
								'label' => 'Open Sans',
								'google_font' => 'Open+Sans:400italic,700italic,400,700'
							),
							'pt-sans' => array(
								'label' => 'PT Sans',
								'google_font' => 'PT+Sans:400,700,400italic,700italic'
							)
						),
						'priority' => 1
					) // End control args
				),
				'heading_font' => array(
					'setting_args' => array(
						'default' => 'open-sans',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					), // End setting args
					'control_args' => array(
						'label' => __( 'Heading font', 'cazuela' ),
						'type' => 'select', // Select control
						'choices' => array(
							'georgia' => array(
								'label' => 'Georgia'
							),
							'open-sans' => array(
								'label' => 'Open Sans',
								'google_font' => 'Open+Sans:400italic,700italic,400,700'
							),
							'droid-serif' => array(
								'label' => 'Droid Serif',
								'google_font' => 'Droid+Serif:700'
							)
						),
						'priority' => 2
					) // End control args
				),
			) // End fields
		)
	);

	return $options;
}
/**
* Passes custom typography classes to Tiny MCE editor
*
* @param    $thsp_mceInit                       array
* @uses thsp_cbp_get_options_values()       helper function defined in /customizer-boilerplate/helpers.php
* @return   $thsp_mceInit                       array
*/
function thsp_tiny_mce_classes( $thsp_mceInit ) {
	// Use Theme Customizer Boilerplate helper function to retrieve theme options
	$thsp_theme_options = thsp_cbp_get_options_values();

	/**
	 * $thsp_mceInit array stores its body classes as a string
	 *
	 * Whitespace character is used as separator between classes,
	 * so when adding classes they must have a space before them
	 */
	$thsp_mceInit['body_class'] .= ' body-' . $thsp_theme_options['body_font'];         // Body font class
	$thsp_mceInit['body_class'] .= ' heading-' . $thsp_theme_options['heading_font'];   // Heading font class

	return $thsp_mceInit;
}
add_filter( 'tiny_mce_before_init', 'thsp_tiny_mce_classes' );

/**
 * Load Google Fonts to use in Tiny MCE
 *
 * @param   $mce_css                            string
 * @uses    thsp_cbp_get_options_values()       defined in /customizer-boilerplate/helpers.php
 * @uses    thsp_cbp_get_fields()               defined in /customizer-boilerplate/helpers.php
 * @return  $mce_css                            string
 */
function thsp_mce_css( $mce_css ) {
	$theme_options = thsp_cbp_get_options_values();
	$theme_options_fields = thsp_cbp_get_fields();

	// Using Theme Customizer Boilerplate to retrieve theme font options values
	$body_font_value = $theme_options['body_font'];
	$heading_font_value = $theme_options['heading_font'];

	// Using Theme Customizer Boilerplate to retrieve all theme options
	$body_font_options = $theme_options_fields['thsp_typography_section']['fields']['body_font']['control_args']['choices'];
	$heading_font_options = $theme_options_fields['thsp_typography_section']['fields']['heading_font']['control_args']['choices'];

	// Check protocol
	$protocol = is_ssl() ? 'https' : 'http';

	// Check if it's a Google Font
	if ( isset( $body_font_options[$body_font_value]['google_font'] ) ) {
		// Commas must be HTML encoded
		$body_font_string = str_replace( ',', ',', $body_font_options[$body_font_value]['google_font'] );
		$mce_css .= ', ' . $protocol . '://fonts.googleapis.com/css?family=' . $body_font_string;
	}
	// Check if it's a Google Font
	if ( isset( $heading_font_options[$heading_font_value]['google_font'] ) ) {
		// Commas must be HTML encoded
		$heading_font_string = str_replace( ',', ',', $heading_font_options[$heading_font_value]['google_font'] );
		$mce_css .= ', ' . $protocol . '://fonts.googleapis.com/css?family=' . $heading_font_string;
	}

	return $mce_css;
}
if (!is_single()) {
function custom_theme_js(){
	wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'),null,true );
	if( ! is_singular() ) {
		wp_enqueue_script('infinite_scroll');
	}
}
//add_action('wp_enqueue_scripts', 'custom_theme_js');
}



function custom_infinite_scroll_js() {
	if( ! is_singular()) { ?>
	<script>
	var infinite_scroll = {
		loading: {
			img: "",
			msgText: "<?php _e( 'Chargement des articles suivant...', 'custom' ); ?>",
			finishedMsg: "<?php _e( 'Derniers articles.', 'custom' ); ?>",
			selector: "#content",
		},
		"nextSelector":".pagination a:first",
		"navSelector":".pagination",
		"itemSelector":".article",
		"contentSelector":"#post-container",
		debug: false,
		animate: true,
		extraScrollPx: 428,
		path: ["/page/","/"]
	};
	jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll, function() {
		easePosts();
		titleSize();
	} );
	</script>
	<?php
	}
}
if (!is_single()) {
	/*add_action( 'wp_footer', 'custom_infinite_scroll_js',100 );*/
}

?>