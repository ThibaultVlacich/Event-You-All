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
      $message          = $('#message'),
      $firstname        = $('#firstname'),
      $lastname         = $('#lastname'),
      $email            = $('#email'),
      $errorS           = $('#errorS'),
      $errorM          = $('#errorM'),
      $errorL          = $('#errorL'),
      $errorF          = $('#errorF'),
      $errorEM           = $('#errorEM'),

      $sent_button    = $('#sent');
/*set up conditions*/

if (
  ($this.is($subject) && $this.val().length >=2 && $this.val().length <=200) ||

  ($this.is($message) &&  $this.val().length >=2 && $this.val().length <=5000) ||

  ($this.is($firstname) && $this.val().length >= 1 && $this.val().length <=40 ) ||

  ($this.is($lastname) && $this.val().length >= 1 && $this.val().length <=40) ||

  ($this.is($email) && validateEmail($this.val()))
) {
  $this.addClass('good').removeClass('error');
}

else {
  $this.addClass('error').removeClass('good');
}

if ( ( $subject.val().length >=2 && $subject.val().length <=200)){
  $errorS.css('display','none');
}
else if (( $subject.val().length ==0)){
  $errorS.css('display','none');
}
else  {
  $errorS.css('display','block');

}

if ( ($message.val().length >=2 && $message.val().length <=5000) ){
  $errorM.css('display','none');
}
else if (( $message.val().length ==0)){
  $errorM.css('display','none');
}

else {
  $errorM.css('display','block');

}



if ( ( $firstname.val().length >=1 && $firstname.val().length <=40)){
  $errorF.css('display','none');
}
else if (( $firstname.val().length ==0)){
  $errorF.css('display','none');
}
else {
  $errorF.css('display','block');
  }



  if ( ( $lastname.val().length >=1 && $lastname.val().length <=40)){
    $errorL.css('display','none');
  }

  else if (( $lastname.val().length ==0)){
    $errorL.css('display','none');
  }

  else {
    $errorL.css('display','block');
    }



    if ( validateEmail($email.val())){
      $errorEM.css('display','none');
    }

    else if (( $email.val().length ==0)){
      $errorEM.css('display','none');
    }

    else {
      $errorEM.css('display','block');
      }



//disable or able sent button according to conditions
if (
  $subject.val().length >=2 &&
  $subject.val().length <=200 &&
  $message.val().length <=5000 &&
  $message.val().length >=2 &&
  $firstname.val().length >= 1 &&
  $firstname.val().length <=40 &&
  $lastname.val().length >= 1 &&
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

/*$(function() {
  CKEDITOR.replace('message');
});*/
