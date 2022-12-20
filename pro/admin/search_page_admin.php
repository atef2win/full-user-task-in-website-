<?php

include '../components/connect.php';

session_start();

if(isset($_SESSION['admin_id'])){
   $user_id = $_SESSION['admin_id'];
}else{
   $user_id = '';
};


?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include '../components/admin_header.php'; ?>
<style>
   
   .search-form form{
      display: flex;
      gap:1rem;
   }
   
   .search-form form input{
      width: 100%;
      border:var(--border);
      border-radius: .5rem;
      background-color: var(--white);
      box-shadow: var(--box-shadow);
      padding:1.4rem;
      font-size: 1.8rem;
      color:var(--black);
   }
   
   .search-form form button{
      font-size: 2.5rem;
      height: 5.5rem;
      line-height: 5.5rem;
      background-color: var(--main-color);
      cursor: pointer;
      color:var(--white);
      border-radius: .5rem;
      width: 6rem;
      text-align: center;
   }
   
   .search-form form button:hover{
      background-color: var(--black);
   }
   
   </style>
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="search here ye admoun ken hajtek b user..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">
<?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     $select_products = $conn->prepare("SELECT * FROM `users` WHERE name LIKE '%{$search_box}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="empty">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <div class="name"><?= $fetch_product['name']; ?>  exists</div>
     
      
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no user found!</p>';
      }
   }
   ?>
   </body>
</html>