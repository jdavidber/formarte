/*!
* NIGHTLY.JS
*
* Main scripts file. Contains theme functionals.
* Tidy and clean, let's keep it that way, shall we?
*
* Version 1.0
*/

/* 
-----------------------------------------------------------------------------------------------------------*/


jQuery(document).ready(function() {

    "use strict";
    
    jQuery('body').show(); // page lazy load 
    
    jQuery.mobile.ajaxEnabled = false;
    jQuery.mobile.keepNative = "select,input,a,button,textarea"
    jQuery.event.special.swipe.durationThreshold = 650;
    jQuery.event.special.swipe.horizontalDistanceThreshold = 85;
    var aSearchClicked = false;
    
    jQuery(".sub-menu").hide();
    jQuery(".container").hide();
    jQuery('[data-role=panel] .ui-panel-inner').css("display", "block"); // prevent from messy-loading
    
    /* Set background for navigation pages
    *
    * @since 1.0
    *
    */
    
    if ( jQuery('.nightly-navigation-page-background img').length ) {
    	var background = jQuery('.nightly-navigation-page-background img').attr('src');
    	jQuery('body').css('background-image', 'url('+background+')');
    }
    
   
    /* Check if menu item has icon (class .fa)
    *
    * @since 1.0
    *
    */
    
    jQuery('#left-sidebar ul li').filter(function(){
        return jQuery(this).children('a').find('.fa').length > 0
    }).each(function(){
        jQuery(this).addClass('menu-item-has-icon');
    });
    
		/* Rendering progress bars
		*
		* @since 1.0
		*
		*/
		
		jQuery(".bar").each(function() {
        jQuery(this).append("<span class='bar-value' style='background:"+jQuery(this).data("background")+";width:"+jQuery(this).data("value")+"%;'></span>");
        jQuery(this).prepend("<h5 class='bar-title'>"+jQuery(this).data("title")+"</h5>");
        var positionPercentage = parseInt(100-jQuery(this).attr("data-value"));
        if(positionPercentage > 50) {
            positionPercentage = 0;
            jQuery(".bar").css("background", "#eee");   
        }
        jQuery(this).prepend("<span class='bar-number' style='right: "+positionPercentage+"%;'>"+jQuery(this).data("value")+"%</span>");
    });
    
    /* Touch/click handlers and functions
    *
    * @since 1.0
    *
    */
        
    if("ontouchend" in document.documentElement) {
        
        jQuery('#a-sidebar').bind('touchstart touchon', function(event){
            if(aSearchClicked){
                jQuery('#top-searchform').removeClass('moved');
                aSearchClicked = false;
            }
            if ( jQuery.mobile.activePage.jqmData( "panel" ) != "open" ) {
            	// only left sidebar
            	jQuery("#left-sidebar").panel( "open" );
            	
            	// dropdown navi
            	jQuery("#navi-dropdown").panel( "open" );
            	jQuery(".ui-page").addClass("darken");
            	jQuery("#open-navi-dropdown").addClass("hover");
            } else {
            	jQuery("#left-sidebar").panel( "close" );
            	// dropdown navi
            	jQuery("#navi-dropdown").panel( "close" );
            	jQuery(".ui-page").removeClass("darken");
            	jQuery("#open-navi-dropdown").removeClass("hover");
            }
         }); 
         jQuery('#a-right-sidebar').bind('touchstart touchon', function(event){
             if(aSearchClicked){
                 jQuery('#top-searchform').removeClass('moved');
                 aSearchClicked = false;
             }
             if ( jQuery.mobile.activePage.jqmData( "panel" ) != "open" ) {
             	jQuery("#right-sidebar").panel( "open" );
             } else {
             	jQuery("#right-sidebar").panel( "close" );
             }
         });
         jQuery('#close-navi-dropdown').bind('touchstart touchon', function(event){
             if ( jQuery.mobile.activePage.jqmData( "panel" ) === "open" ) {
                 jQuery("#navi-dropdown").panel( "close" );
                 jQuery(".ui-page").removeClass("darken");
                 jQuery("#open-navi-dropdown").removeClass("hover");
             }
         });
         jQuery('#a-search').bind('touchstart touchon', function(event){
            if(aSearchClicked){
                jQuery('#top-searchform').removeClass('moved');
                aSearchClicked = false;
            }else{
                jQuery('#top-searchform').addClass('moved');
                aSearchClicked = true;
            }
        });   
    } else {
         
        jQuery('#a-sidebar').bind('click', function(event){
            if(aSearchClicked){ 
                jQuery('#top-searchform').removeClass('moved');
                aSearchClicked = false;
            }
            if ( jQuery.mobile.activePage.jqmData( "panel" ) != "open" ) {
            	// only left sidebar
            	jQuery("#left-sidebar").panel( "open" );
            	// dropdown navi
            	jQuery("#navi-dropdown").panel( "open" );
            	jQuery(".ui-page").addClass("darken");
            	jQuery("#open-navi-dropdown").addClass("hover");
            } else {
            	jQuery("#left-sidebar").panel( "close" );
            	// dropdown navi
            	jQuery("#navi-dropdown").panel( "close" );
            	jQuery(".ui-page").removeClass("darken");
            	jQuery("#open-navi-dropdown").removeClass("hover");
            }
         });
         
         jQuery('#a-right-sidebar').bind('click', function(event){
             if(aSearchClicked){ 
                 jQuery('#top-searchform').removeClass('moved');
                 aSearchClicked = false;
             }
             if ( jQuery.mobile.activePage.jqmData( "panel" ) != "open" ) {
             	jQuery("#right-sidebar").panel( "open" );
             } else {
             	jQuery("#right-sidebar").panel( "close" );
             }
         });
         
         jQuery('#close-navi-dropdown').bind('click', function(event){
             if ( jQuery.mobile.activePage.jqmData( "panel" ) === "open" ) {
                 jQuery("#navi-dropdown").panel( "close" );
                 jQuery(".ui-page").removeClass("darken");
                 jQuery("#open-navi-dropdown").removeClass("hover");
             }
         });
         
         jQuery('#a-search').bind('click', function(event){
            if(aSearchClicked){
                jQuery('#top-searchform').removeClass('moved');
                aSearchClicked = false;
            }else{
                jQuery('#top-searchform').addClass('moved');
                aSearchClicked = true;
            }
         });
    }
    
    /* Toggle for menu subcategories
		*
    *
    * @since 1.0
    *
    */
    
    jQuery(".menu-item-has-children").click(function(event){
    	event.preventDefault();
    	jQuery(this).children(".sub-menu").toggleClass("active").toggle(350);
    	return false;
    }).children(".sub-menu").children("li").click(function(event){
    
        window.location.href = jQuery(this).children("a").attr("href");
    });
    
    /* If you want to disable swipe on cetrtain elements add .disableswipe
    * for example:
    * 
    * <div class="disableswipe">This is swipe disabled block</div>
    *
    * @since 1.0
    *
    */
    
    jQuery( document ).on( "swipeleft swiperight", '.disableswipe', function ( e ) {
        e.stopPropagation();
        e.preventDefault();
    });
    
    jQuery( document ).on( "swipeleft swiperight", 'input', function ( e ) {
        e.stopPropagation();
        e.preventDefault();
    });
    
		/* Sidebar swipe for opening / closing
		*
		* @since 1.0
		*
		*/
		
		jQuery( document ).on( "swipeleft swiperight", function( e ) {
		
			if ( jQuery.mobile.activePage.jqmData( "panel" ) !== "open" ) { // if panel isn't already open
				if(aSearchClicked){ 
				    jQuery('#top-searchform').removeClass('moved');
				    aSearchClicked = false;
				}
		  	if ( e.type === "swipeleft"  ) { // and the swipe is from right to left
		  		jQuery( "#right-sidebar" ).panel( "open" ); // open #right-sidebar
		    } else if ( e.type === "swiperight" ) { // or the swipe is from left to right
		    	jQuery( "#left-sidebar" ).panel( "open" ); // open #left-sidebar
		  	} 
		 	}
		 });
		 
		 /* Dropdown navigation
		 *
		 * @since 1.0
		 *
		 */
		 
		 jQuery( "#navi-dropdown" ).panel({
		   beforeopen: function( e ) {
		       jQuery("body").css("overflow-y", "hidden");
		   },
		   beforeclose: function( e ) {
		       jQuery("body").css("overflow-y", "auto");
		   }
		 });

});