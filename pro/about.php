<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
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
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">
      

      <div class="content">
         <h3>why choose us?</h3>
         <p>you are a legend because you choose us</p>
         <a href="contact.php" class="btn">contact us</a>
         <a href="add_rate.php" class="btn">rate us</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">client's reviews</h1>
   <?php 
                
                $query=$conn->prepare("SELECT * FROM `ratee`");;

                $query->execute();

                while ($row  = $query->fetch(PDO::FETCH_ASSOC)) 
                {
                ?>
                <div class="swiper reviews-slider">
                     <div class="swiper-wrapper">
                        <div class="swiper-slide slide">
                        <img src="images/anonymous.png" alt="">
         <p>nice</p>                               
                         <div class="stars">
                          
                            <?php 
                             
                             $start=1;
                             while ($start <= 5) 
                             {
                             	if ($row['rate'] < $start) 
                                {
                                 ?>
                               <i class="fa fa-star-o"></i>
                                 <?php
                             	}else{
                             	 ?>
                                 <i class="fa fa-star"></i>
                             	 <?php
                             	}

                             	$start++;
                             }
                            ?>                
                         
                        </div>
                        <h3><?php echo $row['name'];?></h3>  
                        </div>
                        </div>
                
                <?php
                }
                ?>
 
                     
<div class="swiper-pagination"></div>
</div>
</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
     
   },
});

</script>

</body>
</html>