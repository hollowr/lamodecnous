<?php get_header(); ?>
<?php $temp_query = $wp_query; ?>
<?php include('sidebar.php'); ?>
<?php $wp_query = $temp_query; ?>
    <?php if ( have_posts() ) : ?>
    <?php
            		$request = parse_url($_SERVER['REQUEST_URI']);
					$path = $request["path"];
					$result = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');
					?>

        <?php while (have_posts()) : the_post(); ?>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css' rel='stylesheet' type='text/css'>
        <div class="entry">

            <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
                <div class="post-meta">
                    <h1><?php the_title(); ?></h1>
				</div>
                <div class="post-content"><i class="icon-zoom-in icon-2x"></i>
        	<i class="icon-zoom-out icon-2x" title="Agrandir la zone de texte"></i><?php $category = get_the_category();?>
                <?php if ( isset($category[2]) ) : ?>
                	<div class="cat">Catégorie #<?php echo $category[1]->cat_name; ?></div>
                <?php endif; ?>
                <div class="date">
                	<?php the_time(__('M j, Y')) ?> par <span class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="Posts by <?php the_author(); ?>"><?php the_author(); ?></a></span><div class="share-content">
            	</div>

            <!--<a href="http://facebook.com/share.php?u=<?php the_permalink() ?>&amp;t=<?php echo urlencode(the_title('','', false)) ?>" target="_blank" class="f" title="Share on Facebook">Facebook</a> Shares : <?php get_likes('http://www.lamodecnous.com'.$result)?>
            <a href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo getTinyUrl(get_permalink($post->ID)); ?>" target="_blank" class="t" title="Spread the word on Twitter">Twitter</a> Likes : <?php get_tweets('http://www.lamodecnous.com'.$result)?>-->
        </div><?php the_content(); ?></div>
             
            </div>
            <div id="buttons">
  <div class="facebook button">
    <i class="icon">
      <i class="icon-facebook">
    </i>
  </i>
  <div class="slide">
    <p>
      facebook
    </p>
  </div>

  <a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;" class="f"  class="facebook-share-button" title="Share on Facebook">Partager : <span class="inputtype"><?php get_likes('http://www.lamodecnous.com'.$result)?></span></a>
  </div>
  
  <div class="twitter button">
    <i class="icon">
      <i class="icon-twitter">
    </i>
  </i>
  <div class="slide">
    <p>
      twitter
    </p>
  </div>
  <a href="https://twitter.com/share" class="twitter-share-button" data-via="lamodecnous">
    Tweet
  </a>
  <script>
    !function(d,s,id){
      var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
      if(!d.getElementById(id)){
        js=d.createElement(s);
        js.id=id;
        //console.log(fjs.parentNode)
        js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
  </script>
  </div>
  
  <div class="google button">
    <i class="icon">
      <i class="icon-google-plus">
    </i>
  </i>
  <div class="slide">
    <p>
      google+
    </p>
  </div>
  <!-- Place this tag where you want the +1 button to render. -->
  <div class="g-plusone" data-size="medium">
  </div>
  
  <!-- Place this tag after the last +1 button tag. -->
  <script type="text/javascript">
    (function() {
      var po = document.createElement('script');
      po.type = 'text/javascript';
      po.async = true;
      po.src = 'https://apis.google.com/js/plusone.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(po, s);
    }
    )();
  </script>
  </div>
</div>
            <div class="content-after scroll-img" style="width:49%;float: right;">
        		<span style="line-height: 24px;float:left">GALLERIE</span><br>
                <ul class="images" style="float:left;list-style: none;width:90%;overflow-x: scroll;
    white-space: nowrap;height:158px;display:inline-block;vertical-align: baseline;">
				
				</ul>
         </div>  
            

            <div class="post-navigation clear">
            	<div class="post-footer"><?php the_tags(__('<strong>Tags: </strong>'), ', '); ?><br><br>
<!-- <a href="#comments" class="post-comms"><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments'), '', __('Comments Closed') ); ?></a> -->
            <?php edit_post_link( __( 'Edit entry'), '&bull; '); ?></div>
                <?php
                    $prev_post = get_adjacent_post(false, '', true);
                    $next_post = get_adjacent_post(false, '', false); ?>
                    <?php if ($prev_post) : $prev_post_url = get_permalink($prev_post->ID); $prev_post_title = $prev_post->post_title; ?>
                        <a class="post-prev" href="<?php echo $prev_post_url; ?>"><em>Article précédent</em><span><?php echo $prev_post_title; ?></span></a>
                    <?php endif; ?>
                    <?php if ($next_post) : $next_post_url = get_permalink($next_post->ID); $next_post_title = $next_post->post_title; ?>
                        <a class="post-next" href="<?php echo $next_post_url; ?>"><em>Article suivant</em><span><?php echo $next_post_title; ?></span></a>
                    <?php endif; ?>
                <div class="line"></div>
                
            </div>
             
        </div>
        <div class="fullscreen">
        <a class="pinte" href=""
        data-pin-do="buttonPin"
        data-pin-config="above" target="_blank">
        <img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />
    	</a>
       	<div class="close">X</div>
       </div>
        <?php
            endwhile; ?>

    <?php endif; ?>

<script>
function resizing(event) {
    jQuery('.entry').css({'width':jQuery(window).width() - 284});
}
function titleSize() {
  jQuery('.post-meta h1').each(function(i, thisH1) {
    var thisH1 = jQuery(thisH1);

    if (thisH1.text().length > 60) {
      thisH1.css({"font-size":"1.3em"});
      
    }
  });
}
titleSize()
window.addEventListener("resize", resizing, false);
jQuery('p').each(function() {
    var $this = jQuery(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});
jQuery(document).ready(
	function() {
		var pinitbutton = jQuery('.pinte').clone().remove();
		console.log(pinitbutton)
		var b = document.getElementsByTagName('p');
    jQuery('.wp-caption-text').remove();
		/*while(b.length) {
		    var parent = b[ 0 ].parentNode;
		    while( b[ 0 ].firstChild ) {
		        parent.insertBefore(  b[ 0 ].firstChild, b[ 0 ] );
		    }
		     parent.removeChild( b[ 0 ] );
		}*/
/*jQuery('p').each(function() {
    var $this = jQuery(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});*/
var htmlCleaned = jQuery(".post-content").html().replace(/<br\s?\/?>/, '');
jQuery(".post-content").html(htmlCleaned);

		jQuery('.header').hide();
        var wrapImgs = jQuery('.post-content img').not('.ch_media').not('.ch_title').wrap('<li class="myimgs"></li>');
        console.log(wrapImgs);
        var myimgs = wrapImgs.clone();
        jQuery('.post-content').wrapInner('<div class="theContent" style="overflow-y:scroll;"></div>');
        jQuery('.post-content a[rel*="attachment"]').remove();
        //console.log(myimgs[0])
        myimgs.appendTo('.images').css({
            'height' : '150px',
            'width': '120px',
            'margin-left': '0px',
            'display': 'inline-block'
        });

        jQuery('.post-content .myimgs').remove();
        jQuery('.images img').wrap('<li class="myimgs"></li>');
        /*jQuery('.myimgs img').replaceWith(function(i, v){
		    return jQuery('<li class="myimgs"/>', {
		        style: 'background-image: url('+this.src+')',
		        html: '<img src="'+this.src+'"'
		    }) 
		})*/
        jQuery('.myimgs').css({
            'height' : '150px',
            'width': '120px',
            'margin-left': '10px',
            'display': 'inline-block',
            'background': 'white url('+jQuery(this).children('img').attr('src')+') no-repeat',
            'background-size': 'cover'
        });
        
        jQuery('.images li img').first().clone().prependTo('.post-content').css({
            'position': 'relative',
            'width': "auto",
            'height': 'auto',
            'margin-left': '0px',
            'display': 'inline-block'
        }).wrap('<div class="mainImg"></div>');
        jQuery('.images li').first().appendTo(jQuery('.images')).css({'display':'block'});
		jQuery('.images li').last().css({'display':'inline-block'});
		jQuery('.images').css({'float':'left','list-style': 'none','width':'90%','overflow-x': 'auto','overflow-y': 'hidden','white-space': 'nowrap','height':'156px','display':'inline-block','vertical-align': 'baseline'});
        if (jQuery('.images li').length == 0 || jQuery('.images li').length == 1) {
        	jQuery('.content-after').hide();
        }
        jQuery('.images').clone().appendTo('.fullscreen');
		
		jQuery('.fullscreen .close').on('click', function() {

				jQuery('.fullscreen').removeClass('visible').fadeOut(500, function(){
					jQuery('.fullscreen .imgfull').remove();
					jQuery('.pinte').remove();
				});
				
			if ((containerUL.children('li').length*140) > container.outerWidth()) {
				i=0;
				theInt = setInterval(function() {
		    		maxscroll = (containerUL.children('li').length) + (Math.round((containerUL.children('li').outerWidth() - container.width())/130));
		    		i++
		    		
		    		if (i === maxscroll){
		    			containerUL.animate({scrollLeft: 0}, 2000);
		    			i = 0;
		    		} else {
		    			containerUL.animate({scrollLeft: i*130}, 1000);
		    			
		    		}
		    		
				},3000);
			}
		})
		jQuery(document).keyup(function(e) {   // enter
		  if (e.keyCode == 27) { jQuery('.fullscreen').removeClass('visible').fadeOut(500, function(){
					jQuery('.fullscreen .imgfull').remove();
					i=0;
					if ((containerUL.children('li').length*140) > container.outerWidth()) {
							theInt = setInterval(function() {
				    		maxscroll = (containerUL.children('li').length) + (Math.round((containerUL.children('li').outerWidth() - container.width())/130));
				    		i++
				    		
				    		if (i === maxscroll){
				    			containerUL.animate({scrollLeft: 0}, 2000);
				    			i = 0;
				    		} else {
				    			containerUL.animate({scrollLeft: i*130}, 1000);
				    			
				    		}	
						},3000);
					}
				}); }   // esc
		});
        // jQuery('#content img').each(function() {
        //   if ( jQuery(this).parent().is("a") ) {
        //     jQuery(this).unwrap(function() {});
        //   }
        // })
function resize() {
	if (document.width > 640) {
			jQuery('.entry').css({'width':jQuery(window).width() - 284});
		} else {
			jQuery('.post-meta h1').css({"font-size":'100%'});
			
			jQuery('.content-after').css({"float":'left',"width":'100%'});
			jQuery('.images').css({"width":'100%'});
			jQuery('.mainImg img').css({"width":'auto'});
			jQuery('.post-navigation .post-prev, .post-navigation .post-next').css({"margin-bottom":'42px'});
			jQuery('.theContent').css({"width":'100%'});
			jQuery('#buttons>div').css({"margin":'4px 6%'});
		}
}
resize();
window.addEventListener('onresize', resize);
window.addEventListener('resize', resize);
		
		jQuery('.slideshow, #infscr-loading').hide();
		jQuery('#infscr-loading').css({'display':'none'});
		//jQuery('#content .entry span').before("<br />");
		//jQuery('#content .entry span').after("<br />");

		// jQuery('.post-content img').each(function() {
  //           if ( jQuery(this).parent().is("a") ) {
  //               jQuery(this).unwrap(function() {
  //                   jQuery(this).wrap("<div>");
  //               });
  //           } else if ( jQuery(this).parent().is("em") ) {
  //               jQuery(this).unwrap(function() {
  //                   jQuery(this).wrap("<div>");
  //               });
  //           } else if ( jQuery(this).parent().is("strong") ) {
  //               jQuery(this).unwrap(function() {
  //                   jQuery(this).wrap("<div>");
  //               });
  //           } else {
  //               // jQuery(this).wrap("<div>");

  //           }
  //           jQuery(this).before("<br />");
  //           var smallWidth = 150;
		//     var mediumWidth = 200; // Max width for the image
		//     var largeWidth = 500;    // Max height for the image
		//     var ratio = 0;  // Used for aspect ratio
		//     var width = jQuery(this).width();    // Current image width
		//     //console.log(jQuery(this))
  //           jQuery(this).removeClass("alignleft");
  //           jQuery(this).addClass("aligncenter"); 
		//     // Check if the current width is larger than the max
  //           if(width >= smallWidth){   // get ratio for scaling image
  //               jQuery(this).css("width", '20%'); // Set new width
  //               jQuery(this).css("height", 'auto');  // Scale height based on ratio
  //           }
		//     if(width >= mediumWidth){   // get ratio for scaling image
		//         jQuery(this).css("width", '50%'); // Set new width
		//         jQuery(this).css("height", 'auto');  // Scale height based on ratio
		//     }
		//     if(width >= largeWidth){   // get ratio for scaling image
		//         jQuery(this).css("width", (jQuery(window).width() - 300)); // Set new width
		//         jQuery(this).css("height", 'auto');  // Scale height based on ratio
		//     }
            
		// });
        //jQuery('.entry').css("width", (jQuery(window).width() - 300));

		jQuery('.theContent').delay(500).animate({'height': (jQuery('.sidebar .post').first().outerHeight(true)*8)-320,'overflow-y': 'scroll'}, 500, 'linear', function(){
			jQuery('.theContent').css({'overflow-y': 'scroll'});
		});
		jQuery('.sidebar').css({'height': (jQuery('.sidebar .post').first().outerHeight(true)*8)+20});
		jQuery('.theContent').css({'overflow-y': 'scroll'});
		jQuery('.mainImg img').on('click', function() {
			theClonedImg = jQuery(this).clone();
				jQuery('.fullscreen').addClass('visible').fadeIn(500);
			console.log('here1')
			if ((containerUL.children('li').length*140) > container.outerWidth()) {
				console.log('here')
				clearInterval(theInt);
			}
			theClonedImg.prependTo('.fullscreen')
			jQuery('.fullscreen img').first().addClass('imgfull')
			var thesourceurl = jQuery('.imgfull').attr('src');
			//console.log(thesourceurl);
			var theTitle = '<?php the_title(); ?>';
			jQuery('.fullscreen a').attr('href','//pinterest.com/pin/create/button/?url='+encodeURIComponent(location.href)+'&media='+ thesourceurl +'&description='+theTitle+'');


		})
		jQuery('.myimgs img').on('click', function(el) { 
			if (jQuery('.mainImg .fadeIn')) //jQuery('.mainImg .fadeIn').remove();
			var img = jQuery(this); 
			//console.log(img)
			var clonedImg = img.clone();
			var clonedImg2 = img.clone(); 

			clonedImg.appendTo('.mainImg').css({
            			'position': 'relative',
                  'height': 'auto',
                  'width': 'auto',
            			'margin': '0 auto',
            			'display': 'block',
            			'padding-right': '10px;',
				'opacity': 0,
				'z-index': 1
        		}).addClass('fadeIn');

			jQuery('.fullscreen .imgfull').remove()
			clonedImg2.prependTo('.fullscreen').css({
            			'position': 'relative',
            			'width': 'auto',
            			'margin-left': '',
            			'margin-top': '1%',
				'opacity': 0,
				'z-index': 5
        		}).addClass('fadeIn imgfull');

			var thesourceurl = jQuery('.imgfull').attr('src');
			
			var theTitle = '<?php the_title(); ?>';
			jQuery('.fullscreen a').attr('href','//pinterest.com/pin/create/button/?url='+encodeURIComponent(location.href)+'&media='+ thesourceurl +'&description='+theTitle+'');

			jQuery('.mainImg img').first().css({
				'display': 'none'
			}).remove();
			jQuery('.images li').first().css({
				'display': 'inline-block'
			});
			jQuery('.mainImg img').on('click', function() {
				jQuery('.fullscreen').addClass('visible').fadeIn(500);
				jQuery('.fullscreen img').first().addClass('imgfull');
				if ((containerUL.children('li').length*140) > container.outerWidth()) {
					console.log('here')
					//clearInterval(theInt);
				}
				jQuery('.fullscreen').append(pinitbutton)
			})
		});

		jQuery('.theContent').css({'overflow-y': 'scroll'});
			jQuery('table').attr('width','100%');
		jQuery('.theContent p').css({'text-align': 'justify'});

			jQuery('#container').addClass('single');
			var offset = jQuery('html').offset();

		function zoomContent() {
			if (!jQuery('.theContent').hasClass('open')) {
					jQuery('.theContent').addClass('open').animate({'width': '98%','height': (jQuery('.sidebar .post').first().outerHeight(true)*8)-320}, 500, 'linear');jQuery('.mainImg').animate({'width':'0%'}, 500, 'linear');jQuery('.theContent').css({'overflow-y': 'scroll'});
			} else
			if (jQuery('.theContent').hasClass('open')) {
					jQuery('.theContent').removeClass('open').animate({'width': '49%','height': (jQuery('.sidebar .post').first().outerHeight(true)*8)-320}, 500, 'linear');jQuery('.mainImg').animate({'width':'49%','max-height': '480px'}, 500, 'linear');jQuery('.theContent').css({'overflow-y': 'scroll'});
			}
		}
		jQuery('.theContent').removeClass('open').animate({'width': '49%','height': (jQuery('.sidebar .post').first().outerHeight(true)*8)-320}, 500, 'linear');jQuery('.mainImg').animate({'width':'49%','max-height': '480px','overflow': 'hidden'}, 500, 'linear');jQuery('.theContent').css({'overflow-y': 'scroll'});
 		jQuery('.entry .icon-zoom-in').on('mousedown', function(){
 			jQuery('.entry .icon-zoom-in').css({'display':'none'});
 			jQuery('.entry .icon-zoom-out').css({'display':'inline'});
 			zoomContent()
 		})
 		jQuery('.entry .icon-zoom-out').on('mousedown', function(){
 			jQuery('.entry .icon-zoom-out').css({'display':'none'});
 			jQuery('.entry .icon-zoom-in').css({'display':'inline'});
 			zoomContent()
 		})
 		
	});
jQuery(document).ready(
	function() {
		setTimeout(function() {
			jQuery('.mainImg, .mainImg img').first().css({
				'display': 'block'
			})
			jQuery('.entry').css({'width':jQuery(window).width() - 284});
			theText = jQuery('.theContent p').first().text();
			var newText = theText.replace(/&nbsp;/g,'');
	    		newText = newText.trim();
			var theFirstLetter = newText.substr(0,1);
			var first_letter = '<span class="firstletter">' + theFirstLetter + '</span>';
			var thepcontent = newText;
			var firstLetterRemoved = newText.substring(1);
			jQuery('.theContent p').first().html(first_letter + firstLetterRemoved);
			jQuery('.firstletter').css({
				'float' : 'left',
				'font-size' : '7em',
				'color': '#3b3b3b',
				'margin-right': '6px',
				'margin-top': '10px',
				'line-height' : '90%',
				'font-family': 'prata, serif'
			});
		},500);

	    //Get our elements for faster access and set overlay width
	    container = jQuery('.scroll-img');
	    containerUL = container.children('ul');
	    container2 = jQuery('.fullscreen');
	    containerUL2 = container2.children('ul');
	    var i = 0;
	 
	    if ((containerUL.children('li').length*140) > container.outerWidth()) {
	    	
		    theInt = setInterval(function() {
		    	maxscroll = (containerUL.children('li').length) + (Math.round((containerUL.children('li').outerWidth() - container.width())/130));
		    		i++
		    		
		    		if (i === maxscroll){
		    			containerUL.animate({scrollLeft: 0}, 2000);
		    			i = 0;
		    		} else {
		    			containerUL.animate({scrollLeft: i*130}, 1000);
		    			
		    		}
		    		
			},3000);
			container.on('mouseover',function(){
		    	clearInterval(theInt);
		    })
		    container.on('mouseout',function(){
		    	theInt = setInterval(function() {
		    	maxscroll = (containerUL.children('li').length) + (Math.round((containerUL.children('li').outerWidth() - container.width())/130));
		    		i++
		    		
		    		if (i === maxscroll){
		    			containerUL.animate({scrollLeft: 0}, 2000);
		    			i = 0;
		    		} else {
		    			containerUL.animate({scrollLeft: i*130}, 1000);
		    			
		    		}
		    		
			},3000);

		 }
		 )
	    


	    }
	    var l = 0;
	 
	    if ((containerUL2.children('li').length*140) > container2.outerWidth()) {
	    	
		    theInt2 = setInterval(function() {
		    	maxscroll2 = (containerUL2.children('li').length) + (Math.round((containerUL2.children('li').outerWidth() - container2.width())/130));
		    		l++
		    		
		    		if (l === maxscroll2){
		    			containerUL2.animate({scrollLeft: 0}, 2000);
		    			l = 0;
		    		} else {
		    			containerUL2.animate({scrollLeft: l*130}, 1000);
		    			
		    		}
		    		
			},3000);
			container2.on('mouseover',function(){
		    	clearInterval(theInt2);
		    })
		    container2.on('mouseout',function(){
		    	theInt2 = setInterval(function() {
		    	maxscroll2 = (containerUL2.children('li').length) + (Math.round((containerUL2.children('li').outerWidth() - container2.width())/130));
		    		l++
		    		
		    		if (l === maxscroll2){
		    			containerUL2.animate({scrollLeft: 0}, 2000);
		    			l = 0;
		    		} else {
		    			containerUL2.animate({scrollLeft: l*130}, 1000);
		    			
		    		}
		    		
			},3000);
		    })
		}
	    
	    
});
</script>
<script type="text/javascript">
    // (function(d){
    //     var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
    //     p.type = 'text/javascript';
    //     p.async = true;
    //     p.src = '//assets.pinterest.com/js/pinit.js';
    //     f.parentNode.insertBefore(p, f);
    // }(document));
    </script>

<?php get_footer(); ?>