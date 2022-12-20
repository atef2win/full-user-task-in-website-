<?PHP
	class garage{
		private $ID_garage;
		private $Nom_garage;
		private $Date_garage;
		private $Prix_garage;		
		
		function __construct($Nom, $Date, $Prix)
        {
            $this->Nom_garage = $Nom;
            $this->Date_garage = $Date;
            $this->Prix_garage = $Prix;
		}
		
		function getNom(){
			return $this->Nom_garage;
		}
		function getDate(){
			return $this->Date_garage;
		}
		function getPrix(){
			return $this->Prix_garage;
		}
		
		function setnom($Nom): void{
			$this->Nom_garage=$Nom;
		}
		function setdate($Date): void{
			$this->Date_garage=$Date;
		}
		function setprix(int $Prix): void{
			$this->Prix_garage=$Prix;
		}
	}

?>