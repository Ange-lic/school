<?php
session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('include/teacher_navbar.php');

    $connection = mysqli_connect("localhost", "root", "", "sms6");


    ?>


    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Give Mark</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style4.css" type="text/css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">



    </head>





    <body style="overflow-x:hidden">


        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">Give Marks</a></li>

            </ul>

            <div class="tab-content">
            <table class="table" style="width: 800px;">
                            <thead>
                                <tr class="success">
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Exam Name</th>
                                    <th>Subject</th>
                                    <th>Remarks</th>

                                </tr>
                            </thead>


                            <tbody>
                            

                            <?php  
                                $query = "select student_name, student_tb.class_id, exam, subject_name, marks, remarking.remarks from student_tb join remarking on student_tb.student_id = remarking.student_id join subject_tb on subject_tb.subject_id = remarking.subject;";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($result)){
                                    $marks = $row['marks']; $remarks ='';
                                    echo "<tr><td>{$row['student_name']}</td><td>{$row['class_id']}</td><td>{$row['exam']}</td><td>{$row['subject_name']}</td><td>{$row['remarks']}</td></tr>";
                                    }
                            ?>
                            </tbody>

                        </table>

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="submitMarks.php" method="POST">
                            <?php
                                $username = $_SESSION['login_teacher'];
                                $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
                                $query_run = mysqli_query($connection, $query);
                                if (mysqli_num_rows($query_run) == 1) {
                                    $row = mysqli_fetch_assoc($query_run);
                                    $teacher_id = $row["teacher_id"];
                                }

                                ?>

                            <select name="class-name" class="form-control" style="display:inline-block; width:200px; " required>
                                <option value="" disabled selected>Select class</option>

                                <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");
                                    $query = "SELECT DISTINCT(class_id) FROM subject_tb WHERE teacher_id='$teacher_id'"; /////put the id of teacher 
                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            # code...
                                            $id = $row["class_id"];

                                            $query1 = "SELECT * from class_tb where class_id='$id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $class_name = $row1["class_name"];
                                            $class_id = $row1["class_id"];

                                            ?>
                                        <option value='<?php echo $class_id ?>'> <?php echo $class_name ?> </option>


                                <?php
                                        }
                                    } else {
                                        echo "No record found";
                                    }
                                    ?>


                            </select>

                            <select name="section-name" class="form-control" style="display:inline-block; width:200px; " required>


                                <option value="" disabled selected>Select Section</option>

                                <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");


                                    $query = "SELECT class_id FROM subject_tb WHERE teacher_id='$teacher_id'";
                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $query = "SELECT section_id,section_name FROM section WHERE class_id='$row[class_id]' ";

                                            $query_run = mysqli_query($connection, $query);

                                            if (mysqli_num_rows($query_run) > 0) {

                                                while ($row = mysqli_fetch_assoc($query_run)) {
                                                    # code...

                                                    ?>
                                                <option value='<?php echo $row["section_name"] ?>'> <?php echo $row["section_name"] ?> </option>


                                <?php

                                                }
                                            }
                                        }
                                    } else {
                                        echo "No record found";
                                    }



                                    ?>


                            </select>



                            <select name="subject-name" class="form-control" style="display:inline-block; width:200px;" required>


                                <option value="" disabled selected>Select Subject</option>

                                <?php





                                    $query = "SELECT subject_id,subject_name FROM subject_tb WHERE teacher_id='$teacher_id'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            # code...

                                            ?>
                                        <option value='<?php echo $row["subject_id"] ?>'> <?php echo $row["subject_name"] ?> </option>


                                <?php
                                        }
                                    } else {
                                        echo "No record found";
                                    }
                                    ?>


                            </select>

                            <select name="exam-name" class="form-control" style="display:inline-block; width:200px; " required>
                                <option value="" disabled selected>Select Exam</option>
                                <option>First Term</option>
                                <option>Mid Term</option>
                                <option>Final Term</option>
                            </select>



                            <!-- <input type="text" id="datepicker" placeholder="Select Date" name="date-name"> -->

                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search-student-att">Search</button>





                        </form>

                        <br><br>




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
