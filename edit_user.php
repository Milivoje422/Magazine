<?php
require_once('includes/load.php');

confirm_logged_in();

	$user_id=$_SESSION['user_id'];
        $user=get_user($user_id);

if(isset($_POST['submit2'])){

		$country   = mysqli_real_escape_string($conn,$_POST['country']);
                $phone_num = mysqli_real_escape_string($conn,$_POST['phonenum']);
                $name      = mysqli_real_escape_string($conn,$_POST['name']);
                $lastname  = mysqli_real_escape_string($conn,$_POST['lastname']);
                $myself    = mysqli_real_escape_string($conn,$_POST['something']);
                
                $username  = $user['username'];
                
                $old_location    =      $_FILES['image']['tmp_name'];
                $folder_name     =      urlencode($username);
                if(!is_dir('uploads/'.$username)){
                    mkdir('uploads/'.$folder_name);
                } 
                
                $new_location   =   'uploads/'.$folder_name.'/'.$_FILES['image']['name'];

		

                
                
		$query="UPDATE * users SET 

                country         =       '$country',

                phone_number    =       '$phone_num',
                name            =       '$name',
                lastname        =       '$lastname',
                about_myself    =       '$myself' WHERE id='$user_id'";

		 
                if(move_uploaded_file($old_location,$new_location)){
                $query.=" , image = '$new_location' "; }
		$result=mysqli_query($conn,$query);
		confirm_query($result);
		

		echo redirect('staff.php');

        }

        
        
        
        

if(isset($_POST['submit1'])){
                 
                $arr_names	=	array('username','email','password','confirm-password');
                $arr_max	=	array('username'=>40,'email'=>255,'password'=>255);
	
                $err1 = empty_fields($arr_names);
                $err2 = max_fields($arr_max);
                $errors=array_merge($err1,$err2);
    
	
if(empty($errors) && $_POST['password']==$_POST['confirm-password']){
		$username  = mysqli_real_escape_string($conn,$_POST['username']);
		$email 	   = mysqli_real_escape_string($conn,$_POST['email']);
		$password  = mysqli_real_escape_string($conn,$_POST['password']);
                 
                $hash_pass=password_hash($password,PASSWORD_DEFAULT);
                
                 $query = "UPDATE users SET 
                    
                 username       =       '$username',
                 email          =       '$email',
                 password       =       '$pass' WHERE id='$user_id'";
                                          
                $result=mysqli_query($conn,$query);
		confirm_query($result);
            
                
                
                echo redirect('staff.php');
        }
        }









?>





<?php include_once('includes/footer.php'); ?>