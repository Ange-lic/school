<?php

session_start();
if ($_SESSION["login_admin"] == null) {
    header("location: index.php");
} else {
    include_once('include/admin_navbar.php');
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Add Teacher</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                <li class="active"><a data-toggle="tab" href="#table">Teachers List</a></li>

                <li><a data-toggle="tab" href="#new">Add Teacher</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <?php

                            $connection = mysqli_connect("localhost", "root", "", "sms6");
                            $query = "SELECT * FROM teacher_tb";
                            $query_run = mysqli_query($connection, $query);

                            ?>

                        <table class="table" style="width: 800px;">
                            <thead>
                                <tr class="success">
                                    <th>Teacher id</th>
                                    <th>Teacher name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Username</th>
                                 
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            # code...
                                            ?>
                                        <tr class="active">
                                            <td><?php echo $row["teacher_id"] ?></td>
                                            <td><?php echo $row["teacher_name"] ?></td>
                                            <td><?php echo $row["email"] ?></td>
                                            <td><?php echo $row["phone"] ?></td>
                                            <td><?php echo $row["username"] ?></td>
                                         
                                            <?php
                                                        $username = $row["username"];
                                                        $query1 = "SELECT * FROM login_tb where username='$username'";
                                                        $query_run1 = mysqli_query($connection, $query1);
                                                        $row1 = mysqli_fetch_assoc($query_run1);
                                                        ?>

                                            <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php echo $row['teacher_id'] ?>,<?php echo $row1['id'] ?>)">Edit</button></td>
                                            <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['teacher_id'] ?>,<?php echo $row1['id'] ?>)">Delete</button></td>

                                        </tr>


                                <?php
                                        }
                                    } else {
                                        echo "<h4>*No record found</h4> <br><br>";
                                    }

                                    ?>

                                <div id="update-teacher-modal" class="modal fade">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Details</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="admin-name">Teacher Name:</label>
                                                    <input type="text" class="form-control" id="name_ad" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" id="em" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">Phone:</label>
                                                    <input type="text" class="form-control" id="ph" pattern="[0-9]{10}" title="must be 10 character" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="username">Username:</label>
                                                    <input type="text" class="form-control" id="usrname" pattern="[a-z]{1,15}" title="Username should only contain lowercase letters. e.g. ram" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="pwd">Password:</label>
                                                    <input type="text" class="form-control" id="pwd" required>
                                                </div>



                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                                <input type="hidden" name="" id="teach_id">
                                                <input type="hidden" name="" id="user_id">
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

                        <div class="textfield " style="margin: 5% 15% 0% 15% ">



                            </br>


                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="teacher-name" type="text" class="form-control" name="teacher-name" placeholder="Teacher Name" required>
                            </div>

                            </br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="email" type="email" class="form-control" name="email-name" placeholder="Email" required>
                            </div>

                            </br>



                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="phone" type="text" class="form-control" name="phone-name" placeholder="Phone" required>
                            </div>

                            </br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" name="user-name" placeholder="Username" required>
                            </div>

                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="password" type="text" class="form-control" name="password-name" placeholder="Password" required>
                            </div>

                            </br>


                            <button type="submit" class="btn btn-info" name="btn-add-teacher">Add Teacher</button>


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

            function deleteUser(delete_t_id, u_id) {
                // alert("Asd");

                console.log(delete_t_id);
                console.log(u_id);
                var conf = confirm("Are you sure?");

                if (conf == true) {

                    $.post(
                        "code.php", {

                            delete_t_id: delete_t_id,
                            u_id: u_id,

                        },

                        function(data, status) {

                        }

                    );



                } else {
                    console.log("else false");
                }
                // setTimeout(() => {
                //     window.location.reload();
                // }, 500);

            }





            function getUserDetails(t_id, user_id) {


                var num = 0;
                $('#teach_id').val(t_id);
                $('#user_id').val(user_id);

                console.log($('#teach_id').val());

                $.post("code.php", {
                        t_id: t_id
                    }, function(data, status) {

                        var user = JSON.parse(data);

                        $('#name_ad').val(user.teacher_name);
                        $('#em').val(user.email);
                        $('#ph').val(user.phone);
                        $('#usrname').val(user.username);
                        $('#pwd').val(user.password);

                    }

                );

                $('#update-teacher-modal').modal("show");

                // alert("SD");


            }

            function updateUserDetail() {
                var name = $('#name_ad').val();
                var email = $('#em').val();
                var phone = $('#ph').val();
                var username = $('#usrname').val();
                var password = $('#pwd').val();

                var teach_id = $('#teach_id').val();
                var user_id = $('#user_id').val();

                var num = 0;
                $.post(
                    "code.php", {
                        teach_id: teach_id,
                        user_id: user_id,
                        name: name,
                        email: email,
                        phone: phone,
                        username: username,
                        password: password,
                    },

                    function(data, status) {
                        $('#update-teacher-modal').modal("hide");

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