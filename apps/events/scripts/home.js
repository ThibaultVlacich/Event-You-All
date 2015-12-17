$(function() {
  $('div.app-events-home div.slideshow').slidesjs({
    width: '100%',
    height: 600,
    play: {
      // Autoplay
      auto: true
    },
    navigation: {
      // Deactivate default navigation buttons, we are using our ones
      active: false
    }
  });
});
