<?php
session_start();

include 'lang/fa/user.php'; ?>
<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/verticalTabs.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/bootstraprtl-v4.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/navbarResponse.css">
    <link rel="stylesheet" href="css/login.css">
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
                        ورود
                        <?php

        
                        if ($_GET['validUser'] == "false") {

                            $errorMsg = 'کاربری با این ایمیل و  کلمه عبور وجود ندارد.';
                            echo "<div class='error' >" . nl2br($errorMsg) . "</div>";
                        }
                      
                        if ($_GET['exitUser'] == "true") {


                            $errorMsg = ' خروج با موفقیت انجام شد.';
                            echo "<div class='success' >" . nl2br($errorMsg) . "</div>";
                        }


                        ?>
                    </div>
            
                    <form name="LoginForm" onsubmit="return validateLogin()" action="inc/actions.php" method="POST">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example97"><?php echo EMAIL; ?></label>
                          
                            <input type="text" name="email" id="userEmail" class="form-control form-control-lg" value="" />
                            <div id="emailAlert" class="alert alert-danger"><?php echo Pleaseـaddـemail; ?></div>
                            <div id="emailValisdateAlert" class="alert alert-danger"><?php echo mailـValisdateـAlert; ?></div>

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example97"><?php echo PASSWORD; ?></label>
                            <input type="password" name="password" id="userPassword" class="form-control form-control-lg" />
                            <div id="passwordAlert" class="alert alert-danger"><?php echo Pleaseـaddـpassword; ?></div>
                            <div id="passwordValisdateAlert" class="alert alert-danger"><?php echo passwordـValisdateـAlert; ?></div>

                        </div>

                        <div class="justify-content-end pt-3" style="direction: rtl;">
                            <button type="submit" name="submitLogin" class="btn btn-warning btn-lg ms-2"><?php echo SEND; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
    <script src="js/validateInput.js"></script>
    <script src="js/Form.js"></script>
    </div>
</body>

</html>