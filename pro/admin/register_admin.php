<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $fname = $_POST['fname'];
   $fname = filter_var($fname, FILTER_SANITIZE_STRING);
   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'username already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password,recovery) VALUES(?,?,?)");
         $insert_admin->execute([$name, $cpass,$fname]);
         $message[] = 'new admin registered successfully!';
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
   <title>register admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" id="password"  class="box" onInput= "check()">
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
           <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
           <input type="text" id="fname" name="fname" required  placeholder="enter your Recovery sentence"  class="box" onInput= "checkrec()">
      <br>
         <div id="set" >
        <div id="count1">Length : 0</div>
        <i id="see1" onclick="see1()" class="far fa-eye"></i>
         </div>
           <div id="checkrec0">
                <i class="far fa-check-circle"></i>  <span> Length more than 5.</span>
           </div>
           <div id="checkrec1">
                <i class="far fa-check-circle"></i>  <span> Length less than 10.</span>
           </div>
           <div id="checkrec2">
                <i class="far fa-check-circle"></i>  <span> Contains numerical character.</span>
           </div>
           <div id="checkrec4">
                <i class="far fa-check-circle"></i>  <span>Shouldn't contain spaces.</span>
           </div>
           <input type="submit" value="register now" class="btn" name="submit">
   </form>

</section>

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
function see1()
{
    var input = document.getElementById("fname");
    var see = document.getElementById("see1");
    
    if(is_visible)
    {
        input.type = 'text';
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

function checkrec()
{
    var input = document.getElementById("fname").value;
    
    input=input.trim();
    document.getElementById("fname").value=input;
    document.getElementById("count1").innerText="Length : " + input.length;
    if(input.length>=5)
    {
        document.getElementById("checkrec0").style.color="green";
    }
    else
    {
       document.getElementById("checkrec0").style.color="red"; 
    }
    
    if(input.length<=10)
    {
        document.getElementById("checkrec1").style.color="green";
    }
    else
    {
       document.getElementById("checkrec1").style.color="red"; 
    }
    
    if(input.match(/[0-9]/i))
    {
        document.getElementById("checkrec2").style.color="green";
    }
    else
    {
       document.getElementById("checkrec2").style.color="red"; 
    }
    if(input.match(' '))
    {
        document.getElementById("checkrec4").style.color="red";
    }
    else
    {
       document.getElementById("checkrec4").style.color="green"; 
    }
    
}
  
  

</script>










<script src="../js/admin_script.js"></script>
   
</body>
</html>