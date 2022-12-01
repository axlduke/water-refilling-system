
<table border="0" cellpadding="3" cellspacing="0">
    <tr>
        <td>
            Password:
        </td>
        <td>
            <input type="password" id="txtPassword" />
        </td>
    </tr>
    <tr>
        <td>
            Confirm Password:
        </td>
        <td>
            <input type="password" id="txtConfirmPassword" />
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <input type="button" id="btnSubmit" value="Submit" />
        </td>
    </tr>
</table>
<script type="text/javascript" src="cpass_jquery.js"></script>
<script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#txtPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
	
	function myFunction() {
	  var x = document.getElementById("myInput");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
} 
</script>
<!-- Password field -->
Password: <input type="password" value="FakePSW" id="myInput">

<!-- An element to toggle between password visibility -->
<input type="checkbox" onclick="myFunction()">Show Password 
