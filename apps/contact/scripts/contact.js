/**
 * Permet de valider si un string est une adresse email valide
 *
 * @param   email string  La chaine de caractère à vérifier
 *
 * @return  bool
 */
function validateEmail(email) {
  var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

  return re.test(email);
}

$('#nickname, #firstname, #lastname, #email, #password, #password_confirm, #cgu').on('change keyup', function() {
  var $this             = $(this),
      $nickname         = $('#nickname'),
      $firstname        = $('#firstname'),
      $lastname         = $('#lastname'),
      $email            = $('#email'),
      $password         = $('#password'),
      $password_confirm = $('#password_confirm'),
      $cgu_checkbox     = $('#cgu'),
      $submit_button    = $('#submit');

  if (
    ($this.is($nickname) && $this.val().length >= 3) ||
    ($this.is($firstname) && $this.val().length >= 3) ||
    ($this.is($lastname) && $this.val().length >= 3) ||
    ($this.is($email) && validateEmail($this.val()))
  ) {
    $this.addClass('good').removeClass('error');
  } else if ($this.is($password) || $this.is($password_confirm)) {
    if ($password.val() == $password_confirm.val()) {
      $password.addClass('good').removeClass('error');
      $password_confirm.addClass('good').removeClass('error');
    } else {
      $password.addClass('error').removeClass('good');
      $password_confirm.addClass('error').removeClass('good');
    }
  } else {
    $this.addClass('error').removeClass('good');
  }

  if (
    $nickname.val().length >= 3 &&
    $firstname.val().length >= 3 &&
    $lastname.val().length >= 3 &&
    validateEmail($email.val()) &&
    $password.val() == $password_confirm.val() &&
    $cgu_checkbox.is(':checked')
  ) {
    $submit_button.prop('disabled', false);
  } else {
    $submit_button.prop('disabled', true);
  }
});

// On désactive le bouton de validation du formulaire au chargement de la page
$(function() {
  $('#submit').prop('disabled', true);
});
