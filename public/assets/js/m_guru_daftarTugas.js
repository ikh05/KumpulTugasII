import {hiddenShowTabel, countHalaman, halamanAcive, navHalaman_click} from './modules/functions.js';


const checkBox_allTugas = document.getElementById('soal-all');
const tambah_banyakSoal = document.getElementById('banyak-soal');
const tambah_file = document.querySelector('form [type=file]');
const tambah_soalPilih = document.querySelector('form [name=soal-pilih]');
const soal_nav = document.getElementById('soal-nav');
const soal_banyakBaris =document.getElementById('soal-banyakBaris').value;
const allSoal = document.querySelectorAll('.daftar-soal tr');
const tugas_nav = document.getElementById('tugas-nav');
const tugas_banyakBaris =document.getElementById('tugas-banyakBaris').value;
const allTugas = document.querySelectorAll('.daftar-tugas tr');
const cara_soalTugas = document.querySelectorAll('#cara-soalTugas a');
const tambah_cara = document.querySelector('form [name=cara]');
const tambah_submit = document.querySelector('form [type=submit]');
console.log(tambah_submit);


if(allSoal.length > 0){
	countHalaman(allSoal, soal_nav, soal_banyakBaris);
	hiddenShowTabel(allSoal, soal_nav, soal_banyakBaris);
	halamanAcive(soal_nav, 1);
	navHalaman_click(allSoal, soal_nav, soal_banyakBaris);
}
if(allTugas.length > 0){
	countHalaman(allTugas, tugas_nav, tugas_banyakBaris);
	hiddenShowTabel(allTugas, tugas_nav, tugas_banyakBaris);
	halamanAcive(tugas_nav, 1);
	navHalaman_click(allTugas, tugas_nav, tugas_banyakBaris);
}

checkBox_allTugas.addEventListener('input', (ev)=>{
	let checkbox = allSoal[0].parentElement.querySelectorAll('[type=checkbox]')
	checkbox.forEach( function(i) {
		i.checked = checkBox_allTugas.checked;
	});
	tambah_banyakSoal.value = checkBox_allTugas.checked ? allSoal.length : 0;
	tambah_soalPilih.value = updateDaftarSoal(checkbox);
});
allSoal.forEach(function(tr){
	tr.querySelector('[type=checkbox]').addEventListener('input', function(ev){
		let checkbox = allSoal[0].parentElement.querySelectorAll('[type=checkbox]')
		cekIndeterminate(checkbox, checkBox_allTugas);
		tambah_banyakSoal.value = parseInt(tambah_banyakSoal.value) + (ev.target.checked ? 1 : -1);
		tambah_soalPilih.value = updateDaftarSoal(checkbox);
	})
})
cara_soalTugas.forEach( function(element, index) {
	element.addEventListener('click', (ev)=>{
		cara_soalTugas.forEach( function(e) {e.classList.remove('active')});
		ev.target.classList.add('active');
		tambah_cara.checked = (ev.target.getAttribute('checkbox-value') === '0' ? true : false)
	})
});

document.addEventListener('click', ()=>{
	if(tambah_cara.checked){
		if(parseInt(tambah_banyakSoal.value) !== 0 ) tambah_submit.removeAttribute('disabled');
		else tambah_submit.setAttribute('disabled','');
	}else{
		if(tambah_file.files.length !== 0) tambah_submit.removeAttribute('disabled');
		else tambah_submit.setAttribute('disabled', '');
	}
});
document.addEventListener('input', ()=>{
	if(tambah_cara.checked){
		if(parseInt(tambah_banyakSoal.value) !== 0 ) tambah_submit.removeAttribute('disabled');
		else tambah_submit.setAttribute('disabled','');
	}else{
		if(tambah_file.files.length !== 0) tambah_submit.removeAttribute('disabled');
		else tambah_submit.setAttribute('disabled', '');
	}
})
tambah_file.addEventListener('input', ()=>{
	document.querySelector('form [name=namafile]').value = tambah_file.files[0].name;
})



function cekIndeterminate (el, checkbox){
	let bool = el[0].checked;
	checkbox.indeterminate = false;
	el.forEach(function(e) {
		if(e.checked !== bool){
			checkbox.indeterminate = true; checkbox.checked = false;
		}
	});
}
function updateDaftarSoal (el) {
	return [...el].filter(e => e.checked).map(e => e.getAttribute('id-soal')).join(', ');
}