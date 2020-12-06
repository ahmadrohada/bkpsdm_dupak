<script>
$(document).ready(function () {
	$( "#load_add_pbt" ).hide();
	$( "#load_simpan_pbt" ).hide();
	$( "#simpan_pbt" ).hide();
	$( "#load_lanjut_pbt" ).hide();
	
	$("#d_hasil_pkg").attr("disabled", true);
	$("#d_tugas_mengajar").attr("disabled", true);
	$("#d_golongan").attr("disabled", true);
	$("#d_tmt_gol").attr("disabled", true);
	$("#tugas_tambahan_2").attr("disabled", true);
	$("#tugas_tambahan_1").attr("disabled", true);
	$("#tugas_mengajar").attr("disabled", true);
	
	load_table_pbt();
	load_penilai_pbt1();
	load_penilai_pbt2();
	
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
				
			}else{
				//BELUM ADA PENGAJUAN pkg
				detail_pbt_guru();
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
		
		
		
		//alert(kode_pbt);
		
		if (pkg == "" ){
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
					$("#d_hasil_pkg").attr("disabled", true);
					$("#d_tugas_mengajar").attr("disabled", true);
					$("#d_golongan").attr("disabled", true);
					$("#d_tmt_gol").attr("disabled", true);
					$("#tugas_tambahan_2").attr("disabled", true);
					$("#tugas_tambahan_1").attr("disabled", true);
					$("#tugas_mengajar").attr("disabled", true);
					
					$("#ralat_pbt" ).show();
					$("#simpan_pbt" ).hide();
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
					if ( data[0] != 0.000){$('.c_05').css('background','#fefeaf');}
					
					$("#ak_06").val(data[1]);
					$("#akf_06").val(data[1]);
					if ( data[1] != 0.000){$('.c_06').css('background','#fefeaf');}
					
					$("#ak_07").val(data[2]);
					$("#akf_07").val(data[2]);
					if ( data[2] != 0.000){$('.c_07').css('background','#fefeaf');}
					
					$("#ak_08").val(data[3]);
					$("#akf_08").val(data[3]);
					if ( data[3] != 0.000){$('.c_08').css('background','#fefeaf');}
					
					$("#ak_09").val(data[4]);
					$("#akf_09").val(data[4]);
					if ( data[4] != 0.000){$('.c_09').css('background','#fefeaf');}
					
					$("#ak_10").val(data[5]);
					$("#akf_10").val(data[5]);
					if ( data[5] != 0.000){$('.c_10').css('background','#fefeaf');}
					
					$("#ak_11").val(data[6]);
					$("#akf_11").val(data[6]);
					if ( data[6] != 0.000){$('.c_11').css('background','#fefeaf');}
					
					$("#ak_12").val(data[7]);
					$("#akf_12").val(data[7]);
					if ( data[7] != 0.000){$('.c_12').css('background','#fefeaf');}
					
					$("#ak_13").val(data[8]);
					$("#akf_13").val(data[8]);
					if ( data[8] != 0.000){$('.c_13').css('background','#fefeaf');}
					
					$("#ak_14").val(data[9]);
					$("#akf_14").val(data[9]);
					if ( data[9] != 0.000){$('.c_14').css('background','#fefeaf');}
					
					$("#ak_15").val(data[10]);
					$("#akf_15").val(data[10]);
					if ( data[10] != 0.000){$('.c_15').css('background','#fefeaf');}
					
					$("#ak_15_a").val(data[11]);
					$("#akf_15_a").val(data[11]);
					if ( data[11] != 0.000){$('.c_15_a').css('background','#fefeaf');}
					
					$("#ak_16").val(data[12]);
					$("#akf_16").val(data[12]);
					if ( data[12] != 0.000){$('.c_16').css('background','#fefeaf');}
					
					$("#ak_17").val(data[13]);
					$("#akf_17").val(data[13]);
					if ( data[13] != 0.000){$('.c_17').css('background','#fefeaf');}
					
					$("#ak_18").val(data[14]);
					$("#akf_18").val(data[14]);
					if ( data[14] != 0.000){$('.c_18').css('background','#fefeaf');}
					
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
		$("#d_hasil_pkg").attr("disabled", false);
		$("#d_tugas_mengajar").attr("disabled", false);
		$("#d_golongan").attr("disabled", false);
		$("#d_tmt_gol").attr("disabled", false);
		$("#tugas_tambahan_2").attr("disabled", false);
		$("#tugas_tambahan_1").attr("disabled", false);
		$("#tugas_mengajar").attr("disabled", false);
		 
		$("#ralat_pbt" ).hide();
		$("#simpan_pbt" ).show();
		
	 });
	
	function load_penilai_pbt1() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=pbt1&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p1_05").html("<img src="+data[0]+">");
					$("#p1_06").html("<img src="+data[1]+">");
					$("#p1_07").html("<img src="+data[2]+">");
					$("#p1_08").html("<img src="+data[3]+">");
					$("#p1_09").html("<img src="+data[4]+">");
					$("#p1_10").html("<img src="+data[5]+">");
					$("#p1_11").html("<img src="+data[6]+">");
					$("#p1_12").html("<img src="+data[7]+">");
					$("#p1_13").html("<img src="+data[8]+">");
					$("#p1_14").html("<img src="+data[9]+">");
					$("#p1_15").html("<img src="+data[10]+">");
					$("#p1_15_a").html("<img src="+data[11]+">");
					$("#p1_16").html("<img src="+data[12]+">");
					$("#p1_17").html("<img src="+data[13]+">");
					$("#p1_18").html("<img src="+data[14]+">");
					
					
					
					
					}
		})
	}
	
	function load_penilai_pbt2() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=pbt2&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p2_05").html("<img src="+data[0]+">");
					$("#p2_06").html("<img src="+data[1]+">");
					$("#p2_07").html("<img src="+data[2]+">");
					$("#p2_08").html("<img src="+data[3]+">");
					$("#p2_09").html("<img src="+data[4]+">");
					$("#p2_10").html("<img src="+data[5]+">");
					$("#p2_11").html("<img src="+data[6]+">");
					$("#p2_12").html("<img src="+data[7]+">");
					$("#p2_13").html("<img src="+data[8]+">");
					$("#p2_14").html("<img src="+data[9]+">");
					$("#p2_15").html("<img src="+data[10]+">");
					$("#p2_15_a").html("<img src="+data[11]+">");
					$("#p2_16").html("<img src="+data[12]+">");
					$("#p2_17").html("<img src="+data[13]+">");
					$("#p2_18").html("<img src="+data[14]+">");
					
					
					
					
					}
		})
	}
	
	//simpan hasil penilaian
	$("#simpan_v_pbt").click(function(){
			$( "#load_simpan_pbt" ).show();
			$.ajax({
			url:"./kelas/verifikasi.php",
			data:"op=simpan_pbt&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					$( "#load_simpan_pbt" ).hide();
					$( "#tab_verifikasi_dupak" ).tabs( "enable", 5 );
					$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 5 );

					}
			})
	 });
	 
	 //Proses penilaian
	$(".kd_keg").click(function(){
		//alert();
		//$(this).focus().select();
		//alert($(this).val());
		$kd_keg = $(this).val();
		
	//cek dulu apakah kode kegiatan yang di klik ada Freq nya apa kagak
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=cek_f&no_dupak="+no_dupak+"&kd_keg="+$kd_keg,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					if ( msg == 0 ) {
						$("#dialog-confirm").html("<center>Mohon untuk menilai hanya pada kegiatan yang diajukan saja</center>");
						$("#dialog-confirm").dialog({
							show:"clip",
							hide:"clip",
							draggable:false,
							resizable: false,
							title: "SIPULPENPAKGURU",
							height: 170,
							width: 450,
							buttons: {
									"Tutup": function () {
									$(this).dialog('close');
								}
							}
						});	
					}else if ( msg >= 1 ) {
						verifikasi();
						
					}
					
					}
		})
	});
	
	
	function verifikasi(){
  $("#dialog-confirm").html("<center></center>");
    $("#dialog-confirm").dialog({
    	show:"clip",
		hide:"clip",
		draggable:false,
		resizable: false,
		modal: true,
		title  : 'SIPULPENPAKGURU',
		height: 100,
		width: 220,
        buttons: {
            "   Terima   ": function () {
					$(this).dialog('close');
					$.ajax({
					url:"./kelas/verifikasi.php",
					data:"op=terima_dupak&no_dupak="+no_dupak+"&kd_keg="+$kd_keg,
                    cache:false,
                    success:function(msg){
						//alert(msg);
						load_penilai_pbt1();
						load_penilai_pbt2();
					}
					})
				
				},
                "   Tolak  ": function () {
					$(this).dialog('close');
					$.ajax({
					url:"./kelas/verifikasi.php",
					data:"op=tolak_dupak&no_dupak="+no_dupak+"&kd_keg="+$kd_keg,
                    cache:false,
                    success:function(msg){
						load_penilai_pbt1();
						load_penilai_pbt2();
					}
					})
            }
        }
    });	
	}
	
	$.ajax({
	url:"./kelas/proses.php",
       data:"op=cek_step&no_dupak="+no_dupak,
			cache:false,
            success:function(msg){
			//alert(msg);
			data=msg.split("|");
			$( "#progressbar" ).progressbar({value: +data[2]});
			
				if ( (data[0] >= 19) || (((data[0] >=10) && (p == 1)) || ((data[0] >=16) && (p == 2 ))  ) ){
				//if ( (data[0] >=10) && (p == 1) || (data[0] >=16) && (p == 2 ) ){
					$("#simpan_v_pbt").hide();
					$("#ralat_pbt").hide();
					$(".kd_keg").attr("disabled", true);
				}
			}
	})
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
		<table style="margin:10px 0 5px 20px;" border="0">
		<tr>
		<td>
			<button class="ui-state-default simpan" id="simpan_pbt" style="margin-left:-10px;">SIMPAN</button>
			<button class="ui-state-default ralat" id="ralat_pbt" style="margin-left:-10px; ">RALAT</button>
			<img src="images/loader/load1.gif" id="load_add_pbt" />
		</td>
		</tr>
		</table>
	</div>
</div>


<br>

<table class="form" style="width:732px; margin-left:40px;">
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
	<th colspan="2" width="15%">
		Hasil Tim Penilai
	</th>
</tr>
<tr>
	<th width="5%">
		F
	</th>
	<th width="10%">
		A.K * F
	</th>
	<th width="7%">I</th>
	<th width="7%">II</th>
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
	<td  align="center">
	</td>
	<td  align="center">
	</td>
</tr>
<tr class="c_05">
	<td  style="padding-left:26px;">
		Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, 
		melaksanakan tindak lanjut hasil penilaian
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="05">
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
	<td  align="center">
		<span id="p1_05" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_05" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_06">
	<td  style="padding-left:26px;">
		Merencanakan dan melaksanakan bimbingan, mengevaluasi dan menilai hasil bimbingan, menganalisis hasil bimbingan, 
		melaksanakan tindak lanjut hasil pembimbingan
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="06">
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
	<td  align="center">
		<span id="p1_06" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_06" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_07">
	<td  style="padding-left:12px;">
		1. Menjadi Kepala Sekolah/Madrasah per tahun
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="07">
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
	<td  align="center">
		<span id="p1_07" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_07" class="nilai" ></span>
	</td>
</tr>
<tr class="c_08">
	<td  style="padding-left:12px;">
		2. Menjadi Wakil Kepala Sekolah/Madrasah per tahun
	</td>
	<td >
		<input type="text" class="kd_keg" readonly value="08">
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
	<td  align="center">
		<span id="p1_08" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_08" class="nilai" ></span>
	</td>
</tr>
<tr class="c_09">
	<td  style="padding-left:12px;">
		3. Menjadi ketua program keahlian/program studi atau 
		<p style="margin-left:14px">yang sejenisnya</p>
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="09">
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
	<td  align="center">
		<span id="p1_09" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_09" class="nilai" ></span>
	</td>
</tr>
<tr class="c_10">
	<td  style="padding-left:12px;">
		4. Menjadi Kepala Perpustakaan
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="10">
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
	<td  align="center">
		<span id="p1_10" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_10" class="nilai" ></span>
	</td>
</tr>
<tr class="c_11">
	<td  style="padding-left:12px;">
		5. Menjadi kepala laboratorium, bengkel, unit produksi
		<p style="margin-left:14px">yang sejenisnya</p>		
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="11">
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
	<td  align="center">
		<span id="p1_11" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_11" class="nilai" ></span>
	</td>
</tr>
<tr class="c_12">
	<td  style="padding-left:12px;">
		6. Menjadi pembimbing khusus pada satuan pendidikan
		<p style="margin-left:14px">yang menyelenggarakan pendidian inklusi,
		pendidikan terpadu atau yang sejenisnya</p>	
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="12">
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
	<td  align="center">
		<span id="p1_12" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_12" class="nilai" ></span>
	</td>
</tr>
<tr class="c_13">
	<td  style="padding-left:12px;">
		7. Menjadi Wali Kelas
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="13">
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
	<td  align="center">
		<span id="p1_13" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_13" class="nilai" ></span>
	</td>
</tr>
<tr class="c_14">
	<td  style="padding-left:12px;">
		8. Menyusun kurikulum pada satuan pendidikannya
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="14">
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
	<td  align="center">
		<span id="p1_14" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_14" class="nilai" ></span>
	</td>
</tr>
<tr class="c_15">
	<td  style="padding-left:12px;">
		9. Menjadi pengawas penilaian dan evaluasi terhadap
		<p style="margin-left:14px">proses dan hasil belajar.(UAS dan UKK)</p>	
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="15">
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
	<td  align="center">
		<span id="p1_15" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_15" class="nilai" ></span>
	</td>
</tr>
<tr class="c_15_a">
	<td  style="padding-left:12px;">
		10. Membimbing guru pemula dalam program induksi
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="15.a">
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
	<td  align="center">
		<span id="p1_15_a" class="nilai" ></span>
	</td>
		<td  align="center">
		<span id="p2_15_a" class="nilai" ></span>
	</td>
</tr>
<tr class="c_16">
	<td  style="padding-left:12px;">
		11. Membimbing siswa dalam kegiatan ekstrakurikuler
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="16">
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
	<td  align="center">
		<span id="p1_16" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_16" class="nilai" ></span>
	</td>
</tr>
<tr class="c_17">
	<td  style="padding-left:12px;">
		12. Menjadi pembimbing pada penyusunan publikasi 
		<p style="margin-left:20px">ilmiah dan karya inovatif</p>	
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="17">
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
	<td  align="center">
		<span id="p1_17" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_17" class="nilai" ></span>
	</td>
</tr>
<tr class="c_18">
	<td  style="padding-left:12px;">
		13. Melaksanakan pembimbingan pada kelas yang
		<p style="margin-left:20px">menjadi tanggungjawabnya(khusus guru kelas)</p>
	</td>
	<td>
		<input type="text" class="kd_keg" readonly value="18">
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
	<td  align="center">
		<span id="p1_18" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_18" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
</table>

<table style="width:732px; margin-left:40px;" border="0">
<tr>
	<td>
		<button class="ui-state-default lanjut" id="simpan_v_pbt" >SIMPAN DATA VERIFIKASI PBT</button>
		<img src="images/loader/load1.gif" id="load_simpan_pbt" />
	</td>
</tr>
</table>