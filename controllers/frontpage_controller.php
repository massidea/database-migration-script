<?php
class FrontpageController extends AppController {
	
	// Ei käytä mitään tietokantaa
	var $uses = null;
	
	function index() {
		$this->set('title_for_layout', 'Etusivu');
		$this->set('content_for_layout', 'Etusivu');
	}	
}

?>
