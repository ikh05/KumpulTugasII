import {cekGambar, ajax} from './modules/functions.js';


const modal_nilai = document.getElementById('beriNilai');
const ket = modal_nilai.querySelector('[name=ket]');
const nilai = modal_nilai.querySelector('[name=nilai]');
const status = modal_nilai.querySelector('[name=status]');
const btnKirim = modal_nilai.querySelector('[type=submit]');

status.addEventListener('input', ()=>{
	if(status.value === 'dinilai'){
		nilai.setAttribute('required','');
		ket.removeAttribute('required');
	}else{
		ket.setAttribute('required','');
		nilai.removeAttribute('required');
	}
});

modal_nilai.addEventListener('show.bs.modal', ev => {
	ajax(ev.relatedTarget, function (res,btn) {
		modal_nilai.querySelector('.modal-title').textContent = res['siswa']['nama'];
		modal_nilai.querySelector('[name=id]').value = btn.getAttribute('id-jawab');
	});
})



















cekGambar();