<?php
session_start();

function connection_db($localhost, $user, $password, $project)
{
    $db = new mysqli($localhost, $user, $password, $project);

    $db->query("SET NAMES UTF8;");
    return $db;
}

if (isset($_GET['action'])) {
    sleep(1);
    function getCity($citys)
    {

        $titleCity = $_SESSION['selectID'];
        $str = '<option value="" class="select-selected">' . nl2br('شهر') . '</option>';
        foreach ($citys as $city) {
            $str .= '<option value=" ' . $city['id'] . ' " >' . nl2br($city['title']) . '</option>';
        }
        echo $str;
        exit();
    }

    $action = $_GET['action'];
    if ($action == 'sc') {

        $qmArr = $_POST['qmStr'];
        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "users";
        $db->statesTable = "states";
        $db->cityTable = "city";
        $sql = "SELECT * FROM ($db->statesTable as s,$db->cityTable as c) where s.id=c.state_id and s.id= $qmArr";
        $result = $db->query($sql);
        $citys = $result->fetch_all(1);
        getCity($citys);
    }
    function getSelectCity($citys)
    {

        $titleCity = $_SESSION['selectID'];
        $str = '<option value="" class="select-selected">' . nl2br('شهر') . '</option>';
        foreach ($citys as $city) {
            $str .= '<option class="' . $_SESSION['selectID'] . '=' . $city['title'] . '"';
            if ($_SESSION['selectID'] === $city['id']) {
                $str .= " selected";
            }
            $str .= " value=" . $city['id'] . ">" . nl2br($city['title']) . "</option>";
        }
        echo $str;
    }
    $action = $_GET['action'];
    if ($action == 'eu') {

        $qmArr = $_POST['qmStr'];
        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "users";
        $db->statesTable = "states";
        $db->cityTable = "city";
        $sql = "SELECT * FROM ($db->statesTable as s,$db->cityTable as c) where s.id=c.state_id and s.id= $qmArr";
        $result = $db->query($sql);
        $citys = $result->fetch_all(1);
        getSelectCity($citys);
    }

    $action = $_GET['action'];
    if ($action == 'su') {

        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "contacts";
        $search = $_POST['suStr'];
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM $db->userTable where user_id='$id' and name like '$search' and and trash='0'";
        $result = $db->query($sql);
        $contacts = $result->fetch_all(1);

        if ($contacts) {

            foreach ($contacts as $contact) {

                $str .= '<tr>' . '<td>' . '<form id="" method="POST" action="EditContacts.php?id=' . $contact['id'] . '">' . '<input id="remove" name="id" type="hidden" class="" value="' . $contact['id'] . '"> <button type="submit" name="submitEdit" class="btn btn-success" > ' . nl2br("ویرایش") . ' </button></form>' . '</td>';
                $str .= '<td>' . '<form id="removeForm" method="POST" action="ajax.php?action=ru">' . '<input id="remove" name="id" type="hidden" class="" value="' . $contact['id'] . '"> <button type="submit" name="submitRemove" class="btn btn-danger" > ' . nl2br("حذف") . ' </button></form>' . '</td>';
                $str .=  '<td>' . nl2br($contact['email']) .  '</td>';
                $str .= '<td>' . nl2br($contact['mobile']) .  '</td>';
                $str .= '<td>' . nl2br($contact['name']) .  '</td>' . '</tr>';
            }
            echo $str;
        } else {

            $errorMsg = 'موردی یافت نشد.';
            $str = "<div class='error'>" . nl2br($errorMsg) . "</div>";
            echo $str;
        }
    }

    $action = $_GET['action'];
    if ($action == 'ic') {
        unset($_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['email'], $_SESSION['phone_number'], $_SESSION['address']);
    }

    $action = $_GET['action'];
    if ($action == 'ru') {

        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "contacts";
        $id = $_POST['id'];
        $sql = "UPDATE  $db->userTable  SET trash=1 where id='$id'";
        $result = $db->query($sql);
        header("location:http://localhost/Google_contact/Contacts.php?removeUser=sucMsgRemove");
        exit();
    }
    $action = $_GET['action'];
    if ($action == 'rutr') {

        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "contacts";
        $id = $_POST['id'];
        $sql = "DELETE FROM $db->userTable where id='$id'";
        $result = $db->query($sql);
        $page = $_SERVER['HTTP_REFERER'];
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
        exit();
    }

    $action = $_GET['action'];
    if ($action == 'resu') {

        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->userTable = "contacts";
        $id = $_POST['suStr'];
        $sql = "UPDATE $db->userTable  SET trash='0' where id='$id'";
        $result = $db->query($sql);
        $page = $_SERVER['HTTP_REFERER'];
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
        exit();
    }

    function titleState($state_id)
    {
        $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
        $db->stateTable = "states";
        $sql = "SELECT * FROM $db->stateTable where id='$state_id' ";
        $result = $db->query($sql);
        return  $state = $result->fetch_all(1);
    }
}
