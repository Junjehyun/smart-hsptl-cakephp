<?php $this->assign('title', 'ユーザー管理'); ?>
<a href="/user-info">
    <h1 class="text-5xl font-bold text-center mt-5">ユーザー管理</h1>
</a>
<div class="container mx-auto px-4">
    <div class="flex justify-center mt-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
            <table id="values-table" class="min-w-full leading-normal rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-300">
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            No
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            氏名
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            Eメール
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            部署
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            ユーザー区分
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            ステータス
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-2xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            処理
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?= h($user->id) ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?= h($user->name) ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?= h($user->email) ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?= h($departments[$user->department] ?? '') ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?php if (isset($userTypes[$user->user_type])): ?>
                                    <span class="<?= $userTypes[$user->user_type]['class'] ?>">
                                        <?= $userTypes[$user->user_type]['name'] ?>
                                    </span>
                                <?php else: ?>
                                    <span class="bg-gray-200 text-gray-800 text-sm font-medium mr-2 px-2.5 py-1 rounded-full"></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?php if ($user->isOnline()): ?>
                                    <span class="bg-lime-300 text-gray-900 text-sm font-medium mr-2 px-2.5 py-1 rounded-full">ログイン中</span>
                                <?php else: ?>
                                    <span><?= $user->created_at->i18nFormat('yyyyMMdd HH:mm') ?></span>
                                    <!--$user->last_activity_date넣어야됨 원래는.-->
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <?php if ($user->user_type !== '777'): ?>
                                    <?= $this->Form->create(null, ['url' => ['action' => 'revokePermission', $user->id], 'style' => 'display:inline']) ?>
                                        <?= $this->Form->button('<i class="fa-regular fa-trash-can"></i> 権限削除', [
                                            'type' => 'submit',
                                            'escapeTitle' => false,
                                            'class' => 'text-rose-400 hover:text-rose-500 font-bold border-none',
                                            'onclick' => 'return confirm("本当に削除しますか?")'
                                        ]) ?>
                                    <?= $this->Form->end() ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <div class="flex justify-center">
                <?= $this->Paginator->paginate() ?>
            </div> -->
        </div>
    </div>
</div>
<script>
    function confirmDelete(event, userId) {
        event.preventDefault();
        const confirmed = confirm('本当に削除しますか?');
        if (confirmed) {
            alert('権限が削除されまして、承認待機処理しました。');
            window.location.href = event.currentTarget.href;
        }
    }
</script>