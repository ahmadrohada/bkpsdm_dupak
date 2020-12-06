<script>
$(document).ready(function () {
	
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	id_pegawai 	 = $("#id_pegawai").val();
	kd_skpd		 = $("#kd_skpd").val();
	$( "#load_usulan" ).hide();
	
	cek_step();
	detail_sekolah();
	
	
/** ======================================================== **/
/** ========= PENGECEKAN STEP DUPAK ======================== **/
/** ======================================================== **/
	function cek_step(){
		$.ajax({
		url:"./kelas/proses.php",
		data:"op=status_dupak&id_pegawai="+id_pegawai,
		cache:false,
		success:function(msg){
			//alert (msg);
			data=msg.split("|");
			$("#no_dupak").val(data[2]);
				
			var x = data[1];
			//tampilkan detail jika sudah melewati step ini ( pengajuan dupak)
			if ( x >=1 ){
				dupak=x.split("|");
				detail_dupak_baru(dupak[2]);  
			}
								
			if ( x == 0 ) $( "#tab_new_dupak" ).tabs( "option", "active", 2 );
			if ( x == 1 ) $( "#tab_new_dupak" ).tabs( "option", "active", 3 );
			if ( x == 2 ) $( "#tab_new_dupak" ).tabs( "option", "active", 4 );
			if ( x == 3 ) $( "#tab_new_dupak" ).tabs( "option", "active", 5 );
			if ( x == 4 ) $( "#tab_new_dupak" ).tabs( "option", "active", 6 );
			if ( x == 5 ) $( "#tab_new_dupak" ).tabs( "option", "active", 7 );
			if ( x == 6 ) $( "#tab_new_dupak" ).tabs( "option", "active", 8 );
								
			if ( x >= 2 ) $( "#tab_new_dupak" ).tabs( "enable", 4 );
			if ( x >= 3 ) $( "#tab_new_dupak" ).tabs( "enable", 5 );
			if ( x >= 4 ) $( "#tab_new_dupak" ).tabs( "enable", 6 );
			if ( x >= 5 ) $( "#tab_new_dupak" ).tabs( "enable", 7 );
			if ( x >= 6 ) $( "#tab_new_dupak" ).tabs( "enable", 8 );
		}
		})

	}
	
	
	function detail_sekolah(){
		$.ajax({
		url:"./kelas/detail.php",
		data:"op=detail_data_sekolah&kd_skpd="+kd_skpd,
		cache:false,
		success:function(msg){	
			//alert(msg);
			x=msg.split("|");
			
			$("#id_kepsek").val(x[1]);
			$("#nama_kepsek").val(x[3]);
			$("#nama_sekolah").val(x[4]);
			$("#nama_operator_sekolah").val(x[8]);
		}
		
		})
		
		
	}
	
	function detail_dupak_baru(){
		
		$("#tgl_mulai_dupak").attr("disabled", true);
		$("#tgl_sampai_dupak").attr("disabled", true);
		
		
		$.ajax({
		url:"./kelas/detail.php",
		data:"op=detail_data_dupak&no_dupak="+no_dupak,
		cache:false,
		success:function(msg){	
			//alert(msg);
			d=msg.split("|");
			
			
			$("#b_no_dupak").val(d[0]);
			$("#b_tgl_dupak").val(d[1]);
			$("#b_entry_dupak").val(d[2]);
			$("#tgl_mulai_dupak").val(d[6]);
			$("#tgl_sampai_dupak").val(d[7]);
			
			$("#simpan_dupak").hide();
			
		}
		
		})
		
		
	}
	
	
	/** ====================================================================== **/
	/**  PROSES SIMPAN DUPAK atau DUPAK BARU MULAI DIAJUKAN DAN DIISI -------- **/
	/** ====================================================================== **/
	
	// redirect saat sekolah belum diset
	//window.location.assign("?page=setting&set=1");
	
    $("#simpan_dupak").click(function(){
		tgl_mulai	=	$("#tgl_mulai_dupak").val();
		tgl_sampai	=	$("#tgl_sampai_dupak").val();
		
		if (tgl_mulai=="") {
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Tanggal Mulai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 170,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#tgl_mulai_dupak").focus();
					}
				}
			});
			
			
		}else if (tgl_sampai=="") {
			$("#alert").html(
				"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
				+"Tanggal Sampai tidak boleh kosong</center>"
			);
			
			$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
				height: 170,
				width: 450,
				buttons: {
					"Tutup": function () {
					$(this).dialog('close');
					$("#tgl_sampai_dupak").focus().select();
					}
				}
			});
			
		}else{
		
		cek_masa_penilaian();
	}
	});
	
	function cek_masa_penilaian(){
		$("#load_usulan").show();
		//alert(tgl_sampai);
		$.ajax({
				url:"./kelas/proses.php",
                data:"op=cek_masa_penilaian&a		="+tgl_mulai+
											"&b		="+tgl_sampai,
                cache:false,
                success:function(msg){
					
					//alert(msg);
					if ( msg == "ok" ) {
						$("#load_usulan").hide();
						simpan_dupak();
					}else if ( msg == "error" )  {
						
						$("#load_usulan").hide();
						$("#alert").html(
							"<center><span class='ui-icon ui-icon-alert' style='float:left; margin:0 0 10px 5px;'></span>"
							+"Tanggal sampai harus lebih dari tgl Mulai !</center>"
						);
						
						$("#alert").dialog({show:"clip",hide:"clip",draggable:false,resizable: false,modal: true,dialogClass: 'no-close',title  : 'SIPULPENPAKGURU',
							height: 170,
							width: 450,
							buttons: {
								"Tutup": function () {
								$(this).dialog('close');
								$("#tgl_sampai_dupak").focus();
								}
							}
						});
					}	
					
					
                }
            })	
		}
	
	
	function simpan_dupak(){
		id_pegawai	=	$("#id_pegawai").val();
		tgl_mulai	=	$("#tgl_mulai_dupak").val();
		tgl_sampai	=	$("#tgl_sampai_dupak").val();
		id_kepsek	=	$("#id_kepsek").val();
		
		//alert();
		$("#load_usulan").show();
        $.ajax({
		url:"./kelas/detail.php",
		data:"op=detail_pak_lama&id_pegawai="+id_pegawai,
		cache:false,
			
		success:function(msg){
		data=msg.split("|");
		//alert(msg);
		
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=simpan_dupak&id_pegawai="+id_pegawai+
				"&a="+tgl_mulai+
				"&b="+tgl_sampai+
				"&c="+data[9]+   //nama gol
				"&d="+data[10]+  //tmt gol
				"&e="+data[24]+  //tmt jafung
				"&f="+data[65]+  //kd jenis guru
				"&g="+data[16]+   //mk awal bln
				"&h="+data[17]+   // mk awal thn
				"&i="+data[66]+   // glr dpn
				"&j="+data[67]+   // glr blk
				"&k="+data[20]+   // kd_pend usul
				"&l="+data[21]+   // jurusan pend usul
				"&m="+data[22]+   // th lulus
				"&n="+id_kepsek,   
							
			cache:false,
			complete: function() {
				$("#load_usulan").hide();
			},
			success:function(msg){
				
				data=msg.split("|");
				if ( data[0] == "sukses"){
					window.location.reload();
				}
				
			}
					
		})
				
		}
	})
				
           
	}	
	
	
	
	cek_masa_penilaian_terkahir();
	function cek_masa_penilaian_terkahir(){
		id_pegawai	=	$("#id_pegawai").val();
		
		//alert();
		
        $.ajax({
			url:"./kelas/detail.php",
			data:"op=cari_masa_penilaian&id_pegawai="+id_pegawai,
			cache:false,
				
			success:function(msg){
			data=msg.split("|");
			//alert(msg);
		
				d=msg.split("|");
			
			
				$("#tgl_mulai_dupak").val(d[1]);
				$("#tgl_sampai_dupak").val(d[2]);
		
		
			}
					
			})
				
		
	};
		
	
});



</script>

<script src="./js/custom_ajax.js"></script>


<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
    <th width="*%">DATA SEKOLAH</td>
</tr>

<tr>
    <td>
        <table width="100%" border="0">
			<tr>
                <td width="30%" valign="top">Sekolah</td>
                <td>
					&nbsp;&nbsp;
					<textarea style="width:460px; height:40px; padding:2px 0 5px 5px; resize: none; background-color: #e6eaeb;" id="nama_sekolah" disabled></textarea>
                </td>
			</tr> 
			<tr>
                <td width="30%">Nama Kepala Sekolah</td>
                <td>
					&nbsp;&nbsp;
					 <input type="text"   id="nama_kepsek" size="60px" disabled> 
					 <input type="hidden"   id="id_kepsek" > 
                </td>
			</tr> 
			<tr>
                <td>Nama Petugas / Operator Sekolah</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"    id="nama_operator_sekolah" size="60px" disabled>
                </td>
			</tr> 
        </table>
	</td>
</tr>
</table>

<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
    <th width="*%">DATA DUPAK AJUAN</td>
</tr>

<tr>
    <td>
        <table width="100%" border="0">
			<tr>
                <td width="30%">No Dupak</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"  style="color:red; font-height:bold;"  id="b_no_dupak" size="35px" disabled>
                </td>
			</tr> 
			<tr>
                <td>Tanggal Pengajuan Dupak</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"    id="b_tgl_dupak" size="15px" disabled>
                </td>
			</tr> 
			<tr>
                <td>Tanggal Input Data</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"    id="b_entry_dupak" size="15px" disabled>
                </td>
			</tr> 
            <tr>
                <td>Masa Penilaian</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"   placeholder="dd-mm-yyyy" id="tgl_mulai_dupak" size="10px"  maxlength="10" onkeypress='return angka(event)'> 
					&nbsp; s.d &nbsp; <input type="text"   placeholder="dd-mm-yyyy" id="tgl_sampai_dupak" size="10px"  maxlength="10" onkeypress='return angka(event)'>
                </td>
			</tr> 
			
        </table>
	</td>
</tr>
</table>

<table width="730px" style="margin:10px 0 5px 30px;" border="0">
<tr>
	<td>
		<button class="ui-state-default simpan" id="simpan_dupak" >SIMPAN PENGAJUAN DUPAK</button>
		<img src="images/loader/load1.gif" id="load_usulan" />
	</td>
</tr>
</table>