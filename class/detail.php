<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/conn.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../class/pustaka.php';
$d 	= New FormatTanggal();
$n 	= New Nilai();
$u 	= New UkurJarak();

$op=isset($_GET['op'])?$_GET['op']:null;
switch($op){
case "jm_data_tmp":

	Connect::getConnection();
	$query = 	mysql_query(" SELECT id FROM tmp ");
	
	
	header("Content-Type:application/json");
	echo json_encode(mysql_num_rows($query));
	
	
	
break;
case "detail_lokasi_pegawai":

	$pegawai_id = $_GET['pegawai_id'];
	Connect::getConnection();
	$query = 	mysql_query(" SELECT * FROM pegawai WHERE  id = '$pegawai_id' ");
														
	
	if ( mysql_num_rows($query) >= 1 ){
	$data = mysql_fetch_object($query);
			//$jarak = $u->jarak($data->lat,$data->lon,-6.308959, 107.318455 ,'m');		



			$item = array(
						"id"			=>$data->id,
						"nama_pegawai"	=>$data->nama_pegawai,
						"nik"			=>$data->nik,
						"dept"			=>$data->dept,
						"latitude"		=>$data->lat,
						"longitude"	 	=>$data->lon,
						"notes"	 		=>$data->notes,
						//"jarak"			=>$jarak,
						
						);
		//Merubah data kedalam bentuk JSON
	}else{
		$item = array(
						"id"			=>"",
						"nama_pegawai"	=>"",
						"nik"			=>"",
						"dept"			=>"",
						"latitude"		=>"",
						"longitude"	 	=>"",
						"notes"	 		=>""
						
						);
	}
	
		header("Content-Type:application/json");
		echo json_encode($item);
	
	
	
break;
case "detail_lokasi_corona":

	$corona_id = $_GET['corona_id'];
	Connect::getConnection();
	$query = 	mysql_query(" SELECT * FROM corona WHERE  id = '$corona_id' ");
														
	
	if ( mysql_num_rows($query) >= 1 ){
	$data = mysql_fetch_object($query);
			
			$item = array(
						"id"			=>$data->id,
						"nama_lokasi"		=>$data->nama_lokasi,
						"kecamatan"		=>$data->kecamatan,
						"latitude"		=>$data->lat,
						"longitude"	 	=>$data->lon,
						"rad"			=>$data->rad,
						"color"			=>$data->color,
						"notes"	 		=>$data->notes
						
						);
		//Merubah data kedalam bentuk JSON
	}else{
		$item = array(
							"id"			=>"",
							"nama_lokasi"	=>"",
							"kecamatan"		=>"",
							"latitude"		=>"",
							"longitude"	 	=>"",
							"rad"			=>"",
							"color"			=>"",
							"notes"	 		=>"",
						
						);
	}
	
		header("Content-Type:application/json");
		echo json_encode($item);
	
	
	
break;
default;
header('HTTP/1.1 400 request error');
break;

}

?>


