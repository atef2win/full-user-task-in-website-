<?PHP
	include "../Controller/garagec.php";

	$garagec=new garagec();
	
	if (isset($_POST["ID_garage"])){
		$garagec->supprimergarage($_POST["ID_garage"]);
		header ('Location:view.php');
	}
?>