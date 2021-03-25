<?php
 
date_default_timezone_set('Asia/Jakarta');


class Pustaka {

	function tgl_sql_1($data){
		
		if ( $data != null ){
			$dt			= explode(',',$data);
			$x			= explode('-',trim($dt[1]));


		}else{
			$x = "00-00-0000";
		}

		
		

		$tanggal 	= $x[0];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[2];

		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';

		$data= $tahun."-".$nm_bulan."-".$tanggal;
	return $data;
	}

	static function tgl_hari( $data )
	{
		$x			= explode('-',$data);
		$tanggal 	= $x[2];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[0];

		//HARI
		/* $tgl=substr($tanggal,8,2);
		$bln=substr($tanggal,5,2);
		$thn=substr($tanggal,0,4);
	  */
		$info=date('w', mktime(0,0,0,$nm_bulan,$tanggal,$tahun));
		
		switch($info){
			case '0': $hari = "Minggu"; 
			break;
			case '1': $hari = "Senin"; 
			break;
			case '2': $hari = "Selasa"; 
			break;
			case '3': $hari = "Rabu"; 
			break;
			case '4': $hari = "Kamis"; 
			break;
			case '5': $hari = "Jumat"; 
			break;
			case '6': $hari = "Sabtu"; 
			break;
			default : $hari = "-"; 
			break;
		};
	
			
		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';
	
		$data= $hari.'<br>'.$tanggal.'-'.$nm_bulan.'-'.$tahun;
		return $data;
		
	}
	static function tgl_hari_2( $data )
	{
		$x			= explode('-',$data);
		$tanggal 	= $x[2];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[0];

		//HARI
		/* $tgl=substr($tanggal,8,2);
		$bln=substr($tanggal,5,2);
		$thn=substr($tanggal,0,4);
	  */
		$info=date('w', mktime(0,0,0,$nm_bulan,$tanggal,$tahun));
		
		switch($info){
			case '0': $hari = "Minggu"; 
			break;
			case '1': $hari = "Senin"; 
			break;
			case '2': $hari = "Selasa"; 
			break;
			case '3': $hari = "Rabu"; 
			break;
			case '4': $hari = "Kamis"; 
			break;
			case '5': $hari = "Jumat"; 
			break;
			case '6': $hari = "Sabtu"; 
			break;
			default : $hari = "-"; 
			break;
		};
	
			
		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';
	
		$data= $hari.', '.$tanggal.'-'.$nm_bulan.'-'.$tahun;
		return $data;
		
	}



	static function shift_now( )
	{
		$jam = date("H");


		if (  $jam <= 7  ){
			$shift_now = 3 ;
		}else if ( ( $jam >= 8 ) & ( $jam <= 15 )  ){
			$shift_now = 1 ;
		}else if (   $jam >= 16  ){
			$shift_now = 2 ;
		}else{
			$shift_now = "-" ;
		}


		return $shift_now;
		
	}

	static function work_date_now( )
	{
		$work_date_now = date("Y-m-d");
		$jam = date("H");

		if (  $jam <= 7  ){
			$work_date_now = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
		}else{
			$work_date_now = date("Y-m-d");
		}

		return $work_date_now;
		
	}


}


class UkurJarak{
	function jarak($latitude1, $longitude1, $latitude2, $longitude2, $unit ) 
	{ 
		$theta = $longitude1 - $longitude2; 
		$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
		$distance = acos($distance); 
		$distance = rad2deg($distance); 
		$distance = $distance * 60 * 1.1515; 
		switch($unit) 
		{ 
			case 'Mi'	: break; 
			case 'Km' 	: $distance = $distance * 1.609344; 
			case 'm' 	: $distance = $distance * 1609.344; 
		} 
		return (round($distance,2)); 
	}
}





class FormatTanggal{

	function balik($data){
		$tanggal = substr($data,8,2); 
		$bulan = substr($data,5,2); 
		$tahun = substr($data,0,4); 

		//ubah angka ke nama bulan
				switch($bulan)
					{
				case 01 : $nm_bulan='Jan';
						break;
				case 02 : $nm_bulan='Feb';
						break;
				case 03 : $nm_bulan='Mar';
						break;
				case 04 : $nm_bulan='Apr';
						break;
				case 05 : $nm_bulan='Mei';
						break;
				case 06 : $nm_bulan='Jun';
						break;
				case 07 : $nm_bulan='Jul';
						break;
				case 8 : $nm_bulan='Agust';
						break;
				case 9 : $nm_bulan='Sept';
						break;
				case 10 : $nm_bulan='Okt';
						break;
				case 11 : $nm_bulan='Nov';
						break;
				case 12 : $nm_bulan='Des';
						break;
					}

					
		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';
		
		$data=$tanggal.'   '.$nm_bulan.'  '.$tahun;
	return $data;

	}

	

	function balik2($data){
		$tanggal = substr($data,8,2); 
		$bulan = substr($data,5,2); 
		$tahun = substr($data,0,4); 


		//ubah angka ke nama bulan
				switch($bulan)
					{
				case 01 : $nm_bulan='Januari';
						break;
				case 02 : $nm_bulan='Februari';
						break;
				case 03 : $nm_bulan='Maret';
						break;
				case 04 : $nm_bulan='April';
						break;
				case 05 : $nm_bulan='Mei';
						break;
				case 06 : $nm_bulan='Juni';
						break;
				case 07 : $nm_bulan='Juli';
						break;
				case 8 : $nm_bulan='Agustus';
						break;
				case 9 : $nm_bulan='September';
						break;
				case 10 : $nm_bulan='Oktober';
						break;
				case 11 : $nm_bulan='November';
						break;
				case 12 : $nm_bulan='Desember';
						break;
					}

		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';
		$data=$tanggal.'   '.$nm_bulan.'  '.$tahun;
	return $data;
	}

	function tgl_sql($data){
		
		if ( $data != null ){
			$x			= explode('-',$data);
		}else{
			$x = "00-00-0000";
		}
		

		$tanggal 	= $x[0];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[2];

		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';

		$data= $tahun."-".$nm_bulan."-".$tanggal;
	return $data;
	}

	public static function tgl_jam_short($data) {
       
		$x		= explode(' ', $data);
		$tgl	= $x[0];
		$jam 	= $x[1];
		$jam 	= substr($jam,0,5); 

		$tanggal = substr($tgl,8,2); 
		$bulan = substr($tgl,5,2); 
		$tahun = substr($tgl,0,4); 

		
		$tanggal = isset($tanggal) ? $tanggal : '';
		$tahun = isset($tahun) ? $tahun : '';
		
		$data=$tanggal.'-'.$bulan.'-'.$tahun;
	return $data . "&nbsp;&nbsp;[" .$jam. "]" ;

	}

	function tgl_form($data){

		$x			= explode('-',$data);
		$tanggal 	= $x[2];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[0];

		
		
		$tanggal = isset($tanggal) ? $tanggal : '';
		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';
		$tahun = isset($tahun) ? $tahun : '';

		$data= $tanggal.'-'.$nm_bulan.'-'.$tahun;
	return $data;
	}
	function bulan($data){
		
		$bulan = $data; 

		//ubah angka ke nama bulan
				switch($bulan)
					{
				case 01 : $nm_bulan='Januari';
						break;
				case 02 : $nm_bulan='Februari';
						break;
				case 03 : $nm_bulan='Maret';
						break;
				case 04 : $nm_bulan='April';
						break;
				case 05 : $nm_bulan='Mei';
						break;
				case 06 : $nm_bulan='Juni';
						break;
				case 07 : $nm_bulan='Juli';
						break;
				case 8 : $nm_bulan='Agustus';
						break;
				case 9 : $nm_bulan='September';
						break;
				case 10 : $nm_bulan='Oktober';
						break;
				case 11 : $nm_bulan='November';
						break;
				case 12 : $nm_bulan='Desember';
						break;
					}

					
		
		$data=$nm_bulan;
	return $data;

	}
	
	
	
	function namahari($tanggal){
    
		//fungsi mencari namahari
		//format $tgl YYYY-MM-DD
		//harviacode.com
		
		$tgl=substr($tanggal,8,2);
		$bln=substr($tanggal,5,2);
		$thn=substr($tanggal,0,4);
	 
		$info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
		
		switch($info){
			case '0': return "Minggu"; break;
			case '1': return "Senin"; break;
			case '2': return "Selasa"; break;
			case '3': return "Rabu"; break;
			case '4': return "Kamis"; break;
			case '5': return "Jumat"; break;
			case '6': return "Sabtu"; break;
		};
		
	}

}

// FUNGSI ubah nilai ke keterangan
	
class Nilai{
	
	function perilaku($data){
				if ($data == 0 ){
					$keterangan = "Buruk";
				}else if ($data <= 50 ){
					$keterangan = "Buruk";
				}else if ($data <= 60) {
					$keterangan = "Kurang";
				}else if ($data <= 75) {
					$keterangan = "Cukup";
				}else if ($data <= 90) {
					$keterangan = "Baik";
				}else if ($data >=90.001) {
					$keterangan = "Sangat Baik";
				}
				
				
				
	return $keterangan;
	}
	
	function warna($data){
				if ($data == 0 ){
					$warna = "#afaeb2";
				}else if ($data <= 50 ){
					$warna = "#ef302e";
				}else if ($data <= 60) {
					$warna = "#d9e746";
				}else if ($data <= 75) {
					$warna = "#e7c646";
				}else if ($data <= 90) {
					$warna = "#68e746";
				}else if ($data >=90.001) {
					$warna = "#0044c7";
				}
				
				
				
	return $warna;
	}
	
	
	function persen_tpp ($ave_capaian){
		
			if ( $ave_capaian >=85 ){
					//$jumlah_tpp = $dt['tpp'];
					$persen_tpp = "100 %";
				}else if ( $ave_capaian < 50 ){
					$jumlah_tpp = "0";
					$persen_tpp = "0";
				}else{
					//$x			 = ($ave_capaian - 50 )/35 *100;
					
					//$x			= 50 + ((100-50)/(85-50)) * ($ave_capaian-50);
					$x				= number_format( (50 + (1.43*($ave_capaian-50))),2 );
					//$jumlah_tpp 	= ($x/100)*$dt['tpp'];
					$persen_tpp		= $x." %";
				}
		
		
	return $persen_tpp;
	}
	
	
	
	
}

?>