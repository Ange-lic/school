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
        <title>Mark Attendance</title>
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
                <li class="active"><a data-toggle="tab" href="#table">Attendance</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="submitAttendance.php" method="POST">

                            <?php
                                $username = $_SESSION['login_teacher'];
                                $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
                                $query_run = mysqli_query($connection, $query);
                                if (mysqli_num_rows($query_run) == 1) {
                                    $row = mysqli_fetch_assoc($query_run);
                                    $teacher_id = $row["teacher_id"];
                                } else { }

                                ?>

                            <select class="form-control" name="class-name" style="width: 200px; display:inline;" required>
                                <option value="" disabled selected>Select class</option>

                                <?php


                                    $query = "SELECT * FROM section WHERE teacher_id='$teacher_id'"; /////put the id of teacher 

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
                                        <option value="<?php echo  $class_id ?>"> <?php echo $class_name ?> </option>


                                <?php
                                        }
                                    } else {
                                        echo "<option> No record found</option>";
                                    }
                                    ?>


                            </select>

                            <select class="form-control" name="section-name" style="width: 200px; display:inline;" required>


                                <option value="" disabled selected>Select Section</option>

                                <?php




                                    $query = "SELECT * FROM section WHERE teacher_id='$teacher_id'";
                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {



                                            ?>
                                        <option value='<?php echo $row["section_name"] ?>'> <?php echo $row["section_name"] ?> </option>


                                <?php

                                        }
                                    } else {
                                        echo "No record found";
                                    }



                                    ?>


                            </select>


                            <input type="text" id="datepicker" class="form-control" style="display:inline-block; width:200px; " placeholder="Select Date" name="date-name" required>

                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search-student">Search</button>

                            <br><br><br><br>


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