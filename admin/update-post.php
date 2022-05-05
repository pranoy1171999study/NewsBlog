<?php include "header.php"; ?>

<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php
        include 'config.php';
        $postid=$_GET['id'];
        $sql="SELECT post.post_id,post.title,post.description,post.category,post.post_img,category.category_name,category.category_id
        FROM post
        LEFT JOIN category ON post.category=category.category_id
        WHERE post.post_id={$postid}";
        $result=mysqli_query($conn,$sql) or die("Query failed");
        if(mysqli_num_rows($result)>0){
        $data=mysqli_fetch_assoc($result);
        
            
        
    ?>

        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $_GET['id']?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $data['title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="">
                    <?php echo $data['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <?php 
                    $sql1="SELECT * FROM category";
                    $result1=mysqli_query($conn,$sql1);
                    while($row=mysqli_fetch_assoc($result1)){
                    
                            if($row['category_id']==$data['category'])
                            {
                                $select="selected";
                            }else{
                                $select="";
                            }
                    ?>
                    <option value="<?php echo $row['category_id'];?>"<?php echo $select;?>><?php echo $row['category_name'];?></option>";
                    
                <?php
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $data['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $data['post_img']; ?>"> 
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php
            }else{

            }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
