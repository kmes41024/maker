<?php
    $thing = $_POST["thing"];
    if($_POST["color"] != '顏色')
        $color = $_POST["color"];
    else
        $color = "";
    
    if($_POST["brand"] != "品牌")
        $brand = $_POST["brand"];
    else
        $brand = "";
    $idNumber = $_POST["idNumber"];

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $length = 5;
    $randomString = date('Ymdhis');
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    if($_FILES["photo"]["error"] > 0)
    {
        $picName = "./noPicture.jpg";
    }
    else
    {
        $_FILES["photo"]["name"] = $randomString.".jpg";
        move_uploaded_file($_FILES["photo"]["tmp_name"], $_FILES["photo"]["name"]);
        
        $picName = $randomString.".jpg";
        rename($picName, "./lostThings/".$randomString.".jpg");
    }
    

    //連接資料庫
    if ( !( $database = mysqli_connect( "localhost", "maker", "" ) ) )			#( "主機", "使用者", "密碼" )
    die( "Could not connect to database </body></html>" );

    mysqli_query($database, "set names 'utf8'");							
    mysqli_query($database,"set character_set_client=utf8");
    mysqli_query($database,"set character_set_results=utf8");

    $query = "INSERT INTO `lostthing` (`id`, `thing`, `color`, `brand`, `idNumber`, `photo`, `random`) VALUES (NULL, '".$thing."', '".$color."', '".$brand."', '".$idNumber."', '".$picName."', '".$randomString."')";

    if ( !mysqli_select_db($database,"maker" ) )					
        die( "Could not open database </body></html>" );

    if ($database->query($query) === TRUE) 
    {
        $query = "SELECT * FROM `lostthing` WHERE binary `random` = '".$randomString."'";	
        if ( !( $result = mysqli_query($database, $query) ) )
        {
        print( "<p>Could not execute query!</p>" );
        die( mysqli_error() . "</body></html>" );
        }
        
        while($row = $result->fetch_assoc())		
        {
            $id = $row['id'];
        }
    } 		
        
    mysqli_close( $database );
    
    header('location:./map.php?id='.$id);

?>
