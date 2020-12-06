<script>
$(document).ready(function () {
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	
	no_dupak		=	$("#no_dupak").val();
	
	
	
	
	load_table_pend();
	detail_pend_lama()
	load_pend_baru();
	
	//cek apakah pendidikan ajuan sudah ada
	function load_pend_baru(){
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_dupak&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
			data=msg.split("|");
			//alert(msg);
			if (data[12] != ""){
				//pend baru sudah diajukan... tampilkan detail dan button edit
				//detail pendidikan ajuan
				$( "#ubah_pendidikan" ).show();
				$( "#tambah_pendidikan" ).hide();
				
					$.ajax({
						url:"./kelas/detail.php",
						data:"op=detail_pendidikan_dupak&no_dupak="+no_dupak,
						cache:false,
						success:function(msg){
						
						q=msg.split("|");
						//alert(msg);
		
						$("#unsur").val(q[0]);
						$("#kegiatan").load("./kelas/proses.php","op=cb_kegiatan_pend&unsur="+q[0]+"&kd="+q[1]);
						$("#ak").val(q[2]);
						$("#f_jurusan").val(q[3]);
						$("#f_th_lulus").val(q[4]);
						$("#f_gelar_dpn").val(q[5]);
						$("#f_gelar_blk").val(q[6]);
						
						//disabled field pengajuan pendidikan
						$("#kegiatan").attr("disabled", true);
						$("#kegiatan").attr("disabled", true);
						$("#f_jurusan").attr("disabled", true);
						$("#f_gelar_dpn").attr("disabled", true);
						$("#f_gelar_blk").attr("disabled", true);
						$("#f_th_lulus").attr("disabled", true);
						
						}
					})
					//$("#ralat_pendidikan" ).show();
				
			}else{
				//belum ada pengajuan pend baru ... tampilkan form pendidikan baru
				
			}
			


			
		}
    })
	
	}
	

	
	
	//fungsi pengisian table pendidikan
	function load_table_pend() {
		no_dupak		=	$("#no_dupak").val();
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_pendidikan&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					$("#ak_01").val(data[0]);
					$("#f_01").val(data[1]);	
					$("#akf_01").val(data[1]*data[0]);
					
					$("#ak_01_1").val(data[2]);
					$("#f_01_1").val(data[3]);
					$("#akf_01_1").val(data[2]*data[3]);
					
					$("#ak_02").val(data[4]);
					$("#f_02").val(data[5]);
					$("#akf_02").val(data[4]*data[5]);
					
					$("#ak_02_1").val(data[6]);
					$("#f_02_1").val(data[7]);
					$("#akf_02_1").val(data[6]*data[7]);
					
					$("#ak_03").val(data[8]);
					$("#f_03").val(data[9]);
					$("#akf_03").val(data[8]*data[9]);
					
					$("#ak_03_1").val(data[10]);
					$("#f_03_1").val(data[11]);
					$("#akf_03_1").val(data[10]*data[11]);
					
					$("#ak_03_2").val(data[12]);
					$("#f_03_2").val(data[13]);
					$("#akf_03_2").val(data[12]*data[13]);
					
					$("#ak_03_3").val(data[14]);
					$("#f_03_3").val(data[15]);
					$("#akf_03_3").val(data[14]*data[15]);
					
					$("#ak_03_3_1").val(data[16]);
					$("#f_03_3_1").val(data[17]);
					$("#akf_03_3_1").val(data[16]*data[17]);
					
					$("#ak_03_3_3").val(data[18]);
					$("#f_03_3_3").val(data[19]);
					$("#akf_03_3_3").val(data[18]*data[19]);
					
					$("#ak_04").val(data[20]);
					$("#f_04").val(data[21]);
					$("#akf_04").val(data[20]*data[21]);
					
					$("#jm_pendidikan").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[20]*data[21])+(data[18]*data[19]) ).toFixed(3)
					
					);
					
					//ceked
					if ( $("#f_04").val()== "1" ) {
							$('#pelatihan')[0].checked=true;
						} else {
							$('#pelatihan')[0].checked=false;
						}
					
					
					
					}
		})
	}

	
	
	function detail_pend_lama(){
		$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_pak_lama&id_pegawai="+id_pegawai,
        cache:false,
            success:function(msg){
			//alert(msg);
			data=msg.split("|");
				
				$("#jenjang_lama").val(data[60]);
				$("#jurusan_lama").val(data[21]);
				$("#th_lulus_lama").val(data[22]);
				
				$("#nama_lama").val(data[68]);
				$("#f_nama").val(data[68]);
				$("#gelar_dpn_lama").val(data[66]);
				$("#gelar_blk_lama").val(data[67]);
				
				//alert(data[65]);
            }
        })
		}
	
	$( "#tab_pend" ).accordion({
		collapsible: true,
		active : false,
		heightStyle: "content",
		header:"div.head_acor"
		
    });

	

 });
 </script>

<script src="./js/custom_ajax.js"></script>

<div id="tab_pend" style="width:732px; margin-left:30px;">
	<div class="head_acor" style="padding:8px 0 8px 30px;">DATA USULAN PENDIDIKAN</div>
	<div id="">
	
		<table width="95%" class="form" border="0">
		<tr>
			<th colspan="2" class="isi">
				DATA PENDIDIKAN LAMA
			</th>
		</tr>
		<tr>
			<td width="30%">
				Jenjang
			</td>
			<td>
			&nbsp;&nbsp;
			<input type="text" id="jenjang_lama" size="38px" disabled >
			</td>
		</tr>
		<tr>
            <td>Jurusan/Tahun Lulus</td>
			<td>
				&nbsp;&nbsp;
				<input type="text" size="38px" id="jurusan_lama" placeholder="Jurusan " disabled> &nbsp;<input type="text" size="4px" onkeypress="return angka(event)" placeholder="Tahun Lulus" id="th_lulus_lama" disabled >
            </td>
		</tr>
		<tr>
            <td>Gelar Depan/Belakang</td>
			<td>
				&nbsp;&nbsp;
				<input type="text" size="8px" id="gelar_dpn_lama" placeholder="Glr Dpn" disabled>
				<input type="text" size="35px" id="nama_lama" disabled>
				<input type="text" size="8px"  id="gelar_blk_lama" placeholder="Glr blk" disabled>
            </td>
		</tr>
			<tr>
            <td colspan="2"></td>
		</tr>
		<tr>
			<th colspan="2" class="isi">
				DATA PENDIDIKAN YANG DIAJUKAN
			</th>
		</tr>
		
		
		
		<tr>
			<td>
				Unsur
			</td>
			<td>
			&nbsp;&nbsp;
			<select id="unsur" style="min-width:135px;" disabled>
				<option value=""></option>
				<option value="1">UNSUR UTAMA</option>
				<option value="2">UNSUR PENUNJANG</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Jenjang / AK</td>
			<td>
			&nbsp;&nbsp;
			<select id="kegiatan" style="min-width:285px;"></select>
			&nbsp;&nbsp;
			<input type="text" placeholder="AK" id="ak" size="10px" disabled >
			</td>
		</tr>
		<tr>
            <td>Jurusan/Tahun Lulus</td>
			<td>
				&nbsp;&nbsp;
				<input type="text" size="38px" id="f_jurusan" placeholder="Jurusan "> &nbsp;<input type="text" size="4px" onkeypress="return angka(event)" maxlength="4" placeholder="Tahun Lulus" id="f_th_lulus" >
            </td>
		</tr>
		<tr>
            <td>Gelar Depan/Belakang</td>
			<td>
				&nbsp;&nbsp;
				<input type="text" size="8px" id="f_gelar_dpn" placeholder="Glr Dpn">
				<input type="text" size="35px" id="f_nama" disabled>
				<input type="text" size="8px"  id="f_gelar_blk" placeholder="Glr blk">
            </td>
		</tr>
		
		
		
		</table>
	</div>
      


	<div class="head_acor" style="padding:8px 0 8px 30px;">DATA USULAN PELATIHAN PRAJABATAN</div>
	<div id="" style="height:105px;">
		<table width="90%" class="form" border="0">
		<tr>
			<td class="isi" style="padding:15px;">
				<input type="checkbox" id="pelatihan" />
				<p style="margin:-13px 0 0 20px;">Pelatihan prajabatan fungsional bagi Guru Calon Pegawai Negeri Sipil / program induksi</p>
			</td>
		</table>
		<p style="font-size:7pt; margin:-1px 0 0 23px;">
	   * centang jika pernah melakukan Pelatihan Prajabatan
	   </p>
		<table style="margin:10px 0 5px 20px;" border="0">
		</table>

	</div>
</div>
<br>






<table class="form" style="width:732px; margin-left:30px;" >
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
	<td width="2%" rowspan="14" valign="top" align="center">
		1.
	</td>
	<td colspan="2" class="isi" >
		PENDIDIKAN
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
	<td width="2%" rowspan="11" valign="top" align="center">
		A.
	</td>
	<td  >
		Mengikuti Pendidikan dan memperoleh gelar/ijazah/akta
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
	<td  style="padding-left:30px;">
		a. Doktor (S-3)
	</td>
	<td>
		01
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_01">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled maxlength="1" id="f_01">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_01">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		b. Doktor (S-3) dari Magister (S-2)
	</td>
	<td>
		01.1
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_01_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_01_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_01_1">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		c. MAGISTER (S.2)
	</td>
	<td>
		02
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_02">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_02">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_02">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		d. MAGISTER (S-2) dari Sarjana (S-1)
	</td>
	<td>
		02.1
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_02_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_02_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_02_1">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		e. Sarjana (S-1) / Diploma IV
	</td>
	<td>
		03
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_03">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_03">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_03">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		f. Sarjana (S-1) dari Sarmud / Diploma-III
	</td>
	<td>
		03.1
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_03_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_03_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_03_1">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		g. Sarjana (S-1) dari D-II/PGSLA/SGPLB
	</td>
	<td>
		03.2
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_03_2">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_03_2">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_03_2">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		h. Sarjana (S-1) dari D-I/PGSLTP/SMTA
	</td>
	<td>
		03.3
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_03_3">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_03_3">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_03_3">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		i. Sarjana Muda/Diploma III
	</td>
	<td>
		03.3.1
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_03_3_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_03_3_1">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_03_3_1">
	</td>
</tr>
<tr>
	<td  style="padding-left:30px;">
		j. Sarjana Muda/Diploma-III dari Diploma-II/SGPLB
	</td>
	<td>
		03.3.3
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_03_3_3">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_03_3_3">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_03_3_3">
	</td>
</tr>
<tr>
	<td width="2%" valign="top" align="center">
		B.
	</td>
	<td  >
		Mengikuti Pelatihan Prajabatan<br>
		<p style="margin-left:23px"> Pelatihan Prajabatan Fungsional bagi Guru Calon Pegawai Negeri Sipil / Program Induksi</p>
	</td>
	<td>
		04
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_04">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_04">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_04">
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
		<input type="text" class="ak_field" disabled id="jm_pendidikan">
	</td>
</tr>
</table>

