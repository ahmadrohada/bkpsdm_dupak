<script>
$(document).ready(function () {
	id_pegawai = $("#id_pegawai").val();

	//alert(id_pegawai);
	//$("html, body").animate({ scrollTop: 160 }, "slow");
		
	detail_pak_lama();
	function detail_pak_lama(){
		$.ajax({
		url:"./kelas/detail.php",
        data:"op=detail_pak_lama&id_pegawai="+id_pegawai,
        cache:false,
            success:function(msg){
			data=msg.split("|");
				//Data PAK
				$("#no_pak").val(data[4]);
				//Nilai PAK

				$("#pend_lama").val(data[26]);
				$("#pend_baru").val(data[27]);
				$("#pend_total").val(data[28]);
				$("#diklat_lama").val(data[29]);
				$("#diklat_baru").val(data[30]);
				$("#diklat_total").val(data[31]);
				$("#pbt_lama").val(data[32]);
				$("#pbt_baru").val(data[33]);
				$("#pbt_total").val(data[34]);
				$("#pd_lama").val(data[35]);
				$("#pd_baru").val(data[36]);
				$("#pd_total").val(data[37]);
				$("#pi_lama").val(data[38]);
				$("#pi_baru").val(data[39]);
				$("#pi_total").val(data[40]);
				$("#ki_lama").val(data[41]);
				$("#ki_baru").val(data[42]);
				$("#ki_total").val(data[43]);

				$("#unsur_utama_lama").val(data[44]);

				$("#unsur_utama_baru").val(data[45]);
				$("#unsur_utama_total").val(data[46]);
				$("#sttb_tdksesuai_lama").val(data[47]);
				$("#sttb_tdksesuai_baru").val(data[48]);
				$("#sttb_tdksesuai_total").val(data[49]);
				$("#dukung_tugas_lama").val(data[50]);
				$("#dukung_tugas_baru").val(data[51]);
				$("#dukung_tugas_total").val(data[52]);
				$("#unsur_penunjang_lama").val(data[53]);

				$("#unsur_penunjang_baru").val(data[54]);

				$("#unsur_penunjang_total").val(data[55]);

				$("#ak_lama").val(data[56]);
				$("#ak_baru").val(data[57]);
				$("#ak_total").val(data[58]);
            }
        })
		}
		

	
});



</script>

<script src="./js/custom_ajax.js"></script>

<table style="width:732px; margin-left:30px;" class="form"  border="1">
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
                <td style="padding-left:13px;">Diklat Kedinasan</td>
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
    <td colspan="4" style="padding-left:15px;">b.Pembelajaran /Bimbingan dan Tugas Tertentu
		<table WIDTH="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:13px;">Pembelajaran /Bimbingan dan Tugas Tertentu</td>
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
    <td colspan="4" style="padding-left:15px;">c. Pengembangan Keprofesian Berkelanjutan
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:13px;">Pengembangan Diri</td>
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
                <td width="*%" style="padding-left:13px;">Publikasi Ilmiah</td>
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
                <td width="*%" style="padding-left:13px;">Karya Inovatif</td>
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
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:15px;">JUMLAH UNSUR UTAMA</td>
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
    <td colspan="4" class="isi" style="padding-left:15px;">2. Unsur Penunjang</td>
</tr>
<tr valign="top">
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:15px;">Ijazah yang tidak sesuai</td>
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
                <td width="*%" style="padding-left:15px;">Pendukung Tugas Guru</td>
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
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%"style="padding-left:15px;" >JUMLAH UNSUR PENUNJANG</td>
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
    <td colspan="4" style="padding-left:15px;">
		<table width="100%" border="0">
            <tr>
                <td width="*%" style="padding-left:15px;"><b>Total Angka Kredit</b></td>
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
