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
		MELAKUKAN KEGIATAN PENUNJANG TUGAS GURU
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
		<p  style="margin-left:-15px;">Telah melakukan kegiatan penunjang tugas guru sebagai berikut</p>
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
	<th width="11%">
		Satuan <br>Hasil
	</th>
	<th width="11%">
		Jumlah <br>Volume <br>Kegiatan
	</th>
	<th width="11%">
		Angka <br>Kredit
	</th>
	<th width="11%">
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
	$x	= mysql_fetch_object(mysql_query("SELECT * FROM tb_dupak_guru_f WHERE no_dupak = '$no_dupak' "));
	$no		= 0;
	$jm_f 	= 0;
	$jm_ak 	= 0;
	$jm_tot	= 0;
	
	for ($i= 64; $i <= 79; $i++)
	{
		$dt 	= 'f_'.$i;
		$data_f = $x->$dt;
		
		
		
		if ( $data_f != 0 ){
			$keg = mysql_fetch_object(mysql_query("SELECT kegiatan,angka_kredit FROM kd_kegiatan_dan_ak WHERE kode_kegiatan='$i' "));
			
			
			
			
			?>
<tr>
	<td valign="top">
		<?php echo $no = $no+1; ?>
	</td>
	<td>
		<?php echo $keg->kegiatan; ?>
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td align="center">
		<?php echo $data_f; ?>
	</td>
	<td align="right">
		<?php echo $keg->angka_kredit; ?>
	</td>
	<td align="right">
		<?php echo number_format($data_f*$keg->angka_kredit,3); ?>
	</td>
	<td>
		
	</td>
</tr>			
			
			<?php
			$jm_f 	= $jm_f+$data_f;
			$jm_ak 	= $jm_ak+$keg->angka_kredit;
			$jm_tot	= $jm_tot+($data_f*$keg->angka_kredit);
		}
		
		
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
	<td align="center">
		<?php echo $jm_f; ?>
	</td>
	<td align="right">
		<?php echo number_format($jm_ak,3 ); ?>
	</td>
	<td align="right">
		<?php echo number_format($jm_tot,3 ); ?>
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
		echo $d->balik2($tgl);
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
