<?php if(isset($data['css'])) :?>

	<?php foreach($data['css'] as $css) :?>
		
		<?php if(strpos($css, 'href') !== 0) :?>
			<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>assets/css/<?= $css ?>.css">
		<?php else :?>
			<link <?= $css ?>>
		<?php endif; ?>

	<?php endforeach; ?>

<?php endif; ?>