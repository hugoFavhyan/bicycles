<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Bicycle Parking' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="bg-gray-800 text-white py-2">
    <div class="container mx-auto flex justify-end">
        <?php
            $uri = current_url(true);
            $uri->stripQuery('lang');
        ?>
        <a href="<?= $uri->setQuery('lang=en') ?>" class="px-2 hover:text-gray-400">English</a>
        <span class="px-1">|</span>
        <a href="<?= $uri->setQuery('lang=es') ?>" class="px-2 hover:text-gray-400">Español</a>
    </div>
</div>
