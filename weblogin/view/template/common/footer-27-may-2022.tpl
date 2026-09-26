<footer id="footer"><b>Copyright <?php echo date('Y'); ?> romishome.com	Designed & Developed by <a href="https://www.shirsendu.com" title="shirsendu &amp; team" target="_blank"><img src="boarding.romishome.com/sdlogo_b.png"></a></b></footer></div>
<script>
$("#main-nav li:has(ul)").click(function(e){
// $(this).siblings().children("a").collapse("hide");
  $(this).siblings().children("div").collapse("hide");  
  //e.stopPropagation();
}); 

//$(".nav-item123").click(function(){
 // $(this).children(".nav-link").attr("aria-expanded","true");
//}); 
$("#button-menu").click(function(){
	$("body").toggleClass("slIde");
  });
</script>
</body></html>