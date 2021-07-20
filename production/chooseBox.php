<?php
    $building = $_GET['building'];
    $id = $_GET['id'];

    if($building == 1)
    {
        $engID = 'A';
        $building = '一館';
    }
    else if($building == 2)
    {    
        $engID = 'B';
        $building = '二館';
    }
    else if($building == 3)
    {
        $engID = 'C';
        $building = '三館';
    }
    else if($building == 5)
    {
        $engID = 'E';
        $building = '五館';
    }
    else if($building == 6)
    {
        $engID = 'F';
        $building = '六館';
    }
    else if($building == 7)
    {
        $engID = 'G';
        $building = '七館';
    }
    
    $query = "SELECT * FROM `box` WHERE binary `building` = '".$building."'";

    if ( !( $database = mysqli_connect( "localhost", "maker", "" ) ) )			#( "主機", "使用者", "密碼" )
        die( "Could not connect to database </body></html>" );
    if ( !mysqli_select_db($database,"maker" ) )			
        die( "Could not open database </body></html>" );
    if ( !( $result = mysqli_query($database, $query) ) )
    {
        print( "<p>Could not execute query!</p>" );
        die( mysqli_error() . "</body></html>" );
    }
    
    $data = array();
    $i = 0;
    while($row = $result->fetch_assoc())	
    {
        $box = $row['box_id'];
        $full = $row['full'];
        if($full == 0)
        {
            $btnNum = $i + 1;
            $btnId = $engID."-".$btnNum;

            $data[$i] = "<button type='button' class='btn btn-round' style = 'background:white;color:gray;width: 90%;height:5em;border-radius:15px;' id = '".$btnId."' onclick = 'setBoxId(this.id)'  data-toggle='modal' data-target='#exampleModalCenter'>".$box."</button>";
        }
        else 
        {
            $data[$i] = '<button type="button" class="btn btn-round" style = "background:#c3c3c3;color:gray;width: 90%;height:5em;border-radius:15px;">'.$box.'<br>(滿)</button>';
        }
        $i = $i + 1;
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
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
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
            var box_id;

            function setBoxId(boxID)
            {
                box_id = boxID;
            }

            function choose()
            {
                console.log(box_id);
                var id = <?php echo $id;?>;
                var building = '<?php echo $building;?>';
                console.log(id);
                console.log(building);
                $.ajax({
                    url:"./updateLostThing.php",
                    data:{
                        box_id:box_id,id:id,building:building
                    },
                    type:"POST",
                    datatype:"html",
                    
                    success:function(output){
                        console.log(output);
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

            function sendToRaspi()
            {
                var s = "";
                if(box_id == "A-1" || box_id == "B-1" || box_id == "C-1" || box_id == "E-1" || box_id == "F-1" || box_id == "G-1")
                    s = "put1_full";
                else if(box_id == "A-2" || box_id == "B-2" || box_id == "C-2" || box_id == "E-2" || box_id == "F-2" || box_id == "G-2")
                    s = "put2_full";
                else if(box_id == "A-3" || box_id == "B-3" || box_id == "C-3" || box_id == "E-3" || box_id == "F-3" || box_id == "G-3")
                    s = "put3_full";
                else if(box_id == "A-4" || box_id == "B-4" || box_id == "C-4" || box_id == "E-4" || box_id == "F-4" || box_id == "G-4")
                    s = "put4_full";

                $.ajax({
                    url:"http://192.168.43.156:8000/"+s,
                    data:{ },
                    type:"GET",
                    datatype:"html",
                    success:function(){ },
                    error:function(){ }
                });
            }

            function putThing()
            {
                sendToRaspi();

                console.log('box_id' + box_id);
                s = 15;
                myVar = setInterval(function(){countDown()},1000);

                var value = 1;
                $.ajax({
                    url:"./updateBox.php",
                    data:{
                        box_id:box_id,value:value
                    },
                    type:"POST",
                    datatype:"html",
                    
                    success:function(output){
                        console.log("good");
                        if(output == 'error')
                            alert("系統錯誤!!")
                    },
                    error:function(){
                        alert("Request failed");
                    }
                });

                choose();
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
                            <br>
                            <h4 style = "color:white">請選擇您要放置的櫃子</h4>
                        </td>
                    </tr>
                    <tr height = "5%">
                        <td></td>
                    </tr>
                    <tr height = "40%">
                        <td>
                            <table align = "center" width = "80%">
                                <tr height = "10px">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align = "center">
                                        <?php echo $data[0]; ?>
                                    </td>
                                    <td align = "center">
                                        <?php echo $data[1]; ?>
                                    </td>
                                </tr>
                                <tr height = "10px">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align = "center">
                                       <?php echo $data[2]; ?>
                                    </td>
                                    <td align = "center">
                                        <?php echo $data[3]; ?>
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
                            <span style = "font-size:0.8em">如果是，櫃子將開啟15秒，請盡速放置物品，並刷學生證</span>
                        </p>
                    </div>
                    <div class="modal-footer" id = "foot">
                        <button type="button" class="btn btn-round" style = "border-radius:15px;background-color: #FFD500;width:50%" id = "btnY" name = "btnY" onclick = "putThing()" data-toggle="modal" data-target="#countDown"  data-dismiss="modal">是</button>
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
                            櫃門已開啟，請於15秒內放好物品，並將櫃門關上
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