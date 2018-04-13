var UserNameLegthMin = 5;
var passwordLengthMin = 5;


function CreateAccountValidate(form){
    
    //firstname , lastname, county, zip, email, password, cpassword
    
    fail = validateFirstName(form.firstname.value);
    fail += validateLastName(form.lastname.value);
    fail += validateCounty(form.county.value);
    fail += validateZipcode(form.zip.value);
    fail += validatePassword(form.password.value, form.cpassword.value);
    fail += validateEmail(form.email.value);
		
    if (fail == ""){
        return true; 
    } 
    else {
        swal({ title: "Invalid Input", text: fail, icon: "error"});
        return false 
    }
}

function validateFirstName(name){
    if (name == "") return "First Name was not entered.\n"
	else if (/[^a-zA-Z]/.test(name))
		return "First name may only have letters.\n"
	return ""
}

function validateLastName(name){
    if (name == "") return "Last Name was not entered.\n"
	else if (/[^a-zA-Z]/.test(name))
		return "Last name may only have letters<br>.\n"
	return ""
}


function validateCounty(county){
    if (county == "Choose County...") return "No county was entered.\n";
	return "";
}

function validateZipcode(zipcode){
    if (zipcode == "") return "No zipcode was entered.\n"
	else if (zipcode.length < 5)
		return "Zipcode must be at least 5 characters.\n"
	else if (/[^0-9]/.test(zipcode))
		return "Zipcode may only have numbers. \n"
	return ""
}


function validateEmail(email){
    if (email == "") return "No Email was entered.\n"
	else if (!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(email))
		return "The Email address is invalid.\n"
	return ""

}

function validatePassword(password, cpassword){
    
    if (password == "") return "No Password was entered.\n"
	else if (password.length < passwordLengthMin)
		return "Passwords must be at least "+passwordLengthMin+" characters.\n"
	else if (!/[a-z]/.test(password) || ! /[A-Z]/.test(password) ||!/[0-9]/.test(password))
		return "Passwords must have lowercase, uppercase, and a number.\n"
    else if(password !== cpassword)
        return "Passwords do not match.\n";
	return ""
}

  
