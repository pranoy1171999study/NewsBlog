<?php
include 'config.php';
$post_id=$_GET['id'];
$cat_id=$_GET['catid'];
//delete previous image
$sql1="SELECT post_img FROM post WHERE post_id={$post_id}";
$result1=mysqli_query($conn,$sql1) or die("Query failed : select");
$row=mysqli_fetch_assoc($result1);
unlink("upload/".$row['post_img']);//delete function

$sql="DELETE FROM post WHERE post_id={$post_id};";
$sql.="UPDATE category SET post=post-1 WHERE category_id={$cat_id}";
if(mysqli_multi_query($conn,$sql)){
    header("location: {$hostname}/admin/post.php");
}else{
    echo "Query Failed";
}

?>