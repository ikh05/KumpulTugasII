// import {ajax} from './modules/functions.js';

document.addEventListener('click', ()=>{
	let el = document.documentElement;
	if(el.requestFullscreen) el.requestFullscreen();
	else if(el.webkitRequestFullscreen) el.webkitRequestFullscreen();
	else if(el.msRequestFullscreen) el.msRequestFullscreen();
});
let message = document.querySelector('.alert');
if(message !== null) {
	setTimeout(()=>{
		message.classList.remove('show');
	}, 4000)
	setTimeout(()=>{
		message.remove()
	}, 5000);
}