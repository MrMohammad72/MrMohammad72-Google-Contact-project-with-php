# MrMohammad72-Google-Contact-project-with-php

## ABOUT Instegram Project :
This program is written on the web platform in php language. In this program, various capabilities have been used, some of which are mentioned in the next headline. These features facilitate the process of managing the audience anywhere and anytime for any type of smart device.

## FEATURES :
* [+] Operation CRUD for account user  !
* [+] Operation CRUD for contacts  !
* [+] Operation auth  !
* [+] Responsive user interface design  !
* [+] MVC architecture in procedural programming  !

## EXAMPLE :
Here you can see an example of the code written.
In the following example, regular expressions are used to validate the inputs given to the forms. This validation is done with js code in the user interface.

The following method receives two inputs. The first input is the attribute name of the form tag and the second input is the attribute name of the desired tag. In other words, the second input receives the content inside the desired tag.
``` php
function input(nameForm , nameAttribute) {
    return document.forms[nameForm][nameAttribute].value;
}
```
The following method checks for the presence or absence of values in input forms, and based on that, the tag that carries the error message attribute display makes it none or block.

``` php
function isset_input(value, id) {
    if (value == "") {
        document.getElementById(id).style.display = "block";
        event.preventDefault();
        return false;
    } else {
        document.getElementById(id).style.display = "none";
        return true;
    }
```
The following method examines the input format with regular expressions.

``` php
function ismatch_regex_input(regex ,value, id ) {

    if (regex.test(value) == false) {
        document.getElementById(id).style.display = "block";
        event.preventDefault();
   
    }else{
        document.getElementById(id).style.display = "none";
        

   
    }
} 

```
The following method calls the functions defined above in the following method.
``` php
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
```
In the form tags
``` php
attribute onsubmit = "return validateContact ()"

```
 It is defined that validations are performed based on this method and the following codes show the different methods for validating forms.
``` php
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
```
The following method is used to check whether user information is stored in the database
``` php
insert_id
```
However, note that the method of calling this method is as follows
``` php
$db->insert_id
```
This method shows the id of the last registered user, so that we can save the registered user id in the session and use it.
``` php
 $db = new mysqli('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "users";
        // for farsi data transfer to/from database
        $db->query("SET NAMES UTF8;");
        $y=$db->userTable;

        $sql = "INSERT INTO $y ( firstname,lastname ,gender ,state_id ,city_id ,address, phone_number, email  , password) VALUES('$firstname','$lastname','$gender','$state_id','$city_id','$address','$phone_number','$email','$password')";
        $result = $db->query($sql);
       
        if ($db->insert_id) {
            unset($_SESSION['firstname'],  $_SESSION['lastname'], $_SESSION['email'], $_SESSION['phone_number'], $_SESSION['address']);
            $_SESSION['id']=$db->insert_id;
            $_SESSION['login'] = true;

            header("location:http://localhost/Home.php?addUser=scsMsgUser");
            exit();
        } else {
            header("location:http://localhost/Register.php?addUser=errMsgUser");
            exit();
        }
    }
```

In this project, to use the user id in the editing section, we have sent it as a get.
``` php
<?php if (isset($_SESSION['login'])) : 
            $id=$_SESSION['id']; ?>
  <a href="<?php echo DB_USER_EDIT.'?id'.'='.$id; ?>"> <?php echo EDIT; ?></a>
```
