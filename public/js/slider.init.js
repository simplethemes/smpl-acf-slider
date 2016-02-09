jQuery(document).ready(function($) {
    if(typeof slider_opts !== "undefined") {
    var slider_params = jQuery.parseJSON(slider_opts);

    //console.log(slider_params);

    $('.slider').slick(slider_params);
    $('#slider').show();
    // center image slide captions
    $('.slideover').flexVerticalCenter({
        parentSelector:'.inner',
        deferTilWindowLoad: true,
        complete: function(){
            $('.slideover').addClass('animated fadeInDown').show();
        }
    });

    $('.slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
        //console.log('afterChange');
        $('.slideover').addClass('animated fadeInDown').show();
    });

    $('.slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
        // console.log('beforeChange');
        $('.slideover').removeClass('animated fadeInDown').hide();
    });


    if (slider_video.has_video) {
        // play video when slide is changed
          function playVideos() {
              if (slider_params.video_autoplay) {
                //vimeo
                $('.video_slide.slick-current').find('iframe[src*=\"vimeo.com\"]').each(function () {
                    $f(this).api('play');
                });
                //youtube
                $('.video_slide.slick-current').find('iframe[src*=\"youtube.com\"]').each(function () {
                    var iframe = $(this)[0].contentWindow;
                    iframe.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
                });
              }
          }
            // pause video when slide is changed

          $('.slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
              playVideos();
          });

          $('.slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
              pauseVideos();
          });

          function pauseVideos() {
              //vimeo
              $('.video_slide.slick-current').find('iframe[src*="vimeo.com"]').each(function () {
                  $f(this).api('pause');
              });
              //youtube
              $('.video_slide.slick-current').find('iframe[src*="youtube.com"]').each(function () {
                  var iframe = $(this)[0].contentWindow;
                  iframe.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
              });
          }
            // Inject YouTube API script
          var tag = document.createElement('script');
          tag.src = "//www.youtube.com/player_api";
          var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
          // Inject Vimeo API script
          var tag = document.createElement('script');
          tag.src = "//f.vimeocdn.com/js/froogaloop2.min.js";
          var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      }
    } // endif
});


/*global jQuery */
/*!
* FlexVerticalCenter.js 1.0
*
* Copyright 2011, Paul Sprangers http://paulsprangers.com
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*
* Date: Fri Oct 28 19:12:00 2011 +0100
*/
(function( $ ){

  $.fn.flexVerticalCenter = function( options ) {
    var settings = $.extend({
      cssAttribute:   'margin-top', // the attribute to apply the calculated value to
      verticalOffset: 0,            // the number of pixels to offset the vertical alignment by
      parentSelector: null,         // a selector representing the parent to vertically center this element within
      debounceTimeout: 25,          // a default debounce timeout in milliseconds
      deferTilWindowLoad: false     // if true, nothing will take effect until the $(window).load event
    }, options || {});

    return this.each(function(){
      var $this   = $(this); // store the object
      var debounce;

      // recalculate the distance to the top of the element to keep it centered
      var resizer = function () {

        var parentHeight = (settings.parentSelector && $this.parents(settings.parentSelector).length) ?
          $this.parents(settings.parentSelector).first().height() : $this.parent().height();

        $this.css(
          settings.cssAttribute, ( ( ( parentHeight - $this.height() ) / 2 ) + parseInt(settings.verticalOffset) )
        );
        if (settings.complete !== undefined) {
         settings.complete();
        }
      };

      // Call on resize. Opera debounces their resize by default.
      $(window).resize(function () {
          clearTimeout(debounce);
          debounce = setTimeout(resizer, settings.debounceTimeout);
      });

      if (!settings.deferTilWindowLoad) {
        // call it once, immediately.
        resizer();
      }

      // Call again to set after window (frames, images, etc) loads.
      $(window).load(function () {
          resizer();
      });

    });

  };
})( jQuery );