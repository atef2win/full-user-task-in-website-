<?PHP
	
	include("../../config.php");
	include ("../Model/garage.php");

	class garagec {
		function ajoutergarage($garage){
			 $sql="INSERT INTO garag (Nom_garage, Date_garage,Prix_garage) 
			 VALUES (:Nom_garage, :Date_garage, :Prix_garage)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
				'Nom_garage' => $garage->getNom(),
				'Date_garage' => $garage->getDate(),
		 		'Prix_garage' => $garage->getPrix()
			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function affichergarage(){
			$sql="SELECT * FROM garag";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
			
		}


        function supprimergarage($id){
			$sql="DELETE FROM garag WHERE ID_garage= :ID_garage";
			$conn = new config();
            $db=$conn->getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':ID_garage',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

        function modifiergarage($garage, $idgarg){
			
			try {
				
				$conn = new config();
            	$db=$conn->getConnexion();
				$query = $db->prepare(
					"UPDATE garag SET 
						Nom_garage = :Nom_garage,
						Date_garage = :Date_garage,
						Prix_garage = :Prix_garage
					    WHERE ID_garage = :ID_garage"
				);
				$query->execute([
					'Nom_garage' => $garage->getNom(),
					'Date_garage' => $garage->getDate(),
					'Prix_garage' => $garage->getPrix(),	
					'ID_garage' => $idgarg
				]);
				echo $query->execute;
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}


        function recuperergarage($idgarg){
			$sql="SELECT * from garag where ID_garage=$idgarg";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$garage=$query->fetch();
				return $garage;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

		function triGarage()
		{
			$sql = "SELECT * FROM garag order by Nom_garage";
			$conn = new config();
            $db=$conn->getConnexion();
			try {
				$list = $db->query($sql);
				return $list;
			} catch (Exception $e) {
				die('Erreur: ' . $e->getMessage());
			}
		}
		function rechercheGarage($rech)
		{
			$sql = "SELECT * FROM garag where garag.Nom_garage like '%$rech%'";
			$conn = new config();
            $db=$conn->getConnexion();
			try {
				$list = $db->query($sql);
				return $list;
			} catch (Exception $e) {
				die('Erreur: ' . $e->getMessage());
			}
		}

	}

?>