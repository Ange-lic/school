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
            $class_name = str_replace('"', '', $_GET["class_name"]);
            $section_name = str_replace(' ', '', $_GET["section_name"]);
            $month = str_replace(' ', '', $_GET["month"]);

            $cname = ucfirst("$class_name");
            $csection = ucfirst("$section_name");
            $cmonth = ucfirst("$month");

            // Logo
            $this->Image('../../images/logo.png', 5, 5, 20, 20);
            $this->SetFont('Arial', 'B', 18);
            // Move to the right
            $this->Cell(276, 20, "Student Fee Report", 0, 0, 'C');
            // Title
            $this->Ln();
            $this->SetFont("Times", "", 14);

            $this->Cell(276, 10, "Class: $cname $csection", 0, 1, 'C');

            $this->Cell(276, 10, "Month: $month", 0, 0, 'C');

            // Line break
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
            $this->SetFont("Times", "", 12);
            $this->Cell(20, 10, "ID", 1, 0, 'C');
            $this->Cell(20, 10, "Name", 1, 0, 'C');
            $this->Cell(20, 10, "Fee Paid", 1, 0, 'C');
            $this->Cell(20, 10, "Date", 1, 0, 'C');
            // $this->Cell(220, 10, "Status", 1, 0, 'C');
            $this->Ln();
        }

        function viewTable()
        {
            $this->SetFont("Times", "", 10);

            $connection = mysqli_connect("localhost", "root", "", "sms6");



            $class_id = str_replace('"', '', $_GET["class_id"]);
            $section_id = str_replace('"', '', $_GET["section_id"]);
            $month = str_replace(' ', '', $_GET["month"]);

            //////////////////////////////////////////////////////////////////////////////////////////////


            // $this->Cell(20, 15, "$status", 'T,B,R,', 0, 'C');
            // $this->Cell(0,0,"",)
            // 0: to the right
            // 1: to the beginning of the next line
            // 2: below




            $query = "SELECT * FROM student_tb
                
                                WHERE class_id =$class_id and section_id=$section_id ";

            $query_run = mysqli_query($connection, $query);


            if (mysqli_num_rows($query_run) > 0) {

                while ($row = mysqli_fetch_array($query_run)) {

                    $student_id = $row["student_id"];
                    $student_name = ucfirst($row["student_name"]);


                    $query1 = "SELECT * FROM fee_tb
                
                                                WHERE student_id=$student_id and month='$month'";

                    $query_run1 = mysqli_query($connection, $query1);

                    if (mysqli_num_rows($query_run1) > 0) {

                        while ($row1 = mysqli_fetch_array($query_run1)) {

                            $std_id = $row1["student_id"];
                            $amount = $row1["amount"];

                            $date = $row1["date"];

                            $stdQu = "SELECT student_name FROM student_tb where student_id='$std_id'";
                            $stdRes = mysqli_query($connection, $stdQu);
                            $student = mysqli_fetch_assoc($stdRes);
                            $std_name = ucfirst($row["student_name"]);

                            $this->Cell(20, 10, "$std_id", 1, 0, 'C');
                            $this->Cell(20, 10, "$std_name", 1, 0, 'C');
                            $this->Cell(20, 10, "$amount", 1, 0, 'C');
                            $this->Cell(20, 10, "$date", 1, 1, 'C');
                        }
                    } else {


                        $this->Cell(20, 10, "$student_id", 1, 0, 'C');
                        $this->Cell(20, 10, "$student_name", 1, 0, 'C');
                        $this->Cell(20, 10, "Nill", 1, 0, 'C');
                        $this->Cell(20, 10, "Nill", 1, 1, 'C');
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
