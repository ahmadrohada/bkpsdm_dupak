<script>
$(document).ready(function () {

//alert();
$("#load_nip").hide();
$("#input_dupak").attr("disabled", true);
$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
$("#nip_baru").focus();


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
	
	
	

$("#input_dupak").click(function(){
		id_pegawai=$("#id_pegawai").val();
		
		$.ajax({
		url:"./kelas/proses.php",
        data:"op=status_dupak&id_pegawai="+id_pegawai,
                    cache:false,
                    success:function(msg){
						//alert (msg);
						data=msg.split("|");
						/** hasil cek status bisa berupa
						0. belum ada proses dupak baru ( dupak lama sudah level sektretariat/terkirim oleh TU ) / tampilkan form input
						1. dalam proses pengisian TU
						2. Sudah diajukan ke TIM penilai/sekretariat
						3. Bukan termasuk guru dari sekolah anda
						
						**/
						if ( data[0] == 0 || data[0] == 1){
							window.location.assign("?page=form_dupak&id_pegawai="+id_pegawai);
						}else if ( data[0] == 2 ){
							proses_penilai(data[1]);	
						}else if ( data[0] == 3 ){
							bukan_guru_anda();
						}else if ( data[0] == 4 ){
							$("#alert").html(
								"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
								+"NIP Pegawai Salah / Tidak Aktif</center>"
							);
							
							$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
								height: 170,
								width: 450,
								buttons: {
									"Tutup": function () {
									$(this).dialog('close');
									$("#nip_baru").focus();
									}
								}
							});
						}
						
						
						
                    }
        })
		
		
 });
 
 
function proses_penilai(nama){
		$("#dialog-form").html(
		"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
		+"DUPAK sedang dalam proses Tim Penilai</center>"
		);
	
		$("#dialog-form").dialog({
		//autoOpen: false,
		show:"clip",
		hide:"clip",
		draggable:false,
		resizable: false,
		modal: true,
		title  : 'SIPULPENPAKGURU',
		height: 170,
		width: 450,
        buttons: {
				"Tutup": function () {
                $(this).dialog('close');
				
            },
			"Lihat Data": function () {
                $(this).dialog('close');
				window.location.assign("?page=data_dupak&cari="+nama);
			},
        }
		
    });	
	
	}	
	
	function bukan_guru_anda(){
		$("#dialog-confirm").html("<center>Maap Nip yang anda masukan bukan Guru dari Sekolah anda</center>");
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
	}	
	
	/**
	$("#r1").hide();
	$("#r2").hide();
	$("#r3").hide();
	$("#r4").hide();
	$("#r5").hide();
	$("#r6").hide();
	$("#r7").hide();
	$("#r1").show(1600);
	$("#r2").show(2000);
	$("#r3").show(2400);
	$("#r4").show(2800);
	$("#r5").show(3200);
	$("#r6").show(3600);
	$("#r7").hshow(2400);
	**/

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
			
			$("#alamat").val(data[33]);
			$("#kota").val(data[34]);
			$("#kode_pos").val(data[35]);
			$("#no_hp").val(data[36]);
			
			$("#nama").val(data[1]);
			
			$("#tmp_lahir").val(data[2]);
			$("#jk").val(data[46]);
			
			$("#foto").html(data[49]);
			$("#input_dupak").attr("disabled", false);
		}
	})
	}
	
		function clear_all(){
		$("#id_pegawai").val("");
		$("#nip_lama").val("");
		//$("#nip_baru").val("");
		$("#nuptk").val("");
		$("#no_karpeg").val("");
		$("#alamat").val("");
		$("#kota").val("");
		$("#no_hp").val("");
		$("#nama").val("");
		$("#tgl_lahir").val("");
		$("#jk").val("");
		$("#sekolah").val("");
		$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
		$("#input_dupak").attr("disabled", true);
	}
});
</script>

<!--=====================================================- > 
**********************************************************
                input DUPAK BARU
**********************************************************
<--====================================================---->	

<h3 class="page-header">
INPUT DUPAK BARU
</h3>

<div class="detail_guru" style="height:470px !important;" >
<table width="96%" border="0" class="data_form">
<tr>
	<td width="30%" rowspan="13" valign="top" align="left">
	<button class="ui-state-default tambah " style="width:320px !important; height:60px !important;" id="r1" disabled>INPUT DATA DUPAK</button>
	<button class="ui-state-default cetak" style="width:320px !important; height:60px !important; margin-top:5px;" id="r2" disabled>CETAK DATA DUPAK</button>
	<button class="ui-state-default kirim" style="width:320px !important; height:60px !important; margin-top:5px;" id="r3" disabled>KIRIM DATA DUPAK</button>
	<button class="ui-state-default proses" style="width:320px !important; height:60px !important; margin-top:5px;" id="r4" disabled>PROSES TIM PENILAI</button>
	<button class="ui-state-default proses" style="width:320px !important; height:60px !important; margin-top:5px;" id="r5" disabled>PROSES SEKRETARIAT</button>
	<button class="ui-state-default pensil" style="width:320px !important; height:60px !important; margin-top:5px;" id="r6" disabled>PENANDATANGANAN</button>
	<button class="ui-state-default terima" style="width:320px !important; height:60px !important; margin-top:5px;" id="r7" disabled>SELESAI</button>
	</td>
</tr>
<tr>
	<td width="25%" rowspan="13" valign="top" align="right" style="padding-right:10px !important; ">
	<span id="foto" class="pas_poto"></span>
	</td>
</tr>
<tr>
	<td width="17%">
		NIP Baru
	</td>
	<td width="2%">
		:
	</td>
	<td width="*%">
		<input type="text" style="width:230px; font-size:12pt; color:black; font-weight:normal; font-family:isi;" maxlength="18" onkeypress='return angka(event)' id="nip_baru" placeholder="Masukan NIP baru Guru">
		<img src="images/loader/load4.gif" id="load_nip"  style="width:20px; height:20px; margin:0px 0px -5px -30px;">
		<input type="hidden" id="id_pegawai">
	</td>
</tr>
<tr>
	<td width="13%">
		Nama Lengkap
	</td>
	<td width="1%">
		:
	</td>
	<td width="31%">
		<input type="text" style="width:230px;" id="nama" disabled>
	</td>
</tr>
<tr>
	<td>
		NUPTK
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="nuptk" disabled>
	</td>
</tr>
<tr>
	<td>
		No. Karpeg
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="no_karpeg" disabled>
	</td>
	

</tr>
<tr>
	<td>
		Tempat / Tanggal Lahir
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="tmp_lahir" disabled>
	</td>
</tr>
<tr>
	<td>
		Jenis Kelamin
	</td>
	<td>:</td>
	<td>
		<select id="jk" style="min-width:250px;" disabled>
			<option value='1'>Laki-laki</option>
			<option value='2'>Perempuan</option>
		</select>
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
		<textarea style="width:240px; height:40px; padding:0px 0 5px 5px; resize: none; " id="alamat" disabled></textarea>
	</td>
</tr>
<tr>
	<td>
		Kota
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="kota" disabled>
	</td>
</tr>
<tr>
	<td >
		No Telepon / Handphone
	</td>
	<td>:</td>
	<td>
		<input type="text" style="width:230px;" id="no_hp" disabled >
	</td>
</tr>
<tr>
	<td width="15%" colspan="7" align="center">
		<button class="ui-state-default tambah " style="width:460px !important; height:60px !important; margin-left:-30px; " id="input_dupak" >INPUT DUPAK</button>
	</td>
</tr>
</table>
</div>