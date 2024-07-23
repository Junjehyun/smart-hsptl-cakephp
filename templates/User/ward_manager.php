<?php $this->assign('title', '病棟管理者'); ?>
<a href="/ward-manager">
    <h1 class="text-5xl font-bold text-center mt-5">病棟管理者</h1>
</a>
<div class="container mx-auto px-4">
    <div class="flex justify-center mt-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-full">
            <table id="values-table" class="min-w-full leading-normal rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-300">
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            No
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            氏名
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            Eメール
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            部署
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            病棟
                        </th>
                        <th class="px-5 py-3 bg-sky-50 text-left text-xl font-semibold text-gray-600 uppercase tracking-tighter whitespace-nowrap">
                            処理
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mergedUsers as $index => $user) : ?>
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-5 py-2 border-r whitespace-nowrap text-xl">
                                <?= $index + 1 ?>
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
                                <?php if (!empty($user->ward_managers)): ?>
                                    <?php foreach ($user->ward_managers as $ward): ?>
                                        <?= h($ward->ward_code) ?><br>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-2 border-r whitespace-nowrap">
                                <button type="button" class="bg-transparent hover:bg-sky-300 text-sky-600 font-semibold hover:text-white py-2 px-4 border border-sky-500 hover:border-transparent rounded wardControlBtn"  data-id="<?= $user->id ?>">
                                    病棟管理
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="updateWardModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50" style="display:none;">
        <div class="ward-modal bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <span class="close cursor-pointer text-gray-600 absolute top-4 right-4 text-2xl">&times;</span>
            <h2 class="text-2xl mb-4 text-center font-semibold">管理病棟修正</h2>
            <!-- <form id="updateWardForm" class="space-y-4"> -->
            <?= $this->Form->create(null, ['id' => 'updateWardForm', 'class' => 'space-y-4']) ?>
            <?= $this->Form->hidden('user_id', ['id' => 'user_id']) ?>
                <!-- <input type="hidden" name="user_id" id="user_id"> -->
                <hr class="mt-2 border-sky-100">
                    <div id="userNameDisplay" class="text-lg text-gray-700 font-medium text-center">
                    </div>
                <hr class="mt-2 border-sky-100">
                <div class="form-group mt-4 px-2 py-4 rounded-lg border-2 border-sky-100">
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="oneThousand" name="ward_code[]" value="1000" class="mr-2" {{ in_array('1000', old('ward_code', [])) ? 'checked' : '' }}>
                            <label for="ward1">1000病棟</label><br>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="twoThousand" name="ward_code[]" value="2000" class="mr-2">
                            <label for="ward2">2000病棟</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="threeThousand" name="ward_code[]" value="3000" class="mr-2">
                            <label for="ward3">3000病棟</label><br>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="fourThousand" name="ward_code[]" value="4000" class="mr-2">
                            <label for="ward4">4000病棟</label><br>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="fiveThousand" name="ward_code[]" value="5000" class="mr-2">
                            <label for="ward5">5000病棟</label><br>
                        </div>
                    </div>
                </div>
                <div class="flex items-center border-2 border-sky-100 rounded p-2 mt-4">
                    <input id="updateWard" type="checkbox" name="updateWard" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" autocompleted>
                    <label for="updateWard" class="ml-2 text-sm text-gray-900">
                        病棟変更を確認しました。
                    </label>
                </div>
                <div class="flex items-center justify-end space-x-2 mt-4">
                    <button type="button" id="updateCancelBtn" class="border-none inline-block rounded bg-gray-100 px-6 py-2 text-xs font-medium uppercase leading-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:ring-0 active:bg-gray-300" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light" style>
                        キャンセル
                    </button>
                    <button id="updateWardBtn" name="updateWardBtn" type="submit" class="border-none ml-1 inline-block rounded bg-sky-400 px-6 py-2 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-sky-600 focus:bg-sky-600 focus:outline-none focus:ring-0 active:bg-sky-700 disabled:bg-gray-300 disabled:cursor-not-allowed disabled:hover:bg-gray-300" disabled>
                        変更
                    </button>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateWardModal = document.getElementById('updateWardModal');
        const wardControlButtons = document.querySelectorAll('.wardControlBtn');
        const updateCancelBtn = document.getElementById('updateCancelBtn');
        const closeModalBtn = document.querySelector('.close');
        const updateWardForm = document.getElementById('updateWardForm');
        const wardManagerUrl = <?= json_encode($this->Url->build(['action' => 'getWardManager', '_full' => true])) ?>;
        const wardUpdateUrl = <?= json_encode($this->Url->build(['action' => 'wardUpdate', '_full' => true])) ?>;

        wardControlButtons.forEach(button => {

            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                
                document.getElementById('user_id').value = userId;

            //病棟管理モーダル表示ロジック
            $.ajax({
                url: wardManagerUrl + '/' + userId,
                type: 'GET',
                datatype: 'json',
                success: function (data) {
                    const wardCodes = data.ward_codes;
                    document.querySelectorAll('input[name="ward_code[]"]').forEach(checkbox => {
                        checkbox.checked = wardCodes.includes(checkbox.value);
                    });
                    updateWardModal.style.display = 'flex'; 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('病棟管理情報を取得できませんでした。: ' + textStatus);
                }
            });    
        });
    });

        closeModalBtn.addEventListener('click', function () {
            updateWardModal.style.display = 'none';
        });

        updateCancelBtn.addEventListener('click', function () {
            updateWardModal.style.display = 'none';
        });

        updateWardForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const userId = document.getElementById('user_id').value;
            const wardCodes = Array.from(document.querySelectorAll('input[name="ward_code[]"]:checked')).map(cb => cb.value);

            console.log(wardCodes);

            $.ajax({
                url: wardUpdateUrl + '/' + userId,
                type: 'POST',
                datatype: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ ward_code: wardCodes }),
                headers: {
                    'X-CSRF-Token': <?= json_encode($this->request->getAttribute('csrfToken')); ?>,
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        alert('病棟が正常に更新されました。 정상처리');
                        location.reload();
                    } else {
                        alert('更新できませんでした。: ' + data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                    alert('更新できませんでした。: ' + textStatus);
                }
            });
        });
        document.getElementById('updateWard').addEventListener('change', function() {
        document.getElementById('updateWardBtn').disabled = !this.checked;
    });
});
</script>