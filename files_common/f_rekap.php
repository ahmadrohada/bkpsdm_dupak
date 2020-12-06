<script>
$(document).ready(function () {
	//nip_baru = $("#nip_baru").val();
	//no_pak_terakhir = $("#no_pak_terakhir").val();
	no_dupak		=	$("#no_dupak").val();
	
	$.ajax({
		url:"./kelas/proses.php",
        data:"op=cek_step&no_dupak="+no_dupak,
            cache:false,
            success:function(msg){
			//alert (msg);
			data=msg.split("|");
				$( "#progressbar" ).progressbar({value: +data[2]  });
			}
    })
	
	//alert(no_dupak);
	detail_pak_lama();
	//alert(nip_baru);
	function detail_pak_lama(){
		$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_rekap&id_pegawai="+id_pegawai+"&no_dupak="+no_dupak,
        cache:false,
            success:function(msg){
			data=msg.split("|");
				//Data PAK
				
				//Nilai PAK
				//alert(data[0]);
				
				$("#r_pend_lama").val(data[0]);
				$("#r_pend_baru").val(data[1]);
			
				$("#r_pend_total").val(data[2]);
				
				
				$("#r_diklat_lama").val(data[3]);
				$("#r_diklat_baru").val(data[4]);
				$("#r_diklat_total").val(data[5]);
				
				
				$("#r_pbt_lama").val(data[6]);
				$("#r_pbt_baru").val(data[7]);
				$("#r_pbt_total").val(data[8]);
				
				
				
				$("#r_pd_lama").val(data[9]);
				$("#r_pd_baru").val(data[10]);
				$("#r_pd_total").val(data[11]);
				
				
				$("#r_pi_lama").val(data[12]);
				$("#r_pi_baru").val(data[13]);
				$("#r_pi_total").val(data[14]);
				
				
				$("#r_ki_lama").val(data[15]);
				$("#r_ki_baru").val(data[16]);
				$("#r_ki_total").val(data[17]);
				
				
				$("#r_unsur_utama_lama").val(data[18]);
				$("#r_unsur_utama_baru").val(data[19]);
				$("#r_unsur_utama_total").val(data[20]);
				
				
				$("#r_sttb_tdksesuai_lama").val(data[21]);
				$("#r_sttb_tdksesuai_baru").val(data[22]);
				$("#r_sttb_tdksesuai_total").val(data[23]);
				
				
				
				$("#r_dukung_tugas_lama").val(data[24]);
				$("#r_dukung_tugas_baru").val(data[25]);
				$("#r_dukung_tugas_total").val(data[26]);
				
				
				$("#r_unsur_penunjang_lama").val(data[27]);
				$("#r_unsur_penunjang_baru").val(data[28]);
				$("#r_unsur_penunjang_total").val(data[29]);
				
				
				$("#r_ak_lama").val(data[30]);
				$("#r_ak_baru").val(data[31]);
				$("#r_ak_total").val(data[32]);
				
            }
			
        })
		}
		

	$("#simpan_rekap").click(function(){
			$.ajax({
			url:"./kelas/dupak.php",
			data:"op=update_step&step=6&no_dupak="+no_dupak,
                    cache:false,
                    success:function(msg){
		
					//$( "#tab_new_dupak" ).tabs( "option", "active", 0 );
					//window.location.assign("home.php?page=detail_dupak&no_dupak="+no_dupak);
					window.location.assign("?page=data_dupak");
					}
			})
	 });
	
	
});



</script>

<script src="./js/custom_ajax.js"></script>

<table style="width:732px; margin-left:30px;" class="form" border="1">
<tr>
    <th width="*%">PENETAPAN ANGKA KREDIT</th>
	<th width="13%">LAMA</th>
	<th width="13%">BARU</th>
	<th width="13%">JUMLAH</th>
</tr>

<tr class="judul">
    <td colspan="4" class="isi" style="padding-left:15px;">1. Unsur Utama</td>
</tr>
<tr>
    <td colspan="4" style="padding-left:15px;">
		a. Pendidikan
        <table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:13px;">Pendidikan Sekolah</td>
                <td width="14%" align="center">
                    <input  class="ak_field"  type="text"   id="r_pend_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input class="ak_field"  type="text"    value="0" id="r_pend_baru" disabled  >
				</td>
                <td width="12%" align="center">
					<input class="ak_field" type="text"   id="r_pend_total" disabled >
				</td>
            </tr>
            <tr>
                <td style="padding-left:13px;">Diklat Kedinasan</td>
                <td align="center">
                    <input type="text" class="ak_field"   id="r_diklat_lama" disabled />
                </td>
                <td align="center">
					<input type="text" class="ak_field"    id="r_diklat_baru" disabled />
				</td>
                <td align="center">
					<input type="text" class="ak_field" id="r_diklat_total"  disabled >
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td colspan="4" style="padding-left:15px;">b.Pembelajaran /Bimbingan dan Tugas Tertentu
		<table WIDTH="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:13px;">Pembelajaran /Bimbingan dan Tugas Tertentu</td>
                <td width="14%" align="center">
                    <input class="ak_field" type="text"    id="r_pbt_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input class="ak_field" type="text"    id="r_pbt_baru"  disabled />
				</td>
                <td width="12%" align="center">
					<input  class="ak_field" type="text" id="r_pbt_total"    disabled>
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td colspan="4" style="padding-left:15px;">c. Pengembangan Keprofesian Berkelanjutan
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:13px;">Pengembangan Diri</td>
                <td width="14%" align="center" >
                    <input type="text" class="ak_field"   id="r_pd_lama" disabled />
                </td >
                <td width="13%" align="center">
					<input type="text"  class="ak_field"   id="r_pd_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="r_pd_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%" style="padding-left:13px;">Publikasi Ilmiah</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="r_pi_lama" disabled  />
                </td >
                <td width="13%" align="center">
					<input type="text" class="ak_field"   id="r_pi_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="r_pi_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%" style="padding-left:13px;">Karya Inovatif</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="r_ki_lama" disabled  />
                </td >
                <td width="13%" align="center">
					<input type="text"  class="ak_field"   id="r_ki_baru" disabled  />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" id="r_ki_total"   disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:15px;">JUMLAH UNSUR UTAMA</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field" style="font-weight:bold"  id="r_unsur_utama_lama"   disabled   />
                </td>
                <td width="13%" align="center">
					<input type="text"  class="ak_field" style="font-weight:bold"  id="r_unsur_utama_baru"  disabled >
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="r_unsur_utama_total"   disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr class="judul">
    <td colspan="4" class="isi" style="padding-left:15px;">2. Unsur Penunjang</td>
</tr>
<tr valign="top">
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:15px;">Ijazah yang tidak sesuai</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field"  id="r_sttb_tdksesuai_lama" disabled  />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field"    id="r_sttb_tdksesuai_baru" disabled />
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" align="center" id="r_sttb_tdksesuai_total"   disabled >
				</td>
            </tr>
			<tr>
                <td width="*%" style="padding-left:15px;">Pendukung Tugas Guru</td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field"   id="r_dukung_tugas_lama" disabled />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field"    id="r_dukung_tugas_baru" disabled />
				</td>
                <td width="12%" align="center">
					<input class="ak_field" type="text" id="r_dukung_tugas_total"  disabled >
				</td>
            </tr>
        </table>
	</td>
</tr>
<tr valign="top">
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%"style="padding-left:15px;" >JUMLAH UNSUR PENUNJANG</td>
                <td width="14%" align="center">
                    <input type="text"  class="ak_field" style="font-weight:bold"   id="r_unsur_penunjang_lama" value="0" disabled />
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold"    id="r_unsur_penunjang_baru"  disabled >
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="r_unsur_penunjang_total"  disabled >
				</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:15px;"><b>Total Angka Kredit</b></td>
                <td width="14%" align="center">
                    <input type="text" class="ak_field" style="font-weight:bold" id="r_ak_lama"    disabled >
                </td>
                <td width="13%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold" id="r_ak_baru"   disabled>
				</td>
                <td width="12%" align="center">
					<input type="text" class="ak_field" style="font-weight:bold"  id="r_ak_total"   disabled >
				</td>
            </tr>
		</table>
    </td>
</tr>
</table>

<table style="width:732px; margin-left:30px;" border="0">
<tr>
	<td colspan="2">
		<button class="ui-state-default simpan" id="simpan_rekap" >SELESAI</button>
	</td>
</tr>
</table>
