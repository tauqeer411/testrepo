<?php 
	$postdata = file_get_contents("php://input");
    $data = json_decode($postdata, true);
    print_r($data);
?>