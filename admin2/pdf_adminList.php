<?php
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData() {
        // Read file lines
        include 'pdf_connect.php';
        $select = "SELECT * FROM table_admin";
        $query = mysqli_query($conn, $select);
        return $query;
    }

    // Function to convert status code to string
    public function getStatusString($statusCode) {
        switch ($statusCode) {
            case 0:
                return 'Admin';
            case 1:
                return 'Superadmin';
            default:
                return 'Unknown';
        }
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(15, 60, 40, 65, 30, 30, 27); // Modified width for the Name column
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $status = $this->getStatusString($row["role"]);
            // Concatenate first name and last name
            $fullName = $row["first_name"] . ' ' . $row["last_name"];
            $this->Cell($w[0], 6, $row["id"], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $fullName, 'LR', 0, 'L', $fill); // Use concatenated full name
            $this->Cell($w[2], 6, $row["username"], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row["email"], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row["contact_number"], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row["date"], 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $status, 'LR', 0, 'L', $fill); // Display status string

            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document with landscape orientation
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Serany Foundation Inc.,');
$pdf->SetTitle('Admin List');
$pdf->SetSubject('Admin List');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_ADMIN_LIST, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('#', 'Name', 'Username', 'Email', 'Contact #', 'Date', 'Status');

// data loading
$data = $pdf->LoadData();

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('AdminList.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
