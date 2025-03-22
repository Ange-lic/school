<?php

session_start();

if ($_SESSION["login_admin"] == null) {
    header("location: index.php");
    exit();
}

$connection = mysqli_connect("localhost", "root", "", "sms6");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to execute a query and return the result
function executeQuery($connection, $query) {
    if (mysqli_query($connection, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($connection);
        return false;
    }
}

// Function to fetch a single row
function fetchRow($result) {
    return mysqli_fetch_assoc($result);
}

// Delete admin record
if (isset($_POST["deleteid"])) {
    $id = $_POST["deleteid"];
    $un = $_POST["u_id"];

    executeQuery($connection, "DELETE FROM admin_tb WHERE admin_id='$id'");
    executeQuery($connection, "DELETE FROM login_tb WHERE id='$un'");
}

// Delete student record
if (isset($_POST["delete_std_id"])) {
    $id = $_POST["delete_std_id"];
    $p_id = $_POST["p_id"];
    $un = $_POST["u_id"];

    executeQuery($connection, "DELETE FROM marks_table WHERE student_id='$id'");
    executeQuery($connection, "DELETE FROM attendance_tb WHERE student_id='$id'");
    executeQuery($connection, "DELETE FROM student_tb WHERE student_id='$id'");

    $query = "SELECT username FROM parent_tb WHERE parent_id='$p_id'";
    $query_run = mysqli_query($connection, $query);
    $row = fetchRow($query_run);
    if ($row && isset($row["username"])) {
        $username = $row["username"];
        $query1 = "SELECT id FROM login_tb WHERE username='$username'";
        $query_run1 = mysqli_query($connection, $query1);
        $row1 = fetchRow($query_run1);
        if ($row1 && isset($row1["id"])) {
            $p_un = $row1["id"];
            executeQuery($connection, "DELETE FROM parent_tb WHERE parent_id='$p_id'");
            executeQuery($connection, "DELETE FROM login_tb WHERE id='$p_un'");
        }
    }
    executeQuery($connection, "DELETE FROM login_tb WHERE id='$un'");
}

// Delete teacher record
if (isset($_POST["delete_t_id"])) {
    $id = $_POST["delete_t_id"];
    $un = $_POST["u_id"];

    executeQuery($connection, "DELETE FROM teacher_tb WHERE teacher_id='$id'");
    executeQuery($connection, "DELETE FROM login_tb WHERE id='$un'");
}

// Delete section record
if (isset($_POST["delete_sec_id"])) {
    $id = $_POST["delete_sec_id"];
    executeQuery($connection, "DELETE FROM section WHERE section_id='$id'");
}

// Delete subject record
if (isset($_POST["delete_sub_id"])) {
    $id = $_POST["delete_sub_id"];
    executeQuery($connection, "DELETE FROM subject_tb WHERE subject_id='$id'");
}

// Delete class record
if (isset($_POST["delete_class_id"])) {
    $id = $_POST["delete_class_id"];
    executeQuery($connection, "DELETE FROM class_tb WHERE class_id='$id'");
}

// Delete news record
if (isset($_POST["delete_news_id"])) {
    $id = $_POST["delete_news_id"];
    executeQuery($connection, "DELETE FROM news WHERE id='$id'");
}

// Delete fee record
if (isset($_POST["delete_fee_id"])) {
    $id = $_POST["delete_fee_id"];
    executeQuery($connection, "DELETE FROM fee_tb WHERE fee_id='$id'");
}

// Fetch admin data
if (isset($_POST['id']) && $_POST['id'] != "") {
    $admin_id = $_POST['id'];
    $query = "SELECT * FROM admin_tb WHERE admin_id='$admin_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch student data
if (isset($_POST['s_id']) && $_POST['s_id'] != "") {
    $student_id = $_POST['s_id'];
    $query = "SELECT * FROM student_tb WHERE student_id='$student_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch teacher data
if (isset($_POST['t_id']) && $_POST['t_id'] != "") {
    $teacher_id = $_POST['t_id'];
    $query = "SELECT * FROM teacher_tb WHERE teacher_id='$teacher_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch parent data
if (isset($_POST['p_id']) && $_POST['p_id'] != "") {
    $parent_id = $_POST['p_id'];
    $query = "SELECT * FROM parent_tb WHERE parent_id='$parent_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch section data
if (isset($_POST['sec_id']) && $_POST['sec_id'] != "") {
    $section_id = $_POST['sec_id'];
    $query = "SELECT * FROM section WHERE section_id='$section_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch class data
if (isset($_POST['cl_id']) && $_POST['cl_id'] != "") {
    $class_id = $_POST['cl_id'];
    $query = "SELECT class_name, class_price FROM class_tb WHERE class_id='$class_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch subject data
if (isset($_POST['get_sub_id']) && $_POST['get_sub_id'] != "") {
    $subject_id = $_POST['get_sub_id'];
    $query = "SELECT * FROM subject_tb WHERE subject_id='$subject_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Fetch fee data
if (isset($_POST['fee_id']) && $_POST['fee_id'] != "") {
    $fee_id = $_POST['fee_id'];
    $query = "SELECT * FROM fee_tb WHERE fee_id='$fee_id'";
    $result = mysqli_query($connection, $query);
    $response = mysqli_num_rows($result) > 0 ? fetchRow($result) : ['status' => 200, 'message' => "Data not found!"];
    echo json_encode($response);
}

// Update admin table
if (isset($_POST['admin_uid'])) {
    $admin_id = $_POST['admin_uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_id = $_POST["user_id"];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE admin_tb SET adminname=?, admin_email=?, admin_phone=?, username=?, password=? WHERE admin_id=?");
    $stmt->bind_param("ssssss", $name, $email, $phone, $username, $password, $admin_id);
    $stmt->execute();
    $stmt->close();

    executeQuery($connection, "DELETE FROM login_tb WHERE id='$user_id'");
}

// Update student table
if (isset($_POST['std_id'])) {
    $student_id = $_POST['std_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $rel = $_POST['rel'];
    $class_id = $_POST['class_id'];
    $section_id = $_POST['section_id'];
    $parent_id = $_POST['parent_id'];
    $parent = $_POST['parent'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_id = $_POST["user_id"];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE student_tb SET student_name=?, gender=?, religion=?, class_id=?, section_id=?, parent_name=?, parent_phone=?, parent_email=?, username=?, password=? WHERE student_id=?");
    $stmt->bind_param("sssssssssss", $name, $gender, $rel, $class_id, $section_id, $parent, $phone, $email, $username, $password, $student_id);
    $stmt->execute();
    $stmt->close();

    executeQuery($connection, "UPDATE parent_tb SET name='$parent', phone='$phone', email='$email' WHERE parent_id='$parent_id'");
    executeQuery($connection, "DELETE FROM login_tb WHERE id='$user_id'");

    header("Location:AddStudent.php");
    exit();
}

// Update teacher table
if (isset($_POST['teach_id'])) {
    $teacher_id = $_POST['teach_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_id = $_POST["user_id"];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE teacher_tb SET teacher_name=?, email=?, phone=?, username=?, password=? WHERE teacher_id=?");
    $stmt->bind_param("ssssis", $name, $email, $phone, $username, $password, $teacher_id);
    $stmt->execute();
    $stmt->close();

    executeQuery($connection, "DELETE FROM login_tb WHERE id='$user_id'");
    header("Location:AddTeacher.php");
    exit();
}

// Update section table
if (isset($_POST['sec_id'])) {
    $section_id = $_POST['sec_id'];
    $section_name = $_POST['sec_name'];
    $class_id = $_POST['class_name'];
    $teacher_id = $_POST['teacher_name'];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE section SET section_name=?, class_id=?, teacher_id=? WHERE section_id=?");
    $stmt->bind_param("sssi", $section_name, $class_id, $teacher_id, $section_id);
    $stmt->execute();
    $stmt->close();
}

// Update class
if (isset($_POST['class_hid'])) {
    $class_id = $_POST['class_hid'];
    $class_name = $_POST['classn'];
    $class_price = $_POST['classp'];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE class_tb SET class_name=?, class_price=? WHERE class_id=?");
    $stmt->bind_param("ssi", $class_name, $class_price, $class_id);
    $stmt->execute();
    $stmt->close();

    header("Location:manageClasses.php");
    exit();
}

// Update subject
if (isset($_POST['sub_id'])) {
    $subject_id = $_POST['sub_id'];
    $subject_name = $_POST['sub_name'];
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST['teacher_id'];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE subject_tb SET subject_name=?, class_id=?, teacher_id=? WHERE subject_id=?");
    $stmt->bind_param("sssi", $subject_name, $class_id, $teacher_id, $subject_id);
    $stmt->execute();
    $stmt->close();

    header("Location:manageClasses.php");
    exit();
}

// Update fee table
if (isset($_POST['fee_i_id'])) {
    $fee_i_id = $_POST['fee_i_id'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];
    $month = $_POST['month'];
    $date = $_POST['date'];

    // Use prepared statements for security
    $stmt = $connection->prepare("UPDATE fee_tb SET amount=?, status=?, month=?, date=? WHERE fee_id=?");
    $stmt->bind_param("ssssi", $amount, $status, $month, $date, $fee_i_id);
    $stmt->execute();
    $stmt->close();

    header("Location:Fees.php");
    exit();
}

// Add admin
if (isset($_POST["btn-add-admin"])) {
    $admin_name = $_POST["admin-name"];
    $email = $_POST["email-name"];
    $phone = $_POST["phone-name"];
    $username = $_POST["user-name"];
    $password = $_POST["password-name"];

    $query = "SELECT * FROM login_tb WHERE username='$username'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) == 0) {
        // Use prepared statements for security
        $stmt = $connection->prepare("INSERT INTO login_tb(username, password) VALUES(?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();

        $stmt = $connection->prepare("INSERT INTO admin_tb (adminname, admin_email, admin_phone, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $admin_name, $email, $phone, $username, $password);
        $stmt->execute();
        $stmt->close();

        header("Location:AddAdmin.php");
        exit();
    } else {
        echo "Username is not unique";
    }
}

// Add student
if (isset($_POST["btn-add-std"])) {
    $student_name = $_POST["student-name"];
    $gender = $_POST["gender-name"];
    $religion = $_POST["religion-name"];
    $class_id = $_POST["class-name"];
    $section_name = $_POST["section-name"];
    $parent_name = $_POST["parent-name"];
    $parent_phone = $_POST["parent-phone-name"];
    $parent_email = $_POST["parent-email-name"];
    $username = $_POST["user-name"];
    $password = $_POST["password-name"];

    // Check if username is unique
    $query = "SELECT * FROM login_tb WHERE username='$username'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) == 0) {
        // Fetch section ID
        $query = "SELECT section_id FROM section WHERE section_name='$section_name' AND class_id='$class_id'";
        $query_run = mysqli_query($connection, $query);
        $result = mysqli_fetch_assoc($query_run);
        if ($result) {
            $section_id = $result['section_id'];

            // Insert into login_tb
            $stmt = $connection->prepare("INSERT INTO login_tb(username, password) VALUES(?, ?)");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->close();

            // Insert into parent_tb
            $username1 = $username . "p";
            $stmt = $connection->prepare("INSERT INTO login_tb(username, password) VALUES(?, ?)");
            $stmt->bind_param("ss", $username1, $password);
            $stmt->execute();
            $stmt->close();

            // Insert into parent_tb
            $count_query = "SELECT COUNT(*) as total FROM parent_tb";
            $query_run = mysqli_query($connection, $count_query);
            $count_id = mysqli_fetch_assoc($query_run);
            $parent_id = $count_id['total'] == 0 ? 0 : $count_id['total'] + rand(1, 100);

            $stmt = $connection->prepare("INSERT INTO parent_tb (parent_id, name, phone, email, username, password) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $parent_id, $parent_name, $parent_phone, $parent_email, $username1, $password);
            $stmt->execute();
            $stmt->close();

            // Insert into student_tb
            $stmt = $connection->prepare("INSERT INTO student_tb (student_name, gender, religion, class_id, section_id, parent_id, parent_name, parent_phone, parent_email, username, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssissssss", $student_name, $gender, $religion, $class_id, $section_id, $parent_id, $parent_name, $parent_phone, $parent_email, $username, $password);
            $stmt->execute();
            $stmt->close();

            header("location: AddStudent.php");
            exit();
        } else {
            echo "<h1>Section is not created</h1>";
        }
    } else {
        echo "Username is not unique";
    }
}

// Add teacher
if (isset($_POST["btn-add-teacher"])) {
    $name = $_POST["teacher-name"];
    $email = $_POST["email-name"];
    $phone = $_POST["phone-name"];
    $username = $_POST["user-name"];
    $password = $_POST["password-name"];

    $query = "SELECT * FROM login_tb WHERE username='$username'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) == 0) {
        // Use prepared statements for security
        $stmt = $connection->prepare("INSERT INTO login_tb(username, password) VALUES(?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();

        $stmt = $connection->prepare("INSERT INTO teacher_tb(teacher_name, email, phone, username, password) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $username, $password);
        $stmt->execute();
        $stmt->close();

        header("location: AddTeacher.php");
        exit();
    } else {
        echo "Username is not unique";
    }
}

// Add class
if (isset($_POST["btn-add-class"])) {
    $class = $_POST["class-name"];
    $price = $_POST["class-price"];

    // Use prepared statements for security
    $stmt = $connection->prepare("INSERT INTO class_tb (class_name, class_price) VALUES(?, ?)");
    $stmt->bind_param("si", $class, $price);
    $stmt->execute();
    $stmt->close();

    header("location: manageClasses.php");
    exit();
}

// Add section
if (isset($_POST["btn-add-section"])) {
    $section_id = $_POST["section-name"];
    $class_id = $_POST["class-name"];
    $teacher_id = $_POST["teacher-name"];

    // Fetch corresponding class name
    $query = "SELECT class_name FROM class_tb WHERE class_id='$class_id'";
    $query_run = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($query_run);
    $class_name = $result["class_name"];

    // Fetch corresponding teacher name
    $query = "SELECT teacher_name FROM teacher_tb WHERE teacher_id='$teacher_id'";
    $query_run = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($query_run);
    $teacher_name = $result["teacher_name"];

    // Check if class and section already exist
    $query = "SELECT class_id, section_id FROM section WHERE class_id='$class_id' AND section_id='$section_id'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        echo "Class and section are already present. Class ID: $class_id, Section ID: $section_id";
    } else {
        // Determine section name based on section ID
        $section_name = chr(65 + $section_id); // Convert number to letter (A, B, C, ...)

        // Insert into section
        $stmt = $connection->prepare("INSERT INTO section (section_id, section_name, class_id, teacher_id) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("issi", $section_id, $section_name, $class_id, $teacher_id);
        $stmt->execute();
        $stmt->close();

        header("location: manageSection.php");
        exit();
    }
}

// Add subject
if (isset($_POST["btn-add-subject"])) {
    $subject = $_POST["subject-name"];
    $class_id = $_POST["class-name"];
    $teacher_id = $_POST["teacher-name"];

    $query = "SELECT subject_name FROM subject_tb WHERE subject_name='$subject'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        echo "<h2>Subject already assigned</h2>";
    } else {
        // Use prepared statements for security
        $stmt = $connection->prepare("INSERT INTO subject_tb(subject_name, class_id, teacher_id) VALUES(?, ?, ?)");
        $stmt->bind_param("ssi", $subject, $class_id, $teacher_id);
        $stmt->execute();
        $stmt->close();

        header("Location: manageSubject.php?subjectAdded");
        exit();
    }
}

// Make payment fee
if (isset($_POST["btn-submit-payment"])) {
    $class_id = $_POST["class-id-name"];
    $section_id = $_POST["section-id-name"];
    $title = $_POST["title-name"];
    $desc = $_POST["desc-name"];
    $month = $_POST["month-name"];
    $payment = $_POST["payment-name"];
    $status = $_POST["status-name"];
    $date = $_POST["date-name"];

    // Check if any student is selected
    if (isset($_POST["students-name"])) {
        foreach ($_POST['students-name'] as $value) {
            $query = "SELECT * FROM student_tb WHERE student_id='$value'";
            $query_run = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($query_run)) {
                $student_id = $row["student_id"];
                $student_name = $row["student_name"];

                // Use prepared statements for security
                $stmt = $connection->prepare("INSERT INTO fee_tb (student_id, class_id, section_id, amount, status, month, date) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iisisss", $student_id, $class_id, $section_id, $payment, $status, $month, $date);
                $stmt->execute();
                $stmt->close();
            }
        }
    } else {
        echo "<h2>No student specified</h2>";
    }

    echo "<h2>Payment is made</h2>";
}

mysqli_close($connection);
?>