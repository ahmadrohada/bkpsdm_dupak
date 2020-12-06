// ============== DATEPICKER FUNCTION ====================//
$(document).ready(function () {// TAB PENGISIAN DUPAK BARU //	$( "#tab_new_dupak" ).tabs({      beforeLoad: function( event, ui ) {        ui.jqXHR.fail(function() {          ui.panel.html("Sedang memuat data......,");		  //$("#load_tab").show();		          });      }    });	//CSS TAB	$( "#tab_new_dupak" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );	$( "#tab_new_dupak li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );				//efek show	$( "#tab_new_dupak" ).tabs({show: { effect: "fadeIn", duration: 560 }	});	//efek exit	//$( "#tab_new_dupak" ).tabs({	//hide: { effect: "fadeOut", duration: 100 }	//});		// TAB VERIFIKASI DUPAK //	$( "#tab_verifikasi_dupak" ).tabs({      beforeLoad: function( event, ui ) {        ui.jqXHR.fail(function() {          ui.panel.html("Sedang memuat data......,");		  //$("#load_tab").show();		          });      }    });	//CSS TAB	$( "#tab_verifikasi_dupak" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );	$( "#tab_verifikasi_dupak li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );				//efek show	$( "#tab_verifikasi_dupak" ).tabs({show: { effect: "fadeIn", duration: 520 }});// TAB ACC DUPAK //	$( "#tab_acc_dupak" ).tabs({      beforeLoad: function( event, ui ) {        ui.jqXHR.fail(function() {          ui.panel.html("Sedang memuat data......,");		  //$("#load_tab").show();		          });      }    });	//CSS TAB	$( "#tab_acc_dupak" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );	$( "#tab_acc_dupak li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );				//efek show	$( "#tab_acc_dupak" ).tabs({show: { effect: "fadeIn", duration: 520 }});			// TAB DETAIL DUPAK BARU //	$( "#tab_detail_dupak" ).tabs({      beforeLoad: function( event, ui ) {        ui.jqXHR.fail(function() {          ui.panel.html("Sedang memuat data......,");		  //$("#load_tab").show();		          });      }    });	//CSS TAB	$( "#tab_detail_dupak" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );	$( "#tab_detail_dupak li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );				//efek show	$( "#tab_detail_dupak" ).tabs({show: { effect: "fadeIn", duration: 900 }	});// TAB PENGISIAN TAMBAH PENGGUNA //	$( "#tab_new_pengguna" ).tabs({      beforeLoad: function( event, ui ) {        ui.jqXHR.fail(function() {          ui.panel.html("Sedang memuat data......,");		  //$("#load_tab").show();		          });      }    });	//CSS TAB	$( "#tab_new_pengguna" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );	$( "#tab_new_pengguna li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );				//efek show	$( "#tab_new_pengguna" ).tabs({show: { effect: "fadeIn", duration: 720 }	});	// TAB DETAIL PENGGUNA //	$( "#tab_detail_pengguna" ).tabs({      beforeLoad: function( event, ui ) {        ui.jqXHR.fail(function() {          ui.panel.html("Sedang memuat data......,");		  //$("#load_tab").show();		          });      }    });	//CSS TAB	$( "#tab_detail_pengguna" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );	$( "#tab_detail_pengguna li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );				//efek show	$( "#tab_detail_pengguna" ).tabs({show: { effect: "fadeIn", duration: 720 }	});	
$('#tgl_pakx').datepicker( {
		changeYear: true,
		changeMonth: true,
		yearRange:'-15:+1',
        dateFormat: 'dd-mm-yy',
    });   
$('#tgl_lahir').datepicker( {		changeYear: true,		changeMonth: true,		yearRange:'-70:-20',        dateFormat: 'yy-mm-dd',    }); 
	
				
$('#tgl_mulaix').datepicker( {
        changeYear: true,
		changeMonth: true,
		yearRange:'-15:+1',
        dateFormat: 'dd-mm-yy',
    });   
	
$('#tgl_dupak_baru').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-5:+0',        dateFormat: 'dd-mm-yy',});
 	$('#tgl_mulai_dupak').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-5:+0',        dateFormat: 'dd-mm-yy',});	$('#tgl_sampai_dupak').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+1',        dateFormat: 'dd-mm-yy',});
$('#tgl_mulai_diklat').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#tgl_selesai_diklat').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#tgl_sertifikat').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#edit_tgl_mulai_diklat').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#edit_tgl_selesai_diklat').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#edit_tgl_sertifikat').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#tgl_kegiatan_kolektif').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});$('#edit_tgl_kegiatan_kolektif').datepicker( {        changeYear: true,		changeMonth: true,		yearRange:'-1:+0',        dateFormat: 'dd-mm-yy',});
$('#tmt_jafungxx').datepicker( {
		changeYear: true,
		changeMonth: true,
		yearRange:'-15:+1',
        dateFormat: 'dd-mm-yy',

    });  
	

	
$('#tmt_golx').datepicker( {
		changeYear: true,
		changeMonth: true,
		yearRange:'-15:+1',
        dateFormat: 'dd-mm-yy',

    });  
	$('#d_tmt_gol').datepicker( {		changeYear: true,		changeMonth: true,		yearRange:'-15:+1',        dateFormat: 'dd-mm-yy',    });  
	


// BUTTON 


   $("button.simpan").button({
      icons: {primary: "ui-icon-disk"},
      font:"78%",
  });  
	$("button.kembali").button({      icons: {primary: "ui-icon-arrowreturnthick-1-w"},      font:"78%",	});
	
    $("button.cetak").button({
      icons: {primary: "ui-icon-print"},
      font:"78%",
     
  });
  
    $("button.search").button({
      icons: {primary: "ui-icon-search"},
      font:"78%",
     
  });
  
  $("button.refresh").button({
      icons: {primary: "ui-icon-refresh"},
      font:"78%",
  });    $("button.kirim").button({      icons: {primary: "ui-icon-transferthick-e-w"},      font:"78%",  });
  
    $("button.ralat").button({
      icons: {primary: "ui-icon-pencil"},
      font:"78%",
  });
  
     $("button.close").button({
      icons: {primary: "ui-icon-close"},
      font:"78%",
     
  });
  
      $( "button.tambah" ).button({
      icons: {primary: "ui-icon-plus"},
      font:"78%",
  });
  
   $("button.batal").button({
      icons: {primary: "ui-icon-arrowreturnthick-1-s"},
      font:"78%",
     
  });
  
  $("button.buka").button({
      icons: {primary: "ui-icon-arrowreturnthick-2-s"},
      font:"78%",
     
  });
  $("button.terima").button({      icons: {primary: "ui-icon-check"},      font:"78%",  });    $("button.tolak").button({      icons: {primary: "ui-icon-closethick"},      font:"78%",  });  $("button.lanjut").button({      icons: {primary: " ui-icon-arrowthickstop-1-s"},      font:"78%",  });     $("button.pensil").button({      icons: {primary: "ui-icon-pencil"},      font:"78%",  });
         $("button.proses").button({      icons: {primary: "ui-icon-document-b"},      font:"78%",  });  
  // KLIK select TEXT
  
	$("#tmt_gol").click(function(){
		$("#tmt_gol").focus().select();
	});
	
	$("#tmt_jafung").click(function(){
		$("#tmt_jafung").focus().select();
	});
	
	$("#tgl_pak").click(function(){
		$("#tgl_pak").focus().select();
	});
	
	$("#tgl_mulai").click(function(){
		$("#tgl_mulai").focus().select();
	});
	
	$("#tgl_sampai").click(function(){
		$("#tgl_sampai").focus().select();
	});
	
  
	$("#sekolah").click(function(){
		$("#sekolah").focus().select();
	});
	
	$("#jurusan").click(function(){
		$("#jurusan").focus().select();
	});
  	
	$("#th_lulus").click(function(){
		$("#th_lulus").focus().select();
	});
  
  // FORM AK VALUE INPASS
	$("#pbm_lama").click(function(){
		$("#pbm_lama").focus().select();
	});
	
	$("#pp_lama").click(function(){
		$("#pp_lama").focus().select();
	});
  
	$("#penunjang_lama").click(function(){
		$("#penunjang_lama").focus().select();
	});
  
	$("#pbm_baru").click(function(){
		$("#pbm_baru").focus().select();
	});
	
	$("#pp_baru").click(function(){
		$("#pp_baru").focus().select();
	});
  
	$("#penunjang_baru").click(function(){
		$("#penunjang_baru").focus().select();
	});
	// PAK 
	$("#pend_lama").click(function(){
		$("#pend_lama").focus().select();
	});
  
	$("#diklat_lama").click(function(){
		$("#diklat_lama").focus().select();
	});
	
	$("#pbt_lama").click(function(){
		$("#pbt_lama").focus().select();
	});

	$("#pd_lama").click(function(){
		$("#pd_lama").focus().select();
	});
	
	$("#pi_lama").click(function(){
		$("#pi_lama").focus().select();
	});
	
	$("#ki_lama").click(function(){
		$("#ki_lama").focus().select();
	});
	
	$("#sttb_tdksesuai_lama").click(function(){
		$("#sttb_tdksesuai_lama").focus().select();
	});
	
	$("#dukung_tugas_lama").click(function(){
		$("#dukung_tugas_lama").focus().select();
	});
	
	$("#pend_baru").click(function(){
		$("#pend_baru").focus().select();
	});
  
	$("#diklat_baru").click(function(){
		$("#diklat_baru").focus().select();
	});
	
	$("#pbt_baru").click(function(){
		$("#pbt_baru").focus().select();
	});

	$("#pd_baru").click(function(){
		$("#pd_baru").focus().select();
	});
	
	$("#pi_baru").click(function(){
		$("#pi_baru").focus().select();
	});
	
	$("#ki_baru").click(function(){
		$("#ki_baru").focus().select();
	});
	
	$("#sttb_tdksesuai_baru").click(function(){
		$("#sttb_tdksesuai_baru").focus().select();
	});
	
	$("#dukung_tugas_baru").click(function(){
		$("#dukung_tugas_baru").focus().select();
	});
	
	$("#glr_dpn").click(function(){
		$("#glr_dpn").focus().select();
	});
	
	$("#glr_blk").click(function(){
		$("#glr_blk").focus().select();
	});
	$('#capaian_makalah').click(function (){		makalah	= $(this).is(':checked');		if ( makalah == true ) {		$("#kesimpulan_makalah").val("Terpenuhi");		} else if ( makalah == false ){		$("#kesimpulan_makalah").val("Belum Terpenuhi");		}	});
		$('#capaian_artikel').click(function (){		makalah	= $(this).is(':checked');		if ( makalah == true ) {		$("#kesimpulan_artikel").val("Terpenuhi");		} else if ( makalah == false ){		$("#kesimpulan_artikel").val("Belum Terpenuhi");		}	});		$('#capaian_buku').click(function (){		makalah	= $(this).is(':checked');		if ( makalah == true ) {		$("#kesimpulan_buku").val("Terpenuhi");		} else if ( makalah == false ){		$("#kesimpulan_buku").val("Belum Terpenuhi");		}	});
	
	
}); 
  
  
  



  
  // AUTO komplit sekolah
function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#sekolah').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: './kelas/auto_complete_refresh.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#sekolah_list_id').show();
				$('#sekolah_list_id').html(data);
				
		
				
			}
		});
	} else {
		$('#sekolah_list_id').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#sekolah').val(item);
	// hide proposition list
	$('#sekolah_list_id').hide();
	
			
					//jika Sekolah change
				
		
				$.ajax({
						url:"./kelas/proses.php",
                        data:"op=ambildata_skpd&sekolah="+item,
                        cache:false,
						
                        success:function(msg){
							$("#kd_skpd").val(msg);
							//alert(msg);
							
                        }
                })	
				
				
				
				
}
  











//  VALIDASI ANGKA
//Hanya boleh Diisi dengan huruf
function huruf(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if ((charCode < 65) || (charCode == 32))
            return false;        
         return true;
      }

function pass(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 48) || ( (charCode >57) & (charCode < 65)) || ( (charCode >90) & (charCode < 97)) || (charCode > 122) )
            return false;        
         return true;
      }function username(evt) {        var charCode = (evt.which) ? evt.which : event.keyCode        if ((charCode < 48) || ( (charCode >57) & (charCode < 65)) || ( (charCode >90) & (charCode < 97)) || (charCode > 122) )            return false;                 return true;      }	  	  //Hanya boleh Diisi dengan Dengan Angkafunction angka(evt) {         var charCode = (evt.which) ? evt.which : event.keyCode         if ((charCode > 65) || (charCode == 44))            return false;                 return true;      }
	  // Drop down menu setting ///**$(document).ready(function () {    $(".showhide-account").click(function () {        $(".account-content").slideToggle("fast");        $(this).toggleClass("active");        return false;    });});$(document).ready(function () {    $(".action-slider").click(function () {        $("#actions-box-slider").slideToggle("fast");        $(this).toggleClass("activated");        return false;    });});**///Error message //$(document).ready(function() {	$(".close-yellow").click(function () {		$("#message-yellow").fadeOut("slow");	});	$(".close-red").click(function () {		$("#message-red").fadeOut("slow");	});	$(".close-blue").click(function () {		$("#message-blue").fadeOut("slow");	});	$(".close-green").click(function () {		$("#message-green").fadeOut("slow");	});});// END ----------------------------- 3  
	