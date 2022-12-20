<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
   $admin_id = '';
};




// count total number of rows in  users table



if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   

</head>
<body>
<style>
* {
  box-sizing: border-box;
}

/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 10%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}
.pagination_section {
    position: relative;
  }
 
  /* pagination styling */
  .pagination_section a {
    color: black;
    font-size: 25px;
    padding: 10px 18px;
    text-decoration: none;
  }
 
  /* pagination hover effect on non-active */
  .pagination_section a:hover:not(.active) {
    background-color: #031F3B;
    color: white;
  }
 
  /* pagination hover effect on active*/
 

 
  a:nth-child(1) {
    font-weight: bold;
  }
 
  a:nth-child(7) {
    font-weight: bold;
  }

</style>
<?php include '../components/admin_header.php'; ?>

   
  
<form class="example" action="search_page_admin.php">
  
  <button type="submit"><i class="fa fa-search"></i>  search for user ye djo</button>
</form>


<section class="accounts">

   <h1 class="heading">user accounts</h1>
  
   <div class="box-container">

   <?php
   $start = 0;  $per_page = 2;
   $page_counter = 0;
   $next = $page_counter + 1;
   $previous = $page_counter - 1;
   
   if(isset($_GET['start'])){
    $start = $_GET['start'];
    $page_counter =  $_GET['start'];
    $start = $start *  $per_page;
    $next = $page_counter + 1;
    $previous = $page_counter - 1;
   }
   // query to get messages from messages table
$q = "SELECT * FROM users LIMIT $start, $per_page";
$query = $conn->prepare($q);
$query->execute();   
if($query->rowCount() > 0){


         while($fetch_accounts =$query->fetch(PDO::FETCH_ASSOC)){   
   ?>



   <div class="box">
      <p> user id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>
      <p> email : <span><?= $fetch_accounts['email']; ?></span> </p>
      <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')" class="delete-btn">delete</a>
     
   </div>
 
   <?php
         }
         $count_query = "SELECT * FROM users";
$query = $conn->prepare($count_query);
$query->execute();
$count = $query->columnCount();
// calculate the pagination number by dividing total number of rows with per page.
$paginations = ceil($count / $per_page);

      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>

   </div>

</section>

   <center>
            
            <ul class="pagination_section">
            <?php
                if($page_counter == 0){
                   
                    for($j=1; $j < $paginations; $j++) { 
                      echo "<a href=?start=$j>".$j."</a>";
                   }
                }else{
                    echo "<a href=?start=$previous>Previous</a>"; 
                    for($j=0; $j < $paginations; $j++) {
                     if($j == $page_counter) {
                        echo "<a href=?start=$j class='active'>".$j."</a>";
                     }else{
                        echo "<a href=?start=$j>".$j."</a>";
                     } 
                  }if($j != $page_counter+1)
                    echo "<a href=?start=$next>Next</a>"; 
                } 
            ?>
        </ul>
            </center>    
             









<script src="../js/admin_script.js"></script>
   
</body>
</html>