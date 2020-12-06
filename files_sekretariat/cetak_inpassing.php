<?php
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	Connect::getConnection();
	//data  PAK
	$pak = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak'"));
	//data Pegawai
	$dataPeg = mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai WHERE nip_baru='$pak->nip_baru'"));
	$d 		= New FormatTanggal();
	
	//guru Gol
	$dataGol = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak='$no_pak'"));
	
	//pangkat
	$gol = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$dataGol->nama_gol' "));
	
	//pebdidikan
	$dataPd = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak='$no_pak' "));
	$dataPend = mysql_fetch_object(mysql_query("SELECT * FROM kd_pendidikan_usul WHERE kd_pend_usul='$dataPd->kd_pend_usul' "));
	
	//jafung
	//$dataJaf = mysql_fetch_object(mysql_query("SELECT * FROM kd_jafung WHERE kd_jafung='$dataGol->kd_jafung' "));
	
	//skpd
	
	$dataSkpd = mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE kd_skpd='$dataPd->kd_skpd' "));	
	
	//rekom 
	$dataRekom = mysql_fetch_object(mysql_query("SELECT * FROM kd_rekomendasi WHERE kd_rekom='$pak->kd_rekom' "));	
	
	//Jenis_guru
	$jegur = mysql_fetch_object(mysql_query("SELECT * FROM kd_jenis_guru WHERE kd_jenis_guru='$dataGol->kd_jenis_guru' "));

	//pejabat
	$pejabat = mysql_fetch_object(mysql_query("SELECT * FROM dt_pejabat WHERE kd_pejabat='$pak->kd_pejabat' "));
?>

<div id="printable" >

<table class="kop" >
<tr>
	<td rowspan="4" width="130px" align="right" valign="top">
		<img src="gambar/logo-karawang.png" width="120px" height="160px" >
	</td>
	<td align="center" valign="bottom">
		<FONT style="font-size:23pt; font-family:Cambria; letter-spacing:3pt;  ">PEMERINTAH KABUPATEN KARAWANG</FONT>
	</td>
</tr>
<tr>
	<td align="center" height="48px" valign="bottom">
		<FONT style=" font-size:30pt; font-weight:bold; font-family:Cambria; letter-spacing:2pt;  ">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</FONT>
	</td>
</tr>
<tr>
	<td align="center">
		<FONT style=" font-size:12pt;  font-family:verdana,calibri; letter-spacing:1pt;  ">Jl. Surotokunto No. 72 Telp. (0267) 405215 Fax. (0267) 405215</FONT>
	</td>
</tr>
<tr>
	<td align="center" valign="top">
		<FONT style=" font-size:16pt; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:2pt;  ">KARAWANG 41313</FONT>
	</td>
</tr>
<tr>
	<td colspan="2" height="3px" valign="top">
		<hr class="kop_hr">
	</td>
</tr>
</table>

<table class="kop" >
<tr height="34px">
	<td align="center" valign="bottom">
		<B><FONT style="font-size:13pt; font-weight:bold;" COLOR=#000000>PENYESUAIAN PENETAPAN ANGKA KREDIT GURU</FONT></B>
	<td>
</tr>
<tr height="24px">
	<td align="center">
		<B><FONT style="font-size:13pt; font-weight:bold;" COLOR=#000000>BUPATI KARAWANG</FONT></B>
	<td>
</tr>
<tr height="14px">
	<td align="center">
		<FONT style="font-size:13pt; font-weight:normal;" COLOR=#000000>No. <?php echo $pak->no_pak; ?> </FONT>
	<td>
</tr>
</table>
<br>


<table class="tg_cetak" >
<tr height="24px">
	<td>
		<B><FONT style=FONT-SIZE:12pt FACE="Arial Narrow" COLOR=#000000>MASA PENILAIAN : &nbsp;&nbsp;&nbsp;</FONT></B>
		<B><FONT style=FONT-SIZE:12pt FACE="Arial Narrow" COLOR=#000000>
		<?php echo $d->balik2($pak->tgl_mulai); ?>
		&nbsp;&nbsp;s.d&nbsp;&nbsp;
		<?php echo $d->balik2($pak->tgl_sampai); ?>
		<input type="hidden" id="tmt_inpass" value="<?php echo $pak->tmt_pak; ?>">
		</FONT></B>
	</td>
</tr>
</table>

<table class="form_cetak" style="line-height:19pt;">
	<tr>
		<td width="10px" align="center">
			I
		</td>
		<th colspan="8">
			<b>KETERANGAN PERORANGAN</b>
		</th>
	</tr>
	<tr>
		<td rowspan="13">
			
		</td>
		<td colspan="3" width="37%">
			Nama Lengkap
		</td>
		<td colspan="5" class="isi">
			<?php 
			//Mencari Nama Lengkap +gelar depan belakang
			if ($dataPd->gelar_blk == null ) 
			{ $koma = ""; } else { $koma = ", ";};			if ($dataPd->gelar_dpn == null ) 			{ $titik = ""; } else { $titik = ". ";};
	
			echo $dataPd->gelar_dpn.$titik.ucwords(strtolower($dataPeg->nama)).$koma.$dataPd->gelar_blk;

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			NIP
		</td>
		<td colspan="5" class="isi">
			<?php echo $dataPeg->nip_baru;?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Tempat Tanggal Lahir
		</td>
		<td colspan="5" class="isi">
			<?php 
		
			//tempat tanggal lahir
		
			$tl		= $d->balik2($dataPeg->tgl_lahir);
			echo ucwords(strtolower($dataPeg->tmp_lahir)).", ".$tl;
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Jenis Kelamin
		</td>
		<td colspan="5" class="isi">
			<?php
				if ( $dataPeg->jk==1) echo "Laki-laki";
				if ( $dataPeg->jk==2) echo "Perempuan";
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Nama Pendidikan
		</td>
		<td colspan="5" class="isi">
			<?php
			echo $dataPend->nama_pend_usul." / ".$dataPd->jurusan_pend_usul." /  Tahun ".$dataPd->th_pend_usul;
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Pangkat / Golongan.Ruang / TMT
		</td>
		<td colspan="5" class="isi">
			<?php echo $gol->pangkat." / ".$dataGol->nama_gol." / ". $d->balik2($dataGol->tmt_gol);?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Jabatan / TMT
		</td>
		<td colspan="5" class="isi">
			<?php
			echo $gol->jab_lama_guru." / ".$d->balik2($dataGol->tmt_jafung);
			?>
		</td>
	</tr>
	<tr>
		<td rowspan="2" colspan="2">
			Masa Kerja Golongan
		</td>
		<td>
			Lama
		</td>
		<td colspan="5">
			<input  id="mk_awal_thn_cetak" class="field_cetak" style="width:20px" >&nbsp Thn &nbsp;&nbsp;
			<input  id="mk_awal_bln_cetak" class="field_cetak" style="width:20px">&nbsp; Bln 
		</td>
	</tr>
	<tr>
		<td>
			Baru
		</td>
		<td colspan="5">
			<input  id="jm_mk_thn_cetak" class="field_cetak" style="width:20px">&nbsp; Thn &nbsp;&nbsp;
			<input  id="jm_mk_bln_cetak" class="field_cetak" style="width:20px">&nbsp; Bln 
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Jenis Guru
		</td>
		<td colspan="5" class="isi">
			<?php
			echo $jegur->jenis_guru;
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Tugas Mengajar
		</td>
		<td colspan="5" class="isi">
			<?php
				echo $jegur->tugas_mengajar;
			?>
		</td>
	</tr>
		<tr>
		<td colspan="3">
			Sekolah
		</td>
		<td colspan="5" class="isi">
			<?php
			echo $dataSkpd->sekolah;
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			SKPD
		</td>
		<td colspan="5" class="isi">
			<?php
			echo $dataSkpd->skpd;
			?>
		</td>
	</tr>
	<tr height="40px" valign="center" align="center">
		<td>
			II
		</td>
		<th colspan="2">
			PAK No <br>
			<?php echo $pak->no_pak_lama; ?>
		</th>
		<th width="75px">
			Lama
		</th>
		<th th width="75px">
			Baru
		</th>
		<th th width="75px">
			Jumlah
		</th>
		<th colspan="2" >
			Penyesuaian PAK no
			<br>
			<?php echo $pak->no_pak_lama; ?>
		</th>
		<th th width="75px">
			Jumlah
		</th>
	</tr>
	<tr>
		<td rowspan="7">
			
		</td>
		<td valign="top" align="center" rowspan="4">
			1
		</td>
		<td style="line-height:19pt;">
			Unsur Utama <br>
			a. Pendidikan<br>
				1) Pendidikan Sekolah<br>
				2) Diklat Kedinasan<br>
				&nbsp;&nbsp;&nbsp;&nbsp;Memperoleh STPL
		</td>
		<td class="tengah" style="line-height:19pt;">
			<input  id="total_pend_lama_cetak" class="field_cetak"><br>
			<input  id="pend_lama_cetak" class="field_cetak"><br>
			<input  id="diklat_lama_cetak" class="field_cetak">
		</td>
		<td class="tengah" style="line-height:19pt;">
			<input  id="total_pend_baru_cetak" class="field_cetak"><br>
			<input  id="pend_baru_cetak" class="field_cetak"><br>
			<input  id="diklat_baru_cetak" class="field_cetak">
		</td>
		<td class="tengah" style="line-height:19pt;">
			<input  id="total_pend_cetak" class="field_cetak"><br>
			<input  id="jm_pend_cetak" class="field_cetak"><br>
			<input  id="jm_diklat_cetak" class="field_cetak">
		</td>
		<td valign="top" align="center" rowspan="4">
			1
		</td>
		<td valign="top" style="line-height:19pt;">
			Unsur Utama <br>
			a. Pendidikan<br>
				1) Pendidikan Sekolah<br>
				2) Diklat Kedinasan
		</td>
		<td class="tengah" style="line-height:19pt;">
		<br>
			<input  id="pend_cetak" class="field_cetak"><br>
			<input  id="diklat_cetak" class="field_cetak">
		</td>
	</tr>
	<tr>
		<td valign="top" style="line-height:19pt;">
			b.Proses Belajar Mengajar
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="pbm_lama_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="pbm_baru_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="jm_pbm_cetak" class="field_cetak">
		</td>
		
		<td style="line-height:19pt;">
			b. Pembelajaran/Bimbingan dan Tugas tertentu<br>
				1) Proses Pembelajaran<br>
				2) Proses Bimbingan
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
		<br>
			<input  id="pembelajaran_cetak" class="field_cetak"><br>
			<input  id="bimbingan_cetak" class="field_cetak">
		</td>
	</tr>
	<tr>
		<td valign="top" style="line-height:19pt;">
			c. Pengembangan Profesi
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="pp_lama_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="pp_baru_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="jm_pp_cetak" class="field_cetak">
		</td>
		
		<td valign="top" style="line-height:19pt;">
			c. Pengembangan Keprofesian Berkelanjutan <br>
				1) Pengembangan Diri<br>
				2) Publikasi Ilmiah<br>
				3) Karya Inovatif
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
		<br>
			<input  id="pd_cetak" class="field_cetak"><br>
			<input  id="pi_cetak" class="field_cetak"><br>
			<input value="0.000" class="field_cetak">
		</td>
	</tr>
	<tr>
		<td style="line-height:19pt;">
			Jumlah Unsur Utama
		</td>
		<td valign="top" class="tengah">
			<input  id="total_unsur_utama_lama_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah">
			<input  id="total_unsur_utama_baru_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah">
			<input  id="total_jm_unsur_utama_cetak" class="field_cetak">
		</td>
		
		<td>
			Jumlah Unsur Utama
		</td>
		<td valign="top" class="tengah">
			<input  id="jm_unsur_utama_inpass_cetak" class="field_cetak">
		</td>
	</tr>
	<tr>
		<td valign="top">
			2
		</td>
		<td valign="top" style="line-height:19pt;">
			Unsur Penunjang Proses Belajar Mengajar
		</td>
		<td valign="top" class="tengah">
			<input  id="penunjang_lama_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah">
			<input  id="penunjang_baru_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah">
			<input  id="jm_penunjang_cetak" class="field_cetak">
		</td>
		<td valign="top">
			2
		</td>
		<td valign="top" style="line-height:19pt;">
			Unsur Penunjang<br>
			&nbsp;&nbsp; 1) Ijazah yang tidak sesuai<br>
			&nbsp;&nbsp; 2) Pendukung Tugas Guru
		</td>
		<td valign="top" class="tengah" style="line-height:19pt;">
			<input  id="jm_dukung_tugas_cetak" class="field_cetak"><br>
			<input  id="ijazah_tdksesuai_cetak" class="field_cetak"><br>
			<input  id="dukung_tugas_cetak" class="field_cetak">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Jumlah Unsur Utama dan<br>Unsur Penunjang
		</td>
		
		<td valign="top" class="tengah">
			<input  id="total_ak_lama_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah">
			<input  id="total_ak_baru_cetak" class="field_cetak">
		</td>
		<td valign="top" class="tengah">
			<input  id="total_jm_ak_cetak" class="field_cetak">
		</td>
		<td colspan="2" valign="top">
			Jumlah Unsur Utama dan Unsur Penunjang
		</td>
		<td valign="top" class="tengah">
			<input  id="total_ak_inpass_cetak" class="field_cetak">
		</td>
	</tr>
	<tr>
		
		<th colspan="5" align="center">
			<font style="font-size:13pt; font-weight:normal;"> TIDAK BERLAKU </font>
		</th>
		
		<th colspan="3" align="center">
			<font style="font-size:13pt; font-weight:normal;">BERLAKU</font>
		</th>
	</tr>
	<tr height="30px">
		<td valign="top">
			III
		</td>
		<td colspan="8" >
		<text style="text-align:left; font-size:11pt; font-family:arial; ">
			Disesuaikan dalam jabatan <?php echo $gol->jab_baru_guru; ?>. PNS tersebut dapat diberikan
			kenaikan jabatan setingkat lebih tinggi, apabila telah memenuhi persyaratan
			sesuai ketentuan yang berlaku dan telah mencapai angka komulatif minimal sebesar
			<?php echo $gol->ak_naik;?> angka kredit, termasuk didalamnya angka kredit minimal kegiatan pengembangan
			keprofesian berkelanjutan yang wajib diperoleh yaitu :<?php echo $gol->ak_pd;?> angka kredit dari sub
			unsur pengembangan diri, serta <?php echo $gol->ak_piki;?> angka kredit dari sub unsur publikasi ilmiah
			dan/atau karya inovatif.
		</text>
		</td>
		
	</tr>
	
</table>
<br><br>

<table class="kop">
<tr height="120px">
	<td valign="top" width="60%">
		<table >
		<tr>
			<td style="font-size:13pt; font-weight:normal;">
			Kepada Yth : 
			</td>
			<td align="left" style="font-size:13pt; font-weight:normal;">
			<?php 						if ($dataPd->gelar_blk == null ) 			{ $koma = ""; } else { $koma = ", ";};			if ($dataPd->gelar_dpn == null ) 			{ $titik = ""; } else { $titik = ". ";};						echo $dataPd->gelar_dpn.$titik.strtoupper($dataPeg->nama).$koma.$dataPd->gelar_blk;																		?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="left" style="font-size:13pt; font-weight:normal;">
			NIP . <?php echo $dataPeg->nip_baru; ?>
			</td>
			
		</tr>
		</table>
	</td>
	
	<td valign="top" width="50%">
		Ditetapkan di : Karawang<br>
		Pada tanggal :
		<?php 		echo $d->balik2($pak->tgl_pak); 		if ($pak->tgl_ralat != "0000-00-00" ) {			echo "<br>Diperbaiki pada tanggal : ".$d->balik2($pak->tgl_ralat);		}				?>
		<br>
		a.n. BUPATI KARAWANG<br>		<?php		echo $pejabat->dinas."<br>";				if ( $pejabat->jabatan != 'Kepala Dinas' ) {		echo "u.b. ".$pejabat->jabatan;		} ?>
	</td>
</tr>
<tr>
	<td valign="top">
		Tembusan : <br>
		1. Bupati Karawang (sebagai laporan)<br>
		2. Kepala Kantor Regional III Badan Kepegawaian Negara<br>
		3. Sekretaris Tim Penilai Angka Kredit Guru Kab. Karawang<br>
		4. Kepala Sekolah yang bersangkutan
	</td>
	<td valign="bottom" align="left">
		<b>
		<u>
		<?php 
		echo $pejabat->nm_pejabat;
		?>
		</u>
		</b>
		
		<br>
		<?php
		echo "NIP. ".$pejabat->nip_pejabat;
		?>
		<br>

		
		
	</td>
	
</tr>
</table>



</div>
<div class="clear"></div>