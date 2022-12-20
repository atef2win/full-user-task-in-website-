<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
      }
   }
   
}

?>













<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>  
  


<section class="form-container">

   <form action="" method="post">
      <h3>create new password</h3>
      <input type="password" id="password" name="new_pass" required placeholder="enter new your password" name="pwd" minlength="8"  class="box"   onInput="check()">
      <br>
         <div id="set" >
        <div id="count">Length : 0</div>
        <i id="see" onclick="see()" class="far fa-eye"></i>
         </div>
           <div id="check0">
                <i class="far fa-check-circle"></i>  <span> Length more than 5.</span>
           </div>
           <div id="check1">
                <i class="far fa-check-circle"></i>  <span> Length less than 10.</span>
           </div>
           <div id="check2">
                <i class="far fa-check-circle"></i>  <span> Contains numerical character.</span>
           </div>
           <div id="check3">
                <i class="far fa-check-circle"></i>   <span>Contains special character.</span>
           </div>
           <div id="check4">
                <i class="far fa-check-circle"></i>  <span>Shouldn't contain spaces.</span>
           </div>
      <input type="password" name="cpass" required placeholder="confirm your new password" minlength="8"  class="box">
      <input type="submit" value="Send Otp" id="forgotBtn" class="btn" name="submit">
      <div class="flex-btn">
           
            <a href="user_login.php" class="option-btn">login</a>
         </div>
   </form>

   <script>
var is_visible = false;

function see()
{
    var input = document.getElementById("password");
    var see = document.getElementById("see");
    
    if(is_visible)
    {
        input.type = 'password';
        is_visible = false; 
        see.style.color='gray';
    }
    else
    {
        input.type = 'text';
        is_visible = true; 
        see.style.color='#262626';
    }
    
}

function check()
{
    var input = document.getElementById("password").value;
    
    input=input.trim();
    document.getElementById("password").value=input;
    document.getElementById("count").innerText="Length : " + input.length;
    if(input.length>=5)
    {
        document.getElementById("check0").style.color="green";
    }
    else
    {
       document.getElementById("check0").style.color="red"; 
    }
    
    if(input.length<=10)
    {
        document.getElementById("check1").style.color="green";
    }
    else
    {
       document.getElementById("check1").style.color="red"; 
    }
    
    if(input.match(/[0-9]/i))
    {
        document.getElementById("check2").style.color="green";
    }
    else
    {
       document.getElementById("check2").style.color="red"; 
    }
    
    if(input.match(/[^A-Za-z0-9-' ']/i))
    {
        document.getElementById("check3").style.color="green";
    }
    else
    {
       document.getElementById("check3").style.color="red"; 
    }
    
    if(input.match(' '))
    {
        document.getElementById("check4").style.color="red";
    }
    else
    {
       document.getElementById("check4").style.color="green"; 
    }
    
}
</script>
   

   
</body>
</html>