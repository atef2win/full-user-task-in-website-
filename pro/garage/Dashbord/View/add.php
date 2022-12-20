<?php
    require_once '../Controller/garagec.php';
    require_once '../Model/garage.php';

    $error = "";
    // create user
    $garage = null;
    // create an instance of the controller
    $garagec = new garagec();
    if (
        isset($_POST["Nom_garage"]) &&
        isset($_POST["Date_garage"]) &&
        isset($_POST["Prix_garage"])        
    ) {
        if (
            !empty($_POST["Nom_garage"]) &&
            !empty($_POST["Date_garage"]) &&
            !empty($_POST["Prix_garage"])
            
        ) {
            $garage = new garage(
                $_POST['Nom_garage'],
                $_POST['Date_garage'],
                $_POST['Prix_garage']
            );
			$garagec->ajoutergarage($garage);
        }
        else
            $error = "Missing information";
    }  
	if(isset($_POST['submit']))
	{
    	header ('Location:view.php');
	}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Gestion des garages</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/style.css">

	</head>

	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12">
					<div class="wrapper">
						<div class="row justify-content-center">
							<div class="col-lg-8">
								<div class="contact-wrap">
									<h3 class="mb-4 text-center"><strong>Ajouter un garage</strong></h3>
									<br>
									<br>
									<div id="form-message-warning" class="mb-4 w-100 text-center"></div> 
										<form method="POST" id="contacForm" name="contactorm" class="contactForm">
											<div class="row">
												<div class="col-md-12"> 
													<div class="form-group">
														<input type="text" class="form-control" name="Nom_garage" placeholder="Nom">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="date" class="form-control" name="Date_garage" placeholder="Date">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" name="Prix_garage" placeholder="Prix">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" name="submit" value="Ajouter garage" onclick="return okEvent();" class="btn btn-primary">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.validate.min.js"></script>
  	<script src="js/main.js"></script>

	</body>
</html>

