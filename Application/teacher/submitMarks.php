<?php
session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('include/teacher_navbar.php');
    $connection = mysqli_connect("localhost", "root", "", "sms6");



    if (isset($_POST["btn-submit-marks"])) {
        $c = 0;

        foreach ($_POST['marks'] as $id => $marks) {

            $student_name = $_POST["student_name"][$id];
            $student_id = $_POST["student_id"][$id];

            $class_name = $_POST["class-name"];
            $class_id = $_POST["class-id-name"];

            $section_id = $_POST["section-id-name"];
            $section_name = $_POST["section-name"];

            $subject_id = $_POST["subject-name"];

            $exam_name = $_POST["exam-name"];



            ///fetch the correspondind subject name

            $sb_n = 0;
            $query = " SELECT subject_name as '$sb_n' FROM subject_tb WHERE subject_id='$subject_id' AND class_id='$class_id' ";
            $query_run = mysqli_query($connection, $query);
            $result = mysqli_fetch_assoc($query_run);

            $subject_name = $result["$sb_n"];


            $query2 = "SELECT * FROM marks_table where student_id='$student_id' and exam_name='$exam_name' and class_id='$class_id' and section_id='$section_id' and subject_id='$subject_id' ";
            $query_run2 = mysqli_query($connection, $query2);


            if (mysqli_num_rows($query_run2) > 0) {
                $c++;
                $query = "UPDATE marks_table set marks='$marks' where student_id='$student_id' and class_id='$class_id' and section_id='$section_id' and subject_id='$subject_id' and exam_name='$exam_name'";

                $query_run = mysqli_query($connection, $query);
				mysqli_query($connection, "UPDATE marking set marks='$marks' where student_id='$student_id' and subject='$subject_id' and exam='$exam_name';");
            } else {




                $query = "INSERT INTO marks_table (student_id,class_id, section_id, subject_id,exam_name,marks) values('$student_id','$class_id','$section_id','$subject_id','$exam_name','$marks')";

                $query_run = mysqli_query($connection, $query);
				mysqli_query($connection, "insert into marking(student_id, subject, marks, exam) values('$student_id', '$subject_id', '$marks', '$exam_name');");
            }

            if ($query_run) {
                // /header("location: GiveMarks.php");
                //  echo "Marks Submited";
                // echo "$c-".$student_id."-".$student_name . "-" . $subject_id . "-" . $subject_name . "-" . $exam_name . "-" . $marks . "-" . $class_id . "-" . $section_id . "-" . $section_name."<hr>";
            } else {
                echo $student_id . $student_name . " " . $subject_id . " " . $subject_name . " " . $exam_name . " " . $marks . " " . $class_id . " " . $section_id . " " . $section_name;
            }
        }
    }
?>


    <form method="POST" action="submitMarks.php">

        <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-submit-marks">Submit</button>

        <br><br><br>
        <table class="table" style="width: 90%;">
            <thead>
                <tr class="success">
                    <th>Std ID.</th>
                    <th>Std Name</th>
                    <th>Subject</th>
                    <th>Exam</th>
                    <th>Marks</th>

                </tr>
            </thead>


            <tbody>


                <?php



                if (isset($_POST["btn-search-student-att"])) {

                    $class_id = $_POST["class-name"];
                    $section_name = $_POST["section-name"];
                    $subject_id = $_POST["subject-name"];
                    $exam_name = $_POST["exam-name"];




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




                    ///fetch the correspondind subject name

                    $sb_n = 0;
                    $query = " SELECT subject_name as '$sb_n' FROM subject_tb WHERE subject_id='$subject_id' AND class_id='$class_id' ";
                    $query_run = mysqli_query($connection, $query);
                    $result = mysqli_fetch_assoc($query_run);

                    $subject_name = $result["$sb_n"];

                    // echo "$class_id-$class_name-$section_id-$section_name-$subject_id-$subject_name";



                ?>


                    <input type="hidden" name="class-id-name" value="<?php echo $class_id ?>">
                    <input type="hidden" name="class-name" value="<?php echo $class_name ?>">
                    <input type="hidden" name="section-name" value="<?php echo $section_name ?>">
                    <input type="hidden" name="section-id-name" value="<?php echo $section_id ?>">
                    <?php







                    ////////////////////////////////

                    $query = "SELECT * from subject_tb where class_id='$class_id' and subject_id='$subject_id'";


                    $query_run = mysqli_query($connection, $query);


                    if (mysqli_num_rows($query_run) > 0) {


                        $row = mysqli_fetch_assoc($query_run); {


                            if ($row["subject_id"] != $subject_id) {
                                echo "<h3>No Record Found, either Class, Section or Subject is not in record." . $row['subject_id'] . "-$subject_id"  . "$class_id</h3><br><br><br>";
                            } else {
                                $counter = 0;

                                $query2 = "SELECT * from marks_table where exam_name='$exam_name' and class_id='$class_id' and section_id='$section_id' and subject_id='$subject_id'";
                                $query_run2 = mysqli_query($connection, $query2);

                                if (mysqli_num_rows($query_run2) > 0) {

                                    while ($row2 = mysqli_fetch_assoc($query_run2)) {
                                        $std_id = $row2["student_id"];


                                        $query3 = "SELECT student_name from student_tb where student_id ='$std_id'";
                                        $query_run3 = mysqli_query($connection, $query3);
                                        $row3 = mysqli_fetch_assoc($query_run3);
                                        $std_name = $row3["student_name"];



                    ?>


                                        <tr class="active">

                                            <td> <?php echo $std_id ?>
                                                <input type="hidden" value="<?php echo $std_id ?>" name="student_id[]">
                                            </td>

                                            <td><?php echo $std_name ?>
                                                <input type="hidden" value="<?php echo $std_name ?>" name="student_name[]">
                                            </td>


                                            <td><?php echo $subject_name ?>
                                                <input type="hidden" value="<?php echo $subject_id ?>" name="subject-name">
                                            </td>

                                            <td><?php echo $exam_name ?>
                                                <input type="hidden" value="<?php echo $exam_name ?>" name="exam-name">

                                            </td>

                                            <td>
                                                <input type="text" placeholder="Enter marks" name="marks[<?php echo $counter; ?>]" value="<?php echo $row2["marks"] ?>" required>

                                            </td>


                                        </tr>




                                    <?php
                                        $counter++;
                                    }
                                    $teacher_name = "";

                                    $username = $_SESSION['login_teacher'];
                                    $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
                                    $query_run = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($query_run) == 1) {
                                        $row = mysqli_fetch_assoc($query_run);
                                        $teacher_name = $row["teacher_name"];
                                    }

                                    ?>


                                    <a target="_blank" href="GenerateMarksTeacherPDF.php?class_id=<?php echo $class_id ?> & class_name=<?php echo $class_name ?> & section_id=<?php echo $section_id ?> & section_name=<?php echo $section_name ?> & exam=<?php echo $exam_name ?> & subject_id=<?php echo $subject_id ?> & subject_name=<?php echo $subject_name ?> & teacher_name=<?php echo $teacher_name ?> " class=" btn btn-success">Generate PDF</a>
                                    <br><br>
                                    <?php
                                } else {


                                    $query = "SELECT section_name FROM section WHERE class_id='$class_id'  ";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            # code...


                                            $query = "SELECT student_id, student_name FROM student_tb WHERE class_id='$class_id' AND section_id='$section_id' ";

                                            $query_run = mysqli_query($connection, $query);


                                            if (mysqli_num_rows($query_run) > 0) {
                                                $count = 0;
                                                while ($row = mysqli_fetch_assoc($query_run)) {

                                                    $student_id = $row["student_id"];
                                                    $student_name = $row["student_name"];




                                                    # code...




                                    ?>

                                                    <tr class="active">

                                                        <td> <?php echo $row["student_id"] ?>
                                                            <input type="hidden" value="<?php echo $row["student_id"] ?>" name="student_id[]">
                                                        </td>

                                                        <td><?php echo $row["student_name"] ?>
                                                            <input type="hidden" value="<?php echo $row["student_name"] ?>" name="student_name[]">
                                                        </td>


                                                        <td><?php echo $subject_name ?>
                                                            <input type="hidden" value="<?php echo $subject_id ?>" name="subject-name">
                                                        </td>

                                                        <td><?php echo $exam_name ?>
                                                            <input type="hidden" value="<?php echo $exam_name ?>" name="exam-name">

                                                        </td>

                                                        <td>
                                                            <input type="text" placeholder="Enter marks" name="marks[<?php echo $count; ?>]" required>

                                                        </td>


                                                    </tr>

                <?php
                                                    $count++;
                                                }
                                            } else {
                                                echo "<h3>No  $class_id-$class_name-$section_id-$section_name-$subject_id-$subject_name Record Found, either Class, Section or Subject is not in record</h3><br><br><br>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        echo "No record found class id" . " $class_id" . " $subject_id";
                    }
                }

                ?>





            </tbody>

        </table>
    </form>

<?php
}
?>
