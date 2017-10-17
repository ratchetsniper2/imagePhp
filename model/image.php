<?php
  
  # Notion d'image
  class Image {
	  
    private $url = ""; 
    private $id = 0;
	private $category = "";
	private $comment = "";
    
    function __construct(string $u, int $id, string $cat, string $com) {
		$this->url = $u;
		$this->id = $id;
		$this->category = $cat;
		$this->comment = $com;
    }
    
    # Retourne l'URL de cette image
    function getURL() : string {
		return $this->url;
    }
    function getId() : int {
		return $this->id;
    }
	
	function getCategory() : string {
		return $this->category;
	}

	function getComment() : string {
		return $this->comment;
	}
	
  }