<?php
    $lostThing = $_POST["lostThing"];

    $query = "SELECT * FROM `brand` WHERE `thing` = '".$lostThing."'";
    
    if ( !( $database = mysqli_connect( "localhost", "maker", "" ) ) )
        die( "Could not connect to database </body></html>" );
    if ( !mysqli_select_db($database,"maker" ) )
        die( "Could not open maker database </body></html>" );
    if ( !( $result = mysqli_query($database, $query) ) )
    {
        print( "<p>Could not execute query!</p>" );
        die( mysqli_error() . "</body></html>" );
    }
    
    echo("<option id = 'brand'>品牌</option>");
    while($row = $result->fetch_assoc())		
    {
        echo("<option id = '".$row['id']."'>".$row['brand']."</option>");
    }

    mysqli_close( $database );
?>