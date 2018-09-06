(function($) {
	"use strict";

    var common = {};
    edgtf.modules.common = common;

    common.edgtfFluidVideo = edgtfFluidVideo;
    common.edgtfPreloadBackgrounds = edgtfPreloadBackgrounds;
    common.edgtfPrettyPhoto = edgtfPrettyPhoto;
    common.edgtfCheckHeaderStyleOnScroll = edgtfCheckHeaderStyleOnScroll;
    common.edgtfInitParallax = edgtfInitParallax;
    common.edgtfEnableScroll = edgtfEnableScroll;
    common.edgtfDisableScroll = edgtfDisableScroll;
    common.edgtfWheel = edgtfWheel;
    common.edgtfKeydown = edgtfKeydown;
    common.edgtfPreventDefaultValue = edgtfPreventDefaultValue;
    common.edgtfOwlSlider = edgtfOwlSlider;
    common.edgtfInitSelfHostedVideoPlayer = edgtfInitSelfHostedVideoPlayer;
    common.edgtfSelfHostedVideoSize = edgtfSelfHostedVideoSize;
    common.edgtfInitBackToTop = edgtfInitBackToTop;
    common.edgtfBackButtonShowHide = edgtfBackButtonShowHide;
    common.edgtfInitRowColumnsSameHeight = edgtfInitRowColumnsSameHeight;
    common.edgtfInitNotFoundPage = edgtfInitNotFoundPage;

	$(document).ready(function() {
		edgtfFluidVideo();
        edgtfPreloadBackgrounds();
        edgtfPrettyPhoto();
        edgtfInitElementsAnimations();
        edgtfInitAnchor().init();
        edgtfInitVideoBackground();
        edgtfInitVideoBackgroundSize();
        edgtfSetContentBottomMargin();
        edgtfOwlSlider();
        edgtfInitSelfHostedVideoPlayer();
		edgtfSelfHostedVideoSize();
        edgtfInitBackToTop();
        edgtfBackButtonShowHide();
        edgtfInitNotFoundPage();
	});

    $(window).load(function() {
        edgtfCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        edgtfInitParallax();
        edgtfInitRowColumnsSameHeight();
    });

	$(window).resize(function() {
		edgtfInitVideoBackgroundSize();
		edgtfSelfHostedVideoSize();
        edgtfInitNotFoundPage();
        
	});

	function edgtfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function edgtfOwlSlider() {

        var sliders = $('.edgtf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){

                var slider = $(this);
                var pagination = $(this).hasClass('edgtf-portfolio-media'); /* place where pagination need to be loaded */
                slider.owlCarousel({
                    singleItem: true,
                    transitionStyle: 'fadeUp',
                    navigation: true,
                    autoHeight: true,
                    pagination: pagination,
                    navigationText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-previous"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-left"></i></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-next"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-right"></i></span></span>'
                    ],
                    afterAction : afterAction
                });


                function afterAction() {
                    /*jshint validthis: true */
                    var numberOfNextSlide;
                    var numberOfPreviousSlide;
                    var numberOfSliders = this.owl.owlItems.length;

                    if (numberOfSliders !== 1) {
                        numberOfPreviousSlide = (this.owl.currentItem !== 0) ? (this.owl.currentItem) : this.owl.owlItems.length;
                        numberOfNextSlide = (this.owl.currentItem !== this.owl.owlItems.length - 1) ? (this.owl.currentItem + 2) : 1;
                    }
                    else {
                        numberOfPreviousSlide = numberOfNextSlide = 1;
                    }

                    updateResult(".edgtf-navigation-counter-previous", numberOfPreviousSlide);
                    updateResult(".edgtf-navigation-counter-next", numberOfNextSlide);
                    updateResult(".edgtf-navigation-counter-number", numberOfSliders);
                }

                function updateResult(pos,value){
                    slider.find(pos).text(value);
                }
            });
        }
    }

    /*
     *	Preload background images for elements that have 'edgtf-preload-background' class
     */
    function edgtfPreloadBackgrounds(){

        $(".edgtf-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") !== "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('edgtf-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('edgtf-preload-background'); }); //make sure that edgtf-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function edgtfPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="arrow_right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="arrow_left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Check header style on scroll, depending on row settings
     */
    function edgtfCheckHeaderStyleOnScroll(){

        if($('[data-edgtf_header_style]').length > 0 && edgtf.body.hasClass('edgtf-header-style-on-scroll')) {

            var waypointSelectors = $('.edgtf-full-width-inner > .wpb_row.edgtf-section, .edgtf-full-width-inner > .edgtf-parallax-section-holder, .edgtf-container-inner > .wpb_row.edgtf-section, .edgtf-container-inner > .edgtf-parallax-section-holder, .edgtf-portfolio-single > .wpb_row.edgtf-section');
            var changeStyle = function(element){
                (element.data("edgtf_header_style") !== undefined) ? edgtf.body.removeClass('edgtf-dark-header edgtf-light-header').addClass(element.data("edgtf_header_style")) : edgtf.body.removeClass('edgtf-dark-header edgtf-light-header').addClass(''+edgtf.defaultHeaderStyle);
            };

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'down') { changeStyle($(this.element)); }
            }, { offset: 0});

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'up') { changeStyle($(this.element)); }
            }, { offset: function(){
                return -$(this.element).outerHeight();
            } });
        }
    }

    /*
     *	Start animations on elements
     */
    function edgtfInitElementsAnimations(){

        var touchClass = $('.edgtf-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.edgtf-grow-in, .edgtf-fade-in-down, .edgtf-element-from-fade, .edgtf-element-from-left, .edgtf-element-from-right, .edgtf-element-from-top, .edgtf-element-from-bottom, .edgtf-flip-in, .edgtf-x-rotate, .edgtf-z-rotate, .edgtf-y-translate, .edgtf-fade-in, .edgtf-fade-in-left-x-rotate'),
            animationClass;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        animationClass = elements.data('animation') ? elements.data('animation') : false;

        if(elements.length > 0 && noAnimationsOnTouch && animationClass){
            elements.each(function(){
                var element = $(this);

                element.appear(function() {
                    element.addClass(animationClass+'-on');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

    /*
     **	Sections with parallax background image
     */
    function edgtfInitParallax(){

        if($('.edgtf-parallax-section-holder').length){
            $('.edgtf-parallax-section-holder').each(function() {

                var parallaxElement = $(this);
                if(parallaxElement.hasClass('edgtf-full-screen-height-parallax')){
                    parallaxElement.height(edgtf.windowHeight);
                    parallaxElement.find('.edgtf-parallax-content-outer').css('padding',0);
                }
                var speed = parallaxElement.data('edgtf-parallax-speed')*0.4;
                parallaxElement.parallax("50%", speed);
            });
        }
    }

    /*
     **	Anchor functionality
     */
    var edgtfInitAnchor = edgtf.modules.common.edgtfInitAnchor = function() {

        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function(anchor){

            $('.edgtf-main-menu .edgtf-active-item, .edgtf-mobile-nav .edgtf-active-item, .edgtf-vertical-menu .edgtf-active-item, .edgtf-fullscreen-menu .edgtf-active-item').removeClass('edgtf-active-item');
            anchor.parent().addClass('edgtf-active-item');

            $('.edgtf-main-menu a, .edgtf-mobile-nav a, .edgtf-vertical-menu a, .edgtf-fullscreen-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function(){

            $('[data-edgtf-anchor]').waypoint( function(direction) {
                if(direction === 'down') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edgtf-anchor")+"']"));
                }
            }, { offset: '50%' });

            $('[data-edgtf-anchor]').waypoint( function(direction) {
                if(direction === 'up') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edgtf-anchor")+"']"));
                }
            }, { offset: function(){
                return -($(this.element).outerHeight() - 150);
            } });

        };

        /**
         * Check anchor active state on load
         */
        var checkActiveStateOnLoad = function(){
            var hash = window.location.hash.split('#')[1];

            if(hash !== "" && $('[data-edgtf-anchor="'+hash+'"]').length > 0){
                //triggers click which is handled in 'anchorClick' function
                $("a[href='"+window.location.href.split('#')[0]+"#"+hash).trigger( "click" );
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function(anchoredElementOffset){

            if(edgtf.modules.header.behaviour == 'edgtf-sticky-header-on-scroll-down-up') {
                (anchoredElementOffset > edgtf.modules.header.stickyAppearAmount) ? edgtf.modules.header.isStickyVisible = true : edgtf.modules.header.isStickyVisible = false;
            }

            if(edgtf.modules.header.behaviour == 'edgtf-sticky-header-on-scroll-up') {
                (anchoredElementOffset > edgtf.scroll) ? edgtf.modules.header.isStickyVisible = false : '';
            }

            var headerHeight = edgtf.modules.header.isStickyVisible ? edgtfGlobalVars.vars.edgtfStickyHeaderTransparencyHeight : edgtfPerPageVars.vars.edgtfHeaderTransparencyHeight;

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function() {
            edgtf.document.on("click", ".edgtf-main-menu a, .edgtf-vertical-menu a, .edgtf-fullscreen-menu a, .edgtf-btn, .edgtf-anchor", function() {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if(hash !== "" && $('[data-edgtf-anchor="' + hash + '"]').length > 0 && anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]) {

                    var anchoredElementOffset = $('[data-edgtf-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-edgtf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                    setActiveState(anchor);

                    edgtf.html.stop().animate({
                        scrollTop: Math.round(scrollAmount)
                    }, 1000, function() {
                        //change hash tag in url
                        if(history.pushState) { history.pushState(null, null, '#'+hash); }
                    });
                    return false;
                }
            });
        };

        return {
            init: function() {
                if($('[data-edgtf-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).load(function() { checkActiveStateOnLoad(); });
                }
            }
        };

    };

    /*
     **	Video background initialization
     */
    function edgtfInitVideoBackground(){

        $('.edgtf-section .edgtf-video-wrap .edgtf-video').mediaelementplayer({
            enableKeyboard: false,
            iPadUseNativeControls: false,
            pauseOtherPlayers: false,
            // force iPhone's native controls
            iPhoneUseNativeControls: false,
            // force Android's native controls
            AndroidUseNativeControls: false
        });

        //mobile check
        if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
            edgtfInitVideoBackgroundSize();
            $('.edgtf-section .edgtf-mobile-video-image').show();
            $('.edgtf-section .edgtf-video-wrap').remove();
        }
    }

    /*
     **	Calculate video background size
     */
    function edgtfInitVideoBackgroundSize(){

        $('.edgtf-section .edgtf-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.edgtf-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.edgtf-section').outerHeight();
            edgtf.minVideoWidth = edgtf.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / edgtf.videoWidthOriginal;
            var scaleV = sectionHeight / edgtf.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * edgtf.videoWidthOriginal < edgtf.minVideoWidth) {scale = edgtf.minVideoWidth / edgtf.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * edgtf.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * edgtf.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function edgtfSetContentBottomMargin(){
        var uncoverFooter = $('.edgtf-footer-uncover');

        if(uncoverFooter.length){
            $('.edgtf-content').css('margin-bottom', $('.edgtf-footer-inner').height());
        }
    }

    function edgtfDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', edgtfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = edgtfWheel;
        document.onkeydown = edgtfKeydown;

        if(edgtf.body.hasClass('edgtf-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function edgtfEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', edgtfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(edgtf.body.hasClass('edgtf-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function edgtfWheel(e) {
        edgtfPreventDefaultValue(e);
    }

    function edgtfKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                edgtfPreventDefaultValue(e);
                return;
            }
        }
    }

    function edgtfPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function edgtfInitSelfHostedVideoPlayer() {

        var players = $('.edgtf-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function edgtfSelfHostedVideoSize(){

		$('.edgtf-self-hosted-video-holder .edgtf-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.edgtf-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / edgtf.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function edgtfToTopButton(a) {
        
        var b = $("#edgtf-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function edgtfBackButtonShowHide(){        
        edgtf.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 2e3) { edgtfToTopButton('off'); } else { edgtfToTopButton('on'); }
        });
    }

    function edgtfInitBackToTop(){       
        var backToTopButton = $('#edgtf-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            edgtf.html.animate({scrollTop: 0}, edgtf.window.scrollTop()/3, 'linear');
        });
    }

    /*
     ** Init Row Section with same height
     */
    function edgtfInitRowColumnsSameHeight(){

        if($('.edgtf-row-columns-same-height').length){
            $('.edgtf-row-columns-same-height').each(function() {

                var thisRowSection = $(this);
                thisRowSection.css('opacity','1');
                var thisRowSectionHeight = 0;

                if(thisRowSection.hasClass('edgtf-grid-section')) {
                    thisRowSectionHeight = thisRowSection.find('> .edgtf-section-inner > .edgtf-section-inner-margin').height();
                    thisRowSection.find('> div > div > .wpb_column').css('min-height', thisRowSectionHeight);
                } else {
                    thisRowSectionHeight = thisRowSection.children().height();
                    thisRowSection.find('> div > .wpb_column').css('min-height', thisRowSectionHeight);
                }
            });
        }
    }

    /*
     ** Init Header and page for 404 page
     */
    function edgtfInitNotFoundPage(){
        if($('.error404').length){
            var header = $('.edgtf-menu-area'),
            pageContent = $('.edgtf-content'),
            mobileHeader = $('.edgtf-mobile-header-inner'),
            htmlTag = $('html'),
            pageHeight = (htmlTag.height() > 700) ? htmlTag.height() : 700;

            if(edgtf.windowWidth >= 1024){
                pageContent.css('height', pageHeight+'px');
            }
            else{
                pageContent.css('height', (pageHeight-header.height()-parseInt(mobileHeader.css('border-bottom-width')))+'px');
            }



        }


    }

})(jQuery);