$(function() {
  CKEDITOR.replace('description');

  /**
   * Make the sidebar sticky
  */
  var $sticky = $('.sticky');

  if (!!$sticky.offset()) { // Execute all this only if we have an element with the .sticky class

    var stickyTop = $sticky.offset().top; // Top offset position of the element

    // Fix its width to avoid a bug
    $sticky.css('width', $sticky.width());

    $(window).scroll(function() {
      var windowTop = $(window).scrollTop();

      if (stickyTop < (windowTop + 15)){
        $sticky.css({ position: 'fixed', top: '15px' });
      } else {
        $sticky.css('position','static');
      }
    });
  }
});
