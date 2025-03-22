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
    <title>Add Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style4.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <style>

    </style>
  </head>

  <body style="overflow-x:hidden">

    <div class="container">


      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#table">Admins</a></li>

        <li><a data-toggle="tab" href="#new">New</a></li>

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

            <table id="editable_table" class="table table-bordered table-striped" style="width: 800px;">
              <thead>
                <tr class="success">
                  <th>ID</th>
                  <th>Name</th>
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
                      <td><?php echo $row["admin_id"] ?></td>
                      <td><?php echo $row["adminname"] ?></td>
                      <td><?php echo $row["admin_email"] ?></td>
                      <td><?php echo $row["admin_phone"] ?></td>
                      <td><?php echo $row["username"] ?></td>
                     
                      <?php
                            $username = $row["username"];
                            $query1 = "SELECT * FROM login_tb where username='$username'";
                            $query_run1 = mysqli_query($connection, $query1);
                            $row1 = mysqli_fetch_assoc($query_run1);
                            ?>

                      <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php echo $row['admin_id'] ?>,<?php echo $row1['id'] ?>)">Edit</button></td>
                      <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['admin_id'] ?>,<?php echo $row1['id'] ?>)">Delete</button></td>

                    </tr>

                <?php
                    }
                  } else {
                    echo "No record found";
                  }
                  ?>


                <!-- Modal -->
                <div id="update-user-modal" class="modal fade">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title">Update Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>

                      <div class="modal-body">


                        <div class="form-group">
                          <label for="admin-name">Admin Name:</label>
                          <input type="text" class="form-control" id="name_ad" required>
                        </div>

                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control" id="em" required>
                        </div>

                        <div class="form-group">
                          <label for="phone">Phone:</label>
                          <input type="text" class="form-control" id="ph" required>
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

                        <input type="hidden" name="" id="admin_id">
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
                <input id="adminname" type="text" class="form-control" name="admin-name" placeholder="Admin Name" required>
              </div>

              <br>


              <div class="input-group col-md-12">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="text" class="form-control" name="email-name" placeholder="Email" required>
              </div>

              </br>

              <div class="input-group col-md-12">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="phone" type="text" class="form-control" name="phone-name" placeholder="Phone" required>
              </div>

              <br>

              <div class="input-group col-md-12">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="username" type="text" class="form-control" name="user-name" placeholder="Username" required>
              </div>

              </br>


              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="text" class="form-control" name="password-name" placeholder="Password" required>
              </div>


              </br>


              <button type="submit" class="btn btn-info" name="btn-add-admin">Add Admin</button>


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
        //alert("SD");

      });

      function deleteUser(deleteid, u_id) {
        // alert("Asd");

        console.log(deleteid);
        console.log(u_id);
        var conf = confirm("Are you sure?");

        if (conf == true) {

          $.post(
            "code.php", {

              deleteid: deleteid,
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


      function getUserDetails(id, uid) {


        var num = 0;
        $('#admin_id').val(id);
        $('#user_id').val(uid);

        console.log($('#user_id').val());
        console.log($('#admin_id').val());

        $.post("code.php", {
            id: id
          },
           function(data, status) {

          
            console.log(data);
            var user = JSON.parse(data);
          
            

            $('#name_ad').val(user.adminname);
            $('#em').val(user.admin_email);
            $('#ph').val(user.admin_phone);
            $('#usrname').val(user.username);
            $('#pwd').val(user.password);

          }

        );

        $('#update-user-modal').modal("show");

        


      }

      function updateUserDetail() {
        var name = $('#name_ad').val();
        var email = $('#em').val();
        var phone = $('#ph').val();
        var username = $('#usrname').val();
        var password = $('#pwd').val();

        var admin_uid = $('#admin_id').val();
        var user_id = $("#user_id").val();

        console.log(user_id);

        var num = 0;
        $.post(
          "code.php", {
            admin_uid: admin_uid,
            user_id: user_id,
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