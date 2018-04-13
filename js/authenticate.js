
var UserNameLegthMin = 5;
var passwordLengthMin = 5;

function ShippingaddressValidation(form){
    
    country = $("#country").text();
    state = $("#administrative_area_level_1").text();
    city = $("#locality").text();
    streetAdress =  $("#street_number").text() +" "+$("#route").text();
    zip = $("#postal_code").text();
    usersCounty = $("#addressForm").data("county")
    
    fail = validateCountry(country)
    fail += validateState(state)
    fail += validateZip(zip, usersCounty)
    
    p = country +", "+ state + ", " + city + ", " + streetAdress + ", " + zip
    
    if(fail == "")
       return true;
    else {
        swal({ title: "Invalid Input", text: "Sorry we cannot ship to this address", icon: "error"});
        return false
    }    
}

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

function validateCountry(country){
    if(country.length == 0)
        return "Please enter your country \n"
    if (country !== "United States")
        return "This service is only available in the United States \n"
    return ""
}

function validateState(state) {
    if(state.length == 0)
        return "Please enter your state \n"
    if(state !== "CA"){
        return "This service is not available in your State \n"
    }
    return ""
}

function validateZip(zipcode, usersCounty){
    allZipcodes = supportedCounties[usersCounty];
    
    if(zipcode.length ==0)
        return "please enter your zipcode \n"
    if(allZipcodes[zipcode])
        return ""
    return "This service is not available in your county \n"
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

var SantaClaraCountyZip = { "94022": true, "94023": true, "94024": true, "94043": true };
var SanMateoCountyZip = { "94002": true, "94005": true, "94010": true, "94011": true };
var supportedCounties = {"Santa Clara": SantaClaraCountyZip, "San Mateo": SanMateoCountyZip}



  
