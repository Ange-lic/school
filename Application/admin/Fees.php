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

        <script>
            function setYear() {
                var d = new Date();
                var year = d.getFullYear();
                let elem = document.getElementById("yearId");
                for (let i = year; i >= 2005; i--) {

                    let option = document.createElement("option");
                    var textnode = document.createTextNode(year);
                    option.appendChild(textnode);
                    elem.appendChild(option);
                    year--;
                }
            }
        </script>
    </head>

    <body style="overflow-x:hidden" onload="setYear()">

        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">View Fee Collection</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="" method="POST">

                            <select name="class-name" class="form-control" style="width: 200px;display: inline; " class="select-box" id="select-class-id" required>
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

                            <select class="form-control" name="section-name" style="width: 200px; display: inline;" class="select-box" required>


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

                            <select id="yearId" name="year-name" style="width: 200px; display:inline-block;" class="form-control" required>
                                <option disabled selected>Select Year</option>
                               
                            </select>

                            <select name="month-name" style="width: 200px; display:inline-block;" class="form-control" required>
                                <option disabled selected>Select Month</option>
                                <option>January</option>
                                <option>Fenraury</option>
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


                            <button type="submit" class="btn btn-info" id="btn-class-search" name="btn-search-fee">Search</button>

                        </form>

                        <br><br>






                        <table class="table" style="width: 90%;">
                            <thead>
                                <tr class="success" style="width: 800px;">
                                    <th>Std. ID.</th>
                                    <th>Std Name</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Month</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "sms6");

                                if (isset($_POST["btn-search-fee"])) {

                                    $class_id = $_POST["class-name"];
                                    $section_name = $_POST["section-name"];
                                    $month=$_POST["month-name"];
                                    $year=$_POST["year-name"];

                                    $date = "$year-$month";

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





                                    $query = "SELECT * FROM student_tb
                
                                WHERE class_id =$class_id and section_id=$section_id ";

                                    $query_run = mysqli_query($connection, $query);


                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_array($query_run)) {

                                            $student_id = $row["student_id"];


                                            $query1 = "SELECT * FROM fee_tb
                
                                                WHERE student_id=$student_id and month='$month'";

                                            $query_run1 = mysqli_query($connection, $query1);

                                            if (mysqli_num_rows($query_run1) > 0) {

                                                while ($row1 = mysqli_fetch_array($query_run1)) {

                                ?>

                                                    <tr class="active">
                                                        <!-- <h2>Class </h2> -->


                                                        <td><?php echo $row1["student_id"] ?></td>


                                                        <?php

                                                        $class_id = $row1["class_id"];
                                                        $student_id = $row1["student_id"];

                                                        $query1 = "SELECT * from class_tb where class_id='$class_id'";
                                                        $query_run1 = mysqli_query($connection, $query1);

                                                        $class = mysqli_fetch_assoc($query_run1);

                                                        $query2 = "SELECT * from section where class_id='$class_id'";
                                                        $query_run2 = mysqli_query($connection, $query2);

                                                        $sec = mysqli_fetch_assoc($query_run2);

                                                        $query2 = "SELECT * from student_tb where student_id='$student_id'";
                                                        $query_run2 = mysqli_query($connection, $query2);

                                                        $student = mysqli_fetch_assoc($query_run2);

                                                        ?>


                                                        <td><?php echo ucfirst($student["student_name"]) ?></td>
                                                        <td><?php echo ucfirst($class["class_name"]) ?></td>
                                                        <td><?php echo ucfirst($sec["section_name"]) ?></td>
                                                        <td><?php echo $row1["amount"] ?></td>
                                                        <td><?php echo $row1["status"] ?></td>
                                                        <td><?php echo $row1["month"] ?></td>
                                                        <td><?php echo $row1["date"] ?></td>






                                                        <td><button class="btn btn-success" name="btn-edit-name" onclick="getUserDetails( <?php echo $row1['fee_id'] ?> ) "> Edit</button>
                                                        </td>
                                                        <td><button class="btn btn-warning" onclick="deleteUser(<?php echo $row1['fee_id'] ?>)">Delete</button></td>



                                                    </tr>
                                                <?php
                                                }
                                            } else {

                                                ?>

                                                <tr class="active">
                                                    <!-- <h2>Class </h2> -->


                                                    <td><?php echo $student_id ?></td>
                                                    <td><?php echo ucfirst($row["student_name"]) ?></td>

                                                    <td><?php echo "Nill"?></td>
                                                    <td><?php echo "Nill"?></td>
                                                    <td><?php echo "Nill" ?></td>
                                                    <td><?php echo "Nill" ?></td>
                                                    <td><?php echo "Nill" ?></td>
                                                    <td><?php echo "Nill" ?></td>




                                                </tr>

                                        <?php
                                            }
                                        }
                                        ?>

                                        <a target="_blank" href="GenerateFeePDF.php?class_id=<?php echo $class_id ?> & class_name=<?php echo $class_name ?> & section_id=<?php echo $section_id ?> & section_name=<?php echo $section_name ?> & month=<?php echo $month ?>" class=" btn btn-success">Generate PDF</a>
                                        <br><br>

                                <?php
                                    } else {
                                        echo "No record found " . $section_id;
                                    }
                                }
                                ?>
                                <div id="update-fee-modal" class="modal fade">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Details</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            </div>

                                            <div class="modal-body">

                                                <!-- <input type="hidden" class="form-control" id="fee-id"> -->

                                                <div class="form-group">
                                                    <label for="fee-name">Fee Id:</label>
                                                    <input type="text" disabled class="form-control" id="fee-id" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="admin-name">Student Id:</label>
                                                    <input type="text" disabled class="form-control" id="std-id" required>
                                                </div>



                                                <div class="form-group">
                                                    <label for="phone">Amount:</label>
                                                    <input type="number" class="form-control" id="amount-id" required>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="status-name" id="status-id" required>
                                                        <option disabled selected>Status</option>
                                                        <option>Paid</option>
                                                        <option>UnPaid</option>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <select class="form-control" name="month-name" id="month-id" required>
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
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                                                        <input type="text" id="datepicker" placeholder="Select Date" name="date-name" class="form-control" required>

                                                    </div>

                                                </div>



                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                                <input type="hidden" name="" id="hidden_id">
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



            function deleteUser(delete_fee_id) {
                // alert("Asd");

                console.log(delete_fee_id);

                var conf = confirm("Are you sure?");

                if (conf == true) {

                    $.post(
                        "code.php", {

                            delete_fee_id: delete_fee_id,


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
            ////////////////////////////////////





            ////////////////////////////////////

            function getUserDetails(fee_id) {

                console.log(fee_id);
                //var num = 0;

                $('#fee-id').val(fee_id);



                $.post("code.php", {
                        fee_id: fee_id
                    }, function(data, status) {

                        var user = JSON.parse(data);

                        $('#fee-id').val(user.fee_id);
                        $('#std-id').val(user.student_id);
                        $('#amount-id').val(user.amount);
                        $('#status-id').val(user.status);
                        $('#month-id').val(user.month);
                        $('#datepicker').val(user.date);

                    }

                );

                // console.log($(#fee));

                $('#update-fee-modal').modal("show");

                // alert("SD");


            }

            function updateUserDetail() {
                var fee_i_id = $('#fee-id').val();
                var amount = $('#amount-id').val();
                var status = $('#status-id').val();
                var month = $('#month-id').val();
                var date = $('#datepicker').val();


                $.post(
                    "code.php", {
                        fee_i_id: fee_i_id,
                        amount: amount,
                        status: status,
                        month: month,
                        date: date,

                    },

                    function(data, status) {
                        $('#update-fee-modal').modal("hide");

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
    ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    