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
        <title>Student</title>
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




            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">




                    <!-- ---------------- -->
                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>Std ID.</th>
                                <th>Std Name</th>
                                <th>Username</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Category</th>

                            </tr>
                        </thead>


                        <tbody>


                            <?php

                            $connection = mysqli_connect("localhost", "root", "", "sms6");
                             $username = $_SESSION['login_std'];
                             $query = "SELECT * FROM student_tb JOIN remarking ON student_tb.student_id=remarking.student_id WHERE username='$username'";
                             $section = array("0"=>"A", "1"=>"B", "2"=>"C", "3"=>"D", "4"=>"E", "5"=>"F", "6"=>"G");
                             $query_run = mysqli_query($connection, $query);
                             while ($row = mysqli_fetch_assoc($query_run)) {




                                 ?>
                             <tr class="active">
                                 <td><?php echo  $row['student_id'] ?></td>
                                 <td><?php echo  $row['student_name'] ?></td>
                                 <td><?php echo  $row['username'] ?></td>
                                 <td><?php echo  $row['class_id'] ?></td>
                                 <td><?php echo  $section[$row['section_id']] ?></td>
                                 <td><?php echo  $row['remarks'] ?></td>


        

                                </tr>
                            <?php
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