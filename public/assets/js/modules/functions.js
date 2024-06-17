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
	var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	var token = '';
	for(var i = 0; i < n; i++){
		token += chars[Math.floor(Math.random() * chars.length)];
	}
	return token;
}

export function hiddenShowTabel (tabel, nav, banyak, f=null) {
	// mencari nav mana yang active
	let navActive = parseInt(nav.querySelector('a.active[value]').getAttribute('value'));
	let indexMulai = ((navActive-1)*banyak);
	let indexAkhir = parseInt(indexMulai)+parseInt(banyak)-1;
	tabel.forEach((e,i)=>{
		if(i < indexMulai || i > indexAkhir) e.classList.add('d-none');
		else e.classList.remove('d-none');
	})
	if(typeof(f) === 'function') f(arguments);
}
export function countHalaman (tabel, nav, banyak, f=null){
	let banyakData = tabel.length;
	let banyaknav = 1;
	if(banyak !== 'all') banyaknav = Math.ceil(banyakData/parseInt(banyak));
	let allButton = nav.querySelectorAll('li');
	for (let i = 1; i+1 < allButton.length; i++) {
		allButton[i].remove();
	}
	let parent = nav.querySelector('ul');
	let btnTerakhir = allButton[allButton.length-1];
	for (let i = 1; i <= banyaknav; i++) {
		let li = document.createElement('li');
		li.classList.add('page-item');
		let href = btnTerakhir.children[0].getAttribute('href');
		li.innerHTML = "<a href='"+href+"' value='"+i+"' class='page-link active'>"+i+"</a>";
		parent.insertBefore(li,btnTerakhir)
	}
	if(typeof(f) === 'function') f(arguments);
}
export function halamanAcive(nav, navActive, f=null) {
	// navClick harus berupa int
	let allButton = nav.querySelectorAll('a[value]');
	allButton.forEach( function(element, index) {
		if(element.getAttribute('value') === navActive.toString()) element.classList.add('active');
		else element.classList.remove('active');
	});
	if(typeof(f) === 'function') f(arguments);
}

export function navHalaman_click (tabel, nav, banyak, f=null) {
	 nav.addEventListener('click', ev => {
	 	let el = ev.target;
		while (el !== nav) {
			if(el.hasAttribute('value')){
				let allBtn = nav.querySelectorAll('a');
				let valueClick = el.getAttribute('value');
				if(valueClick === '-1' || valueClick === '+1'){
					let valueActive = parseInt(nav.querySelector('.active[value]').getAttribute('value'));
					if(valueClick === '-1' && valueActive !== 1) valueActive -= 1;
					if(valueClick === '+1' && valueActive !== (allBtn.length-2)) valueActive += 1;
					valueClick = valueActive.toString();
				}
				halamanAcive(nav, parseInt(valueClick));
				hiddenShowTabel(tabel, nav, banyak);
			}
			el = el.parentElement;
		}
	 })
	 if(typeof(f) === 'function') f(arguments);
}