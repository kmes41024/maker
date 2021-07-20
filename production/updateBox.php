<?php
	header("content-type: text/html; charset=utf-8");

	$box_id = $_POST["box_id"];
	$value = $_POST['value'];

	$query = "UPDATE `box` SET `full` = '".$value."' WHERE `box`.`box_id` = '".$box_id."'";
	
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