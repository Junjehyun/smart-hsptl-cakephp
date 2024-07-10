<?php $this->assign('title', '患者一覧'); ?>
<a href="/kanjaList">
    <h1 class="text-5xl font-bold text-center mt-5">患者検索</h1>
</a>
<div class="container flex justify-center max-w-8xl p-5 py-8">
    <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
        <div class="flex flex-wrap justify-between items-center gap-4">
        <form method="get" action="/kanjaList">
            <div class="overflow-x-auto mt-6 mx-5">
                <div class="flex items-center mb-5 space-x-3">
                    <input name="searchKanja" type="text" class="rounded placeholder-gray-300 h-15 p-2" placeholder="氏名または患者番号を検索" value="<?= h($searchKanja ?? '') ?>">
                    <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold h-15 py-2 px-4 rounded focus:outline-none focus:shadow-outline border-none">
                        検索
                    </button>
                </div>
            </div> 
        </form>
            <a href="/kanjaCreate">
                <button type="button" class="border-none bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15">
                    患者登録
                </button>
            </a>
            <div class="w-full">
                <table class="min-w-full leading-loose rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-300">
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                <input type="checkbox">
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                患者番号
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                氏名
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                性別
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                生年月日
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                診療科
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                医者名
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                病室
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                血液型
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                重症度
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                落傷
                            </th>
                            <th class="px-5 py-3 bg-sky-50 text-center text-m text-gray-600 tracking-tighter whitespace-nowrap">
                                処理
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-5 py-2 border-r text-center">
                                <input type="checkbox">
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($customer->customer_no) ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <a href="<?= $this->Url->build(['action' => 'kanjaShow', $customer->customer_no]) ?>" class="text-blue-500 hover:underline">
                                    <?= h($customer->name) ?>
                                </a>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= $customer->sex === 'M' ? '男' : '女' ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($customer->birthdate) ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($departmentsList[$customer->medical_info->department] ?? $customer->medical_info->department) ?>

                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($customer->medical_info->doctor_name) ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($customer->room_code) ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($bloodTypeList[$customer->blood_type] ?? $customer->blood_type) ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($severitiesList[$customer->severity] ?? $customer->severity) ?>
                            </td>
                            <td class="px-5 py-2 border-r text-center whitespace-nowrap">
                                <?= h($fallsList[$customer->fall] ?? $customer->fall) ?>
                            </td>
                            <td class="px-5 py-2 text-center">
                                <a href="<?= $this->Url->build(['controller' => 'KanjaList', 'action' => 'kanjaEdit', $customer->customer_no]) ?>">
                                    <button type="button" class="bg-sky-400 hover:bg-sky-600 text-white font-bold h-15 py-2 px-4 rounded focus:outline-none focus:shadow-outline border-none">
                                        修正
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>