<?php
session_start();
include 'lang/fa/user.php';
$_SESSION['select_state'] = 'true'; ?>
<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/verticalTabs.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/bootstraprtl-v4.css">
    <link rel="stylesheet" href="css/navbarResponse.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/register.css">


</head>

<body>
    
    <div class="sidebar responsive" id="sidebar">
        <a href="javascript:void(0);" style="font-size:15px;float:left" id="icon" onclick="myFunction()">&#9776;</a>
        <a style="font-size:15px;float:right" id="title"><?php echo 'Google Contacts'; ?></a>
        <a id="clear" style="clear: both;"></a>
        <?php if (isset($_SESSION['login'])) :  ?>
            <a href="<?php echo DB_HOME; ?>"><?php echo HOME; ?></a>
            <a href="#about"><?php echo IMPORT; ?></a>
            <a href="#services"><?php echo EXPORT; ?></a>
            <a href="#clients"><?php echo PRINT1; ?></a>
            <a href="#contact"><?php echo TRASH; ?></a>
            <a href="<?php echo DB_USER_LIST; ?>"> <?php echo SHOW; ?></a>
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

                        if ($_GET['addUser'] == "errMsgUser") {

                            $errorMsg = 'خطایی در هنگام ثبت  کاربر رخ داده است';
                            echo "<div class='error'>" . nl2br($errorMsg) . "</div>";
                        }

                        ?>
                    </div>

                    <form name="RegisterForm" action="inc/actions.php" onsubmit="return validateForm()" method="POST">
                        <div class="rw">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1m"> <?php echo FIRSTNANE; ?></label>
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-lg"  />
                                    <div id="firstNameAlert" class="alert alert-danger"><?php echo Pleaseـaddـname; ?></div>
                                    <div id="firstNameValidateAlert" class="alert alert-danger"><?php echo nameـValidateـAlert; ?></div>

                    
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1n"> <?php echo LASTNAME; ?> </label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-lg" value="<?php echo $_SESSION['lastname']; ?>" />
                                    <div id="lastNameAlert" class="alert alert-danger"><?php echo Pleaseـaddـname; ?></div>
                                    <div id="lastNameValidateAlert" class="alert alert-danger"><?php echo nameـValidateـAlert; ?></div>

                                </div>
                            </div>
                        </div>

                        <div class=" mb-4 py-2" style="margin-right: -13px;">
                            <div class="col-md-6 mb-4">
                                <select id="" name="gender" class="select-selected">
                                    <option value=""> <?php echo GENDER; ?></option>
                                    <option value="FMALE"> <?php echo FEMALE; ?></option>
                                    <option value="MALE"> <?php echo MALE1; ?></option>
                                    <option value="OTHER"> <?php echo OTHER; ?></option>

                                </select>

                            </div>
                        </div>

                        <div class="rw" >
                            <div class="col-md-6 mb-4">

                                <select id="state" name="state" class="select-selected">
                                    <option value=""> <?php echo STATE; ?></option>
                                    <option value="1"><?php echo Tehran; ?></option>
                                    <option value="2"><?php echo Ardabil; ?></option>

                                </select>

                            </div>
                            <div class="col-md-6 mb-4">

                                <select id="ajax-result" name="city" class="select-selected">
                                    <?php if (isset($_SESSION['select_state'])) :  ?>
                                        <option value=""> <?php echo ENTER_FIRST_STATE; ?></option>
                                    <?php endif; ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example8"> <?php echo ADDRESS; ?></label>
                            <input type="text" name="address" id="form3Example8" class="form-control form-control-lg" value="<?php echo $_SESSION['address']; ?>" />

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example97"> <?php echo PHONE_NUMBER; ?></label>
                            <input type="text" name="phone_number" id="userPhone" class="form-control form-control-lg" value="<?php echo $_SESSION['phone_number']; ?>" />
                            <div id="phoneAlert" class="alert alert-danger"><?php echo Pleaseـaddـphone; ?></div>
                            <div id="phoneValidateAlert" class="alert alert-danger"><?php echo phoneـValidateـAlert; ?></div>

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example97"> <?php echo EMAIL; ?></label>
                            <input type="text" name="email" id="userEmail" class="form-control form-control-lg" value="<?php echo $_SESSION['email']; ?>" />
                            <div id="emailAlert" class="alert alert-danger"><?php echo Pleaseـaddـemail; ?></div>
                            <div id="emailValisdateAlert" class="alert alert-danger"><?php echo mailـValisdateـAlert; ?></div>


                        </div>


                        <div class="rw">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1m1"><?php echo PASSWORD; ?></label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" />
                                    <div id="passwordAlert" class="alert alert-danger"><?php echo Pleaseـaddـpassword; ?></div>
                                    <div id="passwordValisdateAlert" class="alert alert-danger"><?php echo passwordـValisdateـAlert; ?></div>

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1n1"><?php echo REPEATPASSWORD; ?></label>
                                    <input type="password" name="Repeatpassword" id="Repeatpassword" class="form-control form-control-lg" />
                                    <div id="RepeatpasswordAlert" class="alert alert-danger "><?php echo PleaseـaddـRepeatpassword; ?></div>
                                    
                                </div>
                                <div id="RepeatpasswordValisdateAlert" class="alert alert-danger"><?php echo RepeatpasswordـValisdateـAlert; ?></div>
                            </div>
                        </div>
                
                <div class="justify-content-end pt-3" style="direction: rtl;">
                    <button type="submit" name="submitRegister" class="btn btn-info btn-lg ms-2" value="Submit"><?php echo RECORD; ?></button>
                    <button id="reset" type="reset" name="submitClear" class="btn btn-info btn-lg ms-2" value="Reset"><?php echo RESET; ?></button>
                </div>
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
    <script>
        $("#reset").click(function(e) {
            <?php unset(
                $_SESSION['firstname'],
                $_SESSION['lastname'],
                $_SESSION['email'],
                $_SESSION['phone_number'],
                $_SESSION['address']
            ) ?>
            location.reload(true);
        })
    </script>
    <script src="js/Form.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/validateInput.js"></script>
    
</body>


</html>