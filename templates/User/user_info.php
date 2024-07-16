<?php $this->assign('title', 'ユーザー管理'); ?>
<a href="/user-info">
    <h1 class="text-5xl font-bold text-center mt-5">ユーザー管理</h1>
</a>
<div class="container mx-auto px-4">
    <div class="flex justify-center mt-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
            <table class="min-w-full leading-normal rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-300">
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            No
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            氏名
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            Eメール
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            部署
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            ユーザー区分
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            ステータス
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            処理
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="px-5 py-2 border-r whitespace-nowrap">
            
                        </td>
                        <td class="px-5 py-2 border-r whitespace-nowrap">
                    
                        </td>
                        <td class="px-5 py-2 border-r whitespace-nowrap">
                    
                        </td>
                        <td class="px-5 py-2 border-r whitespace-nowrap">
                        
                        </td>
                        <td class="px-5 py-2 border-r whitespace-nowrap">

                        </td>
                        <td class="px-5 py-2 border-r whitespace-nowrap">

                        </td>
                        <td class="px-5 py-2 border-r whitespace-nowrap">
                            <a href="#" class="text-rose-400 hover:text-rose-500 font-bold">
                                <i class="fa-regular fa-trash-can"></i> 権限削除
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>