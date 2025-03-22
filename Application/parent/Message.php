<?php
session_start();

if ($_SESSION["login_parent"] == null) {
    header("location: index.php");
} else {
    include_once('include/parent_navbar.php');
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
                <header></header>
                <div class="container">
                    <br><br>
                    <form action="SendMsg.php" method="POST">
                        <textarea id="my-text-area" required name="msg-name" style="color: black;"></textarea>
                        <br><br><br><br><br><br>

                        <?php
                        $username = $_SESSION['login_parent'];
                        $query = "SELECT * FROM parent_tb WHERE username='$username'";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) == 1) {
                            $row = mysqli_fetch_assoc($query_run);
                            $parent_id = $row["parent_id"];

                            $query = "SELECT * FROM student_tb WHERE parent_id='$parent_id'";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) == 1) {
                                $row = mysqli_fetch_assoc($query_run);
                                $student_id = $row["student_id"] ?? null;
                                $class_id = $row["class_id"] ?? null;
                                $section_id = $row["section_id"] ?? null;

                                // Fetch teacher_id
                                $query1 = "SELECT teacher_id FROM section WHERE class_id='$class_id' and section_id='$section_id'";
                                $query_run1 = mysqli_query($connection, $query1);
                                $row1 = mysqli_fetch_assoc($query_run1);
                                $teacher_id = $row1["teacher_id"] ?? null;

                                // Fetch teacher name
                                if ($teacher_id) {
                                    $query2 = "SELECT * FROM teacher_tb WHERE teacher_id='$teacher_id'";
                                    $query_run2 = mysqli_query($connection, $query2);
                                    $row2 = mysqli_fetch_assoc($query_run2);
                                    $teacher_name = $row2["teacher_name"] ?? 'Unknown';
                                } else {
                                    $teacher_name = 'Unknown';
                                }
                            } else {
                                $teacher_name = 'No student found';
                            }
                        } else {
                            $teacher_name = 'No parent found';
                        }
                        ?>

                        <input type="text" readonly style="width:200px; display:inline-block; margin-left:20px;" value="To: <?php echo htmlspecialchars($teacher_name); ?>" name="teacher_name" class="form-control">
                        <input type="hidden" name="teacher_id" value="<?php echo htmlspecialchars($teacher_id); ?>">
                        <input type="hidden" name="parent_id" value="<?php echo htmlspecialchars($parent_id); ?>">
                        <button class="btn btn-info" style ="margin-left:20px; display:inline-block;" type="submit" name="btn-send-msg">Send</button>
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
                        $query = "SELECT * FROM messageteacher_tb WHERE to_msgT='$parent_id'";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $msg = $row["msgT"];
                                $from = $row["from_msgT"];

                                $query1 = "SELECT * FROM teacher_tb WHERE teacher_id='$from'";
                                $query_run1 = mysqli_query($connection, $query1);
                                $row1 = mysqli_fetch_assoc($query_run1);
                                $teacher_name = $row1["teacher_name"] ?? 'Unknown';

                                echo "<tr>
                                        <td>" . htmlspecialchars($msg) . "</td>
                                        <td>" . htmlspecialchars($teacher_name) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No messages found.</td></tr>";
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
                        $query = "SELECT * FROM message_tb WHERE from_msg='$parent_id'";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $msg = $row["msg"];
                                $to = $row["to_msg"];

                                $query1 = "SELECT * FROM teacher_tb WHERE teacher_id='$to'";
                                $query_run1 = mysqli_query($connection, $query1);
                                $row1 = mysqli_fetch_assoc($query_run1);
                                $teacher_name = $row1["teacher_name"] ?? 'Unknown';

                                echo "<tr>
                                        <td>" . htmlspecialchars($teacher_name) . "</td>
                                        <td>" . htmlspecialchars($msg) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No sent messages found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });

        var editor = new FroalaEditor("#my-text-area", {
            width: '1000',
            color: 'black'
        });
    </script>
</body>
</html>

<?php
}
?>