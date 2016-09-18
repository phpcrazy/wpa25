<?php 

function get_view($page, $data = null) {
	$file = "../app/view/" . $page . ".php";
	if(file_exists($file)) {
		ob_start();
		if($data != null) {
			extract($data);
		}
		require $file;	
		ob_end_flush();
	} else {
		trigger_error("You need to add view in view folder, Idiot!", E_USER_ERROR);
	}
}

 ?>