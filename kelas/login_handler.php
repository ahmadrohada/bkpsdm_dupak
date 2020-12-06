<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 		= New FormatTanggal();

$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
$nama_user	 = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';

$op=isset($_POST['op'])?$_POST['op']:null;


//***************************************//
// FUNGSI YANG BERHUBUNGAN DENGAN LOgin //
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$//
//tes

if($op=='cek_login'){
	Connect::getConnection();
	$nama_user 	= addslashes(trim($_POST['nama_user']));	 
	$kata_sandi	= MD5(strtolower(trim($_POST['kata_sandi'])));	
	$sql=mysql_query("SELECT * FROM dt_dupak_pengguna where user_login='$nama_user' and password='$kata_sandi' ");
	
	$count=mysql_num_rows($sql);
	$rs=mysql_fetch_array($sql);
		if($count>0){
	
		//$x = mysql_fetch_object(mysql_query("SELECT kd_skpd FROM dt_pegawai WHERE id_pegawai = '$rs[id_pegawai]' "));
		
		$_SESSION['kd_skpd']		=  isset($rs['kd_skpd']) ? $rs['kd_skpd'] : '';
		//isi DATA USER pada session
		//session_start();
		$_SESSION['id_user'] 		= $rs['id'];
		$_SESSION['id_pegawai'] 	= $rs['id_pegawai'];
		$_SESSION['group'] 			= $rs['group'];
		$_SESSION['status_user'] 	= $rs['status'];
		
		$kd_skpd	= isset($rs['kd_skpd']) ? $rs['kd_skpd'] : 'x';
		//jika TU cari apakah data kepsek sudah terisi
		if ( $rs['group'] == 4){
			
			$x = mysql_num_rows(mysql_query("SELECT id FROM tb_dupak_sekolah WHERE kd_skpd = '$kd_skpd' "));
			if ( $x > 0 ){
				$_SESSION['status_sekolah'] = "1"; 
			}else{
				$_SESSION['status_sekolah'] = "0"; 
			}
		}
		
		
		
		
		
		//update info Login pada dt user
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
			$ip=$_SERVER['REMOTE_ADDR'];
			}
			$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			//var Y,m,d,H,i,s;
			date_default_timezone_set('Asia/Jakarta');
			$waktu = date('Y'."-".'m'."-".'d'." ".'H'.":".'i'.":".'s');
		$log = mysql_query("UPDATE dt_dupak_pengguna SET 
									time_log	='$waktu',
									ip_address	= '$ip',
									host_pc		= '$hostname'
									WHERE id = '$rs[id]' ");
		
		
		
		
		echo "sukses|".$kd_skpd."|".$rs['group'];
	}else{
		echo "error";
	}
//end function login //
	
	
	

		
}
?>