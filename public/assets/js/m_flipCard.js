import {toggleClass} from './modules/functions.js';


let masetrFlip = document.querySelectorAll('.card-master-flip');


document.addEventListener('DOMContentLoaded', ()=>{
})
masetrFlip.forEach((m)=>{
	let vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0)
	let persentas = parseInt(m.getAttribute('height'))/100;
	m.style.height = (vh*persentas)+'px';

	m.addEventListener('click', (ev)=>{
		let el = ev.target;
		while (el !== m) {
			if(el.getAttribute('toggle-class')){
				toggleClass(el.getAttribute('target-toggle-class'), 'flip')
			}
			el = el.parentElement;
		}
	})
});