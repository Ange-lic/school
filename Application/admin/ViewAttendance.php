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
        <title>View Attendance</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style4.css" type="text/css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

        <script>
            function setYear() {
                var d = new Date();
                var year = d.getFullYear();
                let elem = document.getElementById("yearId");
                for (let i = year; i >= 2005; i--) {

                    let option = document.createElement("option");
                    var textnode = document.createTextNode(year);
                    option.appendChild(textnode);
                    elem.appendChild(option);
                    year--;
                }
            }
        </script>




    </head>




    <body style="overflow-x:hidden" onload="setYear()">


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

                        <form action="ViewAttendance.php" method="POST">

                            <select name="class-name" style="width: 200px; display:inline;" class="form-control" id="select-class-id" required>
                                <option value="" disabled selected>Select class</option>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");
                                $query = "SELECT class_name FROM class_tb ";

                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) > 0) {

                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        # code...

                                ?>
                                        <option value='<?php echo $row["class_name"] ?>'> <?php echo $row["class_name"] ?> </option>


                                <?php
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>


                            </select>

                            <select name="section-name" style="width: 200px; display:inline;" class="form-control" required>


                                <option value="" disabled selected>Select Section</option>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");



                                $query = "SELECT section_name FROM section  ";

                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) > 0) {

                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        # code...
                                        if ($name != $row["section_name"]) {
                                            $name = $row["section_name"];

                                ?>
                                            <option value='<?php echo $row["section_name"] ?>'> <?php echo $row["section_name"] ?> </option>


                                <?php
                                        }
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>


                            </select>

                            <select id="yearId" name="year-name" style="width: 200px; display:inline-block;" class="form-control" required>
                                <option disabled selected>Select Year</option>

                            </select>

                            <select name="month-name" style="width: 200px; display:inline-block;" class="form-control" required>
                                <option disabled selected>Select Month</option>
                                <option value="01">January</option>
                                <option value="02">Fenraury</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>


                            <!-- <input type="text" id="datepicker" placeholder="Select Date" name="date-name" style="width: 200px; display:inline;" class="form-control" required> -->

                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search-student">Search</button>

                        </form>



                        <br><br>


                        <!-- ---------------- -->
                        <table class="table" style="width: 800px;">
                            <thead>
                                <tr class="success">
                                    <th>Std ID.</th>
                                    <th>Std Name</th>

                                    <!-- <th>Date</th> -->
                                    <!-- <th>Status</th> -->

                                    <!-- </tr> -->
                                    <!-- <span>Status</span> -->
                                    <!-- </thead> -->


                                    <!-- <tbody> -->


                                    <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");


                                    if (isset($_POST["btn-search-student"])) {

                                        $class_name = $_POST["class-name"];
                                        $section_name = $_POST["section-name"];
                                        $year = $_POST["year-name"];
                                        $month = $_POST["month-name"];

                                        $date = "$year-$month";

                                        ///fetch the correspondind class id

                                        $c_id = 0;
                                        $query = " SELECT class_id as '$c_id' FROM class_tb WHERE class_name='$class_name' ";
                                        $query_run = mysqli_query($connection, $query);
                                        $result = mysqli_fetch_assoc($query_run);

                                        $class_id = $result["$c_id"];


                                        ///fetch the correspondind section id

                                        $s_id = 0;
                                        $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                        $query_run = mysqli_query($connection, $query);
                                        $result = mysqli_fetch_assoc($query_run);

                                        $section_id = $result["$s_id"];

                                        ////////////////////////////////





                                        /////////////////////////////////////////

                                        $query = "SELECT section_name FROM section WHERE class_id='$class_id'  ";

                                        $query_run = mysqli_query($connection, $query);

                                        if (mysqli_num_rows($query_run) > 0) {

                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                # code...

                                                $query = "SELECT * FROM student_tb WHERE class_id='$class_id' AND section_id='$section_id' ";

                                                $query_run = mysqli_query($connection, $query);


                                                $stdArry = array();

                                                while ($row = mysqli_fetch_assoc($query_run)) {
                                                    # code...

                                                    $stdArry[] = $row;
                                                }


                                                $query22 = "SELECT * FROM attendance_tb WHERE date LIKE '$date%'";
                                                $query_run22 = mysqli_query($connection, $query22);

                                                $next = "";

                                                while ($row22 = mysqli_fetch_assoc($query_run22)) {


                                                    $date1 = $row22["date"];
                                                    if ($next != $date1) {

                                                        echo "<th> $date1 </th>";
                                                        $next = $date1;
                                                    }
                                                }

                                    ?>
                                </tr>

                                <?php

                                                foreach ($stdArry as $id) {

                                                    $student_id = "$id[student_id]";
                                                    $student_name = "$id[student_name]";
                                ?>
                                    <tr class="active">
                                        <td><?php echo  $student_id ?></td>
                                        <td><?php echo  ucfirst($student_name) ?></td>

                                        <?php

                                                    $query22 = "SELECT * FROM attendance_tb WHERE student_id='$student_id' AND date LIKE '$date%'";
                                                    $query_run22 = mysqli_query($connection, $query22);


                                                    while ($row22 = mysqli_fetch_assoc($query_run22)) {


                                                        $status = $row22["status"];

                                                        echo "<td> $status  </td>";
                                                    }

                                                    echo "</tr>";

                                        ?>


                                <?php
                                                }
                                            }
                                ?>
                                <a target="_blank" href="GenerateAttendencePDF.php?class=<?php echo $class_id ?> & section=<?php echo $section_id ?> & year=<?php echo $year ?> & month=<?php echo $month ?>"" class=" btn btn-success">Generate PDF</a>
                                <br><br>
                            <?php
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


    </body>


    </html>



    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!--  Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            })

        });



        $(document).ready(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });


        })
    </script>



<?php
                                    }
                                }
?>