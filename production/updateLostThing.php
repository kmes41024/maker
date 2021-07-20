<?php
	header("content-type: text/html; charset=utf-8");

	$id = $_POST["id"];
	$building = $_POST["building"];
    $box_id = $_POST["box_id"];

	$query = "UPDATE `lostthing` SET `building` = '".$building."', `box` = '".$box_id."' WHERE `lostthing`.`id` = ".$id;
	
	if ( !( $database = mysqli_connect( "localhost", "maker", "" ) ) )				#( "主機", "使用者", "密碼" )
	   die( "Could not connect to database </body></html>" );
   
	mysqli_query($database, "set names 'utf8'");							
	mysqli_query($database,"set character_set_client=utf8");
	mysqli_query($database,"set character_set_results=utf8");	
   
	if ( !mysqli_select_db($database,"maker" ) )				
	   die( "Could not open database </body></html>" );
	if ( !( $result = mysqli_query($database, $query) ) )
	{
	   print( "<p>Could not execute query!</p>" );
	   die( mysqli_error() . "</body></html>" );
	}

	if ($database->query($query) === TRUE) 
	{
		echo "success";						
	} 
	else 
	{
		echo "error";
	}
   
	mysqli_close( $database );	 
?>