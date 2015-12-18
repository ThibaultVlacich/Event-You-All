/**
 * Permet de valider si un string est une adresse email valide
 *
 * @param   email string  La chaine de caractère à vérifier
 *
 * @return  bool
 */

 /*Validate e mail adress*/
function validateEmail(email) {
  var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

  return re.test(email);
}

$('#subject, #message, #firstname, #lastname, #email').on('change keyup', function() {
  var $this             = $(this),
      $subject         = $('#subject'),
      $message          =$('#message'),
      $firstname        = $('#firstname'),
      $lastname         = $('#lastname'),
      $email            = $('#email'),
      $submit_button    = $('#submit');
/*set up conditions*/

  if (
    ($this.is($subject) && $this.val().length >=2) ||
    ($this.is($subject) && $this.val().length <=200) ||
    ($this.is($message) &&$this.val().length <=5000) ||
    ($this.is($message) &&$this.val().length >=10) ||
    ($this.is($firstname) && $this.val().length >= 1) ||
    ($this.is($firstname) && $this.val().length <=40) ||
    ($this.is($lastname) && $this.val().length >= 1) ||
    ($this.is($lastname) && $this.val().length <=40) ||
    ($this.is($email) && validateEmail($this.val()))
  ) {
    $this.addClass('good').removeClass('error');
  }
  } else {
    $this.addClass('error').removeClass('good');
  }

  //disable or able sent button according to conditions
  if (
    $subject.val().subject >=2 &&
    $subject.val().subject <=200 &&
    $message.val().message <=5000 &&
    $message.val().message >=10 &&
    $firstname.val().length >= 1 &&
    $firstname.val().length <=40 &&
    $lastname.val().length >= 2 &&
    $lastname.val().length <= 40 &&
    validateEmail($email.val())
  ) {
    $sent_button.prop('disabled', false);
  } else {
    $sent_button.prop('disabled', true);
  }
});

// sent button disabled when page is loading
$(function() {
  $('#sent').prop('disabled', true);
});
