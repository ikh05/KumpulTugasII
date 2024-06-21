import {ajax} from './modules/functions.js';

document.addEventListener('click', ev=>{
	let el = ev.target;
	while (el !== document.body) {
		if(el.hasAttribute('href-ajax') && !el.classList.contains('disabled')){
			ajax(el);
		}
		el = el.parentElement
	}
})


let message = document.querySelector('.alert');
if(message !== null) {
	setTimeout(()=>{
		message.classList.remove('show');
	}, 4000)
	setTimeout(()=>{
		message.remove()
	}, 5000);
}