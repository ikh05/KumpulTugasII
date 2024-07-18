export function cekGambar() {
	document.addEventListener('click', (ev)=>{
		let el = ev.target;
		while (el !== document.querySelector('main')) {
			if(el.hasAttribute('cek-img')){
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
			}else if(el.classList.contains('img-thumbnail')){
				let src = el.getAttribute('src');
				let img = document.querySelector('#modal-cek img');
				let textSoal = img.previousElementSibling;
				img.classList.remove('d-none');
				textSoal.classList.add('d-none');
				img.setAttribute('src', src);
			}
			el = el.parentElement;
		}
	});
}

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
	for (let i = 2; i+2 < allButton.length; i++) {
		allButton[i].remove();
	}
	let parent = nav.querySelector('ul');
	let btnTerakhir = allButton[allButton.length-2];
	for (let i = 1; i <= banyaknav; i++) {
		let li = document.createElement('li');
		li.classList.add('page-item');
		let href = btnTerakhir.children[0].getAttribute('href');
		li.innerHTML = "<a href='"+href+"' value='"+i+"' class='page-link active'>"+i+"</a>";
		if(i === 1){
			li.classList.add('order-1');
		}else if(i === banyaknav){
			li.classList.add('order-5');
		}else{
			li.classList.add('order-3');
		}
		console.log(i + " : ");
		console.log(li.classList);
		console.log('-----')
		parent.insertBefore(li,btnTerakhir)
	}

	if(typeof(f) === 'function') f(arguments);
}
export function halamanAcive(nav, navActive, f=null) {
	// navClick harus berupa int
	let allButton = nav.querySelectorAll('a[value]');
	allButton.forEach( function(element, index) {
		if(element.getAttribute('value') === navActive.toString()){
			element.classList.add('active');
		}
		else {
			element.classList.remove('active');
		};
	});
	f__(nav);
	if(typeof(f) === 'function') f(arguments);
}

export function navHalaman_click (tabel, nav, banyak, f=null) {
	 nav.addEventListener('click', ev => {
	 	let el = ev.target;
		while (el !== nav) {
			if(el.hasAttribute('value')){
				let allBtn = nav.querySelectorAll('a');
				let min = 1;
				let max = allBtn.length - 4;
				let valueClick = el.getAttribute('value');
				if(valueClick === '-1' || valueClick === '+1'){
					let valueActive = parseInt(nav.querySelector('.active[value]').getAttribute('value'));
					if(valueClick === '-1' && valueActive !== 1) valueActive -= 1;
					if(valueClick === '+1' && valueActive !== (allBtn.length-2)) valueActive += 1;
					valueClick = valueActive.toString();
				}
				valueClick = valueClick > max ? max : (valueClick < min ? min : valueClick);  
				halamanAcive(nav, parseInt(valueClick));
				hiddenShowTabel(tabel, nav, banyak);
			}
			el = el.parentElement;
		}
	 })
	 if(typeof(f) === 'function') f(arguments);
}
function f__ (nav) {
	let all__ = nav.querySelectorAll('.__')
	let all_order3 = nav.querySelectorAll('.order-3');
	all_order3.forEach(e=>e.classList.add('d-none'));
	let navActive = nav.querySelector('a.active');
	// menampilkan [sebelum][1][...][4][5=active][6][sesudah]
	navActive.parentElement.classList.remove('d-none');
	let navActive_value = parseInt(navActive.getAttribute('value'));
	if(navActive_value <= 2) all__[0].classList.add('d-none');
	else {
		all__[0].classList.remove('d-none')
		all_order3[navActive_value-3].classList.remove('d-none');
	}
	if(navActive_value >= all_order3.length+1) all__[1].classList.add('d-none');
	else {
		all__[1].classList.remove('d-none')
		all_order3[navActive_value-1].classList.remove('d-none');
	}

	// [index=0],[value=3],[index=2] ...
	if(navActive_value !== 1){

	}
}


export function ajax (el, f=null){
	let ajax = new XMLHttpRequest();
	let url = el.getAttribute('href-ajax');
	let a = arguments;
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			let response = ajax.responseText;
			console.log(response);
			response = JSON.parse(response);
			console.log(response);
			if(typeof(f) === 'function') f(response, el);
			// Array.from(a).map(f => typeof(f) === 'function' ? f(response, el) : f)
		}
	};
	ajax.open('GET', url, true);
	ajax.setRequestHeader("Content-type", "application/json");
	ajax.setRequestHeader('X-Requested-With', 'KTII_Ajax');
	ajax.send();
}

export function set_countdown() {
	let now = new Date();
	let allCountDown = document.querySelectorAll('.countdown');
	allCountDown.forEach( function(element, index){
		let down = element.getAttribute('down').split(/[\s\-:]/);
		down = new Date(down[0], down[1]-1, down[2], down[3], down[4], down[5]);
		let times = (down-now<0) ? 0 : Math.floor((down-now)/1000);
		console.log(times);
		element.innerHTML = "<div style='width:100%; display: flex; gap: .5rem; justify-content:space-around;'></div>";
		if(element.hasAttribute('tahun')){
			t = Math.floor(times/60/60/24/30/12);
			times = times%(60*60*24*30*12);
			element.children[0].innerHTML = "<div style='width:0px; overflow:visible; display: flex; justify-content: center; flex-direction: column;'><p style='margin:0; font-size: 2rem; font-weight: bold;' countdown-type='tahun' min-dig='1' nilai='31104000'>"+t+"</p><p style='margin:0; font-size: 1rem;'>Tahun</p></div>";
		}
		// nanti di cek berapa banyak hari dari bulan yang dilalui
		if(element.hasAttribute('bulan')){
			t = Math.floor(times/60/60/24/30);
			times = times%(60*60*24*30);
			element.children[0].innerHTML += "<div style='width:0px; overflow:visible; display: flex; justify-content: center; flex-direction: column;'><p style='margin:0; font-size: 2rem; font-weight: bold;' countdown-type='bulan' min-dig='1' nilai='2592000'>"+t+"</p><p style='margin:0; font-size: 1rem;'>Bulan</p></div>";
		}
		if(element.hasAttribute('hari')){
			t = Math.floor(times/60/60/24);
			times = times%(60*60*24);
			element.children[0].innerHTML += "<div style='width:0px; overflow:visible; display: flex; justify-content: center; flex-direction: column;'><p style='margin:0; font-size: 2rem; font-weight: bold;' countdown-type='hari' min-dig='1' nilai='86400'>"+t+"</p><p style='margin:0; font-size: 1rem;'>Hari</p></div>";
		}
		if(element.hasAttribute('jam')){
			t = Math.floor(times/60/60);
			times = times%(60*60);
			element.children[0].innerHTML += "<div style='width:0px; overflow:visible; display: flex; justify-content: center; flex-direction: column;'><p style='margin:0; font-size: 2rem; font-weight: bold;' countdown-type='jam' min-dig='2' nilai='3600' >"+t+"</p><p style='margin:0; font-size: 1rem;'>Jam</p></div>";
		}
		if(element.hasAttribute('menit')){
			t = Math.floor(times/60);
			times = times%60;
			element.children[0].innerHTML += "<div style='width:0px; overflow:visible; display: flex; justify-content: center; flex-direction: column;'><p style='margin:0; font-size: 2rem; font-weight: bold;' countdown-type='menit' min-dig='2' nilai='60' >"+t+"</p><p style='margin:0; font-size: 1rem;'>Menit</p></div>";
		}
		element.children[0].innerHTML += "<div style='width:0px; overflow:visible; display: flex; justify-content: center; flex-direction: column;'><p style='margin:0; font-size: 2rem; font-weight: bold;' countdown-type='detik' min-dig='2' nilai='1'>"+times+"</p><p style='margin:0; font-size: 1rem;'>Detik</p></div>";

		// update
		setInterval(function(){
			// mengurangkan detik
			let detik = element.querySelector('[countdown-type=detik]');
			detik.innerHTML = detik.innerHTML-1;
			if(detik.innerHTML < 0) detik.innerHTML = 0;

			// cek detik, dll
			[...detik.parentElement.parentElement.children]
			 .map(e=>e.children[0])
			 .map((e,i,a)=>{
				// jaga digit
				if(e.innerHTML <= 0 && i!= 0){
					if(a[i-1].innerHTML != 0){
						ne = e.getAttribute('nilai');
						ns = a[i-1].getAttribute('nilai');
						nh = ns/ne;
						a[i-1].innerHTML -= 1;
						e.innerHTML = nh;
					}
				}
			});
			[...detik.parentElement.parentElement.children]
			 .map(e=>{
			 	e = e.children[0];
				e.innerHTML = (e.innerHTML.length < e.getAttribute('min-dig') ? "0" : "")+e.innerHTML;
			});
		}, 1000)
	});

}