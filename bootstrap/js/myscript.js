
$(function() {
	/* $("#Home a:contains('Home')").parent().addClass('active');
	$("#Products a:contains('Products')").parent().addClass('active');
	$("#MyAccount a:contains('MyAccount')").parent().addClass('active');
	$("#SignIn a:contains('SignIn')").parent().addClass('active');
	$("#ContactUs a:contains('ContactUs')").parent().addClass('active'); */
});

$(document).ready(function () {
        $('#navbar-collapse-3').find('li').click(function () {
            //removing the previous selected menu state
            $('#navbar-collapse-3').find('li.active').removeClass('active');
			console.log('clicked');
			
            //adding the state for this parent menu
            $('#navbar-collapse-3').parent('ul li').addClass('active');
        });
    });




// move offcanvas left and right to see the sidebars
$(document).ready(function() {
  $('[data-toggle=offcanvasleft]').click(function() {
	  $('.row-offcanvas-left').toggleClass('active');
	});
});
$(document).ready(function() {
  $('[data-toggle="offcanvasright"]').click(function () {
    $('.row-offcanvas-right').toggleClass('active')
	
  });
});

/* hide error register customer */
function hideError() {
    var x = document.getElementById('regerror');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
} 

/* validate customer image */
/* $(document).ready(function () {
$('input[type=file]').change(function () {
	var val = $(this).val().toLowerCase();
var regex = new RegExp("(.*?)\.(jpg|jpeg|gif|bmp)$");
 if(!(regex.test(val))) {
$(this).val('');
document.getElementById('regerror').innerHTML = 'Picture format should be gif or jpg or png.';</script>";

} }); }); */



/* validate customer register */
function ValidateRegisterForm()
{
	document.getElementById('regerror').style.display  = "block";
	

	// validate first name
	var val_firstName = document.getElementById('first_name').value;
	if(val_firstName == null || val_firstName == "" || !val_firstName.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "first name cannot be blank. <br/>first name can contain alphabets or numbers only.";
        //window.alert("first name cannot be blank / first name can contain alphabets or numbers only");
        document.getElementById('first_name').focus();
        return false;
	}
	
	// validate last name
		var val_lastName = document.getElementById('last_name').value;
	if(val_lastName == null || val_lastName == "" || !val_lastName.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "Last name cannot be blank. <br/>Last name can contain alphabets or numbers only.";
        //window.alert("Last name cannot be blank / Last name can contain alphabets or numbers only");
        document.getElementById('last_name').focus();
        return false;
	}
		// validate email
	if (email.value == "")
    {
		document.getElementById('regerror').innerHTML = "Please enter a valid e-mail address.";
        //window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (email.value.indexOf("@", 0) < 0)
    {
		document.getElementById('regerror').innerHTML = "Please enter a valid e-mail address.";
        //window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (email.value.indexOf(".", 0) < 0)
    {
		document.getElementById('regerror').innerHTML = "Please enter a valid e-mail address.";
        //window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }

		// validate password 
		var val_password = document.getElementById('password').value;
		if(!val_password.match( /^[\w]+$/)) {
  		document.getElementById('regerror').innerHTML = "Password cannot be blank. <br/>Password can contain alphabets or numbers only.";
        //window.alert("Password cannot be blank / Last name can contain alphabets or numbers only.");
        document.getElementById('password').focus();
        return false;
	}
		// validate password Confirmation
		var val_password_two = document.getElementById('password_two').value;
		if(!val_password_two.match( /^[\w]+$/)) {
  		document.getElementById('regerror').innerHTML = "Password Confirmation cannot be blank. <br/>Password Confirmation can contain alphabets or numbers only.";
        //window.alert("Password cannot be blank / Last name can contain alphabets or numbers only.");
        document.getElementById('password_two').focus();
        return false;
	}
		// validate Password and  password Confirmation
		if(!val_password.match(val_password_two)) {
  		document.getElementById('regerror').innerHTML = "Password and password confirmation does not match!";
        //window.alert("Password cannot be blank / Last name can contain alphabets or numbers only.");
        document.getElementById('password_two').focus();
        return false;
	}
	
	
		// validate password hint
		var val_passwordHint = document.getElementById('password_hint').value;
	if(!val_passwordHint.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "Password hint cannot be blank. <br/>Password hint can contain alphabets or numbers only.";
        //window.alert("Password hint cannot be blank / Last name can contain alphabets or numbers only.");
        document.getElementById('password_hint').focus();
        return false;
	}
		// validate address
		var val_address = document.getElementById('address').value;
	if(val_address == null || val_address == "" || !val_address.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "Address cannot be blank. <br/>Address can contain alphabets or numbers only.";
       // window.alert("Address hint cannot be blank / Last name can contain alphabets or numbers only.");
        document.getElementById('address').focus();
        return false;
	}
		// validate post code
		var val_postCode = document.getElementById('post_code').value;
	if(val_postCode == null || val_postCode == "" || !val_postCode.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "Post Code cannot be blank. <br/>Post Code can contain alphabets or numbers only.";
        //window.alert("Post Code cannot be blank / Post Code can contain alphabets or numbers only.");
        document.getElementById('post_code').focus();
        return false;
	}
		// validate country
		var val_country = document.getElementById('country').value;
	if(val_country == null || val_country == "" || !val_country.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "Country cannot be blank. <br/>Country can contain alphabets or numbers only.";
        //window.alert("Country cannot be blank / Country can contain alphabets or numbers only.");
        document.getElementById('country').focus();
        return false;
	}
			// validate city
		var val_city = document.getElementById('city').value;
	if(val_city == null || val_city == "" || !val_city.match( /^[\w ]+$/)) {
  		document.getElementById('regerror').innerHTML = "City cannot be blank. <br/>City can contain alphabets or numbers only.";
        //window.alert("City cannot be blank / City can contain alphabets or numbers only.");
        document.getElementById('city').focus();
        return false;
	}
			// validate phone
		var val_phone = document.getElementById('phone').value;
	if(val_phone == null || val_phone == "" || !val_phone.match( /^\d{10}$/)) {
  		document.getElementById('regerror').innerHTML = "Phone cannot be blank. <br/>Phone should contain 10 numbers only.";
        //window.alert("Phone cannot be blank / Phone can Phone should contain 10 numbers only.");
        document.getElementById('phone').focus();
        return false;
	}
	// validate mobile
		var val_mobile = document.getElementById('mobile').value;
	if(val_mobile == null || val_mobile == "" || !val_mobile.match( /^\d{10}$/)) {
  		document.getElementById('regerror').innerHTML = "Mobile cannot be blank. <br/>Mobile should contain 10 numbers only.";
        //window.alert("Mobile cannot be blank / Mobile should contain 10 numbers only."+val_mobile);
        document.getElementById('mobile').focus();
        return false;
	}
	
	// validate image
	var val_image = document.getElementById('image').value;
	var val_checkimg = val_image.toLowerCase();
	var isValid = /(.*?)\.(jpg|jpeg|gif|bmp|png)$/i.test(val_checkimg);
	
	if( document.getElementById("image").files.length == 0 ){
		document.getElementById('regsuccess').innerHTML = "Image cannot be blank";
	}else if (!isValid) {
	document.getElementById('regerror').innerHTML = 'Picture format should be gif or jpg or png.';
      //alert('Only jpg files allowed!');
	  document.getElementById('image').focus();
	  return false;
	  
	  
    }
	var namehtml=document.getElementById("name_status").innerHTML;
	var emailhtml=document.getElementById("email_status").innerHTML;

 if((namehtml && emailhtml)=="OK")
 {
  return true;
 }
 else
 {
  return false;
 }


	
	
	document.getElementById('regsucess').innerHTML = username.value();
return true;


}
	
// check username and email if they exist

function checkusername()
{
 var val_name = document.getElementById( "cust_username" ).value;
	
 if(val_name)
 {
  $.ajax({
  type: 'post',
  url: 'checkdata.php',
  data: {
   cust_username:val_name,
  },
  success: function (response) {
   $( '#username_status' ).html(response);
   if(response=="OK")	
   {
    return true;	
   }
   else
   {
    return false;	
   }
  }
  });
 }
 else
 {
  $( '#username_status' ).html("");
  return false;
 }
}

function checkemail()
{
 var val_email=document.getElementById( "email" ).value;
	
 if(val_email)
 {
  $.ajax({
  type: 'post',
  url: 'checkdata.php',
  data: {
   email:val_email,
  },
  success: function (response) {
   $( '#email_status' ).html(response);
   if(response=="OK")	
   {
    return true;	
   }
   else
   {
    return false;	
   }
  }
  });
 }
 else
 {
  $( '#email_status' ).html("");
  return false;
 }
}

// function could be inclueded in submiting the form to ferify username and email if exist
/*
function checkall()
{
 var namehtml=document.getElementById("username_status").innerHTML;
 var emailhtml=document.getElementById("email_status").innerHTML;

 if((namehtml && emailhtml)=="OK")
 {
  return true;
 }
 else
 {
  return false;
 }
}

*/

/* hide error Login customer */
function hideError() {
    var x = document.getElementById('error');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
} 



/* validate customer Login */
function ValidateLoginForm(){
	document.getElementById('error').style.display  = "block";
// validate email
	if (email.value == "")
    {
		document.getElementById('error').innerHTML = "Please enter a valid e-mail address.";
        //window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (email.value.indexOf("@", 0) < 0)
    {
		document.getElementById('error').innerHTML = "Please enter a valid e-mail address.";
        //window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
    if (email.value.indexOf(".", 0) < 0)
    {
		document.getElementById('error').innerHTML = "Please enter a valid e-mail address.";
        //window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }
		// validate password 
		var val_password = document.getElementById('password').value;
		if(!val_password.match( /^[\w]+$/)) {
  		document.getElementById('error').innerHTML = "Password cannot be blank. <br/>Password can contain alphabets or numbers only.";
        //window.alert("Password cannot be blank / Last name can contain alphabets or numbers only.");
        document.getElementById('password').focus();
        return false;
	}
}
	
	
	
	






