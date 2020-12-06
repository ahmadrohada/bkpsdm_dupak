<?php
include_once 'database.php';


class KelolaPegawai {
	// Method Tambah Data Anggota
	function TampilDataPegawai($table,$data){
		$table = new Db($table);
		$table->field=$data['field'];		$table->jika=$data['jika'];		
		//$table->jika='dt_pegawai.kd_skpd = kd_skpd.kd_skpd and ( kd_skpd.sekolah LIKE "%SDN%" or kd_skpd.sekolah LIKE "%SMPN%" or kd_skpd.sekolah LIKE "%SMAN%" or kd_skpd.sekolah LIKE "%SMKN%" )';
		$table->urut='dt_pegawai.nama asc';		$data['limit'] = isset ($data['limit']) ? $data['limit'] : '';
		$table->limit=$data['limit'];
		$data = $table->tampil();
		return $data;				
	}
	
	function DetailDataPegawai($wh) {
		$table = new Db('dt_pegawai');
		$table->field="*";
		$table->jika=$wh;
		$table->limit="1";
	
		try{
		$x 			= $table->tampil();
		$y       	= $x->current();
		}catch(Exception $e){
			echo "<p class=error>".$e->getMessage()."</p>";
		}
	
		return $y;	
	}
	function TambahDataPegawai($x){
		$data = new Db('dt_pegawai');
		try{
			$data->simpan($x);
		//exit;
		}catch(Exception $e){
		//echo 'Gagal Menyimpan Data';
		echo $e->getMessage();
		}	
	}	function UpdateDataPegawai($data,$where){		$peg = new Db('dt_pegawai');		try{			$peg->update($data,$where);		//exit;		}catch(Exception $e){		//echo 'Gagal Menyimpan Data';		echo $e->getMessage();		}	}
	
}
	
class KelolaDataDupak{
	function TampilDataDupak($tabel,$data){
		$table = new Db($tabel);
		$table->field=$data['field'];
		$table->jika=$data['jika'];				$data['urut'] = isset ($data['urut']) ? $data['urut'] : 'tgl_entry desc';
		$table->urut=$data['urut'];
				$data['limit'] = isset ($data['limit']) ? $data['limit'] : '';		$table->limit=$data['limit'];		
		$data = $table->tampil();
		return $data;
	}

	function TambahDataDupak($table,$x){
		$pak = new Db($table);
		try{
			$pak->simpan($x);			$tes = "sukses";
		//exit;
		}catch(Exception $e){
			$tes = "gagal".$e->getMessage();
		//echo $e->getMessage();
		}		return $tes;
	}
	
	function UpdateDataDupak($table,$data,$where){
		$pak = new Db($table);
		try{
			$pak->update($data,$where);
		//exit;
		}catch(Exception $e){
		//echo 'Gagal Menyimpan Data';
		echo $e->getMessage();
		}
	}
}class KelolaDataPak{	function TampilDataPak($tabel,$data){		$table = new Db($tabel);		$table->field=$data['field'];		$table->jika=$data['jika'];		$table->urut="tgl_entry DESC";		$table->limit = isset($data['limit']) ? $data['limit'] : '';		$data = $table->tampil();		return $data;	}		function TambahDataPak($table,$x){		$pak = new Db($table);		try{			$pak->simpan($x);			$tes = "sukses";		//exit;		}catch(Exception $e){			$tes = "gagal".$e->getMessage();		//echo $e->getMessage();		}		return $tes;	}}
class KelolaDataPiki{		function TambahDataPiki($table,$x){		$pak = new Db($table);		try{			$pak->simpan($x);			$tes = "sukses";		//exit;		}catch(Exception $e){			$tes = "gagal".$e->getMessage();		//echo $e->getMessage();		}		return $tes;	}}
class KelolaPengguna {	// Method Tambah Data Pengguna	function TampilDataPengguna($tabel,$data){		$table = new Db($tabel);		$table->field=$data['field'];		$table->jika=$data['jika'];		$table->urut="time_log desc";		$data['limit'] = isset ($data['limit']) ? $data['limit'] : '';		$table->limit=$data['limit'];		$data = $table->tampil();		return $data;			}		function DetailDataUser($wh) {		$table = new Db('user_dupak');		$table->field="*";		$table->jika=$wh;		$table->limit="1";			try{		$x 			= $table->tampil();		$y       	= $x->current();		}catch(Exception $e){			echo "<p class=error>".$e->getMessage()."</p>";		}			return $y;		}	function TambahDataUser($x){		$data = new Db('user_dupak');		try{			$data->simpan($x);		//exit;		}catch(Exception $e){		//echo 'Gagal Menyimpan Data';		echo $e->getMessage();		}		}	}class KelolaPengumuman {	function TampilDataPengumuman(){				$table = new Db('tb_pengumuman');		$table->field="*";		$table->jika="";		$table->urut="";		$data['limit'] = isset ($data['limit']) ? $data['limit'] : '';		$table->limit=$data['limit'];				$data = $table->tampil();		return $data;			}}

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
					}							$tanggal = isset($tanggal) ? $tanggal : '';		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';		$tahun = isset($tahun) ? $tahun : '';		
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
					}		$tanggal = isset($tanggal) ? $tanggal : '';		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';		$tahun = isset($tahun) ? $tahun : '';
		$data=$tanggal.'   '.$nm_bulan.'  '.$tahun;
	return $data;
	}
	function tgl_sql($data){
		$x			= explode('-',$data);
		$tanggal 	= $x[0];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[2];
		$tanggal = isset($tanggal) ? $tanggal : '';		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';		$tahun = isset($tahun) ? $tahun : '';		$data= $tahun."-".$nm_bulan."-".$tanggal;
	return $data;
	}
	
	function tgl_form($data){
		$x			= explode('-',$data);
		$tanggal 	= $x[2];
		$nm_bulan 	= $x[1];
		$tahun 		= $x[0];
						$tanggal = isset($tanggal) ? $tanggal : '';		$nm_bulan = isset($nm_bulan) ? $nm_bulan : '';		$tahun = isset($tahun) ? $tahun : '';		$data= $tanggal.'-'.$nm_bulan.'-'.$tahun;
	return $data;
	}
}

?>