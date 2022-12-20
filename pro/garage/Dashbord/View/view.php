<?PHP
	include ("../Controller/garagec.php");
 
	$garagec=new garagec();

    if ($_POST["tri"]) {
        $listegarage = $garagec->triGarage();
    } else if ($_POST["recherche"]) {
        $listegarage = $garagec->rechercheGarage($_POST["rech"]);
    } else
        $listegarage=$garagec->affichergarage();

if(isset($_POST['ajout']))
{
    header ('Location:add.php');
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Liste des garages</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/style.css">

	</head>

	<body>
	<section class="ftco-section">
		<div class="container">
            <h3 class="mb-4 text-center"><FONT COLOR="WHITE"><strong>Affichage des garages</strong></FONT></h3>
            <br>
            <br>
            <div class="form-group">
                <a href="add.php">
                    <button type="ajout" value="Ajouter" class="btn btn-primary">
                        Ajouter
                    </button>
                </a>
                <a href="http://localhost/pro/admin/admin_accounts.php">
                    <button type="ajout" value="Ajouter" class="btn btn-primary">
                      return to admin accounts
                    </button>
                </a>
                <form action="view.php" method="POST">
                    <input type="text" name="rech" class="form-control">
                    <br>
                    <input type="submit" name="recherche" value="Search" class="btn btn-primary">
                </form>
                <form action="view.php" method="POST">
                    <input type="submit" name="tri" value="Trier Par Nom" class="btn btn-primary">
                </form>
            </div>
            <table id="myTable" class="table table-striped" >  
                <thead>
                    <th><FONT COLOR="WHITE">ID</FONT></th>
                    <th><FONT COLOR="WHITE">Nom</FONT></th>
                    <th><FONT COLOR="WHITE">Date</FONT></th>
                    <th><FONT COLOR="WHITE">Prix</FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                </thead>
                <tbody>
                    <?PHP
				        foreach($listegarage as $garage){
			        ?>
                    <tr>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $garage['ID_garage']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $garage['Nom_garage']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $garage['Date_garage']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $garage['Prix_garage']; ?></FONT>
                        </td>
                        <td>
                            <div class="form-group">
                                <form method="POST" action="delete.php">
                                    <input type="submit" name="Supprimer" value="Supprimer" class="btn btn-primary">
                                    <input type="hidden" value=<?PHP echo $garage['ID_garage']; ?> name="ID_garage">
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <a href="modify.php?ID_garage=<?PHP echo $garage['ID_garage']; ?>">
                                    <input type="submit" value="Modfier" class="btn btn-primary">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?PHP
				        }
			        ?>
                </tbody>
            </table>
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.validate.min.js"></script>
  	<script src="js/main.js"></script>

	</body>
</html>

