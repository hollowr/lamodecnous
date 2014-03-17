						</div>


						</div>
						<!-- /Container -->

						<div class="footer">
				<div id="footertop" class='footertop'>
					<span id="inscriptions_newsletter">
						<!--START Scripts : this is the script part you can add to the header of your theme-->
						<script type="text/javascript" src="http://www.lamodecnous.com/wp-includes/js/jquery/jquery.js?ver=2.6.0.8"></script>
						<script type="text/javascript" src="http://www.lamodecnous.com/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-fr.js?ver=2.6.0.8"></script>
						<script type="text/javascript" src="http://www.lamodecnous.com/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.6.0.8"></script>
						<script type="text/javascript" src="http://www.lamodecnous.com/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.0.8"></script>
						<script type="text/javascript">
						                /* <![CDATA[ */
						                var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"http://www.lamodecnous.com/wp-admin/admin-ajax.php","loadingTrans":"Chargement..."};
						                /* ]]> */
						                </script><script type="text/javascript" src="http://www.lamodecnous.com/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.0.8"></script>
						<!--END Scripts-->

						<div class="widget_wysija_cont html_wysija"><div id="msg-form-wysija-html53245a80dbb3b-1" class="wysija-msg ajax"></div><form id="form-wysija-html53245a80dbb3b-1" method="post" action="#wysija" class="widget_wysija html_wysija">
						<p class="wysija-paragraph">
						    <label>Newsletter <span class="wysija-required">*</span></label>
						    
						    	<input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="E-mail"  value="" />
						    
						    
						    
						    <span class="abs-req">
						        <input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
						    </span>
						    <input class="wysija-submit-field" type="submit" value="Je m'abonne !" />
						</p>
						

						    <input type="hidden" name="form_id" value="1" />
						    <input type="hidden" name="action" value="save" />
						    <input type="hidden" name="controller" value="subscribers" />
						    <input type="hidden" value="1" name="wysija-page" />

						    
						        <input type="hidden" name="wysija[user_list][list_ids]" value="1" />
						    
						 </form></div>
						</span>
					<span id="partageplus">PARTAGEONS PLUS</span>
					<span class="backtotop"><?php include ('searchform.php'); ?></span>
				</div>
				<div id="footer">
							<div class="container">
									<div id="footer-sidebar" class="secondary">
<div id="footer-sidebar1">
<?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}
?>
</div>
<div id="footer-sidebar2">
<?php
if(is_active_sidebar('footer-sidebar-2')){
dynamic_sidebar('footer-sidebar-2');
}
?>
</div>
<div id="footer-sidebar3">
<?php
if(is_active_sidebar('footer-sidebar-3')){
dynamic_sidebar('footer-sidebar-3');
}
?>
</div>
</div>
									<div class="footer_column">

												<ul id="facebook">
													<li style="color:white">
													Facebook Fan page Likes <?php fanpageLikes()?>
													</li>
													<li style="color:white">
													Twitter Followers <?php twitterFollowers()?>
													</li>
												</ul>
										</div>

					</div>

				<?php
				//$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
				//if (0 < $numposts) $numposts = number_format($numposts);
				?>
				

						</div>
				</div>
				<!-- Page generated: <?php timer_stop(1); ?> s, <?php echo get_num_queries(); ?> queries -->


				<?php echo (get_option('ga')) ? get_option('ga') : '' ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

	<script src="//use.edgefonts.net/prata:n4:all.js"></script>
        <!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/ie.css" /><![endif]-->
        <?php
			wp_enqueue_script('jquery');
			wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', 'jquery', false);
			wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', 'jquery', false);
            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
		?>
	<?php if ( is_home() && !get_option('ss_disable') ) : ?>
        <script type="text/javascript">
            (function($) {
                $(function() {
                    $('#slideshow').cycle({
                        fx:     'scrollHorz',
                        timeout: <?php echo (get_option('ss_timeout')) ? get_option('ss_timeout') : '7000' ?>,
                        next:   '#rarr',
                        prev:   '#larr'
                    });
                })
            })(jQuery);
        </script>
        <?php endif; ?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script defer type="text/javascript" src="/wp-content/themes/lmcn/js/jquery.scrollto.min.js"></script>
<script defer type="text/javascript" src="/wp-content/themes/lmcn/js/jquery.scrollbox.js"></script>
<script defer type="text/javascript">
/*! jQuery visible 1.0.0 teamdf.com/jquery-plugins | teamdf.com/jquery-plugins/license */
(function(c){c.fn.visible=function(e){var a=c(this),b=c(window),f=b.scrollTop();b=f+b.height();var d=a.offset().top;a=d+a.height();var g=e===true?a:d;return(e===true?d:a)<=b&&g>=f}})(jQuery);
</script>
<!-- History.js -->
<!--<script defer type="text/javascript" src="http://browserstate.github.io/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>-->
<script defer type="text/javascript" src="http://static.zencodez.net/js/jquery.css3finalize-v3.x.min.js"></script>
<!-- This Gist
<script defer type="text/javascript" src="wp-content/themes/lmcn/js/ajaxify-html5.js"></script> -->
<script>


// jQuery(document).ready(function() {
//   jQuery('.menunav').toggle(function() {
//     jQuery('.menunav').animate({height: 250}, 250, 'linear');
//   },function(){
//     jQuery('.menunav').animate({height: 0}, 250, 'linear');
//   })
// });


 /*$( "" ).each(function( index ) {
	var hue = 'rgb(' + (Math.floor((256)*Math.random()) + 50) + ',' + (Math.floor((256)*Math.random()) + 100) + ',' + (Math.floor((256)*Math.random()) + 50) + ')';
		$(this).css("background-color", hue);
});*/

/*$('article').closest('.imageContainer').css({'opacity': .1});*/
</script>
<script type="text/javascript">
var topMenu = jQuery('#menu-top-menu');
var logoMenu = jQuery('.logoMenu');
var logoMenuImg = jQuery('.logoMenu img');
var menuNav = jQuery('#menu-navigation');
var menuSocial = jQuery('#social');
var enableTimer = 0;

/*
 * Listen for a scroll and use that to remove
 * the possibility of hover effects
 */
window.addEventListener('scroll', function() {
  clearTimeout(enableTimer);
  removeHoverClass();

  // enable after 1 second, choose your own value here!
  enableTimer = setTimeout(addHoverClass, 1000);
}, false);
"undefined"==typeof document||"classList"in document.createElement("a")||function(a){"use strict";var b="classList",c="prototype",d=(a.HTMLElement||a.Element)[c],e=Object,f=String[c].trim||function(){return this.replace(/^\s+|\s+$/g,"")},g=Array[c].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1},h=function(a,b){this.name=a,this.code=DOMException[a],this.message=b},i=function(a,b){if(""===b)throw new h("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(b))throw new h("INVALID_CHARACTER_ERR","String contains an invalid character");return g.call(a,b)},j=function(a){for(var b=f.call(a.className),c=b?b.split(/\s+/):[],d=0,e=c.length;e>d;d++)this.push(c[d]);this._updateClassName=function(){a.className=this.toString()}},k=j[c]=[],l=function(){return new j(this)};if(h[c]=Error[c],k.item=function(a){return this[a]||null},k.contains=function(a){return a+="",-1!==i(this,a)},k.add=function(a){a+="",-1===i(this,a)&&(this.push(a),this._updateClassName())},k.remove=function(a){a+="";var b=i(this,a);-1!==b&&(this.splice(b,1),this._updateClassName())},k.toggle=function(a){a+="",-1===i(this,a)?this.add(a):this.remove(a)},k.toString=function(){return this.join(" ")},e.defineProperty){var m={get:l,enumerable:!0,configurable:!0};try{e.defineProperty(d,b,m)}catch(n){-2146823252===n.number&&(m.enumerable=!1,e.defineProperty(d,b,m))}}else e[c].__defineGetter__&&d.__defineGetter__(b,l)}(self);
/**
 * Removes the hover class from the body. Hover styles
 * are reliant on this class being present
 */
function removeHoverClass() {
  document.body.classList.remove('hover');
}

/**
 * Adds the hover class to the body. Hover styles
 * are reliant on this class being present
 */
function addHoverClass() {
  document.body.classList.add('hover');
}
<?php if (!is_single()) : ?>
jQuery(window).bind('scroll', function(event) {
	var topPosition = jQuery('#menu-top').offset().top;
	
	if (jQuery(window).scrollTop() >= topPosition) {
		topMenu.classname += ' fixed';
		menuSocial.classname += ' fixed';
		logoMenu.classname += ' fixedLogo';
		logoMenuImg.fadeIn();
	}
	if (jQuery(window).scrollTop() < topPosition) {
		logoMenuImg.fadeOut();
		topMenu.removeClass('fixed');
		menuSocial.removeClass('fixed');
		logoMenu.removeClass('fixedLogo');
	}
	if (jQuery(window).scrollTop() >= (jQuery('#menu').offset().top+100)) {
		menuNav.classname += ' menunavFixed';
	}
	if (jQuery(window).scrollTop() < (jQuery('#menu').offset().top+100)) {
		menuNav.removeClass('menunavFixed');
	}
});
<?php else : ?>
	jQuery(window).bind('scroll', function(event) {
	var topPosition = jQuery('#menu-top').offset().top;
		
	if (jQuery(window).scrollTop() >= topPosition) {
		topMenu.classname += ' fixed';
		menuSocial.classname += ' fixed';
		logoMenu.classname += ' fixedLogo';
		logoMenuImg.fadeIn();
	}
	if (jQuery(window).scrollTop() < topPosition) {
		logoMenuImg.fadeOut();
		topMenu.removeClass('fixed');
		menuSocial.removeClass('fixed');
		logoMenu.removeClass('fixedLogo');
	}
	if (jQuery(window).scrollTop() >= (jQuery('#menu').offset().top+120)) {
		
	}
	if (jQuery(window).scrollTop() < (jQuery('#menu').offset().top+120)) {
		
	}
});
<?php endif; ?>
<?php if (!is_single()) : ?>
jQuery(window).load(function(){
	var lazyload = jQuery('.lazyload');
	var imges = jQuery('<img>');
    lazyload.each(function() {

        var lazy = jQuery(this);
        var src = lazy.attr('data-src');

        imges.attr('src', src).load(function(){
            lazy.css('background-image', 'url("'+src+'")');
        });

    });
    <?php if (is_home()) : ?>
	    jQuery('#articleContainer p').each(function(i, thisL) {
	    		var thisL = jQuery(thisL);
	    		var theText = thisL.text();
	    		
	    		var newText = theText.replace(/&nbsp;/g,'');
	    		newText = newText.trim();
	    		var theFirstLetter = newText.substr(0,1);
				var first_letter = '<span class="firstletter">' + theFirstLetter + '</span>';
				var firstLetterRemoved = newText.substring(1);
				thisL.html(first_letter + firstLetterRemoved);
				

		})
	<?php endif; ?>
	<?php if (is_tag()) : ?>
	    jQuery('#articleContainer p').each(function(i, thisL) {
	    		var thisL = jQuery(thisL);
	    		var theText = thisL.text();
	    		
	    		var newText = theText.replace(/&nbsp;/g,'');
	    		newText = newText.trim();
	    		var theFirstLetter = newText.substr(0,1);
				var first_letter = '<span class="firstletter">' + theFirstLetter + '</span>';
				var firstLetterRemoved = newText.substring(1);
				thisL.html(first_letter + firstLetterRemoved);
				jQuery('.firstletter').css({
					'float' : 'left',
					'font-size' : '2.8em',
					'color': '#808080',
					'margin-right': '0px',
					'margin-top': '4px',
					'line-height' : '90%',
					'font-family': 'prata, serif',
					'display': 'block',
					'width': '56px',
					'text-align': 'center',
					'text-transform': 'uppercase'
				});

		})
	<?php endif; ?>
	<?php if (is_category() || is_search()) : ?>
	    jQuery('#articleContainer p').each(function(i, thisL) {
	    		var thisL = jQuery(thisL);
	    		var theText = thisL.text();
	    		
	    		var newText = theText.replace(/&nbsp;/g,'');
	    		newText = newText.trim();
	    		var theFirstLetter = newText.substr(0,1);
				var first_letter = '<span class="firstletter">' + theFirstLetter + '</span>';
				var firstLetterRemoved = newText.substring(1);
				thisL.html(first_letter + firstLetterRemoved);
				jQuery('.firstletter').css({
					'float' : 'left',
					'font-size' : '2.8em',
					'color': '#808080',
					'margin-right': '0px',
					'margin-top': '4px',
					'line-height' : '90%',
					'font-family': 'prata, serif',
					'display': 'block',
					'width': '56px',
					'text-align': 'center',
					'text-transform': 'uppercase'
				});

		})
	<?php endif; ?>


});
<?php endif; ?>
</script>
<script type="text/javascript"> 
var $buoop = {vs:{i:8,f:3.6,o:10.6,s:4,n:9}} 
$buoop.ol = window.onload; 
window.onload=function(){ 
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
 var e = document.createElement("script"); 
 e.setAttribute("type", "text/javascript"); 
 e.setAttribute("src", "http://browser-update.org/update.js"); 
 document.body.appendChild(e); 
}
</script>
<script type="text/javascript">
if (Modernizr.svg === true) {
    extension = "svg";
} else {
    extension = "png";
};
var home = 'http://www.lamodecnous.com';
var imageExt = document.getElementById("thelogo").src = "" + home + "/wp-content/themes/lmcn/images/logo." + extension;
if (!Modernizr.csstransitions) {
    var allMods = jQuery(".article");
    allMods.each(function(i, el) {
    	jQuery(el).css({'transform': 'translateY(0px)'});
    })
};


</script>
<?php wp_footer(); ?>
	</body>
</html>