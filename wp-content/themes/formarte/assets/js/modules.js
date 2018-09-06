(function($) {
    "use strict";

    window.edgtf = {};
    edgtf.modules = {};

    edgtf.scroll = 0;
    edgtf.window = $(window);
    edgtf.document = $(document);
    edgtf.windowWidth = $(window).width();
    edgtf.windowHeight = $(window).height();
    edgtf.body = $('body');
    edgtf.html = $('html, body');
    edgtf.menuDropdownHeightSet = false;
    edgtf.defaultHeaderStyle = '';
    edgtf.minVideoWidth = 1500;
    edgtf.videoWidthOriginal = 1280;
    edgtf.videoHeightOriginal = 720;
    edgtf.videoRatio = 1280/720;

    //set boxed layout width variable for various calculations

    switch(true){
        case edgtf.body.hasClass('edgtf-grid-1300'):
            edgtf.boxedLayoutWidth = 1350;
            break;
        case edgtf.body.hasClass('edgtf-grid-1200'):
            edgtf.boxedLayoutWidth = 1250;
            break;
        case edgtf.body.hasClass('edgtf-grid-1000'):
            edgtf.boxedLayoutWidth = 1050;
            break;
        case edgtf.body.hasClass('edgtf-grid-800'):
            edgtf.boxedLayoutWidth = 850;
            break;
        default :
            edgtf.boxedLayoutWidth = 1150;
            break;
    }

    $(document).ready(function(){
        edgtf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(edgtf.body.hasClass('edgtf-dark-header')){ edgtf.defaultHeaderStyle = 'edgtf-dark-header';}
        if(edgtf.body.hasClass('edgtf-light-header')){ edgtf.defaultHeaderStyle = 'edgtf-light-header';}

    });

    $(window).resize(function() {
        edgtf.windowWidth = $(window).width();
        edgtf.windowHeight = $(window).height();
    });

    $(window).scroll(function(){
        edgtf.scroll = $(window).scrollTop();
    });

})(jQuery);
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
(function($) {
    "use strict";

    var header = {};
    edgtf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.edgtfSideArea = edgtfSideArea;
    header.edgtfSideAreaScroll = edgtfSideAreaScroll;
    header.edgtfFullscreenMenu = edgtfFullscreenMenu;
    header.edgtfInitMobileNavigation = edgtfInitMobileNavigation;
    header.edgtfMobileHeaderBehavior = edgtfMobileHeaderBehavior;
    header.edgtfSetDropDownMenuPosition = edgtfSetDropDownMenuPosition;
    header.edgtfDropDownMenu = edgtfDropDownMenu;
    header.edgtfSearch = edgtfSearch;

    $(document).ready(function() {
        edgtfHeaderBehaviour();
        edgtfSideArea();
        edgtfSideAreaScroll();
        edgtfFullscreenMenu();
        edgtfInitMobileNavigation();
        edgtfMobileHeaderBehavior();
        edgtfSetDropDownMenuPosition();
        edgtfSearch();
    });

    $(window).load(function() {
        edgtfSetDropDownMenuPosition();
        edgtfDropDownMenu();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgtfHeaderBehaviour() {

        var header = $('.edgtf-page-header');
        var stickyHeader = $('.edgtf-sticky-header');
        var fixedHeaderWrapper = $('.edgtf-fixed-wrapper');

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-up'):
                edgtf.modules.header.behaviour = 'edgtf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = edgtfGlobalVars.vars.edgtfTopBarHeight + edgtfGlobalVars.vars.edgtfLogoAreaHeight + edgtfGlobalVars.vars.edgtfMenuAreaHeight + edgtfGlobalVars.vars.edgtfStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edgtf.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
                    }else {
                        edgtf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-down-up'):
                edgtf.modules.header.behaviour = 'edgtf-sticky-header-on-scroll-down-up';
                stickyAppearAmount = edgtfPerPageVars.vars.edgtfStickyScrollAmount !== 0 ? edgtfPerPageVars.vars.edgtfStickyScrollAmount : edgtfGlobalVars.vars.edgtfTopBarHeight + edgtfGlobalVars.vars.edgtfLogoAreaHeight + edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                edgtf.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic

                var headerAppear = function(){
                    if(edgtf.scroll < stickyAppearAmount) {
                        edgtf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
                    }else{
                        edgtf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edgtf.body.hasClass('edgtf-fixed-on-scroll'):
                edgtf.modules.header.behaviour = 'edgtf-fixed-on-scroll';

                var initialMenuAreaHeight = edgtfGlobalVars.vars.edgtfInitialMenuAreaHeight;
                var fixedAreaHeight = edgtfGlobalVars.vars.edgtfFixedAreaHeight;
                var sideMenuArea = $('.edgtf-side-menu');
                var menuDiffernce1 = (initialMenuAreaHeight-fixedAreaHeight)/2; //initial header is larger then fixed
                var menuDiffernce2 = (fixedAreaHeight-initialMenuAreaHeight)/2; //fixed header is larger then initial



                var sideMenuAreaHolder = fixedHeaderWrapper.find('.edgtf-side-menu-button-opener');
                if(sideMenuAreaHolder.length){
                    var sideMenuAreaLeftPadding = parseInt(sideMenuAreaHolder.css('padding-left'));
                    var sideMenuAreaRightPadding = parseInt(sideMenuAreaHolder.css('padding-right'));
                    var fixedSideMenuAreaLeftPadding = 0;
                    var fixedSideMenuAreaRightPadding = 0;

                    if(initialMenuAreaHeight < fixedAreaHeight) {
                        fixedSideMenuAreaLeftPadding = sideMenuAreaLeftPadding + menuDiffernce2;
                        fixedSideMenuAreaRightPadding = sideMenuAreaRightPadding + menuDiffernce2;
                    } else {
                        fixedSideMenuAreaLeftPadding = sideMenuAreaLeftPadding - menuDiffernce1;
                        fixedSideMenuAreaRightPadding = sideMenuAreaRightPadding - menuDiffernce1;
                    }
                }

                var fullScreenMenuAreaHolder = fixedHeaderWrapper.find('.edgtf-fullscreen-menu-opener');
                if(fullScreenMenuAreaHolder.length){
                    var fullScreenMenuAreaLeftPadding = parseInt(fullScreenMenuAreaHolder.css('padding-left'));
                    var fullScreenMenuAreaRightPadding = parseInt(fullScreenMenuAreaHolder.css('padding-right'));
                    var fixedFullScreenMenuAreaLeftPadding = 0;
                    var fixedFullScreenMenuAreaRightPadding = 0;

                    if(initialMenuAreaHeight < fixedAreaHeight) {
                        fixedFullScreenMenuAreaLeftPadding = fullScreenMenuAreaLeftPadding + menuDiffernce2;
                        fixedFullScreenMenuAreaRightPadding = fullScreenMenuAreaRightPadding + menuDiffernce2;
                    } else {
                        fixedFullScreenMenuAreaLeftPadding = fullScreenMenuAreaLeftPadding - menuDiffernce1;
                        fixedFullScreenMenuAreaRightPadding = fullScreenMenuAreaRightPadding - menuDiffernce1;
                    }
                }

                var searchMenuAreaHolder = fixedHeaderWrapper.find('.edgtf-search-opener');
                if(searchMenuAreaHolder.length){
                    var searchMenuAreaLeftPadding = parseInt(searchMenuAreaHolder.css('padding-left'));
                    var searchMenuAreaRightPadding = parseInt(searchMenuAreaHolder.css('padding-right'));
                    var fixedSearchMenuAreaLeftPadding = 0;
                    var fixedSearchMenuAreaRightPadding = 0;

                    if(initialMenuAreaHeight < fixedAreaHeight) {
                        fixedSearchMenuAreaLeftPadding = searchMenuAreaLeftPadding + menuDiffernce2;
                        fixedSearchMenuAreaRightPadding = searchMenuAreaRightPadding + menuDiffernce2;
                    } else {
                        fixedSearchMenuAreaLeftPadding = searchMenuAreaLeftPadding - menuDiffernce1;
                        fixedSearchMenuAreaRightPadding = searchMenuAreaRightPadding - menuDiffernce1;
                    }
                }

                var woocommerceDropdownCartMenuAreaHolder = fixedHeaderWrapper.find('.edgtf-header-cart');
                if(woocommerceDropdownCartMenuAreaHolder.length){
                    var woocommerceDropdownCartMenuAreaLeftPadding = parseInt(woocommerceDropdownCartMenuAreaHolder.css('padding-left'));
                    var woocommerceDropdownCartMenuAreaRightPadding = parseInt(woocommerceDropdownCartMenuAreaHolder.css('padding-right'));
                    var fixedWoocommerceDropdownCartMenuAreaLeftPadding = 0;
                    var fixedWoocommerceDropdownCartMenuAreaRightPadding = 0;

                    if(initialMenuAreaHeight < fixedAreaHeight) {
                        fixedWoocommerceDropdownCartMenuAreaLeftPadding = woocommerceDropdownCartMenuAreaLeftPadding + menuDiffernce2;
                        fixedWoocommerceDropdownCartMenuAreaRightPadding = woocommerceDropdownCartMenuAreaRightPadding + menuDiffernce2;
                    } else {
                        fixedWoocommerceDropdownCartMenuAreaLeftPadding = woocommerceDropdownCartMenuAreaLeftPadding - menuDiffernce1;
                        fixedWoocommerceDropdownCartMenuAreaRightPadding = woocommerceDropdownCartMenuAreaRightPadding - menuDiffernce1;
                    }
                }

                var headerFixed = function(){
                    if(edgtf.scroll === 0){
                        fixedHeaderWrapper.removeClass('edgtf-fixed-show');
                        fixedHeaderWrapper.css('top',edgtfGlobalVars.vars.edgtfTopBarHeight+edgtfGlobalVars.vars.edgtfAddForAdminBar);
                        header.css('margin-bottom',initialMenuAreaHeight);

                        fixedHeaderWrapper.children('.edgtf-menu-area').css({'height':initialMenuAreaHeight});
                        fixedHeaderWrapper.children('.edgtf-menu-area').find('.edgtf-logo-wrapper a').stop().animate({'max-height':initialMenuAreaHeight}, 200, 'easeOutSine');

                        if(sideMenuAreaHolder.length) {
                            sideMenuAreaHolder.stop().animate({'padding-left':sideMenuAreaLeftPadding+'px', 'padding-right':sideMenuAreaRightPadding+'px'}, 200, 'easeOutSine');
                        }
                        if(fullScreenMenuAreaHolder.length) {
                            fullScreenMenuAreaHolder.stop().animate({'padding-left':fullScreenMenuAreaLeftPadding+'px', 'padding-right':fullScreenMenuAreaRightPadding+'px'}, 200, 'easeOutSine');
                        }
                        if(searchMenuAreaHolder.length) {
                            searchMenuAreaHolder.stop().animate({'padding-left':searchMenuAreaLeftPadding+'px', 'padding-right':searchMenuAreaRightPadding+'px'}, 200, 'easeOutSine');
                        }
                        if(woocommerceDropdownCartMenuAreaHolder.length) {
                            woocommerceDropdownCartMenuAreaHolder.stop().animate({'padding-left':woocommerceDropdownCartMenuAreaLeftPadding+'px', 'padding-right':woocommerceDropdownCartMenuAreaRightPadding+'px'}, 200, 'easeOutSine');
                        }
                        if (sideMenuArea.length) {
                            sideMenuArea.removeClass('edgtf-fixed-header-show'); //style for side area close button in relation to header
                        }

                        setTimeout(function(){
                            edgtfDropDownMenuReInit();
                        }, 250);

                    } else {
                        fixedHeaderWrapper.addClass('edgtf-fixed-show');
                        fixedHeaderWrapper.css('top',edgtfGlobalVars.vars.edgtfAddForAdminBar);
                        header.css('margin-bottom',fixedAreaHeight);

                        fixedHeaderWrapper.children('.edgtf-menu-area').css({'height':fixedAreaHeight});
                        fixedHeaderWrapper.children('.edgtf-menu-area').find('.edgtf-logo-wrapper a').stop().animate({'max-height':fixedAreaHeight}, 200, 'easeOutSine');

                        if(sideMenuAreaHolder.length) {
                            sideMenuAreaHolder.stop().animate({'padding-left':fixedSideMenuAreaLeftPadding, 'padding-right':fixedSideMenuAreaRightPadding}, 200, 'easeOutSine');
                        }
                        if(fullScreenMenuAreaHolder.length) {
                            fullScreenMenuAreaHolder.stop().animate({'padding-left':fixedFullScreenMenuAreaLeftPadding, 'padding-right':fixedFullScreenMenuAreaRightPadding}, 200, 'easeOutSine');
                        }
                        if(searchMenuAreaHolder.length) {
                            searchMenuAreaHolder.stop().animate({'padding-left':fixedSearchMenuAreaLeftPadding+'px', 'padding-right':fixedSearchMenuAreaRightPadding+'px'}, 200, 'easeOutSine');
                        }
                        if(woocommerceDropdownCartMenuAreaHolder.length) {
                            woocommerceDropdownCartMenuAreaHolder.stop().animate({'padding-left':fixedWoocommerceDropdownCartMenuAreaLeftPadding+'px', 'padding-right':fixedWoocommerceDropdownCartMenuAreaRightPadding+'px'}, 200, 'easeOutSine');
                        }
                        if (sideMenuArea.length) {
                            sideMenuArea.addClass('edgtf-fixed-header-show'); //style for side area close button in relation to header
                            $('edgtf-fixed-header-show').find('.edgtf-close-side-menu-holder').stop().animate({'height': fixedAreaHeight + 'px'}, 200, 'easeOutSine');
                            $('edgtf-fixed-header-show').find('a.edgtf-close-side-menu').stop().animate({'height': fixedAreaHeight + 'px'}, 200, 'easeOutSine');
                            $('edgtf-fixed-header-show').find('a.edgtf-close-side-menu').stop().animate({'width': fixedAreaHeight + 'px'}, 200, 'easeOutSine');
                            $('edgtf-fixed-header-show').find('a.edgtf-close-side-menu').stop().animate({'line-height': fixedAreaHeight + 'px'}, 200, 'easeOutSine');
                        }

                        setTimeout(function(){
                            edgtfDropDownMenuReInit();
                        }, 250);
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function edgtfSideArea() {

        var wrapper = $('.edgtf-wrapper'),
            sideMenu = $('.edgtf-side-menu'),
            sideMenuButtonOpen = $('a.edgtf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (edgtf.body.hasClass('edgtf-side-menu-slide-from-right')) {

            cssClass = 'edgtf-right-side-menu-opened';
            wrapper.prepend('<div class="edgtf-cover"/>');
            slideFromRight = true;

        } else if (edgtf.body.hasClass('edgtf-side-menu-slide-with-content')) {

            cssClass = 'edgtf-side-menu-open';
            slideWithContent = true;

        } else if (edgtf.body.hasClass('edgtf-side-area-uncovered-from-content')) {

            cssClass = 'edgtf-right-side-menu-opened';
            slideUncovered = true;

        }

        $('a.edgtf-side-menu-button-opener, a.edgtf-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                edgtf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.edgtf-wrapper .edgtf-cover').click(function() {
                        edgtf.body.removeClass('edgtf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {

                    if(Math.abs(edgtf.scroll - currentScroll) > 400){
                        edgtf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                edgtf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }
            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    edgtf.body.removeClass('edgtf-side-menu-open');
                });
            }
        });
    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function edgtfSideAreaScroll(){

        var sideMenu = $('.edgtf-side-menu');

        if(sideMenu.length){
            sideMenu.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function edgtfFullscreenMenu() {

        if ($('a.edgtf-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.edgtf-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".edgtf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edgtf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edgtf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edgtf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edgtf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.edgtf-fullscreen-menu ul li:not(.has_sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(edgtf.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edgtf.windowHeight);
            });

            if (edgtf.body.hasClass('edgtf-fade-push-text-right')) {
                cssClass = 'edgtf-push-nav-right';
                fadeRight = true;
            } else if (edgtf.body.hasClass('edgtf-fade-push-text-top')) {
                cssClass = 'edgtf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('opened')) {
                    popupMenuOpener.addClass('opened');
                    edgtf.body.addClass('edgtf-fullscreen-menu-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-fade-out').addClass('edgtf-fullscreen-fade-in');
                    edgtf.body.removeClass(cssClass);
                    if(!edgtf.body.hasClass('page-template-full_screen-php')){
                        edgtf.modules.common.edgtfDisableScroll();
                    }
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('opened');
                            edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                            edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                            edgtf.body.addClass(cssClass);
                            if(!edgtf.body.hasClass('page-template-full_screen-php')){
                                edgtf.modules.common.edgtfEnableScroll();
                            }
                            $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('opened');
                    edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                    edgtf.body.addClass(cssClass);
                    if(!edgtf.body.hasClass('page-template-full_screen-php')){
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                    $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which == 1) {
                        popupMenuOpener.removeClass('opened');
                        edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                        edgtf.body.addClass(cssClass);
                        $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                }else{
                    return false;
                }
            });
        }
    }

    function edgtfInitMobileNavigation() {
        var navigationOpener = $('.edgtf-mobile-header .edgtf-mobile-menu-opener');
        var navigationHolder = $('.edgtf-mobile-header .edgtf-mobile-nav');
        var dropdownOpener = $('.edgtf-mobile-nav .mobile_arrow, .edgtf-mobile-nav h6, .edgtf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var dropdownToOpen = $(this).nextAll('ul').first();
                    var openerParent = $(this).parent('li');
                    if(dropdownToOpen.is(':visible')) {
                        dropdownToOpen.slideUp(animationSpeed);
                        openerParent.removeClass('edgtf-opened');
                    } else {
                        dropdownToOpen.slideDown(animationSpeed);
                        openerParent.addClass('edgtf-opened');
                    }
                });
            });
        }

        $('.edgtf-mobile-nav a, .edgtf-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function edgtfMobileHeaderBehavior() {
        if(edgtf.body.hasClass('edgtf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.edgtf-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('edgtf-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('edgtf-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.edgtf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function edgtfSetDropDownMenuPosition(){

        var menuItems = $(".edgtf-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = edgtf.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(edgtf.body.hasClass('boxed')){
                menuItemFromLeft = edgtf.boxedLayoutWidth  - (menuItemPosition - (browserWidth - edgtf.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });
    }

    function edgtfDropDownMenuReInit(){
        var menu_items = $('.edgtf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide_background')) {

                    var dropdown = $(this).find('.inner');

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    var left_position = 0;
                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        left_position = dropdown.offset().left;
                        dropDownSecondDiv.css('left', -left_position);
                    }
                }
            }
        });
    }

    function edgtfDropDownMenu() {

        var menu_items = $('.edgtf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    var left_position = 0;
                    if(!$(this).hasClass('wide_background')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            left_position = (edgtf.windowWidth - 2 * (edgtf.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', edgtf.windowWidth);
                        }
                    }
                }

                if(!edgtf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(edgtf.body.hasClass('edgtf-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('edgtf-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('edgtf-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
        $('.edgtf-drop-down ul li.wide ul li a').on('click', function() {
            var $this = $(this);
            setTimeout(function() {
                $this.mouseleave();
            }, 500);

        });

        edgtf.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function edgtfSearch() {

        var searchOpener = $('a.edgtf-search-opener'),
            searchClose,
            searchForm,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( edgtf.body.hasClass( 'edgtf-fullscreen-search' ) ) {

                var fullscreenSearchFade = false,
                    fullscreenSearchFromCircle = false;

                searchClose = $( '.edgtf-fullscreen-search-close' );

                if (edgtf.body.hasClass('edgtf-search-fade')) {
                    fullscreenSearchFade = true;
                } else if (edgtf.body.hasClass('edgtf-search-from-circle')) {
                    fullscreenSearchFromCircle = true;
                }
                edgtfFullscreenSearch( fullscreenSearchFade, fullscreenSearchFromCircle );

            } else if ( edgtf.body.hasClass( 'edgtf-search-slides-from-window-top' ) ) {

                searchForm = $('.edgtf-search-slide-window-top');
                searchClose = $('.edgtf-search-close');
                edgtfSearchWindowTop();

            } else if ( edgtf.body.hasClass( 'edgtf-search-slides-from-header-bottom' ) ) {

                edgtfSearchHeaderBottom();

            } else if ( edgtf.body.hasClass( 'edgtf-search-covers-header' ) ) {

                edgtfSearchCoversHeader();
            }
        }

        /**
         * Search slides from window top type of search
         */
        function edgtfSearchWindowTop() {

            searchOpener.click( function(e) {
                e.preventDefault();

                var yPos = 0;
                if($('.title').hasClass('has_parallax_background')){
                    yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
                }

                if ( searchForm.height() == "0") {
                    $('.edgtf-search-slide-window-top input[type="text"]').focus();
                    //Push header bottom
                    edgtf.body.addClass('edgtf-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos + 50)+'px'
                    }, 150);
                } else {
                    edgtf.body.removeClass('edgtf-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos - 50)+'px'
                    }, 150);
                }

                $(window).scroll(function() {
                    if ( searchForm.height() != '0' && edgtf.scroll > 50 ) {
                        edgtf.body.removeClass('edgtf-search-open');
                        $('.title.has_parallax_background').css('backgroundPosition', 'center '+(yPos)+'px');
                    }
                });

                searchClose.click(function(e){
                    e.preventDefault();
                    edgtf.body.removeClass('edgtf-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos)+'px'
                    }, 150);
                });
            });
        }

        /**
         * Search slides from header bottom type of search
         */
        function edgtfSearchHeaderBottom() {

            var searchInput = $('.edgtf-search-slide-header-bottom input[type="submit"]');

            searchOpener.click( function(e) {
                e.preventDefault();

                //If there is form openers in multiple widgets, only one search form should be opened
                if ( $(this).closest('.edgtf-mobile-header').length > 0 ) {
                    //    Open form in mobile header
                    searchForm = $(this).closest('.edgtf-mobile-header').children().children().first();
                } else if ( $(this).closest('.edgtf-sticky-header').length > 0 ) {
                    //    Open form in sticky header
                    searchForm= $(this).closest('.edgtf-sticky-header').children().first();
                } else {
                    //Open first form in header
                    searchForm = $('.edgtf-search-slide-header-bottom').first();
                }

                if( searchForm.hasClass( 'edgtf-animated' ) ) {
                    searchForm.removeClass('edgtf-animated');
                } else {
                    searchForm.addClass('edgtf-animated');
                }

                searchForm.addClass('edgtf-disabled');
                searchInput.attr('disabled','edgtf-disabled');
                if( ( $('.edgtf-search-slide-header-bottom .edgtf-search-field').val() !== '' ) && ( $('.edgtf-search-slide-header-bottom .edgtf-search-field').val() !== ' ' ) ) {
                    searchInput.removeAttr('edgtf-disabled');
                    searchForm.removeClass('edgtf-disabled');
                } else {
                    searchForm.addClass('edgtf-disabled');
                    searchInput.attr('disabled','edgtf-disabled');
                }

                $('.edgtf-search-slide-header-bottom .edgtf-search-field').keyup(function() {
                    if( ($(this).val() !== '' ) && ( $(this).val() != ' ') ) {
                        searchInput.removeAttr('edgtf-disabled');
                        searchForm.removeClass('edgtf-disabled');
                    }
                    else {
                        searchInput.attr('disabled','edgtf-disabled');
                        searchForm.addClass('edgtf-disabled');
                    }
                });

                $('.content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.removeClass('edgtf-animated');
                });
            });

            //Submit form
            if($('.edgtf-search-submit').length) {
                $('.edgtf-search-submit').click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    searchForm.submit();
                });
            }
        }

        /**
         * Search covers header type of search
         */
        function edgtfSearchCoversHeader() {

            searchOpener.click( function(e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.edgtf-search-cover .edgtf-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if($(this).closest('.edgtf-grid').length){
                    searchForm = $(this).closest('.edgtf-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else{
                    searchForm = $(this).closest('.edgtf-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ( $(this).closest('.edgtf-sticky-header').length > 0 ) {
                    searchForm = $(this).closest('.edgtf-sticky-header').children().first();
                }
                if ( $(this).closest('.edgtf-mobile-header').length > 0 ) {
                    searchForm = $(this).closest('.edgtf-mobile-header').children().children().first();
                }

                //Find search form position in header and height
                if (searchFormLandmark.parent().hasClass('edgtf-logo-area') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfLogoAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-top-bar') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfTopBarHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-menu-area') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                } else if ( searchFormLandmark.hasClass('edgtf-sticky-header') ) {
                    searchFormHeight = edgtfGlobalVars.vars.edgtfMenuAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('edgtf-mobile-header') ) {
                    searchFormHeight = $('.edgtf-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.edgtf-search-cover input[type="text"]').focus();
                $('.edgtf-search-close, .content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function() {
                    searchForm.stop(true).fadeOut(450);
                });
            });
        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function edgtfFullscreenSearch( fade, fromCircle ) {

            var searchHolder = $( '.edgtf-fullscreen-search-holder'),
                searchOverlay = $( '.edgtf-fullscreen-search-overlay' );

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    var closeTop = $(this).offset().top;
                    var closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'edgtf-animate' ) ) {
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                        edgtf.body.addClass( 'edgtf-search-fade-out' );
                        edgtf.body.removeClass( 'edgtf-search-fade-in' );
                        searchHolder.removeClass( 'edgtf-animate' );
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    } else {
                        edgtf.body.addClass('edgtf-fullscreen-search-opened');
                        edgtf.body.removeClass('edgtf-search-fade-out');
                        edgtf.body.addClass('edgtf-search-fade-in');
                        searchHolder.addClass('edgtf-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - edgtf.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                'left' : closeLeft
                            });
                        }
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfDisableScroll();
                        }
                    }
                    searchClose.click( function(e) {
                        e.preventDefault();
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                        searchHolder.removeClass('edgtf-animate');
                        edgtf.body.removeClass('edgtf-search-fade-in');
                        edgtf.body.addClass('edgtf-search-fade-out');
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });
                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened');
                            searchHolder.removeClass('edgtf-animate');
                            edgtf.body.removeClass('edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            if(!edgtf.body.hasClass('page-template-full_screen-php')){
                                edgtf.modules.common.edgtfEnableScroll();
                            }
                        }
                    });
                }
                //Fullscreen search from circle
                if ( fromCircle ) {
                    if( searchOverlay.hasClass('edgtf-animate') ) {
                        searchOverlay.removeClass('edgtf-animate');
                        searchHolder.css({
                            'opacity': 0,
                            'display':'none'
                        });
                        searchClose.css({
                            'opacity' : 0,
                            'visibility' : 'hidden'
                        });
                        searchOpener.css({
                            'opacity': 1
                        });
                    } else {
                        searchOverlay.addClass('edgtf-animate');
                        searchHolder.css({
                            'display':'block'
                        });
                        setTimeout(function(){
                            searchHolder.css('opacity','1');
                            searchClose.css({
                                'opacity' : 1,
                                'visibility' : 'visible',
                                'top' : closeTop - edgtf.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                'left' : closeLeft
                            });
                            if (samePosition) {
                                searchClose.css({
                                    'top' : closeTop - edgtf.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                    'left' : closeLeft
                                });
                            }
                            searchOpener.css({
                                'opacity' : 0
                            });
                        },200);
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfDisableScroll();
                        }
                    }
                    searchClose.click(function(e) {
                        e.preventDefault();
                        searchOverlay.removeClass('edgtf-animate');
                        searchHolder.css({
                            'opacity' : 0,
                            'display' : 'none'
                        });
                        searchClose.css({
                            'opacity':0,
                            'visibility' : 'hidden'
                        });
                        searchOpener.css({
                            'opacity' : 1
                        });
                        if(!edgtf.body.hasClass('page-template-full_screen-php')){
                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });
                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            searchOverlay.removeClass('edgtf-animate');
                            searchHolder.css({
                                'opacity' : 0,
                                'display' : 'none'
                            });
                            searchClose.css({
                                'opacity':0,
                                'visibility' : 'hidden'
                            });
                            searchOpener.css({
                                'opacity' : 1
                            });
                            if(!edgtf.body.hasClass('page-template-full_screen-php')){
                                edgtf.modules.common.edgtfEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.edgtf-fullscreen-search-holder .edgtf-search-field').focus(function(){
                $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line').css("width","100%");
            });

            $('.edgtf-fullscreen-search-holder .edgtf-search-field').blur(function(){
                $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line').css("width","0");
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    edgtf.modules.title = title;

    title.edgtfParallaxTitle = edgtfParallaxTitle;

    $(document).ready(function() {
        edgtfParallaxTitle();
    });

    $(window).load(function() {


    });

    $(window).resize(function() {

    });

    /*
     **	Title image with parallax effect
     */
    function edgtfParallaxTitle(){
        if($('.edgtf-title.edgtf-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.edgtf-title.edgtf-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.edgtf-title.edgtf-has-parallax-background.edgtf-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(edgtf.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+edgtfGlobalVars.vars.edgtfAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-edgtf.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(edgtf.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+edgtfGlobalVars.vars.edgtfAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-edgtf.scroll + 'px auto'});
            });

        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    edgtf.modules.shortcodes = shortcodes;

    shortcodes.edgtfInitCounter = edgtfInitCounter;
    shortcodes.edgtfInitProgressBars = edgtfInitProgressBars;
    shortcodes.edgtfInitCountdown = edgtfInitCountdown;
    shortcodes.edgtfInitMessages = edgtfInitMessages;
    shortcodes.edgtfInitMessageHeight = edgtfInitMessageHeight;
    shortcodes.edgtfInitTestimonials = edgtfInitTestimonials;
    shortcodes.edgtfInitCarousels = edgtfInitCarousels;
    shortcodes.edgtfInitCircleCarousels = edgtfInitCircleCarousels;
    shortcodes.edgtfInitPieChart = edgtfInitPieChart;
    shortcodes.edgtfInitTabs = edgtfInitTabs;
    shortcodes.edgtfInitTabIcons = edgtfInitTabIcons;
    shortcodes.edgtfInitBlogListCheckered = edgtfInitBlogListCheckered;
    shortcodes.edgtfCustomFontResize = edgtfCustomFontResize;
    shortcodes.edgtfInitImageGallery = edgtfInitImageGallery;
    shortcodes.edgtfInitCarouselWithImageAndText = edgtfInitCarouselWithImageAndText;
    shortcodes.edgtfInitAccordions = edgtfInitAccordions;
    shortcodes.edgtfShowGoogleMap = edgtfShowGoogleMap;
    shortcodes.edgtfInitPortfolioListMasonry = edgtfInitPortfolioListMasonry;
    shortcodes.edgtfInitPortfolioListPinterest = edgtfInitPortfolioListPinterest;
    shortcodes.edgtfInitPortfolio = edgtfInitPortfolio;
    shortcodes.edgtfInitPortfolioMasonryFilter = edgtfInitPortfolioMasonryFilter;
    shortcodes.edgtfInitPortfolioSlider = edgtfInitPortfolioSlider;
    shortcodes.edgtfInitPortfolioLoadMore = edgtfInitPortfolioLoadMore;
    shortcodes.edgtfInitInfoCard = edgtfInitInfoCard;
    shortcodes.edgtfInitUnorderedListAnimation = edgtfInitUnorderedListAnimation;
    shortcodes.edgtfInitFlyingDeck = edgtfInitFlyingDeck;
    shortcodes.edgtfInitExapandableRow = edgtfInitExapandableRow;
    shortcodes.edgtfInitScrollingImage = edgtfInitScrollingImage;

    $(document).ready(function() {
        edgtfInitCounter();
        edgtfInitProgressBars();
        edgtfInitCountdown();
        edgtfIcon().init();
        edgtfIconWithSeparator().init();
        edgtfInitMessages();
        edgtfInitMessageHeight();
        edgtfInitTestimonials();
        edgtfInitCarousels();
        edgtfInitCircleCarousels();
        edgtfInitPieChart();
		edgtfInitTabs();
        edgtfInitTabIcons();
        edgtfButton().init();
		edgtfCustomFontResize();
        edgtfInitImageGallery();
        edgtfInitCarouselWithImageAndText();
        edgtfInitAccordions();
        edgtfShowGoogleMap();
        edgtfInitPortfolioListMasonry();
        edgtfInitPortfolioListPinterest();
        edgtfInitPortfolio();
        edgtfInitPortfolioMasonryFilter();
        edgtfInitPortfolioSlider();
        edgtfInitPortfolioLoadMore();
        edgtfInitUnorderedListAnimation();
        edgtfInitExapandableRow();
        edgtfInitScrollingImage();
    });

    $(window).load(function(){
        edgtfInitBlogListCheckered();
        edgtfInitInfoCard();
        edgtfInitFlyingDeck();
    });

    $(window).resize(function(){
        edgtfInitBlogListCheckered();
		edgtfCustomFontResize();
        edgtfInitPortfolioListMasonry();
        edgtfInitPortfolioListPinterest();
        edgtfInitInfoCard();
    });

    /**
     * Counter Shortcode
     */
    function edgtfInitCounter() {

        var counters = $('.edgtf-counter');

        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                var decimalsValue = 0;
                if(typeof counter.data('decimals-value') !== 'undefined' && counter.data('decimals-value') !== false && counter.data('decimals-value') !== '') {
                    decimalsValue = counter.data('decimals-value');
                }
                counter.appear(function() {
                    counter.parents('.edgtf-counter-holder').addClass('edgtf-counter-holder-show');

                    var max = parseFloat(counter.text());
                    counter.countTo({
                        from: 0,
                        to: max,
                        speed: 1500,
                        refreshInterval: 100,
                        decimals: decimalsValue
                    });

                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

        /*
    **	Horizontal progress bars shortcode
    */
    function edgtfInitProgressBars(){

        var progressBar = $('.edgtf-progress-bar');

        if(progressBar.length){

            progressBar.each(function() {

                var thisBar = $(this);

                thisBar.appear(function() {
                    edgtfInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.edgtf-floating.edgtf-floating-inside') !== 0){
                        var floatingInsideMargin = thisBar.find('.edgtf-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.edgtf-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.edgtf-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.edgtf-floating-inside').css('margin-bottom',-(floatingInsideMargin)+'px');
                    }
                    var percentage = thisBar.find('.edgtf-progress-content').data('percentage'),
                        progressContent = thisBar.find('.edgtf-progress-content'),
                        progressNumber = thisBar.find('.edgtf-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }
    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function edgtfInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.edgtf-progress-content').data('percentage'));
        var percent = progressBar.find('.edgtf-progress-number .edgtf-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.edgtf-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /*
    **	Function to close message shortcode
    */
    function edgtfInitMessages(){
        var message = $('.edgtf-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.edgtf-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }

    /*
    **	Init message height
    */
   function edgtfInitMessageHeight(){
       var message = $('.edgtf-message.edgtf-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.edgtf-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.edgtf-message-icon-holder').height();

               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.edgtf-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.edgtf-message-text-holder').height(iconHolderHeight);
               }
           });
       }
   }

    /**
     * Countdown Shortcode
     */
    function edgtfInitCountdown() {

        var countdowns = $('.edgtf-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var edgtfIcon = edgtf.modules.shortcodes.edgtfIcon = function() {
        //get all icons on page
        var icons = $('.edgtf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('edgtf-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.edgtf-icon-animation-holder').addClass('edgtf-icon-animation-show');
                }, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.edgtf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents icon with separator shortcode
     * @returns {{init: Function}} function that initializes icon with separator's functionality
     */
    var edgtfIconWithSeparator = edgtf.modules.shortcodes.edgtfIconWithSeparator = function() {
        //get all icon with separator on page
        var icon_with_separator = $('.edgtf-iws');

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon_with_separator) {
            if(typeof icon_with_separator.data('iws-icon-hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon_with_separator.find('.edgtf-icon-element');
                var hoverColor = icon_with_separator.data('iws-icon-hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon_with_separator.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon_with_separator.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers title color hover functionality
         */
        var titleHoverColor = function(icon_with_separator) {
            if(typeof icon_with_separator.data('iws-title-hover-color') !== 'undefined') {
                var changeTitleColor = function(event) {
                    event.data.title.css('color', event.data.color);
                };

                var titleElement = icon_with_separator.find('.edgtf-iws-title-holder > *');
                var hoverTitleColor = icon_with_separator.data('iws-title-hover-color');
                var originalTitleColor = titleElement.css('color');

                if(hoverTitleColor !== '') {
                    icon_with_separator.on('mouseenter', {title: titleElement, color: hoverTitleColor}, changeTitleColor);
                    icon_with_separator.on('mouseleave', {title: titleElement, color: originalTitleColor}, changeTitleColor);
                }
            }
        };


        /**
         * Function that triggers lines width on hover
         */
        var linesWidthHover = function(icon_with_separator) {
            if(typeof icon_with_separator.data('iws-lines-width') !== 'undefined') {
                var changeLinesWidth = function(event) {
                    event.data.lines.css('width', event.data.width);
                };

                var linesElement = icon_with_separator.find('.edgtf-line');
                var hoverWidth = icon_with_separator.data('iws-lines-width');

                if(hoverWidth   !== '') {
                    icon_with_separator.on('mouseenter', {lines: linesElement, width: hoverWidth + 'px'}, changeLinesWidth );
                    icon_with_separator.on('mouseleave', {lines: linesElement, width: '0'}, changeLinesWidth );
                }
            }
        };

        return {
            init: function() {
                if(icon_with_separator.length) {
                    icon_with_separator.each(function() {
                        iconHoverColor($(this));
                        titleHoverColor($(this));
                        linesWidthHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function edgtfInitTestimonials(){

        var testimonial = $('.edgtf-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

                var interval = 5000;

                var slideAnimation = 'Slide'; //default slide animation

                if (thisTestimonial.hasClass('edgtf-with-icon')){
                    slideAnimation = 'SlideRotate'; // change to slide rotate if icon present
                }

                var maxHeight = '';

                thisTestimonial.find('.edgtf-testimonial-content').each(function(){

                    if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }

                });

                maxHeight = maxHeight + 10; //overflow fix
                //return max height of all testimonials

                var controlNav = typeof thisTestimonial.data('pagination') !== 'undefined' && thisTestimonial.data('pagination') === 'yes';
                var directionNav = typeof thisTestimonial.data('navigation') !== 'undefined' && thisTestimonial.data('navigation') === 'yes';

                var animationSpeed = 600;

                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

                thisTestimonial.owlCarousel({
                    singleItem: true,
                    // autoPlay: interval;
                    autoPlay: false,
                    navigation: directionNav,
                    transitionStyle : slideAnimation, //fade, fadeUp, backSlide, goDown - 'out-of-the-box' defaults
                    autoHeight: true,
                    addClassActive: true,
                    pagination: controlNav,
                    slideSpeed: animationSpeed,
                    navigationText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-testimonial-icon arrow_left"></span><span class="edgtf-navigation-counter"></span></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"></span><span class="edgtf-testimonial-icon arrow_right"></span></span></span>'
                    ],
                    beforeInit : beforeInit,
                    afterAction : afterAction,
                    beforeMove: beforeMove,
                    afterMove: afterMove
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

                    updateResult(".edgtf-prev-icon .edgtf-navigation-counter", numberOfPreviousSlide);
                    updateResult(".edgtf-next-icon .edgtf-navigation-counter", numberOfNextSlide);
                }

                function updateResult(pos,value){
                    thisTestimonial.find(pos).text(value);
                }

                function beforeInit() {
                    if(thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode').length) {
                        thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode:last-child').css({
                            '-webkit-transform':'translate(-50%,-'+maxHeight+'px)',
                            '-moz-transform':'translate(-50%,-'+maxHeight+'px)',
                            'transform': 'translate(-50%,-'+maxHeight+'px)'
                        });
                    }
                    if(thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-custom-image').length) {
                        thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-custom-image:last-child').css({
                            '-webkit-transform':'translate(-50%,-'+maxHeight+'px)',
                            '-moz-transform':'translate(-50%,-'+maxHeight+'px)',
                            'transform': 'translate(-50%,-'+maxHeight+'px)'
                        });
                    }
                }

                function beforeMove(){
                    if(thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode').length) {
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode:first-child').css({
                            '-webkit-transform':'translateY('+maxHeight+'px)',
                            '-moz-transform':'translateY('+maxHeight+'px)',
                            'transform': 'translateY('+maxHeight+'px)'
                        });
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode:last-child').css({
                            '-webkit-transform':'translate(-50%,0%)',
                            '-moz-transform':'translate(-50%,0%)',
                            'transform': 'translate(-50%,0%)'
                        });
                    }
                    if(thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-custom-image').length) {
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-custom-image:first-child').css({
                            '-webkit-transform':'translateY('+maxHeight+'px)',
                            '-moz-transform':'translateY('+maxHeight+'px)',
                            'transform': 'translateY('+maxHeight+'px)'
                        });
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-custom-image:last-child').css({
                            '-webkit-transform':'translate(-50%,0%)',
                            '-moz-transform':'translate(-50%,0%)',
                            'transform': 'translate(-50%,0%)'
                        });
                    }
                }

                function afterMove(){
                    if(thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode').length) {
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode:first-child').css({
                            '-webkit-transform':'translateY(0)',
                            '-moz-transform':'translateY(0)',
                            'transform': 'translateY(0)'
                        });
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-icon-shortcode:last-child').css({
                            '-webkit-transform':'translate(-50%,-'+maxHeight+'px)',
                            '-moz-transform':'translate(-50%,-'+maxHeight+'px)',
                            'transform': 'translate(-50%,-'+maxHeight+'px)'
                        });
                    }
                    if(thisTestimonial.find('.edgtf-testimonial-icon-inner > .edgtf-custom-image').length) {
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-custom-image:first-child').css({
                            '-webkit-transform':'translateY(0)',
                            '-moz-transform':'translateY(0)',
                            'transform': 'translateY(0)'
                        });
                        $('.edgtf-with-icon .active').find('.edgtf-testimonial-icon-inner > .edgtf-custom-image:last-child').css({
                            '-webkit-transform':'translate(-50%,-'+maxHeight+'px)',
                            '-moz-transform':'translate(-50%,-'+maxHeight+'px)',
                            'transform': 'translate(-50%,-'+maxHeight+'px)'
                        });
                    }
                }
            });
        }
    }

    /*
    **  Unordered list animation effect
    */
    function edgtfInitUnorderedListAnimation(){

        if($('.edgtf-animate-list').length > 0){
            $('.edgtf-animate-list').each(function(){
                var thisAnimateList = $(this);

                thisAnimateList.appear(function() {
                    thisAnimateList.find("li").each(function (l) {
                        var k = $(this);
                        setTimeout(function () {
                            k.animate({
                                opacity: 1,
                                top: 0
                            }, 1500);
                        }, 100*l);
                    });
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

    /**
     * Init Carousel shortcode
     */
    function edgtfInitCarousels() {

        var carouselHolders = $('.edgtf-carousel-holder'),
            carousel,
            numberOfItems,
            navigation;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                carousel = $(this).children('.edgtf-carousel');
                numberOfItems = carousel.data('items');
                navigation = (carousel.data('navigation') == 'yes') ? true : false;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                carousel.owlCarousel({
                    autoPlay: 3000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: false,
                    navigation: navigation,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-carousel-icon arrow_left"></span><span class="edgtf-navigation-counter"></span></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"></span><span class="edgtf-carousel-icon arrow_right"></span></span></span>'
                    ],
                    afterAction : afterAction
                });

                function afterAction() {
                    /*jshint validthis: true */

                    var numberOfNextSlide;
                    var numberOfPreviousSlide;
                    var numberOfSliders = this.owl.owlItems.length;

                    if (numberOfSliders > numberOfItems) {
                        numberOfPreviousSlide = (this.owl.currentItem !== 0) ? (this.owl.currentItem) : this.owl.owlItems.length;
                        numberOfNextSlide = (this.owl.currentItem + (numberOfItems) !== this.owl.owlItems.length) ? (this.owl.currentItem + (numberOfItems + 1)) : 1;

                    }
                    else {
                        numberOfPreviousSlide = numberOfNextSlide = 1;
                    }

                    updateResult(".edgtf-prev-icon .edgtf-navigation-counter", numberOfPreviousSlide);
                    updateResult(".edgtf-next-icon .edgtf-navigation-counter", numberOfNextSlide);
                }

                function updateResult(pos,value){
                    carousel.find(pos).text(value);
                }
            });
        }
    }

    /**
     * Init Circle Carousel shortcode
     */
    function edgtfInitCircleCarousels() {

        var circleCarouselHolders = $('.edgtf-circle-carousel'),
            circleCarouselHeight,
            circleCarouselAutoPlay,
            circleCarouselSpeed,
            circleCarouselSeparation,
            circleCarouselFlankingItems,
            circleCarouselEdgeFadeEnabled,
            circleCarouselSizeMultiplier,
            circleCarouselNavigationClass;

        if (circleCarouselHolders.length) {
            circleCarouselHolders.each(function(){

                var thiscircleCarouselHolders = $(this);

                var circleCarousel = thiscircleCarouselHolders.children('.edgtf-circle-carousel-slider');
                var circleCarouselNavigation = thiscircleCarouselHolders.children('.edgtf-circle-carousel-navigation');

                thiscircleCarouselHolders.appear(function() {
                    thiscircleCarouselHolders.css('visibility','visible');
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

                circleCarouselHeight = (thiscircleCarouselHolders.data('height') !== '' && thiscircleCarouselHolders.data('height') !== undefined) ? thiscircleCarouselHolders.data('height') : 480;
                circleCarouselAutoPlay = (thiscircleCarouselHolders.data('autoplay') !== '' && thiscircleCarouselHolders.data('autoplay') !== undefined) ? thiscircleCarouselHolders.data('autoplay') : 3000;
                circleCarouselSpeed = (thiscircleCarouselHolders.data('speed') !== '' && thiscircleCarouselHolders.data('speed') !== undefined) ? thiscircleCarouselHolders.data('speed') : 800;
                circleCarouselSeparation = (thiscircleCarouselHolders.data('separation') !== '' && thiscircleCarouselHolders.data('separation') !== undefined) ? thiscircleCarouselHolders.data('separation') : 425;
                circleCarouselFlankingItems = (thiscircleCarouselHolders.data('flankingitems') !== '' && thiscircleCarouselHolders.data('flankingitems') !== undefined) ? thiscircleCarouselHolders.data('flankingitems') : 1;
                circleCarouselEdgeFadeEnabled = (thiscircleCarouselHolders.data('edgefadeenabled') !== '' && thiscircleCarouselHolders.data('edgefadeenabled') !== undefined) ? thiscircleCarouselHolders.data('edgefadeenabled') : false;
                circleCarouselSizeMultiplier = (thiscircleCarouselHolders.data('sizemultiplier') !== '' && thiscircleCarouselHolders.data('sizemultiplier') !== undefined) ? thiscircleCarouselHolders.data('sizemultiplier') : 0.7;
                circleCarouselNavigationClass = (thiscircleCarouselHolders.data('navigation') === 'no') ? 'edgtf-circle-carousel-navigation-disabled' : '';

                thiscircleCarouselHolders.addClass(circleCarouselNavigationClass);

                circleCarousel.css({'height':circleCarouselHeight});

                if(edgtf.windowWidth < 1457 && edgtf.windowWidth > 1200) {
                    if (circleCarouselSeparation > 325) {
                        circleCarouselSeparation = 325;
                    }
                } else if (edgtf.windowWidth < 1217 && edgtf.windowWidth > 1024) {
                    circleCarouselSeparation = 250;
                } else if (edgtf.windowWidth < 1025 && edgtf.windowWidth > 768) {
                    circleCarouselSeparation = 220;
                } else if (edgtf.windowWidth < 769 && edgtf.windowWidth > 600) {
                    circleCarouselSeparation = 180;
                    circleCarousel.css({'height':circleCarouselHeight*0.9});
                } else if (edgtf.windowWidth < 601 && edgtf.windowWidth > 480) {
                    circleCarouselSeparation = 160;
                    circleCarousel.css({'height':circleCarouselHeight*0.8});
                } else if (edgtf.windowWidth < 481) {
                    circleCarouselSeparation = 100;
                    circleCarousel.css({'height':circleCarouselHeight*0.7});
                }

                circleCarousel.waterwheelCarousel({
                    autoPlay: circleCarouselAutoPlay,
                    speed: circleCarouselSpeed,
                    flankingItems: circleCarouselFlankingItems,
                    separation: circleCarouselSeparation,
                    opacityMultiplier: 1,
                    edgeFadeEnabled: circleCarouselEdgeFadeEnabled,
                    sizeMultiplier: circleCarouselSizeMultiplier,
                    preloadImages: true,
                    activeClassName: 'edgtf-circle-carousel-active',
                    movingToCenter: function($item) {
                        afterAction($item);
                    }
                });

                circleCarouselNavigation.find('.edgtf-circle-carousel-icon.arrow_left').on('click', function(e) {
                    e.preventDefault();
                    circleCarousel.prev();
                });

                circleCarouselNavigation.find('.edgtf-circle-carousel-icon.arrow_right').on('click', function(e) {
                    e.preventDefault();
                    circleCarousel.next();
                });

                if(!thiscircleCarouselHolders.hasClass('edgtf-circle-carousel-init') && !thiscircleCarouselHolders.hasClass('edgtf-circle-carousel-navigation-disabled')) {
                    thiscircleCarouselHolders.addClass('edgtf-circle-carousel-init');
                    var numberOfSlidesFirstLoad = circleCarousel.children().length - 1;

                    updateResult(circleCarouselNavigation.find('.edgtf-prev-icon-holder .edgtf-navigation-counter'), 0);
                    updateResult(circleCarouselNavigation.find('.edgtf-next-icon-holder .edgtf-navigation-counter'), numberOfSlidesFirstLoad);
                }

                function afterAction($item) {
                    if (!thiscircleCarouselHolders.hasClass('edgtf-circle-carousel-navigation-disabled')) {
                        var numberOfNextSlide, numberOfPreviousSlide, numberOfSlides, currentItemPosition;

                        numberOfSlides = circleCarousel.children().length;
                        currentItemPosition = circleCarousel.children().index($item);

                        if (numberOfSlides > 1) {
                            numberOfPreviousSlide = (currentItemPosition !== 0) ? (currentItemPosition) : numberOfSlides;
                            numberOfNextSlide = (currentItemPosition !== numberOfSlides - 1) ? (numberOfSlides - currentItemPosition - 1) : numberOfSlides;
                        }
                        else {
                            numberOfPreviousSlide = numberOfNextSlide = 0;
                        }

                        updateResult(circleCarouselNavigation.find('.edgtf-prev-icon-holder .edgtf-navigation-counter'), numberOfPreviousSlide);
                        updateResult(circleCarouselNavigation.find('.edgtf-next-icon-holder .edgtf-navigation-counter'), numberOfNextSlide);
                    }
                }

                function updateResult(pos,value){
                    circleCarouselNavigation.find(pos).text(value);
                }
            });
        }
    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function edgtfInitPieChart() {

        var pieCharts = $('.edgtf-pie-chart-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.edgtf-percentage'),
                    barColor = pieChart.children('.edgtf-percentage').data('barcolor'),
                    trackColor = pieChart.children('.edgtf-percentage').data('trackcolor'),
                    lineWidth = pieChart.children('.edgtf-percentage').data('linewidth'),
                    size = 132;

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});
            });
        }
    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.edgtf-to-counter-inner'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /*
    **	Init tabs shortcode
    */
    function edgtfInitTabs(){

       var tabs = $('.edgtf-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this);

                if(thisTabs.hasClass('edgtf-horizontal-tab')){
                    thisTabs.tabs({
                        activate: function( event, ui ) {
                            if(thisTabs.find('.edgtf-portfolio-list-holder-outer.edgtf-ptf-masonry')){
                                edgtfInitPortfolioListMasonry();
                            }
                            if(thisTabs.find('.edgtf-portfolio-list-holder-outer.edgtf-ptf-pinterest')){
                                edgtfInitPortfolioListPinterest();
                            }
                            if(thisTabs.find('.edgtf-portfolio-list-holder-outer')){
                                edgtfInitPortfolio();
                            }
                            if(thisTabs.find('.edgtf-portfolio-list-holder-outer.edgtf-portfolio-slider-holder')){
                                edgtfInitPortfolioSlider();
                            }
                        }
                    });
                }
                else if(thisTabs.hasClass('edgtf-vertical-tab')){
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.edgtf-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /*
    **	Generate icons in tabs navigation
    */
    function edgtfInitTabIcons(){

        var tabContent = $('.edgtf-tab-container');
        if(tabContent.length){

            tabContent.each(function(){
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.edgtf-tabs').find('.edgtf-tabs-nav > li > a[href=#'+id+']');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.edgtf-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var edgtfButton = edgtf.modules.shortcodes.edgtfButton = function() {
        //all buttons on the page
        var buttons = $('.edgtf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('border-color');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };

    /*
    **	Init blog list checkered type
    */
    function edgtfInitBlogListCheckered(){
        var blogList = $('.edgtf-blog-list-holder.edgtf-checkered .edgtf-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});

                thisBlogList.find('.edgtf-item-text-holder').css('height',thisBlogList.find('.edgtf-item-image').height());
            });
        }
    }

    /*
    **  Init info card functionality
    */
    function edgtfInitInfoCard(){
        var infoCard = $('.edgtf-info-card-holder');
        if(infoCard.length) {
            infoCard.each(function() {
                var thisInfoCard = $(this);
                thisInfoCard.animate({opacity: 1});

                var initialHeight = thisInfoCard.find('.edgtf-info-card-initial .edgtf-info-card-inner').height();
                var hoverHeight = thisInfoCard.find('.edgtf-info-card-hover .edgtf-info-card-inner').height();

                if(initialHeight > hoverHeight) {
                    thisInfoCard.find('.edgtf-info-card-hover .edgtf-info-card-inner').css('min-height', initialHeight);
                } else if(initialHeight < hoverHeight) {
                    thisInfoCard.find('.edgtf-info-card-initial .edgtf-info-card-inner').css('min-height', hoverHeight);
                }
            });
        }
    }

	/*
	**	Custom Font resizing
	*/
	function edgtfCustomFontResize(){
		var customFont = $('.edgtf-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (edgtf.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (edgtf.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (edgtf.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (edgtf.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (edgtf.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && edgtf.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && edgtf.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function edgtfShowGoogleMap(){

        if($('.edgtf-google-map').length){
            $('.edgtf-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "edgtf-map-"+ uniqueId;

                edgtfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function edgtfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'edgtf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Edge Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgtf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('edgtf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            edgtfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function edgtfInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function edgtfInitAccordions(){
        var accordion = $('.edgtf-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('edgtf-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edgtf-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.edgtf-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function edgtfInitImageGallery() {

        var galleries = $('.edgtf-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.edgtf-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes'),
                    numberOfItems = (gallery.data('column') !== '') ? gallery.data('column') : '3',
                    singleItem = (numberOfItems == '1');

                gallery.owlCarousel({
                    singleItem: singleItem,
                    items: numberOfItems,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle: animation, //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-previous"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-left"></i></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-next"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-right"></i></span></span>'
                    ],
                    afterAction : afterAction
                });

                function afterAction() {
                    /*jshint validthis: true */

                    var numberOfNextSlide, numberOfPreviousSlide, numberOfSliders;
                    numberOfSliders = this.owl.owlItems.length;

                    if (numberOfSliders > numberOfItems) {
                        numberOfPreviousSlide = (this.owl.currentItem !== 0) ? (this.owl.currentItem) : this.owl.owlItems.length;
                        numberOfNextSlide = (this.owl.currentItem + (numberOfItems) !== this.owl.owlItems.length) ? (this.owl.currentItem + (numberOfItems + 1)) : 1;

                    }
                    else {
                        numberOfPreviousSlide = numberOfNextSlide = 1;
                    }

                    updateResult(".edgtf-navigation-counter-previous", numberOfPreviousSlide);
                    updateResult(".edgtf-navigation-counter-next", numberOfNextSlide);
                    updateResult(".edgtf-navigation-counter-number", numberOfSliders);
                }

                function updateResult(pos,value){
                    gallery.find(pos).text(value);
                }
            });

        }
    }

    function edgtfInitCarouselWithImageAndText() {

        var galleries = $('.edgtf-carousel-with-image-and-text');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.edgtf-carousel-with-image-and-text-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes'),
                    numberOfShownSlides = gallery.data('number_of_slides') ? gallery.data('number_of_slides') : 3 ;

                gallery.owlCarousel({
                    items: numberOfShownSlides,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle: animation, //fade, fadeUp, backSlide, goDown
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-previous"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-left"></i></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-next"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-right"></i></span></span>'
                    ],
                    afterAction : afterAction
                });

                function afterAction() {
                    /*jshint validthis: true */

                    var numberOfNextSlide, numberOfPreviousSlide, numberOfSliders;
                    numberOfSliders = this.owl.owlItems.length;

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
                    gallery.find(pos).text(value);
                }

            });

        }
    }
    /**
     * Initializes portfolio list
     */
    function edgtfInitPortfolio(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-standard, .edgtf-portfolio-list-holder-outer.edgtf-ptf-gallery');
        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this);
                thisPortList.appear(function(){
                    edgtfInitPortMixItUp(thisPortList);
                });
                edgtfInitPortFilterCounter(thisPortList);
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function edgtfInitPortMixItUp(container){
        var filterClass = '';
        if(container.hasClass('edgtf-ptf-has-filter')){
            filterClass = container.find('.edgtf-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }

        var holderInner = container.find('.edgtf-portfolio-list-holder');
        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css('visibility','visible');
                    holderInner.mixItUp('setOptions', {
                        animation: {
                            enable: true,
                            effect: 'fade',
                            duration: 600
                        }
                    });
                },
                onMixStart: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');
                }
            },
            selectors: {
                filter: filterClass
            },
            animation: {
                enable: false
            }
        });
    }
    /**
     * Initializes filter counter
     * Category name is second item in class array by default
     */
    function edgtfInitPortFilterCounter(container){

        if(container.hasClass('edgtf-ptf-has-filter')){
            var articles = (container.find('article'));
            var filters = (container.find('.edgtf-portfolio-filter-holder-inner ul li'));

            filters.each(function(){
                var item = $(this);

                if((item).data('filter') == 'all'){
                    updateResult(item,".edgtf-portfolio-filter-counter", articles.length);
                }
                else{
                    var categoryClass = item.attr('class').split(' ')[1];
                    updateResult(item,".edgtf-portfolio-filter-counter", container.find('article.'+categoryClass).length);
                }

            });

            filters.css('opacity','1');

        }

        function updateResult(item, pos ,value){
            item.find(pos).text(value);
        }
    }
     /*
    **	Init portfolio list masonry type
    */
    function edgtfInitPortfolioListMasonry(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-masonry');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.edgtf-portfolio-list-holder');
                var size = thisPortList.find('.edgtf-portfolio-list-masonry-grid-sizer').width();
                edgtfResizeMasonry(size,thisPortList);

                edgtfInitMasonry(thisPortList);
                $(window).resize(function(){
                    edgtfResizeMasonry(size,thisPortList);
                    edgtfInitMasonry(thisPortList);
                });
            });
        }
    }

    function edgtfInitMasonry(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.edgtf-portfolio-item',
            masonry: {
                columnWidth: '.edgtf-portfolio-list-masonry-grid-sizer'
            }
        });
    }

    function edgtfResizeMasonry(size,container){

        var defaultMasonryItem = container.find('.edgtf-default-masonry-item');
        var largeWidthMasonryItem = container.find('.edgtf-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.edgtf-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.edgtf-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2*size));

        if(edgtf.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeWidthMasonryItem.css('height', size);
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size/2));

        }
    }
    /**
     * Initializes portfolio pinterest
     */
    function edgtfInitPortfolioListPinterest(){

        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-pinterest');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.edgtf-portfolio-list-holder');
                edgtfInitPinterest(thisPortList);
                $(window).resize(function(){
                     edgtfInitPinterest(thisPortList);
                });
            });

        }
    }

    function edgtfInitPinterest(container){

        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.edgtf-portfolio-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.edgtf-portfolio-list-masonry-grid-sizer'
            }
        });

    }
    /**
     * Initializes portfolio masonry filter
     */
    function edgtfInitPortfolioMasonryFilter(){

        var filterHolder = $('.edgtf-portfolio-filter-holder.edgtf-masonry-filter');

        if(filterHolder.length){
            filterHolder.each(function(){

                var thisFilterHolder = $(this);

                var portfolioIsotopeAnimation = null;

                var filter = thisFilterHolder.find('ul li').data('class');

                thisFilterHolder.find('.filter:first').addClass('current');

                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s');
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.edgtf-portfolio-list-holder-outer').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });

            });
        }
    }
    /**
     * Initializes portfolio slider
     */

    function edgtfInitPortfolioSlider(){
        var portSlider = $('.edgtf-portfolio-list-holder-outer.edgtf-portfolio-slider-holder');
        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.edgtf-portfolio-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var navigation = (thisPortSlider.data('navigation') == 'yes') ? true : false;
                var pagination = (thisPortSlider.data('pagination') == 'yes') ? true : false;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                sliderWrapper.owlCarousel({
                    autoPlay: 5000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: pagination,
                    navigation: navigation,
                    mouseDrag : false,
                    slideSpeed: 600,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    navigationText: [
                        '<span class="edgtf-prev-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-previous"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-left"></i></span></span>',
                        '<span class="edgtf-next-icon"><span class="edgtf-owl-icon-inner"><span class="edgtf-navigation-counter"><span class="edgtf-navigation-counter-next"></span>/<span class="edgtf-navigation-counter-number"></span></span><i class="icon-arrows-slim-right"></i></span></span>'
                    ],
                    afterAction : afterAction
                });


                function afterAction() {
                    /*jshint validthis: true */

                    var numberOfNextSlide, numberOfPreviousSlide, numberOfSliders;
                    numberOfSliders = this.owl.owlItems.length;

                    if (numberOfSliders > numberOfItems) {
                        numberOfPreviousSlide = (this.owl.currentItem !== 0) ? (this.owl.currentItem) : this.owl.owlItems.length;
                        numberOfNextSlide = (this.owl.currentItem + (numberOfItems) !== this.owl.owlItems.length) ? (this.owl.currentItem + (numberOfItems + 1)) : 1;

                    }
                    else {
                        numberOfPreviousSlide = numberOfNextSlide = 1;
                    }

                    updateResult(".edgtf-navigation-counter-previous", numberOfPreviousSlide);
                    updateResult(".edgtf-navigation-counter-next", numberOfNextSlide);
                    updateResult(".edgtf-navigation-counter-number", numberOfSliders);
                }

                function updateResult(pos,value){
                    sliderWrapper.find(pos).text(value);
                }


            });
        }
    }
    /**
     * Initializes portfolio load more function
     */
    function edgtfInitPortfolioLoadMore(){
        var portList = $('.edgtf-portfolio-list-holder-outer.edgtf-ptf-load-more');
        if(portList.length){
            portList.each(function(){

                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.edgtf-portfolio-list-holder');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.edgtf-ptf-list-load-more a');

                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
                    maxNumPages = thisPortList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {
                    var loadMoreDatta = edgtfGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();

                    if(nextPage <= maxNumPages){
                        var ajaxData = edgtfSetPortfolioAjaxData(loadMoreDatta);

                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgtCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = edgtfConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with
                                thisPortList.waitForImages(function(){
                                    setTimeout(function() {
                                        if(thisPortList.hasClass('edgtf-ptf-masonry') || thisPortList.hasClass('edgtf-ptf-pinterest') ){
                                            thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');
                                        } else {
                                            thisPortListInner.mixItUp('append',responseHtml);
                                        }
                                        edgtfInitPortFilterCounter(thisPortList);
                                    },400);
                                });
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
            });
        }
    }

    function edgtfConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    }

    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function edgtfGetPortfolioAjaxData(container){
        var returnValue = {};

        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.display_excerpt = '';
        returnValue.excerpt_length = '';
        returnValue.display_category = '';
        returnValue.display_link = '';
        returnValue.display_lightbox = '';
        returnValue.display_title = '';

        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('display_title') !== 'undefined' && container.data('display_title') !== false) {
            returnValue.display_title = container.data('display_title');
        }
        if (typeof container.data('display_separator') !== 'undefined' && container.data('display_separator') !== false) {
            returnValue.display_separator = container.data('display_separator');
        }
        if (typeof container.data('display_excerpt') !== 'undefined' && container.data('display_excerpt') !== false) {
            returnValue.display_excerpt = container.data('display_excerpt');
        }
        if (typeof container.data('excerpt_length') !== 'undefined' && container.data('excerpt_length') !== false) {
            returnValue.excerpt_length = container.data('excerpt_length');
        }
        if (typeof container.data('display_category') !== 'undefined' && container.data('display_category') !== false) {
            returnValue.display_category = container.data('display_category');
        }
        if (typeof container.data('display_link') !== 'undefined' && container.data('display_link') !== false) {
            returnValue.display_link = container.data('display_link');
        }
        if (typeof container.data('display_lightbox') !== 'undefined' && container.data('display_lightbox') !== false) {
            returnValue.display_lightbox = container.data('display_lightbox');
        }
        if (typeof container.data('space_between_items') !== 'undefined' && container.data('space_between_items') !== false) {
            returnValue.space_between_items = container.data('space_between_items');
        }
        if (typeof container.data('image_size') !== 'undefined' && container.data('image_size') !== false) {
            returnValue.image_size = container.data('image_size');
        }

        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function edgtfSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'edgtf_core_portfolio_ajax_load_more',
            type: container.type,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage,
            display_excerpt: container.display_excerpt,
            excerpt_length: container.excerpt_length,
            display_title: container.display_title,
            display_separator: container.display_separator,
            display_category: container.display_category,
            display_link: container.display_link,
            display_lightbox: container.display_lightbox,
            space_between_items: container.space_between_items,
            image_size: container.image_size
        };
        return returnValue;
    }


    function edgtfInitFlyingDeck() {

        if ($('.edgtf-flying-deck').length) {
            window.edgtfFD = new function() {
                this.container = $('.edgtf-flying-deck');
                this.images = $('.edgtf-fd-img');

                this.init = function() {
                    var coords = [
                        {left: 100*645/1920, top: 100*436/2744, depth: 0, rot: {x: 20, y: -30, z: 0}, skew: {x: -20, y: -2}, width: 55},
                        {left: 100*1414/1920, top: 100*598/2744, depth: 200*3, rot: {x: 20, y: 30, z: 0}, skew: {x: 10, y: 2}, width: 40},
                        {left: 100*592/1920, top: 100*1150/2744, depth: 400*3, rot: {x: 20, y: -30, z: 0}, skew: {x: -20, y: -2}, width: 40},
                        {left: 100*1123/1920, top: 100*1194/2744, depth: 150*3, rot: {x: 10, y: 30, z: 30}, skew: {x: -20, y: 20}, width: 50},
                        {left: 100*478/1920, top: 100*1806/2744, depth: 250*3, rot: {x: 50, y: 30, z: -30}, skew: {x: 25, y: -20}, width: 50},
                        {left: 100*1379/1920, top: 100*1949/2744, depth: 100*3, rot: {x: 20, y: 0, z: 20}, skew: {x: -20, y: 20}, width: 45},
                        {left: 100*620/1920, top: 100*2392/2744, depth: 300*3, rot: {x: 60, y: 20, z: -20}, skew: {x: 10, y: -20}, width: 50}
                    ];
                    edgtfFD.images.each(function(i) {
                        var top = coords[i].top;
                        var left = coords[i].left;
                        var z = -coords[i].depth;
                        $(this)
                        .css({
                            'width': coords[i].width + '%',
                            'top': top + '%',
                            'left': left + '%',
                            'transform': Modernizr.csstransforms3d ? 'translate3d(-50%,-50%,'+z+'px)' : 'translate(-50%,-50%) skewX('+coords[i].skew.x+'deg) skewY('+coords[i].skew.y+'deg)',
                            'z-index': 20000 + Math.round(z)+''
                        })
                        .find('.edgtf-fd-y-spin').css('transform','rotateY('+coords[i].rot.y+'deg) rotateX('+coords[i].rot.x+'deg) rotateZ('+coords[i].rot.z+'deg)')
                        .find('.edgtf-fd-y2-spin').css('animation','spin-y 20s linear '+(-i*10/edgtfFD.images.length)+'s infinite alternate')
                        .find('.edgtf-fd-x2-spin').css('animation','spin-x'+(Modernizr.preserve3d ? '' : '-intense')+' 40s linear '+(-i*20/edgtfFD.images.length)+'s infinite alternate')
                        ;
                    });

                    $(window).resize(edgtfFD.handle_resize);
                };
            };

            edgtfFD.init();
        }
    }

    /*
    **  Init expandable row shortcode
    */
    function edgtfInitExapandableRow(){

        var expandableRow = $('.edgtf-er-holder');
        if(expandableRow.length){
            expandableRow.each(function(){

                var thisExpandableRow = $(this);
                var height = 0;
                var speed = 800;

                var $more_label = (thisExpandableRow.find('.edgtf-er-button').data('morefacts') !== '' && thisExpandableRow.find('.edgtf-er-button').data('morefacts') !== undefined) ? thisExpandableRow.find('.edgtf-er-button').data('morefacts') : 'CLICK HERE TO SEE MORE CONTENT';

                var $less_label = (thisExpandableRow.find('.edgtf-er-button').data('morefacts') !== '' && thisExpandableRow.find('.edgtf-er-button').data('lessfacts') !== undefined) ? thisExpandableRow.find('.edgtf-er-button').data('lessfacts') : 'CLICK TO HIDE';

                thisExpandableRow.find('.edgtf-er-button').click(function(){

                    height = thisExpandableRow.find('.edgtf-er-inner').height();

                    if(height > 0 && height < 601){
                        speed = 800;
                    } else if(height > 600 && height < 1201){
                        speed = 1500;
                    } else{
                        speed = 2100;
                    }

                    if(!thisExpandableRow.hasClass('edgtf-er-opened')){

                        thisExpandableRow.addClass('edgtf-er-opened');
                        thisExpandableRow.addClass('edgtf-er-animated-arrow');

                        thisExpandableRow.find('.edgtf-er-outer').stop().animate({'height': height}, speed);

                        thisExpandableRow.find('.edgtf-er-button-text').text($less_label);

                    } else {

                        thisExpandableRow.find('.edgtf-er-outer').stop().animate({'height': '0px'}, speed,function(){
                            thisExpandableRow.removeClass('edgtf-er-opened');
                        });
                        thisExpandableRow.removeClass('edgtf-er-animated-arrow');

                        thisExpandableRow.find('.edgtf-er-button-text').text($more_label);
                    }
                });
            });
        }
    }

    /*
    **  Init scrolling image shortcode
    */
    function edgtfInitScrollingImage(){

        var scrollingImage = $('.edgtf-scrolling-image-holder');
        if(scrollingImage.length){
            scrollingImage.each(function(){

                var thisScrollingImage = $(this);

                thisScrollingImage.children('.edgtf-scrolling-image-img').hover(
                    function() {
                        var img = $(this).find('img');
                        var time = Math.round(img.height() / 330);
                        img.css({
                            'transform': 'translateY('+($(this).height() - img.height())+'px)',
                            'transition-duration': time+'s'
                        });
                    },
                    function() {
                        $(this).find('img').css({
                            'transform': 'translateY(0)',
                            'transition-duration': '1s'
                        });
                    }
                );
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function () {
        edgtfInitQuantityButtons();
        edgtfInitSelect2();
    });

    function edgtfInitQuantityButtons() {

        $('.edgtf-quantity-minus, .edgtf-quantity-plus').click(function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.edgtf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('edgtf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
        });
    }

    function edgtfInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();
        }
    }


})(jQuery);
(function($) {
    'use strict';

    edgtf.modules.portfolio = {};

    $(window).load(function() {
        edgtfPortfolioSingleFollow().init();
    });

    var edgtfPortfolioSingleFollow = function() {

        var info = $('.edgtf-follow-portfolio-info .small-images.edgtf-portfolio-single-holder .edgtf-portfolio-info-holder, ' +
            '.edgtf-follow-portfolio-info .small-slider.edgtf-portfolio-single-holder .edgtf-portfolio-info-holder');

        if (info.length) {
            var infoHolder = info.parent(),
                infoHolderOffset = infoHolder.offset().top,
                infoHolderHeight = infoHolder.height(),
                mediaHolder = $('.edgtf-portfolio-media'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .edgtf-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(edgtf.scroll > infoHolderOffset) {
                        info.animate({
                            marginTop: (edgtf.scroll - (infoHolderOffset) + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                        });
                    }
                }

            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(edgtf.scroll > infoHolderOffset) {

                        if(edgtf.scroll + headerHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar + infoHolderHeight + 20 < infoHolderOffset + mediaHolderHeight) {    //20 px is for styling, spacing between header and info holder

                            //Calculate header height if header appears
                            if ($('.header-appear, .edgtf-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .edgtf-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (edgtf.scroll - (infoHolderOffset) + edgtfGlobalVars.vars.edgtfAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                            });
                            //Reset header height
                            headerHeight = 0;
                        }
                        else{
                            info.stop().animate({
                                marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {

            init : function() {

                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });

            }

        };

    };

})(jQuery);
