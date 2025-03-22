<?php
session_start();

if ($_SESSION["login_admin"] == null) {


  header("location:  index.php");
} else {

  include_once('include/admin_navbar.php');


  ?>


  <div class="container">


    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#table">Sections</a></li>

      <li><a data-toggle="tab" href="#new">New</a></li>

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
              $query = "SELECT * FROM section";
              $query_run = mysqli_query($connection, $query);

              ?>

            <thead>
              <tr class="success">
                <th>Section Name</th>
                <th>Class</th>
                <th>Teacher Assigned</th>

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
                    <td><?php echo $row["section_name"] ?></td>
                    <?php

                          $class_id = $row["class_id"];
                          $teacher_id = $row["teacher_id"];

                          $query1 = "SELECT * from class_tb where class_id=$class_id";
                          $query_run1 = mysqli_query($connection, $query1);

                          $class = mysqli_fetch_assoc($query_run1);

                          $query2 = "SELECT * from teacher_tb where teacher_id=$teacher_id";
                          $query_run2 = mysqli_query($connection, $query2);

                          $teacher = mysqli_fetch_assoc($query_run2);

                          ?>
                    <td><?php echo $class["class_name"] ?></td>
                    <td><?php echo $teacher["teacher_name"] ?></td>
                    <!-- <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails(<?php /*echo $row['section_id']*/ ?>)">Edit</button></td> -->
                    <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row['section_id'] ?>)">Delete</button></td>

                  </tr>

              <?php
                  }
                } else {
                  echo "No record found";
                }
                ?>
              <div id="update-section-modal" class="modal fade">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">Update Details</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>

                    <div class="modal-body">

                      <div class="form-group">
                        <select id="up-section-name" style="width: 200px; margin-left:20px; display:inline;" class="form-control" required>
                          <option value="" disabled selected>Select Section</option>
                          <option value=0>A</option>
                          <option value=1>B</option>
                          <option value=2>C</option>
                          <option value=3>D</option>
                          <option value=4>E</option>
                          <option value=5>F</option>
                          <option value=6>G</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="name_sec"> -->
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

                      <input type="text" name="" id="sec_id">
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

        <form action="code.php" method="POST" style="width: 800px">
          <br>

          <h4>* First add Class and Teacher before adding Section</h4>

          <div class="textfield " style="margin: 5% 15% 0% 15% ">


            <div class="container">


              <br>
              <!-- <input id="section" type="text" class="form-control" name="section-name" placeholder="Section Name"> -->

              <select name="section-name" style="width: 200px; margin-left:20px; display:inline;" class="form-control" required>
                <option value="" disabled selected>Select Section</option>
                <option value=0>A</option>
                <option value=1>B</option>
                <option value=2>C</option>
                <option value=3>D</option>
                <option value=4>E</option>
                <option value=5>F</option>
                <option value=6>G</option>
                <!-- <option>H</option>
                  <option>I</option>
                  <option>J</option>
                  <option>K</option>
                  <option>L</option>
                  <option>M</option>
                  <option>N</option>
                  <option>O</option>
                  <option>P</option>
                  <option>Q</option>
                  <option>R</option>
                  <option>S</option>
                  <option>T</option>
                  <option>U</option>
                  <option>V</option>
                  <option>W</option>
                  <option>X</option>
                  <option>Y</option>
                  <option>Z</option> -->
              </select>








              <select name="class-name" style="width: 200px; display:inline; margin-left:20px;" class="form-control" required>
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



              <select name="teacher-name" style="width: 200px; display:inline; margin-left:20px;" class="form-control" required>
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
              <button style="margin-left:300px; display:inline;" type="submit" class="btn btn-info" name="btn-add-section">Add Section</button>

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

    function deleteUser(delete_sec_id) {
      // alert("Asd");
      var conf = confirm("Are you sure?");

      if (conf == true) {
        $.ajax({
          url: "code.php",
          type: "post",
          data: {
            delete_sec_id: delete_sec_id
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

    // function getUserDetails(sec_id) {



    //   $('#sec_id').val(sec_id);


    //   console.log($('#sec_id').val());

    //   $.post("code.php", {
    //       sec_id: sec_id
    //     }, function(data, status) {

    //       var user = JSON.parse(data);


    //       $('#name_sec').val(user.section_name);
    //       $('#class').val(user.class_name);
    //       $('#teacher').val(user.teacher_name);
    //       alert(user);
    //     }

    //   );

    //   $('#update-section-modal').modal("show");

    // }



    // function updateUserDetail() {
    //   var sec_name = $('#up-section-name').val();
    //   var class_name = $('#up-class-name').val();
    //   var teacher_name = $('#up-teacher-name').val();

    //   var sec_id = $('#sec_id').val();

    //   console.log(sec_id);
    //   console.log(sec_name);
    //   console.log(class_name);
    //   console.log(teacher_name);
    //   // console.log(sec_name);

    //   var num = 0;
    //   $.post(
    //     "code.php", {
    //       sec_id: sec_id,
    //       sec_name: sec_name,
    //       class_name: class_name,
    //       teacher_name: teacher_name,
    //     },


    //     function(data, status) {
    //       $('#update-user-modal').modal("hide");

    //       readRecords();

    //     }



    //   );

    //   // setTimeout(() => {
    //   //   window.location.reload();
    //   // }, 500);

    // }
  </script>

  </body>

  </html>

<?php

}
?>