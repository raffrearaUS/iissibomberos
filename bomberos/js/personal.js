$(document).ready(function() {
	$("#personal").on("input", function() {
		$.get("gestionarUsuarios.php", {
			personal : $("#personal").val()
		}, function(data) {
			$("#rango").empty();
			$("#rango").append(data);
		});
	});
}); 