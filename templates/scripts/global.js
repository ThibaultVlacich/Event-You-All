$(function() {
  /**
   * Mobile menu toggle
   */
  $('nav.main-navigation .mobile i.hamburger').click(function() {
    $(this).toggleClass('active');

    $('nav.main-navigation .mobile ul.mobile-menu').toggleClass('active');

    // De-activate others menus eventually opened
    $('nav.main-navigation .mobile i.search, nav.main-navigation .mobile i.login').removeClass('active');
    $('nav.main-navigation .mobile .mobile-search, nav.main-navigation .mobile .mobile-login').removeClass('active');
  });

  /**
   * Mobile search field toggle
   */
  $('nav.main-navigation .mobile i.search').click(function() {
    $(this).toggleClass('active');

    $('nav.main-navigation .mobile .mobile-search').toggleClass('active');

    // De-activate others menus eventually opened
    $('nav.main-navigation .mobile i.hamburger, nav.main-navigation .mobile i.login').removeClass('active');
    $('nav.main-navigation .mobile .mobile-menu, nav.main-navigation .mobile .mobile-login').removeClass('active');
  });

  /**
   * Mobile login toggle
   */
  $('nav.main-navigation .mobile i.login').click(function() {
    $(this).toggleClass('active');

    $('nav.main-navigation .mobile .mobile-login').toggleClass('active');

    // De-activate others menus eventually opened
    $('nav.main-navigation .mobile i.hamburger, nav.main-navigation .mobile i.search').removeClass('active');
    $('nav.main-navigation .mobile .mobile-menu, nav.main-navigation .mobile .mobile-search').removeClass('active');
  });

  /**
   * Cookie notice
   */
  var $cookieNotice = $('#cookie-notice');

  // Bind the click action on the "Ok" button
  $cookieNotice.find('.accept-button').click(function(e) {

    var currentTime    = new Date(),
        expirationTime = new Date();

    // set expiry time in seconds
    expirationTime.setTime(parseInt(currentTime.getTime()) + 2592000 * 1000);

    // set cookie
    document.cookie = 'cookie_notice_accepted=true;expires=' + expirationTime.toGMTString() + ';path=/;';

    // Remove the notice from the DOM
    $cookieNotice.remove();

    // Prevent default button behavior.
    e.preventDefault();
    return false;
  });

  if (document.cookie.indexOf('cookie_notice_accepted') === -1) {
    // User hasn't still accepted cookies, show him the notice
    $cookieNotice.show();
  } else {
    // He accepted it, remove it from the DOM
    $cookieNotice.remove();
  }
});
