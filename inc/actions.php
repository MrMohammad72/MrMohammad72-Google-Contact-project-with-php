<?php
session_start();

function connection_db($localhost,$user,$password,$project)
{
   $db=new mysqli($localhost,$user,$password,$project);  
     $db->query("SET NAMES UTF8;");
     return $db;
}

if (isset($_POST['submitRemove'])) {


    $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
    $db->userTable = "users";
    $id = $_POST['id'];
    $sql = "DELETE FROM $db->userTable where id='$id'";
    $result = $db->query($sql);

    header("location:http://localhost/Google_contact/List.php?removeUser=sucMsgRemove");
    exit();
}



if ($_GET['logout'] == 1) {
    unset($_SESSION['login'],  $_SESSION['id'], $_SESSION['email'], $_SESSION['firstname']);
    header("location:http://localhost/Google_contact/Login.php?exitUser=true");
    exit();
}



if (isset($_POST['submitRegister'])) {


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['address'] = $address;
    $_SESSION['select_state'] = 'true';
    $hasError = 'false';
    $hasAddError = 'false';

    if ($hasError == 'false') {
        $email = $_POST['email'];
      
        $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "users";
        // for farsi data transfer to/from database
        $db->query("SET NAMES UTF8;");
        $sql = "SELECT count(email) FROM $db->userTable where email='$email' ";
        $result = $db->query($sql);
        $count = $result->fetch_all(2);

        if ($count[0][0] >= 1) {
            // die('stop 1');

            $hasAddError = 'true';
            header("location:http://localhost/Google_contact/Register.php?validUser=errMsgUserValid");
            exit();
        }
    }
    if ($hasAddError == 'false') {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $state_id  = $_POST['state'];
        $city_id = $_POST['city'];
    


        $db = new mysqli('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "users";
        $y=$db->userTable;

        $sql = "INSERT INTO $y ( firstname,lastname ,gender ,state_id ,city_id ,address, phone_number, email  , password) VALUES('$firstname','$lastname','$gender','$state_id','$city_id','$address','$phone_number','$email','$password')";
        $result = $db->query($sql);   

        if ($db->insert_id) {
            unset($_SESSION['firstname'],  $_SESSION['lastname'], $_SESSION['email'], $_SESSION['phone_number'], $_SESSION['address']);
            $_SESSION['id']=$db->insert_id;
            $_SESSION['login'] = true;

            header("location:http://localhost/Google_contact/Home.php?addUser=scsMsgUser");
            exit();
        } else {
            header("location:http://localhost/Google_contact/Register.php?addUser=errMsgUser");
            exit();
        }
    }
}
/* -------------------------------------------------- */


if (isset($_POST['submitEdit'])) {
   
        $hasError = 'false';
        $hasAddError = 'false';

        if (!preg_match("/([\w\-]+\@[\w\-]+\.com$)/", $_POST['email'])) {
            $hasError = 'true';
            header("location:http://localhost/Google_contact/Edit.php?validInput=errMsgEmail");
            exit();
        }

        if ($hasError == 'false') {
            $email = $_POST['email'];
            $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
            $db->userTable = "users";
            $db->query("SET NAMES UTF8;");
            $sql = "SELECT count(email) FROM $db->userTable where email='$email' ";
            $result = $db->query($sql);
            $count = $result->fetch_all(2);

            if ($count[0][0] >= 1) {
                $hasAddError = 'true';
                header("location:http://localhost/Google_contact/Edit.php?validUser=errMsgUserValid");
                exit();
            }
        }
        if ($hasAddError == 'false') {

            function getState($state_id)
            {

                $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
                $db->stateTable = "states";
                $db->query("SET NAMES UTF8;");
                $sql = "SELECT * FROM $db->stateTable  where id='$state_id' ";
                $result = $db->query($sql);
                $state = $result->fetch_all(1);
                return $state[0]['title'];
            }

            function getCity($city_id)
            {
                $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
                $db->cityTable = "city";
                $db->query("SET NAMES UTF8;");
                $sql = "SELECT * FROM $db->cityTable  where id='$city_id' ";
                $result = $db->query($sql);
                $city = $result->fetch_all(1);
                return $city[0]['title'];
            }

            /* ------------------- input form---------------- */

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $password = $_POST['password'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $state_id  = $_POST['state'];
            $city_id = $_POST['city'];
            $state  = getState($state_id);
            $city = getCity($city_id);

            /* --------------database ---------------- */
            $id = $_POST['id'];
            $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
            $db->userTable = "users";
            $sql = "SELECT * FROM $db->userTable  where id='$id' ";
            $result = $db->query($sql);
            $user = $result->fetch_all(1);
            $id = $_POST['id'];
            $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
            $db->userTable = "users";
            $x = $db->userTable;
            $sqlupdate .= "UPDATE $x  SET ";
            if ($firstname !== $user[0]['firstname']) {
                $sqlupdate .= " firstname ='$firstname'";
            } else {
                $oldFirsname = $user[0]['firstname'];
                $sqlupdate .= " firstname ='$oldFirsname'";
            }

            if ($lastname !== $user[0]['lastname']) {
                $sqlupdate .= ",lastname ='$lastname'";
            } else {
                $oldLastname = $user[0]['lastname'];
                $sqlupdate .= " ,lastname ='$oldLastname'";
            }
            if ($gender !== $user[0]['gender']) {
                $sqlupdate .= " ,gender='$gender'";
            } else {
                $oldGender = $user[0]['gender'];
                $sqlupdate .= " ,gender ='$oldGender'";
            }

            if ($stateTitle !== $user[0]['state_id']) {
                $sqlupdate .= " ,state_id ='$state_id'";
            } else {
                $oldStateTitle = $user[0]['state_id'];
                $sqlupdate .= " ,state_id ='$oldStateTitle'";
            }

            if ($cityTitle !== $user[0]['city_id']) {
                $sqlupdate .= " ,city_id ='$city_id'";
            } else {
                $oldCityTitle = $user[0]['city_id'];
                $sqlupdate .= " ,city_id ='$oldCityTitle'";
            }

            if ($address !== $user[0]['address']) {
                $sqlupdate .= " ,address='$address'";
            } else {
                $oldAddress = $user[0]['address'];
                $sqlupdate .= " ,address='$oldAddress'";
            }

            if ($email !== $user[0]['email']) {
                $sqlupdate .= " ,email='$email'";
            } else {
                $oldEmail = $user[0]['email'];
                $sqlupdate .= " ,email='$oldEmail'";
            }

            if ($phone_number !== $user[0]['phone_number']) {
                $sqlupdate .= " ,phone_number='$phone_number'";
            } else {
                $oldPhone_number = $user[0]['phone_number'];
                $sqlupdate .= " ,phone_number='$oldPhone_number'";
            }

            if ($password !== $user[0]['password']) {
                $sqlupdate .= " ,password='$password'";
            } else {
                $oldPassword = $user[0]['password'];
                $sqlupdate .= " ,password='$oldPassword'";
            }
            $sqlupdate .= " where id='$id' ";
            $result = $db->query($sqlupdate);
            if (!$result->insert_id) {
                header("location:http://localhost/Google_contact/EditForm.php?editUser=scsMsgUser");
                exit();
            } else {
                header("location:http://localhost/Google_contact/EditForm.php?editUser=errMsgUser");
                exit();
            }
        }
   
}

if (isset($_POST['EditContacts'])) {

    $contact_id = $_POST['contact_id'];
    $user_id = $_POST['user_id'];

    $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
    $db->userTable = "contacts";
    $sql = "SELECT * FROM $db->userTable  where id='$contact_id' ";
    $result = $db->query($sql);
    $user = $result->fetch_all(1);

    $userName = $_POST['userName'];
    $userPhone = $_POST['userPhone'];
    $userEmail = $_POST['userEmail'];


    $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
    $db->userTable = "contacts";
    $x = $db->userTable;
    $sqlupdate .= "UPDATE $x  SET ";
    if ($userName !== $user[0]['name']) {
        $sqlupdate .= " name ='$userName'";
    } else {
        $oldFirsname = $user[0]['name'];
        $sqlupdate .= " name ='$oldFirsname'";
    }
    if ($userPhone !== $user[0]['mobile']) {
        $sqlupdate .= " ,mobile='$userPhone'";
    } else {
        $oldPhone_number = $user[0]['mobile'];
        $sqlupdate .= " ,mobile='$oldPhone_number'";
    }
    if ($userEmail !== $user[0]['email']) {
        $sqlupdate .= " ,email='$userEmail'";
    } else {
        $oldEmail = $user[0]['email'];
        $sqlupdate .= " ,email='$oldEmail'";
    }
    $sqlupdate .= " where id='$contact_id' ";
    $sqlupdate .= " and user_id=' $user_id' ";
    $result = $db->query($sqlupdate);

    if (!$result->insert_id) {
        header("location:http://localhost/Google_contact/EditContacts.php?editUser=scsMsgUser");
        exit();
    } else {
        header("location:http://localhost/Google_contact/EditContacts.php?editUser=errMsgUser");
        exit();
    }
}


if (isset($_POST['submitLogin'])) {


    if ($_POST['email'] && $_POST['password']) {

        $email = $_POST['email'];
        $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "users";

        $sql = "SELECT * FROM $db->userTable where email='$email'";
        $query = $db->query($sql);
        $result = $query->fetch_all(1);

        if ($_POST['password'] == $result[0]['password']) {

            $_SESSION['login'] = true;
            $_SESSION['id'] = array_flatten($result)['id'];
            $_SESSION['firstname'] = $result[0]['firstname'];


            header("location:http://localhost/Google_contact/Home.php?validUser=true");
            exit();
        } else {
            header("location:http://localhost/Google_contact/Login.php?validUser=false");
            exit();
        }
    }
}

function array_flatten($array)
{
    $return = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $return = array_merge($return, array_flatten($value));
        } else {
            $return[$key] = $value;
        }
    }

    return $return;
}


if (isset($_POST['SubmitContacts'])) {


    $userName = $_POST['userName'];
    $userPhone = $_POST['userPhone'];
    $userEmail = $_POST['userEmail'];
    $user_id = $_POST['user_id'];


    $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
    $db->userTable = "contacts";
    $sql = "SELECT * FROM $db->userTable where email='$userEmail' ";

    $result = $db->query($sql);
    $contacts = $result->fetch_all(1);

    if ($userEmail == $contacts[0]['email']) {
        header("location:http://localhost/Google_contact/Contacts.php?validContacts=errMsgContactsValid");
        exit();
    } else {
        $db =connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->contactTable = "contacts";
        $sql = "INSERT INTO $db->contactTable ( user_id,name ,mobile,email) VALUES( '$user_id','$userName','$userPhone','$userEmail')";
        $result = $db->query($sql);
        if ($result) {
            header("location:http://localhost/Google_contact/Contacts.php?addContacts=sucessAddContacts");
            exit();
        } else {
            header("location:http://localhost/Google_contact/Contacts.php?addContacts=errAddContacts");
            exit();
        }
    }
}
