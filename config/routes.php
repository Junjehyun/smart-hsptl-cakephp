<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /**
         * indexページを表示するルーター設定
         * 
         */
        $builder->connect('/index', ['controller' => 'MainPage', 'action' => 'index'])->setMethods(['GET']);

        /**
         * 患者一覧画面を表示するルーター設定
         * 
         */
        $builder->connect('/kanjaList', ['controller' => 'KanjaList', 'action' => 'kanjaList'])->setMethods(['GET']);

        /**
         * 患者新規登録画面を表示するルーター設定
         * 
         */
        $builder->connect('/kanjaCreate', ['controller' => 'KanjaList', 'action' => 'kanjaCreate'])->setMethods(['GET', 'POST']);

        /**
         * 患者詳細画面を表示するルーター設定
         * 
         */
        $builder->connect('/kanjaShow/:customer_no', ['controller' => 'KanjaList', 'action' => 'kanjaShow'])
        ->setPass(['customer_no'])
        ->setPatterns(['customer_no' => '[A-Za-z0-9]+'])
        ->setMethods(['GET', 'POST']);

        /**
         * 患者情報更新画面を表示するルーター設定
         * 
         */
        $builder->connect('/kanjaEdit/:customer_no', ['controller' => 'KanjaList', 'action' => 'kanjaEdit'])
        ->setPass(['customer_no'])
        ->setPatterns(['customer_no' => '[A-Za-z0-9]+'])
        ->setMethods(['GET', 'POST', 'PUT']);
        
        /**
         * CSV Masterデータを取得するルーター設定
         */
        $builder->connect('/csv-upload', ['controller' => 'CsvUpload', 'action' => 'upload'])->setMethods(['GET', 'POST']);
        $builder->connect('/master-list', ['controller' => 'CsvUpload', 'action' => 'masterList'])->setMethods(['GET']);
        $builder->connect('/master/values', ['controller' => 'CsvUpload', 'action' => 'getValuesByMasterName'])->setMethods(['POST']);

        /**
         * イメージロゴ登録画面関連
         * 
         */
        $builder->connect('/image-upload', ['controller' => 'ImgUpload', 'action' => 'imageUpload'])->setMethods(['GET']);
        $builder->connect('/image-upload', ['controller' => 'ImgUpload', 'action' => 'imageToroku'])->setMethods(['POST']);
        $builder->connect('/image-delete', ['controller' => 'ImgUpload', 'action' => 'imageDelete'])->setMethods(['DELETE']);

        /**
         * ユーザー関連コントローラー
         */
        $builder->connect('/user-approval', ['controller' => 'User', 'action' => 'userApproval'])->setMethods(['GET']);
        $builder->connect('/user-approval-registration/{id}', ['controller' => 'User', 'action' => 'userApprovalRegistration'])->setPass(['id'])->setMethods(['POST']);
        $builder->connect('/user-info', ['controller' => 'User', 'action' => 'userInfo'])->setMethods(['GET']);
        $builder->connect('/users/revoke-permission/:id', ['controller' => 'Users', 'action' => 'revokePermission'])->setPass(['id'])->setMethods(['POST']);
        $builder->connect('/ward-manager', ['controller' => 'User', 'action' => 'wardManager'])->setMethods(['GET']);

        /**
         * 病棟管理者
         */
        $builder->connect('/ward-manager', ['controller' => 'Users', 'action' => 'wardManager'])->setMethods(['GET']);
        $builder->connect('/ward-update/{id}', ['controller' => 'Users', 'action' => 'updateWard'])->setPass(['id'])->setMethods(['POST']);;
        $builder->connect('/ward-manager/{id}', ['controller' => 'Users', 'action' => 'getWardManager'])->setPass(['id'])->setMethods(['GET']);

        /**
         * QRコード関連
         */
        $builder->connect('/qr-index', ['controller' => 'QrCode', 'action' => 'index'])->setMethods(['GET']);
        $builder->connect('/save-qr-code', ['controller' => 'QrCode', 'action' => 'saveQrCode', 'method' => 'POST']);

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
