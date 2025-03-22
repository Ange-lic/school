<?php 
session_start();
$connection = mysqli_connect("localhost", "root", "", "sms6");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(isset($_GET['paid'])){
    if($_GET['paid'] != 'true'){
        echo "Failed";
        return;
    }

    if(isset($_SESSION['paymentData'])){

        $_POST = $_SESSION['paymentData'];
        if (isset($_POST["btn-submit-payment"])) {


            $class_id = $_POST["class-id-name"];
    
            $section_id = $_POST["section-id-name"];
    
            $title = $_POST["title-name"];
            $desc = $_POST["desc-name"];
            $month = $_POST["month-name"];
            $payment = $_POST["payment-name"];
            $status = $_POST["status-name"];
            $date = $_POST["date-name"];
    
            // Check if any option is selected 
            if (isset($_POST["students-name"])) {
                // Retrieving each selected option 
                foreach ($_POST['students-name'] as $value) {
    
                    $query = "SELECT * FROM student_tb where student_id=$value";
                    $query_run = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($query_run)) {
    
                        $student_id = $row["student_id"];
                        $student_name = $row["student_name"];
    
    
                        $query1 = "INSERT INTO fee_tb (student_id,class_id,section_id,amount,status,month,date)
                
                VALUES('$student_id','$class_id','$section_id','$payment','$status','$month','$date')";
    
                        $query_run1 = mysqli_query($connection, $query1);
                    }
                }
            } else {
                echo "<h2>Student is not specified</h2>";
            }
    
            echo "<h2>Payment is made</h2>";
        }
        return;
    }
    echo "failed";
}
?>


<html>

<body>

    <script>
        function post(path, params) {
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", path);

            for (var key in params) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);
                form.appendChild(hiddenField);
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>

    <?php
    if (isset($_POST['btn-submit-payment'])) {
        $_POST['amount'] = $_POST['class-id-name'] * 85;
        $_SESSION['paymentData'] = $_POST;
    ?>
        <script>
            var path = "https://uat.esewa.com.np/epay/main";
            var params = {
                amt: <?php echo $_POST['amount'] ?>,
                psc: 0,
                pdc: 0,
                txAmt: 0,
                tAmt: <?php echo $_POST['amount'] ?>,
                pid: "ee2c3ca1-696b-4cc5-a6be-" + "<?php echo generateRandomString(12) ?>",
                scd: "EPAYTEST",
                su: "http://localhost/Application/parent/code.php?paid=true",
                fu: "http://localhost/Application/parent/code.php?paid=false"
            }
            post(path, params);
            console.log("asd");
        </script>

    <?php
    }
    ?>

</body>

</html>