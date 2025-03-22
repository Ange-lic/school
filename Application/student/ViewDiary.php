<?php
session_start();
if ($_SESSION["login_std"] == null) {
    header("location: index.php");
} else {
    include_once('include/student_navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Diary</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style14.css" type="text/css">
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
            <li class="active"><a data-toggle="tab" href="#table">View Diary</a></li>
        </ul>

        <div class="tab-content">
            <div id="table" class="tab-pane fade in active">
                <header></header>
                <div class="container">
                    <br><br>
                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>Subject</th>
                                <th>Diary</th>
                                <th>Date</th>
                                <th>Teacher Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "sms6");
                            $username = $_SESSION['login_std'];
                            $query = "SELECT * FROM student_tb WHERE username='$username'";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) == 1) {
                                $row = mysqli_fetch_assoc($query_run);
                                $student_id = $row["student_id"];
                                $class_id = $row["class_id"];

                                $query = "SELECT * FROM diary_tb WHERE class_id='$class_id'";
                                $query_run = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    $class_id = $row["class_id"];
                                    $query1 = "SELECT * FROM subject_tb WHERE class_id=$class_id";
                                    $query_run1 = mysqli_query($connection, $query1);
                                    $subject = mysqli_fetch_assoc($query_run1);

                                    $teacher_id = $row["teacher_id"];
                                    $query1 = "SELECT * FROM teacher_tb WHERE teacher_id=$teacher_id";
                                    $query_run1 = mysqli_query($connection, $query1);
                                    $teacher = mysqli_fetch_assoc($query_run1);
                                    ?>
                                    <tr class="active">
                                        <td><?php echo isset($subject["subject_name"]) ? htmlspecialchars($subject["subject_name"]) : 'N/A'; ?></td>
                                        <td><?php echo htmlspecialchars($row["diary"]); ?></td>
                                        <td><?php echo htmlspecialchars($row["date"]); ?></td>
                                        <td><?php echo isset($teacher["teacher_name"]) ? htmlspecialchars($teacher["teacher_name"]) : 'N/A'; ?></td>
                                    </tr>
                                    <?php
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
    <!-- Bootstrap Js CDN -->
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