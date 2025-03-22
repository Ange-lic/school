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
        <title>Add Parent</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body style="overflow-x:hidden;">

        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">Parents List</a></li>


        <li><a data-toggle="tab" href="#new">Add</a></li>

      </ul>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <?php

                            $connection = mysqli_connect("localhost", "root", "", "sms6");
                            $query = "SELECT * FROM parent_tb";
                            $query_run = mysqli_query($connection, $query);

                            ?>

                        <table class="table" style="width: 800px;">
                            <thead>
                                <tr class="success">
                                    <th>Parent id</th>
                                    <th>Parent name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
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
                                            <td><?php echo $row["parent_id"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><?php echo $row["phone"] ?></td>
                                            <td><?php echo $row["email"] ?></td>
                                            <td><?php echo $row["username"] ?></td>
                                           

                                            <?php
                                                        $username = $row["username"];
                                                        $query1 = "SELECT * FROM login_tb where username='$username'";
                                                        $query_run1 = mysqli_query($connection, $query1);
                                                        $row1 = mysqli_fetch_assoc($query_run1);
                                                        ?>

                                            <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php echo $row['parent_id'] ?>,<?php echo $row1['id'] ?>)">Edit</button></td>
                                           <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['parent_id'] ?>,<?php echo $row1['id'] ?>)">Delete</button></td>

                                        </tr>


                                <?php
                                        }
                                    }

                                    ?>

                                <div id="update-parent-modal" class="modal fade">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Details</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="admin-name">Parent Name:</label>
                                                    <input type="text" class="form-control" id="name_ad" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">Phone:</label>
                                                    <input type="text" class="form-control" id="ph" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" id="em" required>
                                                </div>



                                                <div class="form-group">
                                                    <label for="username">Username:</label>
                                                    <input type="text" class="form-control" id="usrname" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="pwd">Password:</label>
                                                    <input type="text" class="form-control" id="pwd" required>
                                                </div>



                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                            <input type="hidden" name="" id="parent_id">
                                            </div>

                                        </div>

                                    </div>
                                </div>






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


            function getUserDetails(p_id) {


                var num = 0;
                $('#parent_id').val(p_id);

                console.log($('#parent_id').val());

                $.post("code.php", {
                        p_id: p_id
                    }, function(data, status) {

                        var user = JSON.parse(data);

                        $('#name_ad').val(user.name);
                        $('#ph').val(user.phone);
                        $('#em').val(user.email);
                        $('#usrname').val(user.username);
                        $('#pwd').val(user.password);

                    }

                );

                $('#update-parent-modal').modal("show");

                // alert("SD");


            }

            function updateUserDetail() {
                var name = $('#name_ad').val();
                var phone = $('#ph').val();
                var email = $('#em').val();
                var username = $('#usrname').val();
                var password = $('#pwd').val();

                var hidden_id = $('#parent_id').val();

                var num = 0;
                $.post(
                    "code.php", {
                        parent_id: parent_id,
                        name: name,
                        phone: phone,
                        email: email,
                        username: username,
                        password: password,
                    },

                    function(data, status) {
                        $('#update-parent-modal').modal("hide");

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