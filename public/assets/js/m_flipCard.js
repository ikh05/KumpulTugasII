import {toggleClass} from './modules/functions.js';


let masetrFlip = document.querySelectorAll('.card-master-flip');
masetrFlip.forEach((m)=>{
	m.addEventListener('click', (ev)=>{
		let el = ev.target;
		console.log(el);
		while (el !== m) {
			if(el.getAttribute('toggle-class')){
				toggleClass(el.getAttribute('target-toggle-class'), 'flip')
			}
			console.log(el);
			el = el.parentElement;
		}
	})
});