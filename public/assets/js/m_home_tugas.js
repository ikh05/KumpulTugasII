import {ajax, cekGambar, set_countdown} from './modules/functions.js';
const modalJawab = document.getElementById('jawabTugas');
document.addEventListener('click', ev =>{
	let el = ev.target;
	while (el !== document.querySelector('body') && el!==null) {
		if(el.hasAttribute('href-ajax')){
			// console.log(el.getAttribute('status-tugas'));
			modalJawab.querySelector('[name=status-tugas]').value = el.getAttribute('status-tugas');
			ajax(el, (res)=>{
				if(modalJawab.getAttribute('active-id') != res['tugas']['id']){
					modalJawab.querySelector('.modal-form').innerHTML = `
						<div class='input-group mb-3'>
							<input type='file' accept='image/*' name='file-1' id='gambar-1' required class='form-control'>
							<!--- <button type='button' class='btn btn-outline-primary' cek-img>Review</button> --->
							<button type='button' class='btn btn-outline-danger' delete-gambar>X</button>
						</div>`;
					let ket = modalJawab.querySelector('[name=ket]') /*required vaue='' type='text'*/
					ket.setAttribute('type', 'text');
					ket.value = '';
					ket.setAttribute('required', '');
					let gambar_jawaban = modalJawab.querySelector('.gambar-jawaban');
					modalJawab.querySelector('.ket-ditolak').classList.add('d-none');
					gambar_jawaban.innerHTML = '';
					modalJawab.querySelector('.modal-header').classList.remove('text-bg-secondary');
					modalJawab.querySelector('.modal-header').classList.remove('text-bg-warning');
					modalJawab.querySelector('.modal-header').classList.remove('text-bg-danger');
					modalJawab.querySelector('.modal-header').classList.remove('text-bg-primary');
					modalJawab.querySelector('.modal-title').textContent = res['tugas']['nama'];
					modalJawab.setAttribute('active-id', res['tugas']['id'])
					modalJawab.querySelector('[name=idTugas]').value = res['tugas']['id'];
					if(res['sTugas'] == 'bkerja'){
						modalJawab.querySelector('.modal-header').classList.add('text-bg-secondary');
						ket.setAttribute('type', 'hidden');
						ket.removeAttribute('required')
					}else if(res['sTugas'] == 'terlambat'){
						modalJawab.querySelector('.modal-header').classList.add('text-bg-danger');
					}else if(res['sTugas'] == 'ditolak'){
						modalJawab.querySelector('.modal-header').classList.add('text-bg-warning');
						ket.setAttribute('readonly', '');
						ket.value = res['jawaban']['ket'];
						modalJawab.querySelector('.ket-ditolak').classList.remove('d-none');
						res['jawaban']['gambar'].forEach(namaGambar =>{
							let div = document.createElement('div');
							let tamp = `<img data-bs-toggle='modal' data-bs-target='#modal-cek' src='${res['BASE_URL']}Gambar/getGambarTugas/${namaGambar}' class='img-thumbnail mb-3' style='max-width:100px;'>`
							div.innerHTML = tamp;
							gambar_jawaban.appendChild(div);
						})
					}else if(res['sTugas'] == 'dikumpul'){
						modalJawab.querySelector('.modal-header').classList.add('text-bg-primary');
						res['jawaban']['gambar'].forEach(namaGambar =>{
							let div = document.createElement('div');
							let tamp = `<img data-bs-toggle='modal' data-bs-target='#modal-cek' src='${res['BASE_URL']}Gambar/getGambarTugas/${namaGambar}' class='img-thumbnail mb-3' style='max-width:100px;'>`
							div.innerHTML = tamp;
							gambar_jawaban.appendChild(div);
							ket.setAttribute('type', 'hidden');
							ket.removeAttribute('required')
						})
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
set_countdown();