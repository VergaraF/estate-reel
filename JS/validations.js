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
function selectCountry(country){
	console.log("asd");
	if(country.value.valueOf() === "-1"){
		alert('Select your country from the list');
		country.focus();
		return false;
	}else{
		return true;
	}
}

function validatePrice(){
	
}

function validateZipCode(country, zip_code){   
	var zipCanada = /[A-z]\d{1}[A-z][- ]?\d{1}[A-z]\d{1}\b/;
	var zipUSA = /\b\d{5}[-]?\d{4}\b/;
	console.log("value of country is " + country.value);
	if(country.value.valueOf() === "Canada"){
		if(zip_code.value.match(zipCanada))  {  
			return true;  
		}else {  
			alert('ZIP code format is invalid! Please try again!');  
			zip_code.focus();
			return false;
		}
	}else if(country.value.valueOf() === "USA"){
		if(zip_code.value.match(zipUSA))  {  
			return true;  
		}else {  
			alert('ZIP code format is invalid! Please try again!');  
			zip_code.focus();  
			return false;  
		}
	}else {  
		alert('Please select the country first and try again!');  
		country.focus();  
		return false;  
	}  
}