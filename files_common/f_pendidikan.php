<script>
$(document).ready(function () {
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	
	$("#ralat_pendidikan" ).hide();
	$( "#load_add_pend" ).hide();
	$( "#load_add_pelatihan" ).hide();
	$( "#load_simpan_pend" ).hide();
	$( "#ubah_pendidikan" ).hide();
	no_dupak		=	$("#no_dupak").val();
	
	
	
	//cek step ,, hanya untuk hiden form isisan saja
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					if ( data[0] >= 2 ){
						//alert("sudah tahap ini");
						$( "#tab_pend" ).hide();
						$("#simpan_pendidikan" ).hide();
						$("#ralat_pendidikan" ).show();
						
					}
					$( "#progressbar" ).progressbar({value: +data[2]});
					
					}
    })
	
	
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
	
	
	
	
	$("#unsur").change(function(){
		//alert(cb_sub_unsur_pend);
		unsur=$("#unsur").val();
		//alert(unsur);
		
		$("#kegiatan").load("./kelas/proses.php","op=cb_kegiatan_pend&unsur="+unsur);
		$("#ak").val("");
			if (unsur != "" ){
				$("#kegiatan").attr("disabled", false);
				$("#kegiatan").focus();
			}else{
				$("#kegiatan").attr("disabled", true);
				$("#f_jurusan").attr("disabled", true);
				$("#f_gelar_dpn").attr("disabled", true);
				$("#f_gelar_blk").attr("disabled", true);
				$("#f_th_lulus").attr("disabled", true);
			}
    });
	
	$("#kegiatan").change(function(){
		kegiatan=$("#kegiatan").val();
		//alert(kegiatan);
		
		
		if (kegiatan != "" ){
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=cari_ak_pend&kode_kegiatan="+kegiatan,
						cache:false,
						success:function(msg){
						//alert (msg);
						$("#ak").val(msg);
						
						}
			})
			$("#f_jurusan").attr("disabled", false);
			$("#f_gelar_dpn").attr("disabled", false);
			$("#f_gelar_blk").attr("disabled", false);
			$("#f_th_lulus").attr("disabled", false);
			$("#f_jurusan").focus();
		}else{
			$("#f_jurusan").attr("disabled", true);
			$("#f_gelar_dpn").attr("disabled", true);
			$("#f_gelar_blk").attr("disabled", true);
			$("#f_th_lulus").attr("disabled", true);
			$("#ak").val("");
		}
		
	})
	
	$("#f_jurusan").change(function(){
		$("#f_th_lulus").focus();
    });
	
	$("#f_th_lulus").change(function(){
		$("#f_gelar_dpn").focus();
    });
	
	$("#f_gelar_dpn").change(function(){
		$("#f_gelar_blk").focus();
    });
	
	$("#tambah_pendidikan").click(function(){
		add_pend();
	})
	
	
	$("#ubah_pendidikan").click(function(){
		add_pend();
	})
	
	function add_pend(){
		unsur			= 	$("#unsur").val();
		kode_kegiatan 	=	$("#kegiatan").val();
		f			 	=	1;
		ak			 	=	$("#ak").val();
		no_dupak		=	$("#no_dupak").val();
		nip_baru		=	$("#nip_baru").val();
		
		jurusan			=	$("#f_jurusan").val();
		th_lulus		=	$("#f_th_lulus").val();
		gelar_dpn		=	$("#f_gelar_dpn").val();
		gelar_blk		=	$("#f_gelar_blk").val();
		
		//alert(th_lulus);
		
		if (unsur == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Pilih Unsur</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#unsur").focus();
					}
				}
			});
			
		}else if (kode_kegiatan == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Pilih jenjang pendidikan</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#kegiatan").focus();
					}
				}
			});
			
		}else if (jurusan == "" ) {
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Isi data jurusan</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#f_jurusan").focus();
					}
				}
			});
			
		}else if (th_lulus == "" ){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Isi data tahun lulus</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#f_th_lulus").focus();
					}
				}
			});
			
		
		}else{
			//alert (kode_kegiatan);
			$( "#load_add_pend" ).show();
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=add_pendidikan&kode_kegiatan="+kode_kegiatan+
												"&f="+f+
												"&ak="+ak+
												"&no_dupak="+no_dupak+
												"&jurusan="+jurusan+
												"&th_lulus="+th_lulus+
												"&gelar_dpn="+gelar_dpn+
												"&gelar_blk="+gelar_blk,
                    cache:false,
                    success:function(msg){
					//alert(msg);
					load_table_pend();
					$( "#load_add_pend" ).hide();
					load_pend_baru();
					//$( "#tab_pend" ).accordion({collapsible: true,active : false});
					}
			})
		
		}
		
	
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

	$("#simpan_pendidikan").click(function(){
			$( "#load_simpan_pend" ).show();
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=update_step&step=2&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					$( "#load_simpan_pend" ).hide();
					$( "#tab_new_dupak" ).tabs( "enable", 4 );
					$( "#tab_new_dupak" ).tabs( "option", "active", 4 );
					

					}
			})
	 });
	 
	 $("#ralat_pendidikan").click(function(){
		$( "#tab_pend" ).show();
		//$("#simpan_pendidikan" ).show();
		$("#ralat_pendidikan" ).hide();
		$( "#tab_pend" ).accordion({collapsible: false,active : false});
		$("html, body").animate({ scrollTop: 200 }, "slow");
	 });
	
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

	$('#pelatihan').click(function (){
		no_dupak		=	$("#no_dupak").val();
		$( "#load_add_pelatihan" ).show();
		
		pelatihan	= $(this).is(':checked');
		if ( pelatihan == true ) {
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=add_pelatihan&f=1&no_dupak="+no_dupak,
			cache:false,
				success:function(msg){
				 load_table_pend();
				$( "#load_add_pelatihan" ).hide();
				//$( "#tab_pend" ).accordion({collapsible: true,active : false});
            }
			})
			
		
		} else if ( pelatihan == false ){
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=add_pelatihan&f=0&no_dupak="+no_dupak,
			cache:false,
				success:function(msg){
				 load_table_pend();
				$( "#load_add_pelatihan" ).hide();
				//$( "#tab_pend" ).accordion({collapsible: true,active : false});
            }
			})
			
		
		}
	});

 });
 </script>

<script src="./js/custom_ajax.js"></script>

<div id="tab_pend" style="width:732px; margin-left:30px;">
	<div class="head_acor" style="padding:8px 0 8px 30px;">FORM USULAN PENDIDIKAN</div>
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
			<select id="unsur" style="min-width:135px;">
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
	
		<table style="margin:10px 0 5px 10px;" border="0">
		<tr>
			<td colspan="2">
				<button class="ui-state-default simpan" id="tambah_pendidikan" >SIMPAN</button>
				<button class="ui-state-default simpan" id="ubah_pendidikan" >SIMPAN</button>
				<img src="images/loader/load1.gif" id="load_add_pend" />
			</td>
		</tr>
		</table>
	</div>
      


	<div class="head_acor" style="padding:8px 0 8px 30px;">FORM USULAN PELATIHAN PRAJABATAN</div>
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
		<tr>
			<td>
				<img src="images/loader/load1.gif" id="load_add_pelatihan" />
			</td>
		</tr>
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

<table style="width:732px; margin-left:30px;" border="0">
<tr>
	<td>
		<button class="ui-state-default kirim" id="simpan_pendidikan" >LANJUT</button>
		<button class="ui-state-default ralat" id="ralat_pendidikan" >RALAT DATA</button>
		<img src="images/loader/load1.gif" id="load_simpan_pend" />
	</td>
</tr>
</table>