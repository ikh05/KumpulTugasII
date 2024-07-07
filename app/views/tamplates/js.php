<?php if(isset($data['js'])) :?>
	<?php foreach($data['js'] as $js) : ?>
		<?php if(strpos($js, 'src') === 0) :?>
			<script <?= $js ?>></script>
		<?php elseif(strpos($js, 'm_') === 0) :?>
			<script type='module' src='<?= BASE_URL ?>assets/js/<?= $js ?>.js'></script>
		<?php elseif(strpos($js, 't_') === 0) :?>
			<?php if($js === 't_config_mathjax') :?>
				<script type="text/javascript">
					MathJax = {
						tex: {inlineMath: [['$', '$'], ['\\(', '\\)']]},
						svg: {fontCache: 'global'}
					};
					setInterval(()=>{ MathJax.typesetPromise()}, 2000);
				</script>
			<?php endif; ?>
		<?php else :?>	
			<script type='text/javascript' src='<?= BASE_URL ?>assets/js/<?= $js ?>.js'></script>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>