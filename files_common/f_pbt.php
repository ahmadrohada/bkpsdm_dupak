<script>
$(document).ready(function () {

	//$("html, body").animate({ scrollTop: 160 }, "slow");
	
	$( "#load_add_pbt" ).hide();
	$( "#load_lanjut_pbt" ).hide();
	$("#ralat_pbt" ).hide();
	load_table_pbt();
	
	
	
		//cek step ,, hanya untuk hiden form isisan saja
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					if ( data[0] >= 3 ){
						//alert("sudah tahap ini");
						$( "#tab_pbt" ).hide();
						$("#lanjut_pbt" ).hide();
						$("#ralat_pbt" ).show();
						
						
						
					}
					
					$( "#progressbar" ).progressbar({value: +data[2]  });
					//alert(data[2]);
					}
    })
	
	/**
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=validasi_dupak&nip_baru="+nip_baru+"&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
		data=msg.split("|");
			//alert(msg);
			if (msg == 'valid') {
				
			isi_data_pbt();
			
		
        } else if (msg == 'invalid') {
			alert("Data Dupak tidak Valid");
			
		}
		}
	})
	**/
	
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

	
	
	
	$("#tugas_tambahan_2").attr("disabled", true);
	$("#tugas_tambahan_1").attr("disabled", true);
	$("#tugas_mengajar").attr("disabled", true);
	$("#edit_pbt" ).hide();
	
	//cek apakah pbt ajuan sudah ada
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_dupak&no_dupak="+no_dupak,
        cache:false,
        success:function(msg){
			data=msg.split("|");
			//alert(msg);
			//alert(data[21]);
			if (data[21] != ""){
				//pbt baru sudah diajukan... tampilkan detail
				//detail pbt ajuan
				isi_data_pbt();
				$("#lanjut_pbt").attr("disabled", false);
				
			}else{
				//BELUM ADA PENGAJUAN pkg
				detail_pbt_guru();
				$("#lanjut_pbt").attr("disabled", true);
			}
			


			
		}
    })
	
	
	
	function detail_pbt_guru(){
			
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							
							
								//isi field pada form_data_guru
								$("#d_tugas_mengajar").val(data[23]);
								$("#d_jenis_guru").val(data[20]);
								$("#d_golongan").val(data[19]);
								$("#d_tmt_gol").val(data[24]);
								$("#d_kode_pbt").val(data[22]);
								
							
							
                        }
                    })
	}	
	
	
	$("#d_golongan").change(function(){
		pkg			= $("#d_hasil_pkg").val();
		nilai 		= $("#d_hasil_pkg").val();
		golongan	= $("#d_golongan").val();
		//alert(pkg);
		
		if ( pkg == "0" ) {
			$("#d_ak_pkg").val("0.000");	
			$("#tugas_tambahan_2").attr("disabled", true);
			$("#tugas_tambahan_1").attr("disabled", true);
			$("#tugas_mengajar").attr("disabled", true);
		}else{
			$("#tugas_tambahan_2").attr("disabled", false);
			$("#tugas_tambahan_1").attr("disabled", false);
			$("#tugas_mengajar").attr("disabled", false);
		
		}
		
			//alert (kode_kegiatan);
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=ambil_ak_pkg&nilai="+nilai+"&golongan="+golongan,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					$("#d_ak_pkg").val(msg);	
					hitung_ak_jenis_guru();
					}
			})
	
		$("#tugas_tambahan_1").focus();
	
	})
	
	$("#d_hasil_pkg").change(function(){
		pkg			= $("#d_hasil_pkg").val();
		nilai 		= $("#d_hasil_pkg").val();
		golongan	= $("#d_golongan").val();
		//alert(pkg);
		
		if ( pkg == "0" ) {
			$("#d_ak_pkg").val("0.000");	
			$("#tugas_tambahan_2").attr("disabled", true);
			$("#tugas_tambahan_1").attr("disabled", true);
			$("#tugas_mengajar").attr("disabled", true);
		}else{
			$("#tugas_tambahan_2").attr("disabled", false);
			$("#tugas_tambahan_1").attr("disabled", false);
			$("#tugas_mengajar").attr("disabled", false);
		
		}
		
			//alert (kode_kegiatan);
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=ambil_ak_pkg&nilai="+nilai+"&golongan="+golongan,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					$("#d_ak_pkg").val(msg);	
					hitung_ak_jenis_guru();
					}
			})
	
		$("#tugas_tambahan_1").focus();
	})
	
	$("#tugas_tambahan_1").change(function(){
	if ( $("#tugas_tambahan_1").val() == $("#tugas_tambahan_2").val() ) {
		alert("Tugas Tambahan tidak boleh sama");
		$("#tugas_tambahan_1").val("");
	}
		hitung_ak_jenis_guru();
		$("#tugas_tambahan_2").focus();
	})
	
	$("#tugas_tambahan_2").change(function(){
	
	if ( $("#tugas_tambahan_1").val() == $("#tugas_tambahan_2").val() ) {
		alert("Tugas Tambahan tidak boleh sama");
		$("#tugas_tambahan_2").val("");
	}
		hitung_ak_jenis_guru();
	})
	
	
	function hitung_ak_jenis_guru(){
		ak		= $("#d_ak_pkg").val();
		tugas_1	= $("#tugas_tambahan_1").val();
		tugas_2	= $("#tugas_tambahan_2").val();
		
		$.ajax({
						url:"./kelas/proses.php",
                        data:"op=ak_pbt&ak="+ak+"&tugas_1="+tugas_1+"&tugas_2="+tugas_2,
                        cache:false,

                        success:function(msg){
							data=msg.split("|");
							//alert (msg);
							$("#d_ak_jenis_guru").val(data[0]);
							$("#ak_tugas_1").val(data[1]);
							$("#ak_tugas_2").val(data[2]);
							$("#f_jm_pbt").val(data[3]);
						
                        }
                    })
	
	}
	
	
	
	$("#d_tugas_mengajar").change(function(){
		kd_jenis_guru=$("#d_tugas_mengajar").val();
		//alert(kd_jenis_guru);
		
		if ( kd_jenis_guru == "" ){
			$("#d_jenis_guru").val("");
			$("#d_kode_pbt").val("");
		}else{
				$.ajax({
						url:"./kelas/proses.php",
                        data:"op=tugas_mengajar&kd_jenis_guru="+kd_jenis_guru,
                        cache:false,

                        success:function(msg){
							//alert(msg);
							data=msg.split("|");
							$("#d_jenis_guru").val(data[0]);
							$("#d_kode_pbt").val(data[1]);
							hitung_ak_jenis_guru();
						
                        }
                    })
			
		}
		

	})
	
	
	$("#simpan_pbt").click(function(){
		//alert("tes");
		tugas_mengajar	 	=	$("#d_tugas_mengajar").val();
		kode_pbt 			=	$("#d_kode_pbt").val();
		ak_jenis_guru 		=	$("#d_ak_jenis_guru").val();
		
		
		tugas_tambahan_1 	=	$("#tugas_tambahan_1").val();
		ak_tugas_1 			=	$("#ak_tugas_1").val();
		
		tugas_tambahan_2 	=	$("#tugas_tambahan_2").val();
		ak_tugas_2 			=	$("#ak_tugas_2").val();
		
		no_dupak		=	$("#no_dupak").val();
		nip_baru		=	$("#nip_baru").val();
		
		pkg				=	$("#d_hasil_pkg").val();
		
		//gol
		golongan	= $("#d_golongan").val();
		tmt_gol		= $("#d_tmt_gol").val();
		
		ak_pkg		= $("#d_ak_pkg").val();
		
		//alert(kode_pbt);
		
		if (ak_pkg == "" ){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Hasil PKG belum dipilih</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#d_hasil_pkg").focus();
					}
				}
			});
			
		
		}else if (tugas_mengajar == "" ){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Pilih Tugas Mengajar</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#d_tugas_mengajar").focus();
					}
				}
			});
		}else if (tmt_gol == "00-00-0000" ){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"TMT Gol masih kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#d_tmt_gol").focus();
					}
				}
			});
		}else{
		
		
			$( "#load_add_pbt" ).show();
			//alert (kode_kegiatan);
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=add_pbt&no_dupak="+no_dupak+
										"&kd_jenis_guru="+tugas_mengajar+
										"&kode_pbt="+kode_pbt+
										"&ak_jenis_guru="+ak_jenis_guru+
										"&tugas_tambahan_1="+tugas_tambahan_1+
										"&ak_tugas_1="+ak_tugas_1+
										"&tugas_tambahan_2="+tugas_tambahan_2+
										"&ak_tugas_2="+ak_tugas_2+
										"&golongan="+golongan+
										"&tmt_gol="+tmt_gol+
										"&pkg="+pkg,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					//$("#ak").val(msg);	
					load_table_pbt();
					$( "#load_add_pbt" ).hide();
					$( "#tab_pbt" ).accordion({collapsible: true,active : false});
					$("#lanjut_pbt").attr("disabled", false);
					//$("html, body").animate({ scrollTop: 600 }, "slow");
					//$("#lanjut_pbt").focus();
					}
			})
		} //end if
	
		
	})
	

	
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
	
	
		$("#lanjut_pbt").click(function(){
		$( "#load_lanjut_pbt" ).show();
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=update_step&step=3&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					//window.location.assign("?page=form_usulan_dupak&no_dupak="+no_dupak+"&nip_baru="+nip_baru);
					//window.location.reload();
					$( "#load_lanjut_pbt" ).hide();
					
					$( "#tab_new_dupak" ).tabs( "enable", 5 );
					$( "#tab_new_dupak" ).tabs( "option", "active", 5 );
					
					}
			})
	 });
	 
	 
	 $( "#tab_pbt" ).accordion({
		collapsible: true,
		active : false,
		heightStyle: "content",
		header:"div.head_acor"
		
    });
	
	 $("#ralat_pbt").click(function(){
		$( "#tab_pbt" ).show();
		$( "#tab_pbt" ).accordion({collapsible: false,active : true});
		$("#ralat_pbt" ).hide();
		$("html, body").animate({ scrollTop: 200 }, "slow");
	 });
	
});
</script>

<script src="./js/custom_ajax.js"></script>

<?php

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';

?>




<div id="tab_pbt" style="width:732px; margin-left:30px;">
	<div class="head_acor" style="padding:8px 0 8px 30px;">FORM USULAN PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU</div>
	<div id="">
	
        <table width="100%" class="form" border="0">
			<tr>
                <td width="20%">Hasil PKG / AK</td>
                <td width="60%">
				&nbsp;&nbsp;
					<select id="d_hasil_pkg"  >
					<option value="Amat Baik">Amat Baik</option>
					<option value="Baik" >Baik</option>
					<option value="Cukup">Cukup</option>
					<option value="Sedang">Sedang</option>
					<option value="Kurang" selected>Kurang</option>
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
					<select id="d_tugas_mengajar"  >
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
					<select id="d_golongan"  >
						<?php
							Connect::getConnection();
							$row = mysql_query("SELECT DISTINCT nm_gol FROM kd_dupak_pkg ");
							while ($r = mysql_fetch_array($row)){
						?>	
						<option value="<?php echo $r['nm_gol']; ?>" ><?php echo $r['nm_gol']; ?></option>
						<?php
						}
						 
						?>
					</select>
					/ <input type="text" size="10px" id="d_tmt_gol" placeholder="dd-mm-yyyy" >
                </td>
				<td></td>
			</tr>
			
			<tr>
                <td rowspan="2" valign="top">Tugas Tambahan</td>
                <td>
				1. &nbsp;&nbsp;
					<select id="tugas_tambahan_1" >
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
					<select id="tugas_tambahan_2"  >
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
		<table style="margin:10px 0 5px 10px;" border="0">
		<tr>
		<td>
			<button class="ui-state-default simpan" id="simpan_pbt" >SIMPAN</button>
			<img src="images/loader/load1.gif" id="load_add_pbt" />
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

<table style="width:732px; margin-left:30px;" border="0">
<tr>
	<td colspan="2">
		<button class="ui-state-default kirim" id="lanjut_pbt" >LANJUT</button>
		<button class="ui-state-default ralat" id="ralat_pbt" >RALAT DATA</button>
		<img src="images/loader/load1.gif" id="load_lanjut_pbt" />
	</td>
</tr>
</table>