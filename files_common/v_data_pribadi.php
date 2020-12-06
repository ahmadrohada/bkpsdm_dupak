<script>
$(document).ready(function () {
	//$("html, body").animate({ scrollTop: 160 }, "slow");
	
	id_pegawai = $("#id_pegawai").val();
	//alert(id_pegawai);
	$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
	detail_data_guru();
	
	
	
	function detail_data_guru(){
			$.ajax({
						url:"./kelas/detail.php",
                        data:"op=detail_data_guru&id_pegawai="+id_pegawai,
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
							//alert(msg);
							
							if (data[0] == '1') {
								
								
								//isi field pada form_data_guru
								$("#nama").val(data[1]);
								$("#ttl").val(data[2]);
								$("#jk").val(data[3]);
								$("#nip").val(data[4]);
								$("#nuptk").val(data[5]);
								$("#no_karpeg").val(data[6]);
								
								$("#no_pak_terakhir").val(data[7]);
								$("#jenjang").val(data[8]);
								$("#gelar_dpn").val(data[9]);
								$("#gelar_blk").val(data[10]);
								$("#nama_gol").val(data[19]);
								
								$("#foto").html(data[49]);
								
								//mAsa Kerja
								$("#mk_awal_bln").val(data[51]);
								$("#mk_awal_thn").val(data[50]);
								$("#jm_mk_thn").val(data[52]);
								$("#jm_mk_bln").val(data[53]);
									
								//alert(data[7]);
								
								if ( data[7] != "-" ){
									detail_pak_lama();
								}else{
									//JIKA pegawai belum punya PAK.. ambil data nya dari data peg
									detail_pegawai();
								}
								
								
								
							}else if (data[0] == '0') {
								$(".cari_nip").hide();
								alert ("Data Guru tidak ditemukan");
								
							}
							
							$( ".pre_load" ).fadeOut(10);
                        }
                    })
					
		}
		
	function detail_pegawai(){

							$("#nama_gol_x").val(data[19]);
							$("#tmt_gol").val(data[24]);
							//alert(data[31]);
							$("#pangkat").val(data[26]);
							$("#jab_lama_guru").val(data[27]);
							$("#jab_baru_guru").val(data[28]);
							
							$("#sekolah").val(data[21]);
							//alert(data[18]);
							$("#kd_skpd").val(data[25]);
							$("#jenjang").val(data[12]);
							$("#jurusan").val(data[13]);
							$("#th_lulus").val(data[18]);
							//JAFUNG
							$("#tugas_mengajar").val(data[20]);
							$("#tmt_jafung").val(data[29]);
							$("#jenis_guru").val("");
							
						
				
				
		}
		
	function detail_pak_lama(){
		$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_pak_lama&id_pegawai="+id_pegawai,
        cache:false,
            success:function(msg){
			//alert(msg);
			data=msg.split("|");
				//Data PErorangan
				$("#no_pak").val(data[4]);
				$("#tgl_pak").val(data[5]);
				$("#tgl_mulai").val(data[6]);
				$("#tgl_sampai").val(data[7]);
				$("#nama_pejabat").val(data[59]);

				//GOL
				$("#nama_gol_x").val(data[9]);
				$("#tmt_gol").val(data[10]);
				//alert(data[9]);
				$("#pangkat").val(data[11]);
				$("#jab_lama_guru").val(data[12]);
				$("#jab_baru_guru").val(data[13]);

				$("#sekolah").val(data[18]);
				//alert(data[18]);
				$("#kd_skpd").val(data[19]);
				$("#jenjang").val(data[60]);
				$("#jurusan").val(data[21]);
				$("#th_lulus").val(data[22]);
				//JAFUNG
				$("#tugas_mengajar").val(data[23]);
				$("#tmt_jafung").val(data[24]);
				$("#jenis_guru").val(data[25]);
				//alert(data[65]);
            }
        })
		}
		

	
	$(".loading_tab").fadeOut(10);
	
});



</script>

<script src="./js/custom_ajax.js"></script>


<?php 
//header("HTTP/1.0 404 Not Found");
//sleep(1);
?>

<div class="loading_tab"></div>
<div class="data_guru" id="form_data_guru">
<div class="pre_load" style="background: url(./images/loader/load1.gif) center no-repeat #e1e3e5 !important; height:235px !important; width:720px !important; margin:-20px 0px 0px -20px !important;" ></div>

<table width="100%" border="0" class="data_form">
<tr>
	<td width="23%" rowspan="10" valign="top" align="left">
		<span id="foto" class="pas_poto"></span>
	</td>
	<td width="19%">
		Nama
		
	</td>
	<td width="1%">
		:
	</td>
	<td width="*%">
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="nama" disabled>
	</td>
</tr>
<tr>
	<td>
		Tempat/Tgl Lahir
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="ttl" disabled>
	</td>
</tr>
<tr>
	<td>
		Jenis Kelamin
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="jk" disabled>
	</td>
</tr>
<tr>
	<td>
		Nip Baru
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px;" id="nip" disabled>
	</td>
</tr>
<tr>
	<td>
		NUPTK
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="nuptk" disabled>
	</td>
</tr>
<tr>
	<td>
		No Karpeg
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="no_karpeg" disabled>
	</td>
</tr>
<tr>
	<td>
		Golongan
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="nama_gol" disabled>
	</td>
</tr>
<tr>
	<td>
		No PAK Terakhir
	</td>
	<td width="1%">
		:
	</td>
	<td>
		<input type="text" style="background:transparent; border:none; cursor:pointer; color:#4f4f4f; margin:-6px; width:200px;" id="no_pak_terakhir" disabled>
	</td>
</tr>


</table>
</div>



<table style="width:732px; margin-left:30px; margin-top:10px;" class="form" border="1">

<tr>
    <th width="*%">DATA PAK TERAKHIR</td>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">NO PAK</td>
                <td width="*%" class="isi" >
                    &nbsp;&nbsp;
					<input type="text"  id="no_pak" size="40" disabled>
                </td>
            </tr>
           <tr>
                <td>Tanggal Pak</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" id="tgl_pak" size="8px" disabled>
                </td>
			</tr>
            <tr>
                <td>Masa Penilaian</td>
                <td>
					&nbsp;&nbsp;
					<input type="text"  id="tgl_mulai" size="8px" disabled> 
					&nbsp; s.d &nbsp; <input type="text" id="tgl_sampai" size="8px" disabled>
                </td>
			</tr> 
            <tr>
                <td>Nama Pejabat</td>
                <td>
					&nbsp;&nbsp;
					<input type="text"  id="nama_pejabat" size="34px" disabled> 
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>


<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
    <th width="*%">DATA PENDIDIKAN TERAKHIR</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Jenjang</td>
                <td width="*%" >
					&nbsp;&nbsp;
					<input type="text" size="25px" id="jenjang" disabled>
                </td>
            </tr>
            <tr>
                <td>Jurusan/Tahun Lulus</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="38px" id="jurusan" disabled> &nbsp;<input type="text" size="4px"  id="th_lulus" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>







<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
    <th width="*%">GOLONGAN DAN MASA KERJA</th>
</tr>

<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Golongan</td>
                <td width="*%" >
                    &nbsp;&nbsp;
					<input type="text"  id="nama_gol_x" size="4px" disabled> 
                </td>
            </tr>
            <tr>
                <td>Pangkat / TMT GOL</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="pangkat" disabled> 
				   <input type="text" id="tmt_gol"  size="9px" disabled>
                </td>
			</tr>
			<tr>
                <td>Jabatan Lama / TMT Jab</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="jab_lama_guru" disabled> 
				   <input type="text" id="tmt_jafung" size="9px" disabled >
                </td>
			</tr>
			<tr>
                <td>Jabatan Baru</td>
                <td>
                   &nbsp;&nbsp;
				   <input type="text" size="28" id="jab_baru_guru" disabled> 
                </td>
			</tr>
			<tr>
                <td>Tugas Mengajar</td>
                <td>
				&nbsp;&nbsp;
				<input type="text" size="40px" id="tugas_mengajar" disabled>
                </td>
			</tr>
			<tr>
                <td>Jenis Guru</td>
                <td>
				&nbsp;&nbsp;
				<input type="text" size="40px" id="jenis_guru" disabled>
                </td>
			</tr>
            <tr>
                <td>Masa Kerja Awal</td>
                <td>
                    &nbsp;&nbsp;
					<input type="text" size="1" id="mk_awal_thn" disabled> Thn &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" size="1" id="mk_awal_bln" disabled> Bln
                </td>
			</tr> 
            <tr>
                <td>Masa Kerja Akhir</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="1" id="jm_mk_thn" disabled> Thn &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" size="1" id="jm_mk_bln" disabled> Bln
                </td>
			</tr>
			<tr>
			    <td width="30%">Sekolah</td>
                <td width="*%" >
                   &nbsp;&nbsp;
					<textarea style="width:330px; height:40px; padding:2px 0 5px 5px; resize: none; background-color: #e6eaeb;" id="sekolah" disabled></textarea>
					<input type="hidden" size="50px" id="kd_skpd" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>
