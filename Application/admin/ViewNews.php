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
        <title>View News</title>
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
        </style>



    </head>





    <body style="overflow-x:hidden">


        <div class="container">


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#table">List</a></li>

            </ul>

            <div class="tab-content">

                <div id="table" class="tab-pane fade in active">

                    <header>

                    </header>

                    <div class="container">
                        <br><br>








                        <?php

                        $connection = mysqli_connect("localhost", "root", "", "sms6");



                        $query = "SELECT * FROM news ";

                        $query_run = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $to_aud = $row["to_aud"];
                            $date = $row["date"];
                            $id=$row["id"];

                        ?>

                            <form method="POST">
                                <input type="text" class="form-control" style="width:20%; display:inline-block;" readonly value="<?php echo "To: " . $to_aud ?>">
                                <input type="text" class="form-control" style="width:20%; display:inline-block;" readonly value="<?php echo "Date: " . $date ?>">

                                <input type="hidden" value="<?php echo $id ?>" name="news-id">
                                <br><br>


                                <textarea id="my-text-area" name="news-up">

                                    <?php echo  $row["news"] ?>

                            </textarea>

                                <br>

                                <input type="submit" value="Update" class="btn btn-success" name="btn-news-up" >
                                <button class="btn btn-warning" onclick="deleteUser(<?php echo $row['id'] ?>)">Delete</button>

                            </form>
                            <hr>

                        <?php
                        }

                        if (isset($_POST["btn-news-up"])) {

                            $news = $_POST["news-up"];
                            $id=$_POST["news-id"];

                            $query="UPDATE news set news='$news' where id='$id'";
                            $query_run=mysqli_query($connection,$query);
                        }


                        ?>





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

            function deleteUser(delete_news_id) {
                //  alert("Asd");
                var conf = confirm("Are you sure?");

                if (conf == true) {
                    $.ajax({
                        url: "code.php",
                        type: "post",
                        data: {
                            delete_news_id: delete_news_id
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

            var editor = new FroalaEditor("#my-text-area", {
                width: '1000'
            });
        </script>





    </body>


    </html>

<?php
}
?>