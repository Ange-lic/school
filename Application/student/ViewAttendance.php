<?php
session_start();
if ($_SESSION["login_std"] == null) {
    header("location: index.php");
} else {

    include_once('include/student_navbar.php');


    ?>


    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Mark Attendance</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style14.css" type="text/css">


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
                <li class="active"><a data-toggle="tab" href="#table">Attendance</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>



                        <br><br>


                        <!-- ---------------- -->
                        <table class="table" style="width: 800px;">
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


                                    $username = $_SESSION['login_std'];
                                    $query = "SELECT student_id,student_name FROM student_tb WHERE username='$username'";
                                    $query_run = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($query_run) == 1) {
                                        $row = mysqli_fetch_assoc($query_run);
                                        $student_id = $row["student_id"];
                                        $student_name = $row["student_name"];
                                    }


                                    $query = "SELECT * FROM attendance_tb WHERE student_id='$student_id'";

                                    $query_run = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row["student_id"];

                                        $query1 = "SELECT * from student_tb where student_id=$student_id";
                                        $query_run1 = mysqli_query($connection, $query1);

                                        $student = mysqli_fetch_assoc($query_run1);

                                        ?>
                                    <tr class="active">
                                        <td><?php echo  $row["student_id"] ?></td>
                                        <td><?php echo  $student["student_name"] ?></td>
                                        <td><?php echo  $row["date"] ?></td>
                                        <td><?php echo  $row["status"] ?></td>

                                    </tr>
                                    <?php
                                        }




                                        if (isset($_POST["btn-search-student"])) {

                                            $date = $_POST["date-name"];


                                            $query = "SELECT student_id,student_name,date,status FROM attendance_tb WHERE student_id='$student_id' and date='$date'";

                                            $query_run = mysqli_query($connection, $query);

                                            if (mysqli_num_rows($query_run) == 1) {

                                                while ($row = mysqli_fetch_assoc($query_run)) {
                                                    ?>
                                            <tr class="active">
                                                <td><?php echo  $row["student_id"] ?></td>
                                                <td><?php echo  $row["student_name"] ?></td>
                                                <td><?php echo  $row["date"] ?></td>
                                                <td><?php echo  $row["status"] ?></td>

                                            </tr>
                                <?php
                                            }
                                        } else {
                                            echo "<h1> No record found<h1>";
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