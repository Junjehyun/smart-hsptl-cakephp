<?php $this->assign('title', '患者詳細情報'); ?>
<a href="/kanjaShow">
    <h1 class="text-5xl font-bold text-center mt-5">患者詳細情報</h1>
</a>
<!-- <div class="container mx-auto max-w-6xl flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 mt-5">  -->
<div class="container mx-auto max-w-6xl flex flex-col space-y-4 mt-5">
    <div class="flex flex-col md:flex-row w-full">
        <!--患者情報-->
        <div class="bg-zinc-50 p-6 rounded-lg shadow-2xl mb-6 md:w-1/2 md:mr-2 sm:w-1/2">
            <h2 class="text-2xl font-bold mb-4">患者情報</h2>
            <hr class="my-4 border-sky-100">
            <table id="values-table" class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">氏名</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><span class="text-sky-400"><?= h($customer->name) ?></span></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">生年月日</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->birthdate) ?></td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">性別</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= $customer->sex === 'M' ? '男' : '女' ?></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">血液型</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($bloodTypes[$customer->blood_type] ?? $customer->blood_type) ?></td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">入院日</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->hospitalized_date->i18nFormat('yyyyMMdd')) ?></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">電話番号</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->telephone) ?></td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">住所</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->address) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--診療情報-->
        <div class="bg-zinc-50 p-6 rounded-lg shadow-2xl mb-6 sm:w-1/2 md:w-1/2 md:mr-2">
            <h2 class="text-2xl font-bold mb-4">診療情報</h2>
            <hr class="my-4 border-sky-100">
            <table id="values-table" class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">診療科</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><span class="text-sky-400"><?= h($departments[$customer->medical_info->department] ?? $customer->medical_info->department) ?></span></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">担当医名</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->medical_info->doctor_name) ?></td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">重症度</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->severity_display) ?></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">落傷</td>
                        <td class="px-6 py-4 whitespace-nowrap border"><?= h($customer->fall_display) ?></td>
                    </tr>
                    <tr class="bg-sky-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semi-bold border text-center">注意事項</td>
                        <td class="px-6 py-4 whitespace-nowrap border">
                            <?php if ($customer->medical_info->blood_warn): ?>
                                <span class="text-red-400">血液</span>
                            <?php endif; ?>
                            <?php if ($customer->medical_info->contact_warn): ?>
                                <span class="text-red-400">接触主義</span>
                            <?php endif; ?>
                            <?php if ($customer->medical_info->air_warn): ?>
                                <span class="text-red-400">空気注意</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--重要事項-->
<div class="bg-zinc-50 p-6 rounded-lg shadow-2xl mb-6">
    <h2 class="text-2xl font-semi-bold md-4 text-sky-400">重要事項</h2>
    <p class="mt-5"><?= h($customer->medical_info->remarks) ?></p>
</div>
<!--コメント-->
<div class="bg-zinc-50 p-6 rounded-lg shadow-2xl mb-6">
    <h2 class="text-2xl font-semi-bold mb-4 text-sky-400">コメント</h2>
    <?= $this->Form->create(null, ['url' => ['action' => 'kanjaShow', $customer->customer_no]]) ?>         
        <textarea name="comments" rows="4" class="w-full p-2 border rounded-lg mb-4" placeholder="コメントを入力してください"></textarea>
        <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-semi-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline border-none">コメント登録</button>
    <?= $this->Form->end() ?>
    <div class="mt-6">
        <?php foreach ($comments as $comment): ?>
            <div class="border-b border-gray-200 mb-4 pb-2">
                <p class="text-base">
                    <span class="text-gray-600 text-2xl"><?= h($comment->comments) ?></span>
                    <strong>- 
                        <?= h($comment->create_date->i18nFormat('yyyy-MM-dd HH:mm:ss')) ?>
                    </strong> 
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

