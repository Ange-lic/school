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
    <title>Fees Collection</title>
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
            <li class="active"><a data-toggle="tab" href="#table">Make Payment</a></li>

        </ul>

        <div class="tab-content">

            <div id="table" class="tab-pane fade in active">

                <header>

                </header>

                <div class="container">
                    <br><br>

                    <form action="" method="POST">

                        <select name="class-name" class="form-control" style="width: 200px; display: inline;" class="select-box" id="select-class-id" required>
                            <option value="" disabled selected>Select class</option>

                            <?php

                            $connection = mysqli_connect("localhost", "root", "", "sms6");
                            $query = "SELECT * FROM class_tb ";

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

                        <select name="section-name" class="form-control" style="width: 200px; display: inline;" class="select-box" required>


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


                        <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search-payment">Search</button>

                    </form>

                    <br><br>


                    <?php

                    if (isset($_POST["btn-search-payment"])) {

                        $class_id = $_POST["class-name"];
                        $section_name = $_POST["section-name"];


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


                        ?>

                        <form action="code.php" method="POST">

                            <div class="textfield " style="margin: 5% 15% 0% 15% ">





                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="" type="text" class="form-control" name="class-name" placeholder="Class Name" value=<?php echo "$class_name" ?> readonly>
                                    <input type="hidden" name="class-id-name" value=<?php echo "$class_id" ?>>
                                </div>

                                <br>

                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="" type="text" class="form-control" name="section-name" placeholder="Section Name" value=<?php echo "$section_name" ?> readonly>
                                    <input type="hidden" name="section-id-name" value=<?php echo "$section_id" ?>>
                                </div>

                                <br>

                                <select name="students-name[]" class="form-control" multiple style="width: 800px;" class="select-box" id="select-student-id" required>

                                    <option value="" disabled selected>Select Student(s)</option>

                                    <?php

                                        $connection = mysqli_connect("localhost", "root", "", "sms6");
                                        $query = "SELECT * FROM student_tb where class_id='$class_id' and section_id='$section_id'  ";

                                        $query_run = mysqli_query($connection, $query);

                                        if (mysqli_num_rows($query_run) > 0) {

                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                # code...

                                                ?>
                                            <option value='<?php echo $row["student_id"] ?>'> <?php echo $row["student_name"] ?> </option>


                                    <?php
                                            }
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>


                                </select>

                                <br>
                                <br>


                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="" type="text" class="form-control" name="title-name" placeholder="Title" required>
                                </div>

                                <br>


                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="desc-name" placeholder="Description" required>
                                </div>

                                </br>



                            

                                <div class="input-group col-md-12">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="" type="number" class="form-control" name="payment-name" placeholder="Payment" required>
                                </div>

                                </br>


                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <!-- <input id="" type="text" class="form-control" name="status-name" placeholder="Status"> -->

                                    <select class="form-control" name="status-name" required>
                                        <option disabled selected>Status</option>
                                        <option>Paid</option>
                                        <option>UnPaid</option>

                                    </select>
                                </div>

                                <br>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                                    <select class="form-control" name="month-name" required>
                                        <option disabled selected>Month</option>
                                        <option>January</option>
                                        <option>Febraury</option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May</option>
                                        <option>June</option>
                                        <option>July</option>
                                        <option>August</option>
                                        <option>September</option>
                                        <option>October</option>
                                        <option>November</option>
                                        <option>December</option>

                                    </select>
                                </div>


                                <br>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                                    <input type="text" id="datepicker" placeholder="Select Date" name="date-name" class="form-control" required>

                                </div>
                                </br><br>
                            


                                <button type="submit" class="btn btn-info" name="btn-submit-payment">Submit</button>


                            </div>



                        </form>

                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>






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
            });
        });


        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });





        function deleteUser(delete_std_id, p_id) {
            // alert("Asd");

            console.log(delete_std_id);
            console.log(p_id);
            var conf = confirm("Are you sure?");

            if (conf == true) {

                $.post(
                    "code.php", {

                        delete_std_id: delete_std_id,
                        p_id: p_id,

                    },

                    function(data, status) {

                    }

                );



            } else {
                console.log("else false");
            }
            setTimeout(() => {
                window.location.reload();
            }, 500);

        }

        function getUserDetails(s_id, c_id, sec_id, p_id) {

            console.log(s_id);
            console.log(c_id);
            console.log(sec_id);
            console.log(p_id);
            // //var num = 0;

            $('#hidden_id').val(s_id);
            $('#class_id-id').val(c_id);
            $('#section_id-id').val(sec_id);
            $('#parent_id-id').val(p_id);


            $.post("code.php", {
                    s_id: s_id
                }, function(data, status) {

                    var user = JSON.parse(data);

                    $('#name-id').val(user.student_name);
                    $('#gender-id').val(user.gender);
                    $('#rel-id').val(user.religion);
                    $('#class-id').val(user.class_name);
                    $('#sec-id').val(user.section_name);
                    $('#parent-id').val(user.parent_name);
                    $('#phone-id').val(user.parent_phone);
                    $('#email-id').val(user.parent_email);
                    $('#username-id').val(user.username);
                    $('#pwd-id').val(user.password);

                }

            );

            $('#update-student-modal').modal("show");

            // alert("SD");


        }

        function updateUserDetail() {
            var name = $('#name-id').val();
            var gender = $('#gender-id').val();
            var rel = $('#rel-id').val();
            var clas = $('#class-id').val();
            var sec = $('#sec-id').val();
            var parent = $('#parent-id').val();
            var phone = $('#phone-id').val();
            var email = $('#email-id').val();
            var username = $('#username-id').val();
            var password = $('#pwd-id').val();

            var hidden_id = $('#hidden_id').val();
            var class_id = $('#class_id-id').val();
            var section_id = $('#section_id-id').val();
            var parent_id = $('#parent_id-id').val();


            $.post(
                "code.php", {
                    hidden_id: hidden_id,
                    name: name,
                    gender: gender,
                    rel: rel,
                    class_id: class_id,
                    class: clas,
                    section_id: section_id,
                    sec: sec,
                    parent_id: parent_id,
                    parent: parent,
                    phone: phone,
                    email: email,
                    username: username,
                    password: password,
                },

                function(data, status) {
                    $('#update-user-modal').modal("hide");



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
