<?php
/*
	functions start with push_, pull_, get_, do_ or is_
	push_ is to save to database
	pull_ is to pull from database, returns 1 or 0, saves the output array in $last_data
	get_ is to get usable values from functions
	do_ is for action that doesn't have a database push or pull
	is_ is for a yes/no answer
*/

class trac {

	function __construct () {
		
	}
	
	function push_visit ($post) {
		global $sql;
		$updated_on=time();

		$sql->executeSQL("INSERT INTO `trac` (`created_on`, `visit`) VALUES ('$updated_on', '".json_encode($post)."')");
		return $sql->lastInsertID();
	}
}

?>