<?php $this->assign('title', '未承認ユーザー'); ?>
<a href="/user-approval">
    <h1 class="text-5xl font-bold text-center mt-5">未承認ユーザー</h1>
</a>
<div class="container mx-auto px-4">
    <div class="flex justify-center mt-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
            <table id="values-table" class="min-w-full leading-normal rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-300">
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            No
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            氏名
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            Eメール
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            部署
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            病棟
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            ステータス
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semi-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            処理
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                <?= h($user->id) ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                <?= h($user->name) ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                <?= h($user->email) ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                
                                <?= h($departments[$user->department] ?? '') ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                <?= h($user->ward_manager->ward_code ?? '') ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                <?php $userType = $userTypes[$user->user_type]; ?>
                                <span class="<?= h($userType['class']) ?>">
                                    <?= h($userType['name']) ?>
                                </span>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <button type="button" class="bg-transparent hover:bg-sky-300 text-sky-600 font-semibold hover:text-white py-2 px-4 border border-sky-500 hover:border-transparent rounded approveBtn"  data-id="<?= $user->id ?>" data-name="<?= $user->name ?>">
                                    承認処理
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="approvalModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50" style="display:none;">
    <div class="modal-content bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <span class="close cursor-pointer text-gray-600 absolute top-4 right-4 text-2xl">&times;</span>
        <h2 class="text-2xl mb-4 text-center font-semibold">ユーザー承認</h2>
        <?= $this->Form->create(null, [
            'url' => ['controller' => 'User', 'action' => 'userApprovalRegistration', ':id'], 
            'id' => 'approvalForm']) ?>
            <input type="hidden" name="user_id" id="user_id">
            <hr class="mt-2 border-sky-100">
            <div id="userNameDisplay" class="text-lg text-gray-700 font-medium text-center"></div>
            <hr class="mt-2 border-sky-100">
            <div class="form-group mt-4 px-2 py-4 rounded-lg border-2 border-sky-100">
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="radio" id="wardKanrisha" name="user_type" value="005" class="mr-2">
                        <label for="wardKanrisha">病棟管理者</label><br>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="admin" name="user_type" value="001" class="mr-2">
                        <label for="admin">スタッフ</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="unApproval" name="user_type" value="009" class="mr-2">
                        <label for="unApproval">未承認</label><br>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="kanrisha" name="user_type" value="007" class="mr-2">
                        <label for="kanrisha">管理者</label><br>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center border-2 border-sky-100 rounded p-2 mt-4">
                <input id="confirmApprove" type="checkbox" name="confirmApprove" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                <label for="confirmApprove" class="ml-2 text-sm text-gray-900">
                    ユーザーのタイプを確認しました。
                </label>
            </div>
            <div class="flex items-center justify-end space-x-2 mt-4">
                <button type="button" id="cancelBtn" class="border-none inline-block rounded bg-gray-100 px-6 py-2 text-xs font-medium uppercase leading-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 focus:bg-gray-200 focus:outline-none active:bg-gray-300">
                    キャンセル
                </button>
                <button id="approveBtn" name="approveBtn" type="submit" class="border-none ml-1 inline-block rounded bg-sky-400 px-6 py-2 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-sky-600 focus:bg-sky-600 focus:outline-none active:bg-sky-700">
                    登録
                </button>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('approvalModal');
        const userNameDisplay = document.getElementById('userNameDisplay');
        const userIdInput = document.getElementById('user_id');
        const closeBtn = document.querySelector('.close');
        const openModalBtns = document.querySelectorAll('.approveBtn');
        const approvalForm = document.getElementById('approvalForm');
        const cancelBtn = document.getElementById('cancelBtn');

        openModalBtns.forEach(button => {
            button.addEventListener('click', function () {
                const userName = this.getAttribute('data-name');
                const userId = this.getAttribute('data-id');

                userNameDisplay.innerHTML = `<span class="text-sky-500">${userName}</span>様のユーザー情報を変更します。`;
                userIdInput.value = userId;

                modal.style.display = 'flex';
            });
        });

        cancelBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        approvalForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const userId = userIdInput.value;
            const userType = approvalForm.querySelector('input[name="user_type"]:checked').value;
            const confirmApprove = approvalForm.querySelector('#confirmApprove').checked;

            if (!confirmApprove) {
                alert('ユーザーのタイプを確認してください。');
                return;
            }

            $.ajax({
                url: '/user-approval-registration/' + userId,
                type: 'POST',
                data: {
                    user_id: userId,
                    user_type: userType,
                    _csrfToken: $('input[name="_csrfToken"]').val()
                },
                success: function(response) {
                    console.log("Response from server:", response);
                    alert('ユーザー承認を完了しました。');
                    modal.style.display = 'none';
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('エラーが発生しました。');
                }
            });
        });
    });

</script>