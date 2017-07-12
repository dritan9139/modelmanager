<?php
class DbTable 
{
	protected $DB;
	protected $statpart_select = "";
	protected $statpart_update = "";
	
	public $_maintable;
	public $_primary;
	protected $_fields;
	/*
	 * example
		array(	"idunterartikel" => "int",
				"artikelnummer" =>	"varchar",
				"bezeichnung" =>	"varchar",
				"lagerbestand" =>	"int",
				"wareneingang" =>	"date");
	*/							
	
	private function buildSelectPart()
	{
		$this->statpart_select = "";
		foreach( $this->_fields as $strField => $strFieldtype)
		{
			switch($strFieldtype)
			{
				case 'date':
				case 'datetime':					
					$this->statpart_select .= " UNIX_TIMESTAMP(" . $this->_maintable . "." . $strField . ") AS " . $strField . ", ";
					break;
				default:
					$this->statpart_select .= " " . $this->_maintable . "." . $strField . " AS " . $strField . ", ";
					break;
			}
		}
		$this->statpart_select .= " UNIX_TIMESTAMP(NOW()) AS servertime ";
	}
	
	function __construct()
	{
		$this->DB = $GLOBALS['DB'];
		$this->readColumns();
		$this->buildSelectPart();
	}
	
	public function readColumns()
	{
		$this->_fields = array();
		$stat = "SHOW COLUMNS FROM " . $this->_maintable; 
		$st = $this->DB->prepare($stat);
		$st->execute();
		$rows = $st->fetchAll();
		foreach( $rows as $row ) 
		{
			$this->_fields[$row['Field']] = $row['Type'];
			if( 'PRI'==$row['Key'] ) 
			{
				$this->_primary = $row['Field'];
			}
/*			
			Field
			Type
			Null
			Key
			Default
			Extra
*/			
		}
	}
	
	public function get($iId)
	{
		$row = array();
		$stat = "SELECT " . $this->statpart_select .
				" FROM " . $this->_maintable .
				" WHERE " . $this->_primary . " = :" . $this->_primary . " " ;
		$st = $this->DB->prepare($stat);
		$st->bindParam($this->_primary, $iId, PDO::PARAM_INT);
		$st->execute();
		$row = $st->fetch();
		return $row;
	}
		
	public function getAll( $strAdditionalSql = '')
	{
		$arrReturn = array();
		$rows = array();
		$stat = "SELECT " . $this->statpart_select .
				" FROM " . $this->_maintable .
				" WHERE 1 ";
		if( !empty($strAdditionalSql))
		{
			$stat .= $strAdditionalSql;
		}		
		$st = $this->DB->prepare($stat);
		$st->execute();
		$rows = $st->fetchAll();
		foreach($rows as $row)
		{
			$arrReturn[$row[$this->_primary]] = $row;
			
		}
		return $arrReturn;
	}
	
	public function cnt( $strAdditionalSql = '')
	{
		$arrReturn = array();
		$rows = array();
		$stat = "SELECT COUNT(*) AS anz " . 
				" FROM " . $this->_maintable .
				" WHERE 1 ";
		if( !empty($strAdditionalSql))
		{
			$stat .= $strAdditionalSql;
		}
		$st = $this->DB->prepare($stat);
		$st->execute();
		$row = $st->fetch();
		return $row['anz'];		
	}
		
	public function del($iId)
	{
		$bReturn = false;
		$stat = "DELETE FROM " . $this->_maintable .
				" WHERE " . $this->_primary . " = :" . $this->_primary . " ";
		$st = $this->DB->prepare($stat);
		$st->bindParam($this->_primary, $iId, PDO::PARAM_INT);
		$st->execute();
		if( $st->rowCount()>0 )
		{
			$bReturn = true;
		}
		else
		{
			$bReturn = false;
		}
		return $bReturn;
	}
	
	public function ins($arrValues)
	{
		$bReturn = false;
		$arrParams = array();
		$stat = "INSERT INTO " . $this->_maintable . " SET ";
		foreach( $this->_fields as $strField => $strFieldtype )
		{
			if( isset($arrValues[$strField]) )
			{
				switch($strFieldtype)
				{
					case 'date':
					case 'datetime':
						$stat .= " " . $strField . " = FROM_UNIXTIME(:" . $strField . "), ";
						break;
					default:
						$stat .= " " . $strField . " = :" . $strField . ", ";
						break;
				}
				$arrParams[$strField] = $arrValues[$strField];
			}
		}
		$stat = trim($stat, ", ");
		$st = $this->DB->prepare($stat);
		foreach( $arrParams as $strKey => $strValue )
		{
			$st->bindParam($strKey, $arrParams[$strKey]);
		}
		$st->execute();
		if( $st->rowCount()>0 )
		{
			$bReturn = $this->DB->lastInsertId(); ;
		}
		else
		{
			$bReturn = false;
		}
		return $bReturn;
	}
	
	public function upd($iId, $arrValues)
	{
		$bReturn = false;
		$arrParams = array();
		$stat = "UPDATE " . $this->_maintable . " SET ";
		foreach( $this->_fields as $strField => $strFieldtype )
		{
			if( isset($arrValues[$strField]) )
			{
				switch($strFieldtype)
				{
					case 'date':
					case 'datetime':
						$stat .= " " . $strField . " = FROM_UNIXTIME(:" . $strField . "), ";
						break;
					default:
						$stat .= " " . $strField . " = :" . $strField . ", ";
						break;
				}
				$arrParams[$strField] = $arrValues[$strField];
			}
		}
		$stat = trim($stat, ", ");
		$stat .= " WHERE " . $this->_primary . " = :".$this->_primary;
		$st = $this->DB->prepare($stat);
		$st->bindParam($this->_primary, $iId);
		foreach( $arrParams as $strKey => $strValue )
		{
			$st->bindParam($strKey, $arrParams[$strKey]);
		}
		$st->execute();
		if( $st->rowCount()>0 )
		{
			$bReturn = true;
		}
		else
		{
			$bReturn = false;
		}
		return $bReturn;
	}	
	
	public function export( $iId )
	{
		$arrDataset = $this->get($iId);
		if( false==$arrDataset )
		{
			return false;
		}
		$stat = "INSERT INTO " . $this->_maintable . " SET ";
		foreach( $this->_fields as $strField => $strFieldtype )
		{
			$strValue = $arrDataset[$strField];
			if( null == $strValue )
			{
				$stat .= " " . $strField . " = NULL, ";
				continue;				
			}
			switch($strFieldtype)
			{
				case 'date':
				case 'datetime':
					$stat .= " " . $strField . " = FROM_UNIXTIME(" . $this->DB->quote($strValue) . "), ";
					break;
				default:
					$stat .= " " . $strField . " = " . $this->DB->quote($strValue) . ", ";
					break;
			}
		}
		$stat = trim($stat, ", ") . ";";
		return $stat;
	}
}

