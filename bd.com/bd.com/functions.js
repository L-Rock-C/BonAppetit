function Check_Pass(){
	pass1 = document.getElementsByName('password')[0]
	pass2 = document.getElementsByName('password_2')[0]

	if(pass1.value != pass2.value){
		alert("As senhas tem que estar de acordo")
		pass1.value = ""
		pass2.value = ""
	}
}