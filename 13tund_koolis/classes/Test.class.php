<?php
	class Test{
		//muutujad ehk properties
		private $secretNumber;
		public $publicNumber;
		
		function __construct($sentValue){
			$this->secretNumber = 10;
			$this->publicNumber = $sentValue * $this->secretNumber;
			echo "Salajane: " .$this->secretNumber ." ja " .$this->publicNumber;			
			
		}//construktor lõppeb
		
		function __destruct(){
			echo " Klass on valmis ja lõpetatud";
			
		}//destructor lõppeb
		
		//funktsioonid ehk metoths
		public function showValues(){
			echo "\n Salajane: " .$this->secretNumber ;
			$this->tellSecret();
		}
		
		private function tellSecret(){
			echo " Näidisklass on pea-aegu valmis!";
			
		}
	}//class lõppeb