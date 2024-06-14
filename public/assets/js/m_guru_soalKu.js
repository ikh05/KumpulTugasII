import {hiddenShowTabel, countHalaman, halamanAcive} from './modules/functions.js';

const formModal = document.getElementById('form-modal');
const allBtnAction = document.querySelectorAll('[form-action]');
const dataTabel = document.querySelectorAll('.data-soal');
const navigasiHalaman = document.getElementById('navigation-pages');
const banyakBaris = document.getElementById('banyakBaris');
const tambahGambar = document.getElementById('tambah-gambar');

allBtnAction.forEach( (e)=>{
	e.addEventListener('click', (ev)=>{
		formModal.setAttribute('action', e.getAttribute('form-action'));
	})
});
document.addEventListener('click', (ev)=>{
	let el = ev.target;
	while (el !== document.querySelector('main')) {
		if(el.hasAttribute('delete-gambar')){
			el.parentElement.remove();
		}
		else if(el.hasAttribute('cek-img')){
			let img = document.querySelector('#modal-cek-gambar img')
			let fileInput = el.previousElementSibling;
		    let reader = new FileReader();
	        reader.onload = function(e) {
	          img.src = e.target.result;
	        }
		    reader.readAsDataURL(fileInput.files[0]);
		}
		el = el.parentElement;
	}
})
document.addEventListener('input', (ev)=>{
	let el = ev.target;
	while (el !== document.querySelector('main')) {
		if(el.hasAttribute('input-gambar')){
			let setelah = el.nextElementSibling;
			if(el.files.length > 0){
				if(!setelah.hasAttribute('cek-img')){
					let cek = document.createElement("button");
					cek.setAttribute('cek-img', '');
					cek.setAttribute('data-bs-toggle', 'modal');
					cek.setAttribute('data-bs-target', '#modal-cek-gambar');
					cek.innerHTML = "CEK";
					el.parentElement.insertBefore(cek, setelah);
				}
			}else{
				if(setelah.hasAttribute('cek-img')){
					setelah.remove();
				}
			}
		}
		el = el.parentElement;
	}
})
tambahGambar.addEventListener('click', ()=>{
	let gambar = document.getElementById('gambar');
	let i = gambar.children.length + 1;
	let div = document.createElement('div');
	div.setAttribute('class', 'input-group mb-3');
	div.innerHTML = `
		<div class='form-floating'>
			<input type='text' name='namaGambar-`+i+`' class='form-control' required value='nama-gambar'>
			<label>Upload Gambar</label>
		</div>
		<input type='file' accept='image/*' name='gambar-`+i+`' id='gambar-`+i+`' required class='d-none' input-gambar>
		<label for='gambar-`+i+`' class='input-group-text'>Upload</label>
		<button type='button' class='btn btn-outline-danger' delete-gambar>X</button>`;
	gambar.appendChild(div);
})
banyakBaris.addEventListener('input', (e)=>{
	countHalaman(dataTabel, navigasiHalaman, banyakBaris.value);
	halamanAcive(navigasiHalaman, 1);
	hiddenShowTabel(dataTabel, navigasiHalaman, banyakBaris.value);
});

navigasiHalaman.addEventListener('click', (ev)=>{
	let el = ev.target;
	while (el !== navigasiHalaman) {
		if(el.hasAttribute('value')){
			let allBtn = navigasiHalaman.querySelectorAll('a');
			let valueClick = el.getAttribute('value');
			if(valueClick === '-1' || valueClick === '+1'){
				let valueActive = parseInt(navigasiHalaman.querySelector('.active[value]').getAttribute('value'));
				if(valueClick === '-1' && valueActive !== 1) valueActive -= 1;
				if(valueClick === '+1' && valueActive !== (allBtn.length-2)) valueActive += 1;
				valueClick = valueActive.toString();
			}
			halamanAcive(navigasiHalaman, parseInt(valueClick));
			hiddenShowTabel(dataTabel, navigasiHalaman, banyakBaris.value);
		}
		el = el.parentElement;
	}
})


countHalaman(dataTabel, navigasiHalaman, banyakBaris.value);
halamanAcive(navigasiHalaman, 1);
hiddenShowTabel(dataTabel, navigasiHalaman, banyakBaris.value);