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
	
	$query =  "SELECT * FROM `lostthing` WHERE binary `thing` = '".$thing."' AND `color` = '".$color."' AND `brand` = '".$brand."' AND `idNumber` = '".$idNumber."'";
    
	if ( !( $database = mysqli_connect( "localhost", "maker", "makermaker" ) ) )			#( "主機", "使用者", "密碼" )
	   die( "Could not connect to database </body></html>" );
    if ( !mysqli_select_db($database,"maker" ) )				
	   die( "Could not open database </body></html>" );
    if ( !( $result = mysqli_query($database, $query) ) )
    {
	   print( "<p>Could not execute query!</p>" );
	   die( mysqli_error() . "</body></html>" );
    }
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>F^2</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
        <!-- Bootstrap -->
        <link href = "../../maker/vendors/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link href="../../maker/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../../maker/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="../../maker/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
        <!-- Custom Theme Style -->
        <link href="../../maker/build/css/custom.min.css" rel="stylesheet">
        <style>
            .outer {
                position: relative; 
            }
            .inner {
                background-color: #d5e1a3;
                position: absolute;   
                top: 50%;            
                transform: translateY(-50%);    
            }
        </style>
        <script>
            var thingID;
            var s = 15;
            var myVar;
            var box_id;
            function setData(id, boxID)
            {
                console.log(id);
                thingID = id;
                box_id = boxID;
            }

            function sendToRaspi()
            {
                var s = "";
                if(box_id == "A-1" || box_id == "B-1" || box_id == "C-1" || box_id == "E-1" || box_id == "F-1" || box_id == "G-1")
                    s = "get1_empty";
                else if(box_id == "A-2" || box_id == "B-2" || box_id == "C-2" || box_id == "E-2" || box_id == "F-2" || box_id == "G-2")
                    s = "get2_empty";
                else if(box_id == "A-3" || box_id == "B-3" || box_id == "C-3" || box_id == "E-3" || box_id == "F-3" || box_id == "G-3")
                    s = "get3_empty";
                else if(box_id == "A-4" || box_id == "B-4" || box_id == "C-4" || box_id == "E-4" || box_id == "F-4" || box_id == "G-4")
                    s = "get4_empty";

                $.ajax({
                    url:"http://192.168.43.156:8000/"+s,
                    data:{ },
                    type:"GET",
                    datatype:"html",
                    success:function(){ },
                    error:function(){ }
                });
            }

            function getThing()
            {
                sendToRaspi();

                console.log('open');
                s = 15;
                myVar = setInterval(function(){countDown()},1000);

                $.ajax({
                    url:"./deleteThing.php",
                    data:{
                        thingID:thingID
                    },
                    type:"POST",
                    datatype:"html",
                    
                    success:function(output){
                        if(output == 'no OK')
                            alert("系統錯誤!!")
                    },
                    error:function(){
                        alert("Request failed");
                    }
                });

                var value = 0;
                $.ajax({
                    url:"./updateBox.php",
                    data:{
                        box_id:box_id,value:value
                    },
                    type:"POST",
                    datatype:"html",
                    
                    success:function(output){
                        if(output == 'no OK')
                            alert("系統錯誤!!")
                    },
                    error:function(){
                        alert("Request failed");
                    }
                });
            }

            function countDown()
            {
                if(s < 0)
                {
                    clearInterval(myVar);
                    setTimeout("javascript:location.href='./index.html'", 250);
                }
                else
                {
                    document.getElementById('second').innerHTML = s;
                    s--;
                }
            }
        </script>
    </head>
    <body style = "background-color:#74A709;font-family: Microsoft JhengHei;">
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="nav navbar-nav" style = "background-color: #F7E277;">
                    <img src="img/logo.png" alt="" style = "height:20%;width:20%">
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div role="main">
            <div class = "">
                <table height = "250px" width = "100%">
                    <tr height = "40%">
                        <td></td>
                    </tr>
                    <tr height = "15%">
                        <td align = "center">
                            <?php
                                if(mysqli_num_rows($result) != 0)
                                {
                                    print("<h4 style = 'color:white'>物品搜尋</h4>");
                                }
                            ?>
                        </td>
                    </tr>
                    <tr height = "5%">
                        <td></td>
                    </tr>
                    <tr height = "40%">
                        <td>
                            <table align = "center" width = "80%">
                                <tr>
                                    <td>
                                    <?php
                                        if(mysqli_num_rows($result) == 0)
                                        {
                                            print("<p style = 'color:white; font-size:3em'; align = 'center'>查無資料</p>");
                                            print("<p style = 'color:white; font-size:1em'; align = 'center'>請重新輸入上頁資料</p>");
                                        }
                                        else
                                        {
                                            while($row = $result->fetch_assoc())	
                                            {
                                                if($row['color'] == "")
                                                    $row['color'] = "&nbsp-";
                                                if($row['brand'] == "")
                                                    $row['brand'] = "&nbsp-";

                                                print('<tr>
                                                    <td align = "center">
                                                        <div class="btn btn-round" style = "width:100%;background-color:white;height:50%;border-radius:0px;padding-left:3px;padding-right:3px">
                                                            <table>
                                                                <tr>
                                                                    <td style = "width:30%">
                                                                        <img src="/maker/production/lostThings/'.$row['photo'].'" style = "width:100%">
                                                                    </td>
                                                                    <td style = "text-align:left;padding-left:5%;font-size:0.9em;width:55%">
                                                                        <p style = "margin:0px">物品名稱 : '.$row['thing'].'<br>物品顏色 : '.$row['color'].'<br>物品品牌 : '.$row['brand'].'<br>所在位置 : '.$row['building'].'&nbsp'.$row['box'].'</p>
                                                                    </td>
                                                                    <td style = "width:15%;vertical-align:bottom" align = "right">
                                                                        <button class="btn btn-round" style = "width:95%;font-size:0.7em;margin-left:0px;margin-right:0px;border-radius:10px;padding-left:1px;padding-right:1px;background-color: #FFD500;" id = "'.$row['id'].'" onclick = "setData('.$row['id'].','."'".$row['box']."'".')" data-toggle="modal" data-target="#exampleModalCenter">這是我的</button>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr height = "10px">
                                                    <td></td>
                                                </tr>');
                                            }
                                        }
                                    ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id = "body">
                        <p align = "center" style = "margin:0px">
                            <span style = "font-size:1.3em">現在是否已站在<span id = "lockPlace"></span>櫃子前?</span><br>
                            <span style = "font-size:0.8em">如果是，櫃子將開啟15秒，請盡速取走物品，並刷學生證</span>
                        </p>
                    </div>
                    <div class="modal-footer" id = "foot">
                        <button type="button" class="btn btn-round" style = "border-radius:15px;background-color: #FFD500;width:50%" id = "btnY" name = "btnY" onclick = "getThing()" data-toggle="modal" data-target="#countDown"  data-dismiss="modal">是</button>
                        <button type="button" class="btn btn-round" style = "border-radius:15px;background-color: #FFD500;width:50%" id = "btnN" name = "btnN" data-dismiss="modal">否</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="countDown" tabindex="-1" role="dialog" aria-labelledby="countDownTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-body" id = "body" style = "padding-left:2px;padding-right:2px;">
                        <p align = "center" style = "vertical-align:middle;margin:0px">
                            櫃門已開啟，請於15秒內取完物品，並將櫃門關上
                        </p>
                        <p align = "center" style = "vertical-align:middle;margin:0px">
                            櫃門還剩&nbsp<span style = "font-size:2em" id = "second">15</span>&nbsp秒鎖上
                        </p>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </body>
</html>