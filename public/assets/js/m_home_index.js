import {btnIconToggle} from './modules/functions.js';

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
	let input = document.querySelector('[name='+key+']');
	input.value = localStorage.getItem('kumpuTugasII_'+key) || '';
	if(typeof(f) === 'function') f(input);
	input.addEventListener('input', ()=>{
		localStorage.setItem('kumpuTugasII_'+key, input.value);
		if(typeof(f) === 'function') f(input);
		cekButtonCari();
	})
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