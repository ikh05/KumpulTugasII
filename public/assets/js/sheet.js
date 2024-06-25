document.addEventListener('click', (ev)=>{
	let el = ev.target;
	while (el !== document.querySelector('body')) {
		if(el.hasAttribute('download-sheet-js')){
			const tabel = document.querySelector(el.getAttribute('download-sheet-js'))
			let data = tabel.querySelectorAll('tbody tr');
			let dataSheet = JSON.parse("["+Array.from(data).map(e=>"{"+trToTextJSON(e)+"}").join(',')+"]");
			const worksheet = XLSX.utils.json_to_sheet(dataSheet);
			const workbook = XLSX.utils.book_new();
			let tanggal = new Date();
			let nama_file = tabel.getAttribute('name-table') + " - " + tanggal.toLocaleDateString() + ".xlsx";
			XLSX.utils.book_append_sheet(workbook, worksheet, "Dates");
			XLSX.writeFile(workbook, nama_file, { compression: true });
		}
		el = el.parentElement;
	}
})


function trToTextJSON(tr) {
	// return tr;
	return Array.from(tr.children).map((e,i)=>{
		if(e.getAttribute('name-row') === 'tugas'){
			return '"Tugas-'+e.getAttribute('tugas')+'":"'+e.textContent+'"';
		}else{
			return '"'+e.getAttribute('name-row')+'":"'+e.textContent+'"';
		}
	}).join(',');
}