function validateSignupForm(){
	var username = document.signUp.username;
	var password = document.signUp.password;
	var confirmPass = document.signUp.cPassword;
	var phone = document.signUp.phoneNum;
	if(validateUsername(username, 5)){
		if(checkPassword(password)){
			if(comparePasswords(password, confirmPass)){ 
				if(phoneNumber(phone)){
					document.form('signUp').submit();
				} 
			}
		}
	}
	return false;
}

//==================SIGN UP VALIDATIONS================================//
function validateUsername(inputtxt, len){
	if (inputtxt.value.length >= len) {
		return true;
	}else{
		alert('Username length should be ' + len + ' characters long at least');
		inputtxt.focus();
		return false;
	}
}

function phoneNumber(inputtxt)
{
	var phoneno = /[(]?\b\d{3}[)-. ]?[ ]?\d{3}[-. ]?\d{4}\b/;
	if((inputtxt.value.match(phoneno))){
		return true;
	}else{
		alert("The format of the phone number is wrong");
		inputtxt.focus();
		return false;
	}
}

function checkPassword(inputtxt) 
{ 
	var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
	if(inputtxt.value.match(passw)) { 
		return true;
	}else{ 
		alert('The password should be between 6 to 20 characters and it should have at least 1 digit, 1 uppercase and 1 lowercase');
		inputtxt.focus();
		return false;
	}
}

function comparePasswords(pass1, pass2){
	if(pass1.value.valueOf() === pass2.value.valueOf()){
		return true;
	}else{
		alert('confirmation failed! Please retype it!');
		pass2.focus();
		return false;
	}
}


//======================UPLOADING APARTMENTS VALIDATIONS=========================//
function countryselect(ucountry)
{
	if(ucountry.value == "Default"){
		alert('Select your country from the list');
		ucountry.focus();
		return false;
	}else{
		return true;
	}
}

function allnumeric(uzip)  
{   
	var numbers = /^[0-9]+$/;  
	if(uzip.value.match(numbers))  {  
		return true;  
	}else {  
		alert('ZIP code must have numeric characters only');  
		uzip.focus();  
		return false;  
	}  
}