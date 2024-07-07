<?php $this->assign('title', '患者新規登録'); ?>
<a href="/kanjaCreate">
    <h1 class="text-5xl font-bold text-center mt-5">患者新規登録</h1>
</a>
<div class="container mx-auto max-w-6xl flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
    <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col">
                <label class="mb-1 text-sm text-gray-600">氏名 <span class="text-red-500">必須</span></label>
                <input name="name" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="氏名">
            </div>
            <div class="flex flex-col">
                <label class="mb-1 text-sm text-gray-600">生年月日 <span class="text-red-500">必須</span></label>
                docker테스트123
            </div>
        </div>
    </div>
</div>