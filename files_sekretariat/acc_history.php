<script>
$(function(){
	id_pegawai 		= $("#id_pegawai").val();	no_dupak	 	= $("#no_dupak").val();
	
	detail_data_guru();
	detail_dupak();
	//alert(no_dupak);
	
	function detail_data_guru(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							
							if (data[0] == '1') {
							
								$("#b_no_pak_terakhir").val(data[7]);
								$("#b_tgl_pak_terakhir").val(data[8]);
								$("#b_masa_penilaian_pak_terakhir").val(data[9]);
								$("#b_nama_pejabat_pak_terakhir").val(data[11]);
								
							}else if (data[0] == '0') {
								alert ("Data Guru tidak ditemukan");
								
							}
							
							//$( ".pre_load" ).fadeOut(10);
                        }
                    })
					
		}
	
	
	function detail_dupak(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_dupak&no_dupak="+no_dupak,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							$("#b_no_dupak").val(data[0]);
							
							$("#b_tgl_pak_baru").val(data[1]);
							$("#b_tgl_pak_mulai").val(data[6]);
							$("#b_tgl_pak_selesai").val(data[7]);
							//$("#b_masa_penilaian_pak_terakhir").val(data[9]);
							//$("#b_nama_pejabat_pak_terakhir").val(data[11]);
								
							$( ".pre_load" ).fadeOut(10);
                        }
                    })
					
		}
		
		
	$("#export_dupak_to_pak").click(function(){
			
			kd_pejabat		= $("#kd_pejabat").val();
		
		
		
			if ( kd_pejabat == "" ){
				alert("Nama Pejabat belum dipilih");
				$("#kd_pejabat").focus();
			} else {
		
			$("#dialog-form").html(
			""
			+"<span class='ui-icon ui-icon-info' style='float:left; margin:0 7px 10px 0;'></span>"
			+"<font style='color:red;'>Pastikan tidak ada kesalahan pada data DUPAK yang akan diproses</font>"
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
					"Proses": function () {
						$(this).dialog('close');
						proses();
						
					},
						"Batal": function () {
						$(this).dialog('close');
					}
				}
			});
			}
	 });	
		
	function proses(){
		
		//$( "#load_proses" ).show();
		no_dupak				=	$("#b_no_dupak").val();
		no_pak_terakhir			=	$("#b_no_pak_terakhir").val();
		
		
		tgl_pak					= 	$("#b_tgl_pak_baru").val();
		tgl_mulai				= 	$("#b_tgl_pak_mulai").val();
		tgl_sampai				= 	$("#b_tgl_pak_selesai").val();
		kd_pejabat				= 	$("#kd_pejabat").val();
		
        //alert(no_pak_terakhir);

       $.ajax({
		url:"./kelas/pak.php",
        data:"op=export_dupak&no_dupak				= "+no_dupak+
								"&tgl_pak			= "+tgl_pak+
								"&tgl_mulai			= "+tgl_mulai+
								"&tgl_sampai		= "+tgl_sampai+
								"&kd_pejabat		= "+kd_pejabat+
								"&no_pak_terakhir	= "+no_pak_terakhir,
                    cache:false,
                    success:function(msg){
					//alert (msg);
					no_pak = msg;
						
						$.ajax({
						url:"./kelas/dupak.php",
						data:"op=update_step&no_dupak="+no_dupak+"&step=20",
								cache:false,
								success:function(msg){
									window.location.assign("?page=pak&no_pak=x");
								}
							})
						
						
					
					}
		})

	}
	
	
});
</script><script src="./js/custom_ajax.js"></script>

<!----  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  ------->
<!-- DATA HISTORY PAK DAN ENTRY NEW PAK   -------->
<!----  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  ------->




<table style="width:732px; margin-left:30px;" class="form" border="1"><tr>
    <th>DATA PAK LAMA</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="35%">No PAK Lama</td>
                <td width="65%">
					<input type="text"  style="color:red; font-height:bold;"  id="b_no_pak_terakhir" size="45px" disabled>
                </td>
            </tr>
            <tr>
                <td>Tanggal PAK</td>
                <td>					<input type="text"  style="color:red; font-height:bold;"  id="b_tgl_pak_terakhir" size="18px" disabled>
                </td>
			</tr>
            <tr>
                <td>Masa Penilaian</td>
                <td class="isi">					<input type="text"  style="color:red; font-height:bold;" id="b_masa_penilaian_pak_terakhir" size="45px" disabled> 
                </td>
			</tr> 
            <tr>
                <td>Nama Pejabat</td>				 <td>					<input type="text"  style="color:red; font-height:bold;"  id="b_nama_pejabat_pak_terakhir" size="45" disabled>                </td>
			</tr>
        </table>
	</td>
</tr>
</table>

<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
	<th>DATA PAK BARU</th>
</tr>
<tr>
	<td>
        <table width="100%" border="0">
			<tr>
				<td width="35%">No DUPAK</td>
                <td width="65%">
					<input type="text"  style="color:red; font-height:bold;"  id="b_no_dupak" size="45" disabled>
                </td>
            </tr>
            <tr>
				<td width="35%">No PAK Baru</td>
                <td width="65%">
					<input type="text"  style="color:red; font-height:bold;"  placeholder="akan otomatis terisi setelah proses" size="45" disabled>
                </td>
            </tr>
            <tr>
				 <td>Tanggal PAK Baru</td>
                <td>
					<input type="text"  style="color:red; font-height:bold;"  id="b_tgl_pak_baru" size="20px" disabled>
                </td>
			</tr>
            <tr>
				<td>Masa Penilaian</td>
                <td>
					<input type="text"  style="color:red; font-height:bold;" id="b_tgl_pak_mulai" size="20px" disabled> s.d
					<input type="text"  style="color:red; font-height:bold;" id="b_tgl_pak_selesai" size="20px" disabled>
                </td>
			</tr> 
            <tr>
                <td>Nama Pejabat</td>
				 <td>
					<select id="kd_pejabat">
					<option value="">Pilih Pejabat</option>
                    <?php
					include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../kelas/pustaka.php';
					Connect::getConnection();
					$pj = mysql_query("SELECT * from dt_pejabat");
					while ($row=mysql_fetch_array($pj)){
					?>
						<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
					<?php	
					}
					?>
					</select>
                </td>
			</tr>
        </table>
	</td>
</tr>


</table>
<button  class="ui-state-default simpan" id="export_dupak_to_pak" style="float:left; margin-left:30px; width:200px;">SIMPAN DATA</button>
