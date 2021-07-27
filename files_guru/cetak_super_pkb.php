<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>

<script>
$(document).ready(function () {
	no_dupak = $("#get_no_dupak").val();

	detail_data_dupak();
	detail_kepsek_dupak();
	
	function detail_data_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_dupak&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#no_dupak").val(data[0]);
							$("#masa_penilaian").val(data[6]+"   s.d   "+data[7]);
							$("#tanggal_dupak").val("Karawang, "+data[9]);
							$("#nama_tu").val(data[5]);
							$("#nip_tu").val("NIP. "+data[10]);
							detail_data_sekolah(data[8]);
                        }
                    })
		}
	
	function detail_data_sekolah(kd_skpd){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_sekolah&kd_skpd="+kd_skpd,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#sekolah").val(data[4]);
							$("#xsekolah").val(data[4]);
							$("#alamat").val(data[6]+"    Telp."+data[7]);
							
							
                        }
                    })
		}
		
	
	function detail_kepsek_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_dupak_kepsek&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#nama_kepsek").val(data[1]);
							$("#nip_kepsek").val(data[2]);
							$("#nuptk_kepsek").val(data[3]);
							$("#pgt_kepsek").val(data[4]+' / '+data[5]+' / '+data[6]);
							$("#jabatan_kepsek").val(data[7]);
							$("#unit_kerja_kepsek").val(data[8]);
							$("#ttd_kepsek").val(data[1]);
							$("#nip_ttd_kepsek").val('NIP. '+data[2]);
							
                        }
                    })
		}
	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_id_pegawai_dupak&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
			x=msg.split("|");
			//alert(x[0]);
			detail_pegawai(x[0]);
        }
	})
	
	//data pribadi guru
	function detail_pegawai(id_pegawai){
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
        cache:false,
        success:function(msg){
		data=msg.split("|");
			//alert(msg);
			$("#nama_guru").val(data[1]);
			$("#nip_guru").val(data[4]);
			$("#nuptk_guru").val(data[5]);
			$("#pgt_guru").val(data[26]+' / '+data[19]+' / '+data[24]);
			$("#jabatan_guru").val(data[28]);
			$("#unit_kerja_guru").val(data[21]);
        }
	})

	}
	

	
 });
</script>

<?php
$no_dupak = isset($_GET['no_dupak']) ? $_GET['no_dupak'] : '';
?>
 
<input type="hidden" value="<?php echo $no_dupak; ?>" id="get_no_dupak">
 
<p align="right">
<button onclick="history.go(-1)" class="ui-state-default kembali"  >Kembali</button>
<button onclick="window.print()" class="ui-state-default cetak"  >Cetak</button>
</p> 
 

<div id="printable" >
 
<table class="kop" >
<tr>
	<td rowspan="4" width="130px" height="170px" align="right" valign="top">
		<img src="images/shared/logo.png" width="120px" height="160px" >
	</td>
	<td align="center" valign="bottom">
		<FONT style="font-size:23pt; font-family:Cambria; letter-spacing:3pt;  ">PEMERINTAH KABUPATEN KARAWANG</FONT>
	</td>
</tr>
<tr>
	<td align="center" height="38px" valign="bottom">
		<FONT style=" font-size:24pt; font-weight:bold; font-family:Cambria; letter-spacing:2pt;  ">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</FONT>
	</td>
</tr>
<tr>
	<td align="center" height="38px" valign="bottom">
		<input type="text" style=" text-align:center; width:920px; border:none; background:transparent; font-size:19pt; color:black; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:2pt;" id="sekolah" readonly>
	</td>
</tr>
<tr>
	<td align="left">
		<input type="text" style=" text-align:center; width:920px; border:none; background:transparent; font-size:12pt; color:black; font-weight:bold; font-family:Times New Roman,verdana,calibri; letter-spacing:1pt;" id="alamat" readonly>
		
	</td>
</tr>
<tr>
	<td colspan="2" height="3px" valign="top">
		<hr class="kop_hr">
	</td>
</tr>
<tr>
	<td colspan="2" height="60px" valign="bottom" align="center">
		<FONT style=" font-size:14pt;  font-weight:bold; font-family:Times New Roman,Cambria; letter-spacing:1pt;  ">
		SURAT PERNYATAAN<br>
		MELAKUKAN KEGIATAN PENGEMBANGAN KEPROFESIAN BERKELANJUTAN
		</font>
	</td>
</tr>
<tr>
	<td colspan="2"  align="center" height="18px" valign="top">
		<FONT style=" font-size:14pt;  font-family:calibri,Times New Roman,verdana; ">
			No Dupak : 
		</font>
			<input type="text" style=" margin-left:0px; text-align:center; width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:isi; " id="no_dupak" readonly>
	
	</td>
</tr>

<tr>
	<td colspan="2"  align="center" height="25px" valign="top">
		<FONT style=" font-size:14pt;  font-family:calibri,Times New Roman,verdana; ">Masa Penilaian	: &nbsp;
		</font>
		<input type="text" style="  margin-left:0px; text-align:left; width:280px;  font-size:13pt; border:none; color:black; font-family:isi; " id="masa_penilaian" readonly>
	</td>
</tr>


</table>
<br>

<table class="keterangan_perorangan" border="0">
<tr>
	<td colspan="4">
		Yang bertanda tangan dibawah ini,
	</td>
</tr>
<tr>
	<td width="10%" align="right">
		
	</td>
	<td width="30%">
		Nama
	</td>
	<td width="1%" align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nama_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NIP
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nip_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NUPTK
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nuptk_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Pangkat/Golongan.Ruang/TMT
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="pgt_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Jabatan
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="jabatan_kepsek" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Unit Kerja
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="unit_kerja_kepsek" readonly>
	</td>
</tr>
<tr>
	<td colspan="4">
		
	</td>
</tr>
<tr>
	<td colspan="4">
		Menyatakan bahwa,
	</td>
</tr>
<tr>
	<td width="10%" align="right">
		
	</td>
	<td width="30%">
		Nama
	</td>
	<td width="1%" align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nama_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NIP
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nip_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		NUPTK
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="nuptk_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Pangkat/Golongan.Ruang/TMT
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="pgt_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Jabatan
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="jabatan_guru" readonly>
	</td>
</tr>
<tr>
	<td align="right">
		
	</td>
	<td>
		Unit Kerja
	</td>
	<td align="center">
		:
	</td>
	<td>
		<input type="text" class="field_isi" id="unit_kerja_guru" readonly>
	</td>
</tr>
</table>
<br><br>
 
<table class="keterangan_perorangan" border="0">
<tr>
	<td>
		<p  style="margin-left:-15px;">Telah melaksanakan kegiatan pengembangan keprofesian berkelanjutan sebagai berikut</p>
	</td>
</tr>
</table>
 
 
<table class="keg_dupak">
<tr>
	<th width="4%">
		No
	</th>
	<th width="*%">
		Uraian Kegiatan
	</th>
	<th width="11%">
		Tanggal
	</th>
	<th width="8%">
		Satuan <br>Hasil
	</th>
	<th width="8%">
		Jumlah <br>Volume <br>Kegiatan
	</th>
	<th width="8%">
		Angka <br>Kredit
	</th>
	<th width="8%">
		Jumlah <br>Angka <br>Kredit
	</th>
	<th width="11%">
		Keterangan/<br>Bukti Fisik
	</th>
</tr>
<tr>
	<th>1</th>
	<th>2</th>
	<th>3</th>
	<th>4</th>
	<th>5</th>
	<th>6</th>
	<th>7</th>
	<th>8</th>
</tr>

<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
$d 			= New FormatTanggal();
Connect::getConnection();
	$diklat		= mysql_query("SELECT dt_dupak_diklat.*,kd_kegiatan_dan_ak.* FROM dt_dupak_diklat,kd_kegiatan_dan_ak WHERE dt_dupak_diklat.no_dupak='$no_dupak' and   kd_kegiatan_dan_ak.kode_kegiatan=dt_dupak_diklat.kode_kegiatan ");
	$jm_diklat 	= mysql_num_rows($diklat);
	
	$kolektif		= mysql_query("SELECT dt_dupak_kegiatan_kolektif.*,kd_kegiatan_dan_ak.* FROM dt_dupak_kegiatan_kolektif,kd_kegiatan_dan_ak WHERE dt_dupak_kegiatan_kolektif.no_dupak='$no_dupak' and   kd_kegiatan_dan_ak.kode_kegiatan=dt_dupak_kegiatan_kolektif.kode_kegiatan ");
	$jm_kolektif 	= mysql_num_rows($kolektif);
	
	//echo $jm;
	$rp = $jm_diklat+$jm_kolektif+1;
	echo $rp;
?>
<tr>
	<td valign="top" align="left" rowspan="<?php echo $rp;?> ">
		1.
	</td>
	<td>
		Melaksanakan Pengembangan Diri
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<?php
	$jm_ak_kolektif = 0;
	$jm_ak_diklat 	= 0;
	$jm_ak_pd		= 0;
	while ($r = mysql_fetch_array($diklat)){
?>
<tr>
	<td style="padding-left:30px;">
		<?php echo $r['nama_diklat']; ?>
	</td>
	<td align="center">
		<?php echo $d->tgl_form($r['tgl_mulai']); ?>
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo $r['ak']; ?>
	</td>
	<td align="right">
		<?php echo $r['ak']; ?>
	</td>
	<td>
		
	</td>
</tr>
<?php 
$jm_ak_diklat= $jm_ak_diklat + $r['ak'];
} 



	while ($s = mysql_fetch_array($kolektif)){
?>
<tr>
	<td style="padding-left:30px;">
		<?php echo $s['kegiatan']; ?>
	</td>
	<td align="center">
		<?php echo $d->tgl_form($s['tgl_pelaksanaan']); ?>
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo $s['ak']; ?>
	</td>
	<td align="right">
		<?php echo $s['ak']; ?>
	</td>
	<td>
		
	</td>
</tr>
<?php 
$jm_ak_kolektif = $jm_ak_kolektif + $s['ak'];
} 
?>
<tr>
	<td colspan="2" align="center">
		Jumlah
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo number_format($jm_ak_diklat+$jm_ak_kolektif,3); ?>
	</td>
	<td align="right">
		<?php echo number_format($jm_ak_diklat+$jm_ak_kolektif,3); ?>
	</td>
	<td>
		
	</td>
</tr>
<?php
$query	= mysql_query("SELECT dt_dupak_piki.*,kd_dupak_kriteria_piki.* FROM dt_dupak_piki,kd_dupak_kriteria_piki WHERE dt_dupak_piki.no_dupak='$no_dupak' and   kd_dupak_kriteria_piki.kode_kegiatan=dt_dupak_piki.kd_kegiatan and kd_dupak_kriteria_piki.kode_kegiatan <= 51");
	$jm 	= mysql_num_rows($query);
	//echo $jm;
	$rp = $jm+1;
?>
<tr>
	<td valign="top" align="left" rowspan="<?php echo $rp;?> ">
		2.
	</td>
	<td>
		Melaksanakan Publikasi Ilmiyah
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<?php
	$jm_ak_pi = 0;
	while ($r = mysql_fetch_array($query)){
?>
<tr>
	<td style="padding-left:30px;">
		<?php echo $r['kriteria_piki']; ?>
	</td>
	<td align="center">
		<?php echo $r['th_piki']; ?>
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo $r['ak_piki']; ?>
	</td>
	<td align="right">
		<?php echo $r['ak_piki']; ?>
	</td>
	<td>
		
	</td>
</tr>
<?php 
$jm_ak_pi = $jm_ak_pi + $r['ak_piki'];
} 
?>
<tr>
	<td colspan="2" align="center">
		Jumlah
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo number_format($jm_ak_pi,3); ?>
	</td>
	<td align="right">
		<?php echo number_format($jm_ak_pi,3); ?>
	</td>
	<td>
		
	</td>
</tr>
<?php
$query	= mysql_query("SELECT dt_dupak_piki.*,kd_dupak_kriteria_piki.* FROM dt_dupak_piki,kd_dupak_kriteria_piki WHERE dt_dupak_piki.no_dupak='$no_dupak' and   kd_dupak_kriteria_piki.kode_kegiatan=dt_dupak_piki.kd_kegiatan and kd_dupak_kriteria_piki.kode_kegiatan >= 52");
	$jm 	= mysql_num_rows($query);
	//echo $jm;
	$rp = $jm+1;
?>
<tr>
	<td valign="top" align="left" rowspan="<?php echo $rp;?> ">
		2.
	</td>
	<td>
		Melaksanakan Karya Inovatif
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<?php
	$jm_ak_ki = 0;
	while ($r = mysql_fetch_array($query)){
?>
<tr>
	<td style="padding-left:30px;">
		<?php echo $r['kriteria_piki']; ?>
	</td>
	<td align="center">
		<?php echo $r['th_piki']; ?>
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo $r['ak_piki']; ?>
	</td>
	<td align="right">
		<?php echo $r['ak_piki']; ?>
	</td>
	<td>
		
	</td>
</tr>
<?php 
$jm_ak_ki = $jm_ak_ki + $r['ak_piki'];
} 
?>
<tr>
	<td colspan="2" align="center">
		Jumlah
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="right">
		<?php echo number_format($jm_ak_ki,3); ?>
	</td>
	<td align="right">
		<?php echo number_format($jm_ak_ki,3); ?>
	</td>
	<td>
		
	</td>
</tr>
</table>
<br>

<table class="keterangan_perorangan" border="0">
<tr>
	<td>
		<p  style="margin-left:85px; margin-right:-19px; word-break:break-all;">
		Demikian pernyataan ini dibuat dengan melampirkan hasil penilaian kinerja dan bukti fisik masing-masing 
		untuk
		</p>
		<p  style="margin-left:-12px;">
		dapat dipergunakan sebagaimana mestinya.
		</p>
	</td>
</tr>
</table>
<br><br><br>

<table class="keterangan_perorangan" border="0">
<tr>
	<td width="65%">
		
	</td>
	<td width="*%" style="padding-left:20px;">
	Karawang, 
	<?php
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
		$d 	= New FormatTanggal();
		$tgl = date('Y-m-d');
		//echo $d->balik2($tgl);
	?>
		
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td style="padding-left:20px;">
		Kepala Sekolah/Pengawas Sekolah
	</td>
</tr>
<tr height="60px">
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td>
		<input type="text" style="width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:Arial,Sans-Serif,Times New Roman,verdana; " id="ttd_kepsek" readonly>
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td>
		<hr style="margin-left:10px; margin-top:-10px; width:240px; position:absolute;">
		<input type="text" style="margin-top:-10px; width:300px; border:none; font-size:13pt; color:black; font-weight:normal; font-family:Arial,Sans-Serif,Times New Roman,verdana; " id="nip_ttd_kepsek" readonly>
	</td>
</tr>
</table>

</div>
