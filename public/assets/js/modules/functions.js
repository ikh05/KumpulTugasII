export function ajax (tujuan, f) {
	let url = [...arguments]; url.splice(0,2)
	url = setURLAjax(url);
	let ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			let response = JSON.parse(ajax.responseText);
			console.log(ajax.responseText);
			console.log(response);
			if(response['message'] !== undefined){
				alert(response['message']);
			}
			if(response['status'] === 'OK'){
				if(typeof(f) === 'function') f(response);
			}
		}
	};
	console.log(`index.php?url=${tujuan}/${url}`);
	ajax.open('GET', tujuan+'.php?url='+url, true);
	ajax.setRequestHeader("Content-type", "application/json");
	ajax.send();
}

function setURLAjax (data) {
	return data.join('/');
}

export function btnIconToggle(btn) {
	btn.children[0].classList.toggle('d-none');
	btn.children[1].classList.toggle('d-none');
}