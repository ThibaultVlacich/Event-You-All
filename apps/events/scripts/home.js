$(function() {
  $('div.app-events-home div.slideshow').slidesjs({
    width: '100%',
    height: 600,
    play: {
      // Autoplay
      auto: true
    },
    navigation: {
      // Deactivate default navigation buttons, we are using our own ones
      active: false
    },
    callback: {
      loaded: function(number) {
        $('.slideshow-details .slide-'+number).show();
      },
      complete: function(number) {
        // Hide currently visible slide
        $('.slideshow-details .slide').hide();
        // Display the new slide
        $('.slideshow-details .slide-'+number).fadeIn(100);
      }
    }
  });
});
