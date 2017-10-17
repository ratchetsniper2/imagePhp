<?php

class Home {
		
	public function indexAction(){
		$view = "homeView.php";
		
		$menu['Home'] = "index.php";
		$menu['A propos'] = "index.php?controller=home&action=aproposAction";
		$menu['Voir photos'] = "index.php?controller=photo&action=indexAction";
		
		require_once ("view/mainView.php");
	}
	
	public function aproposAction(){
		$view = "aproposView.php";
		
		$menu['Home'] = "index.php";
		$menu['A propos'] = "index.php?controller=home&action=aproposAction";
		$menu['Voir photos'] = "index.php?controller=photo&action=indexAction";
		
		require_once ("view/mainView.php");
	}
	
}