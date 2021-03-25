<?php
	header("Content-Type:application/json");
	session_start();
	include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../config/Koneksi.php';
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../kelas/ssp.php';
 

	$tb				= isset($_GET['tb'])?$_GET['tb']:null;
	$d 				= New FormatTanggal();
	
switch($tb){
case "pengguna_list":
		
	//$table = 'dt_dupak_pengguna';
	$table = '
				(
					SELECT a.* ,b.sekolah, a.group AS user_group
							
						FROM dt_dupak_pengguna AS a 
						LEFT JOIN kd_skpd AS b ON a.kd_skpd = b.kd_skpd
				) temp
				';
	$primaryKey = 'id';
	$columns = array(
		array( 'db' => 'id',			'dt' => 'id' ),
		array( 'db' => 'nip_pengguna',	'dt' => 'nip_pengguna' ),
		array( 'db' => 'nama_pengguna',	'dt' => 'nama_pengguna' ),
		array(
			'db' 	=> 'jk',
			'dt' 	=> 'jk',
			'formatter' =>  function( $x ){
				if ($x == 1 ){
					return "L";
				}else{
					return "P";
				}
			} 
		),
		array( 'db' => 'user_login',	'dt' => 'username' ),
		array(
			'db' 	=> 'user_group',
			'dt' 	=> 'user_group',
			'formatter' =>  function( $x ){

				if ( $x == 1 ) return "Admin";
				if ( $x == 2 ) return "Sekretariat";
				if ( $x == 3 ) return "Penilai";
				if ( $x == 4 ) return "Opr Sekolah";
			} 
		),



		
		array( 'db' => 'sekolah',		'dt' => 'sekolah' ),
		array(
			'db' 	=> 'time_log',
			'dt' 	=> 'last_log',
			'formatter' =>  function( $x ) use($d){
				return $d->tgl_jam_short($x);
			} 
		),
	);
 
	
	
	echo json_encode(
		SSP::simple( $_GET, $conn, $table, $primaryKey, $columns )
	);
break;
default;
header('HTTP/1.1 400 request error');
break;
}
?>