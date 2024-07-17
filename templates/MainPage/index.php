<?php $this->assign('title', 'メイン'); ?>

<div class="container flex justify-center mx-auto max-w-4xl p-6 py-8">
    <div class="grid grid-cols-2 gap-4 mt-8 mx-auto">
        <a href="/kanjaList">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
                <i class="fas fa-bell mr-2"></i> 患者検索
            </button>
        </a>
        <a href="/kanjaCreate">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
                <i class="fas fa-search mr-2"></i> 患者登録
            </button>
        </a>
        <a href="/csv-upload">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
                <i class="fas fa-user-plus mr-2"></i> CSV一括登録
            </button>
        </a>
        <a href="/image-upload">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
            イメージ登録
            </button>
        </a>
        <a href="/master-list">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-4xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
            マスターデータ一覧
            </button>
        </a>
        <a href="user-info">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
            ユーザー管理
            </button>
        </a>
        <a href="/user-approval">
            <button class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
            ユーザー承認
            </button>
        </a>
        <a href="/ward-manager">
            <button class="bg-green-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
            病棟管理者
            </button>
        </a>
        <a href="#">
            <button class="bg-rose-400 hover:bg-sky-600 text-white font-bold py-4 px-6 rounded w-full h-96 text-5xl transform transition duration-500 ease-in-out hover:scale-110 border-none">
            QRタグ管理
            </button>
        </a>
    </div>
</div>

