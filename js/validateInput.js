
function input(nameForm , nameAttribute) {
    return document.forms[nameForm][nameAttribute].value;
}
 function isset_input(value, id) {
    if (value == "") {
        document.getElementById(id).style.display = "block";
        event.preventDefault();
        return false;
    } else {
        document.getElementById(id).style.display = "none";
        return true;
    }
    
} 
function ismatch_regex_input(regex ,value, id ) {

    if (regex.test(value) == false) {
        document.getElementById(id).style.display = "block";
        event.preventDefault();
   
    }else{
        document.getElementById(id).style.display = "none";
        

   
    }
} 

function validate(nameForm,nameAttribute,idAlert,idValidateAlert,regex) {
    let value = input(nameForm,nameAttribute);
 
    hasErorr=isset_input(value, idAlert)

    if (hasErorr == true) {
       
        
        ismatch_regex_input(regex,value ,idValidateAlert);

    }
    if (nameAttribute == "Repeatpassword" && hasErorr == true) {

        var password=input("RegisterForm","password");
            if (password !== value) {
                document.getElementById("RepeatpasswordValisdateAlert").style.display = "block";
                event.preventDefault();
            } else{
                document.getElementById("RepeatpasswordValisdateAlert").style.display = "none"; 
            }
   
    }
}

function validateForm() {

  
    validate("RegisterForm","firstname","firstNameAlert","firstNameValidateAlert",/^[a-z0-9_]{3,16}/);
    validate("RegisterForm","lastname","lastNameAlert","lastNameValidateAlert",/^[a-z0-9_]{3,16}/);
    validate("RegisterForm","userPhone","phoneAlert","phoneValidateAlert",/^[0-0]{1}[9-9]{1}[0-9]{9}/);
    validate("RegisterForm","userEmail","emailAlert","emailValisdateAlert",/([\w\-]+\@[\w\-]+\.com$)/);
    validate("RegisterForm","password","passwordAlert","passwordValisdateAlert",/^(?=.*\d).{4,8}/);
    validate("RegisterForm","Repeatpassword","RepeatpasswordAlert","RepeatpasswordValisdateAlert",/^(?=.*\d).{4,8}/);   
}
function validateContact() {

    validate("myForm","userName","nameAlert","nameValidateAlert",/^[a-z0-9_]{3,16}$/);
    validate("myForm","userPhone","phoneAlert","phoneValidateAlert",/^[0-0]{1}[9-9]{1}[0-9]{9}/);
    validate("myForm","userEmail","mailAlert","mailValisdateAlert",/([\w\-]+\@[\w\-]+\.com$)/);
   
}
function validateLogin() {
    validate("LoginForm","userEmail","emailAlert","emailValisdateAlert",/([\w\-]+\@[\w\-]+\.com$)/);
    validate("LoginForm","userPassword","passwordAlert","mailValisdateAlert",/([\w\-]+\@[\w\-]+\.com$)/);
    
}


 
 
 