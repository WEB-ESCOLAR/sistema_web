$(document).ready(function(){
	console.log("js ready");
	$('.bar').on('click', function(){
	  $('.contenido').toggleClass('open');
	})


	$('#home').on('click',function(e){
		console.log("show home window");
		e.preventDefault();
		$('·screen_swap').reload("screens/alumnos.php")
	})

	$('#alumnos').on('click',function(e){
		console.log("show home window");
		e.preventDefault();
		// window.location.replace('screens/home.php');
	})



})