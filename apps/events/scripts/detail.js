$(function() {
  // Correctly position the content based on banner size
  $('div.app-events-detail div.banner img').load(function() {
    $('div.app-events-detail div.event-wrapper').css('margin-top', ($(this).parent().height() - 175) + 'px');
  });

  // If no banner, remove the margin
  if (!$('div.app-events-detail div.banner').length) {
    $('div.app-events-detail div.event-wrapper').css('margin-top', '0px');
  }

  // Handle "read more" button in description
  var $description           = $('.details .description'),
      $description_paragraph = $description.find('div.description-content'),
      $description_readmore  = $description.find('a.readmore');

  if ($description_paragraph.prop('scrollHeight') > $description_paragraph.height()) {
    // Content of the description does not fit its container
    // Show the read more button
    $description_readmore.show();

    $description_readmore.click(function(e) {
      // On click on the "Read More" button, make visible or not the whole description
      $description_paragraph.toggleClass('visible');

      if ($description_paragraph.hasClass('visible')) {
        $(this).html('En lire <i class="fa fa-minus"></i>');
      } else {
        $(this).html('En lire <i class="fa fa-plus"></i>');
      }

      // Prevent default behavior of the button
      e.preventDefault();
      return false;
    });
  } else {
    // Remove the read more button from the DOM
    $description_readmore.remove();

    // Ensure all the description is fully visible
    $description_paragraph.addClass('visible');
  }

  var $gallery = $('div.app-events-detail section.gallery div.photo-gallery');

  // If the gallery is not empty, launch the camera plugin
  if($gallery.length) {
    $gallery.camera({
      fx: 'simpleFade',
      playPause: false
    });
  }

  var $share_buttons = $('.share-buttons');

  // No need to execute the rest of this script if this element does not exist.
  if (!$share_buttons.length)
    return;

  // Handles popups
  $share_buttons.find('a').click(function(e) {
    var $this = $(this),
        left  = (screen.width / 2) - (500 / 2),
        top   = (screen.height / 2) - (250 / 2);

    if ($this.hasClass('fa-facebook')) {
      window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '', 'width=500, height=250, top=' + top + ', left=' + left);
    } else if ($this.hasClass('fa-twitter')) {
      window.open('https://twitter.com/share?url=' + encodeURIComponent(window.location.href) + '&amp;text=' + encodeURIComponent($this.attr('data-text')), '', 'width=500, height=250, top=' + top + ', left=' + left);
    } else if ($this.hasClass('fa-google-plus')) {
      window.open('http://plus.google.com/share?url=' + encodeURIComponent(window.location.href), '', 'width=500, height=250, top=' + top + ', left=' + left);
    }

    // Preventing an eventual default behavior
    e.preventDefault();
    return false;
  });
});
