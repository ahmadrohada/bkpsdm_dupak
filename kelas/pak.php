<?php
session_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 				= New FormatTanggal();


//$kd_skpd 		= isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
//$nama_user	 	= isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';
$id_user		 	= isset($_SESSION['id_pegawai']) ? $_SESSION['id_pegawai'] : '';

$op=isset($_GET['op'])?$_GET['op']:null;


/**  ===================== PROSES EXPORT DUPAK TO PAK db ==============

/// ======================================================================== */




if($op=='detail_pak_baru'){
	//session_start();
	Connect::getConnection();
	$no_dupak				= trim($_GET['no_dupak']);
	$dt_dupak = mysql_fetch_object(mysql_query("SELECT * From dt_dupak WHERE no_dupak = '$no_dupak' "));
	$dt_pegawai= mysql_fetch_object(mysql_query("SELECT * From dt_pegawai WHERE id_pegawai = '$dt_dupak->id_pegawai' "));



	//DATA PRIBADI
	//FOTO
	$ft		= mysql_query("SELECT isi FROM foto WHERE nipbaru='$dt_pegawai->nip_baru' ");
			if ( mysql_num_rows($ft) != 0 ){
			$ft_q 		= mysql_fetch_object($ft);
				$foto =	'<img src="data:image/jpeg;base64,'.base64_encode( $ft_q->isi ).'" class="pas_poto"/>';
			}else{
				$foto = '<img src="images/no_images.jpg" class="pas_poto"/>';
			}
	//NAMA LENGKAP
	if ($dt_dupak->gelar_blk == null )
		{ $koma = ""; } else { $koma = ", ";};
		if ($dt_dupak->gelar_dpn == null )
		{ $titik = ""; } else { $titik = ". ";};

		$nama_lengkap 	= $dt_dupak->gelar_dpn.$titik.ucwords(strtolower($dt_pegawai->nama)).$koma.$dt_dupak->gelar_blk;
	//TTL
		$ttl = $dt_pegawai->tmp_lahir." , ".$d->balik2($dt_pegawai->tgl_lahir);

	//JK
		if ( $dt_pegawai->jk == 2 ) $jk = "Perempuan";
		if ( $dt_pegawai->jk == 1 ) $jk = "Laki-Laki";


	//JENJANG PENDIDKAN
		$kd_pend_usul	= $dt_dupak->kd_pend_usul;
 		$jenjang		= $dt_dupak->pend_usul;
		$jurusan 		= $dt_dupak->jurusan_pend_usul;
		$th_lulus		= $dt_dupak->th_lulus;

	//GOLONGAN
		$kd_golongan 	= mysql_fetch_object(mysql_query("SELECT pangkat,jab_lama_guru,jab_baru_guru FROM kd_golongan WHERE nama_gol='$dt_dupak->nama_gol' "));

		$kd_jenis_guru	= mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru='$dt_dupak->kd_jenis_guru' "));


		$golongan		= $dt_dupak->nama_gol;
		$pangkat		= $kd_golongan->pangkat;
		$tmt_golongan	= $dt_dupak->tmt_gol;
		$jabatan_lama	= $kd_golongan->jab_lama_guru;
		$tmt_jab		= $dt_dupak->tmt_jafung;
		$jabatan_baru	= $kd_golongan->jab_baru_guru;

		$tugas_mengajar	= $kd_jenis_guru->tugas_mengajar;
		$pbm			= $kd_jenis_guru->pbm;
		$jenis_guru		= $kd_jenis_guru->jenis_guru;
		$kd_jenis_guru	= $dt_dupak->kd_jenis_guru;



	//MASA KERJA
		$mk_awal_thn		= $dt_dupak->mk_gol_thn;
		$mk_awal_bln		= $dt_dupak->mk_gol_bln;

		$tgl_sampai			= $dt_dupak->tgl_sampai;
	//********************  PROSES HITUNG MASA KERJA **********************//
	//---------------------------------------------------------------------//

					//pecah tmt_golongan format yyyy-m-d
					$gol = explode("-",$tmt_golongan);
					$th_gol	=	intval($gol[0]);
					$bl_gol	=	intval($gol[1]);
					$hr_gol	=	intval($gol[2]);

					//pecah tmt tgl_selesai
					//pecah tmt_golongan format yyyy-m-d
					$tg_s = explode("-",$tgl_sampai);
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
						$jm_mk_thn	= $sl_th+$mk_awal_thn;
						$jm_mk_bln	= $sl_bl+$mk_awal_bln;

					//jika hasil jm_mk_bln lebih dari 12
					if ( $jm_mk_bln >= 12 ) {
						$jm_mk_bln 	= $jm_mk_bln-12;
						$jm_mk_thn	= $jm_mk_thn+1;
					}

	//---------------------------------------------------------------------//
	//********************  END PROSES HITUNG MASA KERJA ******************//


	//SEKOLAH
	$kd_skpd			= mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE kd_skpd='$dt_dupak->kd_skpd' "));
	$sekolah			= $kd_skpd->sekolah;
	$kd_skpd			= $kd_skpd->kd_skpd;

	//DATA PAK TERAKHIR
		$dt_pak = mysql_query("SELECT no_pak FROM dt_pak WHERE nip_baru='$dt_pegawai->nip_baru' ORDER BY tgl_pak ASC");
		$x = mysql_num_rows($dt_pak);

		if ( $x >= 1 ) {   //JIKA GURU SUDAH PUNYA PAK

			//jika ditemukan data lebih dari 1
			while ($r = mysql_fetch_array($dt_pak)){
					$dpt = $r['no_pak'];
			}


			$hasil = mysql_fetch_object(mysql_query("SELECT no_pak,tgl_pak,tgl_mulai,tgl_sampai,kd_pejabat FROM dt_pak WHERE no_pak='$dpt' "));

			$no_pak_terakhir		= $hasil->no_pak;
			$tgl_pak_terakhir		= $hasil->tgl_pak;
			$pak_terakhir_mulai		= $hasil->tgl_mulai;
			$pak_terakhir_sampai	= $hasil->tgl_sampai;
			$id_pejabat_pak_terakhir= $hasil->kd_pejabat;

			$dt_pejabat	= mysql_fetch_object(mysql_query("SELECT nm_pejabat FROM dt_pejabat WHERE kd_pejabat = '$id_pejabat_pak_terakhir' "));

			$nama_pejabat_pak_terakhir = $dt_pejabat->nm_pejabat;

		}else{
			$no_pak_terakhir		= "-";
			$tgl_pak_terakhir		= "--";
			$pak_terakhir_mulai		= "--";
			$pak_terakhir_sampai	= "--";
			$nama_pejabat_pak_terakhir= "-";
		}


	//ANGKA Kredit PAK LAMA ( ak lama + ak baru padA PAK LAMA)
	if ( $no_pak_terakhir != '-'){
		$dt_pak = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak = '$no_pak_terakhir' "));

		$ak_pend_lama				=	$dt_pak->pend_lama+$dt_pak->pend_baru;
		$ak_diklat_lama				=	$dt_pak->diklat_lama;
		$ak_pbt_lama				=	$dt_pak->pbt_lama+$dt_pak->pbt_baru;
		$ak_pd_lama					=	$dt_pak->pd_lama+$dt_pak->pd_baru;
		$ak_pi_lama					=	$dt_pak->pi_lama+$dt_pak->pi_baru;
		$ak_ki_lama					=	$dt_pak->ki_lama+$dt_pak->ki_baru;
		$ak_sttb_tdksesuai_lama		=	$dt_pak->sttb_tdksesuai_lama+$dt_pak->sttb_tdksesuai_baru;
		$ak_dukung_tugas_lama		=	$dt_pak->dukung_tugas_lama+$dt_pak->dukung_tugas_baru;



	}else{
		$ak_pend_lama				= 0;
		$ak_diklat_lama				= 0;
		$ak_pbt_lama				= 0;
		$ak_pd_lama					= 0;
		$ak_pi_lama					= 0;
		$ak_ki_lama					= 0;
		$ak_sttb_tdksesuai_lama		= 0;
		$ak_dukung_tugas_lama		= 0;

	}


	//ANGKA KREDIT DUPAK
		$ak = mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_ak WHERE no_dupak='$no_dupak' "));
		$f  = mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f WHERE no_dupak='$no_dupak' "));
		$p1 = mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p1' "));
		$p2 = mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_penilai WHERE no_dupak='$no_dupak' and keterangan='p2' "));


	$ak_pend_baru	= ( $ak->ak_01 * $f->f_01 * $p1->p_01 *  $p1->p_01 )
					+ ( $ak->ak_01_1 * $f->f_01_1 * $p1->p_01_1 *  $p2->p_01_1)
					+ ( $ak->ak_02 * $f->f_02 * $p1->p_02 *  $p2->p_02)
					+ ( $ak->ak_02_1 * $f->f_02_1 * $p1->p_02_1 *  $p2->p_02_1)
					+ ( $ak->ak_03 * $f->f_03 * $p1->p_03 *  $p2->p_03)
					+ ( $ak->ak_03_1 * $f->f_03_1 * $p1->p_03_1 *  $p2->p_03_1)
					+ ( $ak->ak_03_2 * $f->f_03_2 * $p1->p_03_2 *  $p2->p_03_2)
					+ ( $ak->ak_03_3 * $f->f_03_3 * $p1->p_03_3 *  $p2->p_03_3)
					+ ( $ak->ak_03_3_1 * $f->f_03_3_1 * $p1->p_03_3_1 *  $p2->p_03_3_1)
					+ ( $ak->ak_03_3_3 * $f->f_03_3_3 * $p1->p_03_3_3 *  $p2->p_03_3_3);

	$ak_diklat_baru = ( $ak->ak_04 * $f->f_04 * $p1->p_04 *  $p1->p_04 );


	$ak_pbt_baru	= ( $ak->ak_05 * $f->f_05 * $p1->p_05 *  $p1->p_05)
					+ ( $ak->ak_06 * $f->f_06 * $p1->p_06 *  $p2->p_06)
					+ ( $ak->ak_07 * $f->f_07 * $p1->p_07 *  $p2->p_07)
					+ ( $ak->ak_08 * $f->f_08 * $p1->p_08 *  $p2->p_08)
					+ ( $ak->ak_09 * $f->f_09 * $p1->p_09 *  $p2->p_09)
					+ ( $ak->ak_10 * $f->f_10 * $p1->p_10 *  $p2->p_10)
					+ ( $ak->ak_11 * $f->f_11 * $p1->p_11 *  $p2->p_11)
					+ ( $ak->ak_12 * $f->f_12 * $p1->p_12 *  $p2->p_12)
					+ ( $ak->ak_13 * $f->f_13 * $p1->p_13 *  $p2->p_13)
					+ ( $ak->ak_14 * $f->f_14 * $p1->p_14 *  $p2->p_14)
					+ ( $ak->ak_15 * $f->f_15 * $p1->p_15 *  $p2->p_15)
					+ ( $ak->ak_16 * $f->f_16 * $p1->p_16 *  $p2->p_16)
					+ ( $ak->ak_17 * $f->f_17 * $p1->p_17 *  $p2->p_17)
					+ ( $ak->ak_18 * $f->f_18 * $p1->p_18 *  $p2->p_18);

	$ak_pd_baru		= ( $ak->ak_19 * $f->f_19 * $p1->p_19 *  $p1->p_19)
					+ ( $ak->ak_20 * $f->f_20 * $p1->p_20 *  $p2->p_20)
					+ ( $ak->ak_21 * $f->f_21 * $p1->p_21 *  $p2->p_21)
					+ ( $ak->ak_22 * $f->f_22 * $p1->p_22 *  $p2->p_22)
					+ ( $ak->ak_23 * $f->f_23 * $p1->p_23 *  $p2->p_23)
					+ ( $ak->ak_24 * $f->f_24 * $p1->p_24 *  $p2->p_24)
					+ ( $ak->ak_25 * $f->f_25 * $p1->p_25 *  $p2->p_25)
					+ ( $ak->ak_26 * $f->f_26 * $p1->p_26 *  $p2->p_26)
					+ ( $ak->ak_27 * $f->f_27 * $p1->p_27 *  $p2->p_27)
					+ ( $ak->ak_28 * $f->f_28 * $p1->p_28 *  $p2->p_28);

	$ak_pi_baru		= ( $ak->ak_29 * $f->f_29 * $p1->p_29 *  $p1->p_29)
					+ ( $ak->ak_30 * $f->f_30 * $p1->p_30 *  $p2->p_30)
					+ ( $ak->ak_31 * $f->f_31 * $p1->p_31 *  $p2->p_31)
					+ ( $ak->ak_32 * $f->f_32 * $p1->p_32 *  $p2->p_32)
					+ ( $ak->ak_33 * $f->f_33 * $p1->p_33 *  $p2->p_33)
					+ ( $ak->ak_34 * $f->f_34 * $p1->p_34 *  $p2->p_34)
					+ ( $ak->ak_35 * $f->f_35 * $p1->p_35 *  $p2->p_35)
					+ ( $ak->ak_36 * $f->f_36 * $p1->p_36 *  $p2->p_36)
					+ ( $ak->ak_37 * $f->f_37 * $p1->p_37 *  $p2->p_37)
					+ ( $ak->ak_38 * $f->f_38 * $p1->p_38 *  $p2->p_38)
					+ ( $ak->ak_39 * $f->f_39 * $p1->p_39 *  $p2->p_39)
					+ ( $ak->ak_40 * $f->f_40 * $p1->p_40 *  $p2->p_40)
					+ ( $ak->ak_41 * $f->f_41 * $p1->p_41 *  $p2->p_41)
					+ ( $ak->ak_42 * $f->f_42 * $p1->p_42 *  $p2->p_42)
					+ ( $ak->ak_43 * $f->f_43 * $p1->p_43 *  $p2->p_43)
					+ ( $ak->ak_44 * $f->f_44 * $p1->p_44 *  $p2->p_44)
					+ ( $ak->ak_45 * $f->f_45 * $p1->p_45 *  $p2->p_45)
					+ ( $ak->ak_46 * $f->f_46 * $p1->p_46 *  $p2->p_46)
					+ ( $ak->ak_47 * $f->f_47 * $p1->p_47 *  $p2->p_47)
					+ ( $ak->ak_48 * $f->f_48 * $p1->p_48 *  $p2->p_48)
					+ ( $ak->ak_49 * $f->f_49 * $p1->p_49 *  $p2->p_49)
					+ ( $ak->ak_50 * $f->f_50 * $p1->p_50 *  $p2->p_50);

		$ak_ki_baru	= ( $ak->ak_51 * $f->f_51 * $p1->p_51 *  $p2->p_51)
					+ ( $ak->ak_52 * $f->f_52 * $p1->p_52 *  $p2->p_52)
					+ ( $ak->ak_53 * $f->f_53 * $p1->p_53 *  $p2->p_53)
					+ ( $ak->ak_54 * $f->f_54 * $p1->p_54 *  $p2->p_54)
					+ ( $ak->ak_55 * $f->f_55 * $p1->p_55 *  $p2->p_55)
					+ ( $ak->ak_56 * $f->f_56 * $p1->p_56 *  $p2->p_56)
					+ ( $ak->ak_57 * $f->f_57 * $p1->p_57 *  $p2->p_57)
					+ ( $ak->ak_58 * $f->f_58 * $p1->p_58 *  $p2->p_58)
					+ ( $ak->ak_59 * $f->f_59 * $p1->p_59 *  $p2->p_59)
					+ ( $ak->ak_60 * $f->f_60 * $p1->p_60 *  $p2->p_60)
					+ ( $ak->ak_61 * $f->f_61 * $p1->p_61 *  $p2->p_61)
					+ ( $ak->ak_62 * $f->f_62 * $p1->p_62 *  $p2->p_62)
					+ ( $ak->ak_63 * $f->f_63 * $p1->p_63 *  $p2->p_63);

		$ak_sttb_tdksesuai_baru	= 	( $ak->ak_64 * $f->f_64 * $p1->p_64 *  $p2->p_64)
								  + ( $ak->ak_65 * $f->f_65 * $p1->p_65 *  $p2->p_65)
								  + ( $ak->ak_66 * $f->f_66 * $p1->p_66 *  $p2->p_66);


		$ak_dukung_tugas_baru	= ( $ak->ak_67 * $f->f_67 * $p1->p_67 *  $p2->p_67)
								+ ( $ak->ak_68 * $f->f_68 * $p1->p_68 *  $p2->p_68)
								+ ( $ak->ak_69 * $f->f_69 * $p1->p_69 *  $p2->p_69)
								+ ( $ak->ak_70 * $f->f_70 * $p1->p_70 *  $p2->p_70)
								+ ( $ak->ak_71 * $f->f_71 * $p1->p_71 *  $p2->p_71)
								+ ( $ak->ak_72 * $f->f_72 * $p1->p_72 *  $p2->p_72)
								+ ( $ak->ak_73 * $f->f_73 * $p1->p_73 *  $p2->p_73)
								+ ( $ak->ak_74 * $f->f_74 * $p1->p_74 *  $p2->p_74)
								+ ( $ak->ak_75 * $f->f_75 * $p1->p_75 *  $p2->p_75)
								+ ( $ak->ak_76 * $f->f_76 * $p1->p_76 *  $p2->p_76)
								+ ( $ak->ak_77 * $f->f_77 * $p1->p_77 *  $p2->p_77)
								+ ( $ak->ak_78 * $f->f_78 * $p1->p_78 *  $p2->p_78)
								+ ( $ak->ak_79 * $f->f_79 * $p1->p_79 *  $p2->p_79);



		//TOTAL AK lama + baru
		$ak_pend_total				= number_format($ak_pend_lama+$ak_pend_baru,3);
		$ak_diklat_total			= number_format($ak_diklat_lama+$ak_diklat_baru,3);
		$ak_pbt_total				= number_format($ak_pbt_lama+$ak_pbt_baru,3);
		$ak_pd_total				= number_format($ak_pd_lama+$ak_pd_baru,3);
		$ak_pi_total				= number_format($ak_pi_lama+$ak_pi_baru,3);
		$ak_ki_total				= number_format($ak_ki_lama+$ak_ki_baru,3);
		$ak_sttb_tdksesuai_total	= number_format($ak_sttb_tdksesuai_lama+$ak_sttb_tdksesuai_baru,3);
		$ak_dukung_tugas_total		= number_format($ak_dukung_tugas_lama+$ak_dukung_tugas_baru,3);



	// [0] Foto
	echo 	$foto."|".
			$dt_pegawai->nip_baru."|".
			$nama_lengkap."|".
			$ttl."|".
			$jk."|".
			$kd_pend_usul."|".
			$jenjang."|".
			$jurusan."|".
			$th_lulus."|".
			$golongan."|".
			$pangkat."|".
			$d->tgl_form($tmt_golongan)."|".
			$jabatan_lama."|".
			$d->tgl_form($tmt_jab)."|".
			$jabatan_baru."|".

			$tugas_mengajar."|".
			$pbm."|".
			$jenis_guru."|".

			$mk_awal_thn."|".
			$mk_awal_bln."|".
			$jm_mk_thn."|".
			$jm_mk_bln."|".

			$kd_skpd."|".
			$sekolah."|".

			$no_pak_terakhir."|".
			$d->tgl_form($tgl_pak_terakhir)."|".
			$d->tgl_form($pak_terakhir_mulai)."|".
			$d->tgl_form($pak_terakhir_sampai)."|".
			$nama_pejabat_pak_terakhir."|".


			//29
			number_format($ak_pend_lama,3)."|".
			number_format($ak_diklat_lama,3)."|".
			number_format($ak_pbt_lama,3)."|".
			number_format($ak_pd_lama,3)."|".
			number_format($ak_pi_lama,3)."|".
			number_format($ak_ki_lama,3)."|".
			number_format($ak_pend_lama+$ak_diklat_lama+$ak_pbt_lama+$ak_pd_lama+$ak_pi_lama+$ak_ki_lama,3)."|".
			number_format($ak_sttb_tdksesuai_lama,3)."|".
			number_format($ak_dukung_tugas_lama,3)."|".
			number_format($ak_sttb_tdksesuai_lama+$ak_dukung_tugas_lama,3)."|".
			number_format($ak_pend_lama+$ak_diklat_lama+$ak_pbt_lama+$ak_pd_lama+$ak_pi_lama+$ak_ki_lama+$ak_sttb_tdksesuai_lama+$ak_dukung_tugas_lama,3)."|".

			number_format($ak_pend_baru,3)."|".
			number_format($ak_diklat_baru,3)."|".
			number_format($ak_pbt_baru,3)."|".
			number_format($ak_pd_baru,3)."|".
			number_format($ak_pi_baru,3)."|".
			number_format($ak_ki_baru,3)."|".
			number_format($ak_pend_baru+$ak_diklat_baru+$ak_pbt_baru+$ak_pd_baru+$ak_pi_baru+$ak_ki_baru,3)."|".
			number_format($ak_sttb_tdksesuai_baru,3)."|".
			number_format($ak_dukung_tugas_baru,3)."|".
			number_format($ak_sttb_tdksesuai_baru+$ak_dukung_tugas_baru,3)."|".
			number_format($ak_pend_baru+$ak_diklat_baru+$ak_pbt_baru+$ak_pd_baru+$ak_pi_baru+$ak_ki_baru+$ak_sttb_tdksesuai_baru+$ak_dukung_tugas_baru,3)."|".

			$ak_pend_total."|".
			$ak_diklat_total."|".
			$ak_pbt_total."|".
			$ak_pd_total."|".
			$ak_pi_total."|".
			$ak_ki_total."|".
			number_format($ak_pend_lama+$ak_diklat_lama+$ak_pbt_lama+$ak_pd_lama+$ak_pi_lama+$ak_ki_lama+$ak_pend_baru+$ak_diklat_baru+$ak_pbt_baru+$ak_pd_baru+$ak_pi_baru+$ak_ki_baru,3)."|".
			$ak_sttb_tdksesuai_total."|".
			$ak_dukung_tugas_total."|".
			number_format($ak_sttb_tdksesuai_lama+$ak_dukung_tugas_lama+$ak_sttb_tdksesuai_baru+$ak_dukung_tugas_baru,3)."|".
			number_format($ak_pend_lama+$ak_diklat_lama+$ak_pbt_lama+$ak_pd_lama+$ak_pi_lama+$ak_ki_lama+$ak_sttb_tdksesuai_lama+$ak_dukung_tugas_lama+$ak_pend_baru+$ak_diklat_baru+$ak_pbt_baru+$ak_pd_baru+$ak_pi_baru+$ak_ki_baru+$ak_sttb_tdksesuai_baru+$ak_dukung_tugas_baru,3)."|".

			//INFO PAK BARU
			$no_dupak."|".
			$d->tgl_form($dt_dupak->tgl_dupak)."|".
			$d->tgl_form($dt_dupak->tgl_mulai)."|".
			$d->tgl_form($dt_dupak->tgl_sampai)."|".
			$kd_jenis_guru."|".
			$dt_dupak->gelar_dpn."|".
			$dt_dupak->gelar_blk."|".
			$dt_dupak->kd_pend_usul."|".
			$dt_dupak->id_pegawai."|";

}else if($op=='rekomendasi'){
	Connect::getConnection();
	$nip_baru		= $_GET['nip_baru'];
	$nama_gol		= $_GET['nama_gol'];
	$tgl_pak_lama	= $_GET['tgl_pak_lama'];
	$ak_capaian_kom	= $_GET['ak_capaian_kom'];
	$ak_pd_baru		= $_GET['ak_pd_baru'];
	$ak_pi_baru		= $_GET['ak_pi_baru'];
	$ak_ki_baru		= $_GET['ak_ki_baru'];


	// Cari AK Naik,AK pd dan ak piki pada Gol tersebut
	$kd_golongan = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$nama_gol' "));

	//makalah,artikel dan buku
	if ( $kd_golongan->makalah_hasil_penelitian == "TRUE" ){
		$makalah_min = "Wajib";
	}else{
		$makalah_min = "Tidak Wajib";
	}

	if ( $kd_golongan->artikel_di_jurnal == "TRUE" ){
		$artikel_min = "Wajib";
	}else{
		$artikel_min = "Tidak Wajib";
	}

	if ( $kd_golongan->buku_pelajaran == "TRUE" ){
		$buku_min = "Wajib";
	}else{
		$buku_min = "Tidak Wajib";
	}


	//Cari data Pak dengan nip ini dan nama gol ini pada tabel pak dan pak_guru_gol
	// kemudian urutan secara ASc berdasarkan tgl pak
	$pak_gol = mysql_query("SELECT dt_pak.tgl_pak,dt_pak.no_pak FROM tb_pak_guru_gol,dt_pak WHERE dt_pak.nip_baru='$nip_baru' and tb_pak_guru_gol.nama_gol='$nama_gol' and dt_pak.no_pak=tb_pak_guru_gol.no_pak and SUBSTRING_INDEX(SUBSTRING_INDEX(dt_pak.no_pak,'/',3),'/',-1) = 'TP.GURU' ORDER BY dt_pak.tgl_pak ASC");
	//echo $no_pak."|";


	//inisialisasi
	$ak_pd_capaian 		= number_format($ak_pd_baru,3);
	$ak_piki_capaian 	= number_format($ak_pi_baru+$ak_ki_baru,3);
	$makalah			= 0;
	$buku				= 0;
	$artikel			= 0;

	while ($r = mysql_fetch_array($pak_gol)){
		if (  strtotime($r['tgl_pak']) <= strtotime($tgl_pak_lama) ) {
			//echo $index_x."*";
			//cari nilai pd
			$data4 = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$r[no_pak]' "));
			$ak_pd_capaian = $ak_pd_capaian+$data4->pd_baru+$data4->diklat_lama84+$data4->diklat_baru84;
			$ak_piki_capaian = $ak_piki_capaian+($data4->pi_baru+$data4->ki_baru);

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

	//CAPAIAN PIKI
	if ( $makalah >=1 ){
		$makalah_capaian	= true;
		$makalah_kesimpulan	= "Terpenuhi";
	}else{
		$makalah_capaian	= false;
		$makalah_kesimpulan	= "Belum Terpenuhi";
	}


	if ( $artikel >=1 ){
		$artikel_capaian	= true;
		$artikel_kesimpulan	= "Terpenuhi";
	}else{
		$artikel_capaian	= false;
		$artikel_kesimpulan	= "Belum Terpenuhi";
	}

		if ( $buku >=1 ){
		$buku_capaian	= true;
		$buku_kesimpulan	= "Terpenuhi";
	}else{
		$buku_capaian	= false;
		$buku_kesimpulan	= "Belum Terpenuhi";
	}



		$kom_min			= number_format($kd_golongan->ak_naik,3);
		$kom_capaian		= $ak_capaian_kom;
	if ( $kom_capaian >= $kom_min ) {
		$kom_kesimpulan		= "Terpenuhi";
	}else{
		$kom_kesimpulan		= "Belum Terpenuhi";
	}

		$pd_min				= number_format($kd_golongan->ak_pd,3);
		$pd_capaian			= number_format($ak_pd_capaian,3);
	if ($pd_capaian >= $pd_min ) {
		$pd_kesimpulan		= "Terpenuhi";
	}else{
		$pd_kesimpulan		= "Belum Terpenuhi";
	}

		$piki_min			= number_format($kd_golongan->ak_piki,3);
		$piki_capaian		= number_format($ak_piki_capaian,3);
	if ($piki_capaian >= $piki_min ) {
		$piki_kesimpulan		= "Terpenuhi";
	}else{
		$piki_kesimpulan		= "Belum Terpenuhi";
	}






	echo
		$nama_gol."|".
		$kom_min."|".
		$kom_capaian."|".
		$kom_kesimpulan."|".

		$pd_min."|".
		$pd_capaian."|".
		$pd_kesimpulan."|".

		$piki_min."|".
		$piki_capaian."|".
		$piki_kesimpulan."|".

		$makalah_min."|".
		$makalah_capaian."|".
		$makalah_kesimpulan."|".

		$artikel_min."|".
		$artikel_capaian."|".
		$artikel_kesimpulan."|".

		$buku_min."|".
		$buku_capaian."|".
		$buku_kesimpulan."|";






}else if($op=='rekomendasi_dupak'){
	Connect::getConnection();
	$nip_baru		= $_GET['nip_baru'];
	$nama_gol		= $_GET['nama_gol'];
	$tgl_pak_lama	= $_GET['tgl_pak_lama'];
	$ak_capaian_kom	= $_GET['ak_capaian_kom'];
	$ak_pd_baru		= $_GET['ak_pd_baru'];
	$ak_pi_baru		= $_GET['ak_pi_baru'];
	$ak_ki_baru		= $_GET['ak_ki_baru'];

	$no_dupak		= $_GET['no_dupak'];

	// Cari AK Naik,AK pd dan ak piki pada Gol tersebut
	$kd_golongan = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$nama_gol' "));

	//makalah,artikel dan buku
	if ( $kd_golongan->makalah_hasil_penelitian == "TRUE" ){
		$makalah_min = "Wajib";
	}else{
		$makalah_min = "Tidak Wajib";
	}

	if ( $kd_golongan->artikel_di_jurnal == "TRUE" ){
		$artikel_min = "Wajib";
	}else{
		$artikel_min = "Tidak Wajib";
	}

	if ( $kd_golongan->buku_pelajaran == "TRUE" ){
		$buku_min = "Wajib";
	}else{
		$buku_min = "Tidak Wajib";
	}


	//Cari data Pak dengan nip ini dan nama gol ini pada tabel pak dan pak_guru_gol
	// kemudian urutan secara ASc berdasarkan tgl pak
	$pak_gol = mysql_query("SELECT dt_pak.tgl_pak,dt_pak.no_pak FROM tb_pak_guru_gol,dt_pak WHERE dt_pak.nip_baru='$nip_baru' and tb_pak_guru_gol.nama_gol='$nama_gol' and dt_pak.no_pak=tb_pak_guru_gol.no_pak and SUBSTRING_INDEX(SUBSTRING_INDEX(dt_pak.no_pak,'/',3),'/',-1) = 'TP.GURU' ORDER BY dt_pak.tgl_pak ASC");
	//echo $no_pak."|";


	//inisialisasi
	$ak_pd_capaian 		= number_format($ak_pd_baru,3);
	$ak_piki_capaian 	= number_format($ak_pi_baru+$ak_ki_baru,3);
	$makalah			= 0;
	$buku				= 0;
	$artikel			= 0;

	//cari data piki pada dupak pengajuan bila gol nya sama
	$dupak_gol	= mysql_fetch_object(mysql_query("SELECT nama_gol FROM dt_dupak WHERE no_dupak='$no_dupak' "));
	
	if ( $dupak_gol->nama_gol == $nama_gol) {  //golongan dupak dan pak sama
		//cari data piki nya
		$cek = mysql_num_rows(mysql_query("SELECT id FROM dt_dupak_piki WHERE no_dupak='$no_dupak' "));
		//jika data ada
		if ( $cek >= 1 ){
			$dupak_piki = mysql_query("SELECT kd_kegiatan FROM dt_dupak_piki WHERE no_dupak='$no_dupak' and keterangan='diterima'  ");
			
			//lakukan scaning piki_piki
			while ($r = mysql_fetch_array($dupak_piki)){
				//makalah artikel dan buku
			
				switch($r['kd_kegiatan'])
					{
				case 29 : $artikel=$artikel+1;
						break;
				case 30 : $artikel=$artikel+1;
						break;
				case 31 : $artikel=$artikel+1;
						break;
				case 32 : $artikel=$artikel+1;
						break;
				case 33 : $artikel=$artikel+1;
						break;
				case 34 : $artikel=$artikel+1;
						break;
				case 35 : $makalah=$makalah+1;
						break;
				case 36 : $makalah=$makalah+1;
						break;
				case 37 : $makalah=$makalah+1;
						break;
				case 38 : $makalah=$makalah+1;
						break;
				case 39 : $makalah=$makalah+1;
						break;
				case 40 : $makalah=$makalah+1;
						break;
				case 41 : $makalah=$makalah+1;
						break;
				case 42 : $buku=$buku+1;
						break;
				case 43 : $buku=$buku+1;
						break;
				case 44 : $buku=$buku+1;
						break;
				case 45 : $buku=$buku+1;
						break;
				case 46 : $buku=$buku+1;
						break;
				case 47 : $buku=$buku+1;
						break;
				case 48 : $buku=$buku+1;
						break;
				case 49 : $buku=$buku+1;
						break;
				case 50 : $buku=$buku+1;
						break;
				case 51 : $buku=$buku+1;
						break;
				}
				
				
			}
			
			
		}
	}
	
	while ($r = mysql_fetch_array($pak_gol)){
		if (  strtotime($r['tgl_pak']) <= strtotime($tgl_pak_lama) ) {
			//echo $index_x."*";
			//cari nilai pd
			$data4 = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$r[no_pak]' "));
			$ak_pd_capaian = $ak_pd_capaian+$data4->pd_baru+$data4->diklat_lama84+$data4->diklat_baru84;
			$ak_piki_capaian = $ak_piki_capaian+($data4->pi_baru+$data4->ki_baru);

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

	//CAPAIAN PIKI
	if ( $makalah >=1 ){
		$makalah_capaian	= true;
		$makalah_kesimpulan	= "Terpenuhi";
	}else{
		$makalah_capaian	= false;
		$makalah_kesimpulan	= "Belum Terpenuhi";
	}


	if ( $artikel >=1 ){
		$artikel_capaian	= true;
		$artikel_kesimpulan	= "Terpenuhi";
	}else{
		$artikel_capaian	= false;
		$artikel_kesimpulan	= "Belum Terpenuhi";
	}

		if ( $buku >=1 ){
		$buku_capaian	= true;
		$buku_kesimpulan	= "Terpenuhi";
	}else{
		$buku_capaian	= false;
		$buku_kesimpulan	= "Belum Terpenuhi";
	}



		$kom_min			= number_format($kd_golongan->ak_naik,3);
		$kom_capaian		= $ak_capaian_kom;
	if ( $kom_capaian >= $kom_min ) {
		$kom_kesimpulan		= "Terpenuhi";
	}else{
		$kom_kesimpulan		= "Belum Terpenuhi";
	}

		$pd_min				= number_format($kd_golongan->ak_pd,3);
		$pd_capaian			= number_format($ak_pd_capaian,3);
	if ($pd_capaian >= $pd_min ) {
		$pd_kesimpulan		= "Terpenuhi";
	}else{
		$pd_kesimpulan		= "Belum Terpenuhi";
	}

		$piki_min			= number_format($kd_golongan->ak_piki,3);
		$piki_capaian		= number_format($ak_piki_capaian,3);
	if ($piki_capaian >= $piki_min ) {
		$piki_kesimpulan		= "Terpenuhi";
	}else{
		$piki_kesimpulan		= "Belum Terpenuhi";
	}






	echo
		$nama_gol."|".
		$kom_min."|".
		$kom_capaian."|".
		$kom_kesimpulan."|".

		$pd_min."|".
		$pd_capaian."|".
		$pd_kesimpulan."|".

		$piki_min."|".
		$piki_capaian."|".
		$piki_kesimpulan."|".

		$makalah_min."|".
		$makalah_capaian."|".
		$makalah_kesimpulan."|".

		$artikel_min."|".
		$artikel_capaian."|".
		$artikel_kesimpulan."|".

		$buku_min."|".
		$buku_capaian."|".
		$buku_kesimpulan."|";






}else if($op=='ekspor_dupak'){
	
	
	//session_start();
	Connect::getConnection();
	$no_dupak				= $_GET['ao'];
	$no_pak_terakhir		= trim($_GET['c']);

	//ARIKEL MAKALH BUKU
	
	if ( $_GET['w'] == "Terpenuhi" ) {
		$makalah	= "TRUE";
	}else{
		$makalah	= "FALSE";
	}
	
	if ( $_GET['x'] == "Terpenuhi" ) {
		$artikel	= "TRUE";
	}else{
		$artikel	= "FALSE";
	}
	if ( $_GET['y'] == "Terpenuhi" ) {
		$buku	= "TRUE";
	}else{
		$buku	= "FALSE";
	}
	
	
	/** ********************************************************************************** //
	// -----------------   JKA PEND baru nilai na ada,,end usul d acc     ----------------//
	/** ================================================================================= */
	
	if ( ( ($_GET['o']=='0.000') && ($_GET['u']=='0.000') ) || ( $_GET['ak'] == '' ) ){ // pendidikan usulan tidak di acc
	
	
		//JIKA pAK TERAKHIRNYA ADA
		if ( $no_pak_terakhir != '-'){
			$pend  = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak ='$no_pak_terakhir' "));
		
			$gelar_dpn			= $pend->gelar_dpn;
			$gelar_blk			= $pend->gelar_blk;
			$kd_pend_usul		= $pend->kd_pend_usul;
			$jurusan_pend_usul	= $pend->jurusan_pend_usul;
			$th_pend_usul		= $pend->th_pend_usul;
		}else{
			$peg  = mysql_fetch_object(mysql_query("SELECT * FROM d_pegawai WHERE id_pegawai ='$_GET[a]' "));
			
			$gelar_dpn			= $peg->gelar_dpn;
			$gelar_blk			= $peg->gelar_blk;
			$kd_pend_usul		= '';
			$jurusan_pend_usul	= $peg->jurusan;
			$th_pend_usul		= $peg->tahun_lulus_pendidikan;
			
		}
		
		
		
		
	}else{
		$gelar_dpn			= $_GET['ai'];
		$gelar_blk			= $_GET['aj'];
		//$kd_pend_usul		= 
		$jurusan_pend_usul	= $_GET['al'];
		$th_pend_usul		= $_GET['am'];
		
		//KD pendidikan USULdari dupak ke PAK
		switch($_GET['ak'])
					{
				case '01' 	: $kd_pend_usul='17';
					break;
				case '01_1' : $kd_pend_usul='17';
					break;
				case '02' 	: $kd_pend_usul='16';
					break;
				case '02_1' 	: $kd_pend_usul='16';
					break;
				case '03' 	: $kd_pend_usul='12';
					break;
				case '03_1'	: $kd_pend_usul='12';
					break;
				case '03_2' 	: $kd_pend_usul='12';
					break;
				case '03_3' 	: $kd_pend_usul='12';
					break;
				case '03_3_2' : $kd_pend_usul='11';
					break;
				case '03_3_3' : $kd_pend_usul='11';
					break;
				case '66' 	: $kd_pend_usul='12';
					break;
				case '65' 	: $kd_pend_usul='16';
					break;
				case '64' 	: $kd_pend_usul='17';
						break;
					}
		
	}
	
	
	//echo $no_pak_terakhir;
	/** ********************************************************************************** //
	// -------------------- PROSES GENERATE NO PAK ---------------------------------//
	/** ================================================================================= */

		$pch_thn		= explode("-",$_GET['d']);
		$th				= $pch_thn[2];



		//cari index terakhir SUBSTRING_INDEX(tgl_entry,'-',1)

		$cek = mysql_query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',2),'/',-1) as no FROM dt_pak WHERE  SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and YEAR(tgl_pak)= '$th' ORDER BY SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',2),'/',-1) DESC LIMIT 1");
		//$cek = mysql_query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',2),'/',-1) as no FROM dt_pak WHERE  SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',3),'/',-1) = 'TP.GURU' and year(tgl_pak) = '$th' ORDER BY TRIM(LEADING '0' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(no_pak,'/',2),'/',-1)) DESC LIMIT 1");

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
		// NO PAK AJUAN
		$no_pak_ajuan = '800/'.$no.'/TP.GURU/PAK/'.$th;
	
	/** ********************************************************************************** //
	// -----------------   PENGECEKAN NO PAK PADA DATABASE      ---------------------------//
	/** ================================================================================= */
	
	$cek1 = mysql_num_rows(mysql_query("SELECT no_pak FROM dt_pak WHERE no_pak = '$no_pak_ajuan' "));
	$cek2 = mysql_num_rows(mysql_query("SELECT no_pak FROM tb_pak_guru_gol WHERE no_pak = '$no_pak_ajuan' "));
	$cek3 = mysql_num_rows(mysql_query("SELECT no_pak FROM tb_pak_guru_pend WHERE no_pak = '$no_pak_ajuan' "));
	//echo $cek1."|".$cek2."|".$cek3;
	$hasil = $cek1.$cek2.$cek3;
	
	if ( $hasil == '000'){
		
		
		//INPUT DATA KE TABEL PAK
		$x= array(
			'no_pak'				=> $no_pak_ajuan,
			'id_pegawai'			=> $_GET['a'],
			'nip_baru'				=> $_GET['b'],
			'no_pak_lama'			=> $_GET['c'],
			'tgl_pak'				=> $d->tgl_sql($_GET['d']),
			'tgl_mulai'				=> $d->tgl_sql($_GET['e']),
			'tgl_sampai'			=> $d->tgl_sql($_GET['f']),
			
			'pend_lama'				=> $_GET['g'],
			'diklat_lama'			=> $_GET['h'],
			'pbt_lama'				=> $_GET['i'],
			'pd_lama'				=> $_GET['j'],
			'pi_lama'				=> $_GET['k'],
			'ki_lama'				=> $_GET['l'],
			'sttb_tdksesuai_lama'	=> $_GET['m'],
			'dukung_tugas_lama'		=> $_GET['n'],
			
			'pend_baru'				=> $_GET['o'],
			'diklat_baru'			=> $_GET['p'],
			'pbt_baru'				=> $_GET['q'],
			'pd_baru'				=> $_GET['r'],
			'pi_baru'				=> $_GET['s'],
			'ki_baru'				=> $_GET['t'],
			'sttb_tdksesuai_baru'	=> $_GET['u'],
			'dukung_tugas_baru'		=> $_GET['v'],
			
			'makalah'				=> $makalah,
			'artikel'				=> $artikel,
			'buku'					=> $buku,
		
			'kd_rekom'				=> $_GET['z'],
			'kd_pejabat'			=> $_GET['aa'],
			
			'id_user'				=> $_SESSION['id_user']
		);
		$pak = New KelolaDataPak();
		$q1 = $pak->TambahDataPak('dt_pak',$x);
		//echo $q1;
		//JIKA INPUT KE TABEL PAK BERHASIL, MAKA LANJUTKAN KE PAK GOL dan PAK PEND
		if ( $q1 == 'sukses' ){
		
			//input ke tabel pak gol
			$y= array(
				'nip_baru'				=> $_GET['b'],
				'no_pak'				=> $no_pak_ajuan,
				'nama_gol'				=> $_GET['ac'],
				'tmt_gol'				=> $d->tgl_sql($_GET['ad']),
				'kd_jenis_guru'			=> $_GET['af'],
				'tmt_jafung'			=> $d->tgl_sql($_GET['ae']),
				'mk_gol_thn'			=> $_GET['ag'],
				'mk_gol_bln'			=> $_GET['ah']
			);
			$pak->TambahDataPak('tb_pak_guru_gol',$y);
				
			//input ke tabel pak pend
			$z= array(

				'no_pak'				=> $no_pak_ajuan,
				'nip_baru'				=> $_GET['b'],
				'gelar_dpn'				=> $gelar_dpn,
				'gelar_blk'				=> $gelar_blk,
				
				'kd_pend_usul'			=> $kd_pend_usul,
				'jurusan_pend_usul'		=> $jurusan_pend_usul,
				'th_pend_usul'			=>$th_pend_usul,
				'kd_skpd'				=> $_GET['an']
			);
			$pak->TambahDataPak('tb_pak_guru_pend',$z);

			
			Connect::getConnection();
			
			/** ********************************************************************************** //
			// -----------------   COPY pIKI DUPAK KE PAK              ---------------------------//
			/** ================================================================================= */
			$query  = mysql_query("SELECT * FROM dt_dupak_piki WHERE no_dupak='$no_dupak' ");
			//echo  mysql_num_rows($query);
			if ( mysql_num_rows($query) != 0 ) {
				while ($r = mysql_fetch_array($query)){
						//input hasil query ke tabel piki PAK
						//cari dulukriteria PIKI nya,.. 
						$kd_kegiatan = $r['kd_kegiatan'];
						$piki = mysql_fetch_object(mysql_query("SELECT kode_alasan,kd_kriteria_piki FROM kd_dupak_kriteria_piki WHERE kode_kegiatan= '$kd_kegiatan' "));
						
						//input ke tabel pak pend
						$data= array(

							'no_pak'				=> $no_pak_ajuan,
						//	'no_piki_tolak1'		=> $_GET['b'],
						//	'tgl_no_piki'			=> $gelar_dpn,
							'nip_piki'				=> $_GET['b'],
							'judul'					=> $r['judul_piki'],
							'thn_pembuatan'			=> $r['th_piki'],
							'kd_kriteria'			=> $piki->kd_kriteria_piki,
							'nilai_ak'				=> $r['ak_piki'],
							'status'				=> ucwords(strtolower($r['keterangan'])),      //enum Ditolak atau Diterima
							'kode_alasan'				=> $piki->kode_alasan
						//	'keterangan'			=>$th_pend_usul
						);
						$piki = New KelolaDataPiki();
						$q3 = $piki->TambahDataPiki('dt_piki',$data);
						echo $q3;
						
				
				}
			}
			
			
			
			/** ********************************************************************************** //
			// -----------------   UPDATE STEP PENGAJUA DUPAK         ---------------------------//
			/** ================================================================================= */
			$update = mysql_query("UPDATE dt_dupak SET step	='20',status_dupak	= 'level_4' WHERE no_dupak = '$no_dupak' ");
			
		}
			
		
		echo "sukses";
	}else{
		echo "error";
		echo $no_pak_ajuan;
		echo $hasil;
	}
	
	
}
?>