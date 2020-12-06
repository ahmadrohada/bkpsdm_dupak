<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./home.php?page=data_guru";</script><?php exit(); }  ?>

<style>

.hover figure img {
	cursor:pointer;
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
}
.hover figure:hover img {
	-webkit-transform: scale(1.2);
	transform: scale(1.2);
}

.pilihan{
	position:absolute;
	margin-top:-80px;
	margin-left:-50px;
}

</style>

<script>
$(document).ready(function () {
	$("#pilihan").val("");
	$("#pilih_puas").html('<img src="images/forms/00.png" />');
	$("#pilih_kurang_puas").html('<img src="images/forms/00.png" />');
	
	
	
	$("#puas").click(function(){
		$("#pilih_puas").html('<img src="images/forms/check.png" />');
		$("#pilih_kurang_puas").html('<img src="images/forms/00.png" />');
		$("#pilihan").val("puas");
		$("#usulan").focus();
	});





	$("#kurang_puas").click(function(){
		$("#pilih_kurang_puas").html('<img src="images/forms/check.png" />');
		$("#pilih_puas").html('<img src="images/forms/00.png" />');
		$("#pilihan").val("kurang_puas");
		$("#usulan").focus();
	});


	
	$("#submit_polling").click(function(){
		pilihan		    = $("#pilihan").val();
		usulan			= $("#usulan").val();
		id_user			= $("#id_user").val();
		
		
		if (pilihan == ""){
			alert(" anda belum memilih ");
		}else{
			
			$.ajax({
			url:"./kelas/proses.php",
			data:"op=polling&id_user="+id_user+"&pilihan="+pilihan+"&usulan="+usulan,
			cache:false,
            success:function(msg){
				if ( msg != 1){
					alert(msg);
				}else{
					window.location.assign("?page=home");	
				}
				
			
				}
			})
			
			
			
			
			
		}
		
		
		
		
	});



});
</script>

<?php
	$id_peg = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';


?>

			
        <div id="message-yellow" style="margin-top:-20px;">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="yellow-left">Kami melakukan polling kepuasan Anda terhadap aplikasi sipulpenpakguru. Mohon berikan komentar anda terhadap aplikasi yang sedang kami kembangkan ini<a href=""></a></td>
                <td class="yellow-right"><a class=""><img src="images/table/icon_close_yellow.gif"   alt="" /></a></td>
            </tr>
            </table>
        </div>
           
        <div class="detail_guru" >
 	    <table border="0" width="100%" cellpadding="0" cellspacing="0">
			 <tr valign="top">
				<td colspan="4" height="10px;">
					
				</td>
            </tr>
            <tr valign="top">
				<td width="30%" rowspan="4">
					
				</td>
				<td  width="20%" align="center">
					<div class="hover">
					<div>
						<figure><img id="puas" src="images/forms/bagus.png" /></figure>
					</div>
					</div>
				</td>
				<td  width="20%" align="center">
					<div class="hover">
					<div>
						<figure><img id="kurang_puas" src="images/forms/jelek.png" /></figure>
					</div>
					</div>
				</td>
				<td width="30%" rowspan="4">
					
				</td>
            </tr>
			<tr height="30px">
				<td  width="20%" align="center">
					<span id="pilih_puas" class="pilihan" ></span>
				</td>
				<td  width="20%" align="center">
					<span id="pilih_kurang_puas" class="pilihan" ></span>
				</td>
            </tr>
			<tr>
				<td colspan="2">
					Komentar / usulan<br>
					<textarea style="width:465px; height:30px; padding:0px 0 5px 5px; resize: none; " id="usulan" ></textarea>
				</td>
            </tr>
			<tr  height="40px">
				<td colspan="2" align="right">
					<input type="hidden" id="pilihan" >
					<input type="hidden" id="id_user" value="<?php echo $id_peg ?>" >
					<button class="ui-state-default simpan" id="submit_polling" >SUBMIT</button>
				</td>
            </tr>
        </table>
		</div>