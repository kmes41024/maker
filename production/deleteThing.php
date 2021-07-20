<?php
	header("content-type: text/html; charset=utf-8");	
	$thingID = $_POST["thingID"];

	$query = "DELETE FROM `lostthing` WHERE `lostthing`.`id` = ".$thingID;

	if ( !( $database = mysqli_connect( "localhost", "maker", "" ) ) )			#( "主機", "使用者", "密碼" )
		die( "Could not connect to database </body></html>" );
	
	mysqli_query($database, "set names 'utf8'");							
	mysqli_query($database,"set character_set_client=utf8");
	mysqli_query($database,"set character_set_results=utf8");
	
	if ( !mysqli_select_db($database,"maker" ) )			
		die( "Could not opendatabase </body></html>" );

    if ($database->query($query) === TRUE) 
    {
        echo "OK";		
    } 
    else 
    {
        echo "no OK";
    }

    mysqli_close( $database );
?>