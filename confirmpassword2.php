<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><title></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript"><!--
function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("Passwords do not match!");
    else
        $("#divCheckPasswordMatch").html("Passwords match.");
}
//--></script>
</head>
<body>

<div class="td">
    <input type="password" id="txtNewPassword" />
</div>
<div class="td">
    <input type="password" id="txtConfirmPassword" onkeyup="checkPasswordMatch();" />
</div>
    <div class="registrationFormAlert" id="divCheckPasswordMatch">
</div>

</body>
</html>