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
    <title>Manage Classes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

    <style>
      .select-box {
        padding: 8px;
        border-radius: 5px;

      }
    </style>
  </head>

  <body>


    <div class="container">


      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#table">Subjects</a></li>

        <li><a data-toggle="tab" href="#new">Add New</a></li>

      </ul>
      <br>

      <div class="container">


      </div>


      <!-- ------------------------------------------------------------------------------------------------- -->


      <div class="tab-content">
        <div id="table" class="tab-pane fade in active">
          <!-- <?php   /*include('adminTable.php');*/ ?> -->
          <div class="container">
            <br><br>
            <table class="table" style="width: 800px;">

              <?php

                $connection = mysqli_connect("localhost", "root", "", "sms6");
                $query = "SELECT * FROM subject_tb";
                $query_run = mysqli_query($connection, $query);

                ?>

              <thead>
                <tr class="success">
                  <th>Subject Name</th>
                  <th>Class</th>
                  <th>Subject Teacher</th>
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
                      <td><?php echo $row["subject_name"] ?></td>

                      <?php

                            $class_id = $row["class_id"];
                            $teacher_id = $row["teacher_id"];

                            $query1 = "SELECT * from class_tb where class_id=$class_id";
                            $query_run1 = mysqli_query($connection, $query1);

                            $class = mysqli_fetch_assoc($query_run1);

                            $query2 = "SELECT * from teacher_tb where teacher_id=$teacher_id";
                            $query_run2 = mysqli_query($connection, $query2);

                            $teach = mysqli_fetch_assoc($query_run2);

                            ?>


                      <td><?php echo $class["class_name"] ?></td>
                      <td><?php echo $teach["teacher_name"] ?></td>
                      <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php echo $row['subject_id'] ?>)">Edit</button></td>
                      <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['subject_id'] ?>)">Delete</button></td>


                    </tr>

                <?php
                    }
                  } else {
                    echo "No record found";
                  }
                  ?>

                <div id="update-sub-modal" class="modal fade">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title">Update Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>

                      <div class="modal-body">

                        <div class="form-group">
                          <input id="up-subject-name" type="text" class="form-control" style="width: 200px; margin-left:20px;" name="subject-name" placeholder="Subject Name" required>
                        </div>

                        <div class="form-group">
                          <select id="up-class-name" style="width: 200px; display:inline; margin-left:20px;" class="form-control" required>
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
                        </div>

                        <div class="form-group">
                          <select id="up-teacher-name" style="width: 200px; display:inline; margin-left:20px;" class="form-control" required>
                            <option value="" disabled selected>Select Teacher</option>

                            <?php

                              $connection = mysqli_connect("localhost", "root", "", "sms6");
                              $query = "SELECT * FROM teacher_tb";

                              $query_run = mysqli_query($connection, $query);

                              if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {
                                  # code...

                                  ?>
                                <option value='<?php echo $row["teacher_id"] ?>'> <?php echo $row["teacher_name"] ?> </option>


                            <?php
                                }
                              } else {
                                echo "No record found";
                              }
                              ?>

                          </select>

                        </div>




                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                        <input type="hidden" name="" id="sub_id">
                      </div>

                    </div>

                  </div>
                </div>


              </tbody>
            </table>
          </div>
        </div>

        <!-- ------------------------------------------- -->

        <div id="new" class="tab-pane fade">

          <form action="code.php" method="POST">

            <br>

            <h4>* First add Class and Teacher before adding Subjects</h4>

            <div class="textfield " style="margin: 5% 15% 0% 25% ">


              <div class="container">

                <div class="input-group col-md-12" style="width: 400px;">

                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                  <input id="subject" type="text" class="form-control" name="subject-name" placeholder="Subject Name" required>

                </div>

                </br>


                </br>
                <select name="class-name" style="width: 200px; display:inline;" class="form-control" required>
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

                <select name="teacher-name" style="width: 200px; display:inline;"class="form-control" required>
                  <option value="" disabled selected>Select Teacher</option>

                  <?php

                    $connection = mysqli_connect("localhost", "root", "", "sms6");
                    $query = "SELECT * FROM teacher_tb";

                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {

                      while ($row = mysqli_fetch_assoc($query_run)) {
                        # code...

                        ?>
                      <option value='<?php echo $row["teacher_id"] ?>'> <?php echo $row["teacher_name"] ?> </option>


                  <?php
                      }
                    } else {
                      echo "No record found";
                    }
                    ?>

                </select>



                <br><br><br><br>
                <button style="margin-left:150px" type="submit" class="btn btn-info" name="btn-add-subject">Add Subject</button>

              </div>




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

      function deleteUser(delete_sub_id) {
        // alert("Asd");
        var conf = confirm("Are you sure?");

        if (conf == true) {
          $.ajax({
            url: "code.php",
            type: "post",
            data: {
              delete_sub_id: delete_sub_id,
            },

            function(data, status) {

            }
          });
          setTimeout(() => {
            window.location.reload();
          }, 500);

        }
      }

      function getUserDetails(get_sub_id) {


        $('#sub_id').val(get_sub_id);

        console.log($('#sub_id').val());

        $.post("code.php", {
            get_sub_id: get_sub_id
          }, function(data, status) {

            console.log(data);
            var user = JSON.parse(data);

            $('#up-subject-name').val(user.subject_name);
            $('#up-class-name').val(user.class_name);
            $('#up-teacher-name').val(user.teacher_name);


          }

        );

        $('#update-sub-modal').modal("show");

        // alert("SD");


      }

      function updateUserDetail() {

        var sub_name = $('#up-subject-name').val();
        var class_id = $('#up-class-name').val();
        var teacher_id = $('#up-teacher-name').val();



        var sub_id = $('#sub_id').val();

        var num = 0;
        $.post(
          "code.php", {
            sub_id: sub_id,
            sub_name: sub_name,
            class_id: class_id,
            teacher_id: teacher_id,

          },

          function(data, status) {
            $('#update-sub-modal').modal("hide");



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