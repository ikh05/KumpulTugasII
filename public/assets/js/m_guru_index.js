import {setInput_localtorage, toggleClass} from './modules/functions.js';


setInput_localtorage('m-username');
setInput_localtorage('m-password');
setInput_localtorage('d-username');
setInput_localtorage('d-nama');
setInput_localtorage('d-email');
setInput_localtorage('d-wa');
setInput_localtorage('d-password');
setInput_localtorage('d-konf-password');

const d_eye = document.getElementById('d-eye');
const m_eye = document.getElementById('m-eye');
const m_pass = document.querySelector('[name=m-password]');
const d_pass = document.querySelector('[name=d-password]');
const d_konf_pass = document.querySelector('[name=d-konf-password]');

m_eye.addEventListener('click', ()=>{
	m_pass.setAttribute('type', m_pass.getAttribute('type')==='text' ? 'password' : 'text');
	toggleClass(m_eye.children[0], 'd-none');
	toggleClass(m_eye.children[1], 'd-none');
});
d_eye.addEventListener('click', ()=>{
	d_pass.setAttribute('type', d_pass.getAttribute('type')==='text' ? 'password' : 'text');
	d_konf_pass.setAttribute('type', d_konf_pass.getAttribute('type')==='text' ? 'password' : 'text');
	toggleClass(d_eye.children[0], 'd-none');
	toggleClass(d_eye.children[1], 'd-none');
});

d_pass.addEventListener('input', ()=>{
	cek_konfPass(d_pass, d_konf_pass);
})
d_konf_pass.addEventListener('input', ()=>{
	cek_konfPass(d_pass, d_konf_pass);
});
function cek_konfPass(p, k) {
	if(p.value !== k.value){
		p.parentElement.nextElementSibling.classList.remove('border-translucent')
		p.parentElement.nextElementSibling.classList.add('btn-outline-danger')
		p.parentElement.classList.add('is-invalid');
		p.classList.add('is-invalid');
		k.classList.add('is-invalid');
	}else{
		p.parentElement.nextElementSibling.classList.remove('btn-outline-danger')
		p.parentElement.nextElementSibling.classList.add('border-translucent')
		p.parentElement.classList.remove('is-invalid');
		p.classList.remove('is-invalid');
		k.classList.remove('is-invalid');
	}
}

document.addEventListener('DOMContentLoaded', ()=>{
	cek_konfPass(d_pass, d_konf_pass);
})