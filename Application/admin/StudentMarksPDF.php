<?php
//include connection file 
// include "dbconfig.php";


session_start();

if ($_SESSION["login_admin"] == null) {
    header("location: index.php");
} else {

    include_once('../../pdf/fpdf.php');


    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            $student_name = str_replace('"', '', $_GET["name"]);
            $class_name = str_replace('"', '', $_GET["class_name"]);
            $section_name = str_replace(' ', '', $_GET["section_name"]);
            $exam_name = str_replace('"', '', $_GET["exam"]);

            $sname = ucfirst("$student_name");
            $cname = ucfirst("$class_name");
            $csection = ucfirst("$section_name");
            $uexam = ucfirst("$exam_name");

            // Logo
            $this->Image('logo.png', 5, 5, 20, 20);
            $this->SetFont('Arial', 'B', 22);
            
            $this->Cell(276, 20, "$uexam Marks Report", 0, 0, 'C');
            $this->SetFont('Arial', 'B', 18);
            $this->Ln();
            $this->Cell(276, 20, "$sname", 0, 0, 'C');
            
            $this->Ln();
            $this->SetFont("Times", "", 14);

            $this->Cell(276, 10, "Class: $cname $csection", 0, 0, 'C');
            
            $this->Ln(50);
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
            $this->SetFont("Times", "", 12);
            $this->Cell(20, 10, "ID", 1, 0, 'C');
            $this->Cell(20, 10, "Name", 1, 0, 'C');
            // $this->Cell(220, 10, "Status", 1, 0, 'C');
            // $this->Ln();
        }

        function viewTable()
        {
           
            $this->SetFont("Times", "", 10);

            $connection = mysqli_connect("localhost", "root", "", "sms6");



            $class_id = str_replace('"', '', $_GET["class_id"]);
            $section_id = str_replace('"', '', $_GET["section_id"]);
            $exam_name = str_replace('"', '', $_GET["exam"]);
            $student_id = str_replace('"', '', $_GET["id"]);
            $student_name = str_replace('"', '', $_GET["name"]);

            //////////////////////////////////////////////////////////////////////////////////////////////


            // $this->Cell(20, 15, "$status", 'T,B,R,', 0, 'C');
            // $this->Cell(0,0,"",)
            // 0: to the right
            // 1: to the beginning of the next line
            // 2: below


            $subject_id = array();

            $query = "SELECT subject_id, subject_name FROM subject_tb WHERE class_id='$class_id'  ";

            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {

                while ($row = mysqli_fetch_assoc($query_run)) {

                    $subject_id[] = $row["subject_id"];
                    $subject_name = ucfirst($row["subject_name"]);

                    // print_r($subject_id) ;



                    $this->Cell(25, 10, "$subject_name", 1, 0, 'C');
                }
            }


            ////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////
            $this->Ln();

            $this->Cell(20, 10, "$student_id", 1, 0, 'C');
            $this->Cell(20, 10, "$student_name", 1, 0, 'C');


            foreach ($subject_id as $id) {


                $query_m = "SELECT * FROM marks_table WHERE class_id='$class_id' and section_id='$section_id' and exam_name='$exam_name' and student_id='$student_id' and subject_id='$id' ";

                $query_run_m = mysqli_query($connection, $query_m);

                if (mysqli_num_rows($query_run_m) > 0) {

                    $row_m = mysqli_fetch_array($query_run_m); {

                        $marks = $row_m["marks"];
                        // echo "<td>$marks</td>";
                        $this->Cell(25, 10, "$marks", 1, 0, 'C');
                    }
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
