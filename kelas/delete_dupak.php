<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';

	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();

		$delete 	= mysql_query("DELETE FROM dt_dupak WHERE no_dupak ='$no_dupak'");
		$delete5 	= mysql_query("DELETE FROM tb_dupak_guru_ak WHERE no_dupak ='$no_dupak'");
		$delete5 	= mysql_query("DELETE FROM tb_dupak_guru_f WHERE no_dupak ='$no_dupak'");
		$delete1 	= mysql_query("DELETE FROM dt_dupak_diklat WHERE no_dupak ='$no_dupak'");
		$delete2	= mysql_query("DELETE FROM dt_dupak_kegiatan_kolektif WHERE no_dupak ='$no_dupak'");
		$delete3	= mysql_query("DELETE FROM dt_dupak_piki WHERE no_dupak ='$no_dupak'");
		$delete4 	= mysql_query("DELETE FROM dt_dupak_tugas_tambahan WHERE no_dupak ='$no_dupak'");
		$delete5 	= mysql_query("DELETE FROM tb_dupak_guru_ak WHERE no_dupak ='$no_dupak'");
		$delete6 	= mysql_query("DELETE FROM tb_dupak_guru_f WHERE no_dupak ='$no_dupak'");
	
	echo $no_dupak." sukses dihapus";
?>