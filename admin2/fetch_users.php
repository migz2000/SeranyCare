<?php 
include "../connect.php";

// Get the parameters sent by DataTables
$start = $_POST['start'] ?? 0; // Start index of records to fetch
$length = $_POST['length'] ?? 10; // Number of records to fetch
$draw = $_POST['draw'] ?? 1; // Draw counter
$searchValue = $_POST['search']['value'] ?? ''; // Search value
$orderByColumnIndex = $_POST['order'][0]['column'] ?? 0; // Index of the column to order by
$orderByColumnName = $_POST['columns'][$orderByColumnIndex]['data'] ?? ''; // Name of the column to order by
$orderByDirection = $_POST['order'][0]['dir'] ?? 'asc'; // Order direction

// Prepare the SQL query
$sql = "SELECT id, first_name, last_name, email, address, contact_number, status FROM login";

// Add search condition if search value is provided
if (!empty($searchValue)) {
    $sql .= " WHERE first_name LIKE '%$searchValue%' OR last_name LIKE '%$searchValue%' OR email LIKE '%$searchValue%' OR address LIKE '%$searchValue%' OR contact_number LIKE '%$searchValue%' OR status LIKE '%$searchValue%'";
}

// Add order by clause
if (!empty($orderByColumnName)) {
    $sql .= " ORDER BY $orderByColumnName $orderByDirection";
}

// Add limit and offset
$sql .= " LIMIT $start, $length";

// Execute the query
$result = $conn->query($sql);

// Fetch total records count (without pagination)
$totalRecordsQuery = $conn->query("SELECT COUNT(*) as count FROM login");
$totalRecords = $totalRecordsQuery->fetch_assoc()['count'];

// Prepare data for DataTables response
$data = [];
while ($row = $result->fetch_assoc()) {
    // Add status with appropriate color based on status value
    $statusText = '';
    $statusColor = '';
    switch ($row['status']) {
        case 0:
            $statusText = '<span style="color: #EE9626;">Pending</span>';
            break;
        case 1:
            $statusText = '<span style="color: green;">Verified</span>';
            break;
        case 2:
            $statusText = '<span style="color: red;">Disabled</span>';
            break;
        default:
            $statusText = 'Unknown';
            break;
    }
    $row['status'] = $statusText;
    
    $data[] = $row;
}

// Return response in the format expected by DataTables
echo json_encode([
    'draw' => intval($draw),
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalRecords,
    'data' => $data
]);
?>
