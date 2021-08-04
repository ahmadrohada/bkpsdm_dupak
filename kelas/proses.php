<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 		= New FormatTanggal();

$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
$nama_user	 = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';

$op=isset($_GET['op'])?$_GET['op']:null;


if($op=='ralat_guru'){
	Connect::getConnection();
	$nip_baru	= $_GET['b'];
	$id_pegawai = $_GET['id_pegawai'];	 
	
	$jm=mysql_num_rows(mysql_query("SELECT id_pegawai FROM dt_pegawai where nip_baru='$nip_baru' and id_pegawai !='$id_pegawai' "));
	
	//echo $jm;
	if ( $jm == 0 ){
	
	$x= array(
		
		'nip_lama'		=> $_GET['a'],
		'nip_baru'		=> $_GET['b'],
		'nuptk'			=> $_GET['c'],
		'no_karpeg'		=> $_GET['d'],
		'nama_jabatan'	=> $_GET['e'],
		'alamat'		=> $_GET['f'],
		'kota'			=> $_GET['g'],
		'kode_pos'		=> $_GET['h'],
		'no_hp'			=> $_GET['i'],
		'nama'			=> $_GET['j'],
		'gelar_dpn'		=> $_GET['k'],
		'gelar_blk'		=> $_GET['l'],
		'tmp_lahir'		=> $_GET['m'],
		'tgl_lahir'		=> $_GET['n'],
		'jk'			=> $_GET['o'],
		'agama'			=> $_GET['p'],
		'kd_skpd'		=> $_GET['q'],
		'kedudukan_peg'	=> $_GET['r']
		
		);
		
		$where		= "id_pegawai = $id_pegawai";
		$pegawai 	= New KelolaPegawai();
		$pegawai->UpdateDataPegawai($x,$where);	
		
		//update nip pada tabel foto
		Connect::getConnection();
		$foto = mysql_query("UPDATE foto SET nipbaru	='$_GET[b]' WHERE id = '$_GET[s]' ")or die( mysql_error());
		}else{
			echo "nip_error";
		
		}


}else if($op=='tambah_guru'){
	Connect::getConnection();
	$id_pegawai = $_GET['id_pegawai'];	
	$kd_skpd 	= $_GET['kd_skpd'];
	
	$x= array(
		
		'kd_skpd'		=> $kd_skpd 
		
		);
		
		$where		= "id_pegawai = $id_pegawai";
		$pegawai 	= New KelolaPegawai();
		$pegawai->UpdateDataPegawai($x,$where);	
		
}else if($op=='validasi_dupak'){
	Connect::getConnection();
	
	$no_dupak 	= $_GET['no_dupak'];
	$nip_baru 	= $_GET['nip_baru'];	
	
	$sql = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
		
	//CEk nip dan no dupak
	if ( $sql->nip_baru == $nip_baru ) {
		echo "valid"; 
	}else{
		echo "invalid"; 
	}
	
	
} else if($op=='hitung_mk_inpass') {

	$tmt_gol			= $_GET['tmt_gol'];
	$tgl_pak			= $_GET['tgl_pak'];
	$mk_awal_thn		= $_GET['mk_awal_thn'];
	$mk_awal_bln		= $_GET['mk_awal_bln'];

	if ( ( $mk_awal_thn!=null ) & ( $mk_awal_bln!=null ) & ( $tmt_gol!=null )& ( $tgl_pak!=null )){


	//pecah tmt_gol
	$gol = explode("-",$tmt_gol);
	$th_gol	=	intval($gol[2]);
	$bl_gol	=	intval($gol[1]);
	$hr_gol	=	intval($gol[0]);

	//pecah tmt inpass
	//pecah tmt_gol
	$inpass = explode("-",$tgl_pak);
	$th_inpass	=	intval($inpass[2]);
	$bl_inpass	=	intval($inpass[1]);
	$hr_inpass	=	intval($inpass[0]);

	//cari selisih selisih tahun
	$sl_th	= $th_inpass-$th_gol;
	//cari selisih bulan
	//jika hasil selisih bulan kurang dari 0
	if ( $bl_gol > $bl_inpass ) {
		$sl_bl	= ($bl_inpass+12)-$bl_gol;
		$sl_th	= $sl_th-1;
	} else {
		$sl_bl	= $bl_inpass-$bl_gol;
	}
	//cari selisih hari

	//jika hasil selisih hari kurang dari 0
	if ( $hr_gol > $hr_inpass ) {
		$sl_hr	= ($hr_inpass+30)-$hr_gol;
		$sl_bl	= $sl_bl-1;
	} else {
		$sl_hr	= $hr_inpass-$hr_gol;
	}	

	// jika hasil selisih hari  lebih dari 30
	if ( $sl_hr >= 30 ) {
		$sl_hr	= $sl_hr-30;
		$sl_bl	= $sl_bl+1;
	}

	//jika selisih bulan lebih dari 12
	if ( $sl_bl >= 12 ) {
		$sl_bl	= $sl_bl-12;
		$sl_th	= $sl_th+1;
	}

	//mASA kerja akhir yaitu
		$jm_mk_thn	= $sl_th+$mk_awal_thn;
		$jm_mk_bln	= $sl_bl+$mk_awal_bln;

	//jika hasil jm_mk_bln lebih dari 12
	if ( $jm_mk_bln >= 12 ) {
		$jm_mk_bln 	= $jm_mk_bln-12;
		$jm_mk_thn	= $jm_mk_thn+1;
	}
		echo $jm_mk_thn."|".$jm_mk_bln;
	} else {
		echo "|";
	}
}else if($op=='hitung_mk_pak') {

	$tmt_gol			= $_GET['tmt_gol'];
	$tgl_sampai			= $_GET['tgl_sampai'];
	$mk_awal_thn		= $_GET['mk_awal_thn'];
	$mk_awal_bln		= $_GET['mk_awal_bln'];

	if ( ( $mk_awal_thn!=null ) & ( $mk_awal_bln!=null ) & ( $tmt_gol!=null )& ( $tgl_sampai!=null )){

	//pecah tmt_gol
	$gol = explode("-",$tmt_gol);
	$th_gol	=	intval($gol[2]);
	$bl_gol	=	intval($gol[1]);
	$hr_gol	=	intval($gol[0]);

	//pecah tmt tgl_selesai
	//pecah tmt_gol
	$tg_s = explode("-",$tgl_sampai);
	$th_s	=	intval($tg_s[2]);
	$bl_s	=	intval($tg_s[1]);
	$hr_s	=	intval($tg_s[0]);

	//cari selisih selisih tahun
	$sl_th	= $th_s-$th_gol;
	//cari selisih bulan
	//jika hasil selisih bulan kurang dari 0
	if ( $bl_gol > $bl_s ) {
		$sl_bl	= ($bl_s+12)-$bl_gol;
		$sl_th	= $sl_th-1;
	} else {
		$sl_bl	= $bl_s-$bl_gol;
	}

	//cari selisih hari
	//jika hasil selisih hari kurang dari 0
	if ( $hr_gol > $hr_s ) {
		$sl_hr	= ($hr_s+30)-$hr_gol;
		$sl_bl	= $sl_bl-1;
	} else {
		$sl_hr	= $hr_s-$hr_gol;
	}	

	// jika hasil selisih hari  lebih dari 30
	if ( $sl_hr >= 30 ) {
		$sl_hr	= $sl_hr-30;
		$sl_bl	= $sl_bl+1;
	}
	//jika selisih bulan lebih dari 12
	if ( $sl_bl >= 12 ) {
		$sl_bl	= $sl_bl-12;
		$sl_th	= $sl_th+1;
	}

	//mASA kerja akhir yaitu
		$jm_mk_thn	= $sl_th+$mk_awal_thn;
		$jm_mk_bln	= $sl_bl+$mk_awal_bln;
	//jika hasil jm_mk_bln lebih dari 12
	if ( $jm_mk_bln >= 12 ) {
		$jm_mk_bln 	= $jm_mk_bln-12;
		$jm_mk_thn	= $jm_mk_thn+1;
	}
		echo $jm_mk_thn."|".$jm_mk_bln;
	} else {
		echo "|";
	}

}else if($op=='cb_sub_unsur_pend'){
	Connect::getConnection();
	$sql=mysql_query("SELECT DISTINCT sub_unsur FROM kd_kegiatan_dan_ak WHERE unsur='PENDIDIKAN' ");
    echo "<option value=''> * SUB UNSUR * </option>";
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[sub_unsur]'>$r[sub_unsur]</option>";
    }
	
}else if($op=='cb_kegiatan_pend'){
	$unsur = $_GET['unsur'];
	$kd 		= isset($_GET['kd']) ? $_GET['kd'] : '';
	
	Connect::getConnection();
	if ( $unsur == "1"){
	
	//$sql=mysql_query("SELECT DISTINCT kegiatan,angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE sub_unsur='Mengikuti pendidikan dan memperoleh gelar/ ijazah/akta' ");
	$sql=mysql_query("SELECT kegiatan,angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE 
																								kode_kegiatan = '01'
																							or  kode_kegiatan = '01_1'		
																							or  kode_kegiatan = '02'
																							or  kode_kegiatan = '02_1'
																							or  kode_kegiatan = '03'
																							or  kode_kegiatan = '03_1'
																							or  kode_kegiatan = '03_2'
																							or  kode_kegiatan = '03_3'
																							or  kode_kegiatan = '03_3_1'
																							or  kode_kegiatan = '03_3_3'");
    echo "<option value=''> * JENJANG PENDIDIKAN * </option>";
	while($r=mysql_fetch_array($sql)){
		if ($r['kode_kegiatan'] == $kd){
        echo "<option value='$r[kode_kegiatan]' selected>$r[kegiatan]</option>";
		}else{
		echo "<option value='$r[kode_kegiatan]'>$r[kegiatan]</option>";
		}
    }
	
	}else if ( $unsur == "2"){
	$sql=mysql_query("SELECT DISTINCT kegiatan,angka_kredit,kode_kegiatan FROM kd_kegiatan_dan_ak WHERE sub_unsur='Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampunya' ");
    echo "<option value=''> * JENJANG PENDIDIKAN * </option>";
	while($r=mysql_fetch_array($sql)){
        if ($r['kode_kegiatan'] == $kd){
        echo "<option value='$r[kode_kegiatan]' selected>$r[kegiatan]</option>";
		}else{
		echo "<option value='$r[kode_kegiatan]'>$r[kegiatan]</option>";
		}
    }
	
	}else{
		echo "";
	}
}else if($op=='cb_jabatan'){
	Connect::getConnection();
	$sql=mysql_query("SELECT DISTINCT nama_jabatan FROM dt_pegawai WHERE nama_jabatan != '' ");
   
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[nama_jabatan]'>".substr($r['nama_jabatan'],0,27)."</option>";
    }
	
}else if($op=='cb_agama'){
	Connect::getConnection();
	$sql=mysql_query("SELECT DISTINCT agama FROM dt_pegawai WHERE agama != ''");
   
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[agama]'>$r[agama]</option>";
    }
	
}else if($op=='cb_kedudukan_peg'){
	Connect::getConnection();
	$sql=mysql_query("SELECT DISTINCT kedudukan_peg FROM dt_pegawai WHERE kedudukan_peg != ''");
   
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[kedudukan_peg]'>$r[kedudukan_peg]</option>";
    }
	
}else if($op=='cari_ak_pend'){
	$kegiatan = $_GET['kode_kegiatan'];
	Connect::getConnection();
	$sql=mysql_fetch_object(mysql_query("SELECT angka_kredit FROM kd_kegiatan_dan_ak WHERE kode_kegiatan='$kegiatan' "));
    echo $sql->angka_kredit;
}else if($op=='ambil_ak_pkg'){

	$golongan		= $_GET['golongan'];
	$nilai			= $_GET['nilai'];
	
	Connect::getConnection();
	$sql=mysql_fetch_object(mysql_query("SELECT ak FROM kd_dupak_pkg where nilai_pkg='$nilai' and nm_gol='$golongan' "));
	echo  $sql->ak;
}else if($op=='tugas_mengajar'){
	$kd			= $_GET['kd_jenis_guru'];
	Connect::getConnection();
	
	$guru =mysql_fetch_object(mysql_query("SELECT jenis_guru,pbm FROM kd_jenis_guru WHERE kd_jenis_guru='$kd'"));
	if ( $guru->pbm==22) {
		$kode_kegiatan = "06";
	}else{
		$kode_kegiatan = "05";
	}
	
	echo $guru->jenis_guru."|".$kode_kegiatan;
}else if($op=='ak_pbt'){
	$ak			= $_GET['ak'];
	$tugas_1	= $_GET['tugas_1'];
	$tugas_2	= $_GET['tugas_2'];
	
	Connect::getConnection();
	
	//tugas 1
	if ($tugas_1 != null){
	$guru =mysql_fetch_object(mysql_query("SELECT ak_pbt,ak_tugas FROM kd_kegiatan_dan_ak WHERE kode_kegiatan='$tugas_1'"));
	$ak_pbt_1 	= $ak*$guru->ak_pbt;
	$ak_tugas_1 = $ak*$guru->ak_tugas;
	}else{
	$ak_pbt_1 	= $ak;
	$ak_tugas_1 = 0;
	}
	
	if ($tugas_2 != null){
	$guru =mysql_fetch_object(mysql_query("SELECT ak_pbt,ak_tugas FROM kd_kegiatan_dan_ak WHERE kode_kegiatan='$tugas_2'"));
	$x = $guru->ak_tugas;
	//$ak_tugas_2 = $ak_pbt_1*$guru->ak_tugas;
	$ak_tugas_2 = $x*$ak;
	$ak_pbt_2 	= $ak_pbt_1*$guru->ak_pbt;
	}else{
	$ak_pbt_2 	= $ak_pbt_1;
	$ak_tugas_2 = 0;
	
	}
	$jm = $ak_pbt_2+$ak_tugas_1+$ak_tugas_2;
	
	echo 
	number_format($ak_pbt_2,3)."|".
	number_format($ak_tugas_1,3)."|".
	number_format($ak_tugas_2,3)."|".
	number_format($jm,3);
}else if($op=='cb_kegiatan_kolektif'){
	$sub_kegiatan_1 = $_GET['sub_kegiatan_1'];
	Connect::getConnection();
	$sql=mysql_query("SELECT sub_kegiatan_2 FROM kd_kegiatan_dan_ak WHERE sub_kegiatan_1 ='$sub_kegiatan_1' ");
	
		 echo "<option value=''></option>";
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[sub_kegiatan_2]'>$r[sub_kegiatan_2]</option>";
    }
	
}else if($op=='cb_kriteria_piki'){
	Connect::getConnection();
	$sql=mysql_query("SELECT DISTINCT kriteria_piki FROM kd_dupak_kriteria_piki");
	
		echo "<option value=''>---------  Kiteria PIKI ----------</option>";
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[kriteria_piki]'>$r[kriteria_piki]</option>";
    }
	
}else if($op=='cb_sub_kriteria_piki'){
	$cb_kriteria_piki = $_GET['cb_kriteria_piki'];
	Connect::getConnection();
	$sql=mysql_query("SELECT sub_kriteria_piki,kode_kegiatan FROM kd_dupak_kriteria_piki WHERE kriteria_piki ='$cb_kriteria_piki' ");
	
	echo "<option value=''>---------  Sub Kiteria PIKI ----------</option>";
	while($r=mysql_fetch_array($sql)){
        echo "<option value='$r[kode_kegiatan]'>".substr($r['sub_kriteria_piki'],0,77)."</option>";
    }
	
}else if($op=='cari_ak_piki'){
	$kode_kegiatan = $_GET['kode_kegiatan'];
	Connect::getConnection();
	$ak=mysql_fetch_object(mysql_query("SELECT angka_kredit FROM kd_dupak_kriteria_piki WHERE kode_kegiatan ='$kode_kegiatan' "));
	

	echo $ak->angka_kredit;
		
}else if($op=='status_dupak'){
	$id_pegawai		= $_GET['id_pegawai'];
	Connect::getConnection();
	
	//cek apakah NIP menrupakan guru pada skpd tersebut
	$cek_skpd = mysql_query("SELECT id_pegawai,nip_baru,kd_skpd,kedudukan_peg FROM dt_pegawai WHERE id_pegawai = '$id_pegawai' and kedudukan_peg = 'Aktif' ");
	
	if ( mysql_num_rows($cek_skpd) == '1' ){
	
	$cek_x = mysql_fetch_object($cek_skpd);
	if ( $cek_x->kd_skpd ==  $kd_skpd ){
	
	// ketersediaan data
	$data = mysql_query("SELECT * FROM dt_dupak where id_pegawai = '$cek_x->id_pegawai' and kd_skpd='$kd_skpd' and status_dupak !='level_4' ORDER BY tgl_dupak DESC LIMIT 1 ");
	
	//jumlah data pada tabel dupak ..
	$jm = mysql_num_rows($data);
	if ($jm == 0 ) {
		// belum ada dupak baru ( dupak lama sudah selesai)
		echo "0";
	} else {
		$dt_dupak = mysql_fetch_object($data);
		//sudah ada data dupak . maka cari level nya
		if ($dt_dupak->status_dupak == "level_1") {
		// dupak masih dalam proses TU, tampilkan form isian.lanjutkan 
			$nama = mysql_fetch_object(mysql_query("SELECT nama FROM dt_pegawai WHERE id_pegawai = '$dt_dupak->id_pegawai' and kd_skpd='$kd_skpd' "));
		
			echo 
			"1|".
			$dt_dupak->step."|".
			$dt_dupak->no_dupak."|".
			$d->balik($dt_dupak->tgl_dupak)."|".
			$d->balik($dt_dupak->tgl_mulai)."|".
			$d->balik($dt_dupak->tgl_sampai)."|".
		
		
			$dt_dupak->pend_usul."|".
			$dt_dupak->jurusan_pend_usul."|".
			$dt_dupak->th_lulus."|".
			$dt_dupak->gelar_dpn."|".
			$dt_dupak->gelar_blk."|".
			$nama->nama."|".
			$dt_dupak->id_pegawai;
			
		} else {
			//dupak bkn level 1 / dupak sudah dikirim ke tim penilai oleh TU
			//manipulasi by request oleh bu pungky
			echo "0";
			
			
			//echo "2|".
			$cek_x->nip_baru."|";
		}
	}
	} else {
			//nip bukan dari skpd beliau
			echo "3";
	}
	}else{
			//nip tidak valid
			echo "4";
	}
}else if($op=='status_dupak_by_id'){
	$id_dupak		= $_GET['id'];
	Connect::getConnection();
	
	
	// ketersediaan data
	$data = mysql_query("SELECT * FROM dt_dupak where id = '$id_dupak' and status_dupak !='level_4' ");
	
		$dt_dupak = mysql_fetch_object($data);
		//sudah ada data dupak . maka cari level nya
		if ($dt_dupak->status_dupak == "level_1") {
		// dupak masih dalam proses TU, tampilkan form isian.lanjutkan 
			$nama = mysql_fetch_object(mysql_query("SELECT nama FROM dt_pegawai WHERE id_pegawai = '$dt_dupak->id_pegawai' and kd_skpd='$kd_skpd' "));
		
			echo 
			"1|".
			$dt_dupak->step."|".
			$dt_dupak->no_dupak."|".
			$d->balik($dt_dupak->tgl_dupak)."|".
			$d->balik($dt_dupak->tgl_mulai)."|".
			$d->balik($dt_dupak->tgl_sampai)."|".
		
		
			$dt_dupak->pend_usul."|".
			$dt_dupak->jurusan_pend_usul."|".
			$dt_dupak->th_lulus."|".
			$dt_dupak->gelar_dpn."|".
			$dt_dupak->gelar_blk."|".
			$nama->nama."|".
			$dt_dupak->id_pegawai;
			
		} else {
			//dupak bkn level 1 / dupak sudah dikirim ke tim penilai oleh TU
			//manipulasi by request oleh bu pungky
			echo "0";
			
			
			//echo "2|".
			$cek_x->nip_baru."|";
		}
	
}else if($op=='tgl_mulai_dupak'){
	$no_pak		= $_GET['no_pak'];
	
	// ketersediaan data
	Connect::getConnection();
	$tgl = mysql_fetch_object(mysql_query("SELECT tgl_sampai + INTERVAL 1 DAY as tg FROM dt_pak WHERE no_pak='$no_pak' "));

	//tgl akhir penilaian pak terakhir + 1
	echo $d->tgl_form($tgl->tg);
	
	
	
}else if($op=='cek_masa_penilaian'){
	$d 		= New FormatTanggal();
	
	$tgl_mulai			=  strtotime($d->tgl_sql($_GET['a']));
	$tgl_sampai			=  strtotime($d->tgl_sql($_GET['b']));
	
	
	if ( $tgl_mulai >= $tgl_sampai )
	{
		echo "error";
	} else {
		echo "ok";
	}
	
}else if($op=='cari_nip_dupak'){
	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();
	$id = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
	
	$nip = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pegawai WHERE id_pegawai= '$id->id_pegawai' "));
	echo $nip->nip_baru;
	
	
	
	
// PROSES VERIFIKASI DUPAK OLEH TIM PENILAI //
}else if($op=='cari_id_pegawai_dupak'){
	$no_dupak		= $_GET['no_dupak'];
	Connect::getConnection();
	$id = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
	
	
	echo $id->id_pegawai;
	
	
	
	
// PROSES VERIFIKASI DUPAK OLEH TIM PENILAI //
}else if($op=='cek_step'){
	Connect::getConnection();
	$no_dupak 	= $_GET['no_dupak'];	
	$p			= isset($_GET['p']) ? $_GET['p'] : '';
	
	$sql = mysql_fetch_object(mysql_query("SELECT id,step,id_pegawai FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
		switch($sql->step)
		{
		case 1 : $progres=5;
			break;
		case 2 : $progres=18;
			break;
		case 3 : $progres=42;
			break;
		case 4 : $progres=55;
			break;
		case 5 : $progres=76;
			break;
		case 6 : $progres=95;
			break;
		case 7 : $progres=0;
			break;
		case 8 : $progres=5;
			break;
		case 9 : $progres=18;
			break;
		case 10 : $progres=42;
			break;
		case 11 : $progres=55;
			break;
		case 12 : $progres=76;
			break;
		case 13 : $progres=100;
			break;
		case 14 : $progres=5;
			break;
		case 15 : $progres=18;
			break;
		case 16 : $progres=42;
			break;
		case 17 : $progres=55;
			break;
		case 18 : $progres=76;
			break;
		case 19 : $progres=100;
			break;
		default : $progres=100;
		}
	
	$nip = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pegawai WHERE id_pegawai= '$sql->id_pegawai' "));
	
	if (($sql->step == 13) && ($p==2)){
		$progres = 0;
	}
	
		echo $sql->step."|".$nip->nip_baru."|".$progres."|".$sql->id_pegawai."|".$sql->id;

	
	
	
		
	
}else if($op=='ambildata_skpd'){

	$sekolah			= $_GET['sekolah'];
	Connect::getConnection();
	$skpd =mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE sekolah='$sekolah'"));
	echo $skpd->kd_skpd;

}else if($op=='hitung_ak_capaian'){

	$nip_baru 	= $_GET['nip_baru'];

	$no_pak 	= $_GET['no_pak'];

	$pd_baru	= $_GET['pd_baru'];

	$ak_total	= $_GET['ak_total'];

	

	Connect::getConnection();

	

	// Cari nama GOL pada PAK tersebut

	$data1 = mysql_fetch_object(mysql_query("SELECT nama_gol FROM tb_pak_guru_gol WHERE no_pak='$no_pak' "));

	//echo $data1->nama_gol;

	

	// Cari AK Naik,AK pd dan ak piki pada Gol tersebut

	$data2 = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$data1->nama_gol' "));

	echo number_format($data2->ak_naik,3)."|";

	echo number_format($data2->ak_pd,3)."|";

	echo number_format($data2->ak_piki,3)."|";

	

	//Cari data Pak dengan nip ini dan nama gol ini pada tabel pak dan pak_guru_gol 

	// kemudian urutan secara ASc berdasarkan tgl pak

	$data3 = mysql_query("SELECT dt_pak.tgl_pak,dt_pak.no_pak FROM tb_pak_guru_gol,dt_pak WHERE dt_pak.nip_baru='$nip_baru' and tb_pak_guru_gol.nama_gol='$data1->nama_gol' and dt_pak.no_pak=tb_pak_guru_gol.no_pak and SUBSTRING_INDEX(SUBSTRING_INDEX(dt_pak.no_pak,'/',3),'/',-1) = 'TP.GURU' ORDER BY dt_pak.tgl_pak ASC");

	//echo $no_pak."|";

	

	//tg_pak tujuan

	$tg = mysql_fetch_object(mysql_query("SELECT tgl_pak,pd_baru FROM dt_pak WHERE no_pak='$no_pak' "));

	

	//mencari selisih angka PD bila terjadi update/ralat data pak

	$selisih = $pd_baru - $tg->pd_baru;

	

	//inisialisasi

	$ak_kom_capaian = $ak_total;

	$ak_pd_capaian = 0;

	$ak_pi_capaian = 0;

	$makalah = 0;
	$artikel = 0;
	$buku	 = 0;
	

	

	while ($r = mysql_fetch_array($data3)){

		

		

		if (  strtotime($r['tgl_pak']) <= strtotime($tg->tgl_pak) ) {

			//echo $index_x."*";

			

			//cari nilai pd 

			$data4 = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$r[no_pak]' "));

			$ak_pd_capaian = $ak_pd_capaian+$data4->pd_baru+$data4->diklat_lama84+$data4->diklat_baru84;

			$ak_pi_capaian = $ak_pi_capaian+($data4->pi_baru+$data4->ki_baru);
			
			
			
			//makalah artikel dan buku
			if ( $data4->makalah == "TRUE") {
				$makalah = $makalah+1;
			}
			if ( $data4->buku == "TRUE") {
				$buku = $buku+1;
			}
			if ( $data4->artikel == "TRUE") {
				$artikel = $artikel+1;
			}
		}

	}



		echo number_format($ak_kom_capaian,3)."|";

		echo number_format($ak_pd_capaian+$selisih,3)."|";

		echo number_format($ak_pi_capaian,3)."|";
		

		//KESIMPULAN

		if ( $ak_kom_capaian >= $data2->ak_naik ) {

		echo "Terpenuhi|";

		}else{

		echo "Belum Terpenuhi|";

		}

		

		if ( $ak_pd_capaian+$selisih >= $data2->ak_pd ) {

		echo "Terpenuhi|";

		}else{

		echo "Belum Terpenuhi|";

		}

		

		if ( $ak_pi_capaian >= $data2->ak_piki ) {

		echo "Terpenuhi|";

		}else{

		echo "Belum Terpenuhi|";

		}

	
		//ceklis
		if ( $data2->makalah_hasil_penelitian == "TRUE" ) {
			echo "Wajib|";
			echo $makalah."|";
		} else {
			echo "Tidak Wajib|";
			echo $makalah."|";
		
		}
		
		if ( $data2->artikel_di_jurnal == "TRUE" ) {
			echo "Wajib|";
			echo $artikel."|";
		} else {
			echo "Tidak Wajib|";
			echo $artikel."|";
		
		}
		
		if ( $data2->buku_pelajaran == "TRUE" ) {
			echo "Wajib|";
			echo $buku."|";
		} else {
			echo "Tidak Wajib|";
			echo $buku."|";
		
		}
		
		echo $data4->kd_rekom."|";
// ******************************************************* //			
// FUNGSi YANG BERHUBUNGAN DENGAN SEKOLAH //		
// ******************************************************* //		






// ******************************************************* //			
// FUNGSi YANG BERHUBUNGAN DENGAN PENGGUNA atau USER DUPAK //		
// ******************************************************* //	
}else if($op=='cek_skpd_user'){
	$kd_skpd		= $_GET['kd_skpd'];
	Connect::getConnection();
	$query = mysql_query("SELECT kd_skpd FROM dt_dupak_pengguna WHERE kd_skpd='$kd_skpd' ");
	
	if (mysql_num_rows($query) >= 1 ){
		//perlihatkan data user
		$data = mysql_fetch_object($query);
		echo "1";
	}else{
		echo "0";
	}

}else if($op=='cari_nip_pegawai'){
	$nip_baru		= $_GET['nip_baru'];
	Connect::getConnection();
	
	//saya juga bingug knapa ada queery ini, ubah 28072021
	//$cek_nip = mysql_num_rows(mysql_query("SELECT id FROM dt_dupak_pengguna WHERE nip_pengguna='$nip_baru' "));
	
	//if ($cek_nip == 0){
	$query = mysql_query("SELECT * FROM dt_pegawai WHERE nip_baru='$nip_baru' ");
	
	if (mysql_num_rows($query) != 0 ){
	
	$data = mysql_fetch_object($query);
	if ($data->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
	if ($data->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	$nama = $data->gelar_dpn.$titik.ucwords(strtolower($data->nama)).$koma.$data->gelar_blk;
	
	//$skpd =mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$data->kd_skpd'"));
	
	
	echo 
	"1|".
	$data->id_pegawai."|".
	$data->nip_baru."|".
	$nama."|".
	$data->jk."|".
	
	//$data->kd_skpd."|".
	//$skpd->sekolah."|".
	
	$data->nip_baru;
	
	}else{
		echo "0"; //jika nip tidak ada pada dt pegawai
	}
	//}else{
	//	echo "2";  //jika nip sudah diregistrasi
	//}
		
}else if($op=='simpan_pengguna'){
	Connect::getConnection();
	$id_pegawai		= isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : '';
	$nip_pengguna 	= $_GET['nip_pengguna'];
	$nama_pengguna 	= $_GET['nama_pengguna'];
	$jk			 	= $_GET['jk'];
	$user_login		= strtolower($_GET['user_login']);
	$password		= MD5(strtolower($_GET['password']));
	$group			= $_GET['group'];
	
	$kd_skpd 		= isset($_GET['kd_skpd']) ? $_GET['kd_skpd'] : '';
	
	Connect::getConnection();
	$insert=mysql_query("INSERT INTO dt_dupak_pengguna values('','$id_pegawai','$nip_pengguna','$nama_pengguna','$jk','$user_login','$password','$group','$kd_skpd','','','','','1')") or die( mysql_error());
	
	

}else if($op=='update_pengguna'){
	
	$id_pengguna	= $_GET['id_pengguna'];
	$nip_pengguna 	= $_GET['nip_pengguna'];
	$nama_pengguna 	= $_GET['nama_pengguna'];
	$jk			 	= $_GET['jk'];
	$user_login		= strtolower($_GET['user_login']);
	$password		= MD5(strtolower($_GET['password']));
	$status			= isset($_GET['status']) ? $_GET['status'] : '1';

	Connect::getConnection();
	if ( $_GET['password'] == '' ){
		$update = mysql_query("UPDATE dt_dupak_pengguna SET 
									user_login		= '$user_login',
									nip_pengguna	= '$nip_pengguna',
									nama_pengguna	= '$nama_pengguna',
									jk				= '$jk',
									user_login		= '$user_login',
									status			= '$status'
									
									WHERE id		 = '$id_pengguna' ")or die( mysql_error());
									
		//echo "1";
	}else{
		$update = mysql_query("UPDATE dt_dupak_pengguna SET 
									user_login		= '$user_login',
									nip_pengguna	= '$nip_pengguna',
									nama_pengguna	= '$nama_pengguna',
									jk				= '$jk',
									password		= '$password',
									user_login		= '$user_login',
									status			= '$status'
									
									WHERE id		 = '$id_pengguna' ")or die( mysql_error());
		//echo "2";
	}
	
	echo $update;
	
	
}else if($op=='ubah_password'){
	$id_user		= $_GET['id_user'];
	$p_lama			= MD5(strtolower($_GET['p_lama']));
	$p_baru			= MD5(strtolower($_GET['p_baru']));
	
	Connect::getConnection();
	$sql=mysql_fetch_object(mysql_query("SELECT password FROM dt_dupak_pengguna WHERE id='$id_user' "));
	if ( $sql->password == $p_lama ) {
		$log = mysql_query("UPDATE dt_dupak_pengguna SET 
									password		= '$p_baru'
									WHERE id = '$id_user' ");
		echo "sukses";
	}else{
		echo "Password Lama tidak cocok";
	}
   
}else if($op=='ubah_data_user'){
	$id_user		= $_GET['id_user'];
	$password		= MD5(strtolower($_GET['password']));
	$user_baru		= strtolower($_GET['user_baru']);
	
	Connect::getConnection();
	$sql=mysql_fetch_object(mysql_query("SELECT password FROM dt_dupak_pengguna WHERE id='$id_user' "));
	if ( $sql->password == $password ) {
		$log = mysql_query("UPDATE dt_dupak_pengguna SET 
									user_login	= '$user_baru'
									WHERE id = '$id_user' ");
		echo "sukses";
	}else{
		echo "Password Lama tidak cocok";
	}
	
	
   
}else if($op=='ubah_data_sekolah'){	
	$id_user		= $_GET['id_user'];
	$kd_skpd		= $_GET['kd_skpd'];
	$password		= MD5(strtolower($_GET['password']));
	$id_kepsek		= $_GET['id_kepsek'];
	$alamat_sekolah	= $_GET['alamat_sekolah'];
	$no_tlp_sekolah	= $_GET['no_tlp_sekolah'];
	
	
	Connect::getConnection();
	$sql=mysql_fetch_object(mysql_query("SELECT password FROM dt_dupak_pengguna WHERE id='$id_user' "));
	
	//echo $sql->password.'|'.$password;
	if ( $sql->password == $password ) {
			
		$cek = mysql_num_rows(mysql_query("SELECT kd_skpd FROM tb_dupak_sekolah WHERE kd_skpd='$kd_skpd' "));
		
		if ( $cek == "0 "){
		$simpan = mysql_query("INSERT into tb_dupak_sekolah VALUES('','$kd_skpd','$id_kepsek','$alamat_sekolah','$no_tlp_sekolah') ");
		
		}else{
		
		$update = mysql_query("UPDATE tb_dupak_sekolah SET 
									id_kepsek			= '$id_kepsek',
									alamat_sekolah		= '$alamat_sekolah',
									no_tlp_sekolah 		= '$no_tlp_sekolah'
									
									WHERE kd_skpd = '$kd_skpd' ") or die( mysql_error());
		}
		
		$_SESSION['status_sekolah'] = "1";
		
		
		
		echo "sukses";
	}else{
		echo "Password tidak cocok";
	}
	
	
 
}else if($op=='qr_code'){	
	$no_dupak		= $_GET['no_dupak'];

    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../qr_code/temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = './qr_code/temp/';

    include "../qr_code/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

	QRcode::png($no_dupak, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
 
    //display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />'; 
	
	
}else if($op=='cek_sub_kegiatan_kolektif'){
	$sub_kegiatan_1		= $_GET['sub_kegiatan_1'];
	
	Connect::getConnection();
	$sql=mysql_fetch_object(mysql_query("SELECT sub_kegiatan_2 FROM kd_kegiatan_dan_ak WHERE sub_kegiatan_1='$sub_kegiatan_1' "));
	
	if ( $sql->sub_kegiatan_2 != "" ){
		echo "1";
	}else{
		echo "0";
	}
	
	
}else if($op=='set_polling'){
	Connect::getConnection();
	
	$kosongkan = mysql_query("TRUNCATE TABLE dt_polling");
	
	$update = mysql_query("UPDATE tb_pengaturan SET value= '1' WHERE setting = 'polling' ")or die( mysql_error());
	echo $update;
}else if($op=='unset_polling'){
	Connect::getConnection();
	
	$kosongkan = mysql_query("TRUNCATE TABLE dt_polling");
	
	$update = mysql_query("UPDATE tb_pengaturan SET value= '0' WHERE setting = 'polling' ")or die( mysql_error());
	echo $update;
}else if($op=='polling'){
	$pilihan	= $_GET['pilihan'];
	$usulan		= $_GET['usulan'];
	$id_user	= $_GET['id_user'];
	date_default_timezone_set('Asia/Jakarta');
	$waktu = date('Y'."-".'m'."-".'d'." ".'H'.":".'i'.":".'s');
	
	Connect::getConnection();
	$insert=mysql_query("INSERT INTO dt_polling values('','$id_user','$pilihan','$usulan','$waktu')") or die( mysql_error());
	
	echo $insert;
}else if($op=='set_online'){
	Connect::getConnection();

	$update = mysql_query("UPDATE tb_pengaturan SET value= '1' WHERE setting = 'web_status' ")or die( mysql_error());
	echo $update;
}else if($op=='set_mtc'){
	Connect::getConnection();
	
	
	$update = mysql_query("UPDATE tb_pengaturan SET value= '0' WHERE setting = 'web_status' ")or die( mysql_error());
	echo $update;
}
?>