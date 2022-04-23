<?php
session_start();
include 'lang/fa/user.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new mysqli('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
    $db->userTable = "users";
    // for farsi data transfer to/from database
    $db->query("SET NAMES UTF8;");
    $sql1 = "SELECT * FROM $db->userTable where id='$id'";
    $result = $db->query($sql1);
    $user = $result->fetch_all(1);
    $_SESSION['selectID'] = $user['0']['city_id'];
}


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/verticalTabs.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/bootstraprtl-v4.css">
    <link rel="stylesheet" href="css/navbarResponse.css">
    <link rel="stylesheet" href="css/register.css">
    <script src="js/verticalTabs.js"></script>
    <title> <?php echo 'Google Contacts'; ?></title>
</head>

<body>
  
  
    <div class="sidebar responsive" id="sidebar">
        <a href="javascript:void(0);" style="font-size:15px;float:left" id="icon" onclick="myFunction()">&#9776;</a>
        <a style="font-size:15px;float:right" id="title"><?php echo 'Google Contacts'; ?></a>
        <a id="clear" style="clear: both;"></a>
        <?php if (isset($_SESSION['login'])) :  ?>
            <a href="<?php echo DB_HOME; ?>"><?php echo HOME; ?></a>
            <a href=""> <?php echo EDIT; ?></a>
            <a href="<?php echo DB_PHONE_BOOK; ?>"><?php echo IMPORT; ?></a>
            <a href="<?php echo DB_PHONE_BOOK; ?>"><?php echo EXPORT; ?></a>
            <a href="#clients"><?php echo PRINT1; ?></a>
            <a href="#contact"><?php echo TRASH; ?></a>
            <a href="<?php echo DB_USER_LOGOUT . '?logout=1'; ?>"> <?php echo LOGOUT; ?></a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['login'])) :  ?>
            <a href="<?php echo DB_USER_REGISTER; ?>"> <?php echo CREATE; ?> </a>
            <a href="<?php echo DB_USER_LOGIN; ?>"><?php echo LOGIN; ?></a>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="content" >

        <section class="h-100 " style="width: 75%; margin-right: 51px;">
            <div class="container py-5 h-100">
                <div class="card">
                    <div class="card-header">
                        <?php echo CREATE;

                        if ($_GET['validUser'] == "errMsgUserValid") {

                            $errorMsg = 'ایمیل تکراری است.';
                            echo "<div class='error'>" . nl2br($errorMsg) . "</div>";
                        }

                        if ($_GET['editUser'] == "scsMsgUser") {

                            $errorMsg = 'اطلاعات کاربر با موفقیت ثبت شد.';
                            echo "<div class='success'>" . nl2br($errorMsg) . "</div>";
                        }
                        if ($_GET['editUser'] == "errMsgUser") {

                            $errorMsg = 'خطایی در هنگام ثبت  کاربر رخ داده است';
                            echo "<div class='error'>" . nl2br($errorMsg) . "</div>";
                        }

                        ?>
                    </div>
                    <form name="RegisterForm" action="inc/actions.php" method="POST" onsubmit="return validateForm()">
                        <div class="rw">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
                                    <label class="form-label" for="form3Example1m"> <?php echo FIRSTNANE; ?></label>
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-lg" value="<?php print_r($user[0]['firstname']); ?>" />
                                    <div id="firstNameAlert" class="alert alert-danger"><?php echo Pleaseـaddـname; ?></div>
                                    <div id="firstNameValidateAlert" class="alert alert-danger"><?php echo nameـValidateـAlert; ?></div>

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1n"> <?php echo LASTNAME; ?> </label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-lg" value="<?php echo $user[0]['lastname']; ?>" />
                                    <div id="lastNameAlert" class="alert alert-danger"><?php echo Pleaseـaddـname; ?></div>
                                    <div id="lastNameValidateAlert" class="alert alert-danger"><?php echo nameـValidateـAlert; ?></div>

                                </div>
                            </div>
                        </div>

                        <div class=" mb-4 py-2" style="margin-right: -13px;">
                            <div class="col-md-6 mb-4">
                                <select id="" name="gender" class="select-selected">
                                    <option value=""> <?php echo GENDER; ?></option>
                                    <option value="FEMALE" <?php if ($user['0']['gender'] === 'FEMALE') {
                                                                echo "selected";
                                                            } ?>> <?php echo FEMALE; ?></option>
                                    <option value="MALE" <?php if ($user['0']['gender'] === 'MALE') {
                                                                echo "selected";
                                                            } ?>> <?php echo MALE1; ?></option>
                                    <option value="OTHER" <?php if ($user['0']['gender'] === 'OTHER') {
                                                                echo "selected";
                                                            } ?>> <?php echo OTHER; ?></option>

                                </select>

                            </div>
                        </div>

                        <div class="rw" >
                            <div class="col-md-6 mb-4">


                                <select id="state" name="state" class="select-selected">
                                    <option value=""> <?php echo STATE; ?></option>
                                    <option value="1" <?php if ($user['0']['state_id'] == '1') {
                                                            echo "selected";
                                                        } ?>> <?php echo Tehran; ?></option>
                                    <option value="2" <?php if ($user['0']['state_id'] == '2') {
                                                            echo "selected";
                                                        } ?>> <?php echo Ardabil; ?></option>

                                </select>

                            </div>
                            <div class="col-md-6 mb-4">

                                <select id="ajax-result" name="city" class="select-selected">
                                    <option value=""> <?php echo CITY; ?></option>

                                </select>

                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example8"> <?php echo ADDRESS; ?></label>
                            <input type="text" name="address" id="form3Example8" class="form-control form-control-lg" value="<?php echo $user[0]['address']; ?>">

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example97"> <?php echo PHONE_NUMBER; ?></label>
                            <input type="text" name="phone_number" id="userPhone" class="form-control form-control-lg" value="<?php echo $user[0]['phone_number']; ?>">
                            <div id="phoneAlert" class="alert alert-danger"><?php echo Pleaseـaddـphone; ?></div>
                            <div id="phoneValidateAlert" class="alert alert-danger"><?php echo phoneـValidateـAlert; ?></div>

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example97"> <?php echo EMAIL; ?></label>
                            <input type="text" name="email" id="userEmail" class="form-control form-control-lg" value="<?php echo $user[0]['email']; ?>">
                            <div id="emailAlert" class="alert alert-danger"><?php echo Pleaseـaddـemail; ?></div>
                            <div id="emailValisdateAlert" class="alert alert-danger"><?php echo mailـValisdateـAlert; ?></div>

                        </div>

                        <div class="rw" >
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1m1"><?php echo PASSWORD; ?></label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" value="" />
                                    <div id="passwordAlert" class="alert alert-danger"><?php echo Pleaseـaddـpassword; ?></div>
                                    <div id="passwordValisdateAlert" class="alert alert-danger"><?php echo passwordـValisdateـAlert; ?></div>

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1n1"><?php echo REPEATPASSWORD; ?></label>
                                    <input type="password" name="Repeatpassword" id="Repeatpassword" class="form-control form-control-lg" value="" />
                                    <div id="RepeatpasswordAlert" class="alert alert-danger "><?php echo PleaseـaddـRepeatpassword; ?></div>
                                    
                                    </div>
                                    <div id="RepeatpasswordValisdateAlert" class="alert alert-danger"><?php echo RepeatpasswordـValisdateـAlert; ?></div>
                            </div>
                        </div>
                        <div class="justify-content-end pt-3" style="direction: rtl;">
                            <button type="submit" name="submitEdit" class="btn btn-warning btn-lg ms-2"><?php echo RECORD; ?></button>
                        </div>
                </div>
            </div>
        </section>
        </form>

    </div>
    </div>
    </div>

    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/Form.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/validateInput.js"></script>
</body>

</html>