<?php

$db_host       = "localhost";
$db_user       = "root";
$db_pass       = "";
$db_database   = "serany_db";

// Create a PDO connection
try {
    $db = new PDO("mysql:host=".$db_host.";dbname=".$db_database, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Create a MySQLi connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Utility function for displaying messages
if (!class_exists('App')) {
    class App {   
        public static function message($type, $message, $code='') {
            if ($type == 'error') {
                return '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               '.$message.' <a class="alert-link" href="#">'.$code.'</a>.
                            </div>';
            } else {
                 return '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               '.$message.' <a class="alert-link" href="#">'.$code.'</a>.
                            </div>';
            }
        }
    }
}

// Function to safely retrieve GET parameters
if (!function_exists('get')) {
    function get($val){
        return @$_GET[$val];
    }
}
?>
