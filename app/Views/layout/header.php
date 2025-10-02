<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="http://localhost/puntoar/public/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('public/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/footer.css') ?>">
    
    <meta charset="UTF-8">
    <title><?= esc($titulo ?? 'PuntoAR') ?></title>

    <?php if (!empty($estilos)): ?>
    <?php foreach ($estilos as $css): ?>
        <link rel="stylesheet" href="<?= base_url('public/css/' . $css) ?>">
    <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>
