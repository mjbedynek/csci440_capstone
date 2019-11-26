<?php

require_once "DB.php";

class User {

	// Instance variables
	private $dbh;
	private $authenticated;
	private $id;
	private $username;
	private $lastlogin;
	private $isadmin;

	// Constructor
	function __construct(&$pdo, $username, $password) {
		$this->dbh = $pdo;
		// See if user exists
		$sql = 'SELECT id, username, isadmin FROM users WHERE username = "' . $username.
				'" AND password = "'.$password.'"';
		$res = $this->dbh->query($sql)[0];

		if ($res) {
			//Remove after testing complete
			//var_dump($res);

			// Store instance vars for obj
			$this->id = $res['id'];
			$this->username = $res['username'];
			$this->lastlogin = $res['lastlogin'];
			// Recast string value to boolean
			$this->isadmin = filter_var($res['isadmin'], FILTER_VALIDATE_BOOLEAN);
			$this->authenticated = true;
		}
	}

	// Return id (from DB)
	public function getID() {
		return $this->id;
	}

	// Return username for object
	public function getUserName() {
		return $this->username;
	}

	// Return if user is admin
	public function isAdmin() {
		return $this->isadmin;
	}

	public function isAuthenticated() {
		return $this->authenticated;
	}

	// Change the user's password
	//public function setPassword() {
	//}
}

?>
