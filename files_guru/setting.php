<script>
$(function(){
	$("#simpan_data_sekolah").hide();
	$("#batal").hide();
	$("#load_nip_kepsek").hide();
	$("#message-red").hide();
	
	
	//LOAD DATA USER
	id_user		= $("#id_user").val();	
	kd_skpd		= $("#set_kd_skpd").val();
	set			= $("#set").val();	
	det_user();
	det_sekolah();
	

	if ( set == '1'){
		$("#nip_kepsek").focus();
		
	}
	
	function belum_lengkap(){
			
		$("#message-red").show();
			
		$("#nip_kepsek").attr( "disabled", false );
		$("#alamat_sekolah").attr( "disabled", false );
		$("#no_tlp_sekolah").attr( "disabled", false );
		$("#nip_kepsek").focus().select();
		$("#ubah_data_sekolah").hide();
		$("#simpan_data_sekolah").show();
					
	}
	
	function det_user(){
	//alert(id_user);
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_user&id_user="+id_user,
        cache:false,
            success:function(msg){
			data=msg.split("|");
			//alert(msg);
		
			$("#group").val(data[0]);
			$("#nip_pengguna").val(data[1]);
			$("#nama_pengguna").val(data[2]);
			$("#jk").val(data[3]);
			$("#user_login").val(data[4]);
            }
        })
	}
	
	function det_sekolah(){
	//alert(id_user);
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_sekolah&kd_skpd="+kd_skpd,
        cache:false,
            success:function(msg){
			data=msg.split("|");
			//alert(msg);
		
			$("#id_kepsek").val(data[1]);
			$("#nip_kepsek").val(data[2]);
			$("#nama_kepsek").val(data[3]);
			$("#nama_sekolah").val(data[4]);
			$("#kd_skpd").val(data[5]);
			$("#alamat_sekolah").val(data[6]);
			$("#no_tlp_sekolah").val(data[7]);
			//alert(data[0]);
				//alert jika data sekolah belum terisi
				if ( data[0] == "0" ){
				belum_lengkap();
				}
            }
        })
	}
	
	
	
	disable_tu();
	function disable_tu(){
		$("#nip_pengguna").attr("disabled", true);
		$("#nama_pengguna").attr("disabled", true);
		$("#jk").attr("disabled", true);
		$("#user_login").attr("disabled", true);
		$("#password").attr("disabled", true);
		$("#simpan_data_tu").hide();
		$("#ubah_data_tu").show();
		$("#batal_tu").hide();
		det_user();
	}

	
	function enable_tu(){
		$("#simpan_data_tu").show();
		$("#ubah_data_tu").hide();
		$("#batal_tu").show();
		$("#nip_pengguna").attr("disabled", false);
		$("#nama_pengguna").attr("disabled", false);
		$("#jk").attr("disabled", false);
		$("#user_login").attr("disabled", false);
		$("#password").attr("disabled", false);
		
	}
	
	$("#batal_tu").click(function(){
		disable_tu();
		
	});
	
	
	
	$("#ubah_data_tu").click(function(){
		enable_tu();
		
	});
	
	
	$("#simpan_data_tu").click(function(){
		
	
		id_tu			= $("#id_user").val();
		nip_tu			= $("#nip_pengguna").val();
		nama_tu			= $("#nama_pengguna").val();
		jk_tu			= $("#jk").val();
		login_tu		= $("#user_login").val();
		password_tu		= $("#password").val();
		
		//alert(jk_tu);
		

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
					$("#nip_pengguna").focus();
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
					$("#nama_pengguna").focus();
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
					$("#user_login").focus();
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
									"&password="			+password_tu,
						cache:false,
						beforeSend: function() {
							//$("#load_update_tu").show();
						},
						complete: function() {
							//$("#load_update_tu").hide();
						},
						success:function(msg){
						disable_tu();
						
						}
			})
		} //end else kosong 
	});	
	
	
// ******************************************************* //			
// ------------------- EDIT SEKOLAH ---------------------- //		
// ******************************************************* //	
	
	$("#nip_kepsek").keyup(function(){
	
	$("#simpan_data_sekolah").attr("disabled", false);
	nip_kepsek=$("#nip_kepsek").val();
	nip_pengguna= $("#nip_pengguna").val();
	
	if(nip_kepsek.length == 18){
	//alert("tes");
	
	if ( nip_kepsek == nip_pengguna ){
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
	
			
			$("#alamat_sekolah").focus();
			
			}else{
				alert("NIP tidak ditemukan dalam basis data");
				$("#simpan_data_sekolah").attr("disabled", true);
				
			}
		}
	})
	}
	}else{
			$("#load_nip_kepsek").hide();
			$("#id_kepsek").val("");
			$("#nama_kepsek").val("");
		}
	});
	
	$("#ubah_data_sekolah").click(function(){
		
		$("#nip_kepsek").prop( "disabled", false );
		$("#alamat_sekolah").prop( "disabled", false );
		$("#no_tlp_sekolah").prop( "disabled", false );
		$("#nip_kepsek").focus().select();
		$("#ubah_data_sekolah").hide();
		$("#simpan_data_sekolah").show();
		$("#batal").show();
	});
	
	$("#batal").click(function(){
		
		$("#nip_kepsek").prop( "disabled", true );
		$("#alamat_sekolah").prop( "disabled", true );
		$("#no_tlp_sekolah").prop( "disabled", true );
		$("#ubah_data_sekolah").show();
		$("#simpan_data_sekolah").hide();
		$("#batal").hide();
		det_user();
		det_sekolah();
	});
	
	$("#simpan_data_sekolah").click(function(){
		$( "#konfirmasi" ).dialog( "open" );
	});
	
	$( "#konfirmasi" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			resizable: false,
			draggable:false,
			height: 220,
			width: 400,
			modal: true,
			buttons: {
				"OK": function() {
					//insert data
					//alert(id_user);
					id_user				= $("#id_user").val();	
					password			= $("#konfirmasi_password").val();	
					kd_skpd				= $("#kd_skpd").val();	
					id_kepsek			= $("#id_kepsek").val();	
					alamat_sekolah		= $("#alamat_sekolah").val();	
					no_tlp_sekolah		= $("#no_tlp_sekolah").val();	
					
					$.ajax({
					url:"./kelas/proses.php",
					data:"op=ubah_data_sekolah&kd_skpd="+kd_skpd+
										"&password="+password+
										"&id_user="+id_user+
										"&id_kepsek="+id_kepsek+
										"&alamat_sekolah="+alamat_sekolah+
										"&no_tlp_sekolah="+no_tlp_sekolah,
					cache:false,
						success:function(msg){
						//alert(msg);
						if ( msg == 'sukses'){
							det_user();
							det_sekolah();
							
							window.location.reload(); 
							
						}else{
							alert(msg);
								$("#nip_kepsek").prop( "disabled", false );
								$("#alamat_sekolah").prop( "disabled", false );
								$("#no_tlp_sekolah").prop( "disabled", false );
								$("#nip_kepsek").focus().select();
								$("#ubah_data_sekolah").hide();
								$("#simpan_data_sekolah").show();
								$("#batal").show();
							
							
						}
						
						}
						
					})
					
					
					$("#nip_kepsek").prop( "disabled", true );
					$("#alamat_sekolah").prop( "disabled", true );
					$("#no_tlp_sekolah").prop( "disabled", true );
		
					$( this ).dialog( "close" );
					$("#ubah_data_sekolah").show();
					$("#simpan_data_sekolah").hide();
					$("#batal").hide();
				},
				"Batal": function() {
					$( this ).dialog( "close" );
					$("#simpan_data_sekolah").show();	
					$("#ubah_data_sekolah").hide();
				}
			},
			close: function() {
					//$("#simpan_data_sekolah").show();	
					//$("#ubah_data_sekolah").hide();
			}
	})
});
</script>

<!--=====================================================- > 
**********************************************************
                DETAIL DATA PENGGUNA
**********************************************************
<--====================================================---->	

<?php
	$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';
	$id_user = $_SESSION['id_user'];
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
	Connect::getConnection();
	
	$set = isset($_GET['set']) ? $_GET['set'] : '';
?>
<input type="hidden" value="<?php echo $kd_skpd; ?>" id="set_kd_skpd">
<input type="hidden" value="<?php echo $id_user; ?>" id="id_user">
<input type="hidden" value="<?php echo $set; ?>" id="set">



<div id="message-red">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="red-left">Untuk dapat menggunakan aplikasi ini, dimohon untuk melengkapi data sekolah<a href=""></a></td>
            <td class="red-right"><a ><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
        </tr>
    </table>
</div>







<h3 class="page-header">
My Account ( Guru )
</h3>
<table style="width:932px; margin-left:0px;" border="0" class="data_form">

<tr>	
	<td rowspan="16" width="10%" class="skpd_field">
		<img src="images/forms/operator.jpg" height="450px" width="430px">
	</td>
    <td width="18%">User Group</td>
    <td width="*%">
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-2px; width:310px; font-weight:bold;" id="group" disabled>
	</td>
</tr>
<tr>	
    <td width="15%">NIP Pengguna</td>
    <td width="*%">
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="nip_pengguna" disabled>
	</td>
</tr>
<tr>	
    <td width="15%">Nama Pengguna</td>
    <td width="*%">
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="nama_pengguna" disabled>
	</td>
</tr>
<tr>	
    <td>Jenis Kelamin</td>
    <td>
		<select id="jk" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:328px; font-weight:bold;" disabled>
			<option value="1">Laki-laki</option>
			<option value="2">Perempuan</option>
		</select>
	</td>
</tr>
<tr>                       
    <td>User Login</td>
    <td>
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="user_login" maxlength="15" disabled>
	</td>
</tr>
<tr>                       
    <td>Password</td>
    <td>
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="password" maxlength="15"  placeholder='Biarkan kosong jika tidak ingin mengganti password' disabled>
	</td>
</tr>
<tr>     
	<td colspan="3" align="right" style="padding:5px 0px 0 0; ">
		<button class="ui-state-default ralat"  id="ubah_data_tu" >UBAH DATA PENGGUNA</button>
		<button class="ui-state-default simpan"  id="simpan_data_tu" >SIMPAN</button>
		<button class="ui-state-default batal"  id="batal_tu" >BATAL</button>
	</td>
</tr>
<tr class="skpd_field">                       
    <td colspan="2" class="isi"><hr></td>
<tr>
<tr class="skpd_field">                       
    <td colspan="2" class="isi">Informasi Sekolah</td>
<tr>
<tr class="skpd_field">                        
    <td>NIP Kepala Sekolah</td>
    <td>
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="nip_kepsek" maxlength="18" onkeypress='return angka(event)' disabled>
		<img src="images/loader/load4.gif" id="load_nip_kepsek"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		<input type="hidden" id="id_kepsek" >
	</td>
</tr>
<tr class="skpd_field">                        
    <td>Nama Kepala Sekolah</td>
    <td>
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="nama_kepsek" disabled>
	</td>
</tr>
<tr class="skpd_field" >                       
    <td valign="top" style="padding-top:5px;">Nama Sekolah</td>
    <td>
		<textarea style="margin-left:-1px; margin-top:1px;  color:#ad001d; width:321px; height:40px; padding:0px 0 0px 9px; resize: none; background-color:transparent;  font-weight:bold;" id="nama_sekolah" disabled></textarea>
		<input type="hidden" id="kd_skpd" >
	</td>
</tr>
<tr class="skpd_field" >                       
    <td valign="top" style="padding-top:2px;">Alamat Sekolah</td>
    <td>
		<textarea style="margin-left:-1px; margin-top:1px;  color:#ad001d; width:321px; height:40px; padding:0px 0 5px 9px; resize: none; background-color:transparent;  font-weight:bold;" id="alamat_sekolah" disabled></textarea>
	</td>
</tr>
<tr class="skpd_field">                        
    <td>No Telepon Sekolah</td>
    <td>
		<input type="text" class="user_field" onkeypress='return angka(event)' style="background:transparent;  cursor:pointer; color:#ad001d; margin:-1px; width:310px; font-weight:bold;" id="no_tlp_sekolah" disabled>
	</td>
</tr>



</table>	



<div id="konfirmasi" title="Konfirmasi Perubahan Data">
<br>
	<table width="360px" border="0">
	<tr>	
		<td align="center">Masukan Password</td>
	</tr>
	<tr>	
		<td align="center">
			<input type="text" id="konfirmasi_password" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin-top:8px; width:220px; font-weight:bold;">
		</td>
	</tr>
	</table>
</div>