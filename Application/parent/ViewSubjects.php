<?php

session_start();

if ($_SESSION['login_parent'] == null) {
    header("location: index.php");
} else {

    include_once('include/parent_navbar.php');

    ?>


    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Student</title>
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




            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">




                    <!-- ---------------- -->
                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>Subject Name</th>


                            </tr>
                        </thead>


                        <tbody>


                            <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");


                                $username = $_SESSION['login_parent'];
                                $query = "SELECT * FROM parent_tb WHERE username='$username'";
                                $query_run = mysqli_query($connection, $query);




                                if (mysqli_num_rows($query_run) == 1) {

                                    $row = mysqli_fetch_assoc($query_run);

                                    $parent_id = $row["parent_id"];


                                    $query1 = "SELECT * FROM student_tb WHERE parent_id='$parent_id'";
                                    $query_run1 = mysqli_query($connection, $query1);

                                    $row1 = mysqli_fetch_assoc($query_run1);

                                    $class_id = $row1["class_id"];
                                    // $class_name = $row1["class_name"];


                                    $query = "SELECT subject_id,subject_name FROM subject_tb WHERE class_id='$class_id'";
                                    $query_run = mysqli_query($connection, $query);


                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>


                                    <tr class="active">
                                        <td><?php echo  $row["subject_name"] ?></td>
                                    </tr>
                            <?php
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