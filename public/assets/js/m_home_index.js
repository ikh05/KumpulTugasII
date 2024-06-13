import {btnIconToggle, setInput_localtorage} from './modules/functions.js';

const inputNama = document.getElementById('input-nama');
const inputEmail = document.getElementById('input-email');
const inputNoWa = document.getElementById('input-noWa');
const inputToken = document.getElementById('input-token');
const inputPass = document.getElementById('input-password');
const btnCari = document.getElementById('btn-cari');
const btnPass = document.getElementById('eye-password');
cekIdentitas('nama');
cekIdentitas('email');
cekIdentitas('noWa');
cekIdentitas('token');
cekIdentitas('pass', function (input){
	console.log(input);
	if(input.value.length > 20) input.classList.add('is-invalid');
	else input.classList.remove('is-invalid');
});
cekButtonCari();


btnPass.addEventListener('click', ()=>{
	if(inputPass.getAttribute('type') === 'password'){
		inputPass.setAttribute('type', 'text');
		inputToken.setAttribute('type', 'text');
	}else{
		inputPass.setAttribute('type', 'password');
		inputToken.setAttribute('type', 'password');
	}
	btnIconToggle(btnPass);
})

function cekIdentitas (key, f=null) {
	setInput_localtorage(key, f);
	cekButtonCari();
}
function cekButtonCari () {
	if(inputNama.value !== '' && 
	   inputEmail.value !== '' && 
	   inputToken.value !== '' && 
	   inputNoWa.value !== '' && 
	   inputPass.value !== '' &&
	   inputPass.value.length <= 20)
	{
		btnCari.removeAttribute('disabled');
	}else {
		btnCari.setAttribute('disabled', '');
	}
}