<?php
//include connection file 
// include "dbconfig.php";


session_start();

if ($_SESSION["login_teacher"] == null) {
    header("location: index.php");
} else {

    include_once('../../pdf/fpdf.php');


    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            $class_name = str_replace('"', '', $_GET["class_name"]);
            $section_name = str_replace(' ', '', $_GET["section_name"]);
            $exam_name = str_replace('"', '', $_GET["exam"]);
            $subject_name = str_replace('"', '', $_GET["subject_name"]);
            $teacher_name = str_replace('"', '', $_GET["teacher_name"]);

            $cname = ucfirst("$class_name");
            $csection = ucfirst("$section_name");
            $uexam = ucfirst("$exam_name");
            $usubject = ucfirst("$subject_name");
            $uteacher = ucfirst("$teacher_name");

            // Logo
            $this->Image('logo.png', 5, 5, 20, 20);
            $this->SetFont('Arial', 'B', 18);
            // Move to the right
            $this->Cell(276, 20, "$uexam Marks Report", 0, 0, 'C');
            // Title
            $this->Ln();
            $this->SetFont("Times", "", 14);


            $this->Cell(276, 10, "Class: $cname $csection", 0, 0, 'C');

            $this->Ln();

            $this->Cell(276, 10, "Subject: $usubject", 0, 0, 'C');
            // Line break
            $this->Ln();

            $this->Cell(276, 10, "Teacher: $uteacher", 0, 0, 'C');

            $this->Ln(20);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }

        function headerTable()
        {
            $subject_name = str_replace('"', '', $_GET["subject_name"]);


            $usubject = ucfirst("$subject_name");

            $this->SetFont("Times", "", 12);
            $this->Cell(20, 10, "ID", 1, 0, 'C');
            $this->Cell(20, 10, "Name", 1, 0, 'C');
            $this->Cell(20, 10, "$usubject", 1, 0, 'C');
            $this->Ln();
        }

        function viewTable()
        {
            $this->SetFont("Times", "", 10);

            $connection = mysqli_connect("localhost", "root", "", "sms6");



            $class_id = str_replace('"', '', $_GET["class_id"]);
            $section_id = str_replace('"', '', $_GET["section_id"]);
            $exam_name = str_replace('"', '', $_GET["exam"]);
            $subject_id = str_replace('"', '', $_GET["subject_id"]);


            //////////////////////////////////////////////////////////////////////////////////////////////


            // $this->Cell(20, 15, "$status", 'T,B,R,', 0, 'C');
            // $this->Cell(0,0,"",)
            // 0: to the right
            // 1: to the beginning of the next line
            // 2: below

            $query = "SELECT * FROM marks_table where subject_id='$subject_id' and class_id='$class_id' and section_id='$section_id' and exam_name='$exam_name'";
            $query_run = mysqli_query($connection, $query);

            $counter = 0;
            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {

                    $std_id = $row["student_id"];
                    $marks = $row["marks"];


                    $query3 = "SELECT student_name from student_tb where student_id ='$std_id'";
                    $query_run3 = mysqli_query($connection, $query3);
                    $row3 = mysqli_fetch_assoc($query_run3);
                    $std_name = $row3["student_name"];

                    $this->Cell(20, 10, "$std_id", 1, 0, 'C');
                    $this->Cell(20, 10, "$std_name", 1, 0, 'C');
                    $this->Cell(20, 10, "$marks", 1, 1, 'C');
                }
            }
        }
    }






    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4', 0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();
}
