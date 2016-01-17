$(function() {
  // If no banner, remove the margin
  if (!$('div.banner').length) {
    $('#entete h1').css('padding-top', '0px');
    $('#entete').css('height', '0px');
  }
});
