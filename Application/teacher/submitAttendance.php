<?php
session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('include/teacher_navbar.php');

?>

    <?php

    $connection = mysqli_connect("localhost", "root", "", "sms6");

    if (isset($_POST["btn-submit-attendance"])) {

        foreach ($_POST['attendance_status'] as $id => $status) {


            $student_id = $_POST["student_id"][$id];


            $date = $_POST["date"];

            $query2 = "SELECT * from attendance_tb where student_id='$student_id' and date='$date'";
            $query_run = mysqli_query($connection, $query2);

            if (mysqli_num_rows($query_run) > 0) {


                $query = "UPDATE attendance_tb SET status='$status' where student_id='$student_id' and date='$date'";

                $query_run = mysqli_query($connection, $query);
            } else {



                $query = "INSERT INTO attendance_tb (student_id,date,status) values('$student_id','$date','$status')";

                $query_run = mysqli_query($connection, $query);
            }

            if ($query_run) {
                // header("location: MarkAttendance.php");
                echo "Attendance done";
            } else {
                echo "Not inserted into Attendance table";
            }
        }
    }
    ?>




    <form action="submitAttendance.php" method="POST">

        <table class="table" style="width: 90%;">
            <thead>
                <tr class="success">
                    <th>Std ID.</th>
                    <th>Std Name</th>
                    <th>Date</th>
                    <th>Status</th>

                </tr>
            </thead>


            <tbody>


                <?php

                $connection = mysqli_connect("localhost", "root", "", "sms6");


                if (isset($_POST["btn-search-student"])) {

                    $class_id = $_POST["class-name"];
                    $section_name = $_POST["section-name"];
                    $date = $_POST["date-name"];

                    ///fetch the correspondind class name

                    $c_n = 0;

                    $query = " SELECT class_name as '$c_n' FROM class_tb WHERE class_id='$class_id' ";
                    $query_run = mysqli_query($connection, $query);
                    $result = mysqli_fetch_assoc($query_run);

                    $class_name = $result["$c_n"];



                    ///fetch the correspondind section id

                    $s_id = 0;
                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                    $query_run = mysqli_query($connection, $query);
                    $result = mysqli_fetch_assoc($query_run);

                    $section_id = $result["$s_id"];



                    ////////////////////////////////

                    $query = "SELECT section_name FROM section WHERE class_id='$class_id'  ";

                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            # code...



                            $query = "SELECT student_id, student_name FROM student_tb WHERE class_id='$class_id' AND section_id='$section_id' ";

                            $query_run = mysqli_query($connection, $query);

                            $counter = 0;
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                # code...

                                $student_id = $row["student_id"];
                                $student_name = $row["student_name"];


                                $query2 = "SELECT * from attendance_tb where student_id='$student_id' and date='$date'";
                                $query_run2 = mysqli_query($connection, $query2);

                                if (mysqli_num_rows($query_run2) > 0) {

                                    while ($row2 = mysqli_fetch_assoc($query_run2)) {


                ?>

                                        <tr class="active">

                                            <td> <?php echo $student_id ?>
                                                <input type="hidden" value="<?php echo $student_id ?>" name="student_id[]">
                                            </td>

                                            <td><?php echo $student_name ?>
                                                <input type="hidden" value="<?php echo $student_name ?>" name="student_name[]">
                                            </td>

                                            <td><?php echo $date ?></td>

                                            <td>

                                                <?php

                                                $status = $row2["status"];

                                                if ($status == 'Present') {

                                                ?>
                                                    <input type="radio" checked name="attendance_status[<?php echo $counter; ?>]" value="<?php echo $status ?>" required> <?php echo $status ?>
                                                <?php

                                                } else {
                                                ?> <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present" required>Present
                                                <?php
                                                }

                                                if ($status == 'Absent') {

                                                ?>
                                                    <input type="radio" checked name="attendance_status[<?php echo $counter; ?>]" value="<?php echo $status ?>" required> <?php echo $status ?>
                                                <?php

                                                } else {
                                                ?> <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent" required>Absent
                                                <?php
                                                }

                                                if ($status == 'Leave') {

                                                ?>
                                                    <input type="radio" checked name="attendance_status[<?php echo $counter; ?>]" value="<?php echo $status ?>" required> <?php echo $status ?>
                                                <?php

                                                } else {
                                                ?> <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Leave" required>Leave
                                                <?php
                                                }



                                                ?>



                                            </td>

                                        </tr>
                                        <input type="hidden" value="<?php echo $date ?>" name="date">

                                    <?php

                                        $counter++;
                                    }
                                } else {




                                    ?>

                                    <tr class="active">

                                        <td> <?php echo $row["student_id"] ?>
                                            <input type="hidden" value="<?php echo $row["student_id"] ?>" name="student_id[]" required>
                                        </td>

                                        <td><?php echo $row["student_name"] ?>
                                            <input type="hidden" value="<?php echo $row["student_name"] ?>" name="student_name[]" required>
                                        </td>

                                        <td><?php echo $date ?></td>

                                        <td>
                                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present" required>Present
                                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent" required> Absent
                                            <input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Leave" required> On Leave

                                        </td>

                                    </tr>
                                    <input type="hidden" value="<?php echo $date ?>" name="date">


                <?php
                                    $counter++;
                                }
                            }
                        }
                    }
                } else {
                    // echo "No record found";
                }
                ?>




            </tbody>

        </table>
        <br><br><br><br>
        <button type="submit" style="float:right; margin-right:120px;" class="btn btn-info" id="btn-class-search" name="btn-submit-attendance">Submit</button>

    </form>

<?php
}
?>