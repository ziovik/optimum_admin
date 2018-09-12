<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style_loading.css">

</head>
<body>

	<div class = "preload" id = "preload">
		<div class ="logo">
		<span style = "color: white; font-size:100px;">Дистрибьютор</span><br><br>
			Добро пожаловать <br> <span style = "color: darkturquoise;">Optimum beauty</span>
			
		</div>
		<div class = "loader-frame">
			<div class = "loader1" id = "loader1"></div>
			<div class = "loader2" id = "loader2"></div>
		</div>
	</div>

	<script >
	    (function(){
 
 var preload = document.getElementById("preload");
 var loading = 0;
 var id = setInterval(frame, 64);

 function frame(){
  if(loading == 20) {
   clearInterval(id);
   window.open("distributor/index.php", "_self");
  }
  else {
   loading = loading + 1;
   if(loading == 20) {
    preload.style.animation = "fadeout 1s ease";
   }
  }
 }


})();
	</script>
</body>
</html>