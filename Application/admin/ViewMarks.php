<?php
session_start();

if ($_SESSION["login_admin"] == null) {


    header("location:  index.php");
} else {

    include_once('include/admin_navbar.php');


?>


    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Mark Attendance</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style4.css" type="text/css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">


        <style>
            .select-box {
                padding: 8px;
                border-radius: 5px;

            }
        </style>



    </head>





    <body style="overflow-x:hidden">


        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">View Marks</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">


                    <div class="container">
                        <br><br>

                        <form action="ViewMarks.php" method="POST">

                            <select class="form-control" name="class-name" style="width: 200px; display:inline;" class="select-box" required>
                                <option value="" disabled selected>Select class</option>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");
                                $query = "SELECT class_id,class_name FROM class_tb ";

                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) > 0) {

                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        # code...

                                ?>
                                        <option value='<?php echo $row["class_id"] ?>'> <?php echo $row["class_name"] ?> </option>


                                <?php
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>


                            </select>

                            <select class="form-control" name="section-name" style="width: 200px; display:inline-block;" class="select-box" required>


                                <option value="" disabled selected>Select Section</option>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");
                                $query = "SELECT section_id,section_name FROM section";

                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) > 0) {

                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        # code...

                                ?>
                                        <option value='<?php echo $row["section_name"] ?>'> <?php echo $row["section_name"] ?> </option>


                                <?php
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>


                            </select>

                            <select class="form-control" name="exam-name" style="width: 200px; display:inline;" class="select-box" required>


                                <option value="" disabled selected>Select Exam</option>
                                <option>First Term</option>
                                <option>Mid Term</option>
                                <option>Final Term</option>


                            </select>





                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-view-marks">View</button>

                        </form>

                        <br><br>


                        <!-- ---------------- -->

                        <!-- <th>Subject Name</th> -->
                        <!-- <th>Exam Name</th> -->
                        <!-- <th>Marks</th> -->







                        <?php

                        $connection = mysqli_connect("localhost", "root", "", "sms6");


                        if (isset($_POST["btn-view-marks"])) {

                        ?>
                            <table class="table" style="width: 800px">
                                <thead>
                                    <tr class="success">
                                        <th>Std ID.</th>
                                        <th>Std Name</th>

                                        <?php

                                        $class_id = $_POST["class-name"];
                                        $section_name = $_POST["section-name"];
                                        // $subject_id = $_POST["subject-name"];
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


                                        //////////////////////////////////////////////////////////////////////////
                                        //////////*




                                        //////////////////////////////////*********************************************////// */
                                        $subject_id = array();
                                        $query = "SELECT subject_id, subject_name FROM subject_tb WHERE class_id='$class_id'  ";

                                        $query_run = mysqli_query($connection, $query);

                                        if (mysqli_num_rows($query_run) > 0) {

                                            while ($row = mysqli_fetch_assoc($query_run)) {

                                                $subject_id[] = $row["subject_id"];

                                                // print_r($subject_id) ;

                                        ?>
                                                <th><?php echo ucfirst($row["subject_name"]) ?></th>





                                        <?php
                                            }
                                        }

                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    ////////////////////////////////////////////////////////////////////////////////////
                                    /////////////////////////////////////////////////////////

                                    $query = "SELECT section_name FROM section WHERE class_id='$class_id'  ";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            # code...

                                            $query = "SELECT * FROM student_tb WHERE class_id='$class_id' AND section_id='$section_id' ";

                                            $query_run = mysqli_query($connection, $query);

                                            if (mysqli_num_rows($query_run) > 0) {

                                                while ($row = mysqli_fetch_array($query_run)) {
                                                    $student_id = $row["student_id"];
                                                    $student_name=$row["student_name"];

                                    ?>

                                                    <tr class="active">
                                                        <!-- <h2>Class </h2> -->
                                                        <td><?php echo $student_id ?></td>
                                                        <td><a target="_blank" style="text-decoration: underline; text-decoration-color: #E8290B;" href="StudentMarksPDF.php?id=<?php echo $student_id ?> & name=<?php echo $student_name ?> & class_id=<?php echo $class_id ?> & class_name=<?php echo $class_name ?> & section_id=<?php echo $section_id ?> & section_name=<?php echo $section_name ?> & exam=<?php echo $exam_name ?>"> <?php echo ucfirst($row["student_name"]) ?></a></td>

                                        <?php
                                                    foreach ($subject_id as $id) {


                                                        $query_m = "SELECT * FROM marks_table WHERE class_id='$class_id' and section_id='$section_id' and exam_name='$exam_name' and student_id='$student_id' and subject_id='$id' ";

                                                        $query_run_m = mysqli_query($connection, $query_m);

                                                        if (mysqli_num_rows($query_run_m) > 0) {

                                                            $row_m = mysqli_fetch_array($query_run_m); {

                                                                $marks = $row_m["marks"];
                                                                echo "<td>$marks</td>";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                        ?>


                                        <a target="_blank" href="GenerateMarksPDF.php?class_id=<?php echo $class_id ?> & class_name=<?php echo $class_name ?> & section_id=<?php echo $section_id ?> & section_name=<?php echo $section_name ?> & exam=<?php echo $exam_name ?>" class=" btn btn-success">Generate PDF</a>
                                        <br><br>
                                    <?php
                                } else {
                                    echo "<h3>* No Record Found</h3><br><br><br>";
                                }

                                    ?>




                                </tbody>



                            </table>

                    </div>

                </div>

            </div>

        </div>


        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!--  Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });

            })
        </script>



    </body>


    </html>

<?php
}
?>