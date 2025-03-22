<?php
session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('include/teacher_navbar.php');
    $connection = mysqli_connect("localhost", "root", "", "sms6");



    if (isset($_POST["btn-upload-diary"])) {

        $class_id = $_POST["class-name"];
        $section_name = $_POST["section-name"];
        $date = $_POST["date-name"];
        $diary=$_POST["diary-name"];

    

        ///fetch the correspondind section id

        $s_id = 0;

        $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
        $query_run = mysqli_query($connection, $query);
        $result = mysqli_fetch_assoc($query_run);

        $section_id = $result["$s_id"];


        ////////////////////////////////////////////////teacher name

        $username = $_SESSION['login_teacher'];
        $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
        $query_run = mysqli_query($connection, $query);
        if (mysqli_num_rows($query_run) == 1) {
            $row = mysqli_fetch_assoc($query_run);
            $teacher_id = $row["teacher_id"];
        }



        $query = "INSERT INTO diary_tb (diary,class_id,section_id,date,teacher_id) values('$diary','$class_id','$section_id','$date','$teacher_id')";

        $query_run = mysqli_query($connection, $query);

        if($query_run){
            echo "Diary is Uploaded";
        }
        else{
            echo "$class_id-$section_id-$date-$diary-$teacher_id";
        }
    }
}
