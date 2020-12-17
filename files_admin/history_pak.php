<script>
$(document).ready(function () {
	id_pegawai = $("#id_pegawai").val();
	//alert(id_pegawai);
	$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
	
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
        cache:false,
        success:function(msg){
		data=msg.split("|");
			//alert(msg);
			if (data[0] == '1') {
								
				//DATA PRIBADI GURU
				$("#nama").val(data[1]);
				$("#ttl").val(data[2]);
				$("#jk").val(data[3]);
				$("#nip").val(data[4]);
				$("#nuptk").val(data[5]);
				$("#no_karpeg").val(data[6]);
					
				//DATA PAK TERAKHIR
				$("#no_pak_terakhir").val(data[7]);
				$("#tgl_pak").val(data[8]);
				$("#masa_penilaian").val(data[9]);
				$("#ak_pak_terakhir").val(data[10]);
				
				
				//DATA PENDIDIKAN
				$("#jenjang").val(data[12]);
				$("#jurusan").val(data[13]);
				$("#th_lulus").val(data[14]);
				
				
				//DATA GOLONGAN DAN TUGAS MENGAJAR
				$("#golongan").val(data[19]);
				$("#tugas_mengajar").val(data[20]);
				$("#sekolah").val(data[21]);
				$("#foto").html(data[49]);			
							
				$( ".pre_load" ).fadeOut(10);
			}else {
				//alert("");
				//window.location.assign("?page=home");	
								
			}
        }
	})
		

});



</script>





<?php
	$id_pegawai = isset($_GET['id']) ? $_GET['id'] : '';
	?>




<input type="hidden" value="<?php echo $id_pegawai ?>" id="id_pegawai">

<h3 class="page-header">
DATA PRIBADI
</h3>

<div class="detail_guru" >
<div class="pre_load"></div>
<table width="100%" border="0" class="data_form">
<tr>
	<td width="15%" rowspan="13" valign="top" align="left">
	<span id="foto" class="pas_poto"></span>
	</td>
	<td colspan="3" class="isi">
		DATA PRIBADI GURU 
	</td>
	<td colspan="3" class="isi">
		DATA PAK TERAKHIR
	</td>
</tr>
<tr>
	<td width="13%">
		Nama
	</td>
	<td width="1%">
		:
	</td>
	<td width="24%">
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="nama" disabled>
	</td>
	<td width="13%">
		No PAK Terakhir
	</td>
	<td width="1%">
		:
	</td>
	<td width="31%">
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="no_pak_terakhir" disabled>
	</td>
</tr>

<tr>
	<td>
		Tempat/Tgl Lahir
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="ttl" disabled>
	</td>
	<td>
		Tanggal PAK
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="tgl_pak" disabled>
	</td>
</tr>
<tr>
	<td>
		Jenis Kelamin
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text"  class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="jk" disabled>
	</td>
	<td>
		Masa Penilaian
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:260px; font-weight:bold;" id="masa_penilaian" disabled>
	</td>
</tr>
<tr>
	<td>
		Nip Baru
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; font-weight:bold;" id="nip" disabled>
	</td>
	<td>
		Angka Kredit
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="ak_pak_terakhir" disabled>
	</td>
</tr>
<tr>
	<td>
		NUPTK
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="nuptk" disabled>
	</td>
	<td>
		
	</td>
	<td width="1%">
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td>
		No Karpeg
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="no_karpeg" disabled>
	</td>
	<td>
		
	</td>
	<td width="1%">
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td>
		&nbsp;
	</td>
	<td width="1%">
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td width="1%">
		
	</td>
	<td>
		
	</td>
</tr>

<tr>
	<td colspan="3" class="isi">
		DATA PENDIDIKAN
	</td>
	<td colspan="3" class="isi">
		DATA GOLONGAN DAN TUGAS MENGAJAR
	</td>
</tr>
<tr>
	<td>
		Jenjang Pendidikan
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="jenjang" disabled>
	</td>
	<td>
		Tugas Mengajar
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:200px; font-weight:bold;" id="tugas_mengajar" disabled>
	</td>
</tr>
<tr>
	<td valign="top">
		Jurusan / Th Lulus
	</td>
	<td valign="top" width="1%">
		:
	</td>
	<td valign="top">
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; font-weight:bold;" id="jurusan" disabled> / 
		<input type="text" class="input_data" style="background:transparent; border:none; cursor:pointer; color:#ad001d; margin:-6px; width:35px; font-weight:bold;" id="th_lulus" disabled>
	</td>
	<td valign="top">
		Sekolah
	</td>
	<td valign="top" width="1%">
		:
	</td>
	<td height="23px">
		<textarea style="color:#ad001d; width:330px; height:40px; padding:0px 0 5px 5px; resize: none; background-color:transparent; border:none; font-weight:bold;" id="sekolah" disabled></textarea>
	</td>
</tr>

</table>
</div>

<br>

<h3 class="page-header">
STATUS DUPAK GURU
</h3>
<div class="status_dupak" >
<?php
include "files_common/dupak_tracking.php";
?>
</div>

<br>
<h3 class="page-header">
DATA PAK GURU
</h3>
<table border="1" class="data table-hover" width="100%">
    <tr>
		<th rowspan="2">NO</th>
		<th rowspan="2" width="18%">NO PAK</th>
		<th rowspan="2"  width="12%">TANGGAL PAK</th>
		<th colspan="2">MASA PENILAIAN</th>
		<th colspan="2">GOLONGAN</th>
		<th colspan="3" width="15%">ANGKA KREDIT</th>
		<th rowspan="2">Aksi</th>
	</tr>
	<tr>
		<th>MULAI</th>
		<th>SAMPAI</th>
		<th>GOL</th>
		<th>TMT</th>
		<th width="8%" >PD</th>
		<th width="8%">PIKI</th>
		<th width="8%">TOTAL</th>
	</tr>
<!-- table data -->
<?php
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	Connect::getConnection();
	
	//untuk foto
	$peg = mysql_fetch_object(mysql_query("SELECT nip_baru FROM dt_pegawai WHERE id_pegawai = '$id_pegawai' "));
	$nip_baru = $peg->nip_baru;
	
	$d 		= New FormatTanggal();
	
	$query = mysql_query("SELECT * FROM dt_pak WHERE nip_baru='$nip_baru' ORDER by tgl_pak asc");
	$no =1;
	while($row=mysql_fetch_array($query))
	{ ?>
<tr>
	<td align="center">
		<?php echo $no; ?>
	</td>
	<td>
		<?php 
		$data	= explode('/',$row['no_pak']);
		if ($data[2]=='TP.GURU') {
		?>
		<a href="?page=detail_pak&nip_baru=<?php echo $nip_baru; ?>&no_pak=<?php echo $row['no_pak']; ?>" ><?php echo $row['no_pak']; ?></a>
		

	
	<?php } else { ?>
	<a href="?page=detail_inpassing&nip_baru=<?php echo $nip_baru; ?>&no_pak=<?php echo $row['no_pak']; ?>" ><?php echo $row['no_pak']; ?></a>
	
	<?php } ?>
	</td>
	<td align="center">
		<?php 
		echo $d->balik($row['tgl_pak']);
		?>
	</td>
	<td align="center">
		<?php 
		echo $d->balik($row['tgl_mulai']);
		?>
	</td>
	<td align="center">
		<?php
		echo $d->balik($row['tgl_sampai']);
		?>
	</td>
	<td align="center">
		<?php 
		//GOLONGAN
		$gol = mysql_fetch_object(mysql_query("SELECT * FROM tb_pak_guru_gol WHERE no_pak='$row[no_pak]'"));
		$nama_gol = isset($gol->nama_gol) ? $gol->nama_gol : '-';
		echo $nama_gol;
		?>
	</td>
	<td align="center">
		<?php
		$tmt_gol = isset($gol->tmt_gol) ? $gol->tmt_gol : '-';
		echo $d->balik($tmt_gol);
		?>
	</td>
	<td align="center">
		<?php 
		
		if ($data[2]=='TPAK-GURU') {
		echo "0.000";
		}else{

		echo number_format($row['pd_baru'],3);
		}
		?>
	</td>
	<td align="center">
		<?php
		if ($data[2]=='TPAK-GURU') {
		echo "0.000";
		}else{
		echo number_format($row['pi_baru']+$row['ki_baru'],3);
		}
		?>
	</td>
	<td align="center">
		<?php
		echo number_format(
		$row['pend_lama']+$row['diklat_lama']+$row['pbt_lama']+$row['pd_lama']+$row['pi_lama']+$row['ki_lama']+$row['sttb_tdksesuai_lama']+$row['dukung_tugas_lama']+
		$row['pend_baru']+$row['diklat_baru']+$row['pbt_baru']+$row['pd_baru']+$row['pi_baru']+$row['ki_baru']+$row['sttb_tdksesuai_baru']+$row['dukung_tugas_baru'],
		3);
		?>
	</td>
	<td align="center">
		<!-- CEK apakan data PAK atau Inpassing -->
		<?php if ($data[2]=='TP.GURU') { ?>
			<a href="?page=detail_pak&no_pak=<?php echo $row['no_pak']; ?>" class="aksi">DETAIL PAK</a>
		<?php } else { ?>
			<a href="?page=detail_inpassing&no_pak=<?php echo $row['no_pak']; ?>" class="aksi">DETAIL PAK</a>
	
		<?php } ?>
	</td>

	
</tr>
<?php	
$no++;		
}			
?>

</table>