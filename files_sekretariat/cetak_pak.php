
<?php
if (isset($_GET['no_pak']) ){
$no_pak = $_GET['no_pak'];

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	Connect::getConnection();
	//data  PAK
	$dataPak = mysql_fetch_object(mysql_query("SELECT * FROM dt_pak WHERE no_pak='$no_pak'"));
	//data Pegawai
	$dataPeg = mysql_fetch_object(mysql_query("SELECT * FROM dt_pegawai WHERE nip_baru='$dataPak->nip_baru'"));
	$d 		= New FormatTanggal();
	
	//guru Gol
	$dataGol = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak='$no_pak'"));
	
	//pangkat
	$gol = mysql_fetch_object(mysql_query("SELECT * FROM kd_golongan WHERE nama_gol='$dataGol->nama_gol' "));
	
	//pebdidikan
	$dataPd = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_pend WHERE no_pak='$no_pak' "));
	$dataPend = mysql_fetch_object(mysql_query("SELECT * FROM kd_pendidikan_usul WHERE kd_pend_usul='$dataPd->kd_pend_usul' "));
	

	
	//skpd
	
	$dataSkpd = mysql_fetch_object(mysql_query("SELECT * FROM kd_skpd WHERE kd_skpd='$dataPd->kd_skpd' "));	
	
	//rekom 
	$dataRekom = mysql_fetch_object(mysql_query("SELECT * FROM kd_rekomendasi WHERE kd_rekom='$dataPak->kd_rekom' "));	
	
}
?>




<div id="printable" >
<br>
<table class="kop_pak" >
<tr>
	<td rowspan="4" width="130px" align="right" valign="top">
		<img src="images/logo-karawang.png" width="120px" height="160px" >
	</td>
	<td align="center" valign="bottom">
		<FONT style="font-size:23pt; font-family:Cambria; letter-spacing:3pt;  ">PEMERINTAH KABUPATEN KARAWANG</FONT>
	</td>
</tr>
<tr>
	<td align="center" height="48px" valign="bottom">
		<FONT style=" font-size:29pt; font-weight:bold; font-family:Cambria; letter-spacing:2pt;  ">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</FONT>
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
		<hr class="kop_hr_pak">
	</td>
</tr>
</table>

<table class="kop_pak" >
<tr height="34px">
	<td align="center" valign="bottom">
		<B><FONT style="font-size:13pt; font-weight:bold;" COLOR=#000000>PENETAPAN ANGKA KREDIT GURU</FONT></B>
	<td>
</tr>
<tr height="24px">
	<td align="center">
		<B><FONT style="font-size:13pt; font-weight:bold;" COLOR=#000000>BUPATI KARAWANG</FONT></B>
	<td>
</tr>
<tr height="14px">
	<td align="center">
		<FONT style="font-size:13pt; font-weight:normal;" COLOR=#000000>No. <?php echo $dataPak->no_pak; ?> </FONT>
	<td>
</tr>
</table>
<br><br>


<table class="tg_cetak_pak" >
<tr height="24px">
	<td align="left">
		<B><FONT style=FONT-SIZE:12pt FACE="Arial Narrow" COLOR=#000000>INSTANSI : PEMERINTAH KABUPATEN KARAWANG</FONT></B>
	</td>
	<td align="right">
		<B><FONT style=FONT-SIZE:12pt FACE="Arial Narrow" COLOR=#000000>MASA PENILAIAN : &nbsp;&nbsp;&nbsp;</FONT></B>
		<B><FONT style=FONT-SIZE:12pt FACE="Arial Narrow" COLOR=#000000>
		<?php echo $d->balik2($dataPak->tgl_mulai); ?>
		&nbsp;&nbsp;s.d&nbsp;&nbsp;
		<?php echo $d->balik2($dataPak->tgl_sampai); ?>
		<input type="hidden"  value="<?php echo $dataPak->tgl_sampai; ?>">
		</FONT></B>
	</td>
</tr>
</table>



<table class="cetak_pak" >
<tr>
	<td width="4%" align="center" valign="top">
		I
	</td>
	<td colspan="8" align="center">
	<B><FONT style=FONT-SIZE:12pt FACE="Arial Narrow" COLOR=#000000>
		KETERANGAN PERORANGAN
	</FONT></B>
	</td>
</tr>
<tr>
	<td rowspan="13"></td>
	<td width="4%" align="center">1</td>
	<td colspan="3" width="25%">Nama</td>
	<td colspan="4" class="isi">
	<?php 
		//Mencari Nama Lengkap +gelar depan belakang
		if ($dataPd->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};		if ($dataPd->gelar_dpn == null ) 		{ $titik = ""; } else { $titik = ". ";};
	
		echo $dataPd->gelar_dpn.$titik.ucwords(strtolower($dataPeg->nama)).$koma.$dataPd->gelar_blk;

	?>
	</td>
</tr>

<tr>
	<td align="center">2</td>
	<td colspan="3" width="25%">NIP</td>
	<td colspan="4" class="isi">
	<?php echo $dataPeg->nip_baru;?>
	</td>
</tr>
<tr>
	<td align="center">3</td>
	<td colspan="3" width="25%">NUPTK</td>
	<td colspan="4" class="isi">
	<?php echo $dataPeg->nuptk;?>
	</td>
</tr>
<tr>
	<td align="center">4</td>
	<td colspan="3" width="25%">No Seri KARPEG</td>
	<td colspan="4" class="isi">
	<?php echo $dataPeg->no_karpeg;?>
	</td>
</tr>
<tr>
	<td align="center">5</td>
	<td colspan="3" width="25%">Pangkat/Golongan.Ruang/TMT</td>
	<td colspan="4" class="isi">
	<?php echo $gol->pangkat." / ".$dataGol->nama_gol." / ". $d->balik2($dataGol->tmt_gol);?>
	</td>
</tr>
<tr>
	<td align="center">6</td>
	<td colspan="3" width="25%">Tempat Tanggal Lahir</td>
	<td  colspan="4" class="isi">
		<?php 
		
		//tempat tanggal lahir
		
		$tl		= $d->balik2($dataPeg->tgl_lahir);
		echo ucwords(strtolower($dataPeg->tmp_lahir)).", ".$tl;
		?>
	</td>
</tr>
<tr>
	<td align="center">7</td>
	<td colspan="3" width="25%">Jenis Kelamin</td>
	<td colspan="4" class="isi">
	<?php
		if ( $dataPeg->jk==1) echo "Laki-laki";
		if ( $dataPeg->jk==2) echo "Perempuan";
	?>
	</td>
</tr>
<tr>
	<td align="center">8</td>
	<td colspan="3" width="25%">Pendidikan Terakhir</td>
	<td class="isi" colspan="4">
	<?php
	echo $dataPend->nama_pend_usul." /  ".$dataPd->jurusan_pend_usul." /  tahun ".$dataPd->th_pend_usul;
	
	?>
	</td>
</tr>
<tr>
	<td align="center">9</td>
	<td colspan="3" width="25%">Jabatan Fungsional / TMT</td>
	<td colspan="4" class="isi">
	<?php
	echo $gol->jab_baru_guru." / ".$d->balik2($dataGol->tmt_jafung);
	?>
	</td>
</tr>

<tr>
	<td rowspan="2" align="center">10</td>
	<td  rowspan="2" colspan="2" width="23%">
	Masa Kerja Jabatan
	</td>
	<td>Lama </td>
	<td colspan="4" class="isi">
			<input  id="mk_awal_thn_cetak" class="field_cetak" style="width:20px">&nbsp; Thn &nbsp;&nbsp;
			<input  id="mk_awal_bln_cetak" class="field_cetak" style="width:20px">&nbsp; Bln 
	</td>
	
</tr>
<tr>
	
	<td>Baru</td>
	<td colspan="4" class="isi">
			<input  id="jm_mk_thn_cetak" class="field_cetak" style="width:20px">&nbsp; Thn &nbsp;&nbsp;
			<input  id="jm_mk_bln_cetak" class="field_cetak" style="width:20px">&nbsp; Bln 
	</td>
</tr>
<tr>
	<td align="center">11</td> 
	<td colspan="3" width="25%">Sekolah</td>
	<td colspan="4" class="isi">
	<?php
	echo $dataSkpd->sekolah;
	?>
	</td>
</tr>
<tr>
	<td align="center">12</td>
	<td colspan="3" width="25%">SKPD</td>
	<td colspan="4" class="isi">
	<?php
	echo $dataSkpd->skpd;
	?>
	</td>
</tr>
<tr>
	<td rowspan="16" align="center" valign="top">II</td><td colspan="5" width="55%">PENETAPAN ANGKA KREDIT</td>
	<td align="center" width="12%">LAMA</td>
	<td align="center" width="12%">BARU</td>
	<td align="center" width="12%">JUMLAH</td>
</tr>
<tr>
	<td rowspan="10" align="center" valign="top">1</td><td colspan="4">UNSUR UTAMA</td><td  ></td><td></td><td></td>
</tr>
<tr>
	<td width="3%" rowspan="3" align="center" valign="top">A</td><td  colspan="3">Pendidikan</td><td></td><td></td><td></td>
</tr>
<tr>
	<td  colspan="3">1) Mengikuti Pendidikan dan Memperoleg Gelar/Ijazah/Akta</td>
	<td class="tengah"><?php echo number_format($dataPak->pend_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pend_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pend_lama+$dataPak->pend_baru,3); ?></td>
</tr>
<tr>
	<td  colspan="3">2) Mengikuti Pelatihan Prajabatan</td>
	<td class="tengah"><?php echo number_format($dataPak->diklat_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->diklat_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->diklat_lama+$dataPak->diklat_baru,3); ?></td>
</tr>
<tr>
	<td align="center" valign="top">B</td><td  colspan="3">Pembelajaran/Bimbingan dan Tugas Tertentu</td>
	<td class="tengah"><?php echo number_format($dataPak->pbt_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pbt_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pbt_lama+$dataPak->pbt_baru,3); ?></td>
</tr>
<tr>
	<td rowspan="4" align="center" valign="top">C</td><td  colspan="3">Pengembangan Keprofesian Berkelanjutan</td><td></td><td></td><td></td>
</tr>
<tr>
	<td  colspan="3">1) Melaksanakan Pengembangan Diri</td>
	<td class="tengah"><?php echo number_format($dataPak->pd_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pd_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pd_lama+$dataPak->pd_baru,3); ?></td>
</tr>
<tr>
	<td  colspan="3">2) Melaksanakan Publikasi Ilmiah</td>
	<td class="tengah"><?php echo number_format($dataPak->pi_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pi_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->pi_lama+$dataPak->pi_baru,3); ?></td>
</tr>
<tr>
	<td  colspan="3">3) Melaksanakan Karya Inovatif</td>
	<td class="tengah"><?php echo number_format($dataPak->ki_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->ki_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->ki_lama+$dataPak->ki_baru,3); ?></td>
</tr>

<tr>
	<td colspan="4">JUMLAH UNSUR UTAMA</td>
	<td class="tengah"><?php echo number_format(
	$dataPak->pend_lama+
	$dataPak->diklat_lama+
	$dataPak->pbt_lama+
	$dataPak->pd_lama+
	$dataPak->pi_lama+
	$dataPak->ki_lama
	,3); ?></td>
	<td class="tengah"><?php echo number_format(
	$dataPak->pend_baru+
	$dataPak->diklat_baru+
	$dataPak->pbt_baru+
	$dataPak->pd_baru+
	$dataPak->pi_baru+
	$dataPak->ki_baru
	,3); ?></td>
	<td class="tengah"><?php echo number_format(
	$dataPak->pend_lama+
	$dataPak->diklat_lama+
	$dataPak->pbt_lama+
	$dataPak->pd_lama+
	$dataPak->pi_lama+
	$dataPak->ki_lama+
	$dataPak->pend_baru+
	$dataPak->diklat_baru+
	$dataPak->pbt_baru+
	$dataPak->pd_baru+
	$dataPak->pi_baru+
	$dataPak->ki_baru
	,3); ?></td>
</tr>
<tr>
	<td rowspan="4" align="center" valign="top">2</td><td colspan="4">UNSUR PENUNJANG</td><td></td><td></td><td></td>
</tr>
<tr>
	<td align="center" valign="top">A</td><td  colspan="3">Ijazah yang tidak sesuai</td>
	<td class="tengah"><?php echo number_format($dataPak->sttb_tdksesuai_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->sttb_tdksesuai_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->sttb_tdksesuai_lama+$dataPak->sttb_tdksesuai_baru,3); ?></td>
</tr>
<tr>
	<td align="center" valign="top">B</td><td  colspan="3">Pendukung Tugas Guru</td>
	<td class="tengah"><?php echo number_format($dataPak->dukung_tugas_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->dukung_tugas_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->dukung_tugas_lama+$dataPak->dukung_tugas_baru,3); ?></td>
<tr>
	<td colspan="4">JUMLAH UNSUR PENUNJANG</td>
	<td class="tengah"><?php echo number_format($dataPak->sttb_tdksesuai_lama+$dataPak->dukung_tugas_lama,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->sttb_tdksesuai_baru+$dataPak->dukung_tugas_baru,3); ?></td>
	<td class="tengah"><?php echo number_format($dataPak->sttb_tdksesuai_lama+$dataPak->dukung_tugas_lama+$dataPak->sttb_tdksesuai_baru+$dataPak->dukung_tugas_baru,3); ?></td>
</tr>

<tr>
	<td colspan="5">JUMLAH UNSUR UTAMA DAN UNSUR PENDUKUNG</td>
	<td class="tengah"><?php echo number_format(
	$dataPak->pend_lama+
	$dataPak->diklat_lama+
	$dataPak->pbt_lama+
	$dataPak->pd_lama+
	$dataPak->pi_lama+
	$dataPak->ki_lama+
	$dataPak->sttb_tdksesuai_lama+
	$dataPak->dukung_tugas_lama
	,3); ?></td>
	<td class="tengah"><?php echo number_format(
	$dataPak->pend_baru+
	$dataPak->diklat_baru+
	$dataPak->pbt_baru+
	$dataPak->pd_baru+
	$dataPak->pi_baru+
	$dataPak->ki_baru+
	$dataPak->sttb_tdksesuai_baru+
	$dataPak->dukung_tugas_baru
	,3); ?></td>
	<td class="tengah"><?php 
	
	
	
	$jumlah_total = 
	$dataPak->pend_lama+
	$dataPak->diklat_lama+
	$dataPak->pbt_lama+
	$dataPak->pd_lama+
	$dataPak->pi_lama+
	$dataPak->ki_lama+
	$dataPak->pend_baru+
	$dataPak->diklat_baru+
	$dataPak->pbt_baru+
	$dataPak->pd_baru+
	$dataPak->pi_baru+
	$dataPak->ki_baru+
	$dataPak->sttb_tdksesuai_lama+
	$dataPak->dukung_tugas_lama+
	$dataPak->sttb_tdksesuai_baru+
	$dataPak->dukung_tugas_baru;
	
	echo number_format($jumlah_total,3); ?></td>
</tr>

<tr >
	<td align="center" valign="top">III</td>
	<td colspan="8" valign="top">
		<FONT style=" font-size:11pt;  font-family:verdana,calibri; ">
		1.  Rincian pemenuhan angka kredit yang wajib diperoleh untuk dinaikan jabatan/pangkat setingkat lebih tinggi, adalah sebagai berikut
		</font>

		
		<table class="rincian"  width="100%" border="1">
			<tr>
				<td>
					
				</td>
				<td>
					a. Angka Kredit Komulatif minimal
				</td>
				<td>
					<input  id="ak_min_komulatif_cetak" class="field_cetak" style="width:80px">
				</td>
				<td>
					: &nbsp;
					<input  id="kesimpulan_komulatif_cetak" class="field_cetak" style="text-align:left; width:120px">
				</td>
				<td>
					d. Makalah Penelitian
				</td>
				<td>
					: &nbsp;
					<input  id="kesimpulan_makalah_cetak" class="field_cetak" style="text-align:left; width:120px">
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
				<td>
					b. Angka Kredit Pengembangan Diri
				</td>
				<td>
					<input  id="ak_min_pd_cetak" class="field_cetak" style="width:80px">
				</td>
				<td>
					: &nbsp;
					<input  id="kesimpulan_pd_cetak" class="field_cetak" style="text-align:left; width:120px">
				</td>
				<td>
					e. Artikel yang dimuat di jurnal
				</td>
				<td>
					: &nbsp;
					<input  id="kesimpulan_artikel_cetak" class="field_cetak" style="text-align:left; width:120px">
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
				<td>
					c. Angka Kredit Publikasi Ilmiyah/ Karya Inovatif
				</td>
				<td>
					<input  id="ak_min_piki_cetak" class="field_cetak" style="width:80px">
				</td>
				<td>
					: &nbsp;
					<input  id="kesimpulan_piki_cetak" class="field_cetak" style="text-align:left; width:120px">
				</td>
				<td>
					f. Buku pelajaran/ buku pendidikan
				</td>
				<td>
					: &nbsp;
					<input  id="kesimpulan_buku_cetak" class="field_cetak" style="text-align:left; width:120px">
				</td>
			</tr>
			<tr>
				<td width="2%"  valign="top">
					2.
				</td>
				<td colspan="5"  valign="top">
					
					<?php
					if ($dataRekom->rekomendasi != "") 
					{ echo $dataRekom->rekomendasi; } else { echo " &nbsp;"; };
					?>
					
				</td>
			</tr>
		</table>

	</td>
</tr>



</table>
<br><br>

<table class="kop" border="0" >
<tr height="100px">
	<td valign="top" width="60%">
		
		<h1  class="barcode" style="font-size:43pt;">
		
		<?php echo $dataPak->nip_baru; ?>
		</h1>
		
		
	</td>
	
	<td valign="top" width="40%">

		Ditetapkan di &nbsp;&nbsp; : &nbsp;&nbsp;Karawang<br>
		Pada tanggal  &nbsp;&nbsp; : &nbsp;&nbsp;		<?php 			echo $d->balik2($dataPak->tgl_pak); 			if ($dataPak->tgl_ralat != "0000-00-00" ) {			echo "<br>Diperbaiki pada tanggal : ".$d->balik2($dataPak->tgl_ralat);			}				?>						<br>		a.n  BUPATI KARAWANG<br>		<?php
		$dataPejabat = mysql_fetch_object(mysql_query("SELECT * from dt_pejabat where kd_pejabat='$dataPak->kd_pejabat' "));				echo $dataPejabat->dinas."<br>";				if ( $dataPejabat->jabatan != 'Kepala Dinas' ) {		echo "u.b. ".$dataPejabat->jabatan;		} ?>
	</td>
</tr>
<tr>
	<td valign="bottom" height="160px">
		Asli disampaikan dengan hormat kepada : <br>
		Kepala BKN dan Kanreg III BKN dan<br>
		Tembusan disampaikan kepada : <br>
		1. Guru yang bersangkutan;<br>
		2. Sekretaris Tim Penilai guru yang bersangkutan;<br>
		3. Kepala Badan Kepegawaian dan Diklat Kab. Karawang;<br>
		4. Pejabat pengusul angka kredit; dan<br>
		5. Pejabat lain yang dipandang perlu.
		
	</td>
	<td valign="center" align="left">
		<b>
		<u>
		<?php 
		echo $dataPejabat->nm_pejabat;
		?>
		</u>
		</b>
		
		<br>
		<?php
		echo "NIP. ".$dataPejabat->nip_pejabat;
		?>
		<br>

		
		
	</td>
	
</tr>
</table>
</div>
