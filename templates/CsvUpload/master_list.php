<?php $this->assign('title', 'マスターデータ一覧'); ?>
<a href="/master-list">
    <h1 class="text-5xl font-bold text-center mt-5">マスターデータ一覧</h1>
</a>
<div class="container mx-auto p-5 py-8 mt-8 max-w-5xl">
    <div class="flex justify-center max-w-5xl mx-auto p-5 py-8 mt-8">
        <div class="bg-white p-6 rounded-lg shadow-xl space-y-3 w-full">
            <label for="master" class="block text-blue-400 font-medium text-base sm:text-xl md:text-2xl lg:text-3xl text-center">
                ※マスターデータ選択で内容が確認できます。
            </label>
            <div class="mt-8">
                <select id="master" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <?php foreach ($masters as $index => $master): ?>
                        <option value="<?= h($master) ?>" <?= $index === 0 ? 'selected' : '' ?>><?= h($master) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="values" class="mt-8">
                <table id="values-table" class="min-w-full leading-normal rounded-lg shadow">
                <!-- <table id="values-table" class="w-1/4 sm:w-1/3 md:w-1/2 lg:w-full  leading-normal rounded-lg shadow"> -->
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-300">
                            <th class="px-5 py-3 bg-sky-50 text-left text-xl font-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">NO</th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-xl font-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">コード名</th>
                            <th class="px-5 py-3 bg-sky-50 text-left text-xl font-bold text-gray-600 uppercase tracking-tighter whitespace-nowrap">表示名</th>
                        </tr>
                    </thead>
                    <tbody id="valuesBody">
                        <!-- Data will be added here via AJAX -->
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const masterSelect = $('#master');
        const valuesBody = $('#valuesBody');
        const csrfToken = '<?= $this->request->getAttribute('csrfToken') ?>';
        const url = '<?= $this->Url->build(['controller' => 'CsvUpload', 'action' => 'getValuesByMasterName']) ?>';

        function masterData(masterName) {
            $.ajax({
                url: url,
                type: 'POST',
                data: JSON.stringify({ master_name: masterName }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-Token': '<?= $this->request->getAttribute('csrfToken') ?>'
                },
                success: function(data) {
                    valuesBody.empty();
                    if (data.values) {
                        data.values.forEach(function(item, index) {
                            const tr = $('<tr>').addClass('hover:bg-gray-50 border-b');
                            tr.append($('<td>').addClass('px-5 py-2 border-r whitespace-nowrap text-xl').text(index + 1));
                            tr.append($('<td>').addClass('px-5 py-2 border-r whitespace-nowrap text-xl').text(item.item_code));
                            const itemName = (masterName === '重症度' || masterName === '落傷') ? item.item_nm_short : item.item_name;
                            tr.append($('<td>').addClass('px-5 py-2 border-r whitespace-nowrap text-xl').text(itemName));
                            valuesBody.append(tr);
                        });
                    } else {
                        valuesBody.append('<tr><td colspan="3">No data found</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        masterData(masterSelect.val());
        masterSelect.on('change', function() {
            masterData($(this).val());
        });
    });
</script>