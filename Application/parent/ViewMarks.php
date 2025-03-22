<?php
session_start();
if ($_SESSION["login_parent"] == null) {
    header("location: index.php");
} else {

    include_once('include/parent_navbar.php');


    ?>


    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Mark Attendance</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style15.css" type="text/css">


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


                            <select class="form-control" name="exam-name" style="width: 200px; display: inline;">


                                <option value="" disabled selected>Select Exam</option>
                                <option>First Term</option>
                                <option>Mid Term</option>
                                <option>Final Term</option>


                            </select>





                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-view-marks">View</button>

                        </form>

                        <br><br>


                        <!-- ---------------- -->
                        <table class="table" style="width: 800px">
                            <thead>
                                <tr class="success">
                                    <th>Std ID.</th>
                                    <th>Std Name</th>
                                    <th>Subject Name</th>
                                    <th>Exam Name</th>
                                    <th>Marks</th>

                                </tr>
                            </thead>


                            <tbody>


                                <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");


                                    if (isset($_POST["btn-view-marks"])) {





                                        $username = $_SESSION['login_parent'];
                                        $query = "SELECT * FROM parent_tb WHERE username='$username'";
                                        $query_run = mysqli_query($connection, $query);


                                        if (mysqli_num_rows($query_run) == 1) {

                                            $row = mysqli_fetch_assoc($query_run);

                                            $parent_id = $row["parent_id"];


                                            $query = "SELECT * FROM student_tb WHERE parent_id='$parent_id'";
                                            $query_run = mysqli_query($connection, $query);

                                            $row = mysqli_fetch_assoc($query_run);

                                            $student_id = $row["student_id"];
                                        }



                                        $exam_name = $_POST["exam-name"];



                                        /////////////////////////////////////////////////////////


                                        $query = "SELECT * FROM marks_table WHERE student_id='$student_id' and exam_name='$exam_name'";

                                        $query_run = mysqli_query($connection, $query);


                                        $stdArry = array();

                                        if (mysqli_num_rows($query_run) > 0) {

                                            while ($row = mysqli_fetch_array($query_run)) {

                                                $student_id = $row["student_id"];
                                                
                                                $query1 = "SELECT * from student_tb where student_id=$student_id";
                                                $query_run1 = mysqli_query($connection, $query1);

                                                $student = mysqli_fetch_assoc($query_run1);

                                                $subject_id = $row["subject_id"];
                                                

                                                $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                                $query_run2 = mysqli_query($connection, $query2);

                                                $subject = mysqli_fetch_assoc($query_run2);


                                               

                                                ?>

                                            <tr class="active">
                                                <!-- <h2>Class </h2> -->
                                                <td><?php echo $row["student_id"] ?></td>
                                                <td><?php echo $student["student_name"] ?></td>
                                                <td><?php echo $subject["subject_name"] ?></td>
                                                <td><?php echo $row["exam_name"] ?></td>
                                                <td><?php echo $row["marks"] ?></td>


                                            </tr>

                                <?php


                                            }
                                        } else {
                                            echo "<h3>* No Record Found</h3><br><br><br>";
                                        }
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