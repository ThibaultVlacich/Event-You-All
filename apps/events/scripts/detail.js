$(function() {
  // Correctly position the content based on banner size
  $('div.app-events-detail div.banner img').load(function() {
    $('div.app-events-detail div.event-wrapper').css('margin-top', ($(this).parent().height() - 175)+'px');
  });

  var $share_buttons = $('.share-buttons');

  // No need to execute the rest of this script if this element does not exist.
  if(!$share_buttons.length)
    return;

  // Handles popups
  $share_buttons.find('a').click(function(e) {
    var $this = $(this),
        left  = (screen.width/2)-(500/2),
        top   = (screen.height/2)-(250/2);

    if($this.hasClass('fa-facebook')) {
      window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href), '', 'width=500, height=250, top='+top+', left='+left);
    } else if($this.hasClass('fa-twitter')) {
      window.open('https://twitter.com/share?url='+encodeURIComponent(window.location.href)+'&amp;via=FreenewsActu&amp;text='+encodeURIComponent($this.attr('data-text')), '', 'width=500, height=250, top='+top+', left='+left);
    } else if($this.hasClass('fa-google-plus')) {
      window.open('http://plus.google.com/share?url='+encodeURIComponent(window.location.href), '', 'width=500, height=250, top='+top+', left='+left);
    }

    // Preventing an eventual default behavior
    e.preventDefault();
    return false;
  });
});
