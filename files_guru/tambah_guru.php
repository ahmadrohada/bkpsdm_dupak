<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php?page=data_guru";</script><?php exit(); }  ?>


<script>
$(document).ready(function () {
	$("#nip_baru").focus();
	$("#load_nip").hide();
	
	id_pegawai = $("#id_pegawai").val();
	
	$( "#simpan" ).hide();
	$( "#batal" ).hide();
	//alert(id_pegawai);
	//alert(id_foto);
	$("#jabatan").load("./kelas/proses.php","op=cb_jabatan");
	$("#agama").load("./kelas/proses.php","op=cb_agama");
	$("#kedudukan_peg").load("./kelas/proses.php","op=cb_kedudukan_peg");

	disabled_all();
	
	
	//disabled all
	function disabled_all(){
		$("#nip_lama").attr("disabled", true);
		//$("#nip_baru").attr("disabled", true);
		$("#nuptk").attr("disabled", true);
		$("#no_karpeg").attr("disabled", true);
		$("#jabatan").attr("disabled", true);
		$("#alamat").attr("disabled", true);
		$("#kota").attr("disabled", true);
		$("#kode_pos").attr("disabled", true);
		$("#no_hp").attr("disabled", true);
		$("#nama").attr("disabled", true);
		$("#gelar_dpn").attr("disabled", true);
		$("#gelar_blk").attr("disabled", true);
		$("#tmp_lahir").attr("disabled", true);
		$("#tgl_lahir").attr("disabled", true);
		$("#jk").attr("disabled", true);
		$("#agama").attr("disabled", true);
		$("#sekolah").attr("disabled", true);
		$("#kedudukan_peg").attr("disabled", true);
		$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
	}
	
	function clear_all(){
		$("#id_pegawai").val("");
		$("#nip_lama").val("");
		//$("#nip_baru").val("");
		$("#nuptk").val("");
		$("#no_karpeg").val("");
		$("#jabatan").val("");
		$("#alamat").val("");
		$("#kota").val("");
		$("#kode_pos").val("");
		$("#no_hp").val("");
		$("#nama").val("");
		$("#gelar_dpn").val("");
		$("#gelar_blk").val("");
		$("#tmp_lahir").val("");
		$("#tgl_lahir").val("");
		$("#jk").val("");
		$("#agama").val("");
		$("#sekolah").val("");
		$("#kedudukan_peg").val("");
		$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
	}
	
	
	
	
	$("#batal").click(function(){
		clear_all();
	});
	
	
	$("#tambah_guru").click(function(){
	
		id_pegawai		= $("#id_pegawai").val();
		kd_skpd_lama	= $("#kd_skpd_lama").val();
		kd_skpd			= $("#kd_skpd").val();
	
		//alert(kd_skpd);
		if ( id_pegawai != "" ){
		
		if ( kd_skpd_lama == kd_skpd ){
			alert("Pegawai sudah merupakan guru dari Sekolah Anda");
			
		}else{
			//alert();
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=tambah_guru&id_pegawai="+id_pegawai+
										"&kd_skpd="+kd_skpd,
                    cache:false,
                    success:function(msg){
						window.location.assign("?page=data_guru");	
					
					
					}
			})
		}
		}else{
			
			$("#nip_baru").focus().select();
		}
	});
	
	$("#nip_baru").keyup(function(){
		nip_baru=$("#nip_baru").val();
		
		if(nip_baru.length == 18){
				$("#load_nip").show();
				//CARI DATA PEGAWAI
					$.ajax({
					url:"./kelas/proses.php",
					data:"op=cari_nip_pegawai&nip_baru="+nip_baru,
					cache:false,
					success:function(msg){
						$("#load_nip").hide();
						//alert(msg);
						data=msg.split("|");
						
						
						
						if (data[0] == 1 ){
							load_data(data[1])
						}else{
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"NIP Pegawai tidak ditemukan</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 170,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									
									}
								}
							});
							clear_all();
						}
					}
				})
			
			
		}else{
			clear_all();
			$("#load_nip").hide();
		}
	});
	
	
	function load_data(id_pegawai){
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
        cache:false,
        success:function(msg){
			data=msg.split("|");
			//alert(msg);
			//alert(data[49]);
			$("#id_pegawai").val(id_pegawai);
			$("#nip_lama").val(data[38]);
			$("#nip_baru").val(data[4]);
			$("#nuptk").val(data[5]);
			$("#no_karpeg").val(data[6]);
			$("#jabatan").val(data[39]);
			
			$("#alamat").val(data[33]);
			$("#kota").val(data[34]);
			$("#kode_pos").val(data[35]);
			$("#no_hp").val(data[36]);
			
			$("#nama").val(data[41]);
			$("#gelar_dpn").val(data[42]);
			$("#gelar_blk").val(data[43]);
			$("#tmp_lahir").val(data[44]);
			$("#tgl_lahir").val(data[45]);
			$("#jk").val(data[46]);
			$("#agama").val(data[32]);
			
			$("#sekolah").val(data[21]);
			$("#kd_skpd_lama").val(data[25]);
			$("#kedudukan_peg").val(data[47]);
			$("#tgl_lhr_sql").val(data[48]);
			
			$("#foto").html(data[49]);
		}
	})
	}
	
});



</script>





<?php
	$kd_skpd = isset($_SESSION['kd_skpd']) ? $_SESSION['kd_skpd'] : '';	
?>

	<input type="hidden" value="<?php echo $kd_skpd; ?>" id="kd_skpd">




<h3 class="page-header">
TAMBAH DATA GURU
</h3>

<div class="detail_guru" style="height:470px !important;" >
<table width="96%" border="0" class="data_form">
<tr>
	<td width="18%" rowspan="13" valign="top" align="left">
	<span id="foto" class="pas_poto"></span>
	</td>
</tr>
<tr>
	<td width="22%">
		NIP Baru
	</td>
	<td width="1%">
		:
	</td>
	<td width="28%">
		<input type="text" style="width:230px;" maxlength="18" onkeypress='return angka(event)' id="nip_baru" placeholder="Masukan NIP baru Guru">
		<img src="images/loader/load4.gif" id="load_nip"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		<input type="hidden" id="id_pegawai">
	</td>
	
	<td width="13%">
		Nama Lengkap
	</td>
	<td width="1%">
		:
	</td>
	<td width="31%">
		<input type="text" style="width:230px;" id="nama" >
	</td>
</tr>
<tr>
	<td>
		NIP Lama
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="nip_lama" >
	</td>
	
	<td>
		Gelar Depan
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="gelar_dpn" >
	</td>
</tr>
<tr>
	<td>
		NUPTK
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="nuptk" >
	</td>
	
	<td>
		Gelar Belakang
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="gelar_blk" >
	</td>
</tr>
<tr>
	<td>
		No. Karpeg
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="no_karpeg" >
	</td>
	
	<td>
		Tempat Lahir
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="tmp_lahir" >
	</td>
</tr>
<tr>
	<td>
		Jabatan
	</td>
	<td>:</td>
	<td>
		<select id="jabatan" style="min-width:250px;"></select>
	</td>
	
	<td>
		Tanggal Lahir
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="tgl_lahir" >
		<input type="hidden"  id="tgl_lhr_sql" >
	</td>
</tr>
<tr>
	<td>
		Status
	</td>
	<td>:</td>
	<td>
		<select id="kedudukan_peg" style="min-width:250px;"></select>
	</td>
	
	<td>
		Jenis Kelamin
	</td>
	<td>:</td>
	<td>
		<select id="jk" style="min-width:250px;">
			<option value='1'>Laki-laki</option>
			<option value='2'>Perempuan</option>
		</select>
	</td>
</tr>
<tr>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	
	<td>
		Agama
	</td>
	<td>:</td>
	<td>
		<select id="agama" style="min-width:250px;"></select>
	</td>
</tr>
<tr>
	<td colspan="3" class="isi">
		
	</td>
	<td colspan="3" class="isi">
		
	</td>
</tr>
<tr>
	<td valign="top">
		Alamat
	</td>
	<td valign="top">
		:
	</td>
	<td>
		<textarea style="width:240px; height:40px; padding:0px 0 5px 5px; resize: none; " id="alamat" ></textarea>
	</td>
	<td  valign="top">
		SKPD LAMA
    </td>
	<td  valign="top">:</td>
	<td>
	<div class="input_container">
	<textarea style="width:240px; height:40px; padding:2px 0 5px 5px; resize: none; " id="sekolah" onkeyup="autocomplet()"></textarea>
	<ul style="margin-left:0px; " id="sekolah_list_id"></ul>
	</div>
	<input type="hidden" id="kd_skpd_lama" >

	</td>
</tr>
<tr>
	<td>
		Kota
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="kota" >
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td>
		Kode Pos
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="kode_pos" >
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td >
		No Telepon / Handphone
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="no_hp" >
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td width="15%" colspan="7" align="right">
		<button class="ui-state-default tambah" id="tambah_guru" >TAMBAH GURU</button>
		<button class="ui-state-default close" id="batal" >BATAL</button>
		
	</td>
</tr>
</table>
</div>