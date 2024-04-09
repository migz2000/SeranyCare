<?php
require_once('TCPDF-main/tcpdf.php');
require_once('pdf_connect.php'); // Make sure this path is correct

class MYPDF extends TCPDF {
    public function LoadData($startDate = null, $endDate = null) {
        global $db; // Assuming $db is your PDO object from pdf_connect.php
        
        // Adjust the endDate to include the whole day
        $endDateFormatted = $endDate ? date('Y-m-d', strtotime($endDate)) . ' 23:59:59' : null;
        
        $baseQuery = "SELECT id, event_id, title, donor_name, email, phone_number, amount, donation_date FROM cash_donations";
        $totalsQuery = "SELECT SUM(amount) AS total_amount, COUNT(DISTINCT donor_name) AS total_donors, COUNT(*) AS total_donations FROM cash_donations";
        $whereClause = "";

        if ($startDate && $endDate) {
            $whereClause = " WHERE DATE(donation_date) BETWEEN ? AND DATE(?)";
        }
        
        // Fetching detailed data
        $stmt = $db->prepare($baseQuery . $whereClause);
        $stmt->execute($whereClause ? [$startDate, $endDateFormatted] : []);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Calculating totals within the time span
        $stmt = $db->prepare($totalsQuery . $whereClause);
        $stmt->execute($whereClause ? [$startDate, $endDateFormatted] : []);
        $totals = $stmt->fetch(PDO::FETCH_ASSOC);

        return ['data' => $data, 'totals' => $totals];
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

    public function ColoredTable($header, $data) {
        $w = array(12, 12, 60, 55, 50, 25, 23, 30); // Adjust column widths as necessary
        $this->SetFillColor(255, 0, 0); // Red
        $this->SetTextColor(255); // White
        $this->SetDrawColor(128, 0, 0); // Dark Red
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        for ($i = 0; $i < count($header); ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Data
        $this->SetFillColor(224, 235, 255); // Light blue
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = 0;
        foreach ($data['data'] as $row) {
            $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['event_id'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['title'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['donor_name'], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['email'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['phone_number'], 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row['amount'], 'LR', 0, 'R', $fill);
            $this->Cell($w[7], 6, $row['donation_date'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln();

        // Display totals
        $this->SetFillColor(255, 255, 255); // White background for the totals
        $this->SetFont('', 'B', 10);
        $this->Cell(0, 10, 'Total Donations: ' . $data['totals']['total_amount'], 0, 1, 'L', 1);
        $this->Cell(0, 10, 'Total Number of Donors: ' . $data['totals']['total_donors'], 0, 1, 'L', 1);
        // Added Total Number of Donations
        $this->Cell(0, 10, 'Total Number of Donations: ' . $data['totals']['total_donations'], 0, 1, 'L', 1);
    }
}

$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Organization');
$pdf->SetTitle('Monetary Donations Report');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_MONETARY_DONATIONS, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 8);
$pdf->AddPage();

// URL parameters handling for date filtering
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

// Fetch and display the data
$data = $pdf->LoadData($startDate, $endDate);
$header = array('ID', 'Event ID', 'Title', 'Donor Name', 'Email', 'Phone Number', 'Amount', 'Donation Date');
$pdf->ColoredTable($header, $data);

$pdf->Output('MonetaryDonationsReport.pdf', 'I');
