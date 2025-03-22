<?php

$connection = mysqli_connect("localhost", "root", "", "sms6");


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> PPS</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style4.css">
    <!-- <script src="js/d6b292a560.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">

                <h3>Pentecost Prep. School</h3>
                <strong>PPS</strong>

            </div>

            <ul class="list-unstyled components ">

                <li>
                    <a href="profile.php">
                        <i class="glyphicon glyphicon-th-list"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="MarkAttendance.php">
                        <i class="glyphicon glyphicon-file"></i>
                        Mark Attendance
                    </a>
                </li>

                <li>
                    <a href="GiveMarks.php">
                        <i class="glyphicon glyphicon-file"></i>
                        Give Marks
                    </a>
                </li>

                <li>
                    <a href="ViewNews.php">
                        <i class="glyphicon glyphicon-file"></i>
                        News
                    </a>
                </li>

                <li>
                    <a href="Diary.php">
                        <i class="glyphicon glyphicon-file"></i>
                        Diary
                    </a>
                </li>

                <li>
                    <a href="ViewSchedule.php">
                        <i class="glyphicon glyphicon-file"></i>
                        View Schedule
                    </a>
                </li>

                <li>
                    <a href="MessageT.php">
                        <i class="glyphicon glyphicon-file"></i>
                        Send Message
                    </a>
                </li>
                <li>
                    <a href="studentremarks.php">
                        <i class="glyphicon glyphicon-file"></i>
                        Student Remarks
                    </a>
                </li>
				 <li>
                    <a href="sendNotes.php">
                        <i class="glyphicon glyphicon-file"></i>
                       Send Notes
                    </a>
                </li>
                
        </nav>




        <!-- Page Content Holder -->

        <div id="content">
            <div class="row" style=" width:1100px">
                <nav class="navbar navbar-default ">
                    <div class="container-fluid ">

                        <div class="col-lg-1.0">
                            <div class="navbar-header ">
                                <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                    <i class="			
								glyphicon glyphicon-resize-horizontal"></i>
                                    <span></span>
                                </button>

                            </div>

                            <div class="col-lg-9">
                                <div class="zab">
                                    <h2>Pentecost Prep School</h2>
                                </div>
                            </div>

                            <?php

                            $teacher_name = "";

                            $username = $_SESSION['login_teacher'];
                            $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
                            $query_run = mysqli_query($connection, $query);
                            if (mysqli_num_rows($query_run) == 1) {
                                $row = mysqli_fetch_assoc($query_run);
                                $teacher_name = $row["teacher_name"];
                            }

                            ?>

                            <a href="../../logout.php" id="destroy" class="btn btn-danger btn-sm" style="float: right;">
                                <span class="glyphicon glyphicon-log-out"></span> Logout
                            </a>



                            <div class="col-lg-1.5">
                                <div class="chip navbar-right col-xs-3 ">
                                    <img src="avatar.png">
                                    <?php echo  $teacher_name ?>

                                </div>
                            </div>




                        </div>
                    </div>
                </nav>
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
            </script>
