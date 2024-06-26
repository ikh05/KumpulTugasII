<!DOCTYPE html>
<html>
<head data-bs-theme="">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= (isset($data['title'])) ? $data['title'] : '~~ KumpulTugas II ~~' ;?></title>

	<!-- ICON -->
	<!-- <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>assets/img/favico.ico"> -->
	
	<!-- MY CSS ROOT -->
	<link href="<?= BASE_URL ?>assets/css/root.css" rel="stylesheet" type="text/css">

	<?php include_once "../app/views/tamplates/css.php" ?>
</head>
<body>

<?php if(isset($data[C_MESSAGE])) : ?>
	<?php if(isset($data[C_MESSAGE]['pesan'])) : ?>
		<!-- Message -->
		<div class="rounded-top-0 text-center alert alert-<?= $data[C_MESSAGE]['warna'] ?> alert-dismissible fade show fixed-top" role="alert">
			<strong><?= $data[C_MESSAGE]['strong']  ?></strong> <?= $data[C_MESSAGE]['pesan'] ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
<?php endif; ?>