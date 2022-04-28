<?php
session_start();
include 'lang/fa/user.php';
?>

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
    <link rel="stylesheet" href="css/navbarResponse.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="js/verticalTabs.js"></script>
    <title> <?php echo 'Google Contacts'; ?></title>
</head>

<body style="background-image:url(img/backgrounds-blank-blue-953214.jpg);margin-top: 0;
    height: 100%;">

<div class="sidebar responsive" id="sidebar">
        <a href="javascript:void(0);" style="font-size:15px;float:left" id="icon" onclick="myFunction()">&#9776;</a>
        <a style="font-size:15px;float:right" id="title"><?php echo 'Google Contacts'; ?></a>
        <a id="clear" style="clear: both;"></a>
        <?php if (isset($_SESSION['login'])) : 
            $id=$_SESSION['id']; ?>
          
        <a href="<?php echo DB_HOME; ?>"><?php echo HOME; ?></a>
        <a href="<?php echo DB_USER_EDIT.'?id'.'='.$id; ?>"> <?php echo EDIT; ?></a>
        <a href="<?php echo DB_USER_DISPLAY_CONTACTS; ?>"><?php echo DISPLAY_CONTACT; ?></a>
        <a href="<?php echo DB_IMPORT_USER; ?>"><?php echo IMPORT; ?></a>
        <a href="<?php echo DB_USER_EXPORTER; ?>"><?php echo PRINT1 ; ?></a>
        <a href="<?php echo DB_USER_TRASH; ?>"><?php echo TRASH; ?></a>
        <a href="<?php echo DB_USER_LOGOUT . '?logout=1'; ?>"> <?php echo LOGOUT; ?></a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['login'])) :  ?>
        <a href="<?php echo DB_USER_REGISTER; ?>"> <?php echo CREATE; ?> </a>
        <a href="<?php echo DB_USER_LOGIN; ?>"><?php echo LOGIN; ?></a>
        <?php endif; ?>
    </div>
    <!-- Content -->
    <div class="content" >
    <div class="card" style="margin-top: 10%;width: 80%;">
    <div class="card-header">
      <?php 
      if ($_GET['validUser'] == "true") {

        $errorMsg = 'ورود با موفقیت انجام شد.';
        echo "<div class='success'>" . nl2br($errorMsg) . "</div>";
    }
    if ($_GET['addUser'] == "scsMsgUser") {

      $errorMsg = 'اطلاعات کاربر با موفقیت ثبت شد.';
      echo "<div class='success'>" . nl2br($errorMsg) . "</div>";
  }
      ?>
    </div>
    <form>
  <div class="form-row">
    <?php
    $id=$_SESSION['id'];
    $db = new mysqli('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');

    $db->contactTable = "users";
    // for farsi data transfer to/from database
    $db->query("SET NAMES UTF8;");
    $sql = "SELECT * FROM $db->contactTable  where id='$id' ";
    $result = $db->query($sql);
    $states = $result->fetch_all(1);
    ?>
  

  <div class="form-group col-md-6">
      <label for="inputEmail4"><?php echo FIRSTNANE; ?></label>
      <input readonly type="email" class="form-control" id="inputEmail4" placeholder="<?php echo $states[0]['firstname']; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4"><?php echo LASTNAME; ?></label>
      <input readonly type="email" class="form-control" id="inputEmail4" placeholder="<?php echo $states[0]['lastname']; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4"> <?php echo EMAIL; ?></label>
      <input readonly type="email" class="form-control" id="inputEmail4" placeholder="<?php echo $states[0]['email']; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4"><?php echo PHONE_NUMBER; ?></label>
      <input readonly type="password" class="form-control" id="inputPassword4" placeholder="<?php echo $states[0]['phone_number']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress"><?php echo ADDRESS; ?></label>
    <input readonly type="text" class="form-control" id="inputAddress" placeholder="<?php echo $states[0]['address']; ?>">
  </div>
  
  <div class="form-row">
  <div class="form-group col-md-4">
      <label for="inputState"><?php echo STATE; ?></label>
      <select readonly id="inputState" class="form-control">
      <option value="1" <?php if ($states['0']['state_id'] == '1') {
                                                            echo "selected";
                                                        } ?>> <?php echo Tehran; ?></option>
                                    <option value="2" <?php if ($states['0']['state_id'] == '2') {
                                                            echo "selected";
                                                        } ?>> <?php echo Ardabil; ?></option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState"><?php echo CITY; ?></label>
      <select readonly id="inputState" class="form-control">
      <option value="2" <?php if ($states['0']['city_id'] == '1') {
                                                            echo "selected";
                                                        } ?>> قدس
      </option>
      <option value="2" <?php if ($states['0']['city_id'] == '2') {
                                                            echo "selected";
                                                        } ?>> شهریار      </option>
      <option value="2" <?php if ($states['0']['city_id'] == '3') {
                                                            echo "selected";
                                                        } ?>> اسلامشهر
      </option>
      <option value="2" <?php if ($states['0']['city_id'] == '4') {
                                                            echo "selected";
                                                        } ?>> خلخال
      </option>
      <option value="2" <?php if ($states['0']['city_id'] == '5') {
                                                            echo "selected";
                                                        } ?>> سرعین
      </option>

      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState"><?php echo GENDER; ?></label>
      <select readonly id="inputState" class="form-control">
      <option value="FEMALE" <?php if ($states['0']['gender'] === 'FEMALE') {
                                                                echo "selected";
                                                            } ?>> <?php echo FEMALE; ?></option>
                                    <option value="MALE" <?php if ($states['0']['gender'] === 'MALE') {
                                                                echo "selected";
                                                            } ?>> <?php echo MALE1; ?></option>
                                    <option value="OTHER" <?php if ($states['0']['gender'] === 'OTHER') {
                                                                echo "selected";
                                                            } ?>> <?php echo OTHER; ?></option>
      </select>
    </div>
  </div>
  
  
</form>
    </div>
</body>
<script>
        function myFunction() {
            var x = document.getElementById("sidebar");
            if (x.className === "sidebar") {
                x.className += " responsive";
            } else {
                x.className = "sidebar";
            }
        }
    </script>
</html>