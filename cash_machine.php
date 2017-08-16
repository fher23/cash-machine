<?php

class Cajero{
	public $denominaciones = array(
		20,
		10,
		100,
		50
	);
	function __construct() {
		echo "Bienvenido<br/>";
		$this->_getDenominaciones();
	}
	public function _retiro($cantidad){
		if($cantidad%10 <> 0){
			echo "La cantidad a retirar debe ser multiplo de 10";
			return false;
		}
		echo "Se entregan:<br/>";
		foreach($this->_menosBilletes($cantidad) as $key_b => $val_b){
			if($val_b > 0){
				echo $val_b . " billete(s) de " . $key_b . "<br/>";
			}
		}
	}
	public function _menosBilletes($cantidad = 0){
		if($cantidad <= 0){
			echo "No es posible realizar la operacion.";
			return false;
		}
		rsort($this->denominaciones);
		$billetes = array();
		foreach($this->denominaciones as $key => $val){
			if($cantidad > 0){
				$billetes[$val] = floor($cantidad / $val);
				$cantidad = $cantidad%$val;
				
			}
		}
		return $billetes;
	}
	public function _getDenominaciones(){
		echo "Las denominaciones disponibles son:<br/>";
		sort($this->denominaciones);
		foreach($this->denominaciones as $key => $val){
			echo $val."<br/>";
		}
	}
}


$cajero = new Cajero();

if(!empty($_POST['cantidad'])){
	$cajero->_retiro($_POST['cantidad']);
}


echo "<html>";
echo "<body>";
echo "<form action='' method='post'>";
echo "<input type='text' value='' name='cantidad' />";
echo "<input type='submit' value='Retirar' />";
echo "</form>";
echo "</body>";
echo "</html>";