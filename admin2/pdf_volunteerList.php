<?php
require_once('TCPDF-main/tcpdf.php');
require_once('pdf_connect.php'); // Make sure this path is correct

class MYPDF extends TCPDF {
    // Load table data from database with an optional time span and status filtering
    public function LoadData($startDate = null, $endDate = null, $status = null) {
        global $conn; // Use the global connection variable
        
        $query = "SELECT *, COUNT(*) as total_volunteers FROM volunteers";
        $conditions = [];
        $params = [];

        if ($startDate && $endDate) {
            $conditions[] = "event_date BETWEEN ? AND ?";
            $params[] = $startDate;
            $params[] = $endDate;
        }
        
        if ($status !== null) {
            $conditions[] = "volunteer_status = ?";
            $params[] = $status;
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = [];
        $total_volunteers = 0;
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            $total_volunteers = $row['total_volunteers']; // Assuming every row includes the total count
        }
        
        return ['data' => $data, 'total_volunteers' => $total_volunteers];
    }

    // Convert status code to string
    public function getStatusString($statusCode) {
        switch ($statusCode) {
            case 0:
                return 'Pending';
            case 1:
                return 'Confirmed';
            case 2:
                return 'Participated';
            default:
                return 'Unknown';
        }
    }

    // Customize the page footer
    public function Footer() {
        $this->SetY(-12);
        $this->SetFont('helvetica', 'I', 8);
        
        // Draw line above the footer
        $lineWidth = (297 - $this->lMargin - $this->rMargin);
        $this->Line($this->lMargin, $this->y, $this->lMargin + $lineWidth, $this->y);
        
        // Page number and "Generated on" date/time
        $footerText = 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' | Generated on: ' . date('Y-m-d H:i');
        $this->Cell(0, 10, $footerText, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    // Generate the table with colored rows
    public function ColoredTable($header, $data) {
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        
        $w = array(12, 30, 40, 40, 25, 50, 20, 30, 20);
        for($i = 0; $i < count($header); ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = 0;
        
        foreach ($data['data'] as $row) {
            $status = $this->getStatusString($row["volunteer_status"]);
            $name = $row["first_name"] . ' ' . $row["last_name"];
            $this->Cell($w[0], 6, $row["id"], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $name, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row["email"], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row["address"], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row["contact_number"], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row["event"], 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row["event_date"], 'LR', 0, 'L', $fill);
            $this->Cell($w[7], 6, $row["event_venue"], 'LR', 0, 'L', $fill);
            $this->Cell($w[8], 6, $status, 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
        // Display the total number of volunteers at the end
        $this->Ln(3);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 10, 'Total Number of Volunteers: ' . $data['total_volunteers'], 0, 0, 'L');
    }
}

// Get time span and status parameters from request
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Organization');
$pdf->SetTitle('Volunteer Participation List');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_VOLUNTEER_LIST, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 8);
$pdf->AddPage();

$header = array('ID', 'Name', 'Email', 'Address', 'Contact #', 'Event', 'Event Date', 'Event Venue', 'Status');
$result = $pdf->LoadData($startDate, $endDate, $status);

$pdf->ColoredTable($header, $result);

$pdf->Output('VolunteerParticipationList.pdf', 'I');
?>
