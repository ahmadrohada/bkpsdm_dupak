<script>
$(document).ready(function () {
	
	
// ******************************************************* //			
// ------------------- administrator ----------------------- //		
// ******************************************************* //	
	$("#batal_administrator").hide();
	$("#update_administrator").hide();
	$("#load_update_administrator").hide();

	
	function enable_administrator(){
		//$("#nip_administrator").attr("disabled", false);
		$("#nama_lengkap_administrator").attr("disabled", false);
		$("#jk_administrator").attr("disabled", false);
		$("#login_administrator").attr("disabled", false);
		$("#password_administrator").attr("disabled", false);
		$("#status_administrator").attr("disabled", false);
		
	}
	
	function disable_administrator(){
		$("#nip_administrator").attr("disabled", true);
		$("#nama_lengkap_administrator").attr("disabled", true);
		$("#jk_administrator").attr("disabled", true);
		$("#login_administrator").attr("disabled", true);
		$("#password_administrator").attr("disabled", true);
		$("#status_administrator").attr("disabled", true);
		
	}
	
	
	$("#edit_administrator").click(function(){
		enable_administrator();
		$("#nip_administrator").focus();
		$("#edit_administrator").hide();
		$("#batal_administrator").show();
		$("#update_administrator").show();
		
	});	
	
	
	$("#batal_administrator").click(function(){
		disable_administrator();
		$("#batal_administrator").hide();
		$("#update_administrator").hide();
		$("#edit_administrator").show();
		
	});	
	
	$("#update_administrator").click(function(){
		id_administrator			= $("#id_administrator").val();
		nip_administrator			= $("#nip_administrator").val();
		nama_administrator			= $("#nama_lengkap_administrator").val();
		jk_administrator			= $("#jk_administrator").val();
		login_administrator		= $("#login_administrator").val();
		password_administrator		= $("#password_administrator").val();
		status_administrator		= $("#status_administrator").val();
		
		//alert(status_administrator);
		
	
		if (nip_administrator == ""){
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
			
		}else if (nama_administrator == ""){
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
					$("#nama_lengkap_tu").focus();
					}
				}
			});
			
		}else if (login_administrator == ""){
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
					$("#login_administrator").focus();
					}
				}
			});
		}else{
		
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=update_pengguna&id_pengguna="			+id_administrator+
									"&nip_pengguna="		+nip_administrator+
									"&nama_pengguna="		+nama_administrator+
									"&jk="					+jk_administrator+
									"&user_login="			+login_administrator+
									"&password="			+password_administrator+
									"&status="				+status_administrator,
						cache:false,
						beforeSend: function() {
							$("#load_update_administrator").show();
						},
						complete: function() {
							$("#load_update_administrator").hide();
						},
						success:function(msg){
						//alert(msg);
						if (msg==1){
							disable_administrator();
							$("#batal_administrator").hide();
							$("#update_administrator").hide();
							$("#edit_administrator").show();
						}else{
							alert(msg);
						}
						
						
						}
			})
		} //end else kosong 
	});	
// ******************************************************* //
	
	
// ******************************************************* //			
// ------------------- sekretariat ----------------------- //		
// ******************************************************* //	
	$("#batal_sekretariat").hide();
	$("#update_sekretariat").hide();
	$("#load_update_sekretariat").hide();

	
	function enable_sekretariat(){
		//$("#nip_sekretariat").attr("disabled", false);
		$("#nama_lengkap_sekretariat").attr("disabled", false);
		$("#jk_sekretariat").attr("disabled", false);
		$("#login_sekretariat").attr("disabled", false);
		$("#password_sekretariat").attr("disabled", false);
		$("#status_sekretariat").attr("disabled", false);
		
	}
	
	function disable_sekretariat(){
		$("#nip_sekretariat").attr("disabled", true);
		$("#nama_lengkap_sekretariat").attr("disabled", true);
		$("#jk_sekretariat").attr("disabled", true);
		$("#login_sekretariat").attr("disabled", true);
		$("#password_sekretariat").attr("disabled", true);
		$("#status_sekretariat").attr("disabled", true);
		
	}
	
	
	$("#edit_sekretariat").click(function(){
		enable_sekretariat();
		$("#nip_sekretariat").focus();
		$("#edit_sekretariat").hide();
		$("#batal_sekretariat").show();
		$("#update_sekretariat").show();
		
	});	
	
	
	$("#batal_sekretariat").click(function(){
		disable_sekretariat();
		$("#batal_sekretariat").hide();
		$("#update_sekretariat").hide();
		$("#edit_sekretariat").show();
		
	});	
	
	$("#update_sekretariat").click(function(){
		id_sekretariat			= $("#id_sekretariat").val();
		nip_sekretariat			= $("#nip_sekretariat").val();
		nama_sekretariat			= $("#nama_lengkap_sekretariat").val();
		jk_sekretariat			= $("#jk_sekretariat").val();
		login_sekretariat		= $("#login_sekretariat").val();
		password_sekretariat		= $("#password_sekretariat").val();
		status_sekretariat		= $("#status_sekretariat").val();
		
		//alert(status_sekretariat);
		
	
		if (nip_sekretariat == ""){
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
			
		}else if (nama_sekretariat == ""){
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
					$("#nama_lengkap_tu").focus();
					}
				}
			});
			
		}else if (login_sekretariat == ""){
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
					$("#login_sekretariat").focus();
					}
				}
			});
		}else{
		
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=update_pengguna&id_pengguna="			+id_sekretariat+
									"&nip_pengguna="		+nip_sekretariat+
									"&nama_pengguna="		+nama_sekretariat+
									"&jk="					+jk_sekretariat+
									"&user_login="			+login_sekretariat+
									"&password="			+password_sekretariat+
									"&status="				+status_sekretariat,
						cache:false,
						beforeSend: function() {
							$("#load_update_sekretariat").show();
						},
						complete: function() {
							$("#load_update_sekretariat").hide();
						},
						success:function(msg){
						disable_sekretariat();
						$("#batal_sekretariat").hide();
						$("#update_sekretariat").hide();
						$("#edit_sekretariat").show();
						
						}
			})
		} //end else kosong 
	});	
// ******************************************************* //
	
// ******************************************************* //			
// -----------------  TIM PENILAI  ----------------------- //		
// ******************************************************* //	
	$("#batal_penilai").hide();
	$("#update_penilai").hide();
	$("#load_update_penilai").hide();

	
	function enable_penilai(){
		//$("#nip_penilai").attr("disabled", false);
		$("#nama_lengkap_penilai").attr("disabled", false);
		$("#jk_penilai").attr("disabled", false);
		$("#login_penilai").attr("disabled", false);
		$("#password_penilai").attr("disabled", false);
		$("#status_penilai").attr("disabled", false);
		
	}
	
	function disable_penilai(){
		$("#nip_penilai").attr("disabled", true);
		$("#nama_lengkap_penilai").attr("disabled", true);
		$("#jk_penilai").attr("disabled", true);
		$("#login_penilai").attr("disabled", true);
		$("#password_penilai").attr("disabled", true);
		$("#status_penilai").attr("disabled", true);
		
	}
	
	
	$("#edit_penilai").click(function(){
		enable_penilai();
		$("#nip_penilai").focus();
		$("#edit_penilai").hide();
		$("#batal_penilai").show();
		$("#update_penilai").show();
		
	});	
	
	
	$("#batal_penilai").click(function(){
		disable_penilai();
		$("#batal_penilai").hide();
		$("#update_penilai").hide();
		$("#edit_penilai").show();
		
	});	
	
	$("#update_penilai").click(function(){
		id_penilai			= $("#id_penilai").val();
		nip_penilai			= $("#nip_penilai").val();
		nama_penilai			= $("#nama_lengkap_penilai").val();
		jk_penilai			= $("#jk_penilai").val();
		login_penilai		= $("#login_penilai").val();
		password_penilai		= $("#password_penilai").val();
		status_penilai		= $("#status_penilai").val();
		
		//alert(status_penilai);
		
	
		if (nip_penilai == ""){
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
			
		}else if (nama_penilai == ""){
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
					$("#nama_lengkap_tu").focus();
					}
				}
			});
			
		}else if (login_penilai == ""){
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
					$("#login_penilai").focus();
					}
				}
			});
		}else{
		
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=update_pengguna&id_pengguna="			+id_penilai+
									"&nip_pengguna="		+nip_penilai+
									"&nama_pengguna="		+nama_penilai+
									"&jk="					+jk_penilai+
									"&user_login="			+login_penilai+
									"&password="			+password_penilai+
									"&status="				+status_penilai,
						cache:false,
						beforeSend: function() {
							$("#load_update_penilai").show();
						},
						complete: function() {
							$("#load_update_penilai").hide();
						},
						success:function(msg){
						disable_penilai();
						$("#batal_penilai").hide();
						$("#update_penilai").hide();
						$("#edit_penilai").show();
						
						}
			})
		} //end else kosong 
	});	
// ******************************************************* //
	
	
	
	
	
	
// ******************************************************* //			
// --------------- PETUGAS SEKOLAH ----------------------- //		
// ******************************************************* //	
	$("#batal_tu").hide();
	$("#update_tu").hide();
	$("#load_update_tu").hide();

	
	function enable_tu(){
		$("#nip_tu").attr("disabled", false);
		$("#nama_lengkap_tu").attr("disabled", false);
		$("#jk_tu").attr("disabled", false);
		$("#login_tu").attr("disabled", false);
		$("#password_tu").attr("disabled", false);
		$("#status_tu").attr("disabled", false);
		
	}
	
	function disable_tu(){
		$("#nip_tu").attr("disabled", true);
		$("#nama_lengkap_tu").attr("disabled", true);
		$("#jk_tu").attr("disabled", true);
		$("#login_tu").attr("disabled", true);
		$("#password_tu").attr("disabled", true);
		$("#status_tu").attr("disabled", true);
		
	}
	
	
	$("#edit_tu").click(function(){
		enable_tu();
		$("#nip_tu").focus();
		$("#edit_tu").hide();
		$("#batal_tu").show();
		$("#update_tu").show();
		
	});	
	
	
	$("#batal_tu").click(function(){
		disable_tu();
		$("#batal_tu").hide();
		$("#update_tu").hide();
		$("#edit_tu").show();
		
	});	
	
	$("#update_tu").click(function(){
		id_tu			= $("#id_tu").val();
		nip_tu			= $("#nip_tu").val();
		nama_tu			= $("#nama_lengkap_tu").val();
		jk_tu			= $("#jk_tu").val();
		login_tu		= $("#login_tu").val();
		password_tu		= $("#password_tu").val();
		status_tu		= $("#status_tu").val();
		
		//alert(status_tu);
		
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
					$("#nama_lengkap_tu").focus();
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
		}else{
		
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=update_pengguna&id_pengguna="			+id_tu+
									"&nip_pengguna="		+nip_tu+
									"&nama_pengguna="		+nama_tu+
									"&jk="					+jk_tu+
									"&user_login="			+login_tu+
									"&password="			+password_tu+
									"&status="				+status_tu,
						cache:false,
						beforeSend: function() {
							$("#load_update_tu").show();
						},
						complete: function() {
							$("#load_update_tu").hide();
						},
						success:function(msg){
						disable_tu();
						$("#batal_tu").hide();
						$("#update_tu").hide();
						$("#edit_tu").show();
						
						}
			})
		} //end else kosong 
	});	
// ******************************************************* //

});



</script>

<script src="./js/custom_ajax.js"></script>


<?php
$level	= isset($_GET['level']) ? $_GET['level'] : '3';
$id	= isset($_GET['id']) ? $_GET['id'] : '';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
Connect::getConnection();


switch($level){
case "1":
	$data_1 = mysql_fetch_object(mysql_query(" SELECT * FROM dt_dupak_pengguna WHERE id = '$id' "));
?>
	<h3 class="page-header" style="margin-left:35px;">Detail Data Administrator</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_administrator"  size="45" placeholder="NIP"  value="<?php  echo $data_1->nip_pengguna; ?>" disabled>
		
		<input type="hidden" id="id_administrator" value="<?php  echo $data_1->id; ?>">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_administrator" size="45" placeholder="Nama Lengkap" value="<?php echo $data_1->nama_pengguna;?>" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_administrator" disabled>
			<?php if ( $data_1->jk == 1 ) { ?>
			<option value="1" selected>Laki-laki</option>
			<option value="2">Perempuan</option>
			<?php } else { ?>
			<option value="1" >Laki-laki</option>
			<option value="2" selected>Perempuan</option>
			<?php } ?>
		</select>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_administrator" maxlength="15" size="45" value="<?php echo $data_1->user_login;?>" disabled></td>
	</tr>
		<tr>						
		<td width="30%" >Password</td>
		<td><input type="text" id="password_administrator" maxlength="15" size="45" placeholder="Kosongkan Jika tidak ingin ganti password" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Status</td>
		<td>
			<select id="status_administrator" disabled>
				<?php if ( $data_1->status == 1 ) { ?>
				<option value="1" selected>Enable</option>
				<option value="0">Disable</option>
				<?php } else { ?>
				<option value="1" >Enable</option>
				<option value="0" selected>Disable</option>
				<?php } ?>
		</select>
		</td>
	</tr>
	</table>	
	

	<table width="730px" style="margin:10px 0 5px 0px;" border="0">
	<tr>
		<td>
			<button style="margin-left:35px;" class="ui-state-default ralat" id="edit_administrator" >Ralat Data Admin</button>
			<button style="margin-left:35px;" class="ui-state-default close" id="batal_administrator" >Batal</button>
			<button style="margin-left:2px;" class="ui-state-default simpan" id="update_administrator" >Update</button>
			<img src="images/loader/load1.gif" id="load_update_administrator" />
		</td>
	</tr>
	</table>
	
	
<?php	
break;
case "2":
$data_2 = mysql_fetch_object(mysql_query(" SELECT * FROM dt_dupak_pengguna WHERE id = '$id' "));
?>
	<h3 class="page-header" style="margin-left:35px;">Detail Data Sekretariat</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_sekretariat" size="45" placeholder="NIP" value="<?php  echo $data_2->nip_pengguna; ?>" disabled >
		<input type="hidden" id="id_sekretariat" value="<?php  echo $data_2->id; ?>">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_sekretariat" size="45" value="<?php  echo $data_2->nama_pengguna; ?>" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_sekretariat" disabled>
			<?php if ( $data_2->jk == 1 ) { ?>
			<option value="1" selected>Laki-laki</option>
			<option value="2">Perempuan</option>
			<?php } else { ?>
			<option value="1" >Laki-laki</option>
			<option value="2" selected>Perempuan</option>
			<?php } ?>
		</select>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_sekretariat" maxlength="15" size="45" value="<?php echo $data_2->user_login;?>" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Password</td>
		<td><input type="text" id="password_sekretariat" maxlength="15" size="45" placeholder="Kosongkan Jika tidak ingin ganti password" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Status</td>
		<td>
			<select id="status_sekretariat" disabled>
				<?php if ( $data_2->status == 1 ) { ?>
				<option value="1" selected>Enable</option>
				<option value="0">Disable</option>
				<?php } else { ?>
				<option value="1" >Enable</option>
				<option value="0" selected>Disable</option>
				<?php } ?>
		</select>
		</td>
	</tr>
	</table>	
	

	<table width="730px" style="margin:10px 0 5px 0px;" border="0">
	<tr>
		<td>
			<button style="margin-left:35px;" class="ui-state-default ralat" id="edit_sekretariat" >Ralat Data Sekretariat</button>
			<button style="margin-left:35px;" class="ui-state-default close" id="batal_sekretariat" >Batal</button>
			<button style="margin-left:2px;" class="ui-state-default simpan" id="update_sekretariat" >Update</button>
			<img src="images/loader/load1.gif" id="load_update_sekretariat" />
		</td>
	</tr>
	</table>


<?php
break;
case "3":
$data_3 = mysql_fetch_object(mysql_query(" SELECT * FROM dt_dupak_pengguna WHERE id = '$id' "));
?>	
	<h3 class="page-header" style="margin-left:35px;">Detail Data Penilai</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" id="nip_penilai" size="45" value="<?php  echo $data_3->nip_pengguna; ?>" disabled >
		<input type="hidden" size="45" placeholder="NIP" id="id_penilai" value="<?php echo $data_3->id;?>">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_penilai" size="45" value="<?php  echo $data_3->nama_pengguna; ?>" disabled ></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_penilai" disabled>
			<?php if ( $data_3->jk == 1 ) { ?>
			<option value="1" selected>Laki-laki</option>
			<option value="2">Perempuan</option>
			<?php } else { ?>
			<option value="1" >Laki-laki</option>
			<option value="2" selected>Perempuan</option>
			<?php } ?>
		</select>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_penilai" maxlength="15" size="45" value="<?php echo $data_3->user_login;?>" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Password</td>
		<td><input type="text" id="password_penilai" maxlength="15" size="45" placeholder="Kosongkan Jika tidak ingin ganti password" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Status</td>
		<td>
			<select id="status_penilai" disabled>
				<?php if ( $data_3->status == 1 ) { ?>
				<option value="1" selected>Enable</option>
				<option value="0">Disable</option>
				<?php } else { ?>
				<option value="1" >Enable</option>
				<option value="0" selected>Disable</option>
				<?php } ?>
		</select>
		</td>
	</tr>
	</table>	
	
	<table width="730px" style="margin:10px 0 5px 0px;" border="0">
	<tr>
		<td>
			<button style="margin-left:35px;" class="ui-state-default ralat" id="edit_penilai" >Ralat Data PENILAI</button>
			<button style="margin-left:35px;" class="ui-state-default close" id="batal_penilai" >Batal</button>
			<button style="margin-left:2px;" class="ui-state-default simpan" id="update_penilai" >Update</button>
			<img src="images/loader/load1.gif" id="load_update_penilai" />
		</td>
	</tr>
	</table>
	

<?php
break;
case "4":
$data_4 = mysql_fetch_object(mysql_query(" SELECT * FROM dt_dupak_pengguna WHERE id = '$id' "));
?>	
	<h3 class="page-header" style="margin-left:35px;">Detail Petugas Sekolah ( Tata Usaha )</h3>
	
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>	
		<td width="30%">NIP Pegawai</td>
		<td>
		<input type="text" size="45" placeholder="NIP" disabled id="nip_tu" value="<?php echo $data_4->nip_pengguna;?>">
		<input type="hidden" size="45" placeholder="NIP" id="id_tu" value="<?php echo $data_4->id;?>">
		</td>
	</tr>
	<tr>	
		<td>Nama Lengkap Pengguna</td>
		<td><input type="text" id="nama_lengkap_tu" size="45" placeholder="Nama Lengkap" value="<?php echo $data_4->nama_pengguna;?>" disabled></td>
	</tr>
	<tr>	
		<td>Jenis Kelamin</td>
		<td>
		<select id="jk_tu" disabled>
			<?php if ( $data_4->jk == 1 ) { ?>
			<option value="1" selected>Laki-laki</option>
			<option value="2">Perempuan</option>
			<?php } else { ?>
			<option value="1" >Laki-laki</option>
			<option value="2" selected>Perempuan</option>
			<?php } ?>
		</select>
		</td>
		</td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Sekolah</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>                       
		<td valign="top" td width="30%">Nama Sekolah</td>
		<td>
		<?php
		if ($data_4->kd_skpd != null ){
			$sql	= mysql_fetch_object(mysql_query("SELECT sekolah as x FROM kd_skpd where kd_skpd='$data_4->kd_skpd'")); 
		}
		
		?>
		<div class="input_container">
		<textarea style="width:290px; height:40px; padding:2px 0 5px 10px; resize: none; " id="sekolah"  disabled><?php  echo $sql->x;?></textarea>
		<ul style="margin-left:0px; " id="sekolah_list_id"></ul>
		</div>
		<input type="hidden" id="kd_skpd" >
		</td>
	</tr>
	<?php
	$query = mysql_query("SELECT * FROM tb_dupak_sekolah WHERE kd_skpd='$data_4->kd_skpd' ");
	$cek = mysql_num_rows($query);
	if ( $cek != 0 ){
		$data_sekolah = mysql_fetch_object($query);
		//nama kepsek
		$kepsek = mysql_fetch_object(mysql_query("SELECT nama,nip_baru,gelar_dpn,gelar_blk FROM dt_pegawai WHERE id_pegawai='$data_sekolah->id_kepsek' "));
		//nama kepsek
		if ($kepsek->gelar_blk == null ) 
		{ $koma = ""; } else { $koma = ", ";};
		if ($kepsek->gelar_dpn == null ) 
		{ $titik = ""; } else { $titik = ". ";};
	
		$nama_kepsek 	= $kepsek->gelar_dpn.$titik.ucwords(strtolower($kepsek->nama)).$koma.$kepsek->gelar_blk;
		$nip_kepsek		= $kepsek->nip_baru;
		$no_tlp_sekolah = $data_sekolah->no_tlp_sekolah;
		$alamat_sekolah	= $data_sekolah->alamat_sekolah;
	}else{
		$nama_kepsek 	= "-";
		$nip_kepsek		= "-";
		$no_tlp_sekolah = "-";
		$alamat_sekolah	= "-";
	}
	
	
	?>
	<tr class="skpd_field">                       
		<td>NIP Kepala Sekolah</td>
		<td>
		<input type="text" id="nip_kepsek" value="<?php echo $nip_kepsek; ?>" size="45"   disabled>
		
		
		<input type="hidden" id="id_kepsek" >
		</td>
	</tr>
	<tr class="skpd_field">                       
		<td>Nama Kepala Sekolah</td>
		<td><input type="text" id="nama_kepsek" size="45" value="<?php echo $nama_kepsek; ?>" disabled></td>
	</tr>
	<tr class="skpd_field">                       
	<td valign="top">Alamat Sekolah</td>
	<td>
		<textarea style="width:290px; height:40px; padding:2px 0 5px 10px; resize: none; "   disabled><?php  echo $alamat_sekolah;?></textarea>
	</td>
	</tr>
	<tr class="skpd_field">                       
		<td>No Tlp Sekolah</td>
		<td><input type="text" id="nama_kepsek" size="45" value="<?php echo $no_tlp_sekolah; ?>" disabled></td>
	</tr>
	</table>
	
	<h3 class="page-header" style="margin:20px 35px 0px; 0px;">Data Login</h3>
	<table style="width:732px; margin-left:30px;" border="0" class="data_form">
	<tr>						
		<td width="30%" >Nama Pengguna</td>
		<td><input type="text" id="login_tu" maxlength="15" size="45" value="<?php echo $data_4->user_login;?>" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Password</td>
		<td><input type="text" id="password_tu" maxlength="15" size="45" placeholder="Kosongkan Jika tidak ingin ganti password" disabled></td>
	</tr>
	<tr>						
		<td width="30%" >Status</td>
		<td>
			<select id="status_tu" disabled>
				<?php if ( $data_4->status == 1 ) { ?>
				<option value="1" selected>Enable</option>
				<option value="0">Disable</option>
				<?php } else { ?>
				<option value="1" >Enable</option>
				<option value="0" selected>Disable</option>
				<?php } ?>
		</select>
		</td>
	</tr>
	</table>	
	

	<table width="730px" style="margin:10px 0 5px 0px;" border="0">
	<tr>
		<td>
			<button style="margin-left:35px;" class="ui-state-default ralat" id="edit_tu" >Ralat Data TU</button>
			<button style="margin-left:35px;" class="ui-state-default close" id="batal_tu" >Batal</button>
			<button style="margin-left:2px;" class="ui-state-default simpan" id="update_tu" >Update</button>
			<img src="images/loader/load1.gif" id="load_update_tu" />
		</td>
	</tr>
	</table>
	
	
<?php
break;
}
?>