MathJax = {
	tex: {
		inlineMath: [['$', '$'], ['\\(', '\\)']]
	},
	svg: {
		fontCache: 'global'
	}
};


setInterval(()=>{
	MathJax.typesetPromise();
	
}, 2000)
