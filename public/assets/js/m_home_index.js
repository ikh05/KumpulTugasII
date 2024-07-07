import {cekGambar, btnIconToggle, setInput_localtorage} from './modules/functions.js';

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
cekIdentitas('tokenKelas');
cekIdentitas('password', function (input){
	console.log(input);
	if(input.value.length > 20) input.classList.add('is-invalid');
	else input.classList.remove('is-invalid');
});


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
	setInput_localtorage(key, function(){
		let _1 = document.getElementById('input-nama');
		let _2 = document.getElementById('input-email');
		let _3 = document.getElementById('input-noWa');
		let _4 = document.getElementById('input-token');
		let _5 = document.getElementById('input-password');
		let b = document.getElementById('btn-cari');
		if(_1.value !== '' && 
		   _2.value !== '' && 
		   _4.value !== '' && 
		   _3.value !== '' && 
		   _5.value !== '' &&
		   _5.value.length <= 20)
		{
			b.removeAttribute('disabled');
		}else {
			b.setAttribute('disabled', '');
		}
	});
}
cekGambar();
