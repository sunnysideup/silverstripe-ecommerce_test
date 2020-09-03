
(function($) {
    jQuery(document).ready(
        function() {
            //must do first!
            windowResizer.init();
            SSUhoverMenu.init();

        }
    );

})(jQuery);



/*
 *@author nicolaas[at]sunnysideup.co.nz
 *
 **/


var windowResizer = {

    windowWidth: 0,

    windowHeight: 0,

    smallScreenMaxSize: 960,

    standardSidebarWidth: 200,

    didScroll: false,

    runningScroll: false,

    lastScrollTop: 0,

    timeout: null,

    init : function() {
        windowResizer.randomImageClick();
        windowResizer.menuButton();
        //redo when window is resized
    },

    menuButton:function(){
        jQuery(".menuButton").on(
            "click",
            function() {
                jQuery("body").toggleClass("has-menu-overlay");
                jQuery(this)
                    .removeClass('nav-down')
                    .removeClass('nav-up');
                return false;
            }
        );
        // Hide Header on on scroll down

        jQuery(window).scroll(
            function(event){
                windowResizer.didScroll = true;
                if(windowResizer.timeout !== null) {
                    window.clearTimeout(windowResizer.timeout);
                }
                if(windowResizer.runningScroll === false) {
                    windowResizer.timeout = window.setTimeout(
                        function() {
                            windowResizer.hasScrolled();
                        },
                        100
                    );
                }
            }
        );


    },


    hasScrolled: function () {
        if(! jQuery('#MainMenu').is(':visible')) {
            windowResizer.runningScroll = true;
            var st = jQuery(window).scrollTop();
            var minScroll = 10;
            var navbarHeight = jQuery('#Layout').offset().top;
            // Make sure they scroll more than minScroll
            if(Math.abs(windowResizer.lastScrollTop - st) <= minScroll) {
                if(st < navbarHeight) {
                    jQuery('.menuButton').removeClass('nav-down').removeClass('nav-up');
                }
                //do nothing
                windowResizer.runningScroll = false;
                return;
            }
            // Scroll Down
            if(st <= navbarHeight) {
                jQuery('.menuButton').removeClass('nav-down').removeClass('nav-up');
                windowResizer.runningScroll = false;
                return;
            }
            if (st > windowResizer.lastScrollTop){
                jQuery('.menuButton').removeClass('nav-down').addClass('nav-up');
            } else {
                // Scroll Up
                // If did not scroll past the document (possible on mac)...
                if(st + jQuery(window).height() < jQuery(document).height()) {
                    jQuery('.menuButton')
                        .removeClass('nav-up').addClass('nav-down');
                }
            }

            windowResizer.lastScrollTop = st;
            windowResizer.runningScroll = false;
        }
    },

    randomImageClick: function() {
        if(jQuery("#RandomVisualThought").length > 0) {
            jQuery("#RandomVisualThought").unbind('click');
            jQuery("#RandomVisualThought").click(
                function(event) {
                    event.preventDefault();
                    if(jQuery('#RandomImageLarge').length > 0) {
                        jQuery('#RandomImageLarge').remove();
                        jQuery('body').removeClass('has-random-image');
                        jQuery('#RandomVisualThoughtHeader').after(jQuery('#RandomVisualThought'));

                    } else {
                        var url = jQuery(this).attr("data-rel");
                        jQuery("body")
                            .prepend('<div id="RandomImageLarge" style="background-image: url('+url+'); background-size: cover;"></div>');
                        jQuery("body").removeClass("has-menu-overlay");
                        jQuery('#RandomImageLarge').css('zIndex', 999);
                        jQuery("body")
                            .addClass('transition-to-has-random-image');
                        windowResizer.imageflicker('#RandomImageLarge', 0);

                    }
                    return false;
                }
            );
        }
    },

    getWindowSizing : function(){
        this.windowWidth = window.innerWidth;
        this.windowHeight = window.innerHeight;
    },

    imageflicker: function(selector, count) {
        if(typeof count === 'undefined') {
            count = 0;
        }
        count++;

        if(windowResizer.isEven(count)) {
            jQuery(selector).hide();
        } else {
            jQuery(selector).show();
        }
        if(count < 28) {
            var wait = Math.floor(Math.random() * 60);
            window.setTimeout(
                function() {windowResizer.imageflicker(selector, count);},
                wait
            );
        }
        else {
            jQuery('#RandomVisualThought').appendTo('body');
            jQuery(selector).css('zIndex', 0);
            jQuery(selector).show();
            jQuery("body")
                .addClass('has-random-image')
                .removeClass('transition-to-has-random-image');
        }
    },

    isEven: function(n) {
        n = Number(n);
        return n === 0 || !!(n && !(n%2));
    }
};



var SSUhoverMenu = {

    init: function(){
        this.reset();
    },
    mobileBrowsing: true,
    animateIn: {opacity: "1"},
    animateOut: {opacity: "0.85"},

    reset: function() {
        // jQuery("body").removeClass("has-menu-overlay");
        // jQuery("#Nav").show();
        // jQuery(".hasCSSHover").removeClass("hasCSSHover");
        jQuery("#Nav li.level1").hoverIntent(
            {
                over: SSUhoverMenu.menuIn,  // function = onMouseOver callback (required)
                timeout: 200,   // number = milliseconds delay before onMouseOut function call
                out: SSUhoverMenu.menuOut  // function = onMouseOut callback (required)
            }
        );
        jQuery("#Nav").hoverIntent(
            {
                over: function(){
                    jQuery(this)
                        .animate(SSUhoverMenu.animateIn)
                        .addClass("menuIn")
                        .removeClass("menuOut");
                },  // function = onMouseOver callback (required)
                timeout: 1500,   // number = milliseconds delay before onMouseOut function call
                out: function(){
                    jQuery(this)
                        .animate(SSUhoverMenu.animateOut)
                        .addClass("menuOut")
                        .removeClass("menuIn");
                }  // function = onMouseOut callback (required)
            }
        );
        jQuery("#Nav").children("li").each(
            function(i, el) {
                var parentOffset = jQuery(el).offset();
                var left = parentOffset.left;
                var docWidth = jQuery(document).width();
                if(left > (docWidth - 270)) {
                    left = docWidth - 270;
                }
                var leftString = left + "px";
                jQuery(el).children("ul").animate({paddingLeft: leftString});
            }
        );
        jQuery("#Nav")
            .animate(SSUhoverMenu.animateOut)
            .addClass("menuOut")
            .removeClass("menuIn");
    },

    menuIn: function() {
        jQuery(this).children("ul").slideDown();
    },

    menuOut: function() {
        jQuery(this).children("ul").slideUp();
    }

}



/**
* hoverIntent is similar to jQuery's built-in "hover" function except that
* instead of firing the onMouseOver event immediately, hoverIntent checks
* to see if the user's mouse has slowed down (beneath the sensitivity
* threshold) before firing the onMouseOver event.
*
* hoverIntent r6 // 2011.02.26 // jQuery 1.5.1+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
*
* hoverIntent is currently available for use in all personal or commercial
* projects under both MIT and GPL licenses. This means that you can choose
* the license that best suits your project, and use it accordingly.
*
* // basic usage (just like .hover) receives onMouseOver and onMouseOut functions
* $("ul li").hoverIntent( showNav , hideNav );
*
* // advanced usage receives configuration object only
* $("ul li").hoverIntent({
*	sensitivity: 7, // number = sensitivity threshold (must be 1 or higher)
*	interval: 100,   // number = milliseconds of polling interval
*	over: showNav,  // function = onMouseOver callback (required)
*	timeout: 0,   // number = milliseconds delay before onMouseOut function call
*	out: hideNav    // function = onMouseOut callback (required)
* });
*
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne brian(at)cherne(dot)net
*/
;(function($) {
    $.fn.hoverIntent = function(f,g) {
        // default configuration options
        var cfg = {
            sensitivity: 7,
            interval: 100,
            timeout: 0
        };
        // override configuration options with user supplied object
        cfg = $.extend(cfg, g ? { over: f, out: g } : f );

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
                $(ob).unbind("mousemove",track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob,[ev]);
            } else {
                // set previous coordinates for next time
                pX = cX; pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob,[ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function(e) {
            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({},e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

            // if e.type == "mouseenter"
            if (e.type == "mouseenter") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX; pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob).bind("mousemove",track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

            // else e.type == "mouseleave"
            } else {
                // unbind expensive mousemove event
                $(ob).unbind("mousemove",track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
            }
        };

        // bind the function to the two event listeners
        return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover);
    };
})(jQuery);
