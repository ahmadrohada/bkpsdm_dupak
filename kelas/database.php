<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/Koneksi.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'select.php';
class Db {
	protected  $_tableName;
	function __construct($tableName){
		$this->_tableName = $tableName;
	}
 
	public function connect(){
		return Connect::getConnection();
	}
 
	public function close(){
		Connect::close();
	}
 
function simpan(array $data){ //CREATE
		$sql = "INSERT INTO `".$this->_tableName."` SET";
		
		
		foreach($data as $field => $value){
			$sql .= " `".$field."`='".mysql_real_escape_string($value, Connect::getConnection())."',";
		}
		
		$sql = rtrim($sql, ',');
		$result = mysql_query($sql, Connect::getConnection());
		if(!$result){
			//throw new Exception('<a href="'.$_SERVER['HTTP_REFERER'].'" class="error" >Gagal menyimpan data ke table '.$this->_tableName.': '.mysql_error().'</a>'); // error message jika gagal entry data
			throw new Exception('Gagal menyimpan data ke table '.$this->_tableName.': '.mysql_error()); // error message jika gagal entry data
		}
	}
 
 
	
	function tampil(){ //READ
		
		
		
		
		$sql  ="SELECT ".$this->field." ";
	
		$sql .="FROM ".$this->_tableName." ";
		
		if($this->jika!=null){
		$sql .="WHERE ".$this->jika." ";}
	
		if($this->urut!=null){
		$sql .="ORDER BY ".$this->urut." ";}
		
		if($this->limit!=null){
		$sql .="LIMIT ".$this->limit." ";}
		
		return new Select($sql);
	}
	
	function update(array $data, $where = ''){ //UPDATE
		$sql = "UPDATE `".$this->_tableName."` SET";
		foreach($data as $field => $value){
			$sql .= " `".$field."`='".mysql_real_escape_string($value, Connect::getConnection())."',";
		}
		$sql = rtrim($sql, ',');
		if($where){
			$sql .= " WHERE ".$where;
		}
		$result = mysql_query($sql, Connect::getConnection());
		if(!$result){
			throw new Exception('<a href="'.$_SERVER['HTTP_REFERER'].'" class="error" >Gagal mengupdate data table '.$this->_tableName.': '.mysql_error().'</a>');
		}
	}
 
	function hapus($where){ //DELETE
		$sql = "DELETE FROM `".$this->_tableName."`";
		if($where){
			$sql .= " WHERE ".$where;
		}
		$result = mysql_query($sql, Connect::getConnection());
		if(!$result){
			throw new Exception('Gagal menghapus data dari table '.$this->_tableName.': '.mysql_error());
		}
	}
 
	
	
 
	
	
}
