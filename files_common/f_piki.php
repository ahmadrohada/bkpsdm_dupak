<script>
$(document).ready(function () {
	//alert();
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	
	$("#ralat_piki" ).hide();
	$( ".load_add_piki" ).hide();
	$( "#load_simpan_piki" ).hide();
	$( "#add_piki_baru" ).hide();
	no_dupak		=	$("#no_dupak").val();
	
	$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
	
	$("#cb_kriteria_piki").load("./kelas/proses.php","op=cb_kriteria_piki");
	$("#cb_edit_kriteria_piki").load("./kelas/proses.php","op=cb_kriteria_piki");
	$("#cb_hapus_kriteria_piki").load("./kelas/proses.php","op=cb_kriteria_piki");
	
	//cek step ,, hanya untuk hiden form isisan saja
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					if ( data[0] >= 5 ){
						//alert("sudah tahap ini");
						$( "#tab_piki" ).hide();
						$("#simpan_piki" ).hide();
						$("#ralat_piki" ).show();
						
					}
					$( "#progressbar" ).progressbar({value: +data[2]  });
					}
    })
	
	
	load_table_piki();
	
	$("#btn_form_piki").click(function(){
		$( "#form_piki" ).dialog( "open" );
	});
	
	
	$( "#form_piki" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			title  : 'SIPULPENPAKGURU',
			height: 370,
			width: 650,
			buttons: {
				"Simpan Data": function() {
					//insert data
					judul_piki 				=	$("#judul_piki").val();
					th_piki					=	$("#th_piki").val();	
					kode_kegiatan			=	$("#kode_kegiatan").val();
					ak_piki					=	$("#ak_piki").val();
					no_dupak				=	$("#no_dupak").val();
					
					
					
				
					if ( judul_piki == ""){
						alert("Judul tidak boleh kosong");
						$("#judul_piki").focus();
					}else if ( th_piki == "" ){
						alert("Tahun tidak boleh kosong");
						$("#th_piki").focus();
					}else if ( kode_kegiatan == "" ){
						alert("Pilih Kriteria PIKI");
						$("#cb_kriteria_piki").focus();
					}else{
						//alert (kode_kegiatan);
						$(".load_add_piki").show();
						
						$.ajax({
						url:"./kelas/dupak.php",
						data:"op=add_piki&no_dupak="+no_dupak+
														"&judul_piki="+judul_piki+
														"&th_piki="+th_piki+
														"&kode_kegiatan="+kode_kegiatan+
														"&ak_piki="+ak_piki,
								cache:false,
								success:function(msg){
								load_table_piki();
								kosongkan_piki();
								$(".load_add_piki").hide();
								//$( "#tab_piki" ).accordion({collapsible: true,active : false});
								$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
								}
						})
					} // end else
					
					
					
					
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	$( "#form_edit_piki" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			title  : 'SIPULPENPAKGURU',
			height: 370,
			width: 650,
			buttons: {
				"Simpan Perubahan": function() {
					//insert data
					id_piki 				=	$("#edit_id_piki").val();
					judul_piki 				=	$("#edit_judul_piki").val();
					th_piki					=	$("#edit_th_piki").val();	
					kode_kegiatan			=	$("#sub_edit_kriteria_piki").val();
					ak_piki					=	$("#edit_ak_piki").val();
					no_dupak				=	$("#no_dupak").val();
					
					kode_kegiatan_awal		=	$("#edit_kode_kegiatan_piki_awal").val();
					ak_piki_awal			=	$("#edit_ak_piki_awal").val();
					
				
					//alert(kode_kegiatan_awal);
					if ( judul_piki == ""){
						alert("Judul tidak boleh kosong");
						$("#edit_judul_piki").focus();
					}else if ( th_piki == "" ){
						alert("Tahun tidak boleh kosong");
						$("#edit_th_piki").focus();
					}else if ( kode_kegiatan == "" ){
						alert("Pilih Kriteria PIKI");
						$("#cb_edit_kriteria_piki").focus();
					}else{
						//alert (kode_kegiatan);
						$(".load_add_piki").show();
						
						$.ajax({
						url:"./kelas/dupak.php",
						data:"op=edit_piki&no_dupak="+no_dupak+
														"&id_piki="+id_piki+
														"&judul_piki="+judul_piki+
														"&th_piki="+th_piki+
														"&kode_kegiatan_baru="+kode_kegiatan+
														"&ak_piki_baru="+ak_piki+
														"&kode_kegiatan_awal="+kode_kegiatan_awal+
														"&ak_piki_awal="+ak_piki_awal,
								cache:false,
								success:function(msg){
								//alert(msg);
								load_table_piki();
								kosongkan_piki();
								$(".load_add_piki").hide();
								//$( "#tab_piki" ).accordion({collapsible: true,active : false});
								$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
								}
						})
					} // end else
					
					
					
					
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	$( "#form_hapus_piki" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			title  : 'SIPULPENPAKGURU',
			height: 370,
			width: 650,
			buttons: {
				"Hapus Data": function() {
					//insert data
					id_piki 				=	$("#hapus_id_piki").val();
					kode_kegiatan			=	$("#sub_hapus_kriteria_piki").val();
					ak_piki					=	$("#hapus_ak_piki").val();
					no_dupak				=	$("#no_dupak").val();
					
					
						//alert (kode_kegiatan);
						$(".load_add_piki").show();
						
						$.ajax({
						url:"./kelas/dupak.php",
						data:"op=hapus_piki&id_piki="+id_piki+
														"&id_piki="+id_piki+
														"&kode_kegiatan="+kode_kegiatan+
														"&ak_piki="+ak_piki+
														"&no_dupak="+no_dupak,
								cache:false,
								success:function(msg){
								//alert(msg);
								load_table_piki();
								kosongkan_piki();
								$(".load_add_piki").hide();
								//$( "#tab_piki" ).accordion({collapsible: true,active : false});
								$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
								}
						})
					
					
					
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	$("#cb_kriteria_piki").change(function(){
		//alert(cb_kriteria_piki);
		cb_kriteria_piki=$("#cb_kriteria_piki").val();
		$("#sub_kriteria_piki").load("./kelas/proses.php","op=cb_sub_kriteria_piki&cb_kriteria_piki="+cb_kriteria_piki);
    });
	
	
	$("#cb_edit_kriteria_piki").change(function(){
		
		cb_edit_kriteria_piki=$("#cb_edit_kriteria_piki").val();
		//alert(cb_edit_kriteria_piki);
		$("#sub_edit_kriteria_piki").attr("disabled", false);
		$("#sub_edit_kriteria_piki").load("./kelas/proses.php","op=cb_sub_kriteria_piki&cb_kriteria_piki="+cb_edit_kriteria_piki);
    });
	
	
	$("#sub_kriteria_piki").change(function(){
		
		kode_kegiatan=$("#sub_kriteria_piki").val();
		//alert(kode_kegiatan);
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_ak_piki&kode_kegiatan="+kode_kegiatan,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					//data=msg.split("|");
					
					$("#ak_piki").val(msg);	
					$("#kode_kegiatan").val(kode_kegiatan);	
					
					}
		})
    });
	
	$("#sub_edit_kriteria_piki").change(function(){
		
		kode_kegiatan=$("#sub_edit_kriteria_piki").val();
		//alert(kode_kegiatan);
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_ak_piki&kode_kegiatan="+kode_kegiatan,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					//data=msg.split("|");
					
					$("#edit_ak_piki").val(msg);	
					$("#edit_kode_kegiatan").val(kode_kegiatan);	
					
					}
		})
    });
	//fungsi pengisian table piki
	function load_table_piki() {
		no_dupak		=	$("#no_dupak").val();
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_piki&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					$("#ak_29").val(data[0]);
					$("#f_29").val(data[1]);	
					$("#akf_29").val((data[1]*data[0]).toFixed(3));
					
					$("#ak_30").val(data[2]);
					$("#f_30").val(data[3]);
					$("#akf_30").val((data[2]*data[3]).toFixed(3));
					
					$("#ak_31").val(data[4]);
					$("#f_31").val(data[5]);
					$("#akf_31").val((data[4]*data[5]).toFixed(3));
					
					$("#ak_32").val(data[6]);
					$("#f_32").val(data[7]);
					$("#akf_32").val((data[6]*data[7]).toFixed(3));
					
					$("#ak_33").val(data[8]);
					$("#f_33").val(data[9]);
					$("#akf_33").val((data[8]*data[9]).toFixed(3));
					
					$("#ak_34").val(data[10]);
					$("#f_34").val(data[11]);
					$("#akf_34").val((data[10]*data[11]).toFixed(3));
					
					$("#ak_35").val(data[12]);
					$("#f_35").val(data[13]);
					$("#akf_35").val((data[12]*data[13]).toFixed(3));
					
					$("#ak_36").val(data[14]);
					$("#f_36").val(data[15]);
					$("#akf_36").val((data[14]*data[15]).toFixed(3));
					
					$("#ak_37").val(data[16]);
					$("#f_37").val(data[17]);
					$("#akf_37").val((data[16]*data[17]).toFixed(3));
					
					$("#ak_38").val(data[18]);
					$("#f_38").val(data[19]);
					$("#akf_38").val((data[18]*data[19]).toFixed(3));
					
					$("#ak_39").val(data[20]);
					$("#f_39").val(data[21]);
					$("#akf_39").val((data[20]*data[21]).toFixed(3));
					
					$("#ak_40").val(data[22]);
					$("#f_40").val(data[23]);
					$("#akf_40").val((data[22]*data[23]).toFixed(3));
					
					$("#ak_41").val(data[24]);
					$("#f_41").val(data[25]);
					$("#akf_41").val((data[24]*data[25]).toFixed(3));
					
					$("#ak_42").val(data[26]);
					$("#f_42").val(data[27]);
					$("#akf_42").val((data[26]*data[27]).toFixed(3));
					
					$("#ak_43").val(data[28]);
					$("#f_43").val(data[29]);
					$("#akf_43").val((data[28]*data[29]).toFixed(3));
					
					$("#ak_44").val(data[30]);
					$("#f_44").val(data[31]);
					$("#akf_44").val((data[30]*data[31]).toFixed(3));
					
					$("#ak_45").val(data[32]);
					$("#f_45").val(data[33]);
					$("#akf_45").val((data[32]*data[33]).toFixed(3));
					
					$("#ak_46").val(data[34]);
					$("#f_46").val(data[35]);
					$("#akf_46").val((data[34]*data[35]).toFixed(3));
					
					$("#ak_47").val(data[36]);
					$("#f_47").val(data[37]);
					$("#akf_47").val((data[36]*data[37]).toFixed(3));
					
					$("#ak_48").val(data[38]);
					$("#f_48").val(data[39]);
					$("#akf_48").val((data[38]*data[39]).toFixed(3));
					
					$("#ak_49").val(data[40]);
					$("#f_49").val(data[41]);
					$("#akf_49").val((data[40]*data[41]).toFixed(3));
					
					$("#ak_50").val(data[42]);
					$("#f_50").val(data[43]);
					$("#akf_50").val((data[42]*data[43]).toFixed(3));
					
					$("#ak_51").val(data[44]);
					$("#f_51").val(data[45]);
					$("#akf_51").val((data[44]*data[45]).toFixed(3));
					
					$("#ak_52").val(data[46]);
					$("#f_52").val(data[47]);
					$("#akf_52").val((data[46]*data[47]).toFixed(3));
					
					$("#ak_53").val(data[48]);
					$("#f_53").val(data[49]);
					$("#akf_53").val((data[48]*data[49]).toFixed(3));
					
					$("#ak_54").val(data[50]);
					$("#f_54").val(data[51]);
					$("#akf_54").val((data[50]*data[51]).toFixed(3));
					
					$("#ak_55").val(data[52]);
					$("#f_55").val(data[53]);
					$("#akf_55").val((data[52]*data[53]).toFixed(3));
					
					$("#ak_56").val(data[54]);
					$("#f_56").val(data[55]);
					$("#akf_56").val((data[54]*data[55]).toFixed(3));
					
					$("#ak_57").val(data[56]);
					$("#f_57").val(data[57]);
					$("#akf_57").val((data[56]*data[57]).toFixed(3));
					
					$("#ak_58").val(data[58]);
					$("#f_58").val(data[59]);
					$("#akf_58").val((data[58]*data[59]).toFixed(3));
					
					$("#ak_59").val(data[60]);
					$("#f_59").val(data[61]);
					$("#akf_59").val((data[60]*data[61]).toFixed(3));
					
					$("#ak_60").val(data[62]);
					$("#f_60").val(data[63]);
					$("#akf_60").val((data[62]*data[63]).toFixed(3));
					
					$("#ak_61").val(data[64]);
					$("#f_61").val(data[65]);
					$("#akf_61").val((data[64]*data[65]).toFixed(3));
					
					$("#ak_62").val(data[66]);
					$("#f_62").val(data[67]);
					$("#akf_62").val((data[66]*data[67]).toFixed(3));
					
					$("#ak_63").val(data[68]);
					$("#f_63").val(data[69]);
					$("#akf_63").val((data[68]*data[69]).toFixed(3));
					
					
					
					$("#jm_piki").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[18]*data[19])+(data[20]*data[21])+(data[22]*data[23])+
					(data[24]*data[25])+(data[26]*data[27])+(data[28]*data[29])+
					(data[30]*data[31])+(data[32]*data[33])+(data[34]*data[35])+
					(data[36]*data[37])+(data[38]*data[39])+(data[40]*data[41])+
					(data[42]*data[43])+(data[44]*data[45])+(data[46]*data[47])+
					(data[48]*data[49])+(data[50]*data[51])+(data[52]*data[53])+
					(data[54]*data[55])+(data[56]*data[57])+(data[58]*data[59])+
					(data[60]*data[61])+(data[62]*data[63])
					
					).toFixed(3)
					);
					
					
					}
		})
	
	
	
	
	}
	

	function kosongkan_piki(){
		$("#judul_piki").val("");
		$("#th_piki").val("");	
		$("#kode_kegiatan").val("");
		$("#ak_piki").val("");
		$("#kriteria_piki").val("");
		$("#sub_kriteria_piki").val("");
	}
	
	$("#simpan_piki").click(function(){
	$( "#load_simpan_piki" ).show();
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=update_step&step=5&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					//window.location.assign("?page=form_usulan_dupak&no_dupak="+no_dupak+"&nip_baru="+nip_baru);
					$( "#load_simpan_piki" ).hide();
					$( "#tab_new_dupak" ).tabs( "enable", 7 );
					$( "#tab_new_dupak" ).tabs( "option", "active", 7 );
					}
			})
	 });
	
	$( "#tab_piki" ).accordion({
		collapsible: true,
		active : false,
		heightStyle: "content",
		header:"div.head_acor"
		
    });
	
	 $("#ralat_piki").click(function(){
		$( "#tab_piki" ).show();
		$( "#tab_piki" ).accordion({collapsible: false,active : true});
		$("#ralat_piki" ).hide();
	 });
 });
 </script>
 
<script src="./js/custom_ajax.js"></script>
<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
?>

 
<div id="tab_piki" style="width:732px; margin-left:30px;">
	<div class="head_acor" style="padding:8px 0 8px 30px;">INPUT DATA USULAN PUBLIKASI ILMIAH / KARYA INOVATIF</div>
	<div id="piki">
		<table id="tbl_piki" width="100%" width="100%" class="detail" border="1"></table><br>
		<table width="560px" style="margin:0px 0 5px 0px;" border="0">
		<tr>
			<td>
				<button class="ui-state-default tambah" id="btn_form_piki" >TAMBAH DATA PIKI</button>
			</td>
		</tr>
		</table>
		
		
	</div>
</div>

<br>

<!--      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
<!--      *****************************    FORM CRUD PIKI    **************************** -->
<!--      ------------------------------------------------------------------------------- -->


<div id="form_piki" title="Tambah Data PIKI">
	<table width="600px" class="form" border="0">
            <tr>
                <td width="23%">Judul Piki</td>
                <td>
				&nbsp;&nbsp;
					<textarea id="judul_piki" style="width:420px; height:57px; resize: none; padding:3px 3px 3px 3px; "></textarea>
                </td>
			</tr>
            <tr>
                <td>Tahun</td>
                <td>
					 &nbsp;&nbsp; <input type="text"  onkeypress='return angka(event)' placeholder="tahun" id="th_piki" size="10px" >
                </td>
			</tr> 
            <tr>
				<td>
					Kriteria PIKI
				</td>
				<td>
					&nbsp;&nbsp;
					<select id="cb_kriteria_piki" style="min-width:235px;"></select>
				</td>
			</tr>
			<tr>
				<td>
					Sub Kriteria PIKI
				</td>
				<td>
					&nbsp;&nbsp;
					<select id="sub_kriteria_piki" style="min-width:235px;"></select>
				</td>
			</tr>
			<tr>
				<td>
					Angka Kredit
				</td>
				<td>
					&nbsp;&nbsp;
					<input type="text" placeholder="AK" id="ak_piki" size="10px" disabled >
					<input type="hidden" id="kode_kegiatan" size="10px"  >
				</td>
			</tr>
        </table>
	

	<table style="margin:10px 0 5px 20px;" border="0">
	<tr>
	<td>
		<img src="images/loader/load1.gif" class="load_add_piki" />
	</td>
	</tr>
	</table>
</div>




<div id="form_edit_piki" title="Edit Data PIKI">
	<table width="600px" class="form" border="0">
            <tr>
                <td width="23%">Judul Piki</td>
                <td>
				&nbsp;&nbsp;
					<input type="hidden" id="edit_id_piki" size="10px" >
					<textarea id="edit_judul_piki" style="width:420px; height:57px; resize: none; padding:3px 3px 3px 3px; "></textarea>
                </td>
			</tr>
            <tr>
                <td>Tahun</td>
                <td>
					 &nbsp;&nbsp; <input type="text"  onkeypress='return angka(event)' placeholder="tahun" id="edit_th_piki" size="10px" >
                </td>
			</tr> 
            <tr>
				<td>
					Kriteria PIKI
				</td>
				<td>
					&nbsp;&nbsp;
					<select id="cb_edit_kriteria_piki" style="min-width:235px;"></select>
				</td>
			</tr>
			<tr>
				<td>
					Sub Kriteria PIKI
				</td>
				<td>
					&nbsp;&nbsp;
					<select id="sub_edit_kriteria_piki" style="min-width:235px;" disabled>
					<?php
						Connect::getConnection();
						$row = mysql_query("SELECT DISTINCT sub_kriteria_piki,kode_kegiatan  FROM kd_dupak_kriteria_piki ");
						while ($r = mysql_fetch_array($row)){
					?>
						<option value="<?php echo $r['kode_kegiatan']; ?>" ><?php echo substr($r['sub_kriteria_piki'],0,76); ?></option>
						<?php
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Angka Kredit
				</td>
				<td>
					&nbsp;&nbsp;
					<input type="text" placeholder="AK" id="edit_ak_piki" size="10px" disabled >
					<input type="hidden" id="edit_ak_piki_awal" >
					<input type="hidden" id="edit_kode_kegiatan_piki_awal" size="10px"  >
				</td>
			</tr>
        </table>
	

	<table style="margin:10px 0 5px 20px;" border="0">
	<tr>
	<td>
		<img src="images/loader/load1.gif" class="load_add_piki" />
	</td>
	</tr>
	</table>
</div>

<div id="form_hapus_piki" title="Hapus Data PIKI">
	<table width="600px" class="form" border="0">
            <tr>
                <td width="23%">Judul Piki</td>
                <td>
				&nbsp;&nbsp;
					<input type="hidden" id="hapus_id_piki" size="10px" >
					<textarea id="hapus_judul_piki" style="width:420px; height:57px; resize: none; padding:3px 3px 3px 3px; " disabled></textarea>
                </td>
			</tr>
            <tr>
                <td>Tahun</td>
                <td>
					 &nbsp;&nbsp; <input type="text"  onkeypress='return angka(event)' placeholder="tahun" id="hapus_th_piki" size="10px" disabled>
                </td>
			</tr> 
            <tr>
				<td>
					Kriteria PIKI
				</td>
				<td>
					&nbsp;&nbsp;
					<select id="cb_hapus_kriteria_piki" style="min-width:235px;" disabled></select>
				</td>
			</tr>
			<tr>
				<td>
					Sub Kriteria PIKI
				</td>
				<td>
					&nbsp;&nbsp;
					<select id="sub_hapus_kriteria_piki" style="min-width:235px;" disabled>
					<?php
						Connect::getConnection();
						$row = mysql_query("SELECT DISTINCT sub_kriteria_piki,kode_kegiatan  FROM kd_dupak_kriteria_piki ");
						while ($r = mysql_fetch_array($row)){
					?>
						<option value="<?php echo $r['kode_kegiatan']; ?>" ><?php echo substr($r['sub_kriteria_piki'],0,76); ?></option>
						<?php
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Angka Kredit
				</td>
				<td>
					&nbsp;&nbsp;
					<input type="text" placeholder="AK" id="hapus_ak_piki" size="10px" disabled >
				</td>
			</tr>
        </table>
	

	<table style="margin:10px 0 5px 20px;" border="0">
	<tr>
	<td>
		<img src="images/loader/load1.gif" class="load_add_piki" />
	</td>
	</tr>
	</table>
</div>

<!-- *************************************  END  ********************************************** -->

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
	<td width="2%" rowspan="70" valign="top" align="center">
		3.
	</td>
	<td colspan="2" class="isi" >
		PENGEMBANGAN KEPROFESIAN BERKELANJUTAN
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
	<td width="2%" rowspan="32" valign="top" align="center">
		B.
	</td>
	<td>
		Melaksanakan Publikasi Ilmiah
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
		1. &nbsp;Presentasi pada forum ilmiah
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
		a. Menjadi pemrasaran/nara sumber pada seminar atau loka &nbsp;&nbsp;&nbsp; karya ilmiah
	</td>
	<td  align="center">
		29
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_29">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  id="f_29" disabled>
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_29">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Menjadi pemrasaran/nara sumber pada kologium atau  &nbsp;&nbsp;&nbsp;&nbsp;diskusi ilmiah
	</td>
	<td  align="center">
		30
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_30">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  id="f_30" disabled>
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_30">
	</td>
</tr>
<tr>
	<td>
		2. &nbsp;Melaksanakan publikasi Ilmiah hasil penelitian atau gagasan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ilmu pada bidang pendidikan formal
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
		a. Membuat karya tulis berupa laporan hasil penelitian pada 
		<p style="margin-left:15px;">bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan 
		dalam bentuk buku ber ISBN dan diedarkan secara 
		nasional atau telah lulus dari penilaian BNSP.</p>
	</td>
	<td  align="center">
		31
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_31">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_31">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_31">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Membuat karya tulis berupa laporan hasil penelitian pada 
		<p style="margin-left:15px;">bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan dalam majalah/jurnal 
		ilmiah tingkat nasional yang terakreditasi</p>
	</td>
	<td  align="center">
		32
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_32">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_32">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_32">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		c. Membuat karya tulis berupa  laporan hasil penelitian  pada
		<p style="margin-left:15px;"> bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan 
		dalam majalah/jurnal ilmiah tingkat provinsi.</p>
	</td>
	<td  align="center">
		33
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_33">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_33">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_33">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		d. Membuat karya tulis berupa  laporan hasil penelitian  pada
		<p style="margin-left:15px;"> bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan 
		dalam majalah/jurnal ilmiah tingkat kabupaten/kota.</p>
	</td>
	<td  align="center">
		34
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_34">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_34">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_34">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		e.  Membuat karya tulis berupa laporan hasil penelitian pada 
		<p style="margin-left:15px;">bidang pendidikan di sekolahnya, 
		diseminarkan di sekolahnya, disimpan di perpustakaan.</p>
	</td>
	<td  align="center">
		35
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_35">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_35">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_35">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		f.  Membuat makalah berupa tinjauan ilmiah dalam bidang
		<p style="margin-left:14px;">pendidikan formal dan pembelajaran pada satuan
			pendidikannya, tidak diterbitkan, disimpan di perpustakaan.</p>
	</td>
	<td  align="center">
		36
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_36">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_36">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_36">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		g.  Membuat Tulisan Ilmiah Populer di bidang pendidikan
		<p style="margin-left:15px;">formal dan pembelajaran pada satuan pendidikannya.</p>
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
	<td style="padding-left:43px;">
		1) &nbsp;Membuat Artikel Ilmiah Populer di bidang pendidikan
			<p style="margin-left:20px;">formal dan pembelajaran pada satuan pendidikannya
			dimuat di media masa tingkat nasional</p>
	</td>
	<td  align="center">
		37
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_37">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_37">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_37">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;Membuat Artikel Ilmiah Populer di bidang pendidikan
			<p style="margin-left:20px;">formal dan pembelajaran pada satuan pendidikannya 
			dimuat di media masa tingkat provinsi (koran daerah).</p>
	</td>
	<td  align="center">
		38
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_38">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_38">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_38">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		h.  Membuat Artikel Ilmiah dalam bidang pendidikan formal
		<p style="margin-left:15px;">dan pembelajaran pada satuan pendidikannya.</p>
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
	<td style="padding-left:43px;">
		1) &nbsp; Membuat Artikel Ilmiah dalam bidang pendidikan
			<p style="margin-left:24px;">formal dan pembelajaran pada satuan pendidikannya 
			dan dimuat di jurnal tingkat nasional yang terakreditasi</p>
	</td>
	<td  align="center">
		39
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_39">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_39">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_39">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp; Membuat Artikel Ilmiah dalam bidang pendidikan
			<p style="margin-left:24px;">formal dan pembelajaran pada satuan pendidikannya dan
			dimuat di jurnal tingkat nasional yang tidak terakreditasi/tingkat propvinsi.</p>
	</td>
	<td  align="center">
		40
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_40">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_40">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_40">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		3) &nbsp; Membuat Artikel Ilmiah dalam bidang pendidikan
			<p style="margin-left:24px;">formal dan pembelajaran pada satuan 
			pendidikannya dan dimuat di jurnal tingkat lokal 
			(kabupaten/kota/ sekolah/madrasah dstnya).</p>
	</td>
	<td  align="center">
		41
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_41">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_41">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_41">
	</td>
</tr>
<tr>
	<td>
		3. &nbsp;Melaksanakan publikasi buku teks pelajaran, buku pengayaan,
			<p style="margin-left:19px;">dan pedoman Guru:</p>
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
		a.  Membuat buku pelajaran per tingkat/buku pendidikan per
		<p style="margin-left:15px;">judul.</p>
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
	<td style="padding-left:43px;">
		1) &nbsp;  Buku pelajaran yang lolos penilaian oleh BSNP
	</td>
	<td  align="center">
		42
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_42">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_42">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_42">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;  Buku pelajaran yang dicetak oleh penerbit dan ber
			<p style="margin-left:24px;">ISBN</p>
	</td>
	<td  align="center">
		43
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_43">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_43">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_43">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		3) &nbsp; Buku pelajaran dicetak oleh penerbit tetapi belum 
		<p style="margin-left:24px;">berISBN</p>
	</td>
	<td  align="center">
		44
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_44">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_44">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_44">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b.  Membuat modul/diktat pembelajaran per semester:
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
	<td style="padding-left:43px;">
		1) &nbsp;  Digunakan di tingkat Provinsi dengan pengesahan
		<p style="margin-left:24px;">dari Dinas Pendidikan Provinsi.</p>
	</td>
	<td  align="center">
		45
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_45">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_45">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_45">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;  Digunakan di tingkat kota/kabupaten dengan
			<p style="margin-left:24px;">pengesahan dari Dinas Pendidikan Kota/Kabupaten</p>
	</td>
	<td  align="center">
		46
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_46">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_46">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_46">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		3) &nbsp; Digunakan di tingkat sekolah/madrasah setempat.
	</td>
	<td  align="center">
		47
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_47">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_47">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_47">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		c.  Membuat buku dalam bidang pendidikan:
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
	<td style="padding-left:43px;">
		1) &nbsp;  Buku dalam bidang pendidikan dicetak oleh penerbit
		<p style="margin-left:24px;">dan ber-ISBN.</p>
	</td>
	<td  align="center">
		48
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_48">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_48">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_48">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;  Buku dalam bidang pendidikan dicetak oleh penerbit
			<p style="margin-left:24px;">tetapi belum ber-ISBN.</p>
	</td>
	<td  align="center">
		49
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_49">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  disabled id="f_49">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_49">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		d.  Membuat karya hasil terjemahan yang dinyatakan oleh
		<p style="margin-left:15px;">kepala sekolah/madrasah tiap karya.</p>
	</td>
	<td  align="center">
		50
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_50">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  disabled id="f_50">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_50">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		e.  Membuat buku pedoman guru
	</td>
	<td  align="center">
		51
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_51">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  disabled id="f_51">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_51">
	</td>
</tr>
<tr>
	<td width="2%" rowspan="20" valign="top" align="center">
		C.
	</td>
	<td>
		Melaksanakan Karya Inovatif
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
		1. &nbsp;Menemukan teknologi tepat guna
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
		a. Kategori Kompleks
	</td>
	<td  align="center">
		52
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_52">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_52">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_52">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Kategori Sederhana
	</td>
	<td  align="center">
		53
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_53">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_53">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_53">
	</td>
</tr>
<tr>
	<td>
		2. &nbsp;Menemukan / menciptakan karya seni
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
		a. Kategori Kompleks
	</td>
	<td  align="center">
		54
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_54">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  disabled id="f_54">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_54">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Kategori Sederhana
	</td>
	<td  align="center">
		55
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_55" >
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_55">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_55">
	</td>
</tr>
<tr>
	<td>
		3. &nbsp;Membuat/modifikasi alat pelajaran/peraga/praktikum:
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
		a.  Membuat alat pelajaran
		<p style="margin-left:15px;">judul.</p>
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
	<td style="padding-left:43px;">
		1) &nbsp;  Kategori kompleks
	</td>
	<td  align="center">
		56
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_56">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq"  disabled id="f_56">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_56">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;Kategori sederhana
	</td>
	<td  align="center">
		57
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_57">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_57">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_57">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b.  Membuat alat peraga:
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
	<td style="padding-left:43px;">
		1) &nbsp;  Kategori kompleks
	</td>
	<td  align="center">
		58
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_58">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled  id="f_58">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_58">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;Kategori sederhana
	</td>
	<td  align="center">
		59
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_59">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_59">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_59">
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b.  Membuat alat praktikum:
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
	<td style="padding-left:43px;">
		1) &nbsp;  Kategori kompleks
	</td>
	<td  align="center">
		60
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_60">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled  id="f_60">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_60">
	</td>
</tr>
<tr>
	<td style="padding-left:43px;">
		2) &nbsp;Kategori sederhana
	</td>
	<td  align="center">
		61
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_61">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_61">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_61" >
	</td>
</tr>
<tr>
	<td>
		4. &nbsp;Mengikuti Kegiatan Penyusunan, Pedoman, 
			<p style="margin-left:18px;">Soal dan sejenisnya </p>
		
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
		a. Mengikuti Kegiatan Penyusunan Standar/ 
		<p style="margin-left:16px;">Pedoman/ Soal dan sejenisnya pada tingkat nasional. </p>
	</td>
	<td  align="center">
		62
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_62">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled  id="f_62">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_62" >
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Mengikuti Kegiatan Penyusunan Standar/ 
			<p style="margin-left:16px;">Pedoman/ Soal dan sejenisnya pada tingkat provinsi.</p>

	</td>
	<td  align="center">
		63
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_63">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_63">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_63">
	</td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH MELAKSANAKAN PIKI
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
	
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		<input type="text" class="ak_field" id="jm_piki" disabled >
	</td>
</tr>
</table>

<table style="width:732px; margin-left:30px;" border="0">
<tr>
	<td colspan="2">
		<button class="ui-state-default kirim" id="simpan_piki" >LANJUT</button>
		<button class="ui-state-default ralat" id="ralat_piki" >RALAT DATA</button>
		<img src="images/loader/load1.gif" id="load_simpan_piki" />
	</td>
</tr>
</table>

