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
        <title>Add Student</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body style="overflow-x:hidden">

        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">Students List</a></li>

                <li><a data-toggle="tab" href="#new">Add Students</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="AddStudent.php" method="POST">

                            <select name="class-name" style="width: 200px; display:inline; margin-right: 10px;" class="form-control" required>
                                <option value="" disabled selected>Select class</option>

                                <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");
                                    $query = "SELECT * FROM class_tb";

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

                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search">Search</button>

                        </form>

                        <br><br>






                        <table class="table" style="width: 90%;">
                            <thead>
                                <tr class="success" style="width: 800px;">
                                    <th>Std. ID.</th>
                                    <th>Std Name</th>
                                    <th>Gender</th>
                                    <th>Religion</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Parent</th>
                                    <th>Parent Phone</th>
                                    <th>Username</th>
                                    
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                    if (isset($_POST["btn-search"])) {

                                        $class_name = $_POST["class-name"];

                                        $connection = mysqli_connect("localhost", "root", "", "sms6");


                                        $c_id = 0;

                                        $query = " SELECT class_id as '$c_id' FROM class_tb WHERE class_name='$class_name' ";
                                        $query_run = mysqli_query($connection, $query);
                                        $result = mysqli_fetch_assoc($query_run);

                                        $class_id = $result["$c_id"];



                                        $query = "SELECT * FROM student_tb
                
                                WHERE class_id =$class_id ";

                                        $query_run = mysqli_query($connection, $query);


                                        if (mysqli_num_rows($query_run) > 0) {

                                            while ($row = mysqli_fetch_array($query_run)) {


                                                ?>

                                            <tr class="active">
                                                <!-- <h2>Class </h2> -->
                                                <td><?php echo $row["student_id"] ?></td>
                                                <td><?php echo $row["student_name"] ?></td>
                                                <td><?php echo $row["gender"] ?></td>
                                                <td><?php echo $row["religion"] ?></td>

                                                <?php

                                                                $class_id = $row["class_id"];

                                                                $query1 = "SELECT * from class_tb where class_id=$class_id";
                                                                $query_run1 = mysqli_query($connection, $query1);

                                                                $class = mysqli_fetch_assoc($query_run1);

                                                                $section_id=$row["section_id"];

                                                                $query2 = "SELECT * from section where section_id=$section_id";
                                                                $query_run2 = mysqli_query($connection, $query2);

                                                                $sec = mysqli_fetch_assoc($query_run2);

                                                                ?>
                                                <td><?php echo $class["class_name"] ?></td>
                                                <td><?php echo $sec["section_name"] ?></td>
                                                <td><?php echo $row["parent_name"] ?></td>
                                                <td><?php echo $row["parent_phone"] ?></td>
                                                <td><?php echo $row["username"] ?></td>
                                                

                                                <?php
                                                                $username = $row["username"];
                                                                $query1 = "SELECT * FROM login_tb where username='$username'";
                                                                $query_run1 = mysqli_query($connection, $query1);
                                                                $row1 = mysqli_fetch_assoc($query_run1);
                                                                ?>

                                                <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php echo $row['student_id'] ?>,<?php echo $row['class_id'] ?>,<?php echo $row['section_id'] ?>,<?php echo $row['parent_id'] ?>,<?php echo $row1['id'] ?>)">Edit</button></td>
                                                <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['student_id'] ?>,<?php echo $row['parent_id'] ?>,<?php echo $row1['id'] ?>)">Delete</button></td>



                                            </tr>

                                <?php

                                            }
                                        } else {
                                            echo "No record found " . $class_id;
                                        }
                                    }
                                    ?>
                                <div id="update-student-modal" class="modal fade">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Details</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="admin-name">Student Name:</label>
                                                    <input type="text" class="form-control" id="name-id"  required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Gender:</label>
                                                    <input type="email" class="form-control" id="gender-id" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">Religion:</label>
                                                    <input type="text" class="form-control" id="rel-id" required>
                                                </div>


                                            <br>
                                                <select id="class-id" style="width: 200px; display:inline; margin-left:0px;" class="form-control" required>
                                                    <option value="" disabled selected>Select class</option>

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


                                                <select id="sec-id" style="width: 200px; margin-left:160px; display:inline;" class="form-control" required>
                                                    <option value="" disabled selected>Select Section</option>
                                                    <option value=0>A</option>
                                                    <option value=1>B</option>
                                                    <option value=2>C</option>
                                                    <option value=3>D</option>
                                                    <option value=4>E</option>
                                                    <option value=5>F</option>
                                                    <option value=6>G</option>
                                                </select>
                                                <br><br>

                                                <div class="form-group">
                                                    <label for="phone">Parent Name:</label>
                                                    <input type="text" class="form-control" id="parent-id"  required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" >Parent Phone:</label>
                                                    <input type="text" class="form-control" id="phone-id" pattern="[0-9]{10}" title="must be 10 character" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Parent Email:</label>
                                                    <input type="email" class="form-control" id="email-id" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="username">Username:</label>
                                                    <input type="text" class="form-control" id="username-id" pattern="[a-z]{1,15}" title="Username should only contain lowercase letters. e.g. ram" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="pwd">Password:</label>
                                                    <input type="text" class="form-control" id="pwd-id" required>
                                                </div>



                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                                <input type="hidden" name="" id="std_id">
                                                <input type="hidden" name="" id="user_id">
                                                <input type="hidden" id="class_id-id">
                                                <input type="hidden" id="section_id-id">
                                                <input type="hidden" id="parent_id-id">
                                            </div>

                                        </div>

                                    </div>
                                </div>







                            </tbody>

                        </table>

                    </div>

                </div>

                <div id="new" class="tab-pane fade">

                    <form action="code.php" method="POST">

                        <br>

                        <h4>* First add Class and Section before adding Student</h4>


                        <div class="textfield " style="margin: 5% 15% 5% 15% ">




                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="student-name" type="text" class="form-control" name="student-name" placeholder="Student Name"  required>
                            </div>

                            </br>


                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="gender" type="text" class="form-control" name="gender-name" placeholder="Gender" required>
                            </div>

                            </br>


                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="religion" type="text" class="form-control" name="religion-name" placeholder="Religion" required>
                            </div>

                            </br>



                            <select name="class-name" style="width: 40%; margin-right: 150px; display:inline;" class="form-control" required>
                                <option value="" disabled selected>Assign class</option>

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

                            <select name="section-name" style="width: 40%; display:inline;" class="form-control" required>
                                <option value="" disabled selected>Assign Section</option>

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

                            <br>
                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="parent-name" type="text" class="form-control" name="parent-name" placeholder="Parent Name" required>
                            </div>

                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="parent-phone" type="text" class="form-control" name="parent-phone-name" placeholder="Parent Phone" pattern="[0-9]{10}" title="phone number must be numbers and in 10 character" required>
                            </div>

                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="parent-email" type="text" class="form-control" name="parent-email-name" placeholder="Parent Eamil" required>
                            </div>

                            <br>


                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" name="user-name" placeholder="Username" pattern="[a-z]{1,15}" title="Username should only contain lowercase letters. e.g. ram" required>
                            </div>

                            <br>


                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="text" class="form-control" name="password-name" placeholder="Password" required>
                            </div>

                            </br>



                            <button type="submit" class="btn btn-info" name="btn-add-std">Add Student</button>


                        </div>



                    </form>




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



            function deleteUser(delete_std_id, p_id, u_id) {
                // alert("Asd");

                console.log(delete_std_id);
                console.log(u_id);
                var conf = confirm("Are you sure?");

                if (conf == true) {

                    $.post(
                        "code.php", {

                            delete_std_id: delete_std_id,
                            p_id: p_id,
                            u_id: u_id,

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

            function getUserDetails(s_id, c_id, sec_id, p_id, user_id) {

                

                $('#std_id').val(s_id);
                $('#class_id-id').val(c_id);
                $('#section_id-id').val(sec_id);
                $('#parent_id-id').val(p_id);
                $('#user_id').val(user_id);


                $.post("code.php", {
                        s_id: s_id
                    }, function(data, status) {

                        console.log(data);

                        var user = JSON.parse(data);



                        $('#name-id').val(user.student_name);
                        $('#gender-id').val(user.gender);
                        $('#rel-id').val(user.religion);
                        $('#class_id-id').val(user.class_id);
                        $('#sec_id-id').val(user.section_id);
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
                var class_id = $('#class-id').val();
                var section_id = $('#sec-id').val();
                var parent = $('#parent-id').val();
                var phone = $('#phone-id').val();
                var email = $('#email-id').val();
                var username = $('#username-id').val();
                var password = $('#pwd-id').val();

                var std_id = $('#std_id').val();
                var parent_id = $('#parent_id-id').val();
                var user_id = $("#user_id").val();

                // console.log(class_id);
                // console.log(section_id);

            


                $.post(
                    "code.php", {
                        std_id: std_id,
                        user_id: user_id,
                        name: name,
                        gender: gender,
                        rel: rel,
                        class_id: class_id,
                        section_id: section_id,
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
