<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php?page=data_dupak_f";</script><?php exit(); }  ?>

<script>
$(document).ready(function () {
	no_dupak = $("#no_dupak").val();
	$("#load_ekspor_dupak").hide();
	$("#foto").html('<img src="images/no_images.jpg" class="pas_poto"/>');
	detail_pak_baru();
	$("#load_data").show();
	
	
	function detail_pak_baru(){
			$.ajax({
						url:"./kelas/pak.php",
                        data:"op=detail_pak_baru&no_dupak="+no_dupak,
						beforeSend: function() {
							$("#load_data").show();
						},
						
                        cache:false,
                        success:function(msg){
							data=msg.split("|");
						
							$("#foto").html(data[0]);
							$("#p_nip_baru").val(data[1]);
							$("#p_nama_lengkap").val(data[2]);
							$("#p_ttl").val(data[3]);
							$("#p_jk").val(data[4]);
							$("#p_gelar_dpn").val(data[67]);
							$("#p_gelar_blk").val(data[68]);
							
							$("#p_jenjang").val(data[6]);
							$("#p_jurusan").val(data[7]);
							$("#p_th_lulus").val(data[8]);
							$("#p_kd_pend_usul").val(data[69]);
								
							//alert(data[17]);
							$("#p_golongan").val(data[9]);
							$("#p_pangkat").val(data[10]);
							$("#p_tmt_gol").val(data[11]);
							$("#p_jab_lama").val(data[12]);
							$("#p_tmt_jab").val(data[13]);
							$("#p_jab_baru").val(data[14]);
							$("#p_tugas_mengajar").val(data[15]);
							//$("#p_pbm").val(data[16]);
							$("#p_jenis_guru").val(data[17]);
							$("#p_kd_jenis_guru").val(data[66]);
							
							
							//MASA KERJA
							$("#p_mk_awal_thn").val(data[18]);
							$("#p_mk_awal_bln").val(data[19]);
							$("#p_jm_mk_thn").val(data[20]);
							$("#p_jm_mk_bln").val(data[21]);
							
							$("#p_kd_skpd").val(data[22]);
							$("#p_sekolah").val(data[23]);
							
							$("#p_no_pak_terakhir").val(data[24]);
							$("#p_tgl_pak_terakhir").val(data[25]);
							$("#p_masa_penilaian_pak_terakhir_mulai").val(data[26]);
							$("#p_masa_penilaian_pak_terakhir_sampai").val(data[27]);
							$("#p_id_pejabat_pak_terakhir").val(data[28]);
							
							
							//ANGKA KREDIT PAK LAMA
							$("#pend_lama").val(data[29]);
							$("#diklat_lama").val(data[30]);
							$("#pbt_lama").val(data[31]);
							$("#pd_lama").val(data[32]);
							$("#pi_lama").val(data[33]);
							$("#ki_lama").val(data[34]);
							$("#unsur_utama_lama").val(data[35]);
							$("#sttb_tdksesuai_lama").val(data[36]);
							$("#dukung_tugas_lama").val(data[37]);
							$("#unsur_penunjang_lama").val(data[38]);
							$("#ak_lama").val(data[39]);
							
							//ANGKA KREDIT PAK BARU
							$("#pend_baru").val(data[40]);
							$("#diklat_baru").val(data[41]);
							$("#pbt_baru").val(data[42]);
							$("#pd_baru").val(data[43]);
							$("#pi_baru").val(data[44]);
							$("#ki_baru").val(data[45]);
							$("#unsur_utama_baru").val(data[46]);
							$("#sttb_tdksesuai_baru").val(data[47]);
							$("#dukung_tugas_baru").val(data[48]);
							$("#unsur_penunjang_baru").val(data[49]);
							$("#ak_baru").val(data[50]);
						
							
							$("#pend_total").val(data[51]);
							$("#diklat_total").val(data[52]);
							$("#pbt_total").val(data[53]);
							$("#pd_total").val(data[54]);
							$("#pi_total").val(data[55]);
							$("#ki_total").val(data[56]);
							$("#unsur_utama_total").val(data[57]);
							$("#sttb_tdksesuai_total").val(data[58]);
							$("#dukung_tugas_total").val(data[59]);
							$("#unsur_penunjang_total").val(data[60]);
							$("#ak_total").val(data[61]);
							
							rekomendasi(data[62],data[1],data[9],data[25],data[61],data[43],data[44],data[45]);
							
							$("#b_no_dupak").val(data[62]);
							$("#tmt_jafungxx").val(data[63]);
							$("#tgl_mulai_dupak").val(data[64]);
							$("#tgl_sampai_dupak").val(data[65]);
							$("#p_id_pegawai").val(data[70]);
							//alert(data[7]);
                        }
                    })
					
		}
	
	
	
	function rekomendasi(no_dupak,nip_baru,nama_gol,tgl_pak_lama,ak_capaian_kom,ak_pd_baru,ak_pi_baru,ak_ki_baru){
		
		
		$.ajax({
			url:"./kelas/pak.php",
			data:"op=rekomendasi_dupak&no_dupak="+no_dupak+"&nip_baru="+nip_baru+"&nama_gol="+nama_gol+"&tgl_pak_lama="+tgl_pak_lama+"&ak_capaian_kom="+ak_capaian_kom+"&ak_pd_baru="+ak_pd_baru+"&ak_pi_baru="+ak_pi_baru+"&ak_ki_baru="+ak_ki_baru,
			cache:false,
			complete: function() {
							$("#load_data").hide();
						},
			success:function(msg){
				data=msg.split("|");
			
		
				$("#ak_min_komulatif").val(data[1]);
				$("#ak_capaian_komulatif").val(data[2]);
				$("#kesimpulan_komulatif").val(data[3]);
				
				
				$("#ak_min_pd").val(data[4]);
				$("#ak_capaian_pd").val(data[5]);
				$("#kesimpulan_pd").val(data[6]);
				
				
				$("#ak_min_piki").val(data[7]);
				$("#ak_capaian_piki").val(data[8]);
				$("#kesimpulan_piki").val(data[9]);
				
				
				
				
				//alert(data[12]);
				$("#makalah").val(data[10]);
				document.getElementById("capaian_makalah").checked = data[11];	
				$("#kesimpulan_makalah").val(data[12]);
				
				//alert(data[14]);
				$("#artikel").val(data[13]);
				document.getElementById("capaian_artikel").checked = data[14];
				$("#kesimpulan_artikel").val(data[15]);
			
			
				$("#buku").val(data[16]);
				document.getElementById("capaian_buku").checked = data[17];
				$("#kesimpulan_buku").val(data[18]);					
									
		
				
				
									
				
									
			
						
				
		
				
				
				
			}
		})
	
	}
	
	
	
	
	//FUUNGSI Untuk ekspor dupak ke data PAK
	$("#ekspor_dupak").click(function(){
		
		id_pegawai			= $("#p_id_pegawai").val();
		nip_baru			= $("#p_nip_baru").val();
		no_pak_lama			= $("#p_no_pak_terakhir").val();
		tgl_pak_baru		= $("#tmt_jafungxx").val();
		tgl_mulai_pak		= $("#tgl_mulai_dupak").val();
		tgl_sampai_pak		= $("#tgl_sampai_dupak").val();
		/** ANKa Kredit **/
		pend_lama			= $("#pend_lama").val();
		diklat_lama			= $("#diklat_lama").val();
		pbt_lama			= $("#pbt_lama").val();
		pd_lama				= $("#pd_lama").val();
		pi_lama				= $("#pi_lama").val();
		ki_lama				= $("#ki_lama").val();
		sttb_tdksesuai_lama	= $("#sttb_tdksesuai_lama").val();
		dukung_tugas_lama	= $("#dukung_tugas_lama").val();
		pend_baru			= $("#pend_baru").val();
		diklat_baru			= $("#diklat_baru").val();
		pbt_baru			= $("#pbt_baru").val();
		pd_baru				= $("#pd_baru").val();
		pi_baru				= $("#pi_baru").val();
		ki_baru				= $("#ki_baru").val();
		sttb_tdksesuai_baru	= $("#sttb_tdksesuai_baru").val();
		dukung_tugas_baru	= $("#dukung_tugas_baru").val();
		makalah				= $("#kesimpulan_makalah").val(); 
		artikel				= $("#kesimpulan_artikel").val();
		buku				= $("#kesimpulan_buku").val();
		kd_rekom			= $("#rekomendasi").val();
		kd_pejabat			= $("#kd_pejabat").val();
	
		//alert(artikel);
		/* pak_gol */
		nama_gol			= $("#p_golongan").val();
		tmt_gol				= $("#p_tmt_gol").val();
		tmt_jafung			= $("#p_tmt_jab").val();
		kd_jenis_guru		= $("#p_kd_jenis_guru").val();
		mk_gol_thn			= $("#p_mk_awal_thn").val();
		mk_gol_bln			= $("#p_mk_awal_bln").val();
		/* pak_pend  */
		gelar_dpn			= $("#p_gelar_dpn").val();
		gelar_blk			= $("#p_gelar_blk").val();
		kd_pend_usul		= $("#p_kd_pend_usul").val();
		jurusan_pend_usul	= $("#p_jurusan").val();
		th_pend_usul		= $("#p_th_lulus").val();
		kd_skpd				= $("#p_kd_skpd").val();
		
		no_dupak			= $("#b_no_dupak").val();
		//alert(no_dupak);
		
		
		if ( kd_rekom == '0'){
			alert("Rekomedasi belum dipilih")
			$("#rekomendasi").focus();
		}else if ( tgl_pak_baru == '' ){
			alert("Tanggal pak tidak boleh kosong")
			$("#tmt_jafungxx").focus();
		}else if ( tgl_mulai_pak == '' ){
			alert("Tanggal mulai pak tidak boleh kosong")
			$("#tgl_mulai_dupak").focus();
		}else if( tgl_sampai_pak =='' ){
			alert("Tanggal samapai pak tidak boleh kosong")
			$("#tgl_sampai_dupak").focus();
		}else if ( kd_pejabat == '' ){
			alert("Pejabat belum dipilih")
			$("#kd_pejabat").focus();
		}else {
			
			$("#load_ekspor_dupak").show();
			
			$.ajax({
				url:"./kelas/pak.php",
				data:"op=ekspor_dupak&a	="+id_pegawai+
									"&b	="+nip_baru+
									"&c	="+no_pak_lama+
									"&d	="+tgl_pak_baru+
									"&e	="+tgl_mulai_pak+
									"&f	="+tgl_sampai_pak+
									"&g	="+pend_lama+
									"&h	="+diklat_lama+
									"&i	="+pbt_lama+
									"&j	="+pd_lama+
									"&k	="+pi_lama+
									"&l	="+ki_lama+
									"&m	="+sttb_tdksesuai_lama+
									"&n	="+dukung_tugas_lama+
									"&o	="+pend_baru+
									"&p	="+diklat_baru+
									"&q	="+pbt_baru+
									"&r	="+pd_baru+
									"&s	="+pi_baru+
									"&t	="+ki_baru+
									"&u	="+sttb_tdksesuai_baru+
									"&v	="+dukung_tugas_baru+
									"&w	="+makalah+
									"&x	="+artikel+
									"&y	="+buku+
									"&z	="+kd_rekom+
									"&aa="+kd_pejabat+
									
									/* pak_gol */
									"&ac="+nama_gol+
									"&ad="+tmt_gol+
									"&ae="+tmt_jafung+
									"&af="+kd_jenis_guru+
									"&ag="+mk_gol_thn+
									"&ah="+mk_gol_bln+
									/* pak_pend  */
									"&ai="+gelar_dpn+
									"&aj="+gelar_blk+
									"&ak="+kd_pend_usul+
									"&al="+jurusan_pend_usul+
									"&am="+th_pend_usul+
									"&an="+kd_skpd+
									"&ao="+no_dupak,
									
				cache:false,
				success:function(msg){
					alert(msg);
					
					
					window.location.assign("?page=data_dupak_f");
					$("#load_ekspor_dupak").hide();
					
					
				}
			})
			
		} // end if kosong
		
		
	});
	
	
	
	
	
	
	
	
	
	
});



</script>

<script src="./js/custom_ajax.js"></script>

<img src="./images/loader/load4.gif" class="loader" id="load_data">

<?php 
$no_dupak = isset($_GET['no_dupak']) ? $_GET['no_dupak'] : '';

?>
<input type="hidden" value="<?php echo $no_dupak;?>" id="no_dupak" >








<div class="kiri">

<table style="width:560px; margin-left:15px;" class="form" border="1">
<tr>
    <th colspan='2' width="*%">DATA PERORANGAN</th>
</tr>
<tr>
	<td valign="top" align="center">
		<span id="foto" class="pas_poto"></span>
	</td>
    <td >
        <table width="100%" border="0">
            <tr>
                <td width="35%">NIP BARU</td>
                <td width="*%" >
					&nbsp;&nbsp;
					<input type="text" size="28px" id="p_nip_baru" disabled>
					<input type="hidden" size="28px" id="p_id_pegawai" >
                </td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="28px" id="p_nama_lengkap" disabled>
					<input type="hidden" size="28px" id="p_gelar_dpn" >
					<input type="hidden" size="28px" id="p_gelar_blk" >
                </td>
			</tr>
			<tr>
                <td>Tempat Tanggal Lahir</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="28px" id="p_ttl" disabled>
                </td>
			</tr>
		    <tr>
                <td>Jenis Kelamin</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="28px" id="p_jk" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>

<table style="width:560px; margin-left:15px;" class="form" border="1">
<tr>
    <th width="*%">DATA PENDIDIKAN YANG DIAJUKAN</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Jenjang</td>
                <td width="*%" >
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_jenjang" disabled>
                </td>
            </tr>
            <tr>
                <td>Jurusan/Tahun Lulus</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_jurusan" disabled> &nbsp;<input type="text" size="4px"  id="p_th_lulus" disabled>
					<input type="hidden" size="30px" id="p_kd_pend_usul" >
				</td>
			</tr>
        </table>
	</td>
</tr>
</table>


<table style="width:560px; margin-left:15px;" class="form" border="1">
<tr>
    <th width="*%">DATA GOLONGAN DAN MASA KERJA</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">Golongan</td>
                <td width="*%" >
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_golongan" disabled>
                </td>
            </tr>
            <tr>
                <td>Pangkat / TMT Gol</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_pangkat" disabled>
					<input type="text" size="8px" id="p_tmt_gol" disabled>
                </td>
			</tr>
			<tr>
                <td>Jabatan Lama / TMT Jab</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_jab_lama" disabled>
					<input type="text" size="8px" id="p_tmt_jab" disabled>
                </td>
			</tr>
		    <tr>
                <td>Jabatan Baru</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_jab_baru" disabled>
                </td>
			</tr>
			<tr>
                <td>Tugas Mengajar</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_tugas_mengajar" disabled>
                </td>
			</tr>
		    <tr>
                <td>Jenis Guru</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="30px" id="p_jenis_guru" disabled>
					<input type="hidden" size="30px" id="p_kd_jenis_guru" >
                </td>
			</tr>
		    <tr>
                <td>Masa Kerja Awal</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="1px" id="p_mk_awal_thn" disabled> Thn &nbsp;&nbsp;&nbsp;
					<input type="text" size="1px" id="p_mk_awal_bln" disabled> Bln
                </td>
			</tr>
		    <tr>
                <td>Masa Kerja Akhir</td>
                <td>
					&nbsp;&nbsp;
					<input type="text" size="1px" id="p_jm_mk_thn" disabled> Thn &nbsp;&nbsp;&nbsp;
					<input type="text" size="1px" id="p_jm_mk_bln" disabled> Bln
                </td>
			</tr>
			<tr>
			    <td width="30%">Sekolah</td>
                <td width="*%" >
					&nbsp;&nbsp;
					<textarea style="width:330px; height:40px; padding:2px 0 5px 5px; resize: none; " id="p_sekolah" disabled></textarea>
					<input type="hidden" size="50px" id="p_kd_skpd" >
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>

<table style="width:560px; margin-left:15px;" class="form" border="1">
<tr>
    <th>Rekomendasi</th>
</tr>
<tr>
    <td colspan="4">
        <table width="100%" >
            <tr>
                <td width="50%">
				</td>
                <td width="17%" align="center">
                    AK Min
                </td>
                <td width="17%" align="center">
					AK Capaian
				</td>
                <td width="*%" align="center">
					Kesimpulan
				</td>
            </tr>
			<tr>
                <td>
					Angka Kredit Komulatif
				</td>
                <td align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold; " id="ak_min_komulatif"  disabled>
                </td>
                <td align="right" class="isi">
					<input type="text" class="ak_field"  style="background:transparent; border:none; font-weight: bold; " id="ak_capaian_komulatif" disabled>
				</td>
                <td  class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:100px;" id="kesimpulan_komulatif" disabled>
				</td>
            </tr>
			<tr>
                <td>
					Angka Kredit Pengembangan Diri
				</td>
                <td align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold; " id="ak_min_pd"  disabled>
                </td>
                <td  align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold;" id="ak_capaian_pd" disabled>
				</td>
                <td   class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:100px;" id="kesimpulan_pd" disabled>
				</td>
            </tr>
			<tr>
                <td>
					Angka Kredit PIKI
				</td>
                <td  align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold; " id="ak_min_piki" disabled >
                </td>
                <td  align="right" class="isi">
					<input type="text" class="ak_field" style="background:transparent; border:none; font-weight: bold;" id="ak_capaian_piki" disabled>
				</td>
                <td   class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:100px;" id="kesimpulan_piki" disabled>
				</td>
            </tr>
			<tr>
                <td>
					Makalah / Penelitian
				</td>
                <td  align="right" class="isi">
					<input type="text" style="background:transparent; border:1px; font-weight: bold; width:80px;" id="makalah" disabled >

                </td>
                <td  align="center">
					<input type='checkbox' id="capaian_makalah" disabled>
				</td>
                <td   class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:100px;" id="kesimpulan_makalah" disabled>
				</td>
            </tr>
			<tr>
                <td >
					Artikel di Jurnal
				</td>
                <td  align="right" class="isi">
					<input type="text" style="background:transparent; border:none; font-weight: bold; width:80px; " id="artikel" disabled >
                </td>
                <td  align="center">
					<input type='checkbox' id="capaian_artikel" disabled>
				</td>
                <td   class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:100px;" id="kesimpulan_artikel" disabled>
				</td>
            </tr>
			<tr>
                <td >
					Buku
				</td>
                <td  align="right" class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:80px;" id="buku" disabled >
                </td>
                <td  align="center">
					<input type='checkbox' id="capaian_buku" disabled>
				</td>
                <td   class="isi">
					<input type="text"  style="background:transparent; border:none; font-weight: bold; width:100px;" id="kesimpulan_buku" disabled>
				</td>
            </tr>
			<tr>
                <td  valign="top">
					Rekomendasi
				</td>
                <td colspan="3" style="padding-left:12px;" >
					&nbsp;&nbsp;
					<select id="rekomendasi" style="margin-top:-10px; height:55px; width:340px;  word-break: break-word; white-space: normal; ">
							<?php
							Connect::getConnection();
							$row = mysql_query("SELECT * FROM kd_rekomendasi ");
							while ($r = mysql_fetch_array($row)){
						?>
							<option value="<?php echo $r['kd_rekom']; ?>"  ><?php echo $r['rekomendasi']; ?></option>

						<?php } ?>
					</select>
                </td>
            </tr>
        </table>  
</tr>
</table>


</div>

<div class="kanan">

<table style="width:560px; margin-left:15px;" class="form" border="1">
<tr>
    <th>DATA PAK LAMA</th>
</tr>
<tr>
    <td>
        <table width="100%" border="0">
            <tr>
                <td width="30%">No PAK Lama</td>
                <td width="*%">
					<input type="text" id="p_no_pak_terakhir" size="42px" disabled>
                </td>
            </tr>
            <tr>
                <td>Tanggal PAK</td>
                <td>
					<input type="text" id="p_tgl_pak_terakhir" size="14px" disabled>
                </td>
			</tr>
            <tr>
                <td>Masa Penilaian</td>
                <td>
					<input type="text" id="p_masa_penilaian_pak_terakhir_mulai" size="14px" disabled> &nbsp; s.d &nbsp;
					<input type="text" id="p_masa_penilaian_pak_terakhir_sampai" size="14px" disabled> 
                </td>
			</tr> 
            <tr>
                <td>Nama Pejabat</td>
				 <td>
					<input type="text" id="p_id_pejabat_pak_terakhir" size="42" disabled>
                </td>
			</tr>
        </table>
	</td>
</tr>
</table>


<table style="width:560px; margin-left:15px;" class="form" border="1">
<tr>
    <th width="*%">PENETAPAN ANGKA KREDIT</th>
	<th width="13%">LAMA</th>
	<th width="13%">BARU</th>
	<th width="13%">JUMLAH</th>
</tr>
<tr class="judul">
    <td colspan="4"><label>1. Unsur Utama</label></td>

</tr>
<tr>
    <td colspan="4">
		<label>a. Pendidikan</label>
        <table width="100%" border="0" >
            <tr>
                <td width="*%">Pendidikan Sekolah</td>
                <td width="14%" align="center">
                    <input  class="ak_field"  type="text"   id="pend_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input class="ak_field"  type="text"    value="0" id="pend_baru" disabled  >
				</td>
                <td width="12%" align="center">
					<input class="ak_field" type="text"   id="pend_total" disabled >
				</td>
            </tr>
            <tr>
                <td >Diklat Kedinasan</td>
                <td align="center">
                    <input type="text" class="ak_field"   id="diklat_lama" disabled />
                </td>
                <td align="center">
					<input type="text" class="ak_field"    id="diklat_baru" disabled />
				</td>
                <td align="center">
					<input type="text" class="ak_field" id="diklat_total"  disabled >
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td colspan="4"><label>b.Pembelajaran /Bimbingan dan Tugas Tertentu</label>
		<table WIDTH="100%" border="0">
            <tr>
                <td width="*%">Pembelajaran /Bimbingan dan Tugas Tertentu</td>
                <td width="14%" align="center">
                    <input class="ak_field" type="text"    id="pbt_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input class="ak_field" type="text"    id="pbt_baru"  disabled />
				</td>
                <td width="12%" align="center">
					<input  class="ak_field" type="text" id="pbt_total"    disabled>
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td colspan="4"><label>c. Pengembangan Keprofesian Berkelanjutan</label>
		<table width="100%" border="0">
            <tr>
                <td width="*%">Pengembangan Diri</td>
                <td width="14%" align="center" >
                    <input type="text" class="ak_field"   id="pd_lama" disabled />
                </td >
                <td width="13%" align="center">
					<input type="text"  class="ak_field"   id="pd_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="pd_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%">Publikasi Ilmiah</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="pi_lama" disabled  />
                </td >
                <td width="13%" align="center">
					<input type="text" class="ak_field"   id="pi_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="pi_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%">Karya Inovatif</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="ki_lama" disabled  />
                </td >
                <td width="13%" align="center">
					<input type="text"  class="ak_field"   id="ki_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="ki_total"   disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%">JUMLAH UNSUR UTAMA</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field" style="font-weight:bold"  id="unsur_utama_lama"   disabled   />
                </td>
                <td width="13%" align="center">
					<input type="text"  class="ak_field" style="font-weight:bold"  id="unsur_utama_baru"  disabled >
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="unsur_utama_total"   disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr class="judul">
    <td colspan="4"><label>2. Unsur Penunjang</label></td>
</tr>
<tr valign="top">
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%">Ijazah yang tidak sesuai</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field"  id="sttb_tdksesuai_lama" disabled  />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field"    id="sttb_tdksesuai_baru" disabled />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" align="center" id="sttb_tdksesuai_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%">Pendukung Tugas Guru</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="dukung_tugas_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field"    id="dukung_tugas_baru" disabled />
				</td>
                <td width="12%" align="center">
					<input class="ak_field" type="text" id="dukung_tugas_total"  disabled >
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%">JUMLAH UNSUR PENUNJANG</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field" style="font-weight:bold"   id="unsur_penunjang_lama" value="0" disabled />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold"    id="unsur_penunjang_baru"  disabled >
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="unsur_penunjang_total"  disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="4">
		<table width="100%" border="0">
            <tr>
                <td width="*%"><b>Total Angka Kredit</b></td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field" style="font-weight:bold" id="ak_lama"    disabled >
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="ak_baru"   disabled>
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold"  id="ak_total"   disabled >
				</td>
            </tr>
		</table>
    </td>
</tr>
</table>





<table style="width:560px; margin-left:15px;" class="form" border="1">
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
					<input type="text"  style="font-height:bold;"  id="tmt_jafungxx" size="10px" >
                </td>
			</tr>
            <tr>
				<td>Masa Penilaian</td>
                <td>
					<input type="text"  style="font-height:bold;" id="tgl_mulai_dupak" size="10px" > s.d
					<input type="text"  style="font-height:bold;" id="tgl_sampai_dupak" size="10px" >
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


<table width="730px" style="margin:10px 0 5px 15px;" border="0">
<tr>
	<td>
		<button style="padding:10px 20px 10px 30px;" class="ui-state-default lanjut" id="ekspor_dupak" >SIMPAN PENGAJUAN DUPAK</button>
		<img src="images/loader/load1.gif" id="load_ekspor_dupak" />
	</td>
</tr>
</table>


</div>