<?php
session_start();
if($_SESSION["login_parent"]==null){
    header("location: index.php");
  }
  else{
  
      include_once('include/parent_navbar.php');
  
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <title>View News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style15.css" type="text/css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


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
            <li class="active"><a data-toggle="tab" href="#table">View News</a></li>

        </ul>

        <div class="tab-content">

            <div id="table" class="tab-pane fade in active">

                <header>

                </header>

                <div class="container">
                    <br><br>





                    <!-- ---------------- -->
                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>News</th>
                                <th>Date</th>
                                <th>To</th>

                            </tr>
                        </thead>


                        <tbody>


                            <?php

                            $connection = mysqli_connect("localhost", "root", "", "sms6");



                            $query = "SELECT * FROM news where to_aud='students' or to_aud='parents' ";

                            $query_run = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr class="active">
                                    <td><?php echo  $row["news"] ?></td>
                                    <td><?php echo  $row["date"] ?></td>
                                    <td><?php echo  $row["to_aud"] ?></td>
                                   

                                </tr>
                            <?php
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





</body>


</html>

<?php
  }
?>