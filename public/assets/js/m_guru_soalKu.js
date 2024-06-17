import {hiddenShowTabel, countHalaman, halamanAcive, navHalaman_click} from './modules/functions.js';

const formModal = document.getElementById('form-modal');
const allBtnAction = document.querySelectorAll('[form-action]');
const dataTabel = document.querySelectorAll('.data-soal');
const navigasiHalaman = document.getElementById('navigation-pages');
const banyakBaris = document.getElementById('banyakBaris');
const tambahGambar = document.getElementById('tambah-gambar');
const cekSoal = document.getElementById('cekSoal');

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
			let img = document.querySelector('#modal-cek img');
			let textSoal = img.previousElementSibling;
			img.classList.remove('d-none');
			textSoal.classList.add('d-none');
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
			let nama_gambar = document.querySelector(`[name=nama-${el.getAttribute('name')}]`);
			if(el.files.length > 0){
				if(!setelah.hasAttribute('cek-img')){
					let cek = document.createElement("button");
					cek.setAttribute('cek-img', '');
					cek.setAttribute('data-bs-toggle', 'modal');
					cek.setAttribute('data-bs-target', '#modal-cek');
					cek.setAttribute('type', 'button');
					cek.setAttribute('class', 'btn btn-outline-secondary')
					cek.innerHTML = "CEK";
					el.parentElement.insertBefore(cek, setelah);
				}
				nama_gambar.removeAttribute('disabled');
				nama_gambar.select();
			}else{
				nama_gambar.setAttribute('disabled');
				if(setelah.hasAttribute('cek-img')){
					setelah.remove();
				}
			}
		}
		el = el.parentElement;
	}
})
cekSoal.addEventListener('click', ()=>{
	let img = document.querySelector('#modal-cek img');
	let cekSoal = img.previousElementSibling;
	img.classList.add('d-none');
	cekSoal.classList.remove('d-none');
	let textSoal = document.querySelector("textarea[name=soal]").value;
	cekSoal.innerHTML = textSoal;
})
tambahGambar.addEventListener('click', ()=>{
	let gambar = document.getElementById('gambar');
	let i = gambar.children.length + 1;
	let div = document.createElement('div');
	div.setAttribute('class', 'input-group mb-3');
	div.innerHTML = `
		<div class='form-floating'>
			<input type='text' name='nama-file-${i}' class='form-control' disabled required value='Nama Gambar'>
			<label>Upload Gambar</label>
		</div>
		<input type='file' accept='image/*' name='file-${i}' id='gambar-${i}' required class='d-none' input-gambar>
		<label for='gambar-${i}' class='input-group-text'>Upload</label>
		<button type='button' class='btn btn-outline-danger' delete-gambar>X</button>`;
	gambar.appendChild(div);
})



banyakBaris.addEventListener('input', (e)=>{
	countHalaman(dataTabel, navigasiHalaman, banyakBaris.value);
	halamanAcive(navigasiHalaman, 1);
	hiddenShowTabel(dataTabel, navigasiHalaman, banyakBaris.value);
});
navHalaman_click(dataTabel, navigasiHalaman, banyakBaris.value)
countHalaman(dataTabel, navigasiHalaman, banyakBaris.value);
halamanAcive(navigasiHalaman, 1);
hiddenShowTabel(dataTabel, navigasiHalaman, banyakBaris.value);