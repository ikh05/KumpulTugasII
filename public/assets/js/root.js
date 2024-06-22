// import {ajax} from './modules/functions.js';


let message = document.querySelector('.alert');
if(message !== null) {
	setTimeout(()=>{
		message.classList.remove('show');
	}, 4000)
	setTimeout(()=>{
		message.remove()
	}, 5000);
}