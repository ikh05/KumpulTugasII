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