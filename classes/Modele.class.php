<?php
require_once("DbTable.class.php");

class Modele extends DbTable {
	public $_maintable = "kunde";
	
    public function getByKpi($kpi)
	{
		$row = array();
		$arrReturn=array();
		$stat = "SELECT " . $kpi . " , count(*) total  " .
				" FROM " . $this->_maintable . 
				" group by  " . $kpi . 
				" order by total desc " ;
		$st = $this->DB->prepare($stat);
		$st->execute();
		$rows = $st->fetchAll();
		foreach($rows as $row)
		{
			$arrReturn[$row[$kpi]] = $row['total'];
			
		}
		return $arrReturn;
	}
	  
	public function createModele(
									$strname,
									$strsurname,
									$datebirthdate,
									$strstreet,
									$place,
									$strzip,
									$strtelefon,
									
									$stremail,
									$strbereich,
									$strcost,
									$strlast_shoting,
									$strsize,
									$strweight,
									$streye_color,
									
									$strkonfektion,
									$strbrast,
									$strtaille,
									$strbh,
									$strhare,
									$strhufte, 
									$strsedcard,
									
									$strbewertung, 
									$strnotice, 
									$strfoto1,
									$strfoto2,
									$strfoto3,
									$strfoto4,
									$iIduser
	  							)
	{
		$strschuhe='fdsf';				
		$stat = "INSERT INTO  " . $this->_maintable . " SET " .
				" name = :name, " .
				" surname = :surname, " .
				" birthdate = :birthdate, " .
				" street = :street, " .
				" place = :place, " .
				" zip = :zip, " .
				" telefon = :telefon, " . 
				
				" email = :email, " .
				" field = :field, " .
				" cost = :cost, " . 
				" size = :size, " .
				" weight = :weight, " .
				" eye_color = :eye_color, " .
				" last_shoting = :last_shoting, " .
									
				" konfektion = :konfektion, " .
				" brast = :brast, " .
				" taille = :taille, " .
				" bh = :bh, " .
				" hare = :hare, " .
				" hufte = :hufte, " . 
				" sedcard = :sedcard, " .
				
					
			    " notice = :notice, " .
				" schuhe = :schuhe, " .
				" bewertung = :bewertung, " .
				" foto1 = :foto1, " .
				" foto2 = :foto2, " . 
				" foto3 = :foto3, " .
				" foto4 = :foto4, " .
				" iduser = :iduser ";
		$st = $this->DB->prepare($stat);
		$st->bindParam(":name",				$strname, 		PDO::PARAM_STR);
		$st->bindParam(":surname",			$strsurname, 		PDO::PARAM_STR);
		$st->bindParam(":birthdate", 		$datebirthdate, 		PDO::PARAM_STR);
		$st->bindParam(":street", 		    $strstreet, 		PDO::PARAM_STR);
		$st->bindParam(":place", 		    $place, 	PDO::PARAM_STR);
		$st->bindParam(":zip", 			    $strzip, 			PDO::PARAM_STR);
		$st->bindParam(":telefon", 			$strtelefon, 			PDO::PARAM_STR);
		
		$st->bindParam(":email", 			$stremail, 			PDO::PARAM_STR);
		$st->bindParam(":field", 	$strbereich, 	PDO::PARAM_STR);
		$st->bindParam(":cost", 		$strcost, 	PDO::PARAM_BOOL);
		$st->bindParam(":last_shoting", 		$strlast_shoting, 		PDO::PARAM_STR);
		$st->bindParam(":size", 		$strsize, 		PDO::PARAM_STR);
		$st->bindParam(":weight", 		$strweight, 		PDO::PARAM_STR);
		$st->bindParam(":eye_color", 		$streye_color, 	PDO::PARAM_STR);
		
		
		$st->bindParam(":konfektion", 			$strkonfektion, 			PDO::PARAM_STR);
		$st->bindParam(":brast", 			$strbrast, 			PDO::PARAM_STR);
		$st->bindParam(":taille", $strtaille, 	PDO::PARAM_STR);
		$st->bindParam(":bh", 		$strbh, 	PDO::PARAM_BOOL);
		$st->bindParam(":hare", 		$strhare, 		PDO::PARAM_STR);
		$st->bindParam(":hufte", 		$strhufte, 		PDO::PARAM_STR);
		$st->bindParam(":sedcard", 		$strsedcard, 	PDO::PARAM_STR);
				
		
		$st->bindParam(":notice", 			$strnotice, 			PDO::PARAM_STR);
		$st->bindParam(":schuhe", 		$strschuhe, 		PDO::PARAM_STR);
		$st->bindParam(":bewertung", 			$strbewertung, 			PDO::PARAM_STR);
		$st->bindParam(":foto1", $strfoto1, 	PDO::PARAM_STR);
		$st->bindParam(":foto2", $strfoto2, 	PDO::PARAM_STR);
		$st->bindParam(":foto3", $strfoto3, 	PDO::PARAM_STR);
		$st->bindParam(":foto4", $strfoto4, 	PDO::PARAM_STR);
		$st->bindParam(":iduser",$iIduser, 	PDO::PARAM_STR);
		$st->execute();
		$iIdKundeNew = $this->DB->lastInsertId();
		return $iIdKundeNew;
	}


public function updModele(
									$strname,
									$strsurname,
									$datebirthdate,
									$strstreet,
									$place,
									$strzip,
									$strtelefon,
									
									$stremail,
									$strbereich,
									$strcost,
									$strlast_shoting,
									$strsize,
									$strweight,
									$streye_color,
									
									$strkonfektion,
									$strbrast,
									$strtaille,
									$strbh,
									$strhare,
									$strhufte, 
									$strsedcard,
									
									$strbewertung, 
									$strnotice, 
									$strfoto1,
									$strfoto2,
									$strfoto3,
									$strfoto4,
									$iIduser,
									$iIdmodel
									
	  							)
	{
		$strschuhe='fdsf';				
		$stat = "UPDATE  " . $this->_maintable . " SET " .
				" name = :name, " .
				" surname = :surname, " .
				" birthdate = :birthdate, " .
				" street = :street, " .
				" place = :place, " .
				" zip = :zip, " .
				" telefon = :telefon, " . 
				
				" email = :email, " .
				" field = :field, " .
				" cost = :cost, " . 
				" size = :size, " .
				" weight = :weight, " .
				" eye_color = :eye_color, " .
				" last_shoting = :last_shoting, " .
									
				" konfektion = :konfektion, " .
				" brast = :brast, " .
				" taille = :taille, " .
				" bh = :bh, " .
				" hare = :hare, " .
				" hufte = :hufte, " . 
				" sedcard = :sedcard, " .
				
					
			    " notice = :notice, " .
				" schuhe = :schuhe, " .
				" bewertung = :bewertung, " .
				" foto1 = :foto1, " .
				" foto2 = :foto2, " . 
				" foto3 = :foto3, " .
				" foto4 = :foto4, " .
				" iduser = :iduser " .
				" WHERE idmodel = :idmodel ";
				
				
		$st = $this->DB->prepare($stat);
		$st->bindParam(":name",				$strname, 		PDO::PARAM_STR);
		$st->bindParam(":surname",			$strsurname, 		PDO::PARAM_STR);
		$st->bindParam(":birthdate", 		$datebirthdate, 		PDO::PARAM_STR);
		$st->bindParam(":street", 		    $strstreet, 		PDO::PARAM_STR);
		$st->bindParam(":place", 		    $place, 	PDO::PARAM_STR);
		$st->bindParam(":zip", 			    $strzip, 			PDO::PARAM_STR);
		$st->bindParam(":telefon", 			$strtelefon, 			PDO::PARAM_STR);
		
		$st->bindParam(":email", 			$stremail, 			PDO::PARAM_STR);
		$st->bindParam(":field", 	$strbereich, 	PDO::PARAM_STR);
		$st->bindParam(":cost", 		$strcost, 	PDO::PARAM_BOOL);
		$st->bindParam(":last_shoting", 		$strlast_shoting, 		PDO::PARAM_STR);
		$st->bindParam(":size", 		$strsize, 		PDO::PARAM_STR);
		$st->bindParam(":weight", 		$strweight, 		PDO::PARAM_STR);
		$st->bindParam(":eye_color", 		$streye_color, 	PDO::PARAM_STR);
		
		
		$st->bindParam(":konfektion", 			$strkonfektion, 			PDO::PARAM_STR);
		$st->bindParam(":brast", 			$strbrast, 			PDO::PARAM_STR);
		$st->bindParam(":taille", $strtaille, 	PDO::PARAM_STR);
		$st->bindParam(":bh", 		$strbh, 	PDO::PARAM_BOOL);
		$st->bindParam(":hare", 		$strhare, 		PDO::PARAM_STR);
		$st->bindParam(":hufte", 		$strhufte, 		PDO::PARAM_STR);
		$st->bindParam(":sedcard", 		$strsedcard, 	PDO::PARAM_STR);
				
		
		$st->bindParam(":notice", 			$strnotice, 			PDO::PARAM_STR);
		$st->bindParam(":schuhe", 		$strschuhe, 		PDO::PARAM_STR);
		$st->bindParam(":bewertung", 			$strbewertung, 			PDO::PARAM_STR);
		$st->bindParam(":foto1", $strfoto1, 	PDO::PARAM_STR);
		$st->bindParam(":foto2", $strfoto2, 	PDO::PARAM_STR);
		$st->bindParam(":foto3", $strfoto3, 	PDO::PARAM_STR);
		$st->bindParam(":foto4", $strfoto4, 	PDO::PARAM_STR);
		$st->bindParam(":iduser",$iIduser, 	PDO::PARAM_STR);
		$st->bindParam(":idmodel",$iIdmodel, 	PDO::PARAM_STR);
		$st->execute();
		$iIdKundeNew = $this->DB->lastInsertId();
		return $iIdKundeNew;
	}
}
