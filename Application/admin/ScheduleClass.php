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
        <title>Schedule</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style4.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


        <style>
            .select-box {
                padding: 8px;
                border-radius: 5px;

            }
        </style>
    </head>

    <body style="overflow-x:hidden" onload="minutes()">

        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">Schedule</a></li>

                <li><a data-toggle="tab" href="#new">Add New</a></li>

            </ul>



            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">



                    <div class="container">
                        <br><br>



                        <?php

                        $connection = mysqli_connect("localhost", "root", "", "sms6");
                        $query = "SELECT * FROM admin_tb";
                        $query_run = mysqli_query($connection, $query);

                        ?>

                        <form action="" method="post">

                            <select name="class-name" style="display: inline-block; width: 190px;" class="form-control" required>
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

                            <select name="section-name" style="display: inline; width: 190px;" class="form-control" required>


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

                            <button type="submit" style="margin-left: 25px;" class="btn btn-info" name="btn-search-schedule">Search</button>



                        </form>

                        <br><br>

                        <table id="editable_table" class="table table-bordered table-striped" style="width: 800px;">

                            <tr>
                                <th>Monday</th>
                                <?php

                                if (isset($_POST["btn-search-schedule"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];

                                    ///fetch the correspondind section id

                                    $s_id = 0;
                                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    $result = mysqli_fetch_assoc($query_run);

                                    $section_id = $result["$s_id"];



                                    $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Monday'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $subject_id = $row["subject_id"];


                                            $query1 = "SELECT * from subject_tb where subject_id='$subject_id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $subject_name = $row1["subject_name"];


                                            echo '<td> ' . $subject_name . '<br>' . $row["slot"] .

                                                '</td>';
                                        }
                                    }
                                }

                                ?>
                            </tr>

                            <tr>
                                <th>Tuesday</th>
                                <?php

                                if (isset($_POST["btn-search-schedule"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];

                                    ///fetch the correspondind section id

                                    $s_id = 0;
                                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    $result = mysqli_fetch_assoc($query_run);

                                    $section_id = $result["$s_id"];



                                    $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Tuesday'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $subject_id = $row["subject_id"];


                                            $query1 = "SELECT * from subject_tb where subject_id='$subject_id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $subject_name = $row1["subject_name"];


                                            echo '<td> ' . $subject_name . '<br>' . $row["slot"] .

                                                '</td>';
                                        }
                                    }
                                }

                                ?>
                            </tr>

                            <tr>
                                <th>Wednesday</th>
                                <?php

                                if (isset($_POST["btn-search-schedule"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];

                                    ///fetch the correspondind section id

                                    $s_id = 0;
                                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    $result = mysqli_fetch_assoc($query_run);

                                    $section_id = $result["$s_id"];



                                    $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Wednesday'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $subject_id = $row["subject_id"];


                                            $query1 = "SELECT * from subject_tb where subject_id='$subject_id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $subject_name = $row1["subject_name"];


                                            echo '<td> ' . $subject_name . '<br>' . $row["slot"] .

                                                '</td>';
                                        }
                                    }
                                }

                                ?>

                            </tr>

                            <tr>
                                <th>Thursday</th>
                                <?php

                                if (isset($_POST["btn-search-schedule"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];

                                    ///fetch the correspondind section id

                                    $s_id = 0;
                                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    $result = mysqli_fetch_assoc($query_run);

                                    $section_id = $result["$s_id"];



                                    $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Thursday'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $subject_id = $row["subject_id"];


                                            $query1 = "SELECT * from subject_tb where subject_id='$subject_id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $subject_name = $row1["subject_name"];


                                            echo '<td> ' . $subject_name . '<br>' . $row["slot"] .

                                                '</td>';
                                        }
                                    }
                                }

                                ?>

                            </tr>

                            <tr>
                                <th>Friday</th>
                                <?php

                                if (isset($_POST["btn-search-schedule"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];

                                    ///fetch the correspondind section id

                                    $s_id = 0;
                                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    $result = mysqli_fetch_assoc($query_run);

                                    $section_id = $result["$s_id"];



                                    $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Friday'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $subject_id = $row["subject_id"];


                                            $query1 = "SELECT * from subject_tb where subject_id='$subject_id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $subject_name = $row1["subject_name"];


                                            echo '<td> ' . $subject_name . '<br>' . $row["slot"] .

                                                '</td>';
                                        }
                                    }
                                }

                                ?>
                            </tr>

                            <tr>
                                <th>Saturday</th>
                                <?php

                                if (isset($_POST["btn-search-schedule"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];

                                    ///fetch the correspondind section id

                                    $s_id = 0;
                                    $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    $result = mysqli_fetch_assoc($query_run);

                                    $section_id = $result["$s_id"];



                                    $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Saturday'";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $subject_id = $row["subject_id"];


                                            $query1 = "SELECT * from subject_tb where subject_id='$subject_id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $subject_name = $row1["subject_name"];


                                            echo '<td> ' . $subject_name . '<br>' . $row["slot"] .

                                                '</td>';
                                        }
                                    }
                                }

                                ?>
                            </tr>



                        </table>

                    </div>

                </div>

                <div id="new" class="tab-pane fade">

                    <form action="AddSchedule.php" method="POST">

                        <div class="textfield " style="margin: 5% 15% 0% 15% ">



                            </br>

                            <select name="class-name" style="width: 40%; margin-left: 45px; display: inline-block;" class="form-control" required>
                                <option value="" disabled selected>Select Class</option>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");
                                $query = "SELECT * FROM class_tb";

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

                            <select name="section-name" style="width: 40%; margin-left: 45px; display: inline-block;" class="form-control" required>
                                <option value="" disabled selected>Select Section</option>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");
                                $query = "SELECT * FROM section";

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

                            <br><br>

                            <button type="submit" style="margin-left: 45px;" class="btn btn-info" name="btn-search-sch">Search</button>

                    </form>

            </br><br><br>


            </div>
        </div>
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
                //alert("SD");

            });

            minutes = function() {
                let end = 60;

                let select = document.getElementById("start-min-id");
                let select2 = document.getElementById("end-min-id");


                for (let i = 0; i <= end; i++) {
                    let option = document.createElement("option");
                    let option2 = document.createElement("option");

                    option.innerHTML = i;
                    option2.innerHTML = i;

                    if (i < 10) {
                        option.innerHTML = "0" + i;
                        option2.innerHTML = "0" + i;

                    }

                    select.appendChild(option);
                    select2.appendChild(option2);

                }
            }

            function deleteUser(deleteid) {
                // alert("Asd");
                var conf = confirm("Are you sure?");

                if (conf = true) {
                    $.ajax({
                        url: "code.php",
                        type: "post",
                        data: {
                            deleteid: deleteid
                        },
                        success: function(data, status) {
                            readRecords();
                        }
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);

                }
            }

            function getUserDetails(id) {


                var num = 0;
                $('#hidden_id').val(id);

                console.log($('#hidden_id').val());

                $.post("code.php", {
                        id: id
                    }, function(data, status) {

                        var user = JSON.parse(data);

                        $('#name_ad').val(user.admin_name);
                        $('#em').val(user.admin_email);
                        $('#ph').val(user.admin_phone);
                        $('#usrname').val(user.username);
                        $('#pwd').val(user.password);

                    }

                );

                $('#update-user-modal').modal("show");

                // alert("SD");


            }

            function updateUserDetail() {
                var name = $('#name_ad').val();
                var email = $('#em').val();
                var phone = $('#ph').val();
                var username = $('#usrname').val();
                var password = $('#pwd').val();

                var hidden_id = $('#hidden_id').val();

                var num = 0;
                $.post(
                    "code.php", {
                        hidden_id: hidden_id,
                        name: name,
                        email: email,
                        phone: phone,
                        username: username,
                        password: password,
                    },

                    function(data, status) {
                        $('#update-user-modal').modal("hide");

                        readRecords();

                    }


                );

                setTimeout(() => {
                    window.location.reload();
                }, 500);

            }
        </script>

    </body>

    </html>

<?php
}
?>