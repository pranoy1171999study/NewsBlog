<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->

<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    include 'config.php';
                    
                    if(isset($_GET['cid']))
                         $cat_id=$_GET['cid'];
                    else $cat_id=0;
                    $sql2="SELECT * FROM category WHERE post > 0";
                    $result2=mysqli_query($conn,$sql2) or die("Query failed");
                
                    if(mysqli_num_rows($result2)>0){ ?>
                    <ul class='menu'>
                        
                        <?php /*$active="";
                        if(!isset($_GET['cid'])) $active="active" */?>
                    <li><a  class='' href='index.php'> HOME </a></li>
                        <?php 
                        while($row2=mysqli_fetch_assoc($result2)){
                            if($row2['category_id']==$cat_id){
                                $active="active";

                            }else{
                                $active="";
                            }
                            echo "<li><a  class='{$active}' href='category.php?cid=".$row2['category_id']."'>".$row2['category_name']."</a></li>";
                
                        } ?>
                        
                    </ul>
                    <?php  } 
                    ?> 
                

            </div>
        </div>
    </div>
</div>
                
<!-- /Menu Bar -->
</body>
</html>
