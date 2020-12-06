<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>


<script>
$(document).ready(function () {
	
	
	
	group	= $("#group").val();
	
	if ( group >= 1 ) 
		{ 
			$( "#tab_detail_pengguna" ).tabs( "enable", 0 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 1 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 2 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 3 );
		}
		
	if ( group >= 2 ) 
		{
			$( "#tab_detail_pengguna" ).tabs( "disable", 0 );
			$( "#tab_detail_pengguna" ).tabs( "enable", 1 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 2 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 3 );
		}
	if ( group >= 3 )
		{
			$( "#tab_detail_pengguna" ).tabs( "disable", 0 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 1 );
			$( "#tab_detail_pengguna" ).tabs( "enable", 2 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 3 );
		}
	if ( group >= 4 )
		{
			$( "#tab_detail_pengguna" ).tabs( "disable", 0 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 1 );
			$( "#tab_detail_pengguna" ).tabs( "disable", 2 );
			$( "#tab_detail_pengguna" ).tabs( "enable", 3 );
		}
	
	if ( group == 1 ) $( "#tab_detail_pengguna" ).tabs( "option", "active", 0 );
	if ( group == 2 ) $( "#tab_detail_pengguna" ).tabs( "option", "active", 1 );
	if ( group == 3 ) $( "#tab_detail_pengguna" ).tabs( "option", "active", 2 );
	if ( group == 4 ) $( "#tab_detail_pengguna" ).tabs( "option", "active", 3 );

	
	
	

});
</script>

<?php
Connect::getConnection();
$id	= isset($_GET['id']) ? $_GET['id'] : '';

$query = mysql_fetch_object(mysql_query("SELECT * FROM dt_dupak_pengguna WHERE id='$id' "));


?>
<input type="hidden" value="<?php echo $query->group; ?> " id="group">

<div id="tab_detail_pengguna">
	
	
  <ul>
	<!-- TAB 0 -->
    <li>
		<a href="files_admin/tab_detail_pengguna.php?level=1&id=<?php echo $id;?>">
		<img src="images/forms/admin.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">ADMINISTRATOR</p>
		</a>
	</li>
	<!-- TAB 1 -->
    <li>
		<a href="files_admin/tab_detail_pengguna.php?level=2&id=<?php echo $id;?>">
		<img src="images/forms/sekretariat.png" width="63px" height="63px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">SEKRETARIAT</p>
		</a>
	</li>
	
	<!-- TAB 2 -->
    <li>
		<a href="files_admin/tab_detail_pengguna.php?level=3&id=<?php echo $id;?>">
		<img src="images/forms/penilai.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">TIM PENILAI</p>
		</a>
	</li>
	<!-- TAB 3 -->
    <li>
		<a href="files_admin/tab_detail_pengguna.php?level=4&id=<?php echo $id;?>">
		<img src="images/forms/data_entry.png" width="60px" height="60px" class="icon_menu">
		<p style="margin:-40px 0 0 80px;">PETUGAS SEKOLAH</p>
		</a>
	</li>
	
  </ul>
 
</div>
   
    
	
	
	
	
	
</div>



