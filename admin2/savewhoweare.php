<?php 


include '../connect.php';
$body = $_POST['body'];

//$query = ORM ::for_table('tbl_about')->create();
//$query->body=$body;
//$query->save();


$query = ORM::for_table('tbl_about')->find_one(4);

// The following two forms are equivalent
//$query = $body->get('body');
$query ->body = $body;
$query ->save();
if($query->save()){
      header("location:addwhoweare.php?success=true");
        }else{
            header("location:addwhoweare.php?failed=true");
        }


?>

