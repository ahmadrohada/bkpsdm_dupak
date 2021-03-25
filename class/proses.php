<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/conn.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../class/pustaka.php';
$d 	= New FormatTanggal();
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y'."-".'m'."-".'d'." ".'H'.":".'i'.":".'s');

$request=isset($_POST['req'])?$_POST['req']:null;

	
switch($request){
/** =================================================== **/
/** --------------- IMPORT DATA FROM TMP  ------------- **/
/** =================================================== **/	
case "import_data":

	
	$date 		= $d->tgl_sql($_POST['tanggal']);	
	$shift 		= $_POST['shift'];
	$class 		= $_POST['class'];
	$pic 		= "anonime";
	
	
	
	try{
		$query = $koneksi->prepare("INSERT INTO tb_breakcode  (work_date, shift, class, pic )
									VALUES(:a, 	:b, :c , :d)");
		$query->execute(array(
								"a" => $date,
								"b" => $shift,
								"c" => $class,
								"d" => $pic,
							));	
		$tb_breakcode_id = $koneksi->lastInsertId();
		//Import tmp to breakcode_data
		if ( $query ){
				$data_tmp = $koneksi->prepare(" SELECT 	* FROM tmp ");
				$data_tmp->execute();

				while($x = $data_tmp->fetch(PDO::FETCH_OBJ)) {
					$insert = $koneksi->prepare("INSERT INTO tb_breakcode_data  ( 	tb_breakcode_id, 
																					preform_id,
																					drawing_id,
																					rewind_id,
																					big_spool_id,
																					breakcode,
																					fiber_length,
																					worker_id,
																					class
																					)
					VALUES( :id, :a, :b, :c, :d, :e, :f, :g, :h )");
					
					$insert->execute(array(
										"id"=> $tb_breakcode_id,
										"a" => $x->a,
										"b" => $x->b,
										"c" => $x->c,
										"d" => $x->d,
										"e" => $x->e,
										"f" => $x->f,
										"g" => $x->g,
										"h" => $x->h,
										));	

				}
		}

		//After sukses
		//TRUNCATE LAGI tmp nya
		$delete = $koneksi->prepare("TRUNCATE TABLE tmp");
		$delete->execute();




	}
	catch ( PDOException $e)
	{
		header('HTTP/1.1 400 error'); //if error
	}





	
	/* if ( mysql_errno() == 0){
			header('HTTP/1.1 200 Sukses'); //if sukses
	}else{
			header('HTTP/1.1 500 Internal Server Error'); //if error
			echo mysql_error();
	}	
 */

break;
case "drawing_report_store":

	
	$date 		= Pustaka::tgl_sql_1($_POST['tanggal']);	
	$shift 		= $_POST['shift'];
	$class 		= $_POST['class'];
	$leader 	= $_POST['leader'];
	$suport_1 	= isset($_POST['suport_1'])?$_POST['suport_1']:"";
	$suport_2 	= isset($_POST['suport_2'])?$_POST['suport_2']:"";
	$suport_3 	= isset($_POST['suport_3'])?$_POST['suport_3']:"";
	
	
	
	try{
		$query = $koneksi->prepare("INSERT INTO tb_drawing_report  (work_date,shift,class,leader,suport_1,suport_2,suport_3  )
									VALUES(:a,:b,:c,:d,:e,:f,:g)");
		$query->execute(array(
								"a" => $date,
								"b" => $shift,
								"c" => $class,
								"d" => $leader,
								"e" => $suport_1,
								"f" => $suport_2,
								"g" => $suport_3
							));	
		

	}
	catch ( PDOException $e)
	{
		header('HTTP/1.1 400 error'); //if error
		echo $e;
	}

break;
/** =================================================== **/
/** ----------   HAPUS LOKASI PEGAWAI ----------------- **/
/** =================================================== **/	
case "hapus_lokasi_pegawai":

	if(isset($_SESSION['access_login'])){

		Connect::getConnection();
		$pegawai_id 	= $_POST['pegawai_id'];	
		
		
		$delete = @mysql_query("DELETE FROM pegawai WHERE id	= '$pegawai_id' ");
			
			
		
		if ( mysql_errno() == 0){
				header('HTTP/1.1 200 Sukses'); //if sukses
		}else{
				header('HTTP/1.1 500 Internal Server Error'); //if error
				echo mysql_error();
		}	
	}else{
		header('HTTP/1.1 403 Harus Login'); //if error
		echo "Silakan Login";
	}	


break;
/** =================================================== **/
/** ---------- UPDATE DATA PEGAWAI ----------------- **/
/** =================================================== **/	
case "update_data_pegawai":

	if(isset($_SESSION['access_login'])){
		Connect::getConnection();
		$id 				= $_POST['pegawai_id'];
		$nama_pegawai 		= $_POST['nama_pegawai'];	
		$nik 				= $_POST['nik'];
		$dept 				= $_POST['dept'];
		$latitude 			= $_POST['latitude'];
		$longitude 			= $_POST['longitude'];
		$notes 				= $_POST['notes'];


		$update = @mysql_query("UPDATE pegawai SET 
														nama_pegawai		= '$nama_pegawai',
														nik					= '$nik',
														dept				= '$dept',
														lat					= '$latitude',
														lon					= '$longitude',
														notes				= '$notes'
														
														WHERE id		= '$id' ");

		if ( mysql_errno() == 0){
			header('HTTP/1.1 200 Sukses'); //if sukses
		}else{
			header('HTTP/1.1 500 Internal Server Error'); //if error
			echo mysql_error();
		}	
	}else{
		header('HTTP/1.1 403 Harus Login'); //if error
		echo "Silakan Login";
	}	
break;
/** =================================================== **/
/** --------------- SIMPAN DATA CORONA  -------------- **/
/** =================================================== **/	
case "simpan_data_corona":

	if(isset($_SESSION['access_login'])){

		Connect::getConnection();
		$nama_lokasi 		= $_POST['nama_lokasi'];	
		$kecamatan 			= $_POST['kecamatan'];
		$latitude 			= $_POST['latitude'];
		$longitude 			= $_POST['longitude'];
		$notes 				= $_POST['notes'];
		$color 				= $_POST['color'];
		$rad 				= $_POST['rad'];
		
		$query = @mysql_query("INSERT INTO corona VALUES(
											'',
											'$nama_lokasi',
											'$kecamatan',
											'$latitude',
											'$longitude',
											'$rad',
											'$color',
											'$notes',
											'$waktu'
											)");
		
		
		
		if ( mysql_errno() == 0){
				header('HTTP/1.1 200 Sukses'); //if sukses
		}else{
				header('HTTP/1.1 500 Internal Server Error'); //if error
				echo mysql_error();
		}	
	}else{
		header('HTTP/1.1 403 Harus Login'); //if error
		echo "Silakan Login";
	}


break;
/** =================================================== **/
/** ---------- UPDATE DATA CORONA ----------------- **/
/** =================================================== **/	
case "update_data_corona":

	if(isset($_SESSION['access_login'])){

		Connect::getConnection();
		$id 				= $_POST['corona_id'];
		$nama_lokasi 		= $_POST['nama_lokasi'];	
		$kecamatan 			= $_POST['kecamatan'];
		$latitude 			= $_POST['latitude'];
		$longitude 			= $_POST['longitude'];
		$notes 				= $_POST['notes'];
		$rad 				= $_POST['rad'];
		$color 				= $_POST['color'];


		$update = @mysql_query("UPDATE corona SET 
														nama_lokasi		= '$nama_lokasi',
														kecamatan		= '$kecamatan',
														lat				= '$latitude',
														lon				= '$longitude',
														rad				= '$rad',
														color			= '$color',
														notes			= '$notes'
														
														
														WHERE id		= '$id' ");

		if ( mysql_errno() == 0){
			header('HTTP/1.1 200 Sukses'); //if sukses
		}else{
			header('HTTP/1.1 500 Internal Server Error'); //if error
			echo mysql_error();
		}	
	}else{
		header('HTTP/1.1 403 Harus Login'); //if error
		echo "Silakan Login";
	}

break;
/** =================================================== **/
/** ----------   HAPUS LOKASI COORNA ----------------- **/
/** =================================================== **/	
case "hapus_lokasi_corona":

	if(isset($_SESSION['access_login'])){

		Connect::getConnection();
		$corona_id 	= $_POST['corona_id'];	
		
		
		$delete = @mysql_query("DELETE FROM corona WHERE id	= '$corona_id' ");
			
			
		
		if ( mysql_errno() == 0){
				header('HTTP/1.1 200 Sukses'); //if sukses
		}else{
				header('HTTP/1.1 500 Internal Server Error'); //if error
				echo mysql_error();
		}	

	}else{
		header('HTTP/1.1 403 Harus Login'); //if error
		echo "Silakan Login";
	}
break;
default;
header('HTTP/1.1 400 request error');
break;
}

?>