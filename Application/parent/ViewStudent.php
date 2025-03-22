<?php
session_start();
if ($_SESSION["login_parent"] == null) {
    header("location: index.php");
} else {
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
                <header></header>
                <div class="container">
                    <br><br>
                    <table class="table" style="width: 800px;">
                        <thead>
                            <tr class="success">
                                <th>News</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "sms6");

                            $dontShow = ["class_id", "section_id", "parent_id", "password", 'student_id'];

                            $username = $_SESSION['login_parent'];
                            $query = "SELECT * FROM parent_tb WHERE username='$username'";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) == 1) {
                                $row = mysqli_fetch_assoc($query_run);
                                $parent_id = $row["parent_id"];
                                $sqlStudent = "SELECT * FROM student_tb WHERE parent_id = $parent_id";
                                $studentQuery = mysqli_query($connection, $sqlStudent);

                                if (mysqli_num_rows($studentQuery) == 1) {
                                    $row = mysqli_fetch_assoc($studentQuery);
                                    
                                    // Check if $row is not null
                                    if ($row) {
                                        $class_id = $row['class_id'] ?? null; // Use null coalescing operator
                                        $section_id = $row['section_id'] ?? null;

                                        // Fetch class name
                                        $classSQL = "SELECT * FROM class_tb WHERE class_id = {$class_id}";
                                        $classQuery = mysqli_query($connection, $classSQL);
                                        $classRow = mysqli_fetch_assoc($classQuery);
                                        $class_name = $classRow['class_name'] ?? 'N/A'; // Default value if not found

                                        // Fetch section name
                                        $sectionSQL = "SELECT * FROM section WHERE section_id = {$section_id}";
                                        $sectionQuery = mysqli_query($connection, $sectionSQL);
                                        $sectionRow = mysqli_fetch_assoc($sectionQuery);
                                        $section_name = $sectionRow['section_name'] ?? 'N/A'; // Default value if not found

                                        // Display class and section
                                        ?>
                                        <tr>
                                            <td>Class</td>
                                            <td><?php echo htmlspecialchars($class_name); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Section</td>
                                            <td><?php echo htmlspecialchars($section_name); ?></td>
                                        </tr>
                                        <?php
                                        foreach ($row as $key => $value) {
                                            if (in_array($key, $dontShow)) {
                                                continue;
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($key); ?></td>
                                                <td><?php echo htmlspecialchars($value); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='2'>No student data found.</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>No student associated with this parent.</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>Parent not found.</td></tr>";
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