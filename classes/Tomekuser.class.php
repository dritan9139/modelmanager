<?php
require_once("DbTable.class.php");

class Tomekuser extends DbTable {
	public $_maintable = "user";
      
	public function getUserByCredentials($strUname, $strPasswd)
	{
		$row = array();
		$stat = "SELECT iduser, uname, role, updated, inserted " .
				" FROM " . $this->_maintable . 
				" WHERE uname = :uname " . 
				" AND passwd = :passwd" ;
		$st = $this->DB->prepare($stat);
		$st->bindParam(':uname', $strUname, PDO::PARAM_STR);
		$st->bindParam(':passwd', $strPasswd, PDO::PARAM_STR);
		$st->execute();
		if( ($row = $st->fetch())!=false )
		{
			return $row;
		}
		return false;
	}
     public function createUser($uname,
                                $email, 			
								$passwd
								)
	{							
	$role="user";
	$stat = "INSERT INTO  " . $this->_maintable . " SET " .
				" uname = :uname, " .
				" email = :email, " .
				" passwd = :passwd, " .
				" role = :role, " .
				" is_activ = 0, " .
				" inserted = now(), " .
				" updated = now() " ;
		$st = $this->DB->prepare($stat);
		$st->bindParam(":uname",				$uname, 		PDO::PARAM_STR);
		$st->bindParam(":email",			    $email, 		PDO::PARAM_STR);
		$st->bindParam(":passwd",			    $passwd, 		PDO::PARAM_STR);
		$st->bindParam(":role", 		        $role, 		PDO::PARAM_STR);
		$st->execute();
		$iIdKundeNew = $this->DB->lastInsertId();
	}
}
