(function($) {
    "use strict";

    var blog = {};
    edgtf.modules.blog = blog;

    blog.edgtfInitAudioPlayer = edgtfInitAudioPlayer;
    blog.edgtfInitBlogListCheckered = edgtfInitBlogListCheckered;

    $(document).ready(function() {
        edgtfInitAudioPlayer();
    });

    $(window).load(function(){
        edgtfInitBlogListCheckered();
    });
    
    $(window).resize(function(){
        edgtfInitBlogListCheckered();
    });

    function edgtfInitAudioPlayer() {

        var players = $('audio.edgtf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /*
    **  Init blog list checkered type
    */
    function edgtfInitBlogListCheckered(){
        var blogList = $('.edgtf-blog-holder.edgtf-blog-type-checkered article');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});

                thisBlogList.find('.edgtf-post-text-holder').css('height',thisBlogList.find('.edgtf-post-image').height());
            });
        }
    }

})(jQuery);