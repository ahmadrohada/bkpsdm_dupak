
<script>
$(document).ready(function () {
	
$(window).load(function() {
     $('.preloader').delay(350).fadeOut('slow');
});

$('a').click(function(e){
     e.preventDefault();
     t = $(this).attr('href');
     $('.preloader').delay(350).fadeIn('slow',function(){
          window.location.href = t;
     });
});

});
</script>
<style>
	.preloader {
        background: #fff;
        bottom: 90px;
        left: 0;
        position: fixed;
        right: 0;
        top:130px;
        z-index: 9999;
    }
</style>

<div class="preloader"></div>