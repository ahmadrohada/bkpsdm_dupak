<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 				= New FormatTanggal();

//$kd_skpd 		= isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
//$nama_user	 	= isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';

$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='detail_data_guru'){
	Connect::getConnection();
	$id_pegawai = $_GET['id_pegawai'];

		$q=mysql_query("SELECT * FROM dt_pegawai where id_pegawai='$id_pegawai'");

		//DATA PEGAWAI
		$d_peg	= mysql_fetch_object($q);
		//echo $d_peg->nip_baru;
		$ttl = ucwords(strtolower($d_peg->tmp_lahir)).", ".$d->balik2($d_peg->tgl_lahir);
		//jk
		if ( $d_peg->jk == 2 ) $jk = "Perempuan";
		if ( $d_peg->jk == 1 ) $jk = "Laki-Laki";
		
		//DATA PAK TERAKHIR
		$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$d_peg->nip_baru' ORDER BY tgl_pak ASC");
		$data_pk = mysql_num_rows($x);
		
		if ( $data_pk >= 1 ) {   //JIKA GURU SUDAH PUNYA PAK
		
			//jika ditemukan data lebih dari 1
			while ($r = mysql_fetch_array($x)){
					$dpt = $r['no_pak'];
			}
	
	
		$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));
		//echo $pak_terakhir->no_pak;
		
		$ak = number_format($pak_terakhir->pend_lama+$pak_terakhir->diklat_lama+$pak_terakhir->pbt_lama+$pak_terakhir->pd_lama+$pak_terakhir->pi_lama+$pak_terakhir->ki_lama+$pak_terakhir->sttb_tdksesuai_lama+$pak_terakhir->dukung_tugas_lama
		+$pak_terakhir->pend_baru+$pak_terakhir->diklat_baru+$pak_terakhir->pbt_baru+$pak_terakhir->pd_baru+$pak_terakhir->pi_baru+$pak_terakhir->ki_baru+$pak_terakhir->sttb_tdksesuai_baru+$pak_terakhir->dukung_tugas_baru,3);

		$pej = mysql_fetch_object(mysql_query("SELECT * FROM dt_pejabat WHERE kd_pejabat='$pak_terakhir->kd_pejabat' "));
		$nama_pejabat = $pej->nm_pejabat;
	
		//DATA PENDIDIKAN TERKAHIR
		//Pencarian data pend guru dari no pak terakhir
		
		$pend = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak='$pak_terakhir->no_pak' "));
		
		
		$nm_pend = mysql_fetch_object(mysql_query("SELECT * FROM kd_pendidikan_usul WHERE kd_pend_usul='$pend->kd_pend_usul' "));
		
		//DATA GOLONGAN DAN TUGAS MENGAJAR
		$gol 		= mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak='$pak_terakhir->no_pak' "));

		$pangkat 	= mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$gol->nama_gol' "));
		$tugas 		= mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru='$gol->kd_jenis_guru' "));
		//skpd
		//$skpd 		= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$pend->kd_skpd' "));
		
		$tugas_mengajar = $tugas->tugas_mengajar;
		$kd_jenis_guru	= $gol->kd_jenis_guru;
		$tmt_gol		= $d->tgl_form($gol->tmt_gol);
		$nm_gol			= $gol->nama_gol;
		//kodePBM
		if ( $tugas->pbm==22) {
		$kode_kegiatan = "06";
		}else{
		$kode_kegiatan = "05";
		}
		
		//NAMA LENGKAP
		
		if ($pend->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($pend->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_lengkap 	= $pend->gelar_dpn.$titik.ucwords(strtolower($d_peg->nama)).$koma.$pend->gelar_blk;
		
		
		
		//DATA PAK TERAKHIR
		$pak_akhir = $pak_terakhir->no_pak;
		$tgl_pak = $d->balik($pak_terakhir->tgl_pak);
		$masa_penilaian = $d->balik($pak_terakhir->tgl_mulai)." s.d ".$d->balik($pak_terakhir->tgl_sampai);
		
		//PENDIDIKAN
		$nama_pend 	= $nm_pend->nama_pend_usul;
		$jurusan	= $pend->jurusan_pend_usul;
		$th_lulus	= $pend->th_pend_usul;
		$g_dpn		= $pend->gelar_dpn;
		$nama		= ucwords(strtolower($d_peg->nama));
		$g_blk		= $pend->gelar_blk;
		
		
			//cek apakah pak terakhir adalah inpassing atau PAK
			$cek_pak =  explode("/",$pak_akhir);
			if ( $cek_pak[2] == 'TP.GURU') { 	//PAK
				$tmt_mk = $gol->tmt_gol;
			}else{								//INPASS
				$tmt_mk = $pak_terakhir->tgl_pak; 
			}
			//MASA KERJA PEGAWAI
			//pecah tmt_gol
			$gol = explode("-",$tmt_mk);
			$th_gol	=	intval($gol[0]);
			$bl_gol	=	intval($gol[1]);
			$hr_gol	=	intval($gol[2]);

			//pecah tmt tgl_selesai
			//pecah tmt_gol
			$tg_s = explode("-",$pak_terakhir->tgl_sampai);
			$th_s	=	intval($tg_s[0]);
			$bl_s	=	intval($tg_s[1]);
			$hr_s	=	intval($tg_s[2]);

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
				$jm_mk_thn	= $sl_th+$d_peg->masakerja_thn;
				$jm_mk_bln	= $sl_bl+$d_peg->masakerja_bln;
			//jika hasil jm_mk_bln lebih dari 12
			if ( $jm_mk_bln >= 12 ) {
				$jm_mk_bln 	= $jm_mk_bln-12;
				$jm_mk_thn	= $jm_mk_thn+1;
			}
		
		
		
		}else{  // ======   Jika data pak belum ada.. maka ambil detail guru dari data master pegawai ===========//
		
		
		
		//NAMA LENGKAP
		
		if ($d_peg->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($d_peg->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_lengkap 	= $d_peg->gelar_dpn.$titik.ucwords(strtolower($d_peg->nama)).$koma.$d_peg->gelar_blk;
		
		
		//PAK terakhir
		$pak_akhir = "-";
		$tgl_pak = "-";
		$masa_penilaian = "-";
		$ak = "-";
		$nama_pejabat = "-";
		
		//pendidikan
		$nama_pend 	= $d_peg->pendidikan_terakhir;
		$jurusan	= $d_peg->jurusan;
		$th_lulus	= $d_peg->tahun_lulus_pendidikan;
		$g_dpn		= $d_peg->gelar_dpn;
		$nama		= ucwords(strtolower($d_peg->nama));
		$g_blk		= $d_peg->gelar_blk;
		
		//DATA GOLONGAN DAN TUGAS MENGAJAR
		$nm_gol 		= $d_peg->gol_trakhir;
		$pangkat 		= mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$nm_gol' "));
		$tugas_mengajar = $d_peg->nama_jabatan;
		
		//skpd
		//$skpd 			= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$d_peg->kd_skpd' "));
		$kd_jenis_guru 	= "";
		$kode_kegiatan 	= "";
		$tmt_gol		= $d->tgl_form($d_peg->tmt_gol_trhr);
		
		//masa kerja
		$jm_mk_thn  = $d_peg->masakerja_thn;
		$jm_mk_bln	= $d_peg->masakerja_bln;
		
		}
		$skpd 			= mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$d_peg->kd_skpd' "));
	
	
		
	
		//DATA GURU PRIBADI
		echo 
		"1|".
		$nama_lengkap."|".
		$ttl."|".
		$jk."|".
		$d_peg->nip_baru."|".
		$d_peg->nuptk."|".
		$d_peg->no_karpeg."|";
		
		//DATA PAK TERAKHIR [7]
		echo 
		$pak_akhir."|".
		$tgl_pak."|".
		$masa_penilaian."|".
		$ak."|".
		$nama_pejabat."|";
		
		//DATA PENDIDIKAN TERKAHIR [12]
		echo
		$nama_pend."|".
		$jurusan."|".
		$th_lulus."|".
		$g_dpn."|".
		$nama."|".
		$g_blk."|".
		$th_lulus."|";
			
		
		//DATA GOLONGAN DAN TUGAS MENGAJAR [19]
		echo
		$nm_gol."|".
		$tugas_mengajar."|".
		$skpd->sekolah."|".
		$kode_kegiatan."|".
		$kd_jenis_guru."|".
		$tmt_gol."|".
		$d_peg->kd_skpd."|".
		$pangkat->pangkat."|".
		$pangkat->jab_lama_guru."|".
		$pangkat->jab_baru_guru."|".
		$d_peg->tmt_jabatan."|";
		
		//
		echo
		"||";
	
		
	
	
		//TAMBAHAN [32]
		echo
		$d_peg->agama."|".
		$d_peg->alamat."|".
		$d_peg->kota."|".
		$d_peg->kode_pos."|".
		$d_peg->no_hp."|".
		$d_peg->status_kepeg."|".
		$d_peg->nip_lama."|".
		$d_peg->nama_jabatan."|". //39
		$d_peg->npwp."|".
		$d_peg->nama."|".
		$d_peg->gelar_dpn."|". 
		$d_peg->gelar_blk."|". //43
		$d_peg->tmp_lahir."|". 
		$d->balik2($d_peg->tgl_lahir)."|".
		$d_peg->jk."|".
		$d_peg->kedudukan_peg."|".
		$d_peg->tgl_lahir."|";
		
		
		//foto
		$ft			= mysql_query("SELECT isi FROM foto WHERE nipbaru='$d_peg->nip_baru' ");
			if ( mysql_num_rows($ft) != 0 ){
			$foto 		= mysql_fetch_object($ft);
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $foto->isi ).'" class="pas_poto"/>'."|";
			}else{
				echo '<img src="images/no_images.jpg" class="pas_poto"/>'."|";
			}
			
		
		//MSA KERJA PADA TABEL PEGAWAI [50]
		echo
		$d_peg->masakerja_thn."|".
		$d_peg->masakerja_bln."|".
		$jm_mk_thn."|".
		$jm_mk_bln."|";
		
		
}else if($op=='detail_data_dupak'){
	Connect::getConnection();
	$no_dupak 	= $_GET['no_dupak'];	
	
	$data = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak where no_dupak='$no_dupak' "));
	
	//sekolah
	$peg = mysql_fetch_object(mysql_query("SELECT kd_skpd FROM dt_pegawai WHERE id_pegawai = '$data->id_pegawai' "));
	$sekolah = mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd where kd_skpd='$peg->kd_skpd' "));
	
	//Kepsek
	$x = mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,nip_baru FROM dt_pegawai WHERE id_pegawai='$data->id_kepsek' "));
	if ( $x->gelar_blk != "" ){
	$koma = ", ";
	}else{
		$koma = "";
	}
	$nama_kepsek 	= $x->gelar_dpn.ucwords(strtolower($x->nama)).$koma.$x->gelar_blk;
		
	//TU
	$y = mysql_fetch_object(mysql_query("SELECT nip_pengguna,nama_pengguna FROM dt_dupak_pengguna WHERE id='$data->id_tu' "));
	$nama_tu 	= ucwords(strtolower($y->nama_pengguna));
	
	
	//DATA DUPAK DASAR
	echo 	
	$data->no_dupak."|".						//0
	$d->tgl_form($data->tgl_dupak)."|".
	$d->tgl_form(substr($data->tgl_entry,0,10))."   [".substr($data->tgl_entry,11,5)."]|".
	$sekolah->sekolah."|". //sekolah
	$nama_kepsek."|".
	$nama_tu."|".
	
	$d->tgl_form($data->tgl_mulai)."|".			//6
	$d->tgl_form($data->tgl_sampai)."|".
	$peg->kd_skpd."|". //sekolah
	$d->balik2($data->tgl_dupak)."|".
	$y->nip_pengguna."|";		//nip_tu			//10
	
	
	
	
	
	//DATA PENDIDIKAN DUPAK ( JIKA ADA PENGAJUAN BARU )
	//jenis unsur
	if ( $data->kd_pend_usul != "" ){
	$j_unsur = mysql_fetch_object(mysql_query("SELECT jenis_unsur,angka_kredit FROM kd_kegiatan_dan_ak where kode_kegiatan='$data->kd_pend_usul' "));
	//NAMA lengkap
	$x = mysql_fetch_object(mysql_query("SELECT nama FROM dt_pegawai where id_pegawai='$data->id_pegawai' "));
	
	echo 	
	$data->pend_usul."|".					//11
	$data->jurusan_pend_usul."|".
	$data->th_lulus."|".
	$data->gelar_dpn."|".
	$data->gelar_blk."|".
	$data->kd_pend_usul."|".
	$j_unsur->jenis_unsur."|".
	$j_unsur->angka_kredit."|".
	$no_dupak."|".
	$x->nama."|";							//20
	}else{
		echo "||||||||||";
	}
	
	//DATA PBT DUPAK
	echo 	
	$data->pkg."|";
	
	//DATA PENILAI DUPAK ( JIKA SUDAH DINILAI)
	if ( $data->id_penilai_1 != "" ){
		$z = mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,nip_baru FROM dt_pegawai WHERE id_pegawai='$data->id_penilai_1' "));
		if ($z->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($z->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_penilai_1 	= $z->gelar_dpn.$titik.ucwords(strtolower($z->nama)).$koma.$z->gelar_blk;
	}else{
		$nama_penilai_1		= "";
	}
	
	if ( $data->id_penilai_2 != "" ){
		$x = mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,nip_baru FROM dt_pegawai WHERE id_pegawai='$data->id_penilai_2' "));
		if ($x->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($x->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_penilai_2 	= $x->gelar_dpn.$titik.ucwords(strtolower($x->nama)).$koma.$x->gelar_blk;
	}else{
		$nama_penilai_2		= "";
	}
	
	echo 	
	$nama_penilai_1."|".$nama_penilai_2."|";
	
}else if($op=='detail_pak_lama'){
	Connect::getConnection();
	//session_start();
	$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
	$id_pegawai 	= $_GET['id_pegawai'];	
	
	
	//$query=mysql_query("SELECT * FROM dt_pegawai where id_pegawai='$id_pegawai' and kd_skpd = '$kd_skpd' ");
	$query=mysql_query("SELECT * FROM dt_pegawai where id_pegawai='$id_pegawai'");
	
	$cek_nip = mysql_num_rows($query);
	if ($cek_nip==1){
		$nip = mysql_fetch_object($query);
		//cari no pak terakhir
		$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$nip->nip_baru' ORDER BY tgl_pak ASC");
		$data = mysql_num_rows($x);
		
		//JIKA data PAK LAMA ada
		if ( $data != 0 ){
		
		//jika ditemukan data lebih dari 1
		if ( $data > 1 ) {
			while ($r = mysql_fetch_array($x)){
					$dpt = $r['no_pak'];
			}
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));
			} else {
					$pak_terakhir = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE nip_baru='$nip->nip_baru' ORDER BY tgl_pak DESC"));
			}
		
	
	
	$no_pak = $pak_terakhir->no_pak;
		//Data Pak
	$pak		=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak'"));

	//Data Perorangan
	$pegawai	=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai WHERE nip_baru='$pak->nip_baru'"));

	$ttl = ucwords(strtolower($pegawai->tmp_lahir)).", ".$d->balik2($pegawai->tgl_lahir);
	if ( $pegawai->jk == 2 ) $jk = "Perempuan";
	if ( $pegawai->jk == 1 ) $jk = "Laki-Laki";

	//Nama Pejabat
	$pejabat	=	mysql_fetch_object(mysql_query("SELECT kd_pejabat,nm_pejabat FROM dt_pejabat WHERE kd_pejabat='$pak->kd_pejabat'"));
	//data PAK GOL
	$pgg = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak ='$pak->no_pak' "));
	$gol = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol ='$pgg->nama_gol' "));

	//PAK Pendidikan
	$pgp = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak ='$pak->no_pak' "));
	if ($pgp->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
	if ($pgp->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	$nama = $pgp->gelar_dpn.$titik.ucwords(strtolower($pegawai->nama)).$koma.$pgp->gelar_blk;
	// SKPD
	$sekolah = mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE kd_skpd ='$pgp->kd_skpd' "));
	//pendidikan USUL
	$pendidikan = mysql_fetch_object(mysql_query("SELECT * FROM kd_pendidikan_usul WHERE kd_pend_usul ='$pgp->kd_pend_usul' "));
	//jafung
	//$jf = isset($pgg->kd_jafung) ? $pgg->kd_jafung : '';
	//$jafung = mysql_fetch_object(mysql_query("SELECT * FROM kd_jafung WHERE kd_jafung ='$jf' "));

	//Jenis guru
	$guru = mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru ='$pgg->kd_jenis_guru' "));

	//REKOMENDASi
	if ( $pak->makalah == "TRUE" ) {
		$makalah = "Terpenuhi";
	}else if ( $pak->makalah == "FALSE" ) {
		$makalah = "Belum Terpenuhi";
	}
	if ( $pak->artikel == "TRUE" ) {
		$artikel = "Terpenuhi";
	}else if ( $pak->artikel == "FALSE" ) {
		$artikel = "Belum Terpenuhi";
	}
	if ( $pak->buku == "TRUE" ) {
		$buku = "Terpenuhi";
	}else if ( $pak->buku == "FALSE" ) {
		$buku = "Belum Terpenuhi";
	}

	//REKOMENDASI
	$rekomendasi = $pak->kd_rekom;

	echo 
	//data pegawai
	$pegawai->nip_baru."|".
	$nama."|".
	$ttl."|".
	$jk."|".
	//Data PAK
	$pak->no_pak."|".
	$d->tgl_form($pak->tgl_pak)."|".
	$d->tgl_form($pak->tgl_mulai)."|".
	$d->tgl_form($pak->tgl_sampai)."|".
	$pejabat->kd_pejabat."|".
	//Data Golongan
	$pgg->nama_gol."|".
	$d->tgl_form($pgg->tmt_gol)."|".
	$gol->pangkat."|".
	$gol->jab_lama_guru."|".
	$gol->jab_baru_guru."|".
	//Masa Kerja
	$pgg->tmt_gol."|".
	$pak->tgl_sampai."|".
	$pgg->mk_gol_bln."|".
	$pgg->mk_gol_thn."|".
	$sekolah->sekolah."|".
	$sekolah->kd_skpd."|".
	//Pendidikan Terakhir
	$pgp->kd_pend_usul."|".
	$pgp->jurusan_pend_usul."|".
	$pgp->th_pend_usul."|".
	$guru->tugas_mengajar."|".
	$d->tgl_form($pgg->tmt_jafung)."|".
	$guru->jenis_guru."|".
	//NILAI PAK
	number_format($pak->pend_lama,3)."|".
	number_format($pak->pend_baru,3)."|".
	number_format($pak->pend_lama+$pak->pend_baru,3)."|".

	number_format($pak->diklat_lama,3)."|".
	number_format($pak->diklat_baru,3)."|".
	number_format($pak->diklat_lama+$pak->diklat_baru,3)."|".

	number_format($pak->pbt_lama,3)."|".
	number_format($pak->pbt_baru,3)."|".
	number_format($pak->pbt_lama+$pak->pbt_baru,3)."|".

	number_format($pak->pd_lama,3)."|".
	number_format($pak->pd_baru,3)."|".
	number_format($pak->pd_lama+$pak->pd_baru,3)."|".

	number_format($pak->pi_lama,3)."|".
	number_format($pak->pi_baru,3)."|".
	number_format($pak->pi_lama+$pak->pi_baru,3)."|".

	number_format($pak->ki_lama,3)."|".
	number_format($pak->ki_baru,3)."|".
	number_format($pak->ki_lama+$pak->ki_baru,3)."|".

	//jmlh unsur utama
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama,3)."|".
	number_format($pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru,3)."|".
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru,3)."|".

	number_format($pak->sttb_tdksesuai_lama,3)."|".
	number_format($pak->sttb_tdksesuai_baru,3)."|".
	number_format($pak->sttb_tdksesuai_lama+$pak->sttb_tdksesuai_baru,3)."|".

	number_format($pak->dukung_tugas_lama,3)."|".
	number_format($pak->dukung_tugas_baru,3)."|".
	number_format($pak->dukung_tugas_lama+$pak->dukung_tugas_baru,3)."|".

	number_format($pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama,3)."|".
	number_format($pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".
	number_format($pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	//TOTAL ANGKA KREDIT
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama,3)."|".
	number_format($pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama
	+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	$pejabat->nm_pejabat."|".
	$pendidikan->nama_pend_usul."|".
	//Rekom
	$makalah."|".
	$artikel."|".
	$buku."|".
	$rekomendasi."|".
	
	$pgg->kd_jenis_guru."|".
	$pgp->gelar_dpn."|".
	$pgp->gelar_blk."|".
	$pegawai->nama."|".
	$pak->no_pak;
	
	//end if data pak-terakhir =0
	}else{
		//echo "data pak 0";
		//ambil data pend dari data guru
	
		$guru = mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai where id_pegawai='$id_pegawai'"));
		
		//pend terakhir
		
		$ck = mysql_num_rows(mysql_query("select kd_pend_usul from kd_pendidikan_usul where nama_pend_usul = '$guru->pendidikan_terakhir' "));
		if ( $ck != 0 ){
			$pend = mysql_fetch_object(mysql_query("select kd_pend_usul from kd_pendidikan_usul where nama_pend_usul = '$guru->pendidikan_terakhir' "));
			$pend_terakhir = $pend->nama_pend_usul;
		}else{
			$pend_terakhir = "";
		}
		
		
		
		
		
		echo 
		"|||||||||".
/*9*/	$guru->gol_trakhir."|".
		$guru->tmt_gol_trhr."|". //10
		"|||||||||".
		$pend_terakhir."|".  //20
/*21*/	$guru->jurusan."|".
		$guru->tahun_lulus_pendidikan."||".
		$guru->tmt_jabatan."|".
		"|||||||".
		"||||||||||".
		"||||||||||".
		"||||||||".
		$guru->pendidikan_terakhir."|".
		"|||||".
		$guru->gelar_blk."|".
		$guru->gelar_dpn."|".
		$guru->nama."|";
	
	}
	
	
	//end if data guru = 0
	}else{
		echo "0";
	}

		
}else if($op=='detail_rekap'){
	Connect::getConnection();
	//session_start();
	$kd_skpd = $_SESSION['kd_skpd'];
	
	$id_pegawai = $_GET['id_pegawai'];	
	$no_dupak 	= $_GET['no_dupak'];	 	
	
	
	
	
	
	//hasil penilai
	//jika belum dinilai,,jangan dulu dikali P1 dan p2
	$query_1 = mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p1'");
	$query_2 = mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p2'");
	
	$ak  	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak'"));
	$f   	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak'"));
	
	if ( (mysql_num_rows($query_1) != 0) & (mysql_num_rows($query_2) != 0)){
	$p1		= mysql_fetch_object($query_1);
	$p2		= mysql_fetch_object($query_2);
	
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
	}else{
		$p1		= mysql_fetch_object($query_1);
		$p2		= mysql_fetch_object($query_2);
	
	$pend_dupak = 	($ak->ak_01)*($f->f_01)+
					($ak->ak_01_1)*($f->f_01_1)+
					($ak->ak_02)*($f->f_02)+
					($ak->ak_02_1)*($f->f_02_1)+
					($ak->ak_03)*($f->f_03)+
					($ak->ak_03_1)*($f->f_03_1)+
					($ak->ak_03_1_1)*($f->f_03_1_1)+
					($ak->ak_03_2)*($f->f_03_2)+
					($ak->ak_03_2_1)*($f->f_03_2_1)+
					($ak->ak_03_2_2)*($f->f_03_2_2)+
					($ak->ak_03_3)*($f->f_03_3)+
					($ak->ak_03_3_1)*($f->f_03_3_1)+
					($ak->ak_03_3_2)*($f->f_03_3_2)+
					($ak->ak_03_3_3)*($f->f_03_3_3);
					
	$diklat_dupak = ($ak->ak_04)*($f->f_04);
	
	$pbt_dupak = 	($ak->ak_05)*($f->f_05)+
					($ak->ak_06)*($f->f_06)+
					($ak->ak_07)*($f->f_07)+
					($ak->ak_08)*($f->f_08)+
					($ak->ak_09)*($f->f_09)+
					($ak->ak_10)*($f->f_10)+
					($ak->ak_11)*($f->f_11)+
					($ak->ak_12)*($f->f_12)+
					($ak->ak_13)*($f->f_13)+
					($ak->ak_14)*($f->f_14)+
					($ak->ak_15)*($f->f_15)+
					($ak->ak_16)*($f->f_16)+
					($ak->ak_17)*($f->f_17)+
					($ak->ak_18)*($f->f_18);
					
	$pd_dupak = 	($ak->ak_19)*($f->f_19)+
					($ak->ak_20)*($f->f_20)+
					($ak->ak_21)*($f->f_21)+
					($ak->ak_22)*($f->f_22)+
					($ak->ak_23)*($f->f_23)+
					($ak->ak_24)*($f->f_24)+
					($ak->ak_25)*($f->f_25)+
					($ak->ak_26)*($f->f_26)+
					($ak->ak_27)*($f->f_27)+
					($ak->ak_28)*($f->f_28);
					
	$pi_dupak = 	($ak->ak_29)*($f->f_29)+
					($ak->ak_30)*($f->f_30)+
					($ak->ak_31)*($f->f_31)+
					($ak->ak_32)*($f->f_32)+
					($ak->ak_33)*($f->f_33)+
					($ak->ak_34)*($f->f_34)+
					($ak->ak_35)*($f->f_35)+
					($ak->ak_36)*($f->f_36)+
					($ak->ak_37)*($f->f_37)+
					($ak->ak_38)*($f->f_38)+
					($ak->ak_39)*($f->f_39)+
					($ak->ak_40)*($f->f_40)+
					($ak->ak_41)*($f->f_41)+
					($ak->ak_42)*($f->f_42)+
					($ak->ak_43)*($f->f_43)+
					($ak->ak_44)*($f->f_44)+
					($ak->ak_45)*($f->f_45)+
					($ak->ak_46)*($f->f_46)+
					($ak->ak_47)*($f->f_47)+
					($ak->ak_48)*($f->f_48)+
					($ak->ak_49)*($f->f_49)+
					($ak->ak_50)*($f->f_50)+
					($ak->ak_51)*($f->f_51);
					
	$ki_dupak = 	($ak->ak_52)*($f->f_52)+
					($ak->ak_53)*($f->f_53)+
					($ak->ak_54)*($f->f_54)+
					($ak->ak_55)*($f->f_55)+
					($ak->ak_56)*($f->f_56)+
					($ak->ak_57)*($f->f_57)+
					($ak->ak_58)*($f->f_58)+
					($ak->ak_59)*($f->f_59)+
					($ak->ak_60)*($f->f_60)+
					($ak->ak_61)*($f->f_61)+
					($ak->ak_62)*($f->f_62)+
					($ak->ak_63)*($f->f_63);
	
	$sttb_tdk_sesuai_dupak = 	($ak->ak_64)*($f->f_64)+
								($ak->ak_65)*($f->f_65)+
								($ak->ak_66)*($f->f_66);
	
	
	$dt_dupak = 	($ak->ak_67)*($f->f_67)+
					($ak->ak_68)*($f->f_68)+
					($ak->ak_69)*($f->f_69)+
					($ak->ak_70)*($f->f_70)+
					($ak->ak_71)*($f->f_71)+
					($ak->ak_72)*($f->f_72)+
					($ak->ak_73)*($f->f_73)+
					($ak->ak_74)*($f->f_74)+
					($ak->ak_75)*($f->f_75)+
					($ak->ak_76)*($f->f_76)+
					($ak->ak_77)*($f->f_77)+
					($ak->ak_78)*($f->f_78)+
					($ak->ak_79)*($f->f_79);
	}
	
	//cari nip dari ID
	$n = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pegawai where id_pegawai='$id_pegawai' "));
	//cari no pak terakhir
	$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$n->nip_baru' ORDER BY tgl_pak ASC");
	$data_pk = mysql_num_rows($x);
	//jika ditemukan data lebih dari 1
	if ( $data_pk >= 1 ) {
		
	//jika ditemukan data lebih dari 1
	while ($r = mysql_fetch_array($x)){
		$dpt = $r['no_pak'];
	}
	
	
	$pak = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt' "));
	
	
	//NILAI PAK LAMA
	$pend_lama 			= $pak->pend_lama;
	$diklat_lama		= $pak->diklat_lama;
	$pbt_lama			= $pak->pbt_lama;
	$pd_lama			= $pak->pd_lama;
	$pi_lama			= $pak->pi_lama;
	$ki_lama			= $pak->ki_lama;
	$sttb_tdksesuai_lama= $pak->sttb_tdksesuai_lama;
	$dukung_tugas_lama	= $pak->dukung_tugas_lama;
	//NILAI PAK Baru
	$pend_baru 			= $pak->pend_baru;
	$diklat_baru		= $pak->diklat_baru;
	$pbt_baru			= $pak->pbt_baru;
	$pd_baru			= $pak->pd_baru;
	$pi_baru			= $pak->pi_baru;
	$ki_baru			= $pak->ki_baru;
	$sttb_tdksesuai_baru= $pak->sttb_tdksesuai_baru;
	$dukung_tugas_baru	= $pak->dukung_tugas_baru;

		
	//DJika belum mengajukan PAK
	}else{
	//NILAI PAK LAMA
	$pend_lama 			= 0;
	$diklat_lama		= 0;
	$pbt_lama			= 0;
	$pd_lama			= 0;
	$pi_lama			= 0;  
	$ki_lama			= 0;
	$sttb_tdksesuai_lama=0;
	$dukung_tugas_lama	= 0;
	//NILAI PAK Baru
	$pend_baru 			= 0;
	$diklat_baru		= 0;
	$pbt_baru			= 0;
	$pd_baru			= 0;
	$pi_baru			= 0;  
	$ki_baru			= 0;
	$sttb_tdksesuai_baru= 0;
	$dukung_tugas_baru	= 0;
		
	}
	
	echo 
	number_format($pend_lama+$pend_baru,3)."|".
	number_format($pend_dupak,3)."|".
	number_format($pend_lama+$pend_baru+$pend_dupak,3)."|".

	number_format($diklat_lama+$diklat_baru,3)."|".
	number_format($diklat_dupak,3)."|".
	number_format($diklat_lama+$diklat_baru+$diklat_dupak,3)."|".
	
	number_format($pbt_lama+$pbt_baru,3)."|".
	number_format($pbt_dupak,3)."|".
	number_format($pbt_lama+$pbt_baru+$pbt_dupak,3)."|".

	
	number_format($pd_lama+$pd_baru,3)."|".
	number_format($pd_dupak,3)."|".
	number_format($pd_lama+$pd_baru+$pd_dupak,3)."|".
	
	number_format($pi_lama+$pi_baru,3)."|".
	number_format($pi_dupak,3)."|".
	number_format($pi_lama+$pi_baru+$pi_dupak,3)."|".

	number_format($ki_lama+$ki_baru,3)."|".
	number_format($ki_dupak,3)."|".
	number_format($ki_lama+$ki_baru+$ki_dupak,3)."|".

	//jmlh unsur utama

	number_format($pend_lama+$diklat_lama+$pbt_lama+$pd_lama+$pi_lama+$ki_lama+$pend_baru+$diklat_baru+$pbt_baru+$pd_baru+$pi_baru+$ki_baru,3)."|".
	number_format($pend_dupak+$diklat_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak,3)."|".
	number_format($pend_lama+$diklat_lama+$pbt_lama+$pd_lama+$pi_lama+$ki_lama+$pend_baru+$diklat_baru+$pbt_baru+$pd_baru+
	$pend_dupak+$diklat_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak+$pi_baru+$ki_baru,3)."|".

	number_format($sttb_tdksesuai_lama+$sttb_tdksesuai_baru,3)."|".
	number_format($sttb_tdk_sesuai_dupak,3)."|".
	number_format($sttb_tdksesuai_lama+$sttb_tdksesuai_baru+$sttb_tdk_sesuai_dupak,3)."|".
	


	number_format($dukung_tugas_lama+$dukung_tugas_baru,3)."|".
	number_format($dt_dupak,3)."|".
	number_format($dukung_tugas_lama+$dukung_tugas_baru+$dt_dupak,3)."|".
	
	//jmlh unsur penunjang
	number_format($sttb_tdksesuai_lama+$dukung_tugas_lama+$sttb_tdksesuai_baru+$dukung_tugas_baru,3)."|".
	number_format($sttb_tdk_sesuai_dupak+$dt_dupak,3)."|".
	number_format($sttb_tdksesuai_lama+$dukung_tugas_lama+$sttb_tdksesuai_baru+$dukung_tugas_baru+$sttb_tdk_sesuai_dupak+$dt_dupak,3)."|".
	

	//TOTAL ANGKA KREDIT
	number_format($pend_lama+$diklat_lama+$pbt_lama+$pd_lama+$pi_lama+$ki_lama+$sttb_tdksesuai_lama+$dukung_tugas_lama
	+$pend_baru+$diklat_baru+$pbt_baru+$pd_baru+$pi_baru+$ki_baru+$sttb_tdksesuai_baru+$dukung_tugas_baru,3)."|".

	number_format($pend_dupak+$diklat_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak+$sttb_tdk_sesuai_dupak+$dt_dupak,3)."|".
	
	number_format($pend_lama+$diklat_lama+$pbt_lama+$pd_lama+$pi_lama+$ki_lama+$sttb_tdksesuai_lama+$dukung_tugas_lama
	+$pend_baru+$diklat_baru+$pbt_baru+$pd_baru+$pi_baru+$ki_baru+$sttb_tdksesuai_baru+$dukung_tugas_baru+
	$pend_dupak+$diklat_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak+$sttb_tdk_sesuai_dupak+$dt_dupak,3);
	
}else if($op=='detail_rekap_tu'){
	Connect::getConnection();
	
	$no_dupak 	= $_GET['no_dupak'];	 	
	
		//cari id pegawai
		$id = mysql_fetch_object(mysql_query("SELECT id_pegawai FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
		
		//cari nip
		$d_peg = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pegawai WHERE id_pegawai = '$id->id_pegawai' "));
		
	//DATA PAK TERAKHIR
		$x = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$d_peg->nip_baru' ORDER BY tgl_pak ASC");
		$data_pk = mysql_num_rows($x);
		
		if ( $data_pk >= 1 ) {   //JIKA GURU SUDAH PUNYA PAK
		
			//jika ditemukan data lebih dari 1
			while ($r = mysql_fetch_array($x)){
					$dpt = $r['no_pak'];
			}

	$pak		=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$dpt'"));
	
	$ak  	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak'"));
	$f   	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak'"));
	//hasil penilai
	
	$p1		= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p1'"));
	$p2		= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p2'"));
	
	$pend_dupak = 	($ak->ak_01)*($f->f_01)+
					($ak->ak_01_1)*($f->f_01_1)+
					($ak->ak_02)*($f->f_02)+
					($ak->ak_02_1)*($f->f_02_1)+
					($ak->ak_03)*($f->f_03)+
					($ak->ak_03_1)*($f->f_03_1)+
					($ak->ak_03_1_1)*($f->f_03_1_1)+
					($ak->ak_03_2)*($f->f_03_2)+
					($ak->ak_03_2_1)*($f->f_03_2_1)+
					($ak->ak_03_2_2)*($f->f_03_2_2)+
					($ak->ak_03_3)*($f->f_03_3)+
					($ak->ak_03_3_1)*($f->f_03_3_1)+
					($ak->ak_03_3_2)*($f->f_03_3_2)+
					($ak->ak_03_3_3)*($f->f_03_3_3);
					
	$diklat_dupak = ($ak->ak_04)*($f->f_04);
	
	$pbt_dupak = 	($ak->ak_05)*($f->f_05)+
					($ak->ak_06)*($f->f_06)+
					($ak->ak_07)*($f->f_07)+
					($ak->ak_08)*($f->f_08)+
					($ak->ak_09)*($f->f_09)+
					($ak->ak_10)*($f->f_10)+
					($ak->ak_11)*($f->f_11)+
					($ak->ak_12)*($f->f_12)+
					($ak->ak_13)*($f->f_13)+
					($ak->ak_14)*($f->f_14)+
					($ak->ak_15)*($f->f_15)+
					($ak->ak_16)*($f->f_16)+
					($ak->ak_17)*($f->f_17)+
					($ak->ak_18)*($f->f_18);
					
	$pd_dupak = 	($ak->ak_19)*($f->f_19)+
					($ak->ak_20)*($f->f_20)+
					($ak->ak_21)*($f->f_21)+
					($ak->ak_22)*($f->f_22)+
					($ak->ak_23)*($f->f_23)+
					($ak->ak_24)*($f->f_24)+
					($ak->ak_25)*($f->f_25)+
					($ak->ak_26)*($f->f_26)+
					($ak->ak_27)*($f->f_27)+
					($ak->ak_28)*($f->f_28);
					
	$pi_dupak = 	($ak->ak_29)*($f->f_29)+
					($ak->ak_30)*($f->f_30)+
					($ak->ak_31)*($f->f_31)+
					($ak->ak_32)*($f->f_32)+
					($ak->ak_33)*($f->f_33)+
					($ak->ak_34)*($f->f_34)+
					($ak->ak_35)*($f->f_35)+
					($ak->ak_36)*($f->f_36)+
					($ak->ak_37)*($f->f_37)+
					($ak->ak_38)*($f->f_38)+
					($ak->ak_39)*($f->f_39)+
					($ak->ak_40)*($f->f_40)+
					($ak->ak_41)*($f->f_41)+
					($ak->ak_42)*($f->f_42)+
					($ak->ak_43)*($f->f_43)+
					($ak->ak_44)*($f->f_44)+
					($ak->ak_45)*($f->f_45)+
					($ak->ak_46)*($f->f_46)+
					($ak->ak_47)*($f->f_47)+
					($ak->ak_48)*($f->f_48)+
					($ak->ak_49)*($f->f_49)+
					($ak->ak_50)*($f->f_50)+
					($ak->ak_51)*($f->f_51);
					
	$ki_dupak = 	($ak->ak_52)*($f->f_52)+
					($ak->ak_53)*($f->f_53)+
					($ak->ak_54)*($f->f_54)+
					($ak->ak_55)*($f->f_55)+
					($ak->ak_56)*($f->f_56)+
					($ak->ak_57)*($f->f_57)+
					($ak->ak_58)*($f->f_58)+
					($ak->ak_59)*($f->f_59)+
					($ak->ak_60)*($f->f_60)+
					($ak->ak_61)*($f->f_61)+
					($ak->ak_62)*($f->f_62)+
					($ak->ak_63)*($f->f_63);
	
	$sttb_tdk_sesuai_dupak = 	($ak->ak_64)*($f->f_64)+
								($ak->ak_65)*($f->f_65)+
								($ak->ak_66)*($f->f_66);
	
	
	$dt_dupak = 	($ak->ak_67)*($f->f_67)+
					($ak->ak_68)*($f->f_68)+
					($ak->ak_69)*($f->f_69)+
					($ak->ak_70)*($f->f_70)+
					($ak->ak_71)*($f->f_71)+
					($ak->ak_72)*($f->f_72)+
					($ak->ak_73)*($f->f_73)+
					($ak->ak_74)*($f->f_74)+
					($ak->ak_75)*($f->f_75)+
					($ak->ak_76)*($f->f_76)+
					($ak->ak_77)*($f->f_77)+
					($ak->ak_78)*($f->f_78)+
					($ak->ak_79)*($f->f_79);
	
	//NILAI PAK LAMA
	echo 
	
	number_format($pak->pend_lama+$pak->pend_baru,3)."|".
	number_format($pend_dupak,3)."|".
	number_format($pak->pend_lama+$pak->pend_baru+$pend_dupak,3)."|".

	number_format($pak->diklat_lama+$pak->diklat_baru,3)."|".
	number_format($diklat_dupak,3)."|".
	number_format($pak->diklat_lama+$pak->diklat_baru+$diklat_dupak,3)."|".
	
	number_format($pak->pbt_lama+$pak->pbt_baru,3)."|".
	number_format($pbt_dupak,3)."|".
	number_format($pak->pbt_lama+$pak->pbt_baru+$pbt_dupak,3)."|".

	
	number_format($pak->pd_lama+$pak->pd_baru,3)."|".
	number_format($pd_dupak,3)."|".
	number_format($pak->pd_lama+$pak->pd_baru+$pd_dupak,3)."|".
	
	number_format($pak->pi_lama+$pak->pi_baru,3)."|".
	number_format($pi_dupak,3)."|".
	number_format($pak->pi_lama+$pak->pi_baru+$pi_dupak,3)."|".

	number_format($pak->ki_lama+$pak->ki_baru,3)."|".
	number_format($ki_dupak,3)."|".
	number_format($pak->ki_lama+$pak->ki_baru+$ki_dupak,3)."|".

	//jmlh unsur utama

	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru,3)."|".
	number_format($pend_dupak+$ki_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak,3)."|".
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+
	$pend_dupak+$ki_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak+$pak->pi_baru+$pak->ki_baru,3)."|".

	number_format($pak->sttb_tdksesuai_lama+$pak->sttb_tdksesuai_baru,3)."|".
	number_format($sttb_tdk_sesuai_dupak,3)."|".
	number_format($pak->sttb_tdksesuai_lama+$pak->sttb_tdksesuai_baru+$sttb_tdk_sesuai_dupak,3)."|".
	


	number_format($pak->dukung_tugas_lama+$pak->dukung_tugas_baru,3)."|".
	number_format($dt_dupak,3)."|".
	number_format($pak->dukung_tugas_lama+$pak->dukung_tugas_baru+$dt_dupak,3)."|".
	
	//jmlh unsur penunjang
	number_format($pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".
	number_format($sttb_tdk_sesuai_dupak+$dt_dupak,3)."|".
	number_format($pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru+$sttb_tdk_sesuai_dupak+$dt_dupak,3)."|".
	

	//TOTAL ANGKA KREDIT
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama
	+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	number_format($pend_dupak+$ki_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak+$sttb_tdk_sesuai_dupak+$dt_dupak,3)."|".
	
	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama
	+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru+
	$pend_dupak+$ki_dupak+$pbt_dupak+$pd_dupak+$pi_dupak+$ki_dupak+$sttb_tdk_sesuai_dupak+$dt_dupak,3);

	}
}else if($op=='detail_pak_inpass'){

	$no_pak			= $_GET['no_pak'];

	Connect::getConnection();

	

	//Data Pak

	$pak		=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak'"));

	

	

	//Data Perorangan

	
	$pegawai	=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai WHERE nip_baru='$pak->nip_baru'"));
	$ttl = ucwords(strtolower($pegawai->tmp_lahir)).", ".$d->balik2($pegawai->tgl_lahir);

	if ( $pegawai->jk == 2 ) $jk = "Perempuan";

	if ( $pegawai->jk == 1 ) $jk = "Laki-Laki";

	

	//Nama Pejabat

	$pejabat	=	mysql_fetch_object(mysql_query("SELECT nm_pejabat,kd_pejabat FROM dt_pejabat WHERE kd_pejabat='$pak->kd_pejabat'"));

	

	//data PAK GOL

	$pgg = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak ='$no_pak' "));

	$gol = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol ='$pgg->nama_gol' "));

	

	

	//PAK Pendidikan

	$pgp = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak ='$pak->no_pak' "));
	
	
	
	if ($pgp->gelar_blk == null ) 

		{ $koma = ""; } else { $koma = ", ";};
	if ($pgp->gelar_dpn == null ) 

		{ $titik = ""; } else { $titik = ". ";};
	

	$nama = $pgp->gelar_dpn.$titik.ucwords(strtolower($pegawai->nama)).$koma.$pgp->gelar_blk;

	// SKPD

	$sekolah = mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE kd_skpd ='$pgp->kd_skpd' "));

	

	//pendidikan USUL

	$pendidikan = mysql_fetch_object(mysql_query("SELECT * FROM kd_pendidikan_usul WHERE kd_pend_usul ='$pgp->kd_pend_usul' "));



	//jafung

	$jafung = mysql_fetch_object(mysql_query("SELECT * FROM kd_jafung WHERE kd_jafung ='$gol->kd_jafung' "));

	

	//Jenis guru

	$guru = mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru ='$pgg->kd_jenis_guru' "));

	

	echo 

	//data pegawai

	$pegawai->nip_baru."|".

	$nama."|".

	$ttl."|".

	$jk."|".

	//Data PAK

	$pak->no_pak."|".

	$d->tgl_form($pak->tgl_pak)."|".

	$d->tgl_form($pak->tgl_pak)."|".

	$d->tgl_form($pak->tgl_mulai)."|".

	$d->tgl_form($pak->tgl_sampai)."|".

	$pejabat->nm_pejabat."|".

	//Data Golongan

	$pgg->nama_gol."|".

	// 11

	$d->tgl_form($pgg->tmt_gol)."|".

	$gol->pangkat."|".

	$gol->jab_lama_guru."|".

	$gol->jab_baru_guru."|".

	//Masa Kerja

	$pgg->tmt_gol."|".

	$pak->tgl_pak."|".

	$pgg->mk_gol_bln."|".

	$pgg->mk_gol_thn."|".

	$sekolah->sekolah."|".

	$sekolah->sekolah."|".

	$sekolah->skpd2."|".

	//Pendidikan Terakhir 22

	$pendidikan->nama_pend_usul."|".

	$pgp->jurusan_pend_usul."|".

	$pgp->th_pend_usul."|".

	$jafung->jafung."|".

	$d->tgl_form($pgg->tmt_jafung)."|".

	$guru->tugas_mengajar."|".

	$guru->jenis_guru."|".

	$pak->no_pak_lama."|".

	

	//NILAI PAK INPASS

	number_format($pak->pend_lama84,3)."|".

	number_format($pak->diklat_lama84,3)."|".

	number_format($pak->pbm_lama84,3)."|".

	number_format($pak->pp_lama84,3)."|".

	number_format($pak->penunjang_lama84,3)."|".

	

	number_format($pak->pend_baru84,3)."|".

	number_format($pak->diklat_baru84,3)."|".

	number_format($pak->pbm_baru84,3)."|".

	number_format($pak->pp_baru84,3)."|".

	number_format($pak->penunjang_baru84,3)."|".

	

	//untuk update ralat

	number_format($pendidikan->ak_pend_usul,3)."|".

	$guru->pbm."|".

	$pgg->tmt_gol."|".

	$pak->tgl_pak."|".

	$pak->tgl_pak."|".

	$pak->tgl_mulai."|".

	$pak->tgl_sampai."|".

	$pgg->tmt_jafung."|".

	$sekolah->kd_skpd."|".

	$pendidikan->kd_pend_usul."|".

	$jafung->kd_jafung."|".

	$guru->kd_jenis_guru."|".

	$pak->kd_pejabat."|".

	$pgp->gelar_dpn."|".
	$pegawai->nama."|".
	$pgp->gelar_blk."|".

	$pak->no_pak;

}else if($op=='detail_pak'){

	$no_pak			= $_GET['no_pak'];

	Connect::getConnection();

	

	//Data Pak

	$pak		=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak'"));

	

	

	//Data Perorangan

	$pegawai	=	mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai WHERE nip_baru='$pak->nip_baru'"));

	

	$ttl = ucwords(strtolower($pegawai->tmp_lahir)).", ".$d->balik2($pegawai->tgl_lahir);

	if ( $pegawai->jk == 2 ) $jk = "Perempuan";

	if ( $pegawai->jk == 1 ) $jk = "Laki-Laki";

	

	//Nama Pejabat

	$pejabat	=	mysql_fetch_object(mysql_query("SELECT kd_pejabat,nm_pejabat FROM dt_pejabat WHERE kd_pejabat='$pak->kd_pejabat'"));

	

	//data PAK GOL

	$pgg = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak ='$pak->no_pak' "));

	$gol = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol ='$pgg->nama_gol' "));

	

	

	//PAK Pendidikan

	$pgp = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak ='$pak->no_pak' "));

	if ($pgp->gelar_blk == null ) 

		{ $koma = ""; } else { $koma = ", ";};
	if ($pgp->gelar_dpn == null ) 

		{ $titik = ""; } else { $titik = ". ";};
	

	$nama = $pgp->gelar_dpn.$titik.ucwords(strtolower($pegawai->nama)).$koma.$pgp->gelar_blk;
	// SKPD

	$sekolah = mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE kd_skpd ='$pgp->kd_skpd' "));

	

	//pendidikan USUL

	$pendidikan = mysql_fetch_object(mysql_query("SELECT * FROM kd_pendidikan_usul WHERE kd_pend_usul ='$pgp->kd_pend_usul' "));



	//jafung
	//$jf = isset($pgg->kd_jafung) ? $pgg->kd_jafung : '';
	//$jafung = mysql_fetch_object(mysql_query("SELECT * FROM kd_jafung WHERE kd_jafung ='$jf' "));

	

	//Jenis guru

	$guru = mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru ='$pgg->kd_jenis_guru' "));

	

	//REKOMENDASi

	if ( $pak->makalah == "TRUE" ) {

		$makalah = "Terpenuhi";

	}else if ( $pak->makalah == "FALSE" ) {

		$makalah = "Belum Terpenuhi";

	}

	if ( $pak->artikel == "TRUE" ) {

		$artikel = "Terpenuhi";

	}else if ( $pak->artikel == "FALSE" ) {

		$artikel = "Belum Terpenuhi";

	}

	if ( $pak->buku == "TRUE" ) {

		$buku = "Terpenuhi";

	}else if ( $pak->buku == "FALSE" ) {

		$buku = "Belum Terpenuhi";

	}

	

	//REKOMENDASI

	$rekomendasi = $pak->kd_rekom;

	

	echo 

	//data pegawai

	$pegawai->nip_baru."|".

	$nama."|".

	$ttl."|".

	$jk."|".

	//Data PAK

	$pak->no_pak."|".

	$d->tgl_form($pak->tgl_pak)."|".

	$d->tgl_form($pak->tgl_mulai)."|".

	$d->tgl_form($pak->tgl_sampai)."|".

	$pejabat->kd_pejabat."|".

	//Data Golongan

	$pgg->nama_gol."|".

	$d->tgl_form($pgg->tmt_gol)."|".

	$gol->pangkat."|".

	$gol->jab_lama_guru."|".

	$gol->jab_baru_guru."|".

	//Masa Kerja

	$pgg->tmt_gol."|".

	$pak->tgl_sampai."|".

	$pgg->mk_gol_bln."|".

	$pgg->mk_gol_thn."|".

	$sekolah->sekolah."|".

	$sekolah->kd_skpd."|".

	//Pendidikan Terakhir

	$pendidikan->kd_pend_usul."|".

	$pgp->jurusan_pend_usul."|".

	$pgp->th_pend_usul."|".

	$guru->tugas_mengajar."|".

	$d->tgl_form($pgg->tmt_jafung)."|".

	$guru->jenis_guru."|".

	//NILAI PAK

	number_format($pak->pend_lama,3)."|".

	number_format($pak->pend_baru,3)."|".

	number_format($pak->pend_lama+$pak->pend_baru,3)."|".

	

	number_format($pak->diklat_lama,3)."|".

	number_format($pak->diklat_baru,3)."|".

	number_format($pak->diklat_lama+$pak->diklat_baru,3)."|".

	

	number_format($pak->pbt_lama,3)."|".

	number_format($pak->pbt_baru,3)."|".

	number_format($pak->pbt_lama+$pak->pbt_baru,3)."|".

	

	number_format($pak->pd_lama,3)."|".

	number_format($pak->pd_baru,3)."|".

	number_format($pak->pd_lama+$pak->pd_baru,3)."|".

	

	number_format($pak->pi_lama,3)."|".

	number_format($pak->pi_baru,3)."|".

	number_format($pak->pi_lama+$pak->pi_baru,3)."|".

	

	number_format($pak->ki_lama,3)."|".

	number_format($pak->ki_baru,3)."|".

	number_format($pak->ki_lama+$pak->ki_baru,3)."|".

	

	//jmlh unsur utama

	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama,3)."|".

	number_format($pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru,3)."|".

	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru,3)."|".

	

	number_format($pak->sttb_tdksesuai_lama,3)."|".

	number_format($pak->sttb_tdksesuai_baru,3)."|".

	number_format($pak->sttb_tdksesuai_lama+$pak->sttb_tdksesuai_baru,3)."|".

	

	number_format($pak->dukung_tugas_lama,3)."|".

	number_format($pak->dukung_tugas_baru,3)."|".

	number_format($pak->dukung_tugas_lama+$pak->dukung_tugas_baru,3)."|".

	

	

	number_format($pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama,3)."|".

	number_format($pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	number_format($pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	

	//TOTAL ANGKA KREDIT

	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama,3)."|".

	number_format($pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	number_format($pak->pend_lama+$pak->diklat_lama+$pak->pbt_lama+$pak->pd_lama+$pak->pi_lama+$pak->ki_lama+$pak->sttb_tdksesuai_lama+$pak->dukung_tugas_lama

	+$pak->pend_baru+$pak->diklat_baru+$pak->pbt_baru+$pak->pd_baru+$pak->pi_baru+$pak->ki_baru+$pak->sttb_tdksesuai_baru+$pak->dukung_tugas_baru,3)."|".

	

	$pejabat->nm_pejabat."|".

	$pendidikan->nama_pend_usul."|".

	//Rekom

	$makalah."|".

	$artikel."|".

	$buku."|".

	$rekomendasi."|".
	
	$pgp->gelar_dpn."|".
	$pegawai->nama."|".
	$pgp->gelar_blk."|".

	

	$pak->no_pak;

}else if($op=='detail_data_user'){
	Connect::getConnection();
	$id 	= $_GET['id_user'];

	$data = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_pengguna WHERE id= '$id' "));
	$nama_user = $data->nama_pengguna;
	
	if ($data->group == '5' ) 	$group = 'Guru';
	if ($data->group == '4' ) 	$group = 'Operator Sekolah';
	if ($data->group == '2' ) 	$group = 'Sekretariat';
	if ($data->group == '3' ) 	$group = 'Tim Penilai';
	if ($data->group == '1' ) 	$group = 'Administrator';
	
	
	echo
	
	$group."|".
	$data->nip_pengguna."|".
	$nama_user."|".
	$data->jk."|".
	$data->user_login."|".
	$data->kd_skpd;
}else if($op=='detail_data_sekolah'){
	Connect::getConnection();
	$kd_skpd 	= $_GET['kd_skpd'];
	$id_user	= $_SESSION['id_user']; 		

	$r = mysql_query("SELECT kd_skpd FROM tb_dupak_sekolah WHERE kd_skpd= '$kd_skpd' ");
	//cari info sekolah
	
	$jm =  mysql_num_rows($r);
	if ( $jm != "0" ) {

	$x = mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_sekolah WHERE kd_skpd= '$kd_skpd' "));
	
		
		
		$z = mysql_fetch_object(mysql_query("SELECT nama,gelar_dpn,gelar_blk,nip_baru FROM dt_pegawai WHERE id_pegawai='$x->id_kepsek' "));
		if ($z->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($z->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_kepsek 	= $z->gelar_dpn.$titik.ucwords(strtolower($z->nama)).$koma.$z->gelar_blk;
		$nip_kepsek		= $z->nip_baru;
		$id_kepsek		= $x->id_kepsek;
		$alamat_sekolah	= $x->alamat_sekolah;
		$no_tlp_sekolah	= $x->no_tlp_sekolah;
		//sekolah
		
	
	}else{
		$id_kepsek		= "";
		$nip_kepsek		= "";
		$nama_kepsek	= "";
		$alamat_sekolah	= "";
		$no_tlp_sekolah	= "";
		
	} 
		// NAMA TU
		$data = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_pengguna WHERE id= '$id_user' "));
		$nama_operator_sekolah = $data->nama_pengguna;
		
		//NAMA SEKOLAH
		$y = mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$kd_skpd' "));
		$nama_sekolah = $y->sekolah;
	
	echo
	$jm."|".
	$id_kepsek."|".
	$nip_kepsek."|".
	$nama_kepsek."|".  
	$nama_sekolah."|". //3
	$kd_skpd."|".
	$alamat_sekolah."|".
	$no_tlp_sekolah."|".
	$nama_operator_sekolah;
	
	
}else if($op=='detail_dupak_kepsek'){
	Connect::getConnection();
	$no_dupak 	= $_GET['no_dupak'];	
	$id 		= mysql_fetch_object(mysql_query("SELECT id_kepsek FROM dt_dupak where no_dupak='$no_dupak' "));

	//cari data pegawai(kepala sekolah) pada tabel pegawai
	$kepsek 	= mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai where id_pegawai='$id->id_kepsek' "));
	
	
		if ($kepsek->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($kepsek->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_kepsek 	= $kepsek->gelar_dpn.$titik.ucwords(strtolower($kepsek->nama)).$koma.$kepsek->gelar_blk;
	
	
	//golongan
	$pang 	= mysql_fetch_object(mysql_query("SELECT pangkat,jab_baru_guru FROM kd_golongan where kd_gol='$kepsek->gol_trakhir' "));
	//sekolah
	$y = mysql_fetch_object(mysql_query("SELECT sekolah FROM kd_skpd WHERE kd_skpd='$kepsek->kd_skpd' "));
	$nama_sekolah = $y->sekolah;
	
	
	echo 
	$kepsek->id_pegawai."|".
	$nama_kepsek."|".
	$kepsek->nip_baru."|".
	$kepsek->nuptk."|".
	$pang->pangkat."|". 
	$kepsek->gol_trakhir."|". 
	$d->tgl_form($kepsek->tmt_gol_trhr)."|". 
	$pang->jab_baru_guru."|". 
	$nama_sekolah."|";
	
}else if($op=='detail_pendidikan_dupak'){
	Connect::getConnection();
	$no_dupak 	= $_GET['no_dupak'];	
	
	$dupak 	= mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak where no_dupak='$no_dupak' "));
	//cari unsur
	//$query	= mysql_query("SELECT * FROM kd_kegiatan_dan_ak where kode_kegiatan='$dupak->kd_pend_usul' and unsur = 'PENDIDIKAN' ");
	$query	= mysql_query("SELECT * FROM kd_kegiatan_dan_ak where kode_kegiatan='$dupak->kd_pend_usul'");
	
	if (mysql_num_rows($query) != 0 ){
	
	$det 	= mysql_fetch_object($query);
	
	if ( $det->jenis_unsur == "UNSUR UTAMA" ) {
		$unsur = "1";
	}else if ( $det->jenis_unsur == "UNSUR PENUNJANG" ){
		$unsur = "2";
	}
	
	echo 
	$unsur."|".
	$dupak->kd_pend_usul."|".
	$det->angka_kredit."|".
	$dupak->jurusan_pend_usul."|".
	$dupak->th_lulus."|".
	$dupak->gelar_dpn."|".
	$dupak->gelar_blk."|".
	$no_dupak;
	}else{
	echo 
	"0|||".
	$dupak->jurusan_pend_usul."|".
	$dupak->th_lulus."|".
	$dupak->gelar_dpn."|".
	$dupak->gelar_blk."|".
	$no_dupak;
	
	
	}
}else if($op=='detail_pbt_dupak'){
	Connect::getConnection();
	
	$no_dupak 	= $_GET['no_dupak'];	
	
	$sql = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak WHERE no_dupak = '$no_dupak' "));
	
	//cari ak_pkg
	if ( $sql->pkg != ''){
		$ak = mysql_fetch_object(mysql_query("SELECT ak FROM kd_dupak_pkg WHERE nm_gol='$sql->nama_gol' and nilai_pkg='$sql->pkg' "));
		$ak_pkg = $ak->ak;
	}else{
		$ak_pkg = 0;
	}
	
	//jenis guru
	$gg = mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru = '$sql->kd_jenis_guru' "));
	
	//cari tugas tambahan
	$ck = mysql_num_rows(mysql_query("SELECT no_dupak FROM dt_dupak_tugas_tambahan WHERE no_dupak = '$no_dupak' "));
	
	if ( $ck != 0 ){
	$tt = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_tugas_tambahan WHERE no_dupak = '$no_dupak' "));
	
	
	
	//nama_tugas tambahan
	if ( $tt->tugas_tambahan_1 != '' ){ 
		$tgs_1 = mysql_fetch_object(mysql_query("SELECT kegiatan FROM kd_kegiatan_dan_ak WHERE kode_kegiatan = '$tt->tugas_tambahan_1' "));
		$nama_tugas_1 = $tgs_1->kegiatan;
	}else{
		$nama_tugas_1 = "";
	}
	if ( $tt->tugas_tambahan_2 != '' ){ 
		$tgs_2 = mysql_fetch_object(mysql_query("SELECT kegiatan FROM kd_kegiatan_dan_ak WHERE kode_kegiatan = '$tt->tugas_tambahan_2' "));
		$nama_tugas_2 = $tgs_2->kegiatan;
	}else{
		$nama_tugas_2 = "";
	}
	
		echo
		$sql->pkg."|".
		$ak_pkg."|".
		$gg->kd_jenis_guru."|".
		$sql->nama_gol."|".
		$d->tgl_form($sql->tmt_gol)."|".
		$tt->jenis_guru."|".      //05
		$tt->tugas_tambahan_1."|".	
		$tt->tugas_tambahan_2."|".
		$tt->ak_jenis_guru."|". //08
		$tt->ak_1."|".	
		$tt->ak_2."|".
		number_format(($tt->ak_1+$tt->ak_2+$tt->ak_jenis_guru),3)."|".
		$gg->jenis_guru."|".
		$nama_tugas_1."|". //13
		$nama_tugas_2."|";
	}else{
		echo
		$sql->pkg."|".
		$ak_pkg."|".
		$gg->kd_jenis_guru."|".
		$sql->nama_gol."|".
		$d->tgl_form($sql->tmt_gol)."|".
		"|".      //05
		"|".	
		"|".
		"0.000|". //08
		"0.000|".	
		"0.000|".
		"0.000|".
		$gg->jenis_guru."|".
		"|". //13
		"|";
		
	}
}else if($op=='detail_diklat_dupak'){
	Connect::getConnection();
	
	$id_diklat	= $_GET['id_diklat'];	
	
	
	$diklat = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_diklat WHERE id = '$id_diklat' "));
	
	
	echo
	$diklat->id."|".
	$diklat->no_dupak."|".
	$diklat->kode_kegiatan."|".
	$diklat->jp."|".
	$diklat->ak."|".
	$diklat->nama_diklat."|". //5
	$diklat->penyelenggara."|".	
	$d->tgl_form($diklat->tgl_mulai)."|".
	$d->tgl_form($diklat->tgl_selesai)."|".
	$d->tgl_form($diklat->tgl_sertifikat)."|".	
	$diklat->no_sertifikat."|";
	
}else if($op=='detail_kolektif_dupak'){
	Connect::getConnection();
	
	$id	= $_GET['id_kolektif'];	
	
	
	$kolektif	= mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_kegiatan_kolektif WHERE id = '$id' "));
	
	$keg 		= mysql_fetch_object(mysql_query("SELECT sub_kegiatan_1,sub_kegiatan_2 FROM kd_kegiatan_dan_ak WHERE kode_kegiatan = '$kolektif->kode_kegiatan' "));
	
	
	echo
	$kolektif->id."|".
	$kolektif->kode_kegiatan."|".
	$keg->sub_kegiatan_1."|".
	$keg->sub_kegiatan_2."|".
	$kolektif->ak."|".
	$kolektif->nama_kegiatan."|". 
	$d->tgl_form($kolektif->tgl_pelaksanaan)."|";
	
}else if($op=='detail_piki_dupak'){
	Connect::getConnection();
	
	$id	= $_GET['id_piki'];	
	
	
	$piki	= mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_piki WHERE id = '$id' "));
	$keg 		= mysql_fetch_object(mysql_query("SELECT * FROM kd_dupak_kriteria_piki WHERE kode_kegiatan = '$piki->kd_kegiatan' "));
	
	echo
	$piki->id."|".
	$piki->judul_piki."|".
	$piki->th_piki."|".
	$piki->kd_kegiatan."|".
	$piki->ak_piki."|".
	$keg->kriteria_piki."|".
	$keg->sub_kriteria_piki."|";
	
}else if($op=='detail_data_pengantar'){
	Connect::getConnection();
	
	$id	= $_GET['id_pengantar'];	
	
	
	$data	= mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_pengantar WHERE id_pengantar = '$id' "));
	
	//jumlah berkas
	$jm_berkas = mysql_num_rows(mysql_query("SELECT no_dupak FROM dt_dupak WHERE id_pengantar= '$id' "));
	
	echo
	$data->id_pengantar."|".
	$data->id_tu."|".
	$data->id_kepsek."|".
	$data->kd_skpd."|".
	$data->no_surat."|".
	$d->balik2($data->tgl_surat)."|".
	$jm_berkas."|";
}else if($op=='detail_polling'){
	Connect::getConnection();
	
	/** STATUS POLLING   **/
	$polling = mysql_fetch_object(mysql_query("SELECT value FROM tb_pengaturan WHERE setting='polling' "));
	if ( $polling->value=='1'){
		$status_polling = "Aktif";
	}else{
		$status_polling = "Tidak Aktif";
	}
	
	/** DATA POLLING **/
	$jm = mysql_num_rows(mysql_query("SELECT id FROM dt_dupak_pengguna WHERE status='1'"));
	$jm_pengguna = $jm-1;
	
	/** DATA RESPONDER **/
	$responder = mysql_num_rows(mysql_query("SELECT id FROM dt_polling"));
	$puas = mysql_num_rows(mysql_query("SELECT id FROM dt_polling WHERE nilai='puas'"));
	$kurang = mysql_num_rows(mysql_query("SELECT id FROM dt_polling WHERE nilai='kurang_puas' "));

	/** PERSENTASE RESPONDER **/
	if ( $responder != 0){
		$p_puas = number_format((( $puas / $responder )*100),1);
		$p_kurang = number_format((( $kurang / $responder )*100),1);
		
		/**  PROGRESS POLLING **/
		$progress =( $responder/$jm_pengguna )*100;
		
	}else{
		$p_puas = 0;
		$p_kurang = 0;
		
		/**  PROGRESS POLLING **/
		$progress =0;
		
	}
	
	
	
	echo
	$status_polling."|".
	$status_polling."|".
	$jm_pengguna."|".
	$responder."|".
	$puas."|".
	$kurang."|".
	$p_puas."|".
	$p_kurang."|".
	$progress."|";
	
}else if($op=='detail_web_status'){
	Connect::getConnection();
	
	/** STATUS WEB   **/
	$ws = mysql_fetch_object(mysql_query("SELECT value FROM tb_pengaturan WHERE setting='web_status' "));
	echo $ws->value;
}else if($op=='cari_masa_penilaian'){
	Connect::getConnection();
	
	$id_pegawai	= $_GET['id_pegawai'];	
	
	/** STATUS WEB   **/
	$ws = @mysql_query(" SELECT 	a.tgl_sampai

													FROM dt_dupak a 
													
													WHERE a.id_pegawai = '$id_pegawai' ");
													
	


	
	if ( mysql_num_rows($ws) != null ){
		$data = mysql_fetch_object($ws);
		
		$end_date = $data->tgl_sampai;
		
		//menenutukan masa penlaian berikutnya dari tgl terkhair
		$date_mulai = date("Y-m-d" , strtotime("+1 day" , strtotime($end_date) ));
		
		$x = date("Y-m-d" , strtotime("+1 year" , strtotime($date_mulai) ));
		
		
		$date_akhir = date("Y-m-d" , strtotime("-1 day" , strtotime($x) ));

		echo $d->tgl_form($end_date).'|'.$d->tgl_form($date_mulai).'|'.$d->tgl_form($date_akhir);
		
		
		
		
	}else{
		echo ' | | ' ;
	}
}
?>



