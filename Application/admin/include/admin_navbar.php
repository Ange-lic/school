<?php


$connection = mysqli_connect("localhost", "root", "", "sms6");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PPS</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style4.css" type="text/css">
    <!-- <script src="js/d6b292a560.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style4.css" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>






</head>

<body>



    <div class="wrapper">
        <!-- Sidebar Holder -->

        <nav id="sidebar">
            <div class="sidebar-header">

                <h4>Pentecost Prep.</h4>
                <h4> School</h4>

            </div>

            <ul class="list-unstyled components ">

                <li>
                    <a href="profile.php">
                        <i class="glyphicon glyphicon-th-list"></i>
                        Dashboard
                    </a>
                </li>


                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown">

                        <i class="
                            glyphicon glyphicon-wrench">
                        </i>
                        Manage Users
                    </a>

                    <ul id="posts_dropdown" class="collapse">

                        <li>
                            <a href="AddAdmin.php">Admin</a>
                        </li>

                        <li>
                            <a href="AddStudent.php">Student</a>
                        </li>

                        <li>
                            <a href="AddParent.php">Parent</a>
                        </li>

                        <li>
                            <a href="AddTeacher.php">Teacher</a>
                        </li>

                    </ul>

                </li>


                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#classes_dropdown"><i class="
                                    glyphicon glyphicon-wrench"></i> Academics
                    </a>
                    <ul id="classes_dropdown" class="collapse">
                        <li>
                            <a href="manageClasses.php">Manage Classes</a>
                        </li>
                        <li>
                            <a href="manageSection.php">Manage Section</a>
                        </li>

                        <li>
                            <a href="manageSubject.php">Manage Subjects</a>
                        </li>

                    </ul>
                </li>






                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#attendance_dropdown"><i class="glyphicon glyphicon-list-alt"></i> Attendance
                    </a>
                    <ul id="attendance_dropdown" class="collapse">
                        <li>
                            <a href="ViewAttendance.php">Student Attendance</a>
                        </li>

                    </ul>
                </li>




                <li>

                    <a href="ViewMarks.php">
                        <i class="glyphicon glyphicon-sound-5-1"></i>
                        Marks

                    </a>
                    <a href="ViewDiary.php">
                        <i class="glyphicon glyphicon-edit"></i>
                        Diary
                    </a>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#schedules_dropdown"><i class="glyphicon glyphicon-list-alt"></i>Schedules
                    </a>
                    <ul id="schedules_dropdown" class="collapse">
                        <li>
                            <a href="ScheduleClass.php">Class Schedules</a>
                        </li>
                        <li>
                            <a href="#">Exam Schedules</a>
                        </li>


                    </ul>
                </li>



                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#news_dropdown"><i class="glyphicon glyphicon-list-alt"></i> News
                    </a>
                    <ul id="news_dropdown" class="collapse">
                        <li>
                            <a href="ViewNews.php">List</a>
                        </li>
                        <li>
                            <a href="SendNews.php">Send</a>
                        </li>


                    </ul>
                </li>







                <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#fee_dropdown"><i class="glyphicon glyphicon-list-alt"></i> Payments
                    </a>

                    <ul id="fee_dropdown" class="collapse">
                        <li>
                            <a href="Fees.php">
                                <i class="glyphicon glyphicon-send"></i>
                                Fees
                            </a>

                        </li>

                        <li>
                            <a href="MakePayment.php">
                                <i class="glyphicon glyphicon-send"></i>
                                Make Payments
                            </a>
                        </li>
                    </ul>

                </li>


               
            </ul>

            
            </ul>
        </nav>


        <!-- Page Content Holder -->
        <div id="content">
            <div class="row"style=" width:1100px">
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

                            $admin_name = "";

                            if ($_SESSION["login_admin"] != null) {

                                $username = $_SESSION['login_admin'];

                                $query = "SELECT * FROM admin_tb WHERE username='$username'";

                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) == 1) {
                                    $row = mysqli_fetch_assoc($query_run);
                                    $admin_name = $row["adminname"];
                                }
                            } else {
                                header("header: index.php");
                            }

                            ?>

                            <a href="../../logout.php" id="destroy" class="btn btn-danger btn-sm" style="float: right;">
                                <span class="glyphicon glyphicon-log-out"></span> Logout    
                            </a>



                            <div class="col-lg-1.5">
                                <div class="chip navbar-right col-xs-3 ">
                                    <img src="avatar.png">
                                    <?php echo  $admin_name ?>

                                </div>
                            </div>




                        </div>
                    </div>
                </nav>
            </div>


            <!-- jQuery CDN -->
            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

            <script type="text/javascript">
               

            </script>
