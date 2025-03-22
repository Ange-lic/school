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
        <title>Diary</title>
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
                <li class="active"><a data-toggle="tab" href="#table">Diary</a></li>
                <li><a data-toggle="tab" href="#dlist">Diary List</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form action="UploadDiary.php" method="POST">
                            <?php
                            $username = $_SESSION['login_teacher'];
                            $query = "SELECT teacher_id,teacher_name FROM teacher_tb WHERE username='$username'";
                            $query_run = mysqli_query($connection, $query);
                            if (mysqli_num_rows($query_run) == 1) {
                                $row = mysqli_fetch_assoc($query_run);
                                $teacher_id = $row["teacher_id"];
                            }

                            ?>

                            <textarea id="my-text-area" required name="diary-name" style="color: black;" required>

                            </textarea>

                            <br<br><br><br><br><br>


                                <select name="class-name" class="form-control" style="display:inline-block; width:200px; " required>
                                    <option value="" disabled selected>Select class</option>

                                    <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");
                                    $query = "SELECT class_id FROM section WHERE teacher_id='$teacher_id'"; /////put the id of teacher 

                                    $query_run = mysqli_query($connection, $query);
                                    $name = "";
                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {

                                            $id = $row["class_id"];

                                            $query1 = "SELECT * from class_tb where class_id='$id'";
                                            $query_run1 = mysqli_query($connection, $query1);

                                            $row1 = mysqli_fetch_assoc($query_run1);

                                            $class_name = $row1["class_name"];

                                    ?>
                                            <option value='<?php echo $row["class_id"] ?>'> <?php echo $class_name ?> </option>


                                    <?php

                                        }
                                    } else {
                                        echo "No record found";
                                    }
                                    ?>


                                </select>

                                <select name="section-name" class="form-control" style="display:inline-block; width:200px; " required>


                                    <option value="" disabled selected>Select Section</option>

                                    <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");


                                    $query = "SELECT * FROM section WHERE teacher_id='$teacher_id' ";

                                    $query_run = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($query_run) > 0) {

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            # code...



                                    ?>
                                            <option value='<?php echo $row["section_name"] ?>'> <?php echo $row["section_name"] ?> </option>


                                    <?php


                                        }
                                    }


                                    ?>


                                </select>

                                <input type="text" id="datepicker" placeholder="Select Date" name="date-name" class="form-control" style="display:inline-block; width:200px; " required>

                                <button class="btn btn-info" style="margin-left:20px;" type="submit" name="btn-upload-diary">Upload</button>
                                <br><br>


                        </form>

                        <br><br>







                    </div>

                </div>

                <div id="dlist" class="tab-pane fade">

                    <?php

                    $query = "SELECT * FROM diary_tb where teacher_id='$teacher_id'";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        echo "<br><br><br>";

                        while ($row = mysqli_fetch_assoc($query_run)) {

                            $id = $row["diary_id"];
                            $date = $row["date"];
                            $str = $row["diary"];

                            $str1 = ltrim($str, "<p>");
                            $diary = rtrim($str1, "</p>");


                    ?>
                            <form method="POST">

                                <textarea rows="5" cols="5" style="width: 70%;" type='text' class='form-control' name="diary1" id="my-text-area" required>
                                <?php


                                echo $diary;

                                ?> 
                            </textarea>

                                <br>
                                <input type="hidden" name="diary-id" value="<?php echo $id ?>">
                                <input type="hidden" name="date" value="<?php echo $date ?>">

                                <input type="submit" class="btn btn-success" value="Update" name="btn-update-dairy">
                                <input type="submit" class="btn btn-warning" value="Delete" name="btn-delete-diary">
                                <hr>

                            </form>

                    <?php

                        }
                    } else {
                        die("No record found");
                    }


                    ?>

                    <?php

                    if (isset($_POST["btn-update-dairy"])) {

                        $diary_id = $_POST["diary-id"];
                        $diary = $_POST["diary1"];
                        $date = $_POST["date"];

                        $query = "UPDATE diary_tb set diary='$diary' where diary_id='$diary_id'";
                        $query_run = mysqli_query($connection, $query);

                        // 

                        if($query_run){
                            // header("location: Diary.php");
                        }
                        else{
                            echo $diary;
                        }



                    } else if (isset($_POST["btn-delete-diary"])) {
                        $diary_id = $_POST["diary-id"];

                        $query = "DELETE from diary_tb where diary_id='$diary_id'";
                        $query_run = mysqli_query($connection, $query);

                        // header("location: Diary.php");
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
            var editor = new FroalaEditor("#my-text-area", {
                width: '1000',
                color: 'black'
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