
<?php
session_start();
if($_SESSION["login_parent"]==null){
    header("location: index.php");
  }
  else{
  
      include_once('include/parent_navbar.php');
  
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <title>View News</title>
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
            <li class="active"><a data-toggle="tab" href="#table">View News</a></li>

        </ul>

        <div class="tab-content">

            <div id="table" class="tab-pane fade in active">

                <header>

                </header>

                <div class="container">
                    <br><br>





                    <!-- ---------------- -->
                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>Name</th>
                                <th>Class</th>
                                <th>Exam</th>
                                <th>Subject</th>
                                <th>Remarks</th>

                            </tr>
                        </thead>


                        <tbody>


                            <?php

                            $connection = mysqli_connect("localhost", "root", "", "sms6");


                            $dontShow = ["class_id", "section_id", "parent_id", "password", 'student_id'];

                            $username = $_SESSION['login_parent'];
                             $query2 = "SELECT * FROM parent_tb WHERE username='$username'";
                            $query_run = mysqli_query($connection, $query2);
                                    if (mysqli_num_rows($query_run) == 1) {
                                        $row = mysqli_fetch_assoc($query_run);
                                        $parent_name = $row["name"];
                                                                            }
                                    $query1 = "SELECT * FROM student_tb WHERE parent_name='$parent_name'";
                                    $query_run1 = mysqli_query($connection, $query1);

                                    $row1 = mysqli_fetch_assoc($query_run1);

                                    $student_id = $row1["student_id"];
								   
									$query = "select remarking.student_id, student_name, student_tb.class_id, exam, subject_name, marks, remarking.remarks from student_tb join remarking on student_tb.student_id = remarking.student_id join subject_tb on subject_tb.subject_id = remarking.subject where remarking.student_id = '$student_id';";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($result)){
                                    $marks = $row['marks']; $remarks ='';
                                    echo "<tr><td>{$row['student_name']}</td><td>{$row['class_id']}</td><td>{$row['exam']}</td><td>{$row['subject_name']}</td><td>{$row['remarks']}</td></tr>";
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





</body>


</html>

<?php
  }
?>
