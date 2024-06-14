export function btnIconToggle(btn) {
	btn.children[0].classList.toggle('d-none');
	btn.children[1].classList.toggle('d-none');
}

export function toggleClass(el, c){
	if(typeof(el) === 'string') el = document.querySelector(el);
	el.classList.toggle(c);
}

export function setInput_localtorage(key, f=null){
	let input = document.querySelector('[name='+key+']');
	input.value = localStorage.getItem('kumpuTugasII_'+key) || '';
	if(typeof(f) === 'function') f(input);
	input.addEventListener('input', ()=>{
		localStorage.setItem('kumpuTugasII_'+key, input.value);
		if(typeof(f) === 'function') f(input);
	})
}

export function generateToken(n=6){
	var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	var token = '';
	for(var i = 0; i < n; i++){
		token += chars[Math.floor(Math.random() * chars.length)];
	}
	return token;
}

export function hiddenShowTabel (tabel, halaman, banyak) {
	// mencari halaman mana yang active
	let halamanActive = parseInt(halaman.querySelector('a.active[value]').getAttribute('value'));
	let indexMulai = ((halamanActive-1)*banyak);
	let indexAkhir = parseInt(indexMulai)+parseInt(banyak)-1;
	tabel.forEach((e,i)=>{
		if(i < indexMulai || i > indexAkhir) e.classList.add('d-none');
		else e.classList.remove('d-none');
	})
}
export function countHalaman (tabel, halaman, banyak){
	let banyakData = tabel.length;
	let banyakHalaman = Math.ceil(banyakData/parseInt(banyak));
	let allButton = halaman.querySelectorAll('li');
	for (let i = 1; i+1 < allButton.length; i++) {
		allButton[i].remove();
	}
	let parent = halaman.querySelector('ul');
	let btnTerakhir = allButton[allButton.length-1];
	for (let i = 1; i <= banyakHalaman; i++) {
		let li = document.createElement('li');
		li.classList.add('page-item');
		li.innerHTML = "<a href='#navigation-pages' value='"+i+"' class='page-link active'>"+i+"</a>";
		parent.insertBefore(li,btnTerakhir)
	}
}
export function halamanAcive(halaman, halamanActive) {
	// halamanClick harus berupa int
	let allButton = halaman.querySelectorAll('a[value]');
	allButton.forEach( function(element, index) {
		if(element.getAttribute('value') === halamanActive.toString()) element.classList.add('active');
		else element.classList.remove('active');
	});
}