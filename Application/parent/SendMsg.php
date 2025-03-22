<?php
session_start();

if ($_SESSION["login_parent"] == null) {
    header("location: index.php");
} else {

    include('include/parent_navbar.php');
    $connection = mysqli_connect("localhost", "root", "", "sms6");


    

    if (isset($_POST["btn-send-msg"])) {
        $msg = $_POST["msg-name"];
        $teacher_id = $_POST["teacher_id"];
        $parent_id = $_POST["parent_id"];


        $query = "INSERT INTO message_tb (message,`to`,from_msg) values('$msg','$teacher_id','$parent_id') ";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo "Message sent";
            // header("location: Message.php");
        }
    }



}
