"use strict";
jQuery.noConflict();
(function($) {
    $(function() {
        /*** Dropdown menu ***/

        var timeout = 200;
        var closetimer = 0;
        var ddmenuitem = 0;

        function dd_open() {
            dd_canceltimer();
            dd_close();
            var liwidth = $(this).width();
            ddmenuitem = $(this).find('ul').css({
                'visibility': 'visible',
                'width': 'auto'
            });
            ddmenuitem.prev().addClass('dd_hover').parent().addClass('dd_hover');
        }

        function dd_close() {
            if (ddmenuitem) ddmenuitem.css('visibility', 'hidden').prev().removeClass('dd_hover').parent().removeClass('dd_hover');
        }

        function dd_timer() {
            closetimer = window.setTimeout(dd_close, timeout);
        }

        function dd_canceltimer() {
            if (closetimer) {
                window.clearTimeout(closetimer);
                closetimer = null;
            }
        }
        document.onclick = dd_close;
        var ddLi = $('#dd > li');
        ddLi.bind('mouseover', dd_open);
        ddLi.bind('mouseout', dd_timer);
        var larrRarr = $('#larr, #rarr');
        larrRarr.hide();
        $('.slideshow').hover(
            function() {
                larrRarr.show();
            }, function() {
                larrRarr.hide();
            }
        );

        (function(window) {


            var lastTime = 0,
                vendors = ['moz', 'webkit', 'o', 'ms'],
                x;

            // Remove vendor prefixing if prefixed and break early if not
            for (x = 0; x < vendors.length && !window.requestAnimationFrame; x += 1) {
                window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
                window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
            }

            // Check if full standard supported
            if (!window.cancelAnimationFrame) {
                // Check if standard partially supported
                if (!window.requestAnimationFrame) {
                    // No support, emulate standard
                    window.requestAnimationFrame = function(callback) {
                        var now = new Date().getTime(),
                            nextTime = Math.max(lastTime + 16, now);

                        return window.setTimeout(function() {
                            callback(lastTime = nextTime);
                        }, nextTime - now);
                    };

                    window.cancelAnimationFrame = window.clearTimeout;
                } else {
                    // Emulate cancel for browsers that don't support it
                    vendors = window.requestAnimationFrame;
                    lastTime = {};

                    window.requestAnimationFrame = function(callback) {
                        var id = x; // Generate the id (x is initialized in the for loop above)
                        x += 1;
                        lastTime[id] = callback;

                        // Call the vendors requestAnimationFrame implementation
                        vendors(function(timestamp) {
                            if (lastTime.hasOwnProperty(id)) {
                                var error;
                                try {
                                    lastTime[id](timestamp);
                                } catch (e) {
                                    error = e;
                                } finally {
                                    delete lastTime[id];
                                    if (error) {
                                        throw error;
                                    } // re-throw the error if an error occurred
                                }
                            }
                        });

                        // return the id for cancellation capabilities
                        return id;
                    };

                    window.cancelAnimationFrame = function(id) {
                        delete lastTime[id];
                    };
                }
            }

        }(this));
        (function(jQuery) {
            var footer = jQuery('.footer');
            jQuery.fn.goTo = function() {
                jQuery('html, body').animate({
                    scrollTop: (jQuery('#menu').offset().top - 100)
                }, 400, 'easeInQuint');
                return this; // for chaining...
            }
            jQuery('#partageplus').on('click', function(event) {
                if (!footer.hasClass('open')) {
                    footer.addClass('open').animate({
                        'height': '406px'
                    }, 800, 'easeOutQuint');
                } else {
			footer.removeClass('open').animate({
                        'height': '40px'
                    }, 800, 'easeOutQuint');
		}
            })
        })(jQuery);

        // Makes use of the visible plugin
        // https://raw.github.com/teamdf/jquery-visible/master/jquery.visible.min.js
        var scrollPosition;

        function isScrolledIntoView(elem) {
            var docViewTop = jQuery(window).scrollTop();
            var docViewBottom = docViewTop + jQuery(window).height();

            var elemTop = jQuery(elem).offset().top;
            var elemBottom = elemTop + jQuery(elem).height();

            return ((elemTop >= docViewTop));
        }


        var jQuerywindow = jQuery(window);
        var theimgslattr = document.querySelectorAll('.imageContainer a')
        for (var i = 0; i < theimgslattr.length; i++) {
        	jQuery(theimgslattr[i]).attr("theIndex", i);
        };
        

        function easePosts() {
            var win = jQuery(window);

            var allMods = jQuery(".article");

            allMods.each(function(i, el) {
                var el = jQuery(el);
                var topView = (el.offset().top - 456) <= jQuery(window).scrollTop();
                //console.log(el.offset().top, jQuery(window).scrollTop())
                if (el.visible(true)) {
                    el.addClass("already-visible");
                }
                if (topView == true) {
                    el.addClass("already-visible"); //.removeClass('come-in');
                }
                var elOffset = el.offset();
                var htmlOffset = jQuery('#content').position();
                // console.log(htmlOffset.top, elOffset.top)
                //if (el.) 

                // var docViewTop = jQuery(window).scrollTop();
                //   var docViewBottom = docViewTop + jQuery(window).height();
                // if (elOffset.top >= docViewBottom ) {
                // 	console.log(elOffset.top, $window.scrollTop())
                // 	el.addClass("already-visible");
                // }
            });
            var enableTimer = 0;

            /*
             * Listen for a scroll and use that to remove
             * the possibility of hover effects
             */
            window.addEventListener('scroll', function() {
                clearTimeout(enableTimer);
                removeHoverClass();
                visibility()
                // enable after 1 second, choose your own value here!
                enableTimer = setTimeout(addHoverClass, 1000);
            }, false);

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

            function visibility(win) {
                allMods.each(function(i, el) {
                    var el = jQuery(el);
                    
                    //var topView = el.offset().top <= jQuery(window).scrollTop();
                    if (el.hasClass('come-in')) {
                    	//if (el.parent().parent()..article:nth-child(7n+7))
                    	jQuery('.imageContainer a').hover(function(i,elem){
                    		
                    	//console.log(jQuery(this).attr('theIndex'))

                    		if (jQuery(this).attr("theindex") == 6 || jQuery(this).attr("theindex") == 13) {
                    			jQuery(this).addClass('moveBgY');
                    		} else {
                    			jQuery(this).addClass("moveBg");
                    		}
				        })
                    } else {
                        if (el.visible(true)) {
                            el.addClass("come-in");
                            //console.log('come-in')
                            //jQuery.data(this, "scrollTimer", setTimeout(function() {
                            		//jQuery('.come-in .imageContainer a').addClass("moveBg");
                            //}, 1000));
                        } else {
                        	jQuery('.come-in .imageContainer a').removeClass("moveBg").removeClass("moveBgY");
                            //el.find('.imageContainer a').removeClass("moveBg");
                        }
                    }

                    //if (topView == true ) {
                    //	el.addClass("already-visible");//.removeClass('come-in');
                    //}
                });
            }

        }
        
        function titleSize() {
            jQuery('#articleContainer h2').each(function(i, thisH2) {
                var thisH2 = jQuery(thisH2);

                if (thisH2.text().length > 34) {
                    thisH2.css({
                        "font-size": 15
                    });
                }
            });
        }

        var menu = jQuery("#menu");
        var jQueryMenuLink = jQuery('#menu-top-menu a');
        var topnavPosition = jQuery('#menu').offset().top;
        if (jQuery(window).scrollTop() < topnavPosition) {
            jQueryMenuLink.first().on('click', function(e) {
                e.preventDefault();
                menu.goTo()
            })
        } else {
            jQuery('a[href~="http://menu"]').on('click', function() {
                menuNav.animate({
                    'top': '200px'
                }, 250);
            })
        }
        //jQuery(window).bind('scroll', function(event) {
            //var footerOpen = jQuery('.footer.open');
            //footerOpen.animate({
                //'height': '40px'
            //}, 800, 'easeOutQuint', function() {
                //footerOpen.removeClass('open');
            //});
        //})




        /*** Ajax-fetching posts ***/

        //$('#pagination a').live('click', function(e){
        //    e.preventDefault();
        //    $(this).addClass('chargement').text('CHARGEMENT...');
        //    $.ajax({
        //        type: "GET",
        //        url: $(this).attr('href') + '#loop',
        //        dataType: "html",
        //        success: function(out){
        //            result = $(out).find('#loop .post');
        //            nextlink = $(out).find('#pagination a').attr('href');
        //            $('#loop').append(result.fadeIn(300));
        //            $('#pagination a').removeClass('loading').text('PLUS D\'ARTICLES');
        //            if (nextlink != undefined) {
        //                $('#pagination a').attr('href', nextlink);
        //            } else {
        //                $('#pagination').remove();
        //            }
        //            if ( $.cookie('mode') == 'grid' ) {
        //                grid_update();
        //            } else {
        //                list_update();
        //            }
        //        }
        //    });
        //});

        /*** Misc ***/

        $('#comment, #author, #email, #url')
            .focusin(function() {
                $(this).parent().css('border-color', '#888');
            })
            .focusout(function() {
                $(this).parent().removeAttr('style');
            });
        $('.rpthumb:last, .comment:last').css('border-bottom', 'none');
        jQuery(document).ready(function() {
            easePosts();
            titleSize();
        });
    })
})(jQuery)

/*
jQuery(document).ready(function($) {
	$('.article:nth-child(7n+3) #articleContainer').each(function(index) {
		if ($('.article:nth-child(7n+3) #articleContainer p').eq(index).length == 0) { 
			//console.log(index) 
			$('.article:nth-child(7n+3)').eq(index).css({'height':'308px'});
			$('.article:nth-child(7n+3) #articleContainer').eq(index).css({'height':'80px'}); 
		}
	})
});
*/
