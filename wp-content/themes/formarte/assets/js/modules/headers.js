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
