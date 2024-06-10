import {ajax, btnIconToggle} from './modules/functions.js';

const identitas = document.getElementById('identitas');
const inputIdentitas = identitas.children[1];
const heightInputIdentitas = inputIdentitas.offsetHeight;
inputIdentitas.style.height = heightInputIdentitas+"px";
const btnUpDown = document.getElementById('upDown');
const inputNama = document.querySelector('[name=nama]');
const inputEmail = document.querySelector('[name=email]');
const inputNoWa = document.querySelector('[name=noWa]');
const inputToken = document.querySelector('[name=token]');
// const inputSekolah = document.querySelector('[name=sekolah]');
const inputPass = document.querySelector('[name=pass]');
const btnCari = document.getElementById('btn-cari');
const btnPass = document.getElementById('eye-password');
const tugas = document.getElementById('tugas');
cekIdentitas('nama');
cekIdentitas('email');
cekIdentitas('noWa');
cekIdentitas('token');
// cekIdentitas('sekolah');
cekIdentitas('pass');
cekButtonCari();


btnUpDown.addEventListener('click', ()=>{
	inputIdentitas.style.height = inputIdentitas.offsetHeight > 0 ? '0px' : (heightInputIdentitas+'px');
	btnIconToggle(btnUpDown);
})
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

function cekIdentitas (key) {
	let input = document.querySelector('[name='+key+']');
	input.value = localStorage.getItem('kumpuTugasII_'+key) || '';
	input.addEventListener('input', ()=>{
		localStorage.setItem('kumpuTugasII_'+key, input.value);
		cekButtonCari();
	})
}
function cekButtonCari () {
	if(inputNama.value !== '' && 
	   inputEmail.value !== '' && 
	   // inputSekolah.value !== '' && 
	   inputToken.value !== '' && 
	   inputNoWa.value !== '' && 
	   inputPass.value !== '')
	{
		btnCari.removeAttribute('disabled');
	}else {
		btnCari.setAttribute('disabled', '');
	}
}