<script>
$(document).ready(function () {
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	
	load_table_penunjang();
	disable_all();
//fungsi pengisian table penunjang
	function load_table_penunjang() {
		no_dupak		=	$("#no_dupak").val();
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_penunjang&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					$("#ak_64").val(data[0]);
					$("#f_64").val(data[1]);	
					$("#akf_64").val((data[1]*data[0]).toFixed(3));
					
					$("#ak_65").val(data[2]);
					$("#f_65").val(data[3]);	
					$("#akf_65").val((data[2]*data[3]).toFixed(3));
					
					$("#ak_66").val(data[4]);
					$("#f_66").val(data[5]);	
					$("#akf_66").val((data[4]*data[5]).toFixed(3));
					
					$("#ak_67").val(data[6]);
					$("#f_67").val(data[7]);	
					$("#akf_67").val((data[6]*data[7]).toFixed(3));
					
					$("#ak_68").val(data[8]);
					$("#f_68").val(data[9]);
					$("#akf_68").val((data[8]*data[9]).toFixed(3));
					
					$("#ak_69").val(data[10]);
					$("#f_69").val(data[11]);
					$("#akf_69").val((data[10]*data[11]).toFixed(3));
					
					$("#ak_70").val(data[12]);
					$("#f_70").val(data[13]);
					$("#akf_70").val((data[12]*data[13]).toFixed(3));
					
					$("#ak_71").val(data[14]);
					$("#f_71").val(data[15]);
					$("#akf_71").val((data[14]*data[15]).toFixed(3));
					
					$("#ak_72").val(data[16]);
					$("#f_72").val(data[17]);
					$("#akf_72").val((data[16]*data[17]).toFixed(3));
					
					$("#ak_73").val(data[18]);
					$("#f_73").val(data[19]);
					$("#akf_73").val((data[18]*data[19]).toFixed(3));
					
					$("#ak_74").val(data[20]);
					$("#f_74").val(data[21]);
					$("#akf_74").val((data[20]*data[21]).toFixed(3));
					
					$("#ak_75").val(data[22]);
					$("#f_75").val(data[23]);
					$("#akf_75").val((data[22]*data[23]).toFixed(3));
					
					$("#ak_76").val(data[24]);
					$("#f_76").val(data[25]);
					$("#akf_76").val((data[24]*data[25]).toFixed(3));
					
					$("#ak_77").val(data[26]);
					$("#f_77").val(data[27]);
					$("#akf_77").val((data[26]*data[27]).toFixed(3));
					
					$("#ak_78").val(data[28]);
					$("#f_78").val(data[29]);
					$("#akf_78").val((data[28]*data[29]).toFixed(3));
					
					$("#ak_79").val(data[30]);
					$("#f_79").val(data[31]);
					$("#akf_79").val((data[30]*data[31]).toFixed(3));
					
					$("#jm_penunjang").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[22]*data[23])+(data[24]*data[25])+(data[26]*data[27])+(data[28]*data[29])+
					(data[30]*data[31])+
					(data[20]*data[21])+(data[18]*data[19]) ).toFixed(3)
					
					
					
					
					);
					
					jm_p = $("#jm_pendidikan").val();
	
					
					if ($("#jm_pendidikan").val() != "0.000" ) {
							//alert(jm_p);
							$( "#f_isian_pendidikan" ).hide();
							$( "#data_pend_dupak" ).show();
					}
					
					}
		})
	}

	function disable_all(){
		$("#f_67").attr("disabled", true);
		$("#f_68").attr("disabled", true);
		$("#f_69").attr("disabled", true);
		$("#f_70").attr("disabled", true);
		$("#f_71").attr("disabled", true);
		$("#f_72").attr("disabled", true);
		$("#f_73").attr("disabled", true);
		$("#f_74").attr("disabled", true);
		$("#f_75").attr("disabled", true);
		$("#f_76").attr("disabled", true);
		$("#f_77").attr("disabled", true);
		$("#f_78").attr("disabled", true);
		$("#f_79").attr("disabled", true);
	}
	
	
	
 });
 </script>

 <script src="./js/custom_ajax.js"></script>
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
		UNSUR PENUNJANG
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
	<td width="2%" rowspan="25" valign="top" align="center">
		
	</td>
	<td colspan="2" class="isi" >
		PENUNJANG TUGAS GURU
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
	<td width="2%" rowspan="5" valign="top" align="center">
		A.
	</td>
	<td>
		Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang<BR>
		diampunya:
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
	<td>
		1. &nbsp;Memperoleh gelar/ijazah yang tidak sesuai dengan bidang
		<p style="margin-left:19px;"> yang diampunya:</p>
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
	<td style="padding-left:23px;">
		a. Doktor (S.3)
	</td>
	<td  align="center">
		64
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_64">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_64">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_64">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Pasca Sarjana (S.2)
	</td>
	<td  align="center">
		65
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_65">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled onkeypress="return angka(event)" id="f_65">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_65">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		c. Sarjana (S.1) / Diploma IV
	</td>
	<td  align="center">
		66
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_66">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled onkeypress="return angka(event)" id="f_66">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_66">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="13" valign="top" align="center">
		B.
	</td>
	<td>
		Melaksanakan kegiatan yang mendukung tugas guru 
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
	<td>
		a. &nbsp;Membimbing siswa dalam praktik kerja nyata 
		<p style="margin-left:19px;">/ praktik industri / ekstrakurikuler dan yang sejenisnya</p>
	</td>
	<td  align="center">
		67
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_67">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" maxlength="1" onkeypress="return angka(event)" id="f_67">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_67">
	</td>
</tr>
<tr>
	<td>
		b. &nbsp;Sebagai pengawas ujian penilaian dan evaluasi 
		<p style="margin-left:19px;">terhadap proses dan hasil belajar tingkat : </p>
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
	<td style="padding-left:23px;">
		1) Sekolah
	</td>
	<td  align="center">
		68
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_68">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_68">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_68">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		2) nasional
	</td>
	<td  align="center">
		69
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_69">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_69">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_69">
	</td>
</tr>
<tr>
	<td>
		c. &nbsp;Menjadi angota organisasi profesi, sebagai:
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
	<td style="padding-left:23px;">
		1) Pengurus Aktif
	</td>
	<td  align="center">
		70
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_70">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_70">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_70">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		2) Anggota Aktif
	</td>
	<td  align="center">
		71
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_71">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_71">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_71">
	</td>
</tr>
<tr>
	<td>
		d. &nbsp;Menjadi anggota kegiatan kepramukaan, sebagai:
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
	<td style="padding-left:23px;">
		1) Pengurus Aktif
	</td>
	<td  align="center">
		72
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_72">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_72" >
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_72">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		2) Anggota Aktif
	</td>
	<td  align="center">
		73
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_73">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_73">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_73">
	</td>
</tr>
<tr>
	<td>
		e. &nbsp;Menjadi Tim Penilai Angka Kredit:
	</td>
	<td  align="center">
		74
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_74">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_74">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_74">
	</td>
</tr>
<tr>
	<td>
		f. &nbsp;Menjadi tutor / pelatih / instruktur ( per 2 jam pelajaran )
	</td>
	<td  align="center">
		75
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_75">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_75">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_75">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="6" valign="top" align="center">
		C.
	</td>
	<td>
		Perolehan penghargaan/tanda jasa
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
	<td>
		1. &nbsp;Memperoleh penghargaan / tanda jasa Satya Lancana 
		<p style="margin-left:19px;">Karya Satya</p>
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
	<td style="padding-left:23px;">
		a. 30 (tiga puluh) tahun
	</td>
	<td  align="center">
		76
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_76">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_76">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_76">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		a. 20 (dua puluh) tahun
	</td>
	<td  align="center">
		77
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_77">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_77">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_77">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		a. 10 (sepuluh) tahun
	</td>
	<td  align="center">
		78
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_78">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_78">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_78">
	</td>
</tr>
<tr>
	<td>
		2. &nbsp;Memperoleh Penghargaan/tanda jasa
	</td>
	<td  align="center">
		79
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_79">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" onkeypress="return angka(event)"  maxlength="1" id="f_79">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_79">
	</td>
</tr>
<tr>
	<td colspan="3" class="isi" style="padding-left:58px;">
		JUMLAH UNSUR PENUNJANG
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="jm_penunjang" disabled >
	</td>
</tr>
</table>
