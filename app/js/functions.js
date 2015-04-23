
function validateRegister(){
	var name = $("#name").val();
	var email = $("#email").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var password_b = $("#password_b").val();

	var formFieldsFull = false;
	formFieldsFull = name != "" && email != "" && username != "" && password != "" && password_b != "";
	if(formFieldsFull){
		if(password == password_b){
			return true;
		}
		else{
			alert("Las contraseñas no coinciden.");
			return false;
		}
	}
	else{
		alert("Llena todos los campos para continuar.");
		return false;
	}
}

function validateUpload(){
	var file = $("input[name='file']").val();
	if(file != ""){
		return true;
	}
	alert("Selecciona un archivo.");
	return false;
}