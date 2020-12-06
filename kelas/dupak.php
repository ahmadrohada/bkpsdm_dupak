<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 				= New FormatTanggal();


$kd_skpd 		= isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
$nama_user	 	= isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';
$id_tu		 	= isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';

$op=isset($_GET['op'])?$_GET['op']:null;


/* ===================== PROSES PENGISIAN DUPAKOLEH TE UUUU ============== 
update 	= untuk update step setelah satu  sub di isi 
simpan	= memulai pengisian dupak oleh TU
load	= pengambilan dAta dupak untuk dimasukan ke form
add		= tambah data sub dupak

======================================================================== */






if($op=='simpan_dupak'){
	//session_start();
	Connect::getConnection();
	$id_pegawai = $_GET['id_pegawai'];

	/* ********************************************************************************** 
	-------------------- PROSES GENERATE NO DUPAK AJUAN ---------------------------------
	================================================================================= */

		//$th 			= date(Y);


		//update terbaru jika pakai tgl now, akan error makanya pakai tgl sesuai thn ajuan aja
		//$th				= date('Y');
		$th = substr($_GET['a'],6,4); 
		
		//cari index terakhir SUBSTRING_INDEX(tgl_entry,'-',1)
		$cek = mysql_query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(no_dupak,'/',2),'/',-1) as no FROM dt_dupak WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(no_dupak,'/',5),'/',-1)= '$th' ORDER BY SUBSTRING_INDEX(SUBSTRING_INDEX(no_dupak,'/',2),'/',-1) DESC LIMIT 1");
		if ( mysql_num_rows($cek) != 0 ) {
			//ambil no index
			$cari_index 	= mysql_fetch_object($cek);
			$x 		= $cari_index->no;
			$no_index_baru 	= $x+1;
		} else 	{
			$no_index_baru 	= 1;

		}

				
		//echo $no_index_baru;
		$jm=strlen($no_index_baru);
		switch($jm)
		{
		case 1 : $no='0000'.$no_index_baru;
			break;
		case 2 : $no='000'.$no_index_baru;
			break;
		case 3 : $no='00'.$no_index_baru;
			break;
		case 4 : $no='0'.$no_index_baru;
			break;
		case 5 : $no=$no_index_baru;
			break;
		}
		//echo $x;
		// NO DUPAK AJUAN




		//ini no dupak dengan tahuna berjalan
		//$no_dupak_ajuan = '800/'.$no.'/TP.GURU/DUPAK/'.$th;


		//trial dengan tahuna sesuai penilaian
		$tahun_dupak = substr($_GET['a'],6,4); 
		$no_dupak_ajuan = '800/'.$no.'/TP.GURU/DUPAK/'.$tahun_dupak;



	/** ********************************************************************************** **/
	/** ------------------- END PROSES GENERATE NO DUPAK AJUAN ------------------------------- */
	/** ================================================================================= */
	$cek1 = mysql_num_rows(mysql_query("SELECT no_dupak FROM tb_dupak_guru_ak WHERE no_dupak = '$no_dupak_ajuan' "));
	$cek2 = mysql_num_rows(mysql_query("SELECT no_dupak FROM tb_dupak_guru_f WHERE no_dupak = '$no_dupak_ajuan' "));
	if ( ( $cek1 == 0  ) & ( $cek2 == 0  ) )	{
	//input ke tabel DUPAK-Pribadi
	$x= array(
		'id'					=> '',
		'no_dupak'				=> $no_dupak_ajuan,
		'id_pegawai'			=> $_GET['id_pegawai'],
		'id_tu'					=> $_SESSION['id_user'],
		'id_kepsek'				=> $_GET['n'],
		'id_pengantar'	=> '',
		'id_penilai_1'			=> '',
		'id_penilai_2'			=> '',
		'id_pejabat'			=> '',
		'tgl_dupak'				=> date('Y-m-d'),
		'tgl_mulai'				=> $d->tgl_sql($_GET['a']),
		'tgl_sampai'			=> $d->tgl_sql($_GET['b']),
		'pkg'					=> '',
		'nama_gol'				=> $_GET['c'],
		'tmt_gol'				=> $d->tgl_sql($_GET['d']),
		'tmt_jafung'			=> $d->tgl_sql($_GET['e']),
		'kd_jenis_guru'			=> $_GET['f'],
		'mk_gol_bln'			=> $_GET['g'],
		'mk_gol_thn'			=> $_GET['h'],
		'gelar_dpn'				=> $_GET['i'],
		'gelar_blk'				=> $_GET['j'],
		//'kd_pend_usul'			=> $_GET['k'],
		//'jurusan_pend_usul'		=> $_GET['l'],
		//'th_lulus'				=> $_GET['m'],
		
		
		'kd_skpd'				=> $_SESSION['kd_skpd'],
		'status_dupak'			=> 'level_1',
		'step'					=> '1'
		);
		$pak = New KelolaDataDupak();
		$q1 = $pak->TambahDataDupak('dt_dupak',$x);		
		
		//echo $q1;
		
		if ( $q1 == 'sukses' ){
			//input ke tabel dupak_ak
			$y= array(
				'no_dupak'	=> $no_dupak_ajuan,
				'id_pegawai'=> $_GET['id_pegawai'],
				'ak_01'		=> '200.000',
				'ak_01_1'	=> '50.000',
				'ak_02'		=> '150.000',
				'ak_02_1'	=> '50.000',
				'ak_03'		=> '100.000',
				'ak_03_1'	=> '60.000',
				'ak_03_1_1'	=> '40.000',
				'ak_03_2'	=> '25.000',
				'ak_03_2_1'	=> '60.000',
				'ak_03_2_2'	=> '40.000',
				'ak_03_3'	=> '15.000',
				'ak_03_3_1'	=> '75.000',
				'ak_03_3_2'	=> '20.000',
				'ak_03_3_3'	=> '35.000',
				'ak_04'		=> '3.000',
				'ak_19'		=> '15.000',
				'ak_20'		=> '9.000',
				'ak_21'		=> '6.000',
				'ak_22'		=> '3.000',
				'ak_23'		=> '2.000',
				'ak_24'		=> '1.000',
				'ak_25'		=> '0.150',
				'ak_26'		=> '0.200',
				'ak_27'		=> '0.100',
				'ak_28'		=> '0.100',
				'ak_29'		=> '0.200',
				'ak_30'		=> '0.200',
				'ak_31'		=> '4.000',
				'ak_32'		=> '3.000',
				'ak_33'		=> '2.000',
				'ak_34'		=> '1.000',
				'ak_35'		=> '4.000',
				'ak_36'		=> '2.000',
				'ak_37'		=> '2.000',
				'ak_38'		=> '1.500',
				'ak_39'		=> '2.000',
				'ak_40'		=> '1.500',
				'ak_41'		=> '1.000',
				'ak_42'		=> '6.000',
				'ak_43'		=> '3.000',
				'ak_44'		=> '1.000',
				'ak_45'		=> '1.500',
				'ak_46'		=> '1.000',
				'ak_47'		=> '0.500',
				'ak_48'		=> '3.000',
				'ak_49'		=> '1.500',
				'ak_50'		=> '1.000',
				'ak_51'		=> '1.500',
				'ak_52'		=> '4.000',
				'ak_53'		=> '2.000',
				'ak_54'		=> '4.000',
				'ak_55'		=> '2.000',
				'ak_56'		=> '2.000',
				'ak_57'		=> '1.000',
				'ak_58'		=> '2.000',
				'ak_59'		=> '1.000',
				'ak_60'		=> '4.000',
				'ak_61'		=> '2.000',
				'ak_62'		=> '1.000',
				'ak_63'		=> '1.000',
				'ak_64'		=> '15.000',
				'ak_65'		=> '10.000',
				'ak_66'		=> '5.000',
				'ak_67'		=> '0.170',
				'ak_68'		=> '0.080',
				'ak_69'		=> '0.080',
				'ak_70'		=> '1.000',
				'ak_71'		=> '0.750',
				'ak_72'		=> '1.000',
				'ak_73'		=> '0.750',
				'ak_74'		=> '0.040',
				'ak_75'		=> '0.040',
				'ak_76'		=> '3.000',
				'ak_77'		=> '2.000',
				'ak_78'		=> '1.000',
				'ak_79'		=> '1.000'
				
				
				);
				
				$pak->TambahDataDupak('tb_dupak_guru_ak',$y);
			
			//input ke tabel dupak_f
			$y= array(
				'no_dupak'				=> $no_dupak_ajuan,
				'id_pegawai'			=> $_GET['id_pegawai'],
				);
				$pak->TambahDataDupak('tb_dupak_guru_f',$y);


				//cari id dupak nya
				$d_id = mysql_fetch_object(mysql_query("SELECT id FROM dt_dupak WHERE no_dupak = '$no_dupak_ajuan' "));
				
			echo "sukses|".$d_id->id."|".$_GET['id_pegawai']."|1";
		}else{
			echo $q1;
		}
	
	} else {
		echo "error_2".'|'.$cek1.'|'.$cek1.'|'.$no_dupak_ajuan;
	}
}else if($op=='update_step'){
	$no_dupak		= $_GET['no_dupak'];
	$step			= $_GET['step'];
	
// ketersediaan data pegawai,.. 
	Connect::getConnection();
	$update = mysql_query("UPDATE dt_dupak SET 
									step	='$step'
									WHERE no_dupak = '$no_dupak' ");

}else if($op=='add_pendidikan'){
	
	$kegiatan_ak	= 'ak_'.$_GET['kode_kegiatan'];
	$kegiatan_f		= 'f_'.$_GET['kode_kegiatan'];
	$ak_kegiatan	= $_GET['ak'];
	$f_kegiatan		= $_GET['f'];
	$no_dupak		= $_GET['no_dupak'];
	
	$jurusan		= $_GET['jurusan'];
	$th_lulus		= $_GET['th_lulus'];
	$gelar_dpn		= $_GET['gelar_dpn'];
	$gelar_blk		= $_GET['gelar_blk'];
	
	Connect::getConnection();
	
	
	
	//cari pend usul nama
	$data = mysql_fetch_object(mysql_query("SELECT kegiatan FROM kd_kegiatan_dan_ak WHERE kode_kegiatan = '$_GET[kode_kegiatan]' "));
	
	$kosongkan_f = mysql_query("UPDATE tb_dupak_guru_f SET 
											f_01	='',
											f_01_1	='',
											f_02	='',
											f_02_1	='',
											f_03	='',
											f_03_1	='',
											f_03_2	='',
											f_03_3	='',
											f_03_3_1='',
											f_03_3_2='',
											f_03_3_3='',
											f_64	='',
											f_65	='',
											f_66	=''
											
											
											WHERE no_dupak = '$no_dupak' ");
	
	//$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$kegiatan_ak." = ".$_GET['ak']." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$_GET['f']." where no_dupak='$no_dupak' ") or die( mysql_error());

	//update dupak
	$update=mysql_query("UPDATE dt_dupak SET 
									kd_pend_usul    	= '$_GET[kode_kegiatan]',
									pend_usul			= '$data->kegiatan',
									jurusan_pend_usul	= '$jurusan',
									th_lulus			= '$th_lulus',
									gelar_dpn			= '$gelar_dpn',
									gelar_blk			= '$gelar_blk'
						where no_dupak='$no_dupak' ") or die( mysql_error());;
	
	echo $no_dupak;
	
}else if($op=='load_pendidikan'){

	$no_dupak		= $_GET['no_dupak'];
	
	Connect::getConnection();
	$ak_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak where no_dupak ='$no_dupak' "));
	$f_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f where no_dupak ='$no_dupak' "));
	
	
	echo 
	$ak_pend->ak_01."|".
	$f_pend->f_01."|".
	$ak_pend->ak_01_1."|".
	$f_pend->f_01_1."|".
	$ak_pend->ak_02."|".
	$f_pend->f_02."|".
	$ak_pend->ak_02_1."|".
	$f_pend->f_02_1."|".
	$ak_pend->ak_03."|".
	$f_pend->f_03."|".
	$ak_pend->ak_03_1."|".
	$f_pend->f_03_1."|".
	$ak_pend->ak_03_2."|".
	$f_pend->f_03_2."|".
	$ak_pend->ak_03_3."|".
	$f_pend->f_03_3."|".
	$ak_pend->ak_03_3_1."|".
	$f_pend->f_03_3_1."|".
	$ak_pend->ak_03_3_3."|".
	$f_pend->f_03_3_3."|".
	$ak_pend->ak_04."|".
	$f_pend->f_04;
	
}else if($op=='add_pelatihan'){
	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();

	$update=mysql_query("UPDATE tb_dupak_guru_f SET f_04 = ".$_GET['f']." where no_dupak='$no_dupak' ") or die( mysql_error());
	
}else if($op=='load_pbt'){

	$no_dupak		= $_GET['no_dupak'];
	
	Connect::getConnection();
	$ak_pbt=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak where no_dupak ='$no_dupak' "));
	$f_pbt=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f where no_dupak ='$no_dupak' "));
	
	
	$jm = $ak_pbt->ak_05+$ak_pbt->ak_06+$ak_pbt->ak_07+$ak_pbt->ak_08+$ak_pbt->ak_09+$ak_pbt->ak_10+
	$ak_pbt->ak_11+$ak_pbt->ak_12+$ak_pbt->ak_13+$ak_pbt->ak_14+$ak_pbt->ak_15+$ak_pbt->ak_16+$ak_pbt->ak_17+
	$ak_pbt->ak_18+$ak_pbt->ak_15_a;
	
	echo 
	$ak_pbt->ak_05."|".
	$ak_pbt->ak_06."|".
	$ak_pbt->ak_07."|".
	$ak_pbt->ak_08."|".
	$ak_pbt->ak_09."|".
	$ak_pbt->ak_10."|".
	$ak_pbt->ak_11."|".
	$ak_pbt->ak_12."|".
	$ak_pbt->ak_13."|".
	$ak_pbt->ak_14."|".
	$ak_pbt->ak_15."|".
	$ak_pbt->ak_15_a."|".
	$ak_pbt->ak_16."|".
	$ak_pbt->ak_17."|".
	$ak_pbt->ak_18."|".
	number_format(round($jm,2),3)."|";
	
	echo 
	$f_pbt->f_05."|". //16
	$f_pbt->f_06."|".
	$f_pbt->f_07."|".
	$f_pbt->f_08."|".
	$f_pbt->f_09."|".
	$f_pbt->f_10."|".
	$f_pbt->f_11."|".
	$f_pbt->f_12."|".
	$f_pbt->f_13."|".
	$f_pbt->f_14."|".
	$f_pbt->f_15."|".
	$f_pbt->f_15_a."|".
	$f_pbt->f_16."|".
	$f_pbt->f_17."|".
	$f_pbt->f_18;
	
	
}else if($op=='add_pbt'){
	$no_dupak		= $_GET['no_dupak'];
	
	$kode_pbt			= 'ak_'.$_GET['kode_pbt'];
	$tugas_tambahan_1	= 'ak_'.$_GET['tugas_tambahan_1'];
	$tugas_tambahan_2	= 'ak_'.$_GET['tugas_tambahan_2'];
	
	$kode_pbt_f			= 'f_'.$_GET['kode_pbt'];
	$tugas_tambahan_1_f	= 'f_'.$_GET['tugas_tambahan_1'];
	$tugas_tambahan_2_f	= 'f_'.$_GET['tugas_tambahan_2'];
	
	$kd_jenis_guru	= $_GET['kd_jenis_guru'];
	$ak_jenis_guru	= $_GET['ak_jenis_guru'];
	$ak_tugas_1		= $_GET['ak_tugas_1'];
	$ak_tugas_2		= $_GET['ak_tugas_2'];
	
	$golongan		= $_GET['golongan'];
	$tmt_gol		= $d->tgl_sql($_GET['tmt_gol']);
	$pkg			= $_GET['pkg'];
	
	$ak = 1;
	
	Connect::getConnection();
	
	//pengosongan Data PBT
	
	$kosongkan_ak = mysql_query("UPDATE tb_dupak_guru_ak SET 
											ak_05	='',
											ak_06	='',
											ak_07	='',
											ak_08	='',
											ak_09	='',
											ak_10	='',
											ak_11	='',
											ak_12	='',
											ak_13	='',
											ak_14	='',
											ak_15	='',
											ak_15_a	='',
											ak_16	='',
											ak_17	='',
											ak_18	=''
											
											WHERE no_dupak = '$no_dupak' ");
	
	$kosongkan_f = mysql_query("UPDATE tb_dupak_guru_f SET 
											f_05	='',
											f_06	='',
											f_07	='',
											f_08	='',
											f_09	='',
											f_10	='',
											f_11	='',
											f_12	='',
											f_13	='',
											f_14	='',
											f_15	='',
											f_15_a	='',
											f_16	='',
											f_17	='',
											f_18	=''
											
											WHERE no_dupak = '$no_dupak' ");
	
	if ( $golongan != null ) {
	$update=mysql_query("UPDATE dt_dupak SET 
											kd_jenis_guru 	= '$kd_jenis_guru',
											nama_gol 		= '$golongan',
											tmt_gol			= '$tmt_gol',
											pkg				= '$pkg'
											where no_dupak	='$no_dupak' ") or die( mysql_error());
	}
	
	//isi pada tabel dt_dupak_tugas_tambahan
	$dt = mysql_num_rows(mysql_query("SELECT no_dupak FROM dt_dupak_tugas_tambahan WHERE no_dupak='$no_dupak' "));
	if ( $dt == 0 ){ 
	$x= array(
		'no_dupak'				=> $_GET['no_dupak'],
		'jenis_guru'			=> $_GET['kode_pbt'],
		'tugas_tambahan_1'		=> $_GET['tugas_tambahan_1'],
		'tugas_tambahan_2'		=> $_GET['tugas_tambahan_2'],
		'ak_jenis_guru'			=> $_GET['ak_jenis_guru'],
		'ak_1'					=> $_GET['ak_tugas_1'],
		'ak_2'					=> $_GET['ak_tugas_2']
		);
		$pak = New KelolaDataDupak();
		$pak->TambahDataDupak('dt_dupak_tugas_tambahan',$x);	
	}else if ( $dt == 1 ) {
		$update_data_tt=mysql_query("UPDATE dt_dupak_tugas_tambahan SET 
											jenis_guru 			= '$_GET[kode_pbt]',
											tugas_tambahan_1	= '$_GET[tugas_tambahan_1]',
											tugas_tambahan_2	= '$_GET[tugas_tambahan_2]',
											ak_jenis_guru		= '$_GET[ak_jenis_guru]',
											ak_1				= '$_GET[ak_tugas_1]',
											ak_2				= '$_GET[ak_tugas_2]'
											where no_dupak='$no_dupak' ") or die( mysql_error());
	}
	
	
	if ( $_GET['kode_pbt'] != null ) {
	$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$kode_pbt." = ".$_GET['ak_jenis_guru']." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kode_pbt_f." = ".$ak." where no_dupak='$no_dupak' ") or die( mysql_error());;
	}
	
	if ( $_GET['tugas_tambahan_1'] != null ) {
	$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$tugas_tambahan_1." = ".$_GET['ak_tugas_1']." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$tugas_tambahan_1_f." = ".$ak." where no_dupak='$no_dupak' ") or die( mysql_error());;
	}
	
	if ( $_GET['tugas_tambahan_2'] != null ) {
	$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$tugas_tambahan_2." = ".$_GET['ak_tugas_2']." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$tugas_tambahan_2_f." = ".$ak." where no_dupak='$no_dupak' ") or die( mysql_error());;
	}
	
	
	//echo $dt;
	
}else if($op=='load_pd'){

	$no_dupak		= $_GET['no_dupak'];
	
	Connect::getConnection();
	$ak_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak where no_dupak ='$no_dupak' "));
	$f_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f where no_dupak ='$no_dupak' "));
	
	
	echo 
	$ak_pend->ak_19."|".
	$f_pend->f_19."|".
	$ak_pend->ak_20."|".
	$f_pend->f_20."|".
	$ak_pend->ak_21."|".
	$f_pend->f_21."|".
	$ak_pend->ak_22."|".
	$f_pend->f_22."|".
	$ak_pend->ak_23."|".
	$f_pend->f_23."|".
	$ak_pend->ak_24."|".
	$f_pend->f_24."|".
	$ak_pend->ak_25."|".
	$f_pend->f_25."|".
	$ak_pend->ak_26."|".
	$f_pend->f_26."|".
	$ak_pend->ak_27."|".
	$f_pend->f_27."|".
	$ak_pend->ak_28."|".
	$f_pend->f_28;
}else if($op=='add_diklat'){
	
	$no_dupak					= $_GET['no_dupak'];
	$nama_diklat				= $_GET['nama_diklat'];
	$penyelenggara_diklat		= $_GET['penyelenggara_diklat'];
	$jp							= $_GET['jp'];
	$tgl_mulai_diklat			= $_GET['tgl_mulai_diklat'];
	$tgl_selesai_diklat			= $_GET['tgl_selesai_diklat'];
	$tgl_sertifikat				= $_GET['tgl_sertifikat'];
	$no_sertifikat				= $_GET['no_sertifikat'];
	
	
	
	//cari kode_kegiatan
		if ($jp > 960){					 	
			$kode_kegiatan = "19";
		}else if ( ($jp >=641) & ($jp <= 960)) {
			$kode_kegiatan = "20";
		}else if ( ($jp >=481) & ($jp <= 640)) {
			$kode_kegiatan = "21";
		}else if ( ($jp >=161) & ($jp <= 480)){ 
			$kode_kegiatan = "22";
		}else if ( ($jp >=81) & ($jp <= 160)) {
			$kode_kegiatan = "23";
		}else if ( ($jp >=30) & ($jp <= 80)){
			$kode_kegiatan = "24";
		}
	
		$kegiatan_ak = "ak_".$kode_kegiatan;
		$kegiatan_f	 = "f_".$kode_kegiatan;
		$f			 = 1;
		
	Connect::getConnection();	

		//cari ak
		$c_ak = mysql_fetch_object(mysql_query("SELECT angka_kredit FROM kd_kegiatan_dan_ak WHERE kode_kegiatan='$kode_kegiatan'  "));
		$ak = $c_ak->angka_kredit;
	
	//insert ke tabel diklat
	$x= array(
		'no_dupak'				=> $_GET['no_dupak'],
		'kode_kegiatan'			=> $kode_kegiatan,
		'nama_diklat'			=> $_GET['nama_diklat'],
		'penyelenggara'			=> $_GET['penyelenggara_diklat'],
		'jp'					=> $_GET['jp'],
		'ak'					=> $ak,
		
		'tgl_mulai'				=> $d->tgl_sql($_GET['tgl_mulai_diklat']),
		'tgl_selesai'			=> $d->tgl_sql($_GET['tgl_selesai_diklat']),
		
		
		'no_sertifikat'			=> $_GET['no_sertifikat'],
		'tgl_sertifikat'		=> $d->tgl_sql($_GET['tgl_sertifikat'])
		);
		$pak = New KelolaDataDupak();
		$pak->TambahDataDupak('dt_dupak_diklat',$x);	
	
	// penjumlahan diklat
	$ak_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_ak." as ak FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak' " ));
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f 	= $f + $f_awal->f;
	
	$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$kegiatan_ak." = ".$ak." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f." where no_dupak='$no_dupak' ") or die( mysql_error());

	
	
}else if($op=='edit_diklat'){
	$no_dupak					= $_GET['no_dupak'];
	$id_diklat					= $_GET['id_diklat'];
	$nama_diklat				= $_GET['nama_diklat'];
	$penyelenggara_diklat		= $_GET['penyelenggara_diklat'];
	$jp							= $_GET['jp'];
	$tgl_mulai_diklat			= $_GET['tgl_mulai_diklat'];
	$tgl_selesai_diklat			= $_GET['tgl_selesai_diklat'];
	$tgl_sertifikat				= $_GET['tgl_sertifikat'];
	$no_sertifikat				= $_GET['no_sertifikat'];
	
	$ak							= $_GET['ak'];
	$kode_kegiatan_awal			= $_GET['kode_kegiatan'];
	
	Connect::getConnection();
	
	// pengurangan diklat
		$kegiatan_ak = "ak_".$kode_kegiatan_awal;
		$kegiatan_f	 = "f_".$kode_kegiatan_awal;

	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f_baru 	=$f_awal->f - 1;
	
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f_baru." where no_dupak='$no_dupak' ") or die( mysql_error());

	
	
	//cari kode_kegiatan
		if ($jp > 960){					 	
			$kode_kegiatan = "19";
		}else if ( ($jp >=641) & ($jp <= 960)) {
			$kode_kegiatan = "20";
		}else if ( ($jp >=481) & ($jp <= 640)) {
			$kode_kegiatan = "21";
		}else if ( ($jp >=161) & ($jp <= 480)){ 
			$kode_kegiatan = "22";
		}else if ( ($jp >=81) & ($jp <= 160)) {
			$kode_kegiatan = "23";
		}else if ( ($jp >=30) & ($jp <= 80)){
			$kode_kegiatan = "24";
		}
	
		$kegiatan_ak = "ak_".$kode_kegiatan;
		$kegiatan_f	 = "f_".$kode_kegiatan;
		$f			 = 1;
		
	Connect::getConnection();	

		//cari ak
		$c_ak = mysql_fetch_object(mysql_query("SELECT angka_kredit FROM kd_kegiatan_dan_ak WHERE kode_kegiatan='$kode_kegiatan'  "));
		$ak = $c_ak->angka_kredit;
	
	
	
	//update tabel diklat
	$x= array(
		'kode_kegiatan'			=> $kode_kegiatan,
		'nama_diklat'			=> $_GET['nama_diklat'],
		'penyelenggara'			=> $_GET['penyelenggara_diklat'],
		'jp'					=> $_GET['jp'],
		'ak'					=> $ak,
		
		'tgl_mulai'				=> $d->tgl_sql($_GET['tgl_mulai_diklat']),
		'tgl_selesai'			=> $d->tgl_sql($_GET['tgl_selesai_diklat']),
		
		
		'no_sertifikat'			=> $_GET['no_sertifikat'],
		'tgl_sertifikat'		=> $d->tgl_sql($_GET['tgl_sertifikat'])
		);
		$where		= "id= '$id_diklat'";
		$pak 		= New KelolaDataDupak();
		$pak->UpdateDataDupak('dt_dupak_diklat',$x,$where);	
	
	
	
	
	// penjumlahan diklat
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f 	= $f + $f_awal->f;
	
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f." where no_dupak='$no_dupak' ") or die( mysql_error());

	
	
}else if($op=='hapus_diklat'){
	$id_diklat					= $_GET['id_diklat'];	
	$ak							= $_GET['ak'];
	$kode_kegiatan				= $_GET['kode_kegiatan'];
	$no_dupak					= $_GET['no_dupak'];
	
	
	// pengurangan diklat
		$kegiatan_ak = "ak_".$kode_kegiatan;
		$kegiatan_f	 = "f_".$kode_kegiatan;
	Connect::getConnection();	
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f_baru 	=$f_awal->f - 1;
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f_baru." where no_dupak='$no_dupak' ") or die( mysql_error());

	$delete 	= mysql_query("DELETE FROM dt_dupak_diklat WHERE id ='$id_diklat' ")or die( mysql_error());
	
}else if($op=='add_kolektif'){
	
	$sub_kegiatan_1				= $_GET['sub_kegiatan_1'];
	$sub_kegiatan_2				= $_GET['sub_kegiatan_2'];
	$nama_kegiatan				= $_GET['nm_kegiatan_kolektif'];
	$tgl_pelaksanaan			= $d->tgl_sql($_GET['tgl_kegiatan_kolektif']);
	
	$no_dupak					= $_GET['no_dupak'];
	

	Connect::getConnection();	
	//cari kode kegiatan
	if ($sub_kegiatan_2 == "") {
		$kd = mysql_fetch_object(mysql_query("SELECT angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE sub_kegiatan_1 ='$sub_kegiatan_1' "));
		$kode_kegiatan = $kd->kode_kegiatan;
		$angka_kredit = $kd->angka_kredit;
	} else if($sub_kegiatan_2 != "") {
		$kd = mysql_fetch_object(mysql_query("SELECT angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE sub_kegiatan_1 ='$sub_kegiatan_1' and sub_kegiatan_2 ='$sub_kegiatan_2' "));
		$kode_kegiatan = $kd->kode_kegiatan;
		$angka_kredit = $kd->angka_kredit;
	}
	
	$kegiatan_ak = "ak_".$kode_kegiatan;
	$kegiatan_f	 = "f_".$kode_kegiatan;
	$f			 = 1;
	$ak			 = $angka_kredit;
	
		//insert ke tabel kolektif
	$x= array(
		'no_dupak'				=> $no_dupak,
		'kode_kegiatan'			=> $kode_kegiatan,
		'nama_kegiatan'			=> $nama_kegiatan,
		'ak'					=> $angka_kredit,
		'tgl_pelaksanaan'		=> $tgl_pelaksanaan
		);
	$pak = New KelolaDataDupak();
	$pak->TambahDataDupak('dt_dupak_kegiatan_kolektif',$x);	
		
	// penjumlahan kegiatan
	$ak_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_ak." as ak FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak' " ));
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f 	= $f + $f_awal->f;
	
	$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$kegiatan_ak." = ".$ak." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f." where no_dupak='$no_dupak' ") or die( mysql_error());

		

	
	
}else if($op=='edit_kolektif'){
	$id_kolektif				= $_GET['id_kolektif'];
	$sub_kegiatan_1				= $_GET['sub_kegiatan_1'];
	$sub_kegiatan_2				= $_GET['sub_kegiatan_2'];
	$nama_kegiatan				= $_GET['nm_kegiatan_kolektif'];
	$tgl_pelaksanaan			= $d->tgl_sql($_GET['tgl_kegiatan_kolektif']);
	
	$no_dupak					= $_GET['no_dupak'];
	
	$ak							= $_GET['ak'];
	$kode_kegiatan_awal			= $_GET['kode_kegiatan'];
	

	Connect::getConnection();	
	// pengurangan kolektif
		$kegiatan_ak = "ak_".$kode_kegiatan_awal;
		$kegiatan_f	 = "f_".$kode_kegiatan_awal;

	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f_baru 	=$f_awal->f - 1;
	
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f_baru." where no_dupak='$no_dupak' ") or die( mysql_error());

	
	
	
	
	//cari kode kegiatan
	if ($sub_kegiatan_2 == null) {
		$kd = mysql_fetch_object(mysql_query("SELECT angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE sub_kegiatan_1 ='$sub_kegiatan_1' "));
		$kode_kegiatan = $kd->kode_kegiatan;
		$angka_kredit = $kd->angka_kredit;
	} else if($sub_kegiatan_2 != null) {
		$kd = mysql_fetch_object(mysql_query("SELECT angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE sub_kegiatan_1 ='$sub_kegiatan_1' and sub_kegiatan_2 ='$sub_kegiatan_2' "));
		$kode_kegiatan = $kd->kode_kegiatan;
		$angka_kredit = $kd->angka_kredit;
	}
	
	$kegiatan_ak = "ak_".$kode_kegiatan;
	$kegiatan_f	 = "f_".$kode_kegiatan;
	$f			 = 1;
	$ak			 = $angka_kredit;
	
		//Update tabel kolektif
	$x= array(
		'kode_kegiatan'			=> $kode_kegiatan,
		'nama_kegiatan'			=> $nama_kegiatan,
		'ak'					=> $ak,
		'tgl_pelaksanaan'		=> $tgl_pelaksanaan
		);
	$where		= "id= '$id_kolektif'";
	$pak 		= New KelolaDataDupak();
	$pak->UpdateDataDupak('dt_dupak_kegiatan_kolektif',$x,$where);	
	
		
	// penjumlahan kegiatan kolektif
	$ak_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_ak." as ak FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak' " ));
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f 	= $f + $f_awal->f;
	
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f." where no_dupak='$no_dupak' ") or die( mysql_error());

		



}else if($op=='hapus_kolektif'){
	$id_kolektif				= $_GET['id_kolektif'];	
	$ak							= $_GET['ak'];
	$kode_kegiatan				= $_GET['kode_kegiatan'];
	$no_dupak					= $_GET['no_dupak'];
	
	
	// pengurangan diklat
		$kegiatan_ak = "ak_".$kode_kegiatan;
		$kegiatan_f	 = "f_".$kode_kegiatan;
	Connect::getConnection();	
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f_baru 	=$f_awal->f - 1;
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f_baru." where no_dupak='$no_dupak' ") or die( mysql_error());

	$delete 	= mysql_query("DELETE FROM dt_dupak_kegiatan_kolektif WHERE id ='$id_kolektif' ")or die( mysql_error());
	


}else if($op=='load_piki'){

	$no_dupak		= $_GET['no_dupak'];
	
	Connect::getConnection();
	$ak_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak where no_dupak ='$no_dupak' "));
	$f_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f where no_dupak ='$no_dupak' "));
	
	
	echo 
	$ak_pend->ak_29."|".
	$f_pend->f_29."|".
	$ak_pend->ak_30."|".
	$f_pend->f_30."|".
	$ak_pend->ak_31."|".
	$f_pend->f_31."|".
	$ak_pend->ak_32."|".
	$f_pend->f_32."|".
	$ak_pend->ak_33."|".
	$f_pend->f_33."|".
	$ak_pend->ak_34."|".
	$f_pend->f_34."|".
	$ak_pend->ak_35."|".
	$f_pend->f_35."|".
	$ak_pend->ak_36."|".
	$f_pend->f_36."|".
	$ak_pend->ak_37."|".
	$f_pend->f_37."|".
	$ak_pend->ak_38."|".
	$f_pend->f_38."|".
	$ak_pend->ak_39."|".
	$f_pend->f_39."|".
	$ak_pend->ak_40."|".
	$f_pend->f_40."|".
	$ak_pend->ak_41."|".
	$f_pend->f_41."|".
	$ak_pend->ak_42."|".
	$f_pend->f_42."|".
	$ak_pend->ak_43."|".
	$f_pend->f_43."|".
	$ak_pend->ak_44."|".
	$f_pend->f_44."|".
	$ak_pend->ak_45."|".
	$f_pend->f_45."|".
	$ak_pend->ak_46."|".
	$f_pend->f_46."|".
	$ak_pend->ak_47."|".
	$f_pend->f_47."|".
	$ak_pend->ak_48."|".
	$f_pend->f_48."|".
	$ak_pend->ak_49."|".
	$f_pend->f_49."|".
	$ak_pend->ak_50."|".
	$f_pend->f_50."|".
	$ak_pend->ak_51."|".
	$f_pend->f_51."|".
	$ak_pend->ak_52."|".
	$f_pend->f_52."|".
	$ak_pend->ak_53."|".
	$f_pend->f_53."|".
	$ak_pend->ak_54."|".
	$f_pend->f_54."|".
	$ak_pend->ak_55."|".
	$f_pend->f_55."|".
	$ak_pend->ak_56."|".
	$f_pend->f_56."|".
	$ak_pend->ak_57."|".
	$f_pend->f_57."|".
	$ak_pend->ak_58."|".
	$f_pend->f_58."|".
	$ak_pend->ak_59."|".
	$f_pend->f_59."|".
	$ak_pend->ak_60."|".
	$f_pend->f_60."|".
	$ak_pend->ak_61."|".
	$f_pend->f_61."|".
	$ak_pend->ak_62."|".
	$f_pend->f_62."|".
	$ak_pend->ak_63."|".
	$f_pend->f_63;
}else if($op=='add_piki'){
	
	$judul_piki		= $_GET['judul_piki'];
	$th_piki		= $_GET['th_piki'];
	$kode_kegiatan	= $_GET['kode_kegiatan'];
	$ak_piki		= $_GET['ak_piki'];
	$no_dupak		= $_GET['no_dupak'];
	
	Connect::getConnection();
	//SIMPAN DATA 
	$x= array(
		'no_dupak'				=> $_GET['no_dupak'],
		'judul_piki'			=> $_GET['judul_piki'],
		'th_piki'				=> $_GET['th_piki'],
		'kd_kegiatan'			=> $_GET['kode_kegiatan'],
		'ak_piki'				=> $_GET['ak_piki']
		);
		$pak = New KelolaDataDupak();
		$pak->TambahDataDupak('dt_dupak_piki',$x);	
	
	$kegiatan_ak = "ak_".$kode_kegiatan;
	$kegiatan_f	 = "f_".$kode_kegiatan;
	$f			 = 1;
	$ak			 = $ak_piki;
	
	// penjumlahan kegiatan
	$ak_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_ak." as ak FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak' " ));
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	//$ak = $ak + $ak_awal->ak;
	$f 	= $f + $f_awal->f;
	
	
	
	
	Connect::getConnection();
	$update=mysql_query("UPDATE tb_dupak_guru_ak SET ".$kegiatan_ak." = ".$ak." where no_dupak='$no_dupak' ") or die( mysql_error());
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f." where no_dupak='$no_dupak' ") or die( mysql_error());;

	
	
	
}else if($op=='edit_piki'){
	$id_piki		= $_GET['id_piki'];
	$judul_piki		= $_GET['judul_piki'];
	$th_piki		= $_GET['th_piki'];
	$no_dupak		= $_GET['no_dupak'];
	
	$ak_awal					= $_GET['ak_piki_awal'];
	$kode_kegiatan_awal			= $_GET['kode_kegiatan_awal'];
	
	$ak_baru					= $_GET['ak_piki_baru'];
	$kode_kegiatan_baru			= $_GET['kode_kegiatan_baru'];
	
	Connect::getConnection();
	
	// pengurangan piki
		$kegiatan_ak = "ak_".$kode_kegiatan_awal;
		$kegiatan_f	 = "f_".$kode_kegiatan_awal;

	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f_baru 	=$f_awal->f - 1;
	
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f_baru." where no_dupak='$no_dupak' ") or die( mysql_error());

	
	$kegiatan_ak = "ak_".$kode_kegiatan_baru;
	$kegiatan_f	 = "f_".$kode_kegiatan_baru;
	$f			 = 1;
	$ak			 = $ak_baru;
	
	//update tabel piki
	$x= array(
		'judul_piki'		=> $judul_piki,
		'th_piki'			=> $th_piki,
		'kd_kegiatan'		=> $kode_kegiatan_baru,
		'ak_piki'			=> $ak_baru
		);
		$where		= "id= '$id_piki'";
		$pak 		= New KelolaDataDupak();
		$pak->UpdateDataDupak('dt_dupak_piki',$x,$where);	
	
	
	
	
	// penjumlahan piki
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f 	= $f + $f_awal->f;
	
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f." where no_dupak='$no_dupak' ") or die( mysql_error());

	
	
}else if($op=='hapus_piki'){
	$id_piki				= $_GET['id_piki'];	
	$ak						= $_GET['ak_piki'];
	$kode_kegiatan			= $_GET['kode_kegiatan'];
	$no_dupak				= $_GET['no_dupak'];
	
	
	// pengurangan diklat
		$kegiatan_ak = "ak_".$kode_kegiatan;
		$kegiatan_f	 = "f_".$kode_kegiatan;
	Connect::getConnection();	
	$f_awal = mysql_fetch_object(mysql_query("SELECT ".$kegiatan_f." as f FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' " ));
	
	$f_baru 	=$f_awal->f - 1;
	$update=mysql_query("UPDATE tb_dupak_guru_f SET ".$kegiatan_f." = ".$f_baru." where no_dupak='$no_dupak' ") or die( mysql_error());

	$delete 	= mysql_query("DELETE FROM dt_dupak_piki WHERE id ='$id_piki' ")or die( mysql_error());
	


}else if($op=='load_penunjang'){

	$no_dupak		= $_GET['no_dupak'];
	
	Connect::getConnection();
	$ak_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak where no_dupak ='$no_dupak' "));
	$f_pend=mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f where no_dupak ='$no_dupak' "));
	
	
	echo 
	$ak_pend->ak_64."|".
	$f_pend->f_64."|".
	$ak_pend->ak_65."|".
	$f_pend->f_65."|".
	$ak_pend->ak_66."|".
	$f_pend->f_66."|".
	$ak_pend->ak_67."|".
	$f_pend->f_67."|".
	$ak_pend->ak_68."|".
	$f_pend->f_68."|".
	$ak_pend->ak_69."|".
	$f_pend->f_69."|".
	$ak_pend->ak_70."|".
	$f_pend->f_70."|".
	$ak_pend->ak_71."|".
	$f_pend->f_71."|".
	$ak_pend->ak_72."|".
	$f_pend->f_72."|".
	$ak_pend->ak_73."|".
	$f_pend->f_73."|".
	$ak_pend->ak_74."|".
	$f_pend->f_74."|".
	$ak_pend->ak_75."|".
	$f_pend->f_75."|".
	$ak_pend->ak_76."|".
	$f_pend->f_76."|".
	$ak_pend->ak_77."|".
	$f_pend->f_77."|".
	$ak_pend->ak_78."|".
	$f_pend->f_78."|".
	$ak_pend->ak_79."|".
	$f_pend->f_79;
}else if($op=='simpan_penunjang'){
	$no_dupak		= $_GET['no_dupak'];
	//session_start();
	Connect::getConnection();
	$step = mysql_query("UPDATE dt_dupak SET step	='6' WHERE no_dupak = '$no_dupak' ")or die( mysql_error());
	$freq = mysql_query("UPDATE tb_dupak_guru_f SET 
											f_67	='$_GET[a]',
											f_68	='$_GET[b]',
											f_69	='$_GET[c]',
											f_70	='$_GET[d]',
											f_71	='$_GET[e]',
											f_72	='$_GET[f]',
											f_73	='$_GET[g]',
											f_74	='$_GET[h]',
											f_75	='$_GET[i]',
											f_76	='$_GET[j]',
											f_77	='$_GET[k]',
											f_78	='$_GET[l]',
											f_79	='$_GET[m]'
											
											
											
											WHERE no_dupak = '$no_dupak' ");


}else if($op=='update_penunjang'){
	$no_dupak		= $_GET['no_dupak'];
	//session_start();
	Connect::getConnection();
	$freq = mysql_query("UPDATE tb_dupak_guru_f SET 
											f_67	='$_GET[a]',
											f_68	='$_GET[b]',
											f_69	='$_GET[c]',
											f_70	='$_GET[d]',
											f_71	='$_GET[e]',
											f_72	='$_GET[f]',
											f_73	='$_GET[g]',
											f_74	='$_GET[h]',
											f_75	='$_GET[i]',
											f_76	='$_GET[j]',
											f_77	='$_GET[k]',
											f_78	='$_GET[l]',
											f_79	='$_GET[m]'
											
											
											
											WHERE no_dupak = '$no_dupak' ");


}else if($op=='hapus'){
	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();
	$cek=mysql_fetch_object(mysql_query("SELECT status_dupak FROM dt_dupak where no_dupak ='$no_dupak' "));
	
	if ($cek->status_dupak == 'level_1'){
		$delete 	= mysql_query("DELETE FROM dt_dupak WHERE no_dupak ='$no_dupak'")or die( mysql_error());
		$delete5 	= mysql_query("DELETE FROM tb_dupak_guru_ak WHERE no_dupak ='$no_dupak'")or die( mysql_error());
		$delete5 	= mysql_query("DELETE FROM tb_dupak_guru_f WHERE no_dupak ='$no_dupak'")or die( mysql_error());
		$delete1 	= mysql_query("DELETE FROM dt_dupak_diklat WHERE no_dupak ='$no_dupak'")or die( mysql_error());
		$delete2	= mysql_query("DELETE FROM dt_dupak_kegiatan_kolektif WHERE no_dupak ='$no_dupak'")or die( mysql_error());
		$delete3	= mysql_query("DELETE FROM dt_dupak_piki WHERE no_dupak ='$no_dupak'")or die( mysql_error());
		$delete4 	= mysql_query("DELETE FROM dt_dupak_tugas_tambahan WHERE no_dupak ='$no_dupak'")or die( mysql_error());

		
		//echo "sukses";
	}else{
		echo "error";
	
	}
	
}else if($op=='proses_acc_dupak'){
	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();
	/** mungkin ini adalah proses paling rumit yang pernah saya buat,
			yaitu memasukan semua variabel pada DUPAK menjadi PAK **/
	
	// 1. Isi data pada tabel PAK,, gnerate no nya dulu
	
	/** ********************************************************************************** //
	// -------------------- PROSES GENERATE NO PAK AJUAN ---------------------------------//
	/** ================================================================================= */

		//$th 			= date(Y);
		$pch_thn		= explode("/",$no_dupak);
		$th				= $pch_thn[4];

		//cari index terakhir SUBSTRING_INDEX(tgl_entry,'-',1)
		$cek = mysql_query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',2),'/',-1) as no FROM dt_pak WHERE  SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and YEAR(tgl_pak)= '$th' ORDER BY SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',2),'/',-1) DESC LIMIT 1");
		if ( mysql_num_rows($cek) != 0 ) {
			//ambil no index
			$cari_index 	= mysql_fetch_object($cek);
			$x 		= $cari_index->no;
			$no_index_baru 	= $x+1;
		} else 	{
			$no_index_baru 	= 1;
		}

		//echo $no_index_baru;
		$jm=strlen($no_index_baru);
		switch($jm)
		{
		case 1 : $no='0000'.$no_index_baru;
			break;
		case 2 : $no='000'.$no_index_baru;
			break;
		case 3 : $no='00'.$no_index_baru;
			break;
		case 4 : $no='0'.$no_index_baru;
			break;
		case 5 : $no=$no_index_baru;
			break;
		}
	
		// NO PAK AJUAN
		$no_pak_ajuan = '800/'.$no.'/TP.GURU/PAK/'.$th;
		echo $no_pak_ajuan;
	
	
	//ambil all data dari tabel dupak
	$dupak = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
	//echo $dupak->nip_baru;
	
	//ambil nilai ndan n pak terakhirnya
		//cari no pak terakhir
		$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$dupak->nip_baru' ORDER BY tgl_pak ASC");
		$data = mysql_num_rows($x);
		//jika ditemukan data lebih dari 1
		if ( $data > 1 ) {
			while ($r = mysql_fetch_array($x)){
					$dpt = $r['no_pak'];
			}
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));
			} else {
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE nip_baru='$dupak->nip_baru' ORDER BY tgl_pak DESC"));
			}
		
	$no_pak = $pak_terakhir->no_pak;
		//Data Pak

	$pak		=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak'"));
	
	$ak  	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak'"));
	$f   	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak'"));
	//hasil penilai
	
	$p1		= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p1'"));
	$p2		= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p2'"));
	
	$pend_dupak = 	($ak->ak_01)*($f->f_01)*($p1->p_01)*($p2->p_01)+
					($ak->ak_01_1)*($f->f_01_1)*($p1->p_01_1)*($p2->p_01_1)+
					($ak->ak_02)*($f->f_02)*($p1->p_02)*($p2->p_02)+
					($ak->ak_02_1)*($f->f_02_1)*($p1->p_01)*($p2->p_01)+
					($ak->ak_03)*($f->f_03)*($p1->p_03)*($p2->p_03)+
					($ak->ak_03_1)*($f->f_03_1)*($p1->p_03_1)*($p2->p_03_1)+
					($ak->ak_03_1_1)*($f->f_03_1_1)*($p1->p_03_1_1)*($p2->p_03_1_1)+
					($ak->ak_03_2)*($f->f_03_2)*($p1->p_03_2)*($p2->p_03_2)+
					($ak->ak_03_2_1)*($f->f_03_2_1)*($p1->p_03_2_1)*($p2->p_03_2_1)+
					($ak->ak_03_2_2)*($f->f_03_2_2)*($p1->p_03_2_2)*($p2->p_03_2_2)+
					($ak->ak_03_3)*($f->f_03_3)*($p1->p_03_3)*($p2->p_03_3)+
					($ak->ak_03_3_1)*($f->f_03_3_1)*($p1->p_03_3_1)*($p2->p_03_3_1)+
					($ak->ak_03_3_2)*($f->f_03_3_2)*($p1->p_03_3_2)*($p2->p_03_3_2)+
					($ak->ak_03_3_3)*($f->f_03_3_3)*($p1->p_03_3_3)*($p2->p_03_3_3);
					
	$diklat_dupak = ($ak->ak_04)*($f->f_04)*($p1->p_04)*($p2->p_04);
	
	$pbt_dupak = 	($ak->ak_05)*($f->f_05)*($p1->p_05)*($p2->p_05)+
					($ak->ak_06)*($f->f_06)*($p1->p_06)*($p2->p_06)+
					($ak->ak_07)*($f->f_07)*($p1->p_07)*($p2->p_07)+
					($ak->ak_08)*($f->f_08)*($p1->p_08)*($p2->p_08)+
					($ak->ak_09)*($f->f_09)*($p1->p_09)*($p2->p_09)+
					($ak->ak_10)*($f->f_10)*($p1->p_10)*($p2->p_10)+
					($ak->ak_11)*($f->f_11)*($p1->p_11)*($p2->p_11)+
					($ak->ak_12)*($f->f_12)*($p1->p_12)*($p2->p_12)+
					($ak->ak_13)*($f->f_13)*($p1->p_13)*($p2->p_13)+
					($ak->ak_14)*($f->f_14)*($p1->p_14)*($p2->p_14)+
					($ak->ak_15)*($f->f_15)*($p1->p_15)*($p2->p_15)+
					($ak->ak_16)*($f->f_16)*($p1->p_16)*($p2->p_16)+
					($ak->ak_17)*($f->f_17)*($p1->p_17)*($p2->p_17)+
					($ak->ak_18)*($f->f_18)*($p1->p_18)*($p2->p_18);
					
	$pd_dupak = 	($ak->ak_19)*($f->f_19)*($p1->p_19)*($p2->p_19)+
					($ak->ak_20)*($f->f_20)*($p1->p_20)*($p2->p_20)+
					($ak->ak_21)*($f->f_21)*($p1->p_21)*($p2->p_21)+
					($ak->ak_22)*($f->f_22)*($p1->p_22)*($p2->p_22)+
					($ak->ak_23)*($f->f_23)*($p1->p_23)*($p2->p_23)+
					($ak->ak_24)*($f->f_24)*($p1->p_24)*($p2->p_24)+
					($ak->ak_25)*($f->f_25)*($p1->p_25)*($p2->p_25)+
					($ak->ak_26)*($f->f_26)*($p1->p_26)*($p2->p_26)+
					($ak->ak_27)*($f->f_27)*($p1->p_27)*($p2->p_27)+
					($ak->ak_28)*($f->f_28)*($p1->p_28)*($p2->p_28);
					
	$pi_dupak = 	($ak->ak_29)*($f->f_29)*($p1->p_29)*($p2->p_29)+
					($ak->ak_30)*($f->f_30)*($p1->p_30)*($p2->p_30)+
					($ak->ak_31)*($f->f_31)*($p1->p_31)*($p2->p_31)+
					($ak->ak_32)*($f->f_32)*($p1->p_32)*($p2->p_32)+
					($ak->ak_33)*($f->f_33)*($p1->p_33)*($p2->p_33)+
					($ak->ak_34)*($f->f_34)*($p1->p_34)*($p2->p_34)+
					($ak->ak_35)*($f->f_35)*($p1->p_35)*($p2->p_35)+
					($ak->ak_36)*($f->f_36)*($p1->p_36)*($p2->p_36)+
					($ak->ak_37)*($f->f_37)*($p1->p_37)*($p2->p_37)+
					($ak->ak_38)*($f->f_38)*($p1->p_38)*($p2->p_38)+
					($ak->ak_39)*($f->f_39)*($p1->p_39)*($p2->p_39)+
					($ak->ak_40)*($f->f_40)*($p1->p_40)*($p2->p_40)+
					($ak->ak_41)*($f->f_41)*($p1->p_41)*($p2->p_41)+
					($ak->ak_42)*($f->f_42)*($p1->p_42)*($p2->p_42)+
					($ak->ak_43)*($f->f_43)*($p1->p_43)*($p2->p_43)+
					($ak->ak_44)*($f->f_44)*($p1->p_44)*($p2->p_44)+
					($ak->ak_45)*($f->f_45)*($p1->p_45)*($p2->p_45)+
					($ak->ak_46)*($f->f_46)*($p1->p_46)*($p2->p_46)+
					($ak->ak_47)*($f->f_47)*($p1->p_47)*($p2->p_47)+
					($ak->ak_48)*($f->f_48)*($p1->p_48)*($p2->p_48)+
					($ak->ak_49)*($f->f_49)*($p1->p_49)*($p2->p_49)+
					($ak->ak_50)*($f->f_50)*($p1->p_50)*($p2->p_50)+
					($ak->ak_51)*($f->f_51)*($p1->p_51)*($p2->p_51);
					
	$ki_dupak = 	($ak->ak_52)*($f->f_52)*($p1->p_52)*($p2->p_52)+
					($ak->ak_53)*($f->f_53)*($p1->p_53)*($p2->p_53)+
					($ak->ak_54)*($f->f_54)*($p1->p_54)*($p2->p_54)+
					($ak->ak_55)*($f->f_55)*($p1->p_55)*($p2->p_55)+
					($ak->ak_56)*($f->f_56)*($p1->p_56)*($p2->p_56)+
					($ak->ak_57)*($f->f_57)*($p1->p_57)*($p2->p_57)+
					($ak->ak_58)*($f->f_58)*($p1->p_58)*($p2->p_58)+
					($ak->ak_59)*($f->f_59)*($p1->p_59)*($p2->p_59)+
					($ak->ak_60)*($f->f_60)*($p1->p_60)*($p2->p_60)+
					($ak->ak_61)*($f->f_61)*($p1->p_61)*($p2->p_61)+
					($ak->ak_62)*($f->f_62)*($p1->p_62)*($p2->p_62)+
					($ak->ak_63)*($f->f_63)*($p1->p_63)*($p2->p_63);
	
	$sttb_tdk_sesuai_dupak = 	($ak->ak_64)*($f->f_64)*($p1->p_64)*($p2->p_64)+
								($ak->ak_65)*($f->f_65)*($p1->p_65)*($p2->p_65)+
								($ak->ak_66)*($f->f_66)*($p1->p_66)*($p2->p_66);
	
	
	$dt_dupak = 	($ak->ak_67)*($f->f_67)*($p1->p_67)*($p2->p_67)+
					($ak->ak_68)*($f->f_68)*($p1->p_68)*($p2->p_68)+
					($ak->ak_69)*($f->f_69)*($p1->p_69)*($p2->p_69)+
					($ak->ak_70)*($f->f_70)*($p1->p_70)*($p2->p_70)+
					($ak->ak_71)*($f->f_71)*($p1->p_71)*($p2->p_71)+
					($ak->ak_72)*($f->f_72)*($p1->p_72)*($p2->p_72)+
					($ak->ak_73)*($f->f_73)*($p1->p_73)*($p2->p_73)+
					($ak->ak_74)*($f->f_74)*($p1->p_74)*($p2->p_74)+
					($ak->ak_75)*($f->f_75)*($p1->p_75)*($p2->p_75)+
					($ak->ak_76)*($f->f_76)*($p1->p_76)*($p2->p_76)+
					($ak->ak_77)*($f->f_77)*($p1->p_77)*($p2->p_77)+
					($ak->ak_78)*($f->f_78)*($p1->p_78)*($p2->p_78)+
					($ak->ak_79)*($f->f_79)*($p1->p_79)*($p2->p_79);
	
	//NILAI PAK LAMA
	
	
	number_format($diklat_dupak,3);
	
	
	number_format($pi_dupak,3);
	number_format($ki_dupak,3);


	/**  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ **/
	//2. Proses pengisian tabel PAK
	/** ################################################################## **/
	$x= array(
		'nip_baru'				=> $dupak->nip_baru,
		'no_pak'				=> $no_pak_ajuan,
		'tgl_pak'				=> $dupak->tgl_dupak,
		'tgl_mulai'				=> $dupak->tgl_mulai,
		'tgl_sampai'			=> $dupak->tgl_sampai,
		'pend_lama'				=> number_format($pak->pend_lama+$pak->pend_baru,3),
		'diklat_lama'			=> number_format($pak->diklat_lama+$pak->diklat_baru,3),
		'pbt_lama'				=> number_format($pak->pbt_lama+$pak->pbt_baru,3),
		'pd_lama'				=> number_format($pak->pd_lama+$pak->pd_baru,3),
		'pi_lama'				=> number_format($pak->pi_lama+$pak->pi_baru,3),
		'ki_lama'				=> number_format($pak->ki_lama+$pak->ki_baru,3),
		'pend_baru'				=> number_format($pend_dupak,3),
		'diklat_baru'			=> number_format($diklat_dupak,3),
		'pbt_baru'				=> number_format($pbt_dupak,3),
		'pd_baru'				=> number_format($pd_dupak,3),
		'pi_baru'				=> number_format($pi_dupak,3),
		'ki_baru'				=> number_format($ki_dupak,3),
		'sttb_tdksesuai_baru'	=> number_format($sttb_tdk_sesuai_dupak,3),
		'dukung_tugas_baru'		=> number_format($dt_dupak,3)
			
		);
		$pak = New KelolaDataPak();
		$pak->TambahDataPak('dt_pak',$x);	
	
	//input ke tabel pak gol

	$y= array(
		'nip_baru'				=> $dupak->nip_baru,
		'no_pak'				=> $no_pak_ajuan,
		'nama_gol'				=> $dupak->nama_gol,
		'tmt_gol'				=> $dupak->tmt_gol,
		'kd_jenis_guru'			=> $dupak->kd_jenis_guru,
		'tmt_jafung'			=> $dupak->tmt_jafung,
		'mk_gol_thn'			=> $dupak->mk_tahun,
		'mk_gol_bln'			=> $dupak->mk_bulan
		);
		$pak->TambahDataPak('tb_pak_guru_gol',$y);

		
	//input ke tabel pak pend
	// JIKA tidak ada pengajuan pendidikan baru,, maka tabel ini akan diisi oleh data pada PAK lama
	$pak_pend_lama = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak='$no_pak'"));
	
	if ( $dupak->kd_pend_usul == null ){
		$gelar_dpn 			= $pak_pend_lama->gelar_dpn;
		$gelar_blk 			= $pak_pend_lama->gelar_blk;
		$kd_pend_usul		= $pak_pend_lama->kd_pend_usul;
		$jurusan_pend_usul	= $pak_pend_lama->jurusan_pend_usul;
		$th_lulus			= $pak_pend_lama->th_pend_usul;
	}else{
		$gelar_dpn 			= $dupak->gelar_dpn;
		$gelar_blk 			= $dupak->gelar_blk;
		$kd_pend_usul		= $dupak->kd_pend_usul;
		$jurusan_pend_usul	= $dupak->jurusan_pend_usul;
		$th_lulus			= $dupak->th_lulus;
	}
		
	
	
	$z= array(
		'nip_baru'				=> $dupak->nip_baru,
		'no_pak'				=> $no_pak_ajuan,
		'gelar_dpn'				=> $gelar_dpn,
		'gelar_blk'				=> $gelar_blk,
		'kd_pend_usul'			=> $kd_pend_usul,
		'jurusan_pend_usul'		=> $jurusan_pend_usul,
		'th_pend_usul'			=> $th_lulus,
		'kd_skpd'				=> $dupak->kd_skpd
		);
		$pak->TambahDataPak('tb_pak_guru_pend',$z);	
	
	// JIKA semua sudah beres maka update step dan level dupak
	$update = mysql_query("UPDATE dt_dupak SET step	='21',status_dupak = 'level_3' WHERE no_dupak = '$no_dupak' ");
	
}else if($op=='kirim_ke_penilai'){
	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();
	
	if ( $no_dupak != null ){
		
	//cari tu dan kepsek
	$kepsek = mysql_fetch_object(mysql_query("SELECT id_kepsek FROM tb_dupak_sekolah WHERE kd_skpd='$kd_skpd' ")); 
	
	
	//buat surat dupak pengantar
	$th				= date('Y');
	$bln			= date('m');
		//cari index terakhir SUBSTRING_INDEX(tgl_entry,'-',1)
		$cek = mysql_query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat,'/',2),'/',-1) as no FROM dt_dupak_pengantar WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat,'/',5),'/',-1)= '$th' ORDER BY SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat,'/',2),'/',-1) DESC LIMIT 1");
		if ( mysql_num_rows($cek) != 0 ) {
			//ambil no index
			$cari_index 	= mysql_fetch_object($cek);
			$x 		= $cari_index->no;
			$no_index_baru 	= $x+1;
		} else 	{
			$no_index_baru 	= 1;

		}

				
		//echo $no_index_baru;
		$jm=strlen($no_index_baru);
		switch($jm)
		{
		case 1 : $no='0000'.$no_index_baru;
			break;
		case 2 : $no='000'.$no_index_baru;
			break;
		case 3 : $no='00'.$no_index_baru;
			break;
		case 4 : $no='0'.$no_index_baru;
			break;
		case 5 : $no=$no_index_baru;
			break;
		}
		
		
		//echo $x;
		// NO surat
		$no_surat = '823/'.$no.'/TU/'.$bln.'/'.$th;
	
	//insert ke tabel surat
	$x= array(
		'id_tu'					=> $id_tu,
		'id_kepsek'				=> $kepsek->id_kepsek,
		'kd_skpd'				=> $kd_skpd,
		'no_surat'				=> $no_surat,
		'tgl_surat'				=> date('Y-m-d'),
		'tujuan'				=> 'Sekretariat Tim Penilai Angka Kredit'
		);
		$surat = New KelolaDataDupak();
		$surat->TambahDataDupak('dt_dupak_pengantar',$x);	

	//ambil id surat
	$id	= mysql_fetch_object(mysql_query("SELECT id_pengantar FROM dt_dupak_pengantar where no_surat='$no_surat' "));
	$id_surat = $id->id_pengantar;
	
	$data			= explode(',',$no_dupak);
	foreach ( $data as $x ){
			if ($x != null ){
			//update step dan no surat
			$step = mysql_query("UPDATE dt_dupak SET 
														status_dupak='level_2',
														step='7',
														id_pengantar='$id_surat'
														WHERE no_dupak = '$x' ")or die( mysql_error());
			}
	}
	
	
	} // end tidk null
}

?>