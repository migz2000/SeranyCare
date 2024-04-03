<?php


	include'../connect.php';
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM news WHERE id= :post_id");
	$result->bindParam(':post_id', $id);
       if($result->execute()){
      header("location:allnews.php?success=true");
        }else{
            header("location:allnews.php?failed=true");
        } 
		
?>