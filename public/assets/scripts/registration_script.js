$(document).ready(function () {
    $('#email').on('keyup',function () {
        var email = $(this).val()
        var testEmail = isValidEmailAddress(email)
        if(!testEmail){
            $('#emailHelp').text('Format email non valide!')
            $('#register').prop("disabled",true);
        }else{
            $('#emailHelp').text('')
            $('#register').prop("disabled",false);
        }
    })
    $('#pass').on('keyup',function () {
        var pass = $(this).val()
        if(pass.length < 5){
            $('#passHelp').text('Mot de passe faible!')
            $('#register').prop("disabled",true);
        }else{
            $('#passHelp').text('')
            $('#register').prop("disabled",false);
        }
    })
    $('#pass1').on('keyup',function () {
        var pass = $('#pass').val()
        var pass1 = $(this).val()
        if(pass != pass1){
            $('#pass1Help').text('Mot de passe ne correspond pas')
            $('#register').prop("disabled",true);
        }else{
            $('#pass1Help').text('')
            $('#register').prop("disabled",false);
        }
    })
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
})