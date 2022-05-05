<?php
include 'config.php';

if(empty($_FILES['new-image']['name'])){
    $file_name=$_POST['old-image'];
    $old="";//use to delete image
}else{
    $old=$_POST['old-image'];
    $errors=array();
    $file_name=$_FILES['new-image']['name'];
    $file_size=$_FILES['new-image']['size'];
    $file_tmp=$_FILES['new-image']['tmp_name'];
    $file_type=$_FILES['new-image']['type'];
    $file_ext=strtolower(end(explode('.',$file_name)));
    $extentions=array("jpeg","jpg","png");
    if(in_array($file_ext,$extentions)==false){
        $errors[]="This extension file is not allowed , only jpg,jpeg,png allower";
    }
    //less than 2 mb
    if($file_size>2*1024*1024){
        $errors[]="File size must be less than 2 mb";
    }

    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }
}

$sql="UPDATE post SET title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category='{$_POST["category"]}',post_img='{$file_name}'
WHERE post_id={$_POST['post_id']}";
$re=mysqli_query($conn,$sql)or die("Query Failed");
echo print_r(mysqli_fetch_assoc($re));


if($old)
{
    if (file_exists("upload/".$old)) {
        unlink("upload/".$old);
    }
}else{
    echo "<h1>not found</h1>";
}

header("Location: {$hostname}/admin/post.php");

?>