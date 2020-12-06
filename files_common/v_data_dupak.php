<script>
$(document).ready(function () {
	
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	id_pegawai = $("#id_pegawai").val();
	//alert(id_pegawai);
	$( "#load_v_dupak" ).hide();
	
	
	no_dupak = $("#no_dupak").val();
	
	
		$.ajax({
		url:"./kelas/detail.php",
		data:"op=detail_data_dupak&no_dupak="+no_dupak,
		cache:false,
		success:function(msg){
				data=msg.split("|");
				//alert(msg);
				$("#b_no_dupak").val(data[0]);
				$("#b_tgl_dupak").val(data[1]);
				$("#b_entry_dupak").val(data[2]);
				$("#b_nama_sekolah").val(data[3]);
				$("#b_nama_kepsek").val(data[4]);
				$("#b_nama_tu").val(data[5]);
				$("#b_mulai").val(data[6]);
				$("#b_sampai").val(data[7]);
			}
	})
								
	//MULAI VERIFIKASI
	$("#verifikasi_dupak").click(function(){
	no_dupak = $("#b_no_dupak").val();
	//alert(no_dupak);
	$( "#load_v_dupak" ).show();
		$.ajax({
		url:"./kelas/verifikasi.php",
		data:"op=simpan_dupak&no_dupak="+no_dupak,
			cache:false,
            success:function(msg){
				//alert(msg);
				$( "#load_v_dupak" ).hide();
				$( "#tab_verifikasi_dupak" ).tabs( "enable", 3 );
				$( "#tab_verifikasi_dupak" ).tabs( "option", "active", 3 );
					
			}
		})
	 });							
		
		
	p 		= $("#p").val();
	//alert(p);
	//ngehide tombol verifikasi	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak+"&p="+p,
                cache:false,
                success:function(msg){
				//alert(msg);
				data=msg.split("|");
				$( "#progressbar" ).progressbar({value: +data[2]});
				//alert(p);
				if ( (data[0] >= 20) || (((data[0] >=8) && (p == 1)) || ((data[0] >=14) && (p == 2 ))  ) ){
				//if ( (data[0] >=8) && (p == 1) || (data[0] >=14) && (p == 2 ) ){
					$("#verifikasi_dupak").hide();
				}
			}
	})
	
});



</script>

<script src="./js/custom_ajax.js"></script>




<div id="data_isian_dupak">
<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
    <th width="*%">DETAIL DATA DUPAK</td>
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
                <td width="30%" valign="top">Sekolah</td>
                <td>
					&nbsp;&nbsp;
					<textarea style="width:380px; height:40px; padding:2px 0 5px 5px; resize: none; " id="b_nama_sekolah" disabled></textarea>
                </td>
			</tr> 
			<tr>
                <td width="30%">Nama Kepala Sekolah</td>
                <td>
					&nbsp;&nbsp;
					 <input type="text"   id="b_nama_kepsek" size="60px" disabled> 
                </td>
			</tr> 
			<tr>
                <td>Nama Petugas / Operator Sekolah</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"    id="b_nama_tu" size="60px" disabled>
                </td>
			</tr> 
            <tr>
                <td width="30%">Masa Penilaian</td>
                <td>
					&nbsp;&nbsp;
                   <input type="text"   id="b_mulai" size="12px"  disabled> 
					&nbsp; s.d &nbsp; <input type="text"  id="b_sampai" size="12px"  disabled>
                </td>
			</tr> 
			
        </table>
	</td>
</tr>
</table>


<table style="width:732px; margin-left:40px;" border="0">
<tr>
	<td>
		<button class="ui-state-default lanjut" id="verifikasi_dupak" style="margin-left:-10px;">MULAI VERIFIKASI DUPAK</button>
		<img src="images/loader/load1.gif" id="load_v_dupak" />
	</td>
</tr>
</table>

</div>