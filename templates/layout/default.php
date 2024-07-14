<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$defaultTitle = 'Smart Hospital';
$pageTitle = $this->fetch('title');

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $defaultTitle ?><?= $pageTitle ? ' - ' . $pageTitle : '' ?>
    </title>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&family=Yomogi&family=Zen+Maru+Gothic:wght@300&display=swap" rel="stylesheet">

    <?= $this->Html->meta('icon') ?>

    <?= $this->Flash->render() ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <!--Tailwindcss-->
    <?= $this->Html->css('tailwind') ?>
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        body {
            font-family: 'Zen Maru Gothic', sans-serif;
        }
        h1 {
            font-family: 'Zen Maru Gothic', sans-serif;
        }
    </style>
    <script>
        setTimeout(function() {
            var flashMessages = document.querySelectorAll('.alert');
            flashMessages.forEach(function(message) {
                message.style.display = 'none';
            });
        }, 5000); 
    </script>
</head>
<body class="bg-white flex-grow p-6">
    <nav class="top-nav bg-sky-50 p-4 shadow-lg">
        <div class="top-nav-title flex items-center">
            <a href="<?= $this->Url->build('/index') ?>" class="flex items-center">
                <?php if ($headerImage): ?>
                    <img src="<?= $this->Url->build('/' . $headerImage) ?>" alt="Logo" style="height: 40px;">
                <?php endif; ?>
                <span>Smart</span> Hospital
            </a>
        </div>
        <div class="top-nav-links relative">
            <!-- <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/">Documentation</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a> -->
        </div>
    </nav>
    <main>
        <div>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
</body>
</html>
