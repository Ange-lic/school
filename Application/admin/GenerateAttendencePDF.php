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
            $y = str_replace('"', '', $_GET["year"]);
            $year = str_replace(' ', '', $y);
            $month = str_replace('"', '', $_GET["month"]);

            if ($month == 1) {
                $month = "January";
            } else if ($month == 2) {
                $month = "February";
            } else if ($month == 3) {
                $month = "March";
            } else if ($month == 4) {
                $month = "April";
            } else if ($month == 5) {
                $month = "May";
            } else if ($month == 6) {
                $month = "June";
            } else if ($month == 7) {
                $month = "July";
            } else if ($month == 8) {
                $month = "August";
            } else if ($month == 9) {
                $month = "September";
            } else if ($month == 10) {
                $month = "October";
            } else if ($month == 11) {
                $month = "November";
            } else if ($month == 12) {
                $month = "December";
            }
            // Logo
            $this->Image('../../images/logo.png', 5, 5, 20, 20);
            $this->SetFont('Arial', 'B', 13);
            // Move to the right
            $this->Cell(276, 20, 'Student Attendance Report', 0, 0, 'C');
            // Title
            $this->Ln();
            $this->SetFont("Times", "", 12);
            $this->Cell(276, 10, "$month, $year", 0, 0, 'C');
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
            // $this->Cell(220, 10, "Status", 1, 0, 'C');
            // $this->Ln();
        }

        function viewTable()
        {
            $this->SetFont("Times", "", 10);

            $connection = mysqli_connect("localhost", "root", "", "sms6");



            $class_id = str_replace('"', '', $_GET["class"]);
            $section_id = str_replace('"', '', $_GET["section"]);

            $y = str_replace('"', '', $_GET["year"]);
            $year = str_replace(' ', '', $y);
            $month = str_replace('"', '', $_GET["month"]);


            $date = "$year-$month";


            $query = "SELECT section_name FROM section WHERE class_id='$class_id'  ";

            $query_run = mysqli_query($connection, $query);


            if (mysqli_num_rows($query_run) > 0) {

                while ($row = mysqli_fetch_assoc($query_run)) {
                    # code...

                    $query = "SELECT * FROM student_tb WHERE class_id='$class_id' AND section_id='$section_id' ";

                    $query_run = mysqli_query($connection, $query);


                    $stdArry = array();

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        # code...

                        $stdArry[] = $row;
                    }




                    $query22 = "SELECT * FROM attendance_tb WHERE date LIKE '$date%'";
                    $query_run22 = mysqli_query($connection, $query22);

                    $next = "";
                    while ($row22 = mysqli_fetch_assoc($query_run22)) {


                        $date1 = $row22["date"];
                        if ($next != $date1) {

                            $this->Cell(20, 10, "$date1", 'T,B,R,L', 0, 'C');

                            $next = $date1;
                        }
                        // $this->Cell(0,0,"",)
                        // 0: to the right
                        // 1: to the beginning of the next line
                        // 2: below

                    }
                    $this->Cell(30, 10, "Total", '1', 0, 'C');

                    $this->Ln();

                    foreach ($stdArry as $id) {
                        $present = 0;
                        $absent = 0;
                        $leave = 0;


                        $student_id = "$id[student_id]";
                        $student_name = ucfirst("$id[student_name]");


                        $this->Cell(20, 15, "$student_id", 1, 0, 'C');
                        $this->Cell(20, 15, "$student_name", 1, 0, 'C');



                        $query22 = "SELECT * FROM attendance_tb WHERE student_id='$id[student_id]' AND date LIKE '$date%'";
                        $query_run22 = mysqli_query($connection, $query22);

                        while ($row22 = mysqli_fetch_assoc($query_run22)) {


                            $status = $row22["status"];
                            $this->Cell(20, 15, "$status", 'T,B,R,', 0, 'C');
                            if ($status == "Present") {
                                $present++;
                            } else if ($status == "Absent") {
                                $absent++;
                            } else {
                                $leave++;
                            }
                            // $this->Cell(0,0,"",)
                            // 0: to the right
                            // 1: to the beginning of the next line
                            // 2: below

                        }

                        $this->Cell(30, 15, "P=$present, A=$absent, L=$leave", '1', 0, 'C');
                        $this->Ln();
                    }

                    $this->Ln();
                }
            } else {

                echo "No record found<br> $class_id-$section_id-$date-------";
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
