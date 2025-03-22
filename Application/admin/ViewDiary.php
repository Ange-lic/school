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
        <title>View Diary</title>
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
                <li class="active"><a data-toggle="tab" href="#table">Diary</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="ViewDiary.php" method="POST">

                            <select name="class-name" class="form-control" style="display:inline-block; width:200px; " required>
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

                            <select name="section-name" class="form-control" style="display:inline-block; width:200px; " required>


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


                            <input type="text" id="datepicker" placeholder="Select Date" class="form-control" name="date-name" style="display:inline-block; width:200px; " required>

                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search-diary">Search</button>

                        </form>

                        <br><br>


                        <!-- ---------------- -->
                        <table class="table" style="width: 800px;">
                            <thead>
                                <tr class="success">

                                    <th>Diary Id.</th>
                                    <th>Diary</th>
                                    <th>Class Name</th>
                                    <th>Section Name</th>
                                    <th>Date</th>
                                    <th>Teacher Name</th>

                                </tr>
                            </thead>


                            <tbody>


                                <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");


                                    if (isset($_POST["btn-search-diary"])) {

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


                                                $query = "SELECT * FROM diary_tb WHERE class_id='$class_id' AND section_id='$section_id' AND date='$date'";

                                                $query_run = mysqli_query($connection, $query);


                                                while ($row = mysqli_fetch_assoc($query_run)) {




                                                    $query1 = "SELECT * from class_tb where class_id='$class_id'";
                                                    $query_run1 = mysqli_query($connection, $query1);

                                                    $row1 = mysqli_fetch_assoc($query_run1);

                                                    $class_name = $row1["class_name"];
                                                    $class_id = $row1["class_id"];

                                                    $query1 = "SELECT * from section where section_id='$section_id'";
                                                    $query_run1 = mysqli_query($connection, $query1);

                                                    $row1 = mysqli_fetch_assoc($query_run1);

                                                    $section_name=$row1["section_name"];
                                                    $teacher_id=$row1["teacher_id"];

                                                    $query1 = "SELECT * from teacher_tb where teacher_id='$teacher_id'";
                                                    $query_run1 = mysqli_query($connection, $query1);

                                                    $row1 = mysqli_fetch_assoc($query_run1);

                                                    $teacher_name=$row1["teacher_name"];


                                                    ?>
                                                <tr class="active">
                                                    <td><?php echo  $row["diary_id"] ?></td>
                                                    <td><?php echo  $row["diary"] ?></td>
                                                    <td><?php echo  $class_name ?></td>
                                                    <td><?php echo  $section_name ?></td>
                                                    <td><?php echo  $row["date"] ?></td>
                                                    <td><?php echo  $teacher_name ?></td>

                                                </tr>
                                <?php
                                                }
                                            }
                                        }
                                    } else {
                                        echo "No record found";
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