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
    <!--HTML5 QR Reader-->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@300&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
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
            font-family: 'Kiwi Maru', sans-serif;
        }
        h1, h2, h3 {
            font-family: 'Kiwi Maru', sans-serif;
        }
        /* 640px以下のテーブル処理 */
        @media (max-width: 640px) {
            #values-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            #values-table thead, #values-table tbody, #values-table th, #values-table td, #values-table tr {
                display: block;
            }

            #values-table thead {
                float: none;
                width: 100%;
            }

            #values-table tbody {
                display: block;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
            }

            #values-table td, #values-table th {
                display: inline-block;
                white-space: nowrap;
            }
        }

        @media (max-width: 640px) {

        #values-table thead {
            flex: 0 0 auto;
        }
        #values-table tbody {
            display: flex;
            flex-direction: column;
            flex: 1 1 auto;
        }
        #values-table tr {
            display: flex;
            flex: 0 0 auto;
        }
        #values-table th, #values-table td {
            flex: 1 1 auto;
            white-space: nowrap;
        }
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
