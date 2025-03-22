<?php
session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('include/teacher_navbar.php');

    $connection = mysqli_connect("localhost", "root", "", "sms6");


?>



    <!DOCTYPE html>

    <html lang="en">

    <head>
        <title>Messages</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style4.css" type="text/css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

        <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/js/froala_editor.pkgd.min.js"></script>




    </head>





    <body style="overflow-x:hidden">


        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">Send Message</a></li>
                <li><a data-toggle="tab" href="#rlist">Received List</a></li>
                <li><a data-toggle="tab" href="#dlist">Sent List</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="SendMsgT.php" method="POST">


                            <textarea id="my-text-area" required name="msg-name" style="color: black;" required>

                            </textarea>

                            <br<br><br>

                                <?php
                                $teacher_name = "";

                                $username = $_SESSION['login_teacher'];
                                $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) == 1) {
                                    $row = mysqli_fetch_assoc($query_run);
                                    $teacher_name = $row["teacher_name"];
                                    $teacher_id = $row["teacher_id"];



                                    $query = "SELECT * FROM section WHERE teacher_id='$teacher_id'";
                                    $query_run = mysqli_query($connection, $query);

                                    $row = mysqli_fetch_assoc($query_run);

                                    $class_id = $row["class_id"];
                                    $section_id = $row["section_id"];
                                }

                                ?>

                                <select name="parent-name[]" class="form-control" multiple style="width: 800px; height:200px;" class="select-box" id="select-student-id" required>

                                    <option value="" disabled>Select Student(s)</option>

                                    <?php

                                    $query = "SELECT * FROM student_tb where class_id='$class_id' and section_id='$section_id'  ";
                                    //$query2 = "Select * from remarking";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            # code...
                                            $student_name = $row["student_name"];

                                    ?>
                                            <option value="weak">Weak Student</option>
                                            <option value="average">Average Student</option>
                                            <option value="distinction">Distinction Student</option>


                                    <?php
                                        }
                                    } else {
                                        echo "No record found";
                                    }
                                    ?>


                                </select>




                                <input type="hidden" name="teacher_id" value="<?php echo "$teacher_id" ?>">
                                <br><br>


                                <button class="btn btn-info" style="margin-left:0px; display:block;" type="submit" name="btn-send-msgt">Send</button>
                                <br><br>


                        </form>

                        <br><br>







                    </div>

                </div>

                <div id="rlist" class="tab-pane fade">

                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>Message</th>
                                <th>From</th>


                            </tr>
                        </thead>


                        <tbody>

                            <?php
                            $query = "SELECT * FROM message_tb where `to`='$teacher_id'";

                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {

                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $msg = $row["message"];
                                    $from = $row["from_msg"];

                                    $query1 = "SELECT * FROM parent_tb where parent_id='$from'";

                                    $query_run1 = mysqli_query($connection, $query1);
                                    $row1 = mysqli_fetch_assoc($query_run1);

                                    $parent_name = $row1["name"];




                            ?>

                                    <tr>
                                        <td><?php echo $msg ?></td>
                                        <td><?php echo $parent_name ?></td>
                                    </tr>


                            <?php



                                }
                            }
                            ?>

                        </tbody>

                    </table>

                </div>

                <div id="dlist" class="tab-pane fade">




                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>To</th>
                                <th>Message</th>


                            </tr>
                        </thead>


                        <tbody>


                            <?php







                            $query = "SELECT * FROM messageteacher_tb WHERE from_msgT='$teacher_id'";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {





                                while ($row = mysqli_fetch_assoc($query_run)) {


                                    $msg = $row["msgT"];

                                    $to = $row["to_msgT"];

                                    $query1 = "SELECT * FROM parent_tb WHERE parent_id='$to'";
                                    $query_run1 = mysqli_query($connection, $query1);

                                    $row1 = mysqli_fetch_assoc($query_run1);

                                    $parent_name = $row1["name"];





                            ?>

                                    <tr>
                                        <td><?php echo $parent_name ?></td>
                                        <td><?php echo $msg ?></td>
                                    </tr>


                            <?php

                                }
                            } else {
                                echo "not";
                            }





                            ?>


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

            change = function(e) {
                let ta = document.getElementById(e.id);
                console.log(e.id);

                ta.value = "";

            }
            leave = function(e) {
                let ta = document.getElementById(e.id);
                if (ta.value == "") {

                    let ta = document.getElementById(e.id);
                    console.log(ta.value);
                    ta.value = "N/A";

                }

            }
            let uploadedFiles = []

            var editor = new FroalaEditor("#my-text-area", {
                width: '1000',
                color: 'black',
                fileUploadParam: 'pdf',

                // Set the file upload URL.
                fileUploadURL: '/Application/teacher/upload_file.php',

                // Additional upload params.
                fileUploadParams: {
                    submit: 'anything'
                },

                // Set request type.
                fileUploadMethod: 'POST',

                // Set max file size to 20MB.
                fileMaxSize: 20 * 1024 * 1024,

                // Allow to upload any file.
                fileAllowedTypes: ['*'],
                events: {
                    'file.beforeUpload': function(files) {
                        // Return false if you want to stop the file upload.
                    },
                    'file.uploaded': function(response) {
                        // uploadedFiles.push()
                        // File was uploaded to the server.
                    },
                    'file.inserted': function($file, response) {
                        // File was inserted in the editor.
                    },
                    'file.error': function(error, response) {
                        // Bad link.
                        if (error.code == 1){}

                        // No link in upload response.
                        else if (error.code == 2){}

                        // Error during file upload.
                        else if (error.code == 3){}

                        // Parsing response failed.
                        else if (error.code == 4){}

                        // File too text-large.
                        else if (error.code == 5){}

                        // Invalid file type.
                        else if (error.code == 6){}

                        // File can be uploaded only to same domain in IE 8 and IE 9.
                        else if (error.code == 7){}
                        // Response contains the original server response to the request if available.
                    }
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });

            })
        </script>



    </body>


    </html>

<?php
}
?>