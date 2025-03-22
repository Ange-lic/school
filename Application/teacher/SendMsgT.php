<?php
session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('include/teacher_navbar.php');

    $connection = mysqli_connect("localhost", "root", "", "sms6");




    if (isset($_POST["btn-send-msgt"])) {
        $msg = $_POST["msg-name"];
        $teacher_id = $_POST["teacher_id"];
        foreach ($_POST['parent-name'] as $value) {



            $query = "INSERT INTO messageteacher_tb (msgT,to_msgT,from_msgT) values('$msg','$value','$teacher_id') ";
            $query_run = mysqli_query($connection, $query);

            
        }
        if ($query_run) {
            echo "Message sent";
            // header("location: Message.php");
        }
    }
}
