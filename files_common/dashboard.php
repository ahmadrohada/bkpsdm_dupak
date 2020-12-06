<?php if(!isset($_SERVER['HTTP_REFERER'])) { ?><script type="text/javascript">document.location  = "./index.php";</script><?php exit(); }  ?>


<?php 
	Connect::getConnection();
	$id_peg = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
	//echo $id_peg;
	//Nama user
	$s = mysql_fetch_object(mysql_query("SELECT nama_pengguna,jk FROM dt_dupak_pengguna WHERE id='$id_peg' "));
		$nama_user = ucwords(strtolower($s->nama_pengguna));
		
		if ( $s->jk == "1" ) $panggilan = "Bapak";
		if ( $s->jk == "2" ) $panggilan = "Ibu";
?>


<div id="page-heading">

	
  
</div>
<!-- end page-heading -->


    		
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">
				 <i>Assalamu'alaikum &nbsp;</i> <?php echo $panggilan." ".$nama_user; ?> 
				 <img src="images/forms/smile.png" style="position:absolute; margin-top:-5px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Selamat Datang di .:: SISTEM INFORMASI PENGUSULAN PENILAIAN DAN PENETAPAN ANGKA KREDIT GURU  ::. </td>
                <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
          
			<!--  start message-yellow -->
            <!--
            <div id="message-yellow">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="yellow-left">You have a new message. <a href="">Go to Inbox.</a></td>
                <td class="yellow-right"><a class="close-yellow"><img src="images/table/icon_close_yellow.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            -->
            <!--  end message-yellow -->
            
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                <div id="table-content">
                <p align="center"><img src="images/guru.jpg" alt="sipulpenpakguru"></p>
				
				
                </div>
              
              </td>
              <td>
              	<!--  start related-activities -->
                <?php include "pengumuman.php";?>  
                <!-- end related-activities -->
              </td>
            </tr>
            <tr>
              <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
              <td></td>
            </tr>
          </table>

      

	<div class="clear"></div>
     
    