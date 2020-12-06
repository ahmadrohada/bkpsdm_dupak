<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php?page=data_guru";</script><?php exit(); }  ?>


<script>
$(document).ready(function () {
	id_pegawai = $("#id_pegawai").val();
	$( "#load_save" ).hide();
	$( "#simpan" ).hide();
	$( "#batal" ).hide();
	//alert(id_pegawai);
	//alert(id_foto);
	$("#jabatan").load("./kelas/proses.php","op=cb_jabatan");
	$("#agama").load("./kelas/proses.php","op=cb_agama");
	$("#kedudukan_peg").load("./kelas/proses.php","op=cb_kedudukan_peg");
	$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
	load_data();
	disabled_all();
	
	
	//disabled all
	function disabled_all(){
		$("#nip_lama").attr("disabled", true);
		$("#nip_baru").attr("disabled", true);
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
	}
	
	//enabled all
	function enabled_all(){
		$("#nip_lama").attr("disabled", false);
		//$("#nip_baru").attr("disabled", false);
		$("#nuptk").attr("disabled", false);
		$("#no_karpeg").attr("disabled", false);
		$("#jabatan").attr("disabled", false);
		$("#alamat").attr("disabled", false);
		$("#kota").attr("disabled", false);
		$("#kode_pos").attr("disabled", false);
		$("#no_hp").attr("disabled", false);
		$("#nama").attr("disabled", false);
		$("#gelar_dpn").attr("disabled", false);
		$("#gelar_blk").attr("disabled", false);
		$("#tmp_lahir").attr("disabled", false);
		$("#tgl_lahir").attr("disabled", false);
		$("#jk").attr("disabled", false);
		$("#agama").attr("disabled", false);
		$("#sekolah").attr("disabled", false);
		$("#kedudukan_peg").attr("disabled", false);
	}
	
	
	
	$("#ralat").click(function(){
		tgl1	= $("#tgl_lhr_sql").val();
		$("#tgl_lahir").val(tgl1);
		$( "#ralat" ).hide();
		$( "#simpan" ).show();
		$( "#batal" ).show();
		enabled_all();
	});
	
	
	$("#batal").click(function(){
		$( "#ralat" ).show();
		$( "#simpan" ).hide();
		$( "#batal" ).hide();
		load_data();
		disabled_all();
	});
	
	
	$("#simpan").click(function(){
	
		id_pegawai	= $("#id_pegawai").val();
		id_foto		= $("#id_foto").val();
		nip_lama	= $("#nip_lama").val();
		nip_baru	= $("#nip_baru").val();
		nuptk		= $("#nuptk").val();
		no_karpeg	= $("#no_karpeg").val();
		jabatan		= $("#jabatan").val();
		alamat		= $("#alamat").val();
		kota		= $("#kota").val();
		kode_pos	= $("#kode_pos").val();
		no_hp		= $("#no_hp").val();
		nama		= $("#nama").val();
		gelar_dpn	= $("#gelar_dpn").val();
		gelar_blk	= $("#gelar_blk").val();
		tmp_lahir	= $("#tmp_lahir").val();
		tgl_lahir	= $("#tgl_lahir").val();
		jk			= $("#jk").val();
		agama		= $("#agama").val();
		kd_skpd		= $("#kd_skpd").val();
		kedudukan_peg = $("#kedudukan_peg").val();
	
		
		if (nip_baru == "" ){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"NIP Baru tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nip_baru").focus();
					}
				}
			});
			
		
		}else if (nama == "" ){
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Nama Tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 150,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#nama").focus();
					}
				}
			});
		}else{
		
			
		
		
		
		
			$( "#load_save" ).show();
	
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=ralat_guru&id_pegawai="+id_pegawai+
										"&a="+nip_lama+
										"&b="+nip_baru+
										"&c="+nuptk+
										"&d="+no_karpeg+
										"&e="+jabatan+
										"&f="+alamat+
										"&g="+kota+
										"&h="+kode_pos+
										"&i="+no_hp+
										"&j="+nama+
										"&k="+gelar_dpn+
										"&l="+gelar_blk+
										"&m="+tmp_lahir+
										"&n="+tgl_lahir+
										"&o="+jk+
										"&p="+agama+
										"&q="+kd_skpd+
										"&r="+kedudukan_peg+
										"&s="+id_foto,
                    cache:false,
                    success:function(msg){
					
					if ( msg == "nip_error"){
						$( "#load_save" ).hide();
						
						
						$("#alert").html(
						"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
						+"NIP Baru sudah dipakai</center>"
						);
			
						$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
							height: 150,
							width: 450,
							buttons: {
							"Tutup": function () {
							$(this).dialog('close');
							$("#nip_baru").focus();
					}
				}
			});
						
					}else{
					
					//alert(msg);
					$( "#ralat" ).show();
					$( "#simpan" ).hide();
					$( "#batal" ).hide();
					load_data();
					disabled_all();
					$( "#load_save" ).hide();
					}
					
					}
			})
		} //end if
	});
	
	
	function load_data(){
	$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
        cache:false,
        success:function(msg){
			data=msg.split("|");
			//alert(msg);
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
			$("#kd_skpd").val(data[25]);
			$("#kedudukan_peg").val(data[47]);
			$("#tgl_lhr_sql").val(data[48]);
			$("#foto").html(data[49]);
			
			$( ".pre_load" ).fadeOut(10);
		}
	})
	}
	
});



</script>





<?php
	$id_pegawai = isset($_GET['id']) ? $_GET['id'] : '';
?>




<input type="hidden" value="<?php echo $id_pegawai ?>" id="id_pegawai">


<h3 class="page-header">
DATA PRIBADI
</h3>

<div class="detail_guru" style="height:470px !important;" >


<div class="pre_load" style="height:470px !important;"></div>
<table width="100%" border="0" class="data_form">
<tr>
	<td width="18%" rowspan="13" valign="top" align="left">
		<span id="foto" class="pas_poto"></span>
	</td>
</tr>
<tr>
	<td width="13%">
		NIP Lama
	</td>
	<td width="1%">
		:
	</td>
	<td width="24%">
		<input type="text" style="width:230px;" id="nip_lama" >
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
		NIP Baru
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="nip_baru" >
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
		SKPD
    </td>
	<td  valign="top">:</td>
	<td>
	<div class="input_container">
	<textarea style="width:240px; height:40px; padding:2px 0 5px 5px; resize: none; " id="sekolah" onkeyup="autocomplet()"></textarea>
	<ul style="margin-left:0px; " id="sekolah_list_id"></ul>
	</div>
	<input type="hidden" id="kd_skpd" >

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
		<img src="images/loader/load1.gif" id="load_save" />
		<button class="ui-state-default simpan" id="simpan" >SIMPAN</button>
		<button class="ui-state-default close" id="batal" >BATAL</button>
		<button class="ui-state-default ralat" id="ralat" >RALAT DATA</button>
		
	</td>
</tr>
</table>
</div>