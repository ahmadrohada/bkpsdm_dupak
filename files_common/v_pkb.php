<script>
$(document).ready(function () {
	$("#load_simpan_pkb").hide();
	
	no_dupak = $("#no_dupak").val();
	
	$( ".load_add_diklat" ).hide();
	$( ".load_add_kolektif" ).hide();
	$( "#load_simpan_pkb" ).hide();
	$("#cb_edit_sub_kegiatan_2").attr("disabled", true);
	$("#cb_sub_kegiatan_2").attr("disabled", true);
	
	load_table_pd();
	$("#tbl_diklat").load("./kelas/load_data.php","op=load_tbl_diklat&no_dupak="+no_dupak);
	$("#tbl_kolektif").load("./kelas/load_data.php","op=load_tbl_kolektif&no_dupak="+no_dupak);
	
	load_penilai_pkb1();
	load_penilai_pkb2();
	
	$("#cb_kegiatan_kolektif").change(function(){
		sub_kegiatan_1=$("#cb_kegiatan_kolektif").val();
		$("#cb_sub_kegiatan_2").load("./kelas/proses.php","op=cb_kegiatan_kolektif&sub_kegiatan_1="+sub_kegiatan_1);
		if ( sub_kegiatan_1 != ""){
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=cek_sub_kegiatan_kolektif&sub_kegiatan_1="+sub_kegiatan_1,
				cache:false,
				success:function(msg){
				//alert (msg);
					if ( msg == "1" ) 	{
						$("#cb_sub_kegiatan_2").attr("disabled", false);
						$("#cb_sub_kegiatan_2").focus();
					}else{
						$("#cb_sub_kegiatan_2").val("");
						$("#cb_sub_kegiatan_2").attr("disabled", true);
						$("#nm_kegiatan_kolektif").focus();
						
					}
						

						
				}
			})
		}else{
			$("#cb_sub_kegiatan_2").val("");
			$("#cb_sub_kegiatan_2").attr("disabled", true);
		}
    });
	
	$("#cb_edit_kegiatan_kolektif").change(function(){
		sub_kegiatan_1=$("#cb_edit_kegiatan_kolektif").val();
		//alert(sub_kegiatan_1);
		$("#cb_edit_sub_kegiatan_2").load("./kelas/proses.php","op=cb_kegiatan_kolektif&sub_kegiatan_1="+sub_kegiatan_1);
		if ( sub_kegiatan_1 != ""){
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=cek_sub_kegiatan_kolektif&sub_kegiatan_1="+sub_kegiatan_1,
				cache:false,
				success:function(msg){
				//alert (msg);
					if ( msg == "1" ) 	{
						$("#cb_edit_sub_kegiatan_2").attr("disabled", false);
						$("#cb_edit_sub_kegiatan_2").focus();
					}else{
						$("#cb_edit_sub_kegiatan_2").val("");
						$("#cb_edit_sub_kegiatan_2").attr("disabled", true);
						$("#edit_nm_kegiatan_kolektif").focus();
						
					}
						

						
				}
			})
		}else{
			$("#cb_edit_sub_kegiatan_2").val("");
			$("#cb_edit_sub_kegiatan_2").attr("disabled", true);
		}
    });
	

	$("#btn_form_diklat").click(function(){
		$( "#form_diklat" ).dialog( "open" );
	});
	
	
	$( "#form_diklat" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			height: 440,
			width: 610,
			
			
			
			
			buttons: {
				"Simpan Data": function() {
					//insert data
							no_dupak				=	$("#no_dupak").val();
							nama_diklat 			=	$("#nama_diklat").val();
							penyelenggara_diklat	=	$("#penyelenggara_diklat").val();	
							jp						=	$("#jp").val();
							
							tgl_mulai_diklat		=	$("#tgl_mulai_diklat").val();
							tgl_selesai_diklat		=	$("#tgl_selesai_diklat").val();
							tgl_sertifikat			=	$("#tgl_sertifikat").val();
							no_sertifikat			=	$("#no_sertifikat").val();
						
							
							
							if (nama_diklat == ""){
								alert("Nama Diklat Masih Kosong");
								$("#nama_diklat").focus().select();
							}else if (penyelenggara_diklat == ""){
								alert("Penyelenggara Masih Kosong");
								$("#penyelenggara_diklat").focus().select();
							}else if ( jp < 30 ) {
								alert("Jam Diklat Kurang");
								$("#jp").focus().select();
							} else if (no_sertifikat == ""){
								alert("No Sertifikat Masih Kosong");
								$("#no_sertifikat").focus().select();
							}else if (tgl_sertifikat == ""){
								alert("Tanggal Masih Kosong");
								$("#tgl_sertifikat").focus().select();
							}else {
								//alert (kode_kegiatan);
								$( ".load_add_diklat" ).show();
								
								$.ajax({
								url:"./kelas/dupak.php",
								data:"op=add_diklat&no_dupak="+no_dupak+
																"&nama_diklat="+nama_diklat+
																"&penyelenggara_diklat="+penyelenggara_diklat+
																"&jp="+jp+
																"&tgl_mulai_diklat="+tgl_mulai_diklat+
																"&tgl_selesai_diklat="+tgl_selesai_diklat+
																"&tgl_sertifikat="+tgl_sertifikat+
																"&no_sertifikat="+no_sertifikat,
										cache:false,
										success:function(msg){
										//alert (msg);
										//$("#ak").val(msg);	
										
										load_table_pd();
										kosongkan_diklat();
										$( ".load_add_diklat" ).hide();
										//$( "#tab_pd" ).accordion({collapsible: true,active : false});
										}
								})
							}
					$( this ).dialog( "close" );
					$("#tbl_diklat").load("./kelas/load_data.php","op=load_tbl_diklat&no_dupak="+no_dupak);
					load_table_pd();
		
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	
	$( "#form_edit_diklat" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			height: 420,
			width: 610,
			buttons: {
				"Simpan Perubahan": function() {
					//insert data
							no_dupak				=	$("#no_dupak").val();
							id_diklat				=	$("#edit_id_diklat").val();
							nama_diklat 			=	$("#edit_nama_diklat").val();
							penyelenggara_diklat	=	$("#edit_penyelenggara_diklat").val();	
							jp						=	$("#edit_jp").val();
							
							tgl_mulai_diklat		=	$("#edit_tgl_mulai_diklat").val();
							tgl_selesai_diklat		=	$("#edit_tgl_selesai_diklat").val();
							tgl_sertifikat			=	$("#edit_tgl_sertifikat").val();
							no_sertifikat			=	$("#edit_no_sertifikat").val();
							
							ak						=	$("#edit_ak").val();
							kode_kegiatan			=	$("#edit_kode_kegiatan").val();
						
							
							
							if (nama_diklat == ""){
								alert("Nama Diklat Masih Kosong");
								$("#edit_nama_diklat").focus().select();
							}else if (penyelenggara_diklat == ""){
								alert("Penyelenggara Masih Kosong");
								$("#edit_penyelenggara_diklat").focus().select();
							}else if ( jp < 30 ) {
								alert("Jam Diklat Kurang");
								$("#edit_jp").focus().select();
							} else if (no_sertifikat == ""){
								alert("No Sertifikat Masih Kosong");
								$("#edit_no_sertifikat").focus().select();
							}else if (tgl_sertifikat == ""){
								alert("Tanggal Masih Kosong");
								$("#edit_tgl_sertifikat").focus().select();
							}else {
								//alert (kode_kegiatan);
								$( ".load_add_diklat" ).show();
								
								$.ajax({
								url:"./kelas/dupak.php",
								data:"op=edit_diklat&id_diklat="+id_diklat+
																"&no_dupak="+no_dupak+
																"&nama_diklat="+nama_diklat+
																"&penyelenggara_diklat="+penyelenggara_diklat+
																"&jp="+jp+
																"&tgl_mulai_diklat="+tgl_mulai_diklat+
																"&tgl_selesai_diklat="+tgl_selesai_diklat+
																"&tgl_sertifikat="+tgl_sertifikat+
																"&no_sertifikat="+no_sertifikat+
																"&ak="+ak+
																"&kode_kegiatan="+kode_kegiatan,
										cache:false,
										success:function(msg){
										//alert (msg);
										//$("#ak").val(msg);	
										
										load_table_pd();
										$( ".load_add_diklat" ).hide();
										//$( "#tab_pd" ).accordion({collapsible: true,active : false});
										}
								})
							}
					$( this ).dialog( "close" );
					$("#tbl_diklat").load("./kelas/load_data.php","op=load_tbl_diklat&no_dupak="+no_dupak);
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	
	$( "#form_hapus_diklat" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			height: 420,
			width: 610,
			buttons: {
				"Hapus Diklat": function() {
					//insert data
							no_dupak				=	$("#no_dupak").val();
							id_diklat				=	$("#hapus_id_diklat").val();
							ak						=	$("#hapus_ak").val();
							kode_kegiatan			=	$("#hapus_kode_kegiatan").val();
						
							$.ajax({
								url:"./kelas/dupak.php",
								data:"op=hapus_diklat&id_diklat="+id_diklat+
														"&ak="+ak+
														"&kode_kegiatan="+kode_kegiatan+
														"&no_dupak="+no_dupak,
										success:function(msg){
										//alert (msg);
																	
										load_table_pd();
										$( ".load_add_diklat" ).hide();
										//$( "#tab_pd" ).accordion({collapsible: true,active : false});
										}
							})
					$( this ).dialog( "close" );
					$("#tbl_diklat").load("./kelas/load_data.php","op=load_tbl_diklat&no_dupak="+no_dupak);
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	$("#btn_form_kolektif").click(function(){
		$( "#form_kolektif" ).dialog( "open" );
	});
	
	$( "#form_kolektif" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			resizable: false,
			draggable:false,
			height: 310,
			width: 680,
			modal: true,
			buttons: {
				"Simpan Data": function() {
					//insert data
					sub_kegiatan_1			=	$("#cb_kegiatan_kolektif").val();
					sub_kegiatan_2			=	$("#cb_sub_kegiatan_2").val();	
					nm_kegiatan_kolektif	=	$("#nm_kegiatan_kolektif").val();
					tgl_kegiatan_kolektif	=	$("#tgl_kegiatan_kolektif").val();
					
					//alert(sub_kegiatan_2);
					
					no_dupak				=	$("#no_dupak").val();
					
					if (sub_kegiatan_1 == ""){
						alert("Kegiatan Masih Kosong");
						$("#cb_kegiatan_kolektif").focus().select();
					}else if (nm_kegiatan_kolektif == ""){
						alert("Nama Kegiatan Masih Kosong");
						$("#nm_kegiatan_kolektif").focus().select();
					}else if (tgl_kegiatan_kolektif == ""){
						alert("Tanggal Kegiatan Masih Kosong");
						$("#tgl_kegiatan_kolektif").focus().select();
					}else{
					
						//alert (kode_kegiatan);
						$( ".load_add_kolektif" ).show();
						$.ajax({
						url:"./kelas/dupak.php",
						data:"op=add_kolektif&no_dupak="+no_dupak+
														"&sub_kegiatan_1="+sub_kegiatan_1+
														"&sub_kegiatan_2="+sub_kegiatan_2+
														"&nm_kegiatan_kolektif="+nm_kegiatan_kolektif+
														"&tgl_kegiatan_kolektif="+tgl_kegiatan_kolektif,
								cache:false,
								success:function(msg){
								//alert (msg);
								//$("#ak").val(msg);	
								kosongkan_kolektif();
								load_table_pd();
								$( ".load_add_kolektif" ).hide();
									//$( "#tab_pd" ).accordion({collapsible: true,active : false});
								}
						})
					
					}
					$( this ).dialog( "close" );
					$("#tbl_kolektif").load("./kelas/load_data.php","op=load_tbl_kolektif&no_dupak="+no_dupak);
					load_table_pd();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})
	
	$( "#form_edit_kolektif" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			resizable: false,
			draggable:false,
			height: 290,
			width: 680,
			modal: true,
			buttons: {
				"Simpan Perubahan": function() {
					//insert data
					sub_kegiatan_1			=	$("#cb_edit_kegiatan_kolektif").val();
					sub_kegiatan_2			=	$("#cb_edit_sub_kegiatan_2").val();	
					nm_kegiatan_kolektif	=	$("#edit_nm_kegiatan_kolektif").val();
					tgl_kegiatan_kolektif	=	$("#edit_tgl_kegiatan_kolektif").val();
					
					kode_kegiatan			=	$("#edit_kode_kegiatan_kolektif").val();
					ak						=	$("#edit_ak_kolektif").val();
					no_dupak				=	$("#no_dupak").val();
					id_kolektif				=	$("#edit_id_kolektif").val();
					
					//alert(ak);
					
					if (sub_kegiatan_1 == ""){
						alert("Kegiatan Masih Kosong");
						$("#cb_edit_kegiatan_kolektif").focus().select();
					}else if (nm_kegiatan_kolektif == ""){
						alert("Nama Kegiatan Masih Kosong");
						$("#edit_nm_kegiatan_kolektif").focus().select();
					}else if (tgl_kegiatan_kolektif == ""){
						alert("Tanggal Kegiatan Masih Kosong");
						$("#edit_tgl_kegiatan_kolektif").focus().select();
					}else{
					
						//alert (kode_kegiatan);
						$( ".load_add_kolektif" ).show();
						$.ajax({
						url:"./kelas/dupak.php",
						data:"op=edit_kolektif&no_dupak="+no_dupak+
														"&sub_kegiatan_1="+sub_kegiatan_1+
														"&sub_kegiatan_2="+sub_kegiatan_2+
														"&nm_kegiatan_kolektif="+nm_kegiatan_kolektif+
														"&tgl_kegiatan_kolektif="+tgl_kegiatan_kolektif+
														"&kode_kegiatan="+kode_kegiatan+
														"&id_kolektif="+id_kolektif+
														"&ak="+ak,
								cache:false,
								success:function(msg){
								//alert (msg);
								//$("#ak").val(msg);	
								kosongkan_kolektif();
								load_table_pd();
								$( ".load_add_kolektif" ).hide();
									//$( "#tab_pd" ).accordion({collapsible: true,active : false});
								}
						})
					
					}
					$( this ).dialog( "close" );
					$("#tbl_kolektif").load("./kelas/load_data.php","op=load_tbl_kolektif&no_dupak="+no_dupak);
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			},
			
	})
	
	$( "#form_hapus_kolektif" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			height: 290,
			width: 680,
			buttons: {
				"Hapus Kolektif": function() {
					//insert data
							no_dupak				=	$("#no_dupak").val();
							id_kolektif				=	$("#hapus_id_kolektif").val();
							ak						=	$("#hapus_ak_kolektif").val();
							kode_kegiatan			=	$("#hapus_kode_kegiatan_kolektif").val();
						
							$.ajax({
								url:"./kelas/dupak.php",
								data:"op=hapus_kolektif&id_kolektif="+id_kolektif+
														"&ak="+ak+
														"&kode_kegiatan="+kode_kegiatan+
														"&no_dupak="+no_dupak,
										success:function(msg){
										alert (msg);
																	
										load_table_pd();
										$( ".load_add_kolektif" ).hide();
										//$( "#tab_pd" ).accordion({collapsible: true,active : false});
										}
							})
					$( this ).dialog( "close" );
					$("#tbl_kolektif").load("./kelas/load_data.php","op=load_tbl_kolektif&no_dupak="+no_dupak);
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
	})

	
	function kosongkan_diklat(){
		$("#nama_diklat").val("");
		$("#penyelenggara_diklat").val("");	
		$("#jp").val("");
		$("#tgl_mulai_diklat").val("");
		$("#tgl_selesai_diklat").val("");
		$("#tgl_sertifikat").val("");
		$("#no_sertifikat").val("");
	}
	
	function kosongkan_kolektif(){
		$("#cb_kegiatan_kolektif").val("");
		$("#cb_sub_kegiatan_2").val("");	
		$("#nm_kegiatan_kolektif").val("");
		$("#tgl_kegiatan_kolektif").val("");
		$("#cb_edit_kegiatan_kolektif").val("");
		$("#cb_edit_sub_kegiatan_2").val("");	
		$("#edit_nm_kegiatan_kolektif").val("");
		$("#edit_tgl_kegiatan_kolektif").val("");
		
		$("#edit_id_kolektif").val("");
		$("#edit_kode_kegiatan_kolektif").val("");
		$("#edit_ak_kolektif").val("");
	}
	
	$("#simpan_v_pkb").click(function(){
		$( "#load_simpan_pkb" ).show();
		$.ajax({
			url:"./kelas/verifikasi.php",
			data:"op=simpan_pendidikan&no_dupak="+no_dupak,
			cache:false,
                    success:function(msg){
					//alert (msg);
					//window.location.assign("?page=form_usulan_dupak&no_dupak="+no_dupak+"&nip_baru="+nip_baru);
					$( "#load_simpan_pkb" ).hide();
					$( "#tab_verifikasi_dupak" ).tabs( "enable", 6 );
					$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 6 );
					}
			})
	 });
	
	//LOAD DATA TABEL PKB
	load_table_pd();
	function load_table_pd() {
		no_dupak		=	$("#no_dupak").val();
		//alert(no_dupak);
		$.ajax({
			url:"./kelas/dupak.php",
			data:"op=load_pd&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					//alert(msg);
					
					$("#ak_19").val(data[0]);
					$("#f_19").val(data[1]);	
					$("#akf_19").val((data[1]*data[0]).toFixed(3));
					if ( data[1] != 0){$('.c_19').css('background','#fefeaf');}
					
					$("#ak_20").val(data[2]);
					$("#f_20").val(data[3]);
					$("#akf_20").val((data[2]*data[3]).toFixed(3));
					if ( data[3] != 0){$('.c_20').css('background','#fefeaf');}
					
					$("#ak_21").val(data[4]);
					$("#f_21").val(data[5]);
					$("#akf_21").val((data[4]*data[5]).toFixed(3));
					if ( data[5] != 0){$('.c_21').css('background','#fefeaf');}
					
					$("#ak_22").val(data[6]);
					$("#f_22").val(data[7]);
					$("#akf_22").val((data[6]*data[7]).toFixed(3));
					if ( data[7] != 0){$('.c_22').css('background','#fefeaf');}
					
					$("#ak_23").val(data[8]);
					$("#f_23").val(data[9]);
					$("#akf_23").val((data[8]*data[9]).toFixed(3));
					if ( data[9] != 0){$('.c_23').css('background','#fefeaf');}
					
					$("#ak_24").val(data[10]);
					$("#f_24").val(data[11]);
					$("#akf_24").val((data[10]*data[11]).toFixed(3));
					if ( data[11] != 0){$('.c_24').css('background','#fefeaf');}
					
					$("#ak_25").val(data[12]);
					$("#f_25").val(data[13]);
					$("#akf_25").val((data[12]*data[13]).toFixed(3));
					if ( data[13] != 0){$('.c_25').css('background','#fefeaf');}
	
					$("#ak_26").val(data[14]);
					$("#f_26").val(data[15]);
					$("#akf_26").val((data[14]*data[15]).toFixed(3));
					if ( data[15] != 0){$('.c_26').css('background','#fefeaf');}
					
					$("#ak_27").val(data[16]);
					$("#f_27").val(data[17]);
					$("#akf_27").val((data[16]*data[17]).toFixed(3));
					if ( data[17] != 0){$('.c_27').css('background','#fefeaf');}
					
					$("#ak_28").val(data[18]);
					$("#f_28").val(data[19]);
					$("#akf_28").val((data[18]*data[19]).toFixed(3));
					if ( data[19] != 0){$('.c_28').css('background','#fefeaf');}
					
					$("#jm_pd").val((
					(data[1]*data[0])+(data[2]*data[3])+(data[4]*data[5])+
					(data[6]*data[7])+(data[8]*data[9])+(data[10]*data[11])+
					(data[12]*data[13])+(data[14]*data[15])+(data[16]*data[17])+
					(data[18]*data[19])).toFixed(3) )
					}
		})
	}

	
	function load_penilai_pkb1() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=pkb1&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p1_19").html("<img src="+data[0]+">");
					$("#p1_20").html("<img src="+data[1]+">");
					$("#p1_21").html("<img src="+data[2]+">");
					$("#p1_22").html("<img src="+data[3]+">");
					$("#p1_23").html("<img src="+data[4]+">");
					$("#p1_24").html("<img src="+data[5]+">");
					$("#p1_25").html("<img src="+data[6]+">");
					$("#p1_26").html("<img src="+data[7]+">");
					$("#p1_27").html("<img src="+data[8]+">");
					$("#p1_28").html("<img src="+data[9]+">");
					
					
					
					
					}
		})
	}
	
		function load_penilai_pkb2() {
		$.ajax({
			url:"./kelas/hasil_penilai.php",
			data:"op=pkb2&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					data=msg.split("|");
					$("#p2_19").html("<img src="+data[0]+">");
					$("#p2_20").html("<img src="+data[1]+">");
					$("#p2_21").html("<img src="+data[2]+">");
					$("#p2_22").html("<img src="+data[3]+">");
					$("#p2_23").html("<img src="+data[4]+">");
					$("#p2_24").html("<img src="+data[5]+">");
					$("#p2_25").html("<img src="+data[6]+">");
					$("#p2_26").html("<img src="+data[7]+">");
					$("#p2_27").html("<img src="+data[8]+">");
					$("#p2_28").html("<img src="+data[9]+">");
					
					
					
					
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
						//verifikasi();
						$( "#v_pkb" ).dialog( "open" );
						$("#tbl_v_pkb").load("./kelas/load_data.php","op=v_pkb&no_dupak="+no_dupak+"&kd_keg="+kd_keg);
						
					}
					
					}
		})
	});
	
	

	$( "#v_pkb" ).dialog({
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
				load_table_pd();
				$("#tbl_diklat").load("./kelas/load_data.php","op=load_tbl_diklat&no_dupak="+no_dupak);
				$("#tbl_kolektif").load("./kelas/load_data.php","op=load_tbl_kolektif&no_dupak="+no_dupak);
				
				load_penilai_pkb1();
				load_penilai_pkb2();
			}
			
				
	})
	
	
	
	 //SIMPAN VERIFIKASI
	$("#simpan_v_pkb").click(function(){
	$( "#load_simpan_pkb" ).show();
			$.ajax({
			url:"./kelas/verifikasi.php",
			data:"op=simpan_pkb&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
					$( "#load_simpan_pkb" ).hide();
					$( "#tab_verifikasi_dupak" ).tabs( "enable", 6 );
					$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 6 );

					}
			})
	 });
	
	$( "#tab_pkb" ).accordion({
		collapsible: true,
		active : false,
		heightStyle: "content",
		header:"div.head_acor"
		
    });
	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
                cache:false,
                success:function(msg){
				//alert(msg);
				data=msg.split("|");
				$( "#progressbar" ).progressbar({value: +data[2]});
				
				if ( (data[0] >= 19) || (((data[0] >=11) && (p == 1)) || ((data[0] >=17) && (p == 2 ))  ) ){
				//if ( (data[0] >=11) && (p == 1) || (data[0] >=17) && (p == 2 ) ){
					$("#simpan_v_pkb").hide();
					$(".edit_diklat").hide();
					$(".hapus_diklat").hide();
					$(".edit_kolektif").hide();
					$(".hapus_kolektif").hide();
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

<!--      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
<!--      *****************   TABEL DIKLAT dan KEGIATAN KOLEKTIF   ********************** -->
<!--      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->


<div id="tab_pkb" style="width:732px; margin-left:30px;">
	<div class="head_acor" style="padding:8px 0 8px 30px;">FORM USULAN DIKLAT FUNGSIONAL DAN KEGIATAN KOLEKTIF</div>
	<div id="diklat_fungsional">


	<table id="tbl_diklat" width="100%" class="detail" border="1"></table><br>
	<table id="tbl_kolektif" width="100%" class="detail" border="1"></table>
	
	<br>
	<table width="560px" style="margin:0px 0 5px 0px;" border="0">
	<tr>
		<td>
			<button class="ui-state-default tambah" id="btn_form_diklat" >TAMBAH DATA DIKLAT</button>
			<button class="ui-state-default tambah" id="btn_form_kolektif" >TAMBAH KEGIATAN KOLEKTIF</button>
		</td>
	</tr>
	</table>
	
	
	</div>
</div>
<br>
<!--      *****************   END TABEL DIKLAT dan KEGIATAN KOLEKTIF   ****************** -->





<!--      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
<!--      *****************************   FORM CRUD DIKLAT   **************************** -->
<!--      ------------------------------------------------------------------------------- -->
<div id="form_diklat" title="Tambah Data Diklat">
	<table width="560px" class="form" border="0">
			<tr>
                <td>Nama Diklat</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="45px" id="nama_diklat">
                </td>
			</tr>
			<tr>
                <td>Penyelengara</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="penyelenggara_diklat">
                </td>
			</tr>
			<tr>
                <td>Jumlah Jam Pelajaran</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="4px" onkeypress="return angka(event)" maxlength="3" id="jp" > Jam
                </td>
			</tr>
			<tr>
                <td>Tanggal Mulai</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="tgl_mulai_diklat">
                </td>
			</tr>
			<tr>
                <td>Tanggal Selesai</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="tgl_selesai_diklat">
                </td>
			</tr>
			<tr>
                <td>Tanggal Sertifikat</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="tgl_sertifikat">
                </td>
			</tr>
			<tr>
                <td>No Sertifikat</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="no_sertifikat">
                </td>
			</tr>
			
        </table>
	
		<table width="560px" style="margin:10px 0 5px 20px;" border="0">
		<tr>
			<td>
				<img src="images/loader/load1.gif" class="load_add_diklat" />
			</td>
		</tr>
		</table>
</div>

<div id="form_edit_diklat" title="Edit Data Diklat">
	<table width="560px" class="form" border="0">
			<tr>
                <td>Nama Diklat</td>
                <td>
					&nbsp;&nbsp;
					<input type="hidden" size="45px" id="edit_id_diklat">
					<input type="hidden" size="45px" id="edit_kode_kegiatan">
					<input type="hidden" size="45px" id="edit_ak">
					<input type="text" size="45px" id="edit_nama_diklat">
                </td>
			</tr>
			<tr>
                <td>Penyelengara</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="edit_penyelenggara_diklat">
                </td>
			</tr>
			<tr>
                <td>Jumlah Jam Pelajaran</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="4px" onkeypress="return angka(event)" maxlength="3" id="edit_jp" > Jam
                </td>
			</tr>
			<tr>
                <td>Tanggal Mulai</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="edit_tgl_mulai_diklat">
                </td>
			</tr>
			<tr>
                <td>Tanggal Selesai</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="edit_tgl_selesai_diklat">
                </td>
			</tr>
			<tr>
                <td>Tanggal Sertifikat</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="edit_tgl_sertifikat">
                </td>
			</tr>
			<tr>
                <td>No Sertifikat</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="edit_no_sertifikat">
                </td>
			</tr>
			
        </table>
	
		<table width="560px" style="margin:10px 0 5px 20px;" border="0">
		<tr>
			<td>
				<img src="images/loader/load1.gif" class="load_add_diklat" />
			</td>
		</tr>
		</table>
</div>

<div id="form_hapus_diklat" title="Hapus Data Diklat">
	<table width="560px" class="form" border="0">
			<tr>
                <td>Nama Diklat</td>
                <td>
					&nbsp;&nbsp;
					<input type="hidden" size="45px" id="hapus_id_diklat">
					<input type="hidden" size="45px" id="hapus_kode_kegiatan">
					<input type="hidden" size="45px" id="hapus_ak">
					<input type="text" size="45px" id="hapus_nama_diklat" disabled>
                </td>
			</tr>
			<tr>
                <td>Penyelengara</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="hapus_penyelenggara_diklat" disabled>
                </td>
			</tr>
			<tr>
                <td>Jumlah Jam Pelajaran</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="4px" onkeypress="return angka(event)" maxlength="3" id="hapus_jp" disabled> Jam
                </td>
			</tr>
			<tr>
                <td>Tanggal Mulai</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="hapus_tgl_mulai_diklat" disabled>
                </td>
			</tr>
			<tr>
                <td>Tanggal Selesai</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="hapus_tgl_selesai_diklat" disabled>
                </td>
			</tr>
			<tr>
                <td>Tanggal Sertifikat</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="hapus_tgl_sertifikat" disabled>
                </td>
			</tr>
			<tr>
                <td>No Sertifikat</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="hapus_no_sertifikat" disabled>
                </td>
			</tr>
			
        </table>
	
		<table width="560px" style="margin:10px 0 5px 20px;" border="0">
		<tr>
			<td>
				<img src="images/loader/load1.gif" class="load_add_diklat" />
			</td>
		</tr>
		</table>
</div>
<!--      ************************   END FORM  DIKLAT   ****************** -->





<!--      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
<!--      ******************   FORM CRUD Kegiatan Kolektif   **************************** -->
<!--      ------------------------------------------------------------------------------- -->
<div id="form_kolektif" title="Tambah Data Kegiatan Kolektif">
	<table width="630px" class="form" border="1">
			<tr>
                <td>Kegiatan</td>
                <td>
				&nbsp;&nbsp;
					<select id="cb_kegiatan_kolektif"  >
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT DISTINCT sub_kegiatan_1  FROM kd_kegiatan_dan_ak WHERE kegiatan = 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['sub_kegiatan_1']; ?>" ><?php echo substr($r['sub_kegiatan_1'],0,210); ?></option>
						<?php
						}
						?>
					</select>
                </td>
			</tr>
			<tr>
                <td>Sub Kegiatan</td>
                <td>
				&nbsp;&nbsp;
					<select id="cb_sub_kegiatan_2" style="width:295px;"></select>
                </td>
			</tr>
			<tr>
                <td>Nama Kegiatan Kolektif</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="nm_kegiatan_kolektif">
                </td>
			</tr>
			<tr>
                <td>Tanggal Pelaksanaan</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="tgl_kegiatan_kolektif">
                </td>
			</tr>
        </table>
		<table width="560px" style="margin:10px 0 5px 20px;" border="0">
		<tr>
			<td>
				<img src="images/loader/load1.gif" class="load_add_kolektif" />
			</td>
		</tr>
		</table>
</div>

<div id="form_edit_kolektif" title="Edit Data Kegiatan Kolektif">
	<table width="630px" class="form" border="1">
			<tr>
                <td>Kegiatan</td>
                <td>
				&nbsp;&nbsp;
					<input type="hidden" size="45px" id="edit_id_kolektif">
					<input type="hidden" size="45px" id="edit_kode_kegiatan_kolektif">
					<input type="hidden" size="45px" id="edit_ak_kolektif">
					<select id="cb_edit_kegiatan_kolektif"  >
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT DISTINCT sub_kegiatan_1  FROM kd_kegiatan_dan_ak WHERE kegiatan = 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['sub_kegiatan_1']; ?>" ><?php echo substr($r['sub_kegiatan_1'],0,210); ?></option>
						<?php
						}
						?>
					</select>
                </td>
			</tr>
			<tr>
                <td>Sub Kegiatan</td>
                <td>
				&nbsp;&nbsp;
					<select id="cb_edit_sub_kegiatan_2" style="width:295px;">
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT DISTINCT sub_kegiatan_2  FROM kd_kegiatan_dan_ak WHERE kegiatan = 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['sub_kegiatan_2']; ?>" ><?php echo substr($r['sub_kegiatan_2'],0,210); ?></option>
						<?php
						}
						?>
					
					</select>
                </td>
			</tr>
			<tr>
                <td>Nama Kegiatan Kolektif</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="edit_nm_kegiatan_kolektif">
                </td>
			</tr>
			<tr>
                <td>Tanggal Pelaksanaan</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="edit_tgl_kegiatan_kolektif">
                </td>
			</tr>
        </table>
		<table width="560px" style="margin:10px 0 5px 20px;" border="0">
		<tr>
			<td>
				<img src="images/loader/load1.gif" class="load_add_kolektif" />
			</td>
		</tr>
		</table>
</div>

<div id="v_pkb" title="Verifikasi Data">
	<table id="tbl_v_pkb" width="100%" class="detail" border="1"></table>
</div>	

<div id="form_hapus_kolektif" title="Hapus Data Kegiatan Kolektif">
	<table width="630px" class="form" border="1">
			<tr>
                <td>Kegiatan</td>
                <td>
				&nbsp;&nbsp;
					<input type="hidden" size="45px" id="hapus_id_kolektif">
					<input type="hidden" size="45px" id="hapus_kode_kegiatan_kolektif">
					<input type="hidden" size="45px" id="hapus_ak_kolektif">
					<select id="cb_hapus_kegiatan_kolektif" disabled >
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT DISTINCT sub_kegiatan_1  FROM kd_kegiatan_dan_ak WHERE kegiatan = 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['sub_kegiatan_1']; ?>" ><?php echo substr($r['sub_kegiatan_1'],0,210); ?></option>
						<?php
						}
						?>
					</select>
                </td>
			</tr>
			<tr>
                <td>Sub Kegiatan</td>
                <td>
				&nbsp;&nbsp;
					<select id="cb_hapus_sub_kegiatan_2" style="width:295px;" disabled>
					<option value=""></option>
					<?php
							Connect::getConnection();
							$row = mysql_query("SELECT DISTINCT sub_kegiatan_2  FROM kd_kegiatan_dan_ak WHERE kegiatan = 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru' ");
							while ($r = mysql_fetch_array($row)){
						?>
						<option value="<?php echo $r['sub_kegiatan_2']; ?>" ><?php echo substr($r['sub_kegiatan_2'],0,210); ?></option>
						<?php
						}
						?>
					
					</select>
                </td>
			</tr>
			<tr>
                <td>Nama Kegiatan Kolektif</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" size="45px" id="hapus_nm_kegiatan_kolektif" disabled>
                </td>
			</tr>
			<tr>
                <td>Tanggal Pelaksanaan</td>
                <td>
				&nbsp;&nbsp;
					<input type="text" placeholder="dd-mm-yyyy" size="10px"  maxlength="10" onkeypress='return angka(event)' id="hapus_tgl_kegiatan_kolektif" disabled>
                </td>
			</tr>
        </table>
		<table width="560px" style="margin:10px 0 5px 20px;" border="0">
		<tr>
			<td>
				<img src="images/loader/load1.gif" class="load_add_kolektif" />
			</td>
		</tr>
		</table>
</div>
<!--      ************************   END FORM  DIKLAT   ****************** -->
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
	<td width="2%" rowspan="16" valign="top" align="center">
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
	<td width="2%" rowspan="14" valign="top" align="center">
		A.
	</td>
	<td>
		Melaksanakan Pengembangan Diri
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
		1. &nbsp;Mengikuti Diklat Fungsional
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
<tr class="c_19">
	<td style="padding-left:23px;">
		a. Lamanya antara 960 jam
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="19">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_19">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_19">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_19">
	</td>
	<td  align="center">
		<span id="p1_19" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_19" class="nilai" ></span>
	</td>
</tr>
<tr class="c_20">
	<td style="padding-left:23px;">
		b. Lamanya antara 641 s.d 960 jam
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="20">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_20">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_20">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_20">
	</td>
	<td  align="center">
		<span id="p1_20" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_20" class="nilai" ></span>
	</td>
</tr>
<tr class="c_21">
	<td style="padding-left:23px;">
		c. Lamanya antara 481 s.d 640 jam
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="21">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_21">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled     id="f_21">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_21">
	</td>
	<td  align="center">
		<span id="p1_21" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_21" class="nilai" ></span>
	</td>
</tr>
<tr class="c_22">
	<td style="padding-left:23px;">
		d. Lamanya antara 161 s.d 480 jam
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="22">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_22">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_22">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_22">
	</td>
	<td  align="center">
		<span id="p1_22" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_22" class="nilai" ></span>
	</td>
</tr>
<tr class="c_23">
	<td style="padding-left:23px;">
		e. Lamanya antara 81 s.d 160 jam
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="23">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_23">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_23">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_23">
	</td>
	<td  align="center">
		<span id="p1_23" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_23" class="nilai" ></span>
	</td>
</tr>
<tr class="c_24">
	<td style="padding-left:23px;">
		f. Lamanya antara 30 s.d 80 jam
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="24">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_24">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_24">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_24">
	</td>
	<td  align="center">
		<span id="p1_24" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_24" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td>
		2.  &nbsp;Kegiatan kolektif guru yang meningkatkan kompetensi 
		<p style="margin-left:18px">dan/atau  keprofesian guru</p>
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
<tr class="c_25">
	<td style="padding-left:23px;">
		a. Lokakarya atau kegiatan bersama (seperti
		<p style="margin-left:14px"> kelompok kerja guru)  untuk penyusunan perangkat kurikulum dan atau pembelajaran</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="25">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_25">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled  id="f_25">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_25">
	</td>
	<td  align="center">
		<span id="p1_25" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_25" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td style="padding-left:23px;">
		b. Keikutsertaan pada kegiatan ilmiah (seminar,
		<p style="margin-left:14px"> kologium dan diskusi  panel)</p>
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
<tr class="c_26">
	<td style="padding-left:35px;">
		1. Menjadi pembahas pada kegiatan ilmiah
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="26">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_26">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled  id="f_26">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_26">
	</td>
	<td  align="center">
		<span id="p1_26" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_26" class="nilai" ></span>
	</td>
</tr>
<tr class="c_27">
	<td style="padding-left:35px;">
		2. Menjadi peserta pada kegiatan ilmiah
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="27">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_27">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_27">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_27">
	</td>
	<td  align="center">
		<span id="p1_27" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_27" class="nilai" ></span>
	</td>
</tr>
<tr class="c_28">
	<td style="padding-left:23px;">
		c. Kegiatan kolektif lainnya yang sesuai dengan tugas 
		<p style="margin-left:14px">dan kewajiban  guru</p>
	</td>
	<td  align="center">
		<input type="text" class="kd_keg" readonly value="28">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="ak_28">
	</td>
	<td  align="center">
		<input type="text" class="ak_freq" disabled id="f_28">
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="akf_28">
	</td>
	<td  align="center">
		<span id="p1_28" class="nilai" ></span>
	</td>
	<td  align="center">
		<span id="p2_28" class="nilai" ></span>
	</td>
</tr>
<tr>
	<td colspan="2" class="isi" style="padding-left:27px;">
		JUMLAH MELAKSANAKAN PENGEMBANGAN DIRI
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		
	</td>
	<td  align="center">
		<input type="text" class="ak_field" disabled id="jm_pd">
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
		<button class="ui-state-default lanjut" id="simpan_v_pkb" >SIMPAN DATA VERIFIKASI PKB</button>
		<img src="images/loader/load1.gif" id="load_simpan_pkb" />
	</td>
</tr>
</table>


