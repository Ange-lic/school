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
        <title>News</title>
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


        <style>
            .select-box {
                padding: 8px;
                border-radius: 5px;

            }

            /* #news-id{
            width: 800px;
            height: 200px;
        } */
        </style>



    </head>





    <body style="overflow-x:hidden">


        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">Add News</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>

                        <form id="news-form" action="SendNews.php" method="POST">

                            <textarea id="my-text-area"  required name="news-name" >

                            </textarea>

                            <br><br><br>


                            <select name="to-name" class="form-control" style="display:inline-block; width:200px; " required>
                                <option value="" disabled selected>To</option>
                                <option value="1">Students</option>
                                <option value="2">Teachers</option>
                                <option value="3">Parents</option>

                            </select>

                            <input type="text" class="form-control" style="display:inline-block; width:200px; z-index=1; " id="datepicker" placeholder="Select Date" name="date-name" required class="select-box">

                            <button type="submit" class="btn btn-info" id="btn-class-send" name="btn-send">Send</button>
                            <br><br><br> <br><br><br> <br><br><br>


                        </form>



                        <br><br>


                        <!-- ---------------- -->
                        <table class="table" style="width: 800px;">
                            <thead>

                            </thead>


                            <tbody>


                                <?php

                                    $connection = mysqli_connect("localhost", "root", "", "sms6");


                                    if (isset($_POST["btn-send"])) {

                                        $news = $_POST["news-name"];
                                        $to_name = $_POST["to-name"];
                                        $date = $_POST["date-name"];

                                        //1==students,  2==teachers, 3== parents


                                        if ($to_name == 1) {
                                            //student
                                            $query = "INSERT INTO news (news,to_aud,date) Values('$news','students','$date')";
                                            $query_run = mysqli_query($connection, $query);
                                        } elseif ($to_name == 2) {
                                            # teachers

                                            $query = "INSERT INTO news (news,to_aud,date) Values('$news','teachers','$date')";
                                            $query_run = mysqli_query($connection, $query);
                                        } elseif ($to_name == 3) {
                                            // parents
                                            $query = "INSERT INTO news (news,to_aud,date) Values('$news','parents','$date')";
                                            $query_run = mysqli_query($connection, $query);
                                        }
                                    }


                                    ?>




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
        </script>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });

            })

            var editor = new FroalaEditor("#my-text-area",{width: '1000'});
        </script>



    </body>


    </html>

<?php

}

?>