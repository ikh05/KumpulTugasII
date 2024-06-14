import {generateToken, setInput_localtorage} from './modules/functions.js';


const buatToken = document.querySelector('#create-token');
let invalid = 'contoh: "XII Mipa 1"';


buatToken.addEventListener('click', ()=>{
	let token = generateToken(6);
	buatToken.parentElement.querySelector('input').value = token;
});


setInput_localtorage('nama');
setInput_localtorage('sekolah');