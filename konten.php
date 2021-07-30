<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php";</script><?php exit(); }  ?>


<?php
Connect::getConnection();
$id_user = $_SESSION['id_user'];

//tes

$sql=mysql_fetch_object(mysql_query("SELECT status FROM dt_dupak_pengguna where id='$id_user' "));
$_SESSION['status_user'] 	= $sql->status;

$ws=mysql_fetch_object(mysql_query("SELECT value FROM tb_pengaturan where setting='web_status' "));
// 0  = mtc mode
// 1 = aktif
//$status_web = 0;
$status_web = $ws->value; 
//echo $status_web ;


$pl=mysql_fetch_object(mysql_query("SELECT value FROM tb_pengaturan where setting='polling' "));
// 0 = polling tidak aktif
// 1 = polling aktif
$status_polling = $pl->value;


if ( $status_polling == 1 ){
	// cek status dari polling
	// 1  = sudah polling
	// 0 = belum polling

	
	//cek apakah pengguna sudah memberikan data polling apa belum
	$polling=mysql_num_rows(mysql_query("SELECT id FROM dt_polling where id_pengguna='$id_user' "));
}else{
	
	$polling = 1;
}

if (( $status_web == 0 ) && ( $group!='1') ){   //disabled kecuali admin
//if ( $status_web == 0 ) {						  //disabled all
		include ("files_common/perbaikan.php");  //mtc mode

}else if ( $_SESSION['status_user'] == '0'){
	
		include ("files_common/disable_account.php");  
	
}else if ( (  $polling == 0) && ( $group!='1') ){

		include ("files_common/polling.php");


}else {
	
if(isset($_GET['page'])){

	if($group=='5'){
		$page="files_guru/".$_GET['page'];	
	} else if($group=='4'){
		//Buat pengecualian untuk yang belum set sekolah
		if ( $_SESSION['status_sekolah'] == '0' ){
			$page="files_tu/setting";	
		}else{
			$page="files_tu/".$_GET['page'];	
		}
	} else if($group=='2'){
		$page="files_sekretariat/".$_GET['page'];	
	} else if($group=='3'){
		$page="files_penilai/".$_GET['page'];	
	} else if($group=='1'){
		$page="files_admin/".$_GET['page'];	
	}

	
	$file="$page.php";

	if (!file_exists($file)){
		include ("files_common/dashboard.php");
		//echo "<h2 class='error'>ERROR file tidak ditemukan</h2>";
	}else{
		//define('hda', TRUE);
		include ("$page.php");
	}
	
	$_SESSION['nama_file']= '';
}else{
	include ("files_common/dashboard.php");
}



} // end mtc mode
?>

