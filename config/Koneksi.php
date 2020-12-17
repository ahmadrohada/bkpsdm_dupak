<?php
class Connect {
	protected static $_connection;
	public static function getConnection(){
		if(!self::$_connection){
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpassword = '';
			$dbname ='pak_baru';
			self::$_connection = @mysql_connect($dbhost, $dbuser, $dbpassword);
			if(!self::$_connection){
				throw new Exception('Gagal melalukan koneksi ke database. '.mysql_error());
			}
			$result = @mysql_select_db($dbname, self::$_connection);
			if(!$result){
				throw new Exception('Koneksi gagal:'.mysql_error() );
			}
		}
		return self::$_connection;
	}

		public static function getConnection2(){
		if(!self::$_connection){
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpassword = '';
			$dbname ='pak_baru';
			self::$_connection = @mysql_connect($dbhost, $dbuser, $dbpassword);
			if(!self::$_connection){
				throw new Exception('Gagal melalukan koneksi ke database. '.mysql_error());
			}
			$result = @mysql_select_db($dbname, self::$_connection);
			if(!$result){
				throw new Exception('Koneksi gagal:'.mysql_error() );
			}
		}
		return self::$_connection;
	}
 
	public static function close(){
		if(self::$_connection){
			mysql_close(self::$_connection);
		}

	}

} 

$koneksi = new Connect();
