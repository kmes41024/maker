<?php
    $id = $_GET['id'];
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
            function choose(building)
            {
                console.log(building);
                setTimeout("javascript:location.href='./chooseBox.php?building=" + building + "&id=" + <?php echo $id;?> + "'", 000);
            }
        </script>
    </head>
    <body style = "background-color:#74A709;font-family: Microsoft JhengHei;"> 
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="nav navbar-nav" style = "background-color: #F7E277;">
                    <img src="logo.png" alt="" style = "height:20%;width:20%">
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
                            <h4 style = "color:white">您想將撿到的物品放在何處?</h4>
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
                                <tr height = "10px">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align = "center">
                                        <div style = "position:relative;">
                                            <img src = "yzuMap.png" href = "yzuMap.png" style = "width:100%">
                                            <div>
                                                <img src = "building1.png" href = "img/building1.png" style = "width:5%;position:absolute;top:35%;left:22.5%" onclick = "choose(1)">
                                            </div>
                                            <div>
                                                <img src = "building2.png" href = "img/building2.png" style = "width:8%;position:absolute;top:14%;left:38%" onclick = "choose(2)">
                                            </div>
                                            <div>
                                                <img src = "building3.png" href = "img/building3.png" style = "width:5.5%;position:absolute;top:34.5%;left:39.5%" onclick = "choose(3)">
                                            </div>
                                            <div>
                                                <img src = "building5.png" href = "img/building5.png" style = "width:11.5%;position:absolute;top:15%;left:25%" onclick = "choose(5)">
                                            </div>
                                            <div>
                                                <img src = "building6.png" href = "img/building6.png" style = "width:4.3%;position:absolute;top:19%;left:19.5%" onclick = "choose(6)">
                                            </div>
                                            <div>
                                                <img src = "building7.png" href = "img/building7.png" style = "width:10%;position:absolute;top:34%;left:44.5%" onclick = "choose(7)">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /page content -->
        
    </body>
</html>