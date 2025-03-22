
<?php

session_start();

if ($_SESSION["login_admin"] == null) {


    header("location:  index.php");
} else {

    include_once('include/admin_navbar.php');


    if (isset($_POST["btn-add-schedule"])) {

        $class_id = $_POST["class-id"];
        $section_id = $_POST["section-id"];
        $subject_id = $_POST["subject-id"];
        $day = $_POST["day"];
        $slot = $_POST["slot-name"];

        $query = "INSERT INTO schedule_tb (class_id,section_id,subject_id,day,slot) VALUES('$class_id','$section_id','$subject_id','$day','$slot')";

        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo "<h2>Schedule Inserted</h2>";
            echo "$class_id-$section_id-$subject_id-$day-$slot";
        } else {
            echo "$class_id-$section_id-$subject_id-$day-$slot askjfasnfdlk";
        }
    }
}
?>