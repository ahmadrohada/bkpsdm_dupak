<?php


include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/conn.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../class/pustaka.php';
$d 	= New FormatTanggal();
$n 	= New Nilai();
$u 	= New UkurJarak();

$op=isset($_GET['op'])?$_GET['op']:null;
switch($op){
case "status_drawing_report":
	


	$shift_now 		= Pustaka::shift_now();
	$work_date_now	= Pustaka::work_date_now();

	//cari report drawing dengan tanggal dan shift diatas
	$query = $koneksi->prepare(" SELECT id  FROM tb_drawing_report  
											WHERE work_date = '$work_date_now' 
											AND shift = '$shift_now' ");
	$query->execute();
	$count = $query->rowCount(PDO::FETCH_OBJ);
	if ( $count >= 1 ){
		$x = $query->fetch(PDO::FETCH_OBJ);
	}

	$item = array(
			"count"				=> $count,
			"shift_now"			=> $shift_now,
			"work_date_now"		=> $work_date_now,
			"work_date_now"		=> Pustaka::tgl_hari_2($work_date_now),
			"report_id"			=> isset($x->id)?$x->id:null,
	);

	echo json_encode($item);

	
break;
case "detail_drawing_report":
	


	$id = $_GET['id'];

	$query = $koneksi->prepare(" SELECT a.*,
										b.nama AS leader,
										c.nama AS suport_1,
										d.nama AS suport_2,
										e.nama AS suport_3,
										f.nama AS suport_4,
										g.nama AS suport_5

											FROM tb_drawing_report  AS a
											LEFT JOIN users AS b ON b.id = a.leader
											LEFT JOIN users AS c ON c.id = a.suport_1
											LEFT JOIN users AS d ON d.id = a.suport_2
											LEFT JOIN users AS e ON e.id = a.suport_3
											LEFT JOIN users AS f ON f.id = a.suport_4
											LEFT JOIN users AS g ON g.id = a.suport_5

											WHERE a.id = '$id' ");
	$query->execute();
	$x = $query->fetch(PDO::FETCH_OBJ);


	$item = array(
			"id"				=> $id,
			"shift"				=> $x->shift,
			"work_date"			=> Pustaka::tgl_hari_2($x->work_date),
			"class"				=> $x->class,
			"leader"			=> $x->leader,
			"suport_1"			=> $x->suport_1,
			"suport_2"			=> $x->suport_2,
			"suport_3"			=> $x->suport_3,
			"suport_4"			=> $x->suport_4,
			"suport_5"			=> $x->suport_5,
	);

	echo json_encode($item);

	
break;

case "drawing_report_data":

	$id = $_GET['drawing_report_id'];

	$response = array();
	$response["data"] = array();
	$drawing_id = array('101','102','103','104');

	for ($i = 0; $i <= 3; $i++){

		$query = $koneksi->prepare(" SELECT a.*,b.nama AS nama_pic	FROM tb_drawing_report_data a
												LEFT JOIN users b ON b.id = a.pic_id
												WHERE drawing_report_id = '$id' AND drawing_id = '$drawing_id[$i]' ");
		$query->execute();
		$x = $query->fetch(PDO::FETCH_OBJ);

		if ( $x != "" ){
			$h['drawing_id']			= $drawing_id[$i];
			$h['drawing_report_id']		= $x->drawing_report_id;
			$h['nama_pic']				= $x->nama_pic;

			$h['df_1']					= ($x->df_1 > 0)?$x->df_1:'';
			$h['df_2']					= ($x->df_2 > 0)?$x->df_2:'';
			$h['df_3']					= ($x->df_3 > 0)?$x->df_3:'';
			$h['df_4']					= ($x->df_4 > 0)?$x->df_4:'';
			$h['df_5']					= ($x->df_5 > 0)?$x->df_5:'';
			$h['df_6']					= ($x->df_6 > 0)?$x->df_6:'';
			$h['df_7']					= ($x->df_7 > 0)?$x->df_7:'';
			$h['df_8']					= ($x->df_8 > 0)?$x->df_8:'';
			$h['df_9']					= ($x->df_9 > 0)?$x->df_9:'';
			$h['df_10']					= ($x->df_10 > 0)?$x->df_10:'';
			$h['df_11']					= ($x->df_11 > 0)?$x->df_11:'';
			$h['df_12']					= ($x->df_12 > 0)?$x->df_12:'';
			$h['df_13']					= ($x->df_13 > 0)?$x->df_13:'';
			$h['df_14']					= ($x->df_14 > 0)?$x->df_14:'';
			$h['df_15']					= ($x->df_15 > 0)?$x->df_15:'';
			$h['df_16']					= ($x->df_16 > 0)?$x->df_16:'';
			$h['df_17']					= ($x->df_17 > 0)?$x->df_17:'';
			$h['df_18']					= ($x->df_18 > 0)?$x->df_18:'';
			$h['df_19']					= ($x->df_19 > 0)?$x->df_19:'';
			$h['df_20']					= ($x->df_20 > 0)?$x->df_20:'';
			$h['df_21']					= ($x->df_21 > 0)?$x->df_21:'';
			$h['df_22']					= ($x->df_22 > 0)?$x->df_22:'';
			$h['df_23']					= ($x->df_23 > 0)?$x->df_23:'0';
			$h['df_24']					= ($x->df_24 > 0)?$x->df_24:'0';
			array_push($response["data"], $h);
			
		}else{
			$h['drawing_id']			= $drawing_id[$i];
			$h['drawing_report_id']		= '';
			$h['nama_pic']				= '';

			$h['df_1']					= '-';
			$h['df_2']					= '-';
			$h['df_3']					= '-';
			$h['df_4']					= '-';
			$h['df_5']					= '-';
			$h['df_6']					= '-';
			$h['df_7']					= '-';
			$h['df_8']					= '-';
			$h['df_9']					= '-';
			$h['df_10']					= '-';
			$h['df_11']					= '-';
			$h['df_12']					= '-';
			$h['df_13']					= '-';
			$h['df_14']					= '-';
			$h['df_15']					= '-';
			$h['df_16']					= '-';
			$h['df_17']					= '-';
			$h['df_18']					= '-';
			$h['df_19']					= '-';
			$h['df_20']					= '-';
			$h['df_21']					= '-';
			$h['df_22']					= '-';
			$h['df_23']					= '-';
			$h['df_24']					= '-';
			
			array_push($response["data"], $h);
			
		}

		

	}



	if (mysql_errno() == 0){
		echo json_encode($response);
		//header('HTTP/1.1 200 Sukses'); //if sukses
	}else{
		header('HTTP/1.1 400 error'); //if error
	}

	
break;
case "user_list":
	
	$nama = isset($_GET['nama'])?$_GET['nama']:null;


	$query = $koneksi->prepare(" SELECT 	
										a.id,
										a.nama
										FROM users a 
										WHERE nama LIKE '%$nama%'		
										
										ORDER by a.nama ASC ");

		
	$no = 0;
	$query->execute();

	while($x = $query->fetch(PDO::FETCH_OBJ)) {
				$no++;
				$item[] = array(
							'no'		=> $no,
							'id'		=> $x->id,
							'nama'		=> $x->nama,
				);

	}	
		
	if ($no!=0){
		header('HTTP/1.1 200 Sukses'); //if sukses
		echo json_encode($item);
		
	}else{
		header('HTTP/1.1 400 error'); //if error
	}

	
break;
case "leader_list":
	
	$nama = isset($_GET['nama'])?$_GET['nama']:null;


	$query = $koneksi->prepare(" SELECT 	
										a.id,
										a.nama
										FROM users a 
										WHERE nama LIKE '%$nama%'	
										AND role = 'leader'	
										
										ORDER by a.nama ASC ");

		
	$no = 0;
	$query->execute();

	while($x = $query->fetch(PDO::FETCH_OBJ)) {
				$no++;
				$item[] = array(
							'no'		=> $no,
							'id'		=> $x->id,
							'nama'		=> $x->nama,
				);

	}	
		
	if ($no!=0){
		header('HTTP/1.1 200 Sukses'); //if sukses
		echo json_encode($item);
		
	}else{
		header('HTTP/1.1 400 error'); //if error
	}

	
break;
default;
header('HTTP/1.1 400 request error');
break;

}

?>


