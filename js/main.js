

$("#register").on('click',ValidateForm);
var emailInput = $("#uEmail");
var passwordInput = $("#uPswd");
var passwordVerifyInput = $("#uPswdVer");

$("input").on('click',function(){$(this).css('background-color',"")})
function ValidateForm(evt)
{
    if(evt)
    evt.preventDefault();

    var email = emailInput.val();
    var pswd = passwordInput.val();
    var pswdVer = passwordVerifyInput .val();

    if(email.length > 0)
    emailInput.css('background-color',"");
    else
    {
        emailInput.css('background-color',"red");  
        return;   
    }

    if(pswd.length > 6)   
    passwordInput.css('background-color',"");
    else
    {
        passwordInput.css('background-color',"red");
        passwordInput.trigger('focus');
        return;
    }

    if(pswd == pswdVer)
    {
        $("form").trigger('submit');
    }
    else
    {
        passwordInput.css('background-color',"red");  
        passwordVerifyInput.css('background-color',"red");
        return;
    }
}