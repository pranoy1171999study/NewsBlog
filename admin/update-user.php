<?php include "header.php"; 

if(isset($_POST['submit']))
{
    //connect to database
    include "config.php";

    $userid=mysqli_real_escape_string($conn,$_POST['user_id']);
    //mysquli_real_escape_string MySQL function to protect injection of some special characters
    $fname=mysqli_real_escape_string($conn,$_POST['f_name']);
    $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
    $user=mysqli_real_escape_string($conn,$_POST['username']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);

    $sql="UPDATE user SET first_name='{$fname}',last_name='{$lname}',username='{$user}',role={$role} WHERE user_id={$userid}";
    $result=mysqli_query($conn,$sql) or die("Query Failed");

    if($result)
    {
        
        echo "<script>alert('Success!');</script>";

        header("Location: {$hostname}/admin/users.php");
    }
    else
    {
        echo "<p style='color:red; text-align:center; margin:20px;'>User name already exists</p>";
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

              <?php  
                include 'config.php';
                $user_id=$_GET['id'];
                $sql="SELECT * FROM user WHERE user_id={$user_id}";
                $result=mysqli_query($conn,$sql) or die("Query failed");
                if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
              ?>
                  <!-- Form Start -->
                  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $user_id;?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          
                          <?php 
                                        if($row['role']==0) echo " <option value='0' selected>normal User</option>
                                                                    <option value='1' >admin</option>"; 
                                        if($row['role']==1) echo "<option value='0' >normal User</option>
                                                                    <option value='1' selected>admin</option>";
                            ?></td>
                          
                             
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php
                    }
                        }
                ?>
                
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
