<?php
require_once('TCPDF-main/tcpdf.php');
require_once('pdf_connect.php'); // Ensure the path is correct

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    public function LoadData($startDate = null, $endDate = null, $status = null) {
        include 'pdf_connect.php';
        
        $query = "SELECT * FROM inkind_inventory";
        $totalsQuery = "SELECT COUNT(DISTINCT donor) AS total_donors, COUNT(*) AS total_donations FROM inkind_inventory"; // New query for totals
        
        // Constructing WHERE clause for both queries based on filters
        $whereClause = "";
        $queryParams = array();
        
        if ($startDate && $endDate) {
            $whereClause .= " WHERE inkind_donate_date BETWEEN ? AND ?";
            array_push($queryParams, $startDate, $endDate);
            if ($status !== null) {
                $whereClause .= " AND inkind_status = ?";
                array_push($queryParams, $status);
            }
        } else if ($status !== null) {
            $whereClause .= " WHERE inkind_status = ?";
            array_push($queryParams, $status);
        }
        
        $stmt = $conn->prepare($query . $whereClause);
        $stmt->bind_param(str_repeat("s", count($queryParams)), ...$queryParams);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        // Calculating totals
        $stmt = $conn->prepare($totalsQuery . $whereClause);
        $stmt->bind_param(str_repeat("s", count($queryParams)), ...$queryParams);
        $stmt->execute();
        $totalsResult = $stmt->get_result();
        $totals = $totalsResult->fetch_assoc();
        
        return ['data' => $data, 'totals' => $totals];
    }    

    // Function to convert status code to string
    public function getStatusString($statusCode) {
        switch ($statusCode) {
            case 0:
                return 'Received';
            case 1:
                return 'Distributed';
            case 2:
                return 'Cancelled';
            default:
                return 'Unknown';
        }
    }

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-12);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        // Draw line above the footer
        $lineWidth = (297 - $this->lMargin - $this->rMargin); // Page width minus margins
        $this->Line($this->lMargin, $this->y, $this->lMargin + $lineWidth, $this->y);
        
        // Page number and "Generated on" date/time
        $footerText = 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' | Generated on: ' . date('Y-m-d H:i');
        $this->Cell(0, 10, $footerText, 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
        $w = array(10, 40, 45, 25, 10, 50, 30, 17, 20, 20);
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
            $status = $this->getStatusString($row["inkind_status"]); // Get status string
            $quantityType = $row["quantity"] . ' ' . $row["quantity_type"];
            $this->Cell($w[0], 6, $row["id"], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row["donor"], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row["email"], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row["phone_number"], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row["event_id"], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row["title"], 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row["type"], 'LR', 0, 'L', $fill);
            $this->Cell($w[7], 6, $quantityType, 'LR', 0, 'L', $fill);
            $this->Cell($w[8], 6, $row["inkind_donate_date"], 'LR', 0, 'L', $fill);
            $this->Cell($w[9], 6, $status, 'LR', 0, 'L', $fill); // Display status string

            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// Get time span and status parameters from request
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

// create new PDF document with landscape orientation
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Serany Foundation Inc.,');
$pdf->SetTitle('In-kind Inventory');
$pdf->SetSubject('In-kind Inventory');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_INKIND_INVENTORY, PDF_HEADER_STRING);

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
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();

// column titles
$header = array('#', 'Name', 'Email', 'Contact #', 'Event #', 'Event Title', 'Type', 'Quantity', 'Date', 'Status');

// Load data with totals
$result = $pdf->LoadData($startDate, $endDate, $status);

// Print table
$pdf->ColoredTable($header, $result['data']);

// Now, print totals at the end
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Ln(3); // Ensure there's a bit of space before the totals
$pdf->Cell(0, 10, 'Total Number of Donors: ' . $result['totals']['total_donors'], 0, 1);
$pdf->Cell(0, 10, 'Total Number of Donations: ' . $result['totals']['total_donations'], 0, 1);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('InkindInventory.pdf', 'I');

//============================================================+
// END OF FILE
//=========================