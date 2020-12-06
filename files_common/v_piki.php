<script>
$(document).ready(function () {
	$("#load_simpan_piki").hide();
	
	no_dupak = $("#no_dupak").val();
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
	
	load_penilai_piki1();
	load_penilai_piki2();
	
	
	
	
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
								$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
								load_table_piki();	
								
								kosongkan_piki();
								$(".load_add_piki").hide();
								
								
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
									
								$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
								load_table_piki();	
								
								kosongkan_piki();
								$(".load_add_piki").hide();
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
								$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
								load_table_piki();
								kosongkan_piki();
								$(".load_add_piki").hide();
								
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
	
	function kosongkan_piki(){
		$("#judul_piki").val("");
		$("#th_piki").val("");	
		$("#kode_kegiatan").val("");
		$("#ak_piki").val("");
		$("#kriteria_piki").val("");
		$("#sub_kriteria_piki").val("");
	}
	
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
	
	load_table_piki();
	
	
	
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
					if ( data[1] != 0){$('.c_29').css('background','#fefeaf');}
					
					$("#ak_30").val(data[2]);
					$("#f_30").val(data[3]);
					$("#akf_30").val((data[2]*data[3]).toFixed(3));
					if ( data[3] != 0){$('.c_30').css('background','#fefeaf');}
					
					$("#ak_31").val(data[4]);
					$("#f_31").val(data[5]);
					$("#akf_31").val((data[4]*data[5]).toFixed(3));
					if ( data[5] != 0){$('.c_31').css('background','#fefeaf');}
					
					$("#ak_32").val(data[6]);
					$("#f_32").val(data[7]);
					$("#akf_32").val((data[6]*data[7]).toFixed(3));
					if ( data[7] != 0){$('.c_32').css('background','#fefeaf');}
					
					$("#ak_33").val(data[8]);
					$("#f_33").val(data[9]);
					$("#akf_33").val((data[8]*data[9]).toFixed(3));
					if ( data[9] != 0){$('.c_33').css('background','#fefeaf');}
					
					$("#ak_34").val(data[10]);
					$("#f_34").val(data[11]);
					$("#akf_34").val((data[10]*data[11]).toFixed(3));
					if ( data[11] != 0){$('.c_34').css('background','#fefeaf');}
					
					$("#ak_35").val(data[12]);
					$("#f_35").val(data[13]);
					$("#akf_35").val((data[12]*data[13]).toFixed(3));
					if ( data[13] != 0){$('.c_35').css('background','#fefeaf');}
					
					$("#ak_36").val(data[14]);
					$("#f_36").val(data[15]);
					$("#akf_36").val((data[14]*data[15]).toFixed(3));
					if ( data[15] != 0){$('.c_36').css('background','#fefeaf');}
					
					$("#ak_37").val(data[16]);
					$("#f_37").val(data[17]);
					$("#akf_37").val((data[16]*data[17]).toFixed(3));
					if ( data[17] != 0){$('.c_37').css('background','#fefeaf');}
					
					$("#ak_38").val(data[18]);
					$("#f_38").val(data[19]);
					$("#akf_38").val((data[18]*data[19]).toFixed(3));
					if ( data[19] != 0){$('.c_38').css('background','#fefeaf');}
					
					$("#ak_39").val(data[20]);
					$("#f_39").val(data[21]);
					$("#akf_39").val((data[20]*data[21]).toFixed(3));
					if ( data[21] != 0){$('.c_39').css('background','#fefeaf');}
					
					$("#ak_40").val(data[22]);
					$("#f_40").val(data[23]);
					$("#akf_40").val((data[22]*data[23]).toFixed(3));
					if ( data[23] != 0){$('.c_40').css('background','#fefeaf');}
					
					$("#ak_41").val(data[24]);
					$("#f_41").val(data[25]);
					$("#akf_41").val((data[24]*data[25]).toFixed(3));
					if ( data[25] != 0){$('.c_41').css('background','#fefeaf');}
					
					$("#ak_42").val(data[26]);
					$("#f_42").val(data[27]);
					$("#akf_42").val((data[26]*data[27]).toFixed(3));
					if ( data[27] != 0){$('.c_42').css('background','#fefeaf');}
					
					$("#ak_43").val(data[28]);
					$("#f_43").val(data[29]);
					$("#akf_43").val((data[28]*data[29]).toFixed(3));
					if ( data[29] != 0){$('.c_43').css('background','#fefeaf');}
					
					$("#ak_44").val(data[30]);
					$("#f_44").val(data[31]);
					$("#akf_44").val((data[30]*data[31]).toFixed(3));
					if ( data[31] != 0){$('.c_44').css('background','#fefeaf');}
					
					$("#ak_45").val(data[32]);
					$("#f_45").val(data[33]);
					$("#akf_45").val((data[32]*data[33]).toFixed(3));
					if ( data[33] != 0){$('.c_45').css('background','#fefeaf');}
					
					$("#ak_46").val(data[34]);
					$("#f_46").val(data[35]);
					$("#akf_46").val((data[34]*data[35]).toFixed(3));
					if ( data[35] != 0){$('.c_46').css('background','#fefeaf');}
					
					$("#ak_47").val(data[36]);
					$("#f_47").val(data[37]);
					$("#akf_47").val((data[36]*data[37]).toFixed(3));
					if ( data[37] != 0){$('.c_47').css('background','#fefeaf');}
					
					$("#ak_48").val(data[38]);
					$("#f_48").val(data[39]);
					$("#akf_48").val((data[38]*data[39]).toFixed(3));
					if ( data[39] != 0){$('.c_48').css('background','#fefeaf');}
					
					$("#ak_49").val(data[40]);
					$("#f_49").val(data[41]);
					$("#akf_49").val((data[40]*data[41]).toFixed(3));
					if ( data[41] != 0){$('.c_49').css('background','#fefeaf');}
					
					$("#ak_50").val(data[42]);
					$("#f_50").val(data[43]);
					$("#akf_50").val((data[42]*data[43]).toFixed(3));
					if ( data[43] != 0){$('.c_50').css('background','#fefeaf');}
					
					$("#ak_51").val(data[44]);
					$("#f_51").val(data[45]);
					$("#akf_51").val((data[44]*data[45]).toFixed(3));
					if ( data[45] != 0){$('.c_51').css('background','#fefeaf');}
					
					$("#ak_52").val(data[46]);
					$("#f_52").val(data[47]);
					$("#akf_52").val((data[46]*data[47]).toFixed(3));
					if ( data[47] != 0){$('.c_52').css('background','#fefeaf');}
					
					$("#ak_53").val(data[48]);
					$("#f_53").val(data[49]);
					$("#akf_53").val((data[48]*data[49]).toFixed(3));
					if ( data[49] != 0){$('.c_53').css('background','#fefeaf');}
					
					$("#ak_54").val(data[50]);
					$("#f_54").val(data[51]);
					$("#akf_54").val((data[50]*data[51]).toFixed(3));
					if ( data[51] != 0){$('.c_54').css('background','#fefeaf');}
					
					$("#ak_55").val(data[52]);
					$("#f_55").val(data[53]);
					$("#akf_55").val((data[52]*data[53]).toFixed(3));
					if ( data[53] != 0){$('.c_55').css('background','#fefeaf');}
					
					$("#ak_56").val(data[54]);
					$("#f_56").val(data[55]);
					$("#akf_56").val((data[54]*data[55]).toFixed(3));
					if ( data[55] != 0){$('.c_56').css('background','#fefeaf');}
					
					$("#ak_57").val(data[56]);
					$("#f_57").val(data[57]);
					$("#akf_57").val((data[56]*data[57]).toFixed(3));
					if ( data[57] != 0){$('.c_57').css('background','#fefeaf');}
					
					$("#ak_58").val(data[58]);
					$("#f_58").val(data[59]);
					$("#akf_58").val((data[58]*data[59]).toFixed(3));
					if ( data[59] != 0){$('.c_58').css('background','#fefeaf');}
					
					$("#ak_59").val(data[60]);
					$("#f_59").val(data[61]);
					$("#akf_59").val((data[60]*data[61]).toFixed(3));
					if ( data[61] != 0){$('.c_59').css('background','#fefeaf');}
					
					$("#ak_60").val(data[62]);
					$("#f_60").val(data[63]);
					$("#akf_60").val((data[62]*data[63]).toFixed(3));
					if ( data[63] != 0){$('.c_60').css('background','#fefeaf');}
					
					$("#ak_61").val(data[64]);
					$("#f_61").val(data[65]);
					$("#akf_61").val((data[64]*data[65]).toFixed(3));
					if ( data[65] != 0){$('.c_61').css('background','#fefeaf');}
					
					$("#ak_62").val(data[66]);
					$("#f_62").val(data[67]);
					$("#akf_62").val((data[66]*data[67]).toFixed(3));
					if ( data[67] != 0){$('.c_62').css('background','#fefeaf');}
					
					$("#ak_63").val(data[68]);
					$("#f_63").val(data[69]);
					$("#akf_63").val((data[68]*data[69]).toFixed(3));
					if ( data[69] != 0){$('.c_63').css('background','#fefeaf');}
					
					
					
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
	
	
	
	function load_penilai_piki1() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=piki1&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p1_29").html("<img src="+data[0]+">");
					$("#p1_30").html("<img src="+data[1]+">");
					$("#p1_31").html("<img src="+data[2]+">");
					$("#p1_32").html("<img src="+data[3]+">");
					$("#p1_33").html("<img src="+data[4]+">");
					$("#p1_34").html("<img src="+data[5]+">");
					$("#p1_35").html("<img src="+data[6]+">");
					$("#p1_36").html("<img src="+data[7]+">");
					$("#p1_37").html("<img src="+data[8]+">");
					$("#p1_38").html("<img src="+data[9]+">");
					$("#p1_39").html("<img src="+data[10]+">");
					$("#p1_40").html("<img src="+data[11]+">");
					$("#p1_41").html("<img src="+data[12]+">");
					$("#p1_42").html("<img src="+data[13]+">");
					$("#p1_43").html("<img src="+data[14]+">");
					$("#p1_44").html("<img src="+data[15]+">");
					$("#p1_45").html("<img src="+data[16]+">");
					$("#p1_46").html("<img src="+data[17]+">");
					$("#p1_47").html("<img src="+data[18]+">");
					$("#p1_48").html("<img src="+data[19]+">");
					$("#p1_49").html("<img src="+data[20]+">");
					$("#p1_50").html("<img src="+data[21]+">");
					$("#p1_51").html("<img src="+data[22]+">");
					$("#p1_52").html("<img src="+data[23]+">");
					$("#p1_53").html("<img src="+data[24]+">");
					$("#p1_54").html("<img src="+data[25]+">");
					$("#p1_55").html("<img src="+data[26]+">");
					$("#p1_56").html("<img src="+data[27]+">");
					$("#p1_57").html("<img src="+data[28]+">");
					$("#p1_58").html("<img src="+data[29]+">");
					$("#p1_59").html("<img src="+data[30]+">");
					$("#p1_60").html("<img src="+data[31]+">");
					$("#p1_61").html("<img src="+data[32]+">");
					$("#p1_62").html("<img src="+data[33]+">");
					$("#p1_63").html("<img src="+data[34]+">");
				
					
					
					
					
					}
		})
	}
	
	function load_penilai_piki2() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=piki2&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p2_29").html("<img src="+data[0]+">");
					$("#p2_30").html("<img src="+data[1]+">");
					$("#p2_31").html("<img src="+data[2]+">");
					$("#p2_32").html("<img src="+data[3]+">");
					$("#p2_33").html("<img src="+data[4]+">");
					$("#p2_34").html("<img src="+data[5]+">");
					$("#p2_35").html("<img src="+data[6]+">");
					$("#p2_36").html("<img src="+data[7]+">");
					$("#p2_37").html("<img src="+data[8]+">");
					$("#p2_38").html("<img src="+data[9]+">");
					$("#p2_39").html("<img src="+data[10]+">");
					$("#p2_40").html("<img src="+data[11]+">");
					$("#p2_41").html("<img src="+data[12]+">");
					$("#p2_42").html("<img src="+data[13]+">");
					$("#p2_43").html("<img src="+data[14]+">");
					$("#p2_44").html("<img src="+data[15]+">");
					$("#p2_45").html("<img src="+data[16]+">");
					$("#p2_46").html("<img src="+data[17]+">");
					$("#p2_47").html("<img src="+data[18]+">");
					$("#p2_48").html("<img src="+data[19]+">");
					$("#p2_49").html("<img src="+data[20]+">");
					$("#p2_50").html("<img src="+data[21]+">");
					$("#p2_51").html("<img src="+data[22]+">");
					$("#p2_52").html("<img src="+data[23]+">");
					$("#p2_53").html("<img src="+data[24]+">");
					$("#p2_54").html("<img src="+data[25]+">");
					$("#p2_55").html("<img src="+data[26]+">");
					$("#p2_56").html("<img src="+data[27]+">");
					$("#p2_57").html("<img src="+data[28]+">");
					$("#p2_58").html("<img src="+data[29]+">");
					$("#p2_59").html("<img src="+data[30]+">");
					$("#p2_60").html("<img src="+data[31]+">");
					$("#p2_61").html("<img src="+data[32]+">");
					$("#p2_62").html("<img src="+data[33]+">");
					$("#p2_63").html("<img src="+data[34]+">");
				
					
					
					
					
					}
		})
	}
	
	$(".kd_keg").click(function(){
		//alert();
		//$(this).focus().select();
		//alert($(this).val());
		kd_keg = $(this).val();
		
	//cek dulu apakah kode kegiatan yang di klik ada Freq nya apa kagak
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=cek_f&no_dupak="+no_dupak+"&kd_keg="+kd_keg,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					if ( msg == 0 ) {
						$("#dialog-confirm").html("<center>Mohon untuk menilai hanya pada kegiatan yang diajukan saja</center>");
						$("#dialog-confirm").dialog({
							show:"clip",
							hide:"clip",
							resizable: false,
							modal: true,
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
						$( "#v_piki" ).dialog( "open" );
						$("#tbl_v_piki").load("./kelas/load_data.php","op=v_piki&no_dupak="+no_dupak+"&kd_keg="+kd_keg);
					}
					
					}
		})
	});
	
	$( "#v_piki" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			resizable: false,
			draggable:false,
			//height: auto,
			width: 700,
			modal: true,
			buttons: {
				Tutup: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
				$("#tbl_piki").load("./kelas/load_data.php","op=load_tbl_piki&no_dupak="+no_dupak);
				load_penilai_piki1();
				load_penilai_piki2();
				load_table_piki();
			}
			
				
	})
	
	
	$( "#tab_piki" ).accordion({
		collapsible: true,
		active : false,
		heightStyle: "content",
		header:"div.head_acor"
		
    });
	
	//simpan hasil penilaian
	$("#simpan_v_piki").click(function(){
			$( "#load_simpan_piki" ).show();
			$.ajax({
			url:"./kelas/verifikasi.php",
			data:"op=simpan_piki&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					$( "#load_simpan_piki" ).hide();
					$( "#tab_verifikasi_dupak" ).tabs( "enable", 7 );
					$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 7 );

					}
			})
	 });
	 
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
                cache:false,
                success:function(msg){
				//alert(msg);
				data=msg.split("|");
				$( "#progressbar" ).progressbar({value: +data[2]});
				
				if ( (data[0] >= 19) || (((data[0] >=12) && (p == 1)) || ((data[0] >=18) && (p == 2 ))  ) ){
				//if ( (data[0] >=12) && (p == 1) || (data[0] >=18) && (p == 2 ) ){
					$("#simpan_v_piki").hide();
					$(".edit_piki").hide();
					$(".hapus_piki").hide();
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




<div id="v_piki" title="Verifikasi Data PIKI">
	<table id="tbl_v_piki" width="100%" class="detail" border="1"></table>
</div>	





<!-- *************************************  END  ********************************************** -->
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
	<td  align="center">
		
	</td>
	<td  align="center">
	</td>
</tr>
<tr class="c_29">
	<td style="padding-left:23px;">
		a. Menjadi pemrasaran/nara sumber pada seminar
		<p style="margin-left:16px">atau loka karya ilmiah</p>
		
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="29">
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
	<td  align="center">
		<span id="p1_29" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_29" class="nilai" ></span>
	</td>
</tr>
<tr class="c_30">
	<td style="padding-left:23px;">
		b. Menjadi pemrasaran/nara sumber pada kologium
		<p style="margin-left:16px">atau diskusi ilmiah</p>
		
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="30">
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
	<td  align="center">
		<span id="p1_30" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_30" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td>
		2. &nbsp;Melaksanakan publikasi Ilmiah hasil penelitian atau
		<p style="margin-left:18px">gagasan ilmu pada bidang pendidikan formal</p>
		
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
<tr class="c_31">
	<td style="padding-left:23px;">
		a. Membuat karya tulis berupa laporan hasil penelitian
		<p style="margin-left:15px;"> pada  bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan 
		dalam bentuk buku ber ISBN dan diedarkan secara 
		nasional atau telah lulus dari penilaian BNSP.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="31">
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
	<td  align="center">
		<span id="p1_31" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_31" class="nilai" ></span>
	</td>
</tr>
<tr class="c_32">
	<td style="padding-left:23px;">
		b. Membuat karya tulis berupa laporan hasil penelitian 
		<p style="margin-left:15px;">pada  bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan dalam majalah/jurnal 
		ilmiah tingkat nasional yang terakreditasi</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="32">
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
	<td  align="center">
		<span id="p1_32" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_32" class="nilai" ></span>
	</td>
</tr>
<tr class="c_33">
	<td style="padding-left:23px;">
		c. Membuat karya tulis berupa  laporan hasil penelitian
		<p style="margin-left:15px;">   pada bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan 
		dalam majalah/jurnal ilmiah tingkat provinsi.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="33">
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
	<td  align="center">
		<span id="p1_33" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_33" class="nilai" ></span>
	</td>
</tr>
<tr class="c_34">
	<td style="padding-left:23px;">
		d. Membuat karya tulis berupa  laporan hasil penelitian 
		<p style="margin-left:15px;">  pada bidang pendidikan di sekolahnya, diterbitkan/dipublikasikan 
		dalam majalah/jurnal ilmiah tingkat kabupaten/kota.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="34">
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
	<td  align="center">
		<span id="p1_34" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_34" class="nilai" ></span>
	</td>
</tr>
<tr class="c_35">
	<td style="padding-left:23px;">
		e.  Membuat karya tulis berupa laporan hasil penelitian 
		<p style="margin-left:15px;">pada  bidang pendidikan di sekolahnya, 
		diseminarkan di sekolahnya, disimpan di perpustakaan.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="35">
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
	<td  align="center">
		<span id="p1_35" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_35" class="nilai" ></span>
	</td>
</tr>
<tr class="c_36">
	<td style="padding-left:23px;">
		f.  Membuat makalah berupa tinjauan ilmiah dalam 
		<p style="margin-left:14px;">bidang pendidikan formal dan pembelajaran pada satuan
			pendidikannya, tidak diterbitkan, disimpan di perpustakaan.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="36">
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
	<td  align="center">
		<span id="p1_36" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_36" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		g.  Membuat Tulisan Ilmiah Populer di bidang 
		<p style="margin-left:15px;">pendidikan formal dan pembelajaran pada satuan pendidikannya.</p>
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
<tr class="c_37">
	<td style="padding-left:43px;">
		1) &nbsp;Membuat Artikel Ilmiah Populer di bidang
			<p style="margin-left:20px;"> pendidikan formal dan pembelajaran pada satuan pendidikannya
			dimuat di media masa tingkat nasional</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="37">
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
	<td  align="center">
		<span id="p1_37" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_37" class="nilai" ></span>
	</td>
</tr>
<tr class="c_38">
	<td style="padding-left:43px;">
		2) &nbsp;Membuat Artikel Ilmiah Populer di bidang 
			<p style="margin-left:20px;">pendidikan formal dan pembelajaran pada satuan pendidikannya 
			dimuat di media masa tingkat provinsi (koran daerah).</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="38">
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
	<td  align="center">
		<span id="p1_38" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_38" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		h.  Membuat Artikel Ilmiah dalam bidang pendidikan
		<p style="margin-left:15px;"> formal dan pembelajaran pada satuan pendidikannya.</p>
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
<tr class="c_39">
	<td style="padding-left:43px;">
		1) &nbsp; Membuat Artikel Ilmiah dalam bidang 
			<p style="margin-left:24px;">pendidikan formal dan pembelajaran pada satuan pendidikannya 
			dan dimuat di jurnal tingkat nasional yang terakreditasi</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="39">
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
	<td  align="center">
		<span id="p1_39" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_39" class="nilai" ></span>
	</td>
</tr>
<tr class="c_40">
	<td style="padding-left:43px;">
		2) &nbsp; Membuat Artikel Ilmiah dalam bidang 
			<p style="margin-left:24px;">pendidikan formal dan pembelajaran pada satuan pendidikannya dan
			dimuat di jurnal tingkat nasional yang tidak terakreditasi/tingkat propvinsi.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="40">
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
	<td  align="center">
		<span id="p1_40" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_40" class="nilai" ></span>
	</td>
</tr>
<tr class="c_41">
	<td style="padding-left:43px;">
		3) &nbsp; Membuat Artikel Ilmiah dalam bidang
			<p style="margin-left:24px;"> pendidikan formal dan pembelajaran pada satuan 
			pendidikannya dan dimuat di jurnal tingkat lokal 
			(kabupaten/kota/ sekolah/madrasah dstnya).</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="41">
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
	<td  align="center">
		<span id="p1_41" class="nilai" ></span>
	</td>
		<td  align="center">
		<span id="p2_41" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td>
		3. &nbsp;Melaksanakan publikasi buku teks pelajaran, buku 
			<p style="margin-left:19px;">pengayaan, dan pedoman Guru:</p>
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
	<td style="padding-left:23px;">
		a.  Membuat buku pelajaran per tingkat/buku
		<p style="margin-left:15px;"> pendidikan per judul.</p>
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
<tr class="c_42">
	<td style="padding-left:43px;">
		1) &nbsp;  Buku pelajaran yang lolos penilaian oleh BSNP
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="42">
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
	<td  align="center">
		<span id="p1_42" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_42" class="nilai" ></span>
	</td>
</tr>
<tr class="c_43">
	<td style="padding-left:43px;">
		2) &nbsp;  Buku pelajaran yang dicetak oleh penerbit dan 
			<p style="margin-left:24px;">ber ISBN</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="43">
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
	<td  align="center">
		<span id="p1_43" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_43" class="nilai" ></span>
	</td>
</tr>
<tr class="c_44">
	<td style="padding-left:43px;">
		3) &nbsp; Buku pelajaran dicetak oleh penerbit tetapi
		<p style="margin-left:24px;"> belum  berISBN</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="44">
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
	<td  align="center">
		<span id="p1_44" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_44" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
		<td  align="center">
		
	</td>
</tr>
<tr class="c_45">
	<td style="padding-left:43px;">
		1) &nbsp;  Digunakan di tingkat Provinsi dengan 
		<p style="margin-left:24px;">pengesahan dari Dinas Pendidikan Provinsi.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="45">
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
	<td  align="center">
		<span id="p1_45" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_45" class="nilai" ></span>
	</td>
</tr>
<tr class="c_46">
	<td style="padding-left:43px;">
		2) &nbsp;  Digunakan di tingkat kota/kabupaten dengan
			<p style="margin-left:24px;">pengesahan dari Dinas Pendidikan Kota/Kabupaten</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="46">
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
	<td  align="center">
		<span id="p1_46" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_46" class="nilai" ></span>
	</td>
</tr>
<tr class="c_47">
	<td style="padding-left:43px;">
		3) &nbsp; Digunakan di tingkat sekolah/madrasah
		<p style="margin-left:24px;"> setempat.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="47">
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
	<td  align="center">
		<span id="p1_47" class="nilai" ></span>
	</td>
		<td  align="center">
		<span id="p2_47" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_48">
	<td style="padding-left:43px;">
		1) &nbsp;  Buku dalam bidang pendidikan dicetak oleh
		<p style="margin-left:24px;"> penerbit dan ber-ISBN.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="48">
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
	<td  align="center">
		<span id="p1_48" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_48" class="nilai" ></span>
	</td>
</tr>
<tr class="c_49">
	<td style="padding-left:43px;">
		2) &nbsp;  Buku dalam bidang pendidikan dicetak oleh
			<p style="margin-left:24px;"> penerbit tetapi belum ber-ISBN.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="49">
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
	<td  align="center">
		<span id="p1_49" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_49" class="nilai" ></span>
	</td>
</tr>
<tr class="c_50">
	<td style="padding-left:23px;">
		d.  Membuat karya hasil terjemahan yang dinyatakan 
		<p style="margin-left:15px;">oleh kepala sekolah/madrasah tiap karya.</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="50">
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
	<td  align="center">
		<span id="p1_50" class="nilai" ></span>
	</td>
		<td  align="center">
		<span id="p2_50" class="nilai" ></span>
	</td>
</tr>
<tr class="c_51">
	<td style="padding-left:23px;">
		e.  Membuat buku pedoman guru
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="51">
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
	<td  align="center">
		<span id="p1_51" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_51" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
</tr>
<tr class="c_52">
	<td style="padding-left:23px;">
		a. Kategori Kompleks
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="52">
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
	<td  align="center">
		<span id="p1_52" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_52" class="nilai" ></span>
	</td>
</tr>
<tr class="c_53">
	<td style="padding-left:23px;">
		b. Kategori Sederhana
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="53">
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
	<td  align="center">
		<span id="p1_53" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_53" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_54">
	<td style="padding-left:23px;">
		a. Kategori Kompleks
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="54">
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
	<td  align="center">
		<span id="p1_54" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_54" class="nilai" ></span>
	</td>
</tr>
<tr class="c_55">
	<td style="padding-left:23px;">
		b. Kategori Sederhana
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="55">
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
	<td  align="center">
		<span id="p1_55" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_55" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_56">
	<td style="padding-left:43px;">
		1) &nbsp;  Kategori kompleks
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="56">
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
	<td  align="center">
		<span id="p1_56" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_56" class="nilai" ></span>
	</td>
</tr>
<tr class="c_57">
	<td style="padding-left:43px;">
		2) &nbsp;Kategori sederhana
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="57">
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
	<td  align="center">
		<span id="p1_57" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_57" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_58">
	<td style="padding-left:43px;">
		1) &nbsp;  Kategori kompleks
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="58">
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
	<td  align="center">
		<span id="p1_58" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_58" class="nilai" ></span>
	</td>
</tr>
<tr class="c_59">
	<td style="padding-left:43px;">
		2) &nbsp;Kategori sederhana
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="59">
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
	<td  align="center">
		<span id="p1_59" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_59" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_60">
	<td style="padding-left:43px;">
		1) &nbsp;  Kategori kompleks
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="60">
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
	<td  align="center">
		<span id="p1_60" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_60" class="nilai" ></span>
	</td>
</tr>
<tr class="c_61">
	<td style="padding-left:43px;">
		2) &nbsp;Kategori sederhana
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="61">
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
	<td  align="center">
		<span id="p1_61" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_61" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
<tr class="c_62">
	<td style="padding-left:23px;">
		a. Mengikuti Kegiatan Penyusunan Standar/ 
		<p style="margin-left:16px;">Pedoman/ Soal dan sejenisnya pada tingkat nasional. </p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="62">
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
	<td  align="center">
		<span id="p1_62" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_62" class="nilai" ></span>
	</td>
</tr>
<tr class="c_63">
	<td style="padding-left:23px;">
		b. Mengikuti Kegiatan Penyusunan Standar/ 
			<p style="margin-left:16px;">Pedoman/ Soal dan sejenisnya pada tingkat provinsi.</p>

	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="63">
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
	<td  align="center">
		<span id="p1_63" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_63" class="nilai" ></span>
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
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
</tr>
</table>

<br>
<table style="width:732px; margin-left:40px;" border="0">
<tr>
	<td>
		<button class="ui-state-default lanjut" id="simpan_v_piki" >SIMPAN DATA VERIFIKASI PIKI</button>
		<img src="images/loader/load1.gif" id="load_simpan_piki" />
	</td>
</tr>
</table>