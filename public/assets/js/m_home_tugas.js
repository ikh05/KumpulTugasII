import {ajax, cekGambar} from './modules/functions.js';
const modalJawab = document.getElementById('jawabTugas');
document.addEventListener('click', ev =>{
	let el = ev.target;
	while (el !== document.querySelector('body') && el!==null) {
		if(el.hasAttribute('href-ajax')){
			// console.log(el.getAttribute('status-tugas'));
			ajax(el, (res, e)=>{
				if(modalJawab.getAttribute('active-id') != res['tugas']['id']){
					modalJawab.querySelector('.modal-title').classList.remove('text-bg-secondary');
					modalJawab.querySelector('.modal-title').textContent = res['tugas']['nama'];
					modalJawab.setAttribute('active-id', res['tugas']['id'])
					modalJawab.querySelector('.modal-form').innerHTML = '';
					modalJawab.querySelector('[name=idTugas]').value = res['tugas']['id'];
					modalJawab.querySelector('[name=status-tugas]').value = e.getAttribute('status-tugas');
					modalJawab.querySelector('.modal-form').innerHTML = `
						<div class='input-group mb-3'>
							<input type='file' accept='image/*' name='file-1' id='gambar-1' required class='form-control'>
							<!--- <button type='button' class='btn btn-outline-primary' cek-img>Review</button> --->
							<button type='button' class='btn btn-outline-danger' delete-gambar>X</button>
						</div>`;
					if(e.getAttribute('status-tugas') == 'bkerja'){
						modalJawab.querySelector('.modal-title').classList.add('text-bg-secondary');
						modalJawab.querySelector('[name=ket]').setAttribute('type', 'hidden');
						modalJawab.querySelector('[name=ket]').removeAttribute('required');
					}else if(e.getAttribute('status-tugas') == 'terlambat'){
						modalJawab.querySelector('[name=ket]').setAttribute('type', 'text');
						modalJawab.querySelector('[name=ket]').setAttribute('required', '');
					}
				}
			})
		}
		if(el.id === 'tambah-gambar'){
			let gambar = document.getElementById('gambar');
			let i = gambar.children.length + 1;
			let div = document.createElement('div');
			div.setAttribute('class', 'input-group mb-3');
			div.innerHTML = `
					<input type='file' accept='image/*' name='file-${i}' id='gambar-${i}' required class='form-control'>
					<!--- <button type='button' class='btn btn-outline-primary' cek-img>Review</button> --->
					<button type='button' class='btn btn-outline-danger' delete-gambar>X</button>`
			gambar.appendChild(div);
		}
		if(el.hasAttribute('delete-gambar')){
			el.parentElement.remove();
			let count = modalJawab.querySelector('#gambar').children.length;
			if(count){
				modalJawab.querySelector('[type=submit]').classList.remove('disabled');
			}else{
				modalJawab.querySelector('[type=submit]').classList.add('disabled');			
			}
		}
		if(el === modalJawab){
			let count = modalJawab.querySelector('#gambar').children.length;
			let checked = modalJawab.querySelector('#pastikan').checked;
			if(count && checked){
				modalJawab.querySelector('[type=submit]').classList.remove('disabled');
			}else{
				modalJawab.querySelector('[type=submit]').classList.add('disabled');			
			}
		}
		el = el.parentElement;
	}
})
cekGambar()