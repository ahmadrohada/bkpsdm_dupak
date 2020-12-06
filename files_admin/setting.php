<script>
$(function(){
	//LOAD DATA USER
	id_user		= $("#id_user").val();	
	det_user();


	
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
	
	
	$("#change_user").click(function(){
		$( "#form_user" ).dialog( "open" );
	});
	$( "#form_user" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			draggable:false,
			resizable: false,
			modal: true,
			title  : 'SIPULPENPAKGURU',
			height: 220,
			width: 400,
			modal: true,
			buttons: {
				"Simpan": function() {
					//insert data
					//alert(id_user);
					password		= $("#password").val();	
					user_baru		= $("#user_baru").val();	
					
					$.ajax({
					url:"./kelas/proses.php",
					data:"op=ubah_data_user&id_user="+id_user+
										"&password="+password+
										"&user_baru="+user_baru,
					cache:false,
						success:function(msg){
						alert(msg);
						$("#password").val("");	
						det_user();
						det_sekolah();
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
	
	
	$("#change_pass").click(function(){
		$( "#form_password" ).dialog( "open" );
	});
	$( "#form_password" ).dialog({
			autoOpen: false,
			show:"clip",
			hide:"clip",
			resizable: false,
			draggable:false,
			height: 220,
			width: 400,
			modal: true,
			buttons: {
				"Simpan": function() {
					//insert data
					//alert(id_user);
					p_lama		= $("#p_lama").val();	
					p_baru		= $("#p_baru").val();	
					
					$.ajax({
					url:"./kelas/proses.php",
					data:"op=ubah_password&id_user="+id_user+
										"&p_lama="+p_lama+
										"&p_baru="+p_baru,
					cache:false,
						success:function(msg){
						alert(msg);
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
	
?>
<input type="hidden" value="<?php echo $kd_skpd; ?>" id="set_kd_skpd">
<input type="hidden" value="<?php echo $id_user; ?>" id="id_user">

<h3 class="page-header">
My Account ( Administrator )
</h3>
<table width="90%" border="0">

<tr>	
	<td rowspan="7" width="15%" class="skpd_field">
		<img src="images/forms/operator.jpg" height="450px" width="490px">
	</td>
    <td width="15%">User Group</td>
    <td width="*%">
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-6px; width:310px; font-weight:bold;" id="group" disabled>
	</td>
</tr>
<tr>	
    <td width="15%">NIP Pengguna</td>
    <td width="*%">
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-6px; width:310px; font-weight:bold;" id="nip_pengguna" disabled>
	</td>
</tr>
<tr>	
    <td width="15%">Nama Pengguna</td>
    <td width="*%">
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-6px; width:310px; font-weight:bold;" id="nama_pengguna" disabled>
	</td>
</tr>
<tr>	
    <td>Jenis Kelamin</td>
    <td>
		<select id="jk" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-6px; width:328px; font-weight:bold;" disabled>
			<option value="1">Laki-laki</option>
			<option value="2">Perempuan</option>
		</select>
	</td>
</tr>
<tr>                       
    <td>User Login</td>
    <td>
		<input type="text" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d; margin:-6px; width:310px; font-weight:bold;" id="user_login" disabled>
	</td>
</tr>
<tr>                       
    <td></td>
    <td>
	<p style=" width:130px; cursor:pointer; color:red; " id="change_user">
		Ubah Nama User Login
	</p>
	<p style="width:95px; cursor:pointer; color:red;" id="change_pass">
		Ubah Kata Sandi
	</p>

	</td>
</tr>
<tr height="150px">
	<td></td>
    <td></td>
</tr>

</table>	

<div id="form_user">
<br>
	<table width="360px" border="0">

	<tr>	
		<td width="*%">User Login Baru</td>
		<td width="45%">
			<input type="text" id="user_baru" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d;  width:220px; font-weight:bold;">
		</td>
	</tr>
	<tr>	
		<td width="*%">Kata Sandi</td>
		<td width="45%">
			<input type="password" id="password" class="user_field" onkeypress='return pass(event)' style="background:transparent;  cursor:pointer; color:#ad001d; margin-top:8px; width:220px; font-weight:bold;">
		</td>
	</tr>
	</table>
</div>	
	

<div id="form_password" title="Ubah Kata Sandi">
<br>
	<table width="360px" border="0">

	<tr>	
		<td width="*%">Password Lama</td>
		<td width="45%">
			<input type="password" id="p_lama" class="user_field" style="background:transparent;  cursor:pointer; color:#ad001d;  width:220px; font-weight:bold;">
		</td>
	</tr>
	<tr>	
		<td width="*%">Password Baru</td>
		<td width="45%">
			<input type="text" id="p_baru" class="user_field" onkeypress='return pass(event)' style="background:transparent;  cursor:pointer; color:#ad001d; margin-top:8px; width:220px; font-weight:bold;">
		</td>
	</tr>
	</table>
</div>	

