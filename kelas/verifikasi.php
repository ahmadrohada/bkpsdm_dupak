<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 		= New FormatTanggal();

$kd_skpd 		= isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
$id_penilai		= isset($_SESSION['id_pegawai']) ? $_SESSION['id_pegawai'] : '';
$op				=isset($_GET['op'])?$_GET['op']:null;
$no_dupak		=isset($_GET['no_dupak'])?$_GET['no_dupak']:null;

//CARI STEP Untuk memastikan proses sedang penilai 1 atau 2
Connect::getConnection();
$tes = mysql_fetch_object(mysql_query("SELECT step FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
	if ( ( $tes->step >= 7 ) && ( $tes->step <=12  )){
		//$tbl_penilai 	= "tb_dupak_penilai1";
		$proses			= "penilai_1";
	} else if ( ( $tes->step >= 13 ) && ( $tes->step <=18  )){
		//$tbl_penilai 	= "tb_dupak_penilai2";
		$proses			= "penilai_2";
	}


	
// ============================****************************=============================== 
//terdapat 4 proses
//cek 		= mengecek apakah data sudah verifikasi atau belum,
//simpan 		= menyimpan hasil verifikasi
//terima		= menerima hasil dupak
//tolak		= menolak hasil dupak
// =========================================================================================**/ 
	

switch($op){
case "cek_penilai":
	$q = mysql_fetch_object(mysql_query("SELECT id_penilai_1,id_penilai_2,step,status_dupak from dt_dupak WHERE no_dupak = '$no_dupak' "));
	
	$a = $q->id_penilai_1;
	$b = $q->id_penilai_2;
	$c = $q->step;
	
	// P1 // P2 // progress P1 // Progress P2 // id skarang
	
	
	if ( ( $a == '' ) && ( $b == '' ) && ( $a != $id_penilai )&& ( $b != $id_penilai ) ) 	$cek = '00000'; //belum dinilai
	
	
	if ( ( $a != '' ) && ( $b == '' ) && ( $c < 13) && ( $a != $id_penilai )&& ( $b != $id_penilai ))	$cek = '10000'; //penilai sudah P1 tapi belum selesai dinilai oleh P1 //bukan p1
	if ( ( $a != '' ) && ( $b == '' ) && ( $c < 13) && ( $a == $id_penilai )&& ( $b != $id_penilai ))	$cek = '10001'; //penilai sudah P1 tapi belum selesai dinilai oleh P1 // adalah p1
	
	if ( ( $a != '' ) && ( $b == '' ) && ( $c >= 13) && ( $a != $id_penilai )&& ( $b != $id_penilai ))	$cek = '10100'; //penilai sudah P1 sudah selesai dinilai oleh P1 //bukan p1 
	if ( ( $a != '' ) && ( $b == '' ) && ( $c >= 13) && ( $a == $id_penilai )&& ( $b != $id_penilai ))	$cek = '10101'; //penilai sudah P1 sudah selesai dinilai oleh P1 // adalah p1
	
	if ( ( $a != '' ) && ( $b != '' ) && ( $c < 19)	&& ( $a != $id_penilai )&& ( $b != $id_penilai ))	$cek = '11100'; //penilai sudah P2 tapi belum selesai dinilai oleh P2  // bukan p1 atau p2
	if ( ( $a != '' ) && ( $b != '' ) && ( $c < 19)	&& ( $a == $id_penilai )&& ( $b != $id_penilai ))	$cek = '11101'; //penilai sudah P2 tapi belum selesai dinilai oleh P2  // adalah p1
	if ( ( $a != '' ) && ( $b != '' ) && ( $c < 19)	&& ( $a != $id_penilai )&& ( $b == $id_penilai ))	$cek = '11102'; //penilai sudah P2 tapi belum selesai dinilai oleh P2  // adalah p2
	
		if ( ( $a != '' ) && ( $b != '' ) && ( $c >= 19)	&& ( $a != $id_penilai )&& ( $b != $id_penilai ))	$cek = '11110'; //penilai sudah P2 sudah selesai dinilai oleh P2  // bukan p1 atau p2
	if ( ( $a != '' ) && ( $b != '' ) && ( $c >= 19)	&& ( $a == $id_penilai )&& ( $b != $id_penilai ))	$cek = '11111'; //penilai sudah P2 sudah selesai dinilai oleh P2  // adalah p1
	if ( ( $a != '' ) && ( $b != '' ) && ( $c >= 19)	&& ( $a != $id_penilai )&& ( $b == $id_penilai ))	$cek = '11112'; //penilai sudah P2 sudah selesai dinilai oleh P2  // adalah p2
	
	
	echo $cek;
	
break;
/** ==================== VERIFIKASI DATA DUPAK ===================== **/
case "simpan_dupak":
	
	
	if ( $proses == "penilai_1" ) {
		$step   = "8";
		$ket	='p1';
		$id		= "id_penilai_1";
	}
	if ( $proses == "penilai_2" ) {
		$step 	= "14";
		$ket	='p2';
		$id		= "id_penilai_2";
	}
	Connect::getConnection();
	//Update Step dulu coy
	$update=mysql_query("UPDATE dt_dupak SET step = '$step', ".$id." = '$id_penilai' where no_dupak='$no_dupak' ") or die( mysql_error());
	
	//buat tabel penilaian
	$x= array(
		'no_dupak'		=> $no_dupak,
		'id_penilai'	=> $id_penilai,
		'p_01'		=> '00',
		'p_01_1'	=> '00',
		'p_02'		=> '00',
		'p_02_1'	=> '00',
		'p_03'		=> '00',
		'p_03_1'	=> '00',
		'p_03_1_1'	=> '00',
		'p_03_2'	=> '00',
		'p_03_2_1'	=> '00',
		'p_03_2_2'	=> '00',
		'p_03_3'	=> '00',
		'p_03_3_1'	=> '00',
		'p_03_3_2'	=> '00',
		'p_03_3_3'	=> '00',
		'p_04'		=> '00',
		'p_05'		=> '00',
		'p_06'		=> '00',
		'p_07'		=> '00',
		'p_08'		=> '00',
		'p_09'		=> '00',
		'p_10'		=> '00',
		'p_11'		=> '00',
		'p_12'		=> '00',
		'p_13'		=> '00',
		'p_14'		=> '00',
		'p_15'		=> '00',
		'p_15_a'	=> '00',
		'p_16'		=> '00',
		'p_17'		=> '00',
		'p_18'		=> '00',
		'p_19'		=> '00',
		'p_20'		=> '00',
		'p_21'		=> '00',
		'p_22'		=> '00',
		'p_23'		=> '00',
		'p_24'		=> '00',
		'p_25'		=> '00',
		'p_26'		=> '00',
		'p_27'		=> '00',
		'p_28'		=> '00',
		'p_29'		=> '00',
		'p_30'		=> '00',
		'p_31'		=> '00',
		'p_32'		=> '00',
		'p_33'		=> '00',
		'p_34'		=> '00',
		'p_35'		=> '00',
		'p_36'		=> '00',
		'p_37'		=> '00',
		'p_38'		=> '00',
		'p_39'		=> '00',
		'p_40'		=> '00',
		'p_41'		=> '00',
		'p_42'		=> '00',
		'p_43'		=> '00',
		'p_44'		=> '00',
		'p_45'		=> '00',
		'p_46'		=> '00',
		'p_47'		=> '00',
		'p_48'		=> '00',
		'p_49'		=> '00',
		'p_50'		=> '00',
		'p_51'		=> '00',
		'p_52'		=> '00',
		'p_53'		=> '00',
		'p_54'		=> '00',
		'p_55'		=> '00',
		'p_56'		=> '00',
		'p_57'		=> '00',
		'p_58'		=> '00',
		'p_59'		=> '00',
		'p_60'		=> '00',
		'p_61'		=> '00',
		'p_62'		=> '00',
		'p_63'		=> '00',
		'p_64'		=> '00',
		'p_65'		=> '00',
		'p_66'		=> '00',
		'p_67'		=> '00',
		'p_68'		=> '00',
		'p_69'		=> '00',
		'p_70'		=> '00',
		'p_71'		=> '00',
		'p_72'		=> '00',
		'p_73'		=> '00',
		'p_74'		=> '00',
		'p_75'		=> '00',
		'p_76'		=> '00',
		'p_77'		=> '00',
		'p_78'		=> '00',
		'p_79'		=> '00',
		'keterangan'=> $ket,
		'tgl_penilaian'	=> date('Y'."-".'m'."-".'d'." ".'H'.":".'i'.":".'s')
		
		);
		$pak = New KelolaDataDupak();
		$pak->TambahDataDupak('tb_dupak_penilai',$x);	
	
break;
case "cek_dupak":
	//mengecek apak dupak sudah di verifikasi apa belum
	//cari data penilaian
	$cari = mysql_num_rows(mysql_query("SELECT id from tb_dupak_penilai WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai'  "));
	
	echo $cari;
	
break;

/** ==================== VERIFIKASI DUPAK ===================== **/
case "terima_dupak":
	$string = $_GET['kd_keg'];
	$kd_keg = "p_".str_replace(".", "_", $string);
	Connect::getConnection();
	
	
	//$update = mysql_query("UPDATE dt_penilai SET pend	='diterima' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='1' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	
	//echo $update;
break;
case "tolak_dupak":
	$string = $_GET['kd_keg'];
	$kd_keg = "p_".str_replace(".", "_", $string);
	Connect::getConnection();
	
	
	//$update = mysql_query("UPDATE dt_penilai SET pend	='ditolak' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='0' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");

break;
case "simpan_pendidikan":

	
	if ( $proses == "penilai_1" ) $step = "9";
	if ( $proses == "penilai_2" ) $step = "15";
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak SET 
									step	='$step'
									WHERE no_dupak = '$no_dupak' ");


break;
case "cek_pendidikan":

	Connect::getConnection();
	$cek = mysql_fetch_object(mysql_query("SELECT pend from dt_penilai WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai'  "));
	
	if ( $cek->pend == "0" ){
		echo "0";
	}else{
		echo $cek->pend;
	}


break;

//** ==================== VERIFIKASI DATA PBT ===================== **/
case "simpan_pbt":
	
	if ( $proses == "penilai_1" ) $step = "10";
	if ( $proses == "penilai_2" ) $step = "16";
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak SET 
									step	='$step'
									WHERE no_dupak = '$no_dupak' ");


break;



//** ==================== VERIFIKASI DATA PKB ===================== **/
case "simpan_pkb":
	
	if ( $proses == "penilai_1" ) $step = "11";
	if ( $proses == "penilai_2" ) $step = "17";
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak SET 
									step	='$step'
									WHERE no_dupak = '$no_dupak' ");


break;

//** ==================== VERIFIKASI DATA PIKI ===================== **/
case "simpan_piki":
	
	if ( $proses == "penilai_1" ) $step = "12";
	if ( $proses == "penilai_2" ) $step = "18";
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak SET 
									step	='$step'
									WHERE no_dupak = '$no_dupak' ");


break;
//** ==================== VERIFIKASI DATA PENUNJANG ===================== **/
case "simpan_penunjang":
	
	if ( $proses == "penilai_1" ) {
	$step = "13";
	$level = "level_2";
	}
	if ( $proses == "penilai_2" ) {
	$step = "19";
	$level = "level_3";
	}
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak SET 
									step	='$step',
									status_dupak='$level'
									WHERE no_dupak = '$no_dupak' ");


break;
//** ==================== UBAH KETERANGAN DIKLAT TERIMA/TOLAK ===================== **/
case "v_ket_diklat":
	Connect::getConnection();
	$id_diklat		=isset($_GET['id_diklat'])?$_GET['id_diklat']:'';
	$ket			=isset($_GET['ket'])?$_GET['ket']:'';
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak_diklat SET 
									keterangan	='$ket'
									WHERE id = '$id_diklat'");

	//cari no _dupak nya
	$x = mysql_fetch_object(mysql_query("SELECT no_dupak,kode_kegiatan FROM dt_dupak_diklat WHERE id='$id_diklat' "));
	$no_dupak	= $x->no_dupak;
	$string		= $x->kode_kegiatan;
	$kd_keg = "p_".str_replace(".", "_", $string);
	//apakah ada salah satu diklat yang diterima
	$query	= mysql_num_rows(mysql_query("SELECT id FROM dt_dupak_diklat WHERE no_dupak ='$no_dupak' and keterangan='diterima'  and kode_kegiatan='$x->kode_kegiatan'  "));
	
	if ( $query >= 1){
		$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='1' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	}else{
		$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='0' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	}
	
	
break;
//** ==================== UBAH KETERANGAN KEGIATAN KOLEKTIF TERIMA/TOLAK ===================== **/
case "v_ket_kk":
	Connect::getConnection();
	$id_kk			=isset($_GET['id_kk'])?$_GET['id_kk']:'';
	$ket			=isset($_GET['ket'])?$_GET['ket']:'';
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak_kegiatan_kolektif SET 
									keterangan	='$ket'
									WHERE id = '$id_kk'");

	//cari no _dupak nya
	$x = mysql_fetch_object(mysql_query("SELECT no_dupak,kode_kegiatan FROM dt_dupak_kegiatan_kolektif WHERE id='$id_kk' "));
	$no_dupak	= $x->no_dupak;
	$string		= $x->kode_kegiatan;
	$kd_keg = "p_".str_replace(".", "_", $string);
	//apakah ada salah satu diklat yang diterima
	$query	= mysql_num_rows(mysql_query("SELECT id FROM dt_dupak_kegiatan_kolektif WHERE no_dupak ='$no_dupak' and keterangan='diterima' and kode_kegiatan='$x->kode_kegiatan' "));
	
	if ( $query >= 1){
		$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='1' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	}else{
		$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='0' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	}

break;
//** ==================== UBAH KETERANGAN PIKI TERIMA/TOLAK ===================== **/
case "v_ket_piki":
	Connect::getConnection();
	$id_piki		=isset($_GET['id_piki'])?$_GET['id_piki']:'';
	$ket			=isset($_GET['ket'])?$_GET['ket']:'';
	
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak_piki SET 
									keterangan	='$ket'
									WHERE id = '$id_piki'");

	//cari no _dupak nya
	$x = mysql_fetch_object(mysql_query("SELECT no_dupak,kd_kegiatan FROM dt_dupak_piki WHERE id='$id_piki' "));
	$no_dupak	= $x->no_dupak;
	$string		= $x->kd_kegiatan;
	$kd_keg = "p_".str_replace(".", "_", $string);
	//apakah ada salah satu diklat yang diterima
	$query	= mysql_num_rows(mysql_query("SELECT id FROM dt_dupak_piki WHERE no_dupak ='$no_dupak' and kd_kegiatan = '$string' and keterangan='diterima' "));
	
	if ( $query >= 1){
		$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='1' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	}else{
		$update = mysql_query("UPDATE tb_dupak_penilai SET ".$kd_keg."='0' WHERE no_dupak = '$no_dupak' and id_penilai='$id_penilai' ");
	}

break;
}
?>