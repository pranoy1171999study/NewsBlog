<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php

                    if(isset($_GET['cid']))
                    {
                        $sql="SELECT * FROM category WHERE category_id={$_GET['cid']}";
                        $result=mysqli_query($conn,$sql);
                        $row=mysqli_fetch_assoc($result) or die("Query Failed");
                        $cat_name=$row['category_name'];
                    
                    }
                ?>
                <div class="post-container">
                  <h2 class="page-heading"><?php echo strtoupper($cat_name); ?></h2>
                  <?php

                    if(isset($_GET['cid']))
                    {
                        $cat_id=$_GET['cid'];
                    }
                    //include 'config.php';
                    $limit=3;
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                    }
                    else{
                        $page=1;
                    } 
                    $offset=($page-1)*$limit;

                    if(isset($_GET['cid']))
                    {
                        $sql="SELECT post.post_id,post.title,post.description,post.post_date,post.category,post.post_img,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category=category_id
                    LEFT JOIN user ON post.author=user.user_id
                    WHERE post.category={$_GET['cid']}
                    ORDER BY post.post_id
                    DESC LIMIT {$offset},{$limit}";
                    }else{
                        $sql="SELECT post.post_id,post.title,post.description,post.post_date,post.category,post.post_img,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category=category_id
                    LEFT JOIN user ON post.author=user.user_id
                    ORDER BY post.post_id
                    DESC LIMIT {$offset},{$limit}";
                    }
                    
                    
                    
                    
                    $result=mysqli_query($conn,$sql) or die("Query failed");
                    $user_number=mysqli_num_rows($result);
                    if($user_number>0){
                        while($row=mysqli_fetch_assoc($result)){
                ?>
                    
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,230)."......"; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                              }else{
                                  echo "<div>There is no post to show</div>";
                              }
                              //pagination
                                //cheek category is selected or not
                                $pass_catagory="";
                                if(isset($_GET['cid']))
                                {
                                    $pass_catagory="&cid=".$_GET['cid'];
                                    $sql1="SELECT * FROM post WHERE category={$_GET['cid']}";
                                }else{
                                    $sql1="SELECT * FROM post";
                                }
                              
                              $result1=mysqli_query($conn,$sql1) or die("Query failed");
                              if(mysqli_fetch_assoc($result1)>0){
         
                                 $total_records=mysqli_num_rows($result1);
                                 $total_page=ceil($total_records/$limit);
         
                                 echo "<ul class='pagination admin-pagination'>";
                                 if($page>1){
                                     echo'<li><a href="category.php?page='.($page-1).$pass_catagory.'">Prev</a></li>';
                                 }
                                 for($i=1;$i<=$total_page;$i++)
                                 {
                                     if($i==$page){
                                         $active="active";
                                     }else{
                                         $active="";
                                     }
                                     echo '<li class="'.$active.'"><a href="category.php?page='.$i.$pass_catagory.'">'.$i.'</a></li>';
                                 }
                                 if($page<$total_page){
                                     echo'<li><a href="category.php?page='.($page+1).$pass_catagory.'">Next</a></li>';
                                 }
                                 
                              }
                              echo '</ul>';
                              
                              ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
