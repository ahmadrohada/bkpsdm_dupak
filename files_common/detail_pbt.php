<script>
$(document).ready(function () {

	//$("html, body").animate({ scrollTop: 160 }, "slow");
	load_table_pbt();
	isi_data_pbt();
	
	function isi_data_pbt(){
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_pbt_dupak&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
		data=msg.split("|");
			//alert(msg);
			//alert(data[2]);
			$("#d_hasil_pkg").val(data[0]);
			$("#d_ak_pkg").val(data[1]);
			$("#d_tugas_mengajar").val(data[2]);
			$("#d_jenis_guru").val(data[12]);
			$("#d_golongan").val(data[3]);
			$("#d_tmt_gol").val(data[4]);
			
			$("#d_kode_pbt").val(data[5]);
			$("#tugas_tambahan_1").val(data[6]);
			$("#tugas_tambahan_2").val(data[7]);
			$("#d_ak_jenis_guru").val(data[8]);
			$("#ak_tugas_1").val(data[9])
			$("#ak_tugas_2").val(data[10]);
			$("#f_jm_pbt").val(data[11]);
			
			
        }
	})
		
	}

	
	
	
	//fungsi pengisian table pbt
	function load_table_pbt() {
		no_dupak		=	$("#no_dupak").val();
		//alert(no_dupak);
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_pbt&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					$("#ak_05").val(data[0]);	
					$("#akf_05").val(data[0]);
					
					$("#ak_06").val(data[1]);
					$("#akf_06").val(data[1]);
					
					$("#ak_07").val(data[2]);
					$("#akf_07").val(data[2]);
					
					$("#ak_08").val(data[3]);
					$("#akf_08").val(data[3]);
					
					$("#ak_09").val(data[4]);
					$("#akf_09").val(data[4]);
					
					$("#ak_10").val(data[5]);
					$("#akf_10").val(data[5]);
					
					$("#ak_11").val(data[6]);
					$("#akf_11").val(data[6]);
					
					$("#ak_12").val(data[7]);
					$("#akf_12").val(data[7]);
					
					$("#ak_13").val(data[8]);
					$("#akf_13").val(data[8]);
					
					$("#ak_14").val(data[9]);
					$("#akf_14").val(data[9]);
					
					$("#ak_15").val(data[10]);
					$("#akf_15").val(data[10]);
					
					$("#ak_15_a").val(data[11]);
					$("#akf_15_a").val(data[11]);
					
					$("#ak_16").val(data[12]);
					$("#akf_16").val(data[12]);
					
					$("#ak_17").val(data[13]);
					$("#akf_17").val(data[13]);
					
					$("#ak_18").val(data[14]);
					$("#akf_18").val(data[14]);
					
					$("#jm_pbt").val(data[15]);
					
					if ($("#jm_pbt").val() != "0.000" ) {
							//alert(jm_p);
							$("#isian_pbt" ).hide();
							$("#edit_pbt" ).show();
					}
					
					}
		})
	}
	
	
	 
	 $( "#tab_pbt" ).accordion({
		collapsible: true,
		active : false,
		heightStyle: "content",
		header:"div.head_acor"
		
    });
	
});
</script>

<script src="./js/custom_ajax.js"></script>

<?php

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';

?>




<div id="tab_pbt" style="width:732px; margin-left:30px;">
	<div class="head_acor" style="padding:8px 0 8px 30px;">DATA USULAN PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU</div>
	<div id="">
	
        <table width="100%" class="form" border="0">
			<tr>
                <td width="20%">Hasil PKG / AK</td>
                <td width="60%">
				&nbsp;&nbsp;
					<select id="d_hasil_pkg"  disabled>
					<option value="">Hasil PKG</option>
					<option value="Amat Baik">Amat Baik</option>
					<option value="Baik">Baik</option>
					<option value="Cukup">Cukup</option>
					<option value="Sedang">Sedang</option>
					<option value="Kurang">Kurang</option>
					</select>
					
					&nbsp;&nbsp;
					<input type="text" size="10px" id="d_ak_pkg" placeholder="AK" disabled>
					
                </td>
				<td width="10%" align="center">
					
				</td>
			</tr>
			<tr>
                <td>Tugas Mengajar</td>
                <td>
				&nbsp;&nbsp;
					<select id="d_tugas_mengajar" disabled >
					<option value=""></option>
						<?php
							Connect::getConnection();
							$row = mysql_query("SELECT * FROM kd_jenis_guru ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['kd_jenis_guru']; ?>" ><?php echo substr($r['tugas_mengajar'],0,45); ?></option>
						<?php
							}  
						?>
					</select>
                </td>
				<td> </td>
			</tr>
			<tr>
                <td>Jenis Guru</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="42px" id="d_jenis_guru" disabled> 
					<input type="text" size="2px" id="d_kode_pbt" disabled>
                </td>
				<td  align="center"> 
					<input type="text" class="ak_field" id="d_ak_jenis_guru"  disabled>
				</td>
			</tr>
			<tr>
                <td>Golongan / TMT Gol</td>
                <td>
				&nbsp;&nbsp;
					<select id="d_golongan" disabled >
					<option value=""></option>
						<?php
							Connect::getConnection();
							$row = mysql_query("SELECT * FROM kd_golongan ");
							while ($r = mysql_fetch_array($row)){
						?>	
						<option value="<?php echo $r['nama_gol']; ?>" ><?php echo $r['nama_gol']; ?></option>
						<?php
						}
						 
						?>
					</select>
					/ <input type="text" size="10px" id="d_tmt_gol" placeholder="dd-mm-yyyy" disabled>
                </td>
				<td></td>
			</tr>
			
			<tr>
                <td rowspan="2" valign="top">Tugas Tambahan</td>
                <td>
				1. &nbsp;&nbsp;
					<select id="tugas_tambahan_1" disabled >
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT * FROM kd_kegiatan_dan_ak WHERE unsur = 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU' and kode_kegiatan != '05' and kode_kegiatan != '06' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['kode_kegiatan']; ?>" ><?php echo substr($r['kegiatan'],0,67); ?></option>
						<?php
						}
						?>
					</select>
                </td>
				<td  align="center"> 
					<input type="text" class="ak_field" id="ak_tugas_1" disabled>
				</td>
			</tr>
			<tr>
                <td>
				2. &nbsp;&nbsp;
					<select id="tugas_tambahan_2" disabled >
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT * FROM kd_kegiatan_dan_ak WHERE unsur = 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU' and kode_kegiatan != '05' and kode_kegiatan != '06' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['kode_kegiatan']; ?>" ><?php echo substr($r['kegiatan'],0,67); ?></option>
						<?php
						}
						?>
					</select>
					<td  align="center"> 
					<input type="text" class="ak_field" id="ak_tugas_2" disabled>
				</td>
                </td>
			</tr>
			<tr>
                <td colspan="2" align="center" class="isi">JUMLAH</td>
				<td  align="center"> 
				<input type="text" class="ak_field" id="f_jm_pbt" disabled>
				</td>
			</tr>
        </table>
	</div>
</div>


<br>


<table class="form" style="width:732px; margin-left:30px;">
<tr>
	<th rowspan="2" colspan="3" width="50%">
		UNSUR, SUB UNSUR DAN BUTIR KEGIATAN
	</th>
	<th rowspan="2" width="8%">
		Kode Komp
	</th>
	<th rowspan="2" width="10%">
		Angka Kredit
	</th>
	<th colspan="2" width="20%">
		Jumlah Usulan
	</th>
</tr>
<tr>
	<th width="5%">
		F
	</th>
	<th width="10%">
		A.K * F
	</th>
</tr>
<tr>
	<td colspan="3" class="isi">
		UNSUR UTAMA
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
	
	</td>
</tr>
<tr>
	<td width="2%" rowspan="20" valign="top" align="center">
		2.
	</td>
	<td colspan="2" class="isi" >
		PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td width="2%" rowspan="2" valign="top" align="center">
		A.
	</td>
	<td>
		Melaksanakan proses Pembelajaran
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
	
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td  style="padding-left:26px;">
		Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, 
		melaksanakan tindak lanjut hasil penilaian
	</td>
	<td>
		05
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_05" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_05" disabled >
	</td>
</tr>
<tr>
	<td width="2%" rowspan="2" valign="top" align="center">
		B.
	</td>
	<td>
		Melaksanakan proses Bimbingan
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td  style="padding-left:26px;">
		Merencanakan dan melaksanakan bimbingan, mengevaluasi dan menilai hasil bimbingan, menganalisis hasil bimbingan, 
		melaksanakan tindak lanjut hasil pembimbingan
	</td>
	<td>
		06
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_06" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_06" disabled >
	</td>
</tr>
<tr>
	<td width="2%" rowspan="14" valign="top" align="center">
		C.
	</td>
	<td>
		Melaksanakan tugas lain yang relevan dengan fungsi sekolah/madrasah
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		1. Menjadi Kepala Sekolah/Madrasah per tahun
	</td>
	<td>
		07
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_07" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_07" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		2. Menjadi Wakil Kepala Sekolah/Madrasah per tahun
	</td>
	<td >
		08
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_08" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_08" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		3. Menjadi ketua program keahlian/program studi atau yang &nbsp;&nbsp;&nbsp;&nbsp;sejenisnya
	</td>
	<td>
		09
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_09" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field"id="akf_09" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		4. Menjadi Kepala Perpustakaan
	</td>
	<td>
		10
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_10" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_10" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		5. Menjadi kepala laboratorium, bengkel, unit produksi atau &nbsp;&nbsp;&nbsp;&nbsp;yang sejenisnya
	</td>
	<td>
		11
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_11" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_11" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		6. Menjadi pembimbing khusus pada satuan pendidikan yang &nbsp;&nbsp;&nbsp;&nbsp;menyelenggarakan pendidian inklusi,
		pendidikan terpadu atau &nbsp;&nbsp;&nbsp;&nbsp;yang sejenisnya
	</td>
	<td>
		12
	</td>
	<td  align="center">
		<input type="text" class="ak_field"id="ak_12" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_12" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		7. Menjadi Wali Kelas
	</td>
	<td>
		13
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_13" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_13" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		8. Menyusun kurikulum pada satuan pendidikannya
	</td>
	<td>
		14
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_14" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_14" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		9. Menjadi pengawas penilaian dan evaluasi terhadap proses &nbsp;&nbsp;&nbsp;&nbsp;dan hasil belajar
		.(UAS dan UKK)
	</td>
	<td>
		15
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_15" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_15" disabled >
	</td>

</tr>
<tr>
	<td  style="padding-left:12px;">
		10. Membimbing guru pemula dalam program induksi
	</td>
	<td>
		15.a
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_15_a" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_15_a" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		11. Membimbing siswa dalam kegiatan ekstrakurikuler
	</td>
	<td>
		16
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_16" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_16" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		12. Menjadi pembimbing pada penyusunan publikasi ilmiah dan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;karya inovatif
	</td>
	<td>
		17
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_17" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_17" disabled >
	</td>
</tr>
<tr>
	<td  style="padding-left:12px;">
		13. Melaksanakan pembimbingan pada kelas yang menjadi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tanggungjawabnya(khusus guru kelas)
	</td>
	<td>
		18
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="ak_18" disabled >
	</td>
	<td  align="center">
		PAKET
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="akf_18" disabled >
	</td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="jm_pbt" disabled >
	</td>
</tr>
</table>
