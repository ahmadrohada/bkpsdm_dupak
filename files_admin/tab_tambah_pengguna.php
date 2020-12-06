<script>
$(document).ready(function () {
	$("#load_nip_tu").hide();
	$("#load_nip_kepsek").hide();
	
	
	
	
	
	
	
// ******************************************************* //			
// --------------- ADMINISTRATOR   ----------------------- //		
// ******************************************************* //	
	
	$("#load_nip_administrator").hide();
	
	
	$("#nip_administrator").keyup(function(){
	//alert("tes");
	nip_baru=$("#nip_administrator").val();
	$("#simpan_administrator").attr("disabled", false);
	
	if(nip_baru.length == 18){
	$("#load_nip_administrator").show();
	//CARI DATA PEGAWAI
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_nip_pegawai&nip_baru="+nip_baru,
        cache:false,
        success:function(msg){
			$("#load_nip_administrator").hide();
			//alert(msg);
			data=msg.split("|");
			
			
			
			if (data[0] == 1 ){
			//alert(data[4]);
			$("#id_administrator").val(data[1]);
			$("#nama_lengkap_administrator").val(data[3]);
			$("#jk_administrator").val(data[4]);
		
			$("#login_administrator").val(data[2]);
			$("#password_administrator").val("12345");
			
			$("#login_administrator").attr("disabled", false);
			$("#password_administrator").attr("disabled", false);
			
			$("#simpan_administrator").focus();
			
			}else if(data[0] == 0 ) {
				alert("NIP tidak ditemukan dalam basis data");
			}else if(data[0] == 2 ) {
				alert("NIP Sudah terdaftar");
				$("#simpan_administrator").attr("disabled", true);
			}
		}
	})
	}else{
			$("#id_administrator").val("");
			$("#nama_lengkap_administrator").val("");
			$("#jk_administrator").val("");
		
			$("#password_administrator").val("");
			$("#login_administrator").val("");
		
	}
	});
	
	
	$("#simpan_administrator").click(function(){
		id_administrator 		= $("#id_administrator").val(); //untuk id_pegawai
		nip_administrator 		= $("#nip_administrator").val();
		nama_administrator 		= $("#nama_lengkap_administrator").val();
		jk_administrator 		= $("#jk_administrator").val();
		
		login_administrator 	= $("#login_administrator").val();
		password_administrator 	= $("#password_administrator").val();
		group		 			= "1";
		
		
		alert(login_administrator);
		
		
		if (id_administrator == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"NIP Pegawai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nip_administrator").focus();
					}
				}
			});
			
		}else{
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=simpan_pengguna&id_pegawai="+id_administrator+
									"&nip_pengguna="+nip_administrator+
									"&nama_pengguna="+nama_administrator+
									"&jk="+jk_administrator+
									"&user_login="+login_administrator+
									"&password="+password_administrator+
									"&group="+group,
									
									
									
                    cache:false,
                    success:function(msg){
					//alert (msg);
						if (msg == "error"){
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna dengan NIP tersebut sudah ada</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									$("#nip_administrator").focus().select();
									}
								}
							});
						
						}else{
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-disk' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna berhasil disimpan</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									kosongkan();
									}
								}
							});
						}
						
					}
		})
		
		}
	});
	
	
// ******************************************************* //



// ******************************************************* //			
// ---------------  SEKRETARIAT   ----------------------- //		
// ******************************************************* //		

	$("#load_nip_sekretariat").hide();
	
	$("#nip_sekretariat").keyup(function(){
	//alert("tes");
	nip_baru=$("#nip_sekretariat").val();
	
	if(nip_baru.length == 18){
	$("#load_nip_sekretariat").show();
	//CARI DATA PEGAWAI
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_nip_pegawai&nip_baru="+nip_baru,
        cache:false,
        success:function(msg){
			$("#load_nip_sekretariat").hide();
			//alert(msg);
			data=msg.split("|");
			
			if (data[0] == 1 ){
				//alert(data[4]);
				$("#id_sekretariat").val(data[1]);
				$("#nama_lengkap_sekretariat").val(data[3]);
				$("#jk_sekretariat").val(data[4]);
			
				$("#login_sekretariat").val(data[2]);
				$("#password_sekretariat").val("12345");
				
				$("#login_sekretariat").attr("disabled", false);
				$("#password_sekretariat").attr("disabled", false);
				
				$("#simpan_sekretariat").focus();
				
				}else if(data[0] == 0 ) {
					alert("NIP tidak ditemukan dalam basis data");
				}else if(data[0] == 2 ) {
					alert("NIP Sudah terdaftar");
					$("#simpan_sekretariat").attr("disabled", true);
			}
		}
	})
	}else{
			$("#id_sekretariat").val("");
			$("#nama_lengkap_sekretariat").val("");
			$("#jk_sekretariat").val("");
		
			$("#password_sekretariat").val("");
			$("#login_sekretariat").val("");
		
	}
	});
	
	
	
$("#simpan_sekretariat").click(function(){
		id_sekretariat 		= $("#id_sekretariat").val(); //untuk id_pegawai
		nip_sekretariat 		= $("#nip_sekretariat").val();
		nama_sekretariat 		= $("#nama_lengkap_sekretariat").val();
		jk_sekretariat 		= $("#jk_sekretariat").val();
		
		login_sekretariat 	= $("#login_sekretariat").val();
		password_sekretariat 	= $("#password_sekretariat").val();
		group		 			= "2";
		
		if (id_sekretariat == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"NIP Pegawai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nip_sekretariat").focus();
					}
				}
			});
			
		}else{
			$.ajax({
			url:"./kelas/proses.php",
						data:"op=simpan_pengguna&id_pegawai="+id_sekretariat+
									"&nip_pengguna="+nip_sekretariat+
									"&nama_pengguna="+nama_sekretariat+
									"&jk="+jk_sekretariat+
									"&user_login="+login_sekretariat+
									"&password="+password_sekretariat+
									"&group="+group,
                    cache:false,
                    success:function(msg){
					//alert (msg);
						if (msg == "error"){
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna dengan NIP tersebut sudah ada</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									$("#nip_sekretariat").focus().select();
									}
								}
							});
						
						}else{
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-disk' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna berhasil disimpan</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									kosongkan();
									}
								}
							});
						}
						
					}
		})
		}
	});
	
	
// ******************************************************* //
	
	
	
// ******************************************************* //			
// ---------------  TIM PENILAI   ----------------------- //		
// ******************************************************* //	
	$("#load_nip_penilai").hide();
	
	$("#nip_penilai").keyup(function(){
	//alert("tes");
	nip_baru=$("#nip_penilai").val();
	
	if(nip_baru.length == 18){
	
	$("#load_nip_penilai").show();
	//CARI DATA PEGAWAI
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_nip_pegawai&nip_baru="+nip_baru,
        cache:false,
        success:function(msg){
			$("#load_nip_penilai").hide();
			//alert(msg);
			data=msg.split("|");
			
			if (data[0] == 1 ){
				//alert(data[4]);
				$("#id_penilai").val(data[1]);
				$("#nama_lengkap_penilai").val(data[3]);
				$("#jk_penilai").val(data[4]);
			
				$("#login_penilai").val(data[2]);
				$("#password_penilai").val("12345");
				
				$("#login_penilai").attr("disabled", false);
				$("#password_penilai").attr("disabled", false);
				
				$("#simpan_penilai").focus();
				
				}else if(data[0] == 0 ) {
					alert("NIP tidak ditemukan dalam basis data");
				}else if(data[0] == 2 ) {
					alert("NIP Sudah terdaftar");
					$("#simpan_penilai").attr("disabled", true);
			}
		}
		})
	}else{
			$("#id_penilai").val("");
			$("#nama_lengkap_penilai").val("");
			$("#jk_penilai").val("");
		
			$("#password_penilai").val("");
			$("#login_penilai").val("");
		
	}
	
	
	
	});
	
	
	$("#simpan_penilai").click(function(){
		id_penilai 		= $("#id_penilai").val(); //untuk id_pegawai
		nip_penilai 	= $("#nip_penilai").val();
		nama_penilai 	= $("#nama_lengkap_penilai").val();
		jk_penilai 		= $("#jk_penilai").val();
		
		login_penilai 	= $("#login_penilai").val();
		password_penilai= $("#password_penilai").val();
		group		 		= "3";
		
		if (id_penilai == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"NIP Pegawai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nip_penilai").focus();
					}
				}
			});
			
		}else{
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=simpan_pengguna&id_pegawai="+id_penilai+
									"&nip_pengguna="+nip_penilai+
									"&nama_pengguna="+nama_penilai+
									"&jk="+jk_penilai+
									"&user_login="+login_penilai+
									"&password="+password_penilai+
									"&group="+group,
                    cache:false,
                    success:function(msg){
					//alert (msg);
						if (msg == "error"){
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna dengan NIP tersebut sudah ada</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									$("#nip_penilai").focus().select();
									}
								}
							});
						
						}else{
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-disk' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna berhasil disimpan</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									kosongkan();
									}
								}
							});
						}
						
					}
		})
		}
	});
// ******************************************************* //

	
	
	
	$("#sekolah").change(function(){
		$("#nip_tu").attr("disabled", false);
		$("#nama_lengkap_tu").attr("disabled", false);
		$("#jk_tu").attr("disabled", false);
		$("#login_tu").attr("disabled", false);
		$("#password_tu").attr("disabled", false);
		$("#nip_tu").focus();
		

	});
	
	
	$("#nip_tu").keyup(function(){
		kd_skpd=$("#kd_skpd").val();
		//cek apakah sekolah sudah punya user
		//alert(kd_skpd);
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_skpd_user&kd_skpd="+kd_skpd,
        cache:false,
				success:function(msg){
				data=msg.split("|");	
					//alert(msg);
					if ( data[0] == 1){
						alert("data sekolah sudah diregistrasi");
					}
				
					
					
				}
		})
		
		
	});
	
	/**
	$("#nip_tu").keyup(function(){
	nip_baru=$("#nip_tu").val();
		
	if(nip_baru.length == 18){
	nip_baru=$("#nip_tu").val();
	$("#load_nip_tu").show();
	//CARI DATA PEGAWAI
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_nip_pegawai&nip_baru="+nip_baru,
        cache:false,
        success:function(msg){
			$("#load_nip_tu").hide();
			//alert(msg);
			data=msg.split("|");
			
			
			
			if (data[0] == 1 ){
			//alert(data[4]);
			$("#id_tu").val(data[1]);
			$("#nama_lengkap_tu").val(data[3]);
			$("#jk_tu").val(data[4]);
			$("#kd_skpd").val(data[5]);
			$("#sekolah").val(data[6]);
			
			$("#password_tu").val("bkd12345");
			$("#login_tu").val(data[2]);
			
			$("#nip_kepsek").focus();
			}else{
				alert("NIP tidak ditemukan dalam basis data");
			}
		}
	})
	
	}else{
			$("#nama_lengkap_tu").val("");
			$("#id_tu").val("");
			$("#jk_tu").val("0");
			$("#sekolah").val("");
			$("#kd_skpd").val("");
			
			$("#load_nip_tu").hide();
		}
	});

	
	
	$("#nip_kepsek").keyup(function(){
	nip_kepsek	= $("#nip_kepsek").val();
	nip_baru	= $("#nip_tu").val();
		
	if(nip_baru.length == 18){
	//alert("tes");

	
	if ( nip_kepsek == nip_baru ){
		alert("Error");
		$("#nip_kepsek").focus().select();
	}else{
	
	$("#load_nip_kepsek").show();
	//CARI DATA PEGAWAI
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=cari_nip_pegawai&nip_baru="+nip_kepsek,
        cache:false,
        success:function(msg){
			$("#load_nip_kepsek").hide();
			//alert(msg);
			data=msg.split("|");
			
			
			
			if (data[0] == 1 ){
			//alert(data[4]);
			$("#id_kepsek").val(data[1]);
			$("#nama_kepsek").val(data[3]);
	
			
			$("#simpan_tu").focus();
			
			}else{
				//alert("NIP tidak ditemukan dalam basis data");
				$("#nama_kepsek").val("");
				$("#id_kepsek").val("");
			}
		}
	})
	}
	}else{
			$("#id_kepsek").val("");
			$("#nama_kepsek").val("");
			$("#jk_tu").val("0");
			$("#load_nip_kepsek").hide();
		}
	});
	
	
	**/
	
	function kosongkan(){
		//TU
		$("#nip_tu").val("");
		$("#nama_lengkap_tu").val("");
		$("#kd_skpd").val("");
		$("#sekolah").val("");
		
		
		$("#nip_tu").attr("disabled", true);
		$("#nama_lengkap_tu").attr("disabled", true);
		$("#jk_tu").attr("disabled", true);
		$("#login_tu").attr("disabled", true);
		$("#password_tu").attr("disabled", true);
		
		
			
		$("#password_tu").val("");
		$("#login_tu").val("");
			
		//$("#nip_kepsek").val("");
		//$("#id_kepsek").val("");
		//$("#nama_kepsek").val("");
	
		//PENILAI
		$("#id_penilai").val("");
		$("#nip_penilai").val("");
		$("#nama_lengkap_penilai").val("");
		$("#jk_penilai").val("");
		$("#password_penilai").val("");
		$("#login_penilai").val("");
		
		//SEKRETARIAT
		$("#id_sekretariat").val("");
		$("#nip_sekretariat").val("");
		$("#nama_lengkap_sekretariat").val("");
		$("#jk_sekretariat").val("");
		$("#password_sekretariat").val("");
		$("#login_sekretariat").val("");
		
		//Admin
		$("#id_administrator").val("");
		$("#nip_administrator").val("");
		$("#nama_lengkap_administrator").val("");
		$("#jk_administrator").val("");
		$("#password_administrator").val("");
		$("#login_administrator").val("");
	}
	
	

	
	
	
	
	
	
	
	$("#simpan_tu").click(function(){
		nip_tu 			= $("#nip_tu").val();
		nama_tu			= $("#nama_lengkap_tu").val();
		jk				= $("#jk_tu").val();
		login_tu 		= $("#login_tu").val();
		password_tu 	= $("#password_tu").val();
		group		 	= "4";
		
		kd_skpd		 	= $("#kd_skpd").val();
		//id_kepsek		= $("#id_kepsek").val();
		
		if (nip_tu == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"NIP Pegawai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nip_tu").focus();
					}
				}
			});
			
		}else if (nama_tu == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Nama Pegawai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nama_tu").focus();
					}
				}
			});
			
		}else if (login_tu == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Username tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#login_tu").focus();
					}
				}
			});
		}else if (password_tu == ""){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Password tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#password_tu").focus();
					}
				}
			});
		}else{
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=simpan_pengguna&user_login="+login_tu+
									"&password="+password_tu+
									"&group="+group+
									"&kd_skpd="+kd_skpd+
									"&nip_pengguna="+nip_tu+
									"&nama_pengguna="+nama_tu+
									"&jk="+jk,
                    cache:false,
                    success:function(msg){
					//alert (msg);
						if (msg == "error"){
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna dengan NIP tersebut sudah ada</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									$("#nip_tu").focus().select();
									}
								}
							});
						
						}else{
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-disk' style='float:left; margin:0 0 10px 5px;'></span>"
								+"Data Pengguna berhasil disimpan</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 150,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									kosongkan();
									}
								}
							});
						}
						
					}
		})
		
		
		}
		
		
		
	});
	
	
	
});



</script>

<script src="./js/custom_ajax.js"></script>


<?php

$level	= isset($_GET['level']) ? $_GET['level'] : '';



switch($level){
case "administrator":
?>
	<h3 class="page-header" style="margin-left:35px;">Tambah Administrator</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_administrator" size="45" placeholder="NIP" onkeypress='return angka(event)' >
		
		<img src="images/loader/load4.gif" id="load_nip_administrator"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		<input type="hidden" id="id_administrator">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_administrator" size="45" placeholder="Nama Lengkap" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_administrator" disabled>
			<option value="0"></option>
			<option value="1">Laki-laki</option>
			<option value="2">Perempuan</option>
		</select>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_administrator" maxlength="15" size="45" placeholder="Nama yang dipakai untuk login" disabled></td>
	</tr>
	<tr>                       
		<td>Password</td>
		<td><input type="text" id="password_administrator" maxlength="15" size="45" placeholder="Kata Sandi Login" disabled></td>
	</tr>
	</tr>						
		<td colspan="2">
		
		</td>
	</tr>
	</table>	
	<button style="margin-left:35px;" class="ui-state-default simpan" id="simpan_administrator" >Simpan</button>
	
<?php	
break;
case "sekretariat":
?>
	<h3 class="page-header" style="margin-left:35px;">Tambah Sekretariat</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_sekretariat" size="45" placeholder="NIP" onkeypress='return angka(event)' >
		
		<img src="images/loader/load4.gif" id="load_nip_sekretariat"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		<input type="hidden" id="id_sekretariat">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_sekretariat" size="45" placeholder="Nama Lengkap" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_sekretariat" disabled>
			<option value="0"></option>
			<option value="1">Laki-laki</option>
			<option value="2">Perempuan</option>
		</select>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_sekretariat" maxlength="15" size="45" placeholder="Nama yang dipakai untuk login" ></td>
	</tr>
	<tr>                       
		<td>Password</td>
		<td><input type="text" id="password_sekretariat" maxlength="15" size="45" placeholder="Kata Sandi Login" ></td>
	</tr>
	</tr>						
		<td colspan="2">
		
		</td>
	</tr>
	</table>	
	<button style="margin-left:35px;" class="ui-state-default simpan" id="simpan_sekretariat" >Simpan</button>


<?php
break;
case "tim_penilai":
?>	
	<h3 class="page-header" style="margin-left:35px;">Tambah TIM PENILAI PAK</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_penilai" size="45" maxlength="18" placeholder="NIP" onkeypress='return angka(event)' >
		
		<img src="images/loader/load4.gif" id="load_nip_penilai"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		<input type="hidden" id="id_penilai">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_penilai" size="45" placeholder="Nama Lengkap" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_penilai" disabled>
			<option value="0"></option>
			<option value="1">Laki-laki</option>
			<option value="2">Perempuan</option>
		</select>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_penilai" maxlength="15" size="45" placeholder="Nama yang dipakai untuk login" ></td>
	</tr>
	<tr>                       
		<td>Password</td>
		<td><input type="text" id="password_penilai" maxlength="15" size="45" placeholder="Kata Sandi Login" ></td>
	</tr>
	</tr>						
		<td colspan="2">
		
		</td>
	</tr>
	</table>	
	<button style="margin-left:35px;" class="ui-state-default simpan" id="simpan_penilai" >Simpan</button>

<?php
break;
case "petugas_sekolah":
?>	
	<h3 class="page-header" style="margin-left:35px;">Tambah Petugas Sekolah ( Tata Usaha )</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>                       
		<td valign="top" td width="30%">Nama Sekolah</td>
		<td>
		<div class="input_container">
		<textarea style="width:290px; height:40px; padding:2px 0 5px 5px; resize: none; " id="sekolah" onkeyup="autocomplet()" ></textarea>
		<ul style="margin-left:0px; " id="sekolah_list_id"></ul>
		</div>
		<input type="hidden" id="kd_skpd" >
		</td>
	</tr>
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_tu" size="45" maxlength="18" placeholder="NIP" onkeypress='return angka(event)' disabled >
		
	
		
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap</td>
		<td><input type="text" id="nama_lengkap_tu" size="45" placeholder="Nama Lengkap" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_tu" disabled>
			<option value="1">Laki-laki</option>
			<option value="2">Perempuan</option>
		</select>
		</td>
	</tr>
	</table>
	
	<!--
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Sekolah</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr class="skpd_field">                       
		<td>NIP Kepala Sekolah</td>
		<td>
		<input type="text" maxlength="18" id="nip_kepsek" size="45" placeholder="NIP Kepala Sekolah" >
		<img src="images/loader/load4.gif" id="load_nip_kepsek"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		
		<input type="hidden" id="id_kepsek" >
		</td>
	</tr>
	<tr class="skpd_field">                       
		<td>Nama Kepala Sekolah</td>
		<td><input type="text" id="nama_kepsek" size="45" placeholder="Nama Kepala Sekolah" disabled></td>
	</tr>
	</table>
	-->
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Username</td>
		<td><input type="text" id="login_tu" maxlength="15" size="45" onkeypress='return username(event)' disabled placeholder="Nama yang dipakai untuk login" ></td>
	</tr>
	<tr>                       
		<td>Password</td>
		<td><input type="text" id="password_tu" maxlength="15" size="45" onkeypress='return pass(event)' value="12345" disabled placeholder="Kata Sandi Login" ></td>
	</tr>
	</tr>						
		<td colspan="2">
		
		</td>
	</tr>
	</table>	
	<button style="margin-left:35px;" class="ui-state-default simpan" id="simpan_tu" >Simpan</button>
<?php
break;
}
?>