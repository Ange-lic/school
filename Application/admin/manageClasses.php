<?php
session_start();

if($_SESSION["login_admin"]==null){

    
    header("location:  index.php");
}
else{

    include_once('include/admin_navbar.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Manage Classes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
</head>

<body style="overflow-x: hidden;">

  <div class="container">


    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#table">Classes</a></li>

      <li><a data-toggle="tab" href="#new">New</a></li>

    </ul>

    <div class="tab-content">

      <div id="table" class="tab-pane fade in active" style="width=700px;">


        <div class="container">
          <br><br>

          <table class="table" style="width: 800px;">

            <?php

            $connection = mysqli_connect("localhost", "root", "", "sms6");
            $query = "SELECT * FROM class_tb";
            $query_run = mysqli_query($connection, $query);

            ?>

            <thead>

              <tr class="success">
                <th>Class ID</th>
                <th>Class Name</th>
                <th>Class Price</th>
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
                    <td><?php echo $row["class_id"] ?></td>
                    <td><?php echo $row["class_name"] ?></td>
                    <td><?php echo $row["class_price"] ?></td>
                    <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php echo $row['class_id'] ?>)">Edit</button></td>
                    <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['class_id'] ?>)">Delete</button></td>


                  </tr>

              <?php
                }
              } else {
                echo "No record found";
              }
              ?>

              <div id="update-class-modal" class="modal fade">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">Update Details</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>

                    <div class="modal-body">



                      <div class="form-group">
                        <label for="class_pl">Class Name:</label>
                        <input type="text" class="form-control" id="class_pl" required>
                      </div>

                      <div class="form-group">
                        <label for="class_price">Class Price:</label>
                        <input type="number" class="form-control" id="class_price" required>
                      </div>

                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                      <input type="hidden" name="" id="class_hid">
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

          <div class="textfield " style="margin: 0">


            <div class="container">

              <br><br><br>
              <div class="input-group mb-3" style="margin-left: 33%; margin-top:0%">
                <input type="text" class="form-control" placeholder="Class Name" aria-label="classname" aria-describedby="basic-addon1" name="class-name" required>
              </div>
              <br>
              <div class="input-group mb-3" style="margin-left: 33%; margin-top:0%">
                <input type="number" class="form-control" placeholder="Class Cost" aria-label="classprice" aria-describedby="basic-addon1" name="class-price" required>
              </div>
              <br><br><br>

              <button type="submit" class="btn btn-info" style="margin-left: 33%; margin-top:-7%" name="btn-add-class">Add Class</button>

            </div>



        </form>

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

    function deleteUser(delete_class_id) {
      // alert("Asd");
      var conf = confirm("Are you sure?");

      if (conf == true) {
        $.ajax({
          url: "code.php",
          type: "post",
          data: {
            delete_class_id: delete_class_id
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


    function getUserDetails(cl_id) {


      $('#class_hid').val(cl_id);

      console.log($('#class_hid').val());

      $.post("code.php", {
          cl_id: cl_id
        }, function(data, status) {

          var user = JSON.parse(data);

          $('#class_pl').val(user.class_name);
          $('#class_price').val(user.class_price);

        }

      );

      $('#update-class-modal').modal("show");

      // alert("SD");


    }

    function updateUserDetail() {
      var classn = $('#class_pl').val();
      var classp = $('#class_price').val();
      

      var class_hid = $('#class_hid').val();

      var num = 0;
      $.post(
        "code.php", {
          class_hid: class_hid,
          classn: classn,
          classp: classp

        },

        function(data, status) {
          $('#update-class-modal').modal("hide");



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
}?>