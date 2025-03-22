<?php
session_start();

if ($_SESSION["login_parent"] == null) {
    header("location: index.php");
} else {
    include_once('include/parent_navbar.php');
    $connection = mysqli_connect("localhost", "root", "", "sms6");
?>

<style>
    .list-unstyled a {
        color: white;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fees Collection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style4.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body style="overflow-x:hidden">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#table">Make Payment</a></li>
        </ul>

        <div class="tab-content">
            <div id="table" class="tab-pane fade in active">
                <header></header>
                <div class="container">
                    <?php 
                    $username = $_SESSION['login_parent'];
                    $query = "SELECT * FROM parent_tb WHERE username='$username'";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) == 1) {
                        $row = mysqli_fetch_assoc($query_run);
                        $parent_id = $row["parent_id"];

                        $sql = "SELECT * FROM student_tb WHERE parent_id = $parent_id";
                        $query_run = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($query_run) == 1) {
                            $row = mysqli_fetch_assoc($query_run);
                            $class_id = $row['class_id'] ?? null;
                            $section_id = $row['section_id'] ?? null;

                            // Fetch class details
                            $classSQL = "SELECT * FROM class_tb WHERE class_id = {$class_id}";
                            $classQuery = mysqli_query($connection, $classSQL);
                            $classRow = mysqli_fetch_assoc($classQuery);
                            $class_name = $classRow['class_name'] ?? 'N/A';
                            $price = $classRow['class_price'] ?? 0;

                            // Fetch section details
                            $sectionSQL = "SELECT * FROM section WHERE section_id = {$section_id}";
                            $sectionQuery = mysqli_query($connection, $sectionSQL);
                            $sectionRow = mysqli_fetch_assoc($sectionQuery);
                            $section_name = $sectionRow['section_name'] ?? 'N/A';
                        }
                    }
                    ?>

                    <form id="payment" action="code.php" method="POST">
                        <div class="textfield" style="margin: 5% 15% 0% 15%">
                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="class-name" placeholder="Class Name" value="Rs.<?php echo $price ?>" readonly>
                            </div>
                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="class-name" placeholder="Class Name" value="<?php echo htmlspecialchars($class_name); ?>" readonly>
                                <input type="hidden" name="class-id-name" value="<?php echo htmlspecialchars($class_id); ?>">
                            </div>

                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="section-name" placeholder="Section Name" value="<?php echo htmlspecialchars($section_name); ?>" readonly>
                                <input type="hidden" name="section-id-name" value="<?php echo htmlspecialchars($section_id); ?>">
                            </div>

                            <select style="display: none;" name="students-name[]" class="form-control" multiple style="width: 800px;" id="select-student-id" required>
                                <option value="" disabled selected>Select Student(s)</option>
                                <?php
                                $query = "SELECT * FROM student_tb WHERE class_id='$class_id' AND section_id='$section_id'";
                                $query_run = mysqli_query($connection, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        echo "<option value='" . htmlspecialchars($row["student_id"]) . "'>" . htmlspecialchars($row["student_name"]) . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No record found</option>";
                                }
                                ?>
                            </select>

                            <br>

                            <div class="input-group col-md-12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="number" class="form-control" name="payment-name" placeholder="Payment" required>
                            </div>

                            <br>

                            <input type="hidden" name="status-name" value="Paid">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <select class="form-control" name="month-name" required>
                                    <option disabled selected>Month</option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                                </select>
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="date" id="datepicker" placeholder="Select Date" name="date-name" class="form-control" required>
                            </div>
                            <br><br>

                            <button type="submit" class="btn btn-info" name="btn-submit-payment">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>
</html>

<?php
}
?>