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