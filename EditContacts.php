<?php
session_start();


include 'lang/fa/user.php';
?>
<html>

<head>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/index_style.css" />
    <link rel="stylesheet" href="css/Contacts.css" />

    <title> <?php echo 'Google Contacts'; ?></title>
</head>

<body>
    
    <div class="jumbotron jum" style="background-color: #212529;text-align: center;">
        <ul class="breadcrumb">
            <li><a href="<?php echo DB_HOME; ?>"><?php echo HOME; ?></a></li>

            <li><a href="#"><?php echo PHONE_BOOK; ?></a></li>
        </ul>

        <div class="row">
            <div class="col-lg-4 inp">
                <h5 class="mt-2" style="text-align: right;"><?php echo SEARCH; ?></h5>

                <form action="ajax.php" id="searchForm" method="POST" >
                    <input class=" form-control mb-3 mt-3" id="searchName" name="searchName" style="text-align: center;" placeholder="<?php echo Pleaseـaddـname; ?>" required>

                    <button name="SubmitSearch" type="submit" class="btn btn-info w-100 btn1" value="Submit"><?php echo SEARCH; ?></button>
                </form>

                <h5 class="mt-2" style="text-align: right;"><?php echo EDIT1; ?></h5>
                <?php
                if ($_GET['addContacts'] == "sucessAddContacts") {

                    $errorMsg = 'ثبت با موفقیت انجام شد.';
                    echo "<div class='success'>" . nl2br($errorMsg) . "</div>";
                }

                if ($_GET['validContacts'] == "errMsgContactsValid") {

                    $errorMsg = 'ایمیل تکراری است.';
                    echo "<div class='error'>" . nl2br($errorMsg) . "</div>";
                }

                if ($_GET['addContacts'] == "errAddContacts") {

                    $errorMsg = 'خطایی در هنگام ثبت  کاربر رخ داده است';
                    echo "<div class='error'>" . nl2br($errorMsg) . "</div>";
                }
                if ($_GET['removeUser'] == "sucMsgRemove") {

                    $errorMsg = 'حذف کاربر با موفقیت انجام شد.';
                    echo "<div class='success'>" . nl2br($errorMsg) . "</div>";
                }
                if ($_GET['editUser'] == "scsMsgUser") {

                    $errorMsg = 'اطلاعات کاربر با موفقیت ثبت شد.';
                    echo "<div class='success'>" . nl2br($errorMsg) . "</div>";
                }
                if ($_GET['editUser'] == "errMsgUser") {

                    $errorMsg = 'خطایی در هنگام ثبت  کاربر رخ داده است';
                    echo "<div class='error'>" . nl2br($errorMsg) . "</div>";
                }
                $id = $_POST['id'];
                $db = new mysqli('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
                $db->userTable = "contacts";
                // for farsi data transfer to/from database
                $db->query("SET NAMES UTF8;");
                $sql = "SELECT * FROM $db->userTable  where id='$id' ";
                $result = $db->query($sql);
                $user = $result->fetch_all(1);
                ?>

                <form name="myForm" action="inc/actions.php" onsubmit="return validateContact()" method="POST">

                    <input name="contact_id" type="hidden" value="<?php echo $id; ?>">
                    <input name="user_id" type="hidden" value="<?php echo $_SESSION['id']; ?>">

                    <input class="form-control mb-3 mt-3" value="<?php echo $user[0]['name']; ?>" id="userName" name="userName" style="text-align: center;">

                    <div id="nameAlert" class="alert alert-danger text-justify p-2 " style="direction: rtl;"><?php echo Pleaseـaddـname; ?></div>
                    <div id="nameValidateAlert" class="alert alert-danger text-justify p-2 " style="direction: rtl;"><?php echo nameـValidateـAlert; ?></div>

                    <input class="form-control mb-3" value="<?php echo $user[0]['mobile']; ?>" id="userPhone" name="userPhone" style="text-align: center;">

                    <div id="phoneAlert" class="alert alert-danger text-justify p-2 " style="direction: rtl;"><?php echo Pleaseـaddـphone; ?></div>
                    <div id="phoneValidateAlert" class="alert alert-danger text-justify p-2 " style="direction: rtl;"><?php echo phoneـValidateـAlert; ?></div>

                    <input class="form-control mb-3" value="<?php echo $user[0]['email']; ?>" id="userEmail" name="userEmail" style="text-align: center;">

                    <div id="mailAlert" class="alert alert-danger text-justify p-2 " style="direction: rtl;"><?php echo Pleaseـaddـemail; ?></div>
                    <div id="mailValisdateAlert" class="alert alert-danger text-justify p-2 " style="direction: rtl;"><?php echo mailـValisdateـAlert; ?></div>

                    <button name="EditContacts" type="submit" class="btn btn-info w-100 btn1" value="Submit"><?php echo EDIT1; ?></button>
                </form>
            </div>
            <?php
            $user_id = $_SESSION['id'];
            $db = new mysqli('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');

            $db->contactTable = "contacts";
            // for farsi data transfer to/from database
            $db->query("SET NAMES UTF8;");
            $sql = "SELECT * FROM $db->contactTable  where user_id='$user_id' and trash='0' ";
            $result = $db->query($sql);
            $states = $result->fetch_all(1);
            ?>
            <div class="col-lg-8">

                <table id="myTable" class="table text-justify table-striped">

                    <thead class="tableh1" style="direction: rtl;text-align: center;">

                        <th></th>
                        <th></th>
                        <th class=""><?php echo EMAIL; ?></th>
                        <th class=""><?php echo PHONE; ?></th>
                        <th class=""><?php echo NAME; ?></th>
                    </thead>

                    <tbody id="ajax-result">
                        <?php 
                        foreach ($states as $state) {
                        ?>
                            <tr>
                                <th style="text-align: center;">
                                    <form id="removeForm" method="POST" action="ajax.php?action=ru"><input id="remove" name="id" type="hidden" class="" value="<?php echo $state['id']; ?>"> <button type="submit" name="submitRemove" class="btn btn-danger"><?php echo REMOVE; ?> </button></form>

                                </th>
                                <th style="text-align: center;">
                                    <form id="editForm" method="POST" action="EditContacts.php"> <input name="id" type="hidden" class="" value="<?php echo $state['id']; ?>"><button type="submit" name="submitEdit" class="btn btn-success"> <?php echo EDIT1; ?> </button></form>
                                </th>
                                <th style="text-align: center;"><?php echo $state['email']; ?></th>
                                <th style="text-align: center;"><?php echo $state['mobile']; ?></th>
                                <th style="text-align: center;"><?php echo $state['name']; ?></th>

                            </tr>

                        <?php  }; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/Contacts.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validateInput.js"></script>

</body>

</html>