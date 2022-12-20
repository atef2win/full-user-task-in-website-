<?PHP
	class employe{
		private $idEmp;
		private $email;
		private $name;
		private $salaire;	
		private $idg;	
		
		function __construct($email, $name, $salaire,$idg)
        {
            $this->email = $email;
            $this->name = $name;
            $this->salaire = $salaire;
			$this->idg = $idg;
		}
		

		function getEmail(){
			return $this->email;
		}
		function getName(){
			return $this->name;
		}
		function getSalaire(){
			return $this->salaire;
		}
		function getIDG(){
			return $this->idg;
		}

		

	}

?>