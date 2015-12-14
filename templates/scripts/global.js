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
});
