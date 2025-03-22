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
        <title>Schedule</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style15.css" type="text/css">
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

            </ul>



            <div class="tab-content">


                <br><br>

                <table id="editable_table" class="table table-bordered table-striped" style="width: 800px;">

                    <?php

                        $connection = mysqli_connect("localhost", "root", "", "sms6");


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

                            $class_id = $row["class_id"];
                            $section_id = $row["section_id"];
                        }

                        ?>

                    <tr>
                        <th>Monday</th>
                        <?php


                            $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Monday'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subject_id = $row["subject_id"];


                                    $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                    $query_run2 = mysqli_query($connection, $query2);

                                    $subject = mysqli_fetch_assoc($query_run2);


                                    echo '<td> ' . $subject["subject_name"] . '<br>' . $row["slot"] .

                                        '</td>';
                                }
                            }


                            ?>
                    </tr>

                    <tr>
                        <th>Tuesday</th>
                        <?php


                            $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Tuesday'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subject_id = $row["subject_id"];


                                    $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                    $query_run2 = mysqli_query($connection, $query2);

                                    $subject = mysqli_fetch_assoc($query_run2);


                                    echo '<td> ' . $subject["subject_name"] . '<br>' . $row["slot"] .

                                        '</td>';
                                }
                            }


                            ?>
                    </tr>

                    <tr>
                        <th>Wednesday</th>
                        <?php


                            $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Wednesday'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subject_id = $row["subject_id"];


                                    $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                    $query_run2 = mysqli_query($connection, $query2);

                                    $subject = mysqli_fetch_assoc($query_run2);


                                    echo '<td> ' . $subject["subject_name"] . '<br>' . $row["slot"] .

                                        '</td>';
                                }
                            }


                            ?>

                    </tr>

                    <tr>
                        <th>Thursday</th>
                        <?php


                            $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Thursday'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subject_id = $row["subject_id"];


                                    $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                    $query_run2 = mysqli_query($connection, $query2);

                                    $subject = mysqli_fetch_assoc($query_run2);


                                    echo '<td> ' . $subject["subject_name"] . '<br>' . $row["slot"] .

                                        '</td>';
                                }
                            }


                            ?>

                    </tr>

                    <tr>
                        <th>Friday</th>

                        <?php


                            $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Friday'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subject_id = $row["subject_id"];


                                    $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                    $query_run2 = mysqli_query($connection, $query2);

                                    $subject = mysqli_fetch_assoc($query_run2);


                                    echo '<td> ' . $subject["subject_name"] . '<br>' . $row["slot"] .

                                        '</td>';
                                }
                            }


                            ?>

                    </tr>

                    <tr>
                        <th>Saturday</th>

                        <?php


                            $query = "SELECT * from schedule_tb where class_id='$class_id' and section_id='$section_id' and day='Saturday'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subject_id = $row["subject_id"];


                                    $query2 = "SELECT * from subject_tb where subject_id=$subject_id";
                                    $query_run2 = mysqli_query($connection, $query2);

                                    $subject = mysqli_fetch_assoc($query_run2);


                                    echo '<td> ' . $subject["subject_name"] . '<br>' . $row["slot"] .

                                        '</td>';
                                }
                            }


                            ?>

                    </tr>



                </table>


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