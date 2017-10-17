<?php

class Home {
		
	public function indexAction(){
		$data["view"] = "homeView.php";
		
		$data["menu"]['Home'] = "index.php";
		$data["menu"]['A propos'] = "index.php?controller=home&action=aproposAction";
		$data["menu"]['Voir photos'] = "index.php?controller=photo&action=indexAction";
		
		require_once ("view/mainView.php");
	}
	
	public function aproposAction(){
		$data["view"] = "aproposView.php";
		
		$data["menu"]['Home'] = "index.php";
		$data["menu"]['A propos'] = "index.php?controller=home&action=aproposAction";
		$data["menu"]['Voir photos'] = "index.php?controller=photo&action=indexAction";
		
		require_once ("view/mainView.php");
	}
	
}