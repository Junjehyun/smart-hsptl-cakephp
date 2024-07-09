<?php $this->assign('title', '患者新規登録'); ?>
<a href="/kanjaCreate">
    <h1 class="text-5xl font-bold text-center mt-5">患者新規登録</h1>
</a>
<?= $this->Form->create(null, ['url' => ['action' => 'kanjaCreate']]) ?>
    <div class="container mx-auto max-w-6xl flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
        <!-- 個人情報Section -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">患者情報</h2>   
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">氏名 <span class="text-red-500">必須</span></label>
                    <input name="name" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="氏名">
                </div> -->
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">氏名 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('name', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '氏名',
                        'value' => $data['name'] ?? ''
                    ]) ?>
                    <?php if (!empty($errors['name'])): ?>
                        <?php foreach ($errors['name'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">生年月日 <span class="text-red-500">必須</span></label>
                    <div class="flex space-x-2">
                        <select id="year" name="birth_year" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/3">
                        </select>
                        <select id="month" name="birth_month" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/4">
                        </select>
                        <select id="day" name="birth_day" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/4">
                        </select>
                    </div>
                    <?php if (!empty($errors['birthdate'])): ?>  
                        <?php foreach ($errors['birthdate'] as $error): ?>  
                            <div class="text-red-500"><?= h($error) ?></div>  
                        <?php endforeach; ?>  
                    <?php endif; ?>  
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">性別 <span class="text-red-500">必須</span></label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="sex" value="M" class="form-radio" <?= isset($data['sex']) && $data['sex'] === 'M' ? 'checked' : '' ?>>
                            <span class="ml-2">男</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="sex" value="F" class="form-radio" <?= isset($data['sex']) && $data['sex'] === 'F' ? 'checked' : '' ?>>
                            <span class="ml-2">女</span>
                        </label>
                        <?php if (!empty($errors['sex'])): ?>
                            <?php foreach ($errors['sex'] as $error): ?>
                                <div class="text-red-500"><?= h($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">入院日付 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('hospital_date', [
                        'label' => false,
                        'type' => 'date',
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '入院日選択(YYYY-MM-DD)',
                        'value' => $data['hospital_date'] ?? ''
                    ]) ?>
                    <?php if (!empty($errors['hospital_date'])): ?>
                        <?php foreach ($errors['hospital_date'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class=""flex flex-col>
                    <label class="mb-1 text-sm text-gray-600">血液型 <span class="text-red-500">必須</span></label>
                    <select name="blood_type" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option>※選択して下さい</option>
                        <?php foreach ($bloodTypes as $bloodType): ?>
                            <option value="<?= h($bloodType->item_code) ?>" <?= isset($data['blood_type']) && $data['blood_type'] === $bloodType->item_code ? 'selected' : '' ?>>
                                <?= h($bloodType->item_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['blood_type'])): ?>
                        <?php foreach ($errors['blood_type'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">電話番号 <span class="text-red-500">必須</span></label>
                    <!-- <input name="telephone" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="電話番号"> -->
                    <?= $this->Form->control('telephone', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '電話番号',
                        'value' => $data['telephone'] ?? ''
                    ]) ?>
                    <?php if (!empty($errors['telephone'])): ?>
                        <?php foreach ($errors['telephone'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col col-span-2">
                    <label class="mb-1 text-sm text-gray-600">住所</label>
                    <input name="address" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="住所">
                </div>
            </div>
        </div>
        <!-- 診療情報Section -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
            <h3 class="text-2xl font-bold mb-4">診療情報</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">診療科 <span class="text-red-500">必須</span></label>
                    <select name="department" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option>※選択して下さい</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= h($department->item_code) ?>" <?= isset($data['department']) && $data['department'] === $department->item_code ? 'selected' : '' ?>>
                                <?= h($department->item_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['department'])): ?>
                        <?php foreach ($errors['department'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">担当医名 <span class="text-red-500">必須</span></label>
                    <!-- <input name="doctor_name" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" placeholder="担当医名"> -->
                    <?= $this->Form->control('doctor_name', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '担当医名',
                        'value' => $data['doctor_name'] ?? ''
                    ]) ?>
                    <?php if (!empty($errors['doctor_name'])): ?>
                        <?php foreach ($errors['doctor_name'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">重症度 <span class="text-red-500">必須</span></label>
                    <select name="severity" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option>※選択して下さい</option>
                        <?php foreach ($severities as $severity): ?>
                            <option value="<?= h($severity->item_code) ?>" <?= isset($data['severity']) && $data['severity'] === $severity->item_code ? 'selected' : '' ?>>
                                <?= h($severity->item_nm_short) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['severity'])): ?>
                        <?php foreach ($errors['severity'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">落傷 <span class="text-red-500">必須</span></label>
                    <select name="fall" class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option>※選択して下さい</option>
                            <?php foreach ($falls as $fall): ?>
                                <option value="<?= h($fall->item_code) ?>" <?= isset($data['fall']) && $data['fall'] === $fall->item_code ? 'selected' : '' ?>>
                                    <?= h($fall->item_nm_short) ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['fall'])): ?>
                        <?php foreach ($errors['fall'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col col-span-2">
                    <label class="mb-1 text-sm text-gray-600">注意事項</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="blood_warn">
                            <span class="ml-2">血液</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="contact_warn">
                            <span class="ml-2">接触主義</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="air_warn">
                            <span class="ml-2">空気注意</span>
                        </label>
                    </div>
                </div>
                <div class="flex flex-col col-span-2">
                    <label class="mb-1 text-sm text-gray-600">重要事項</label>
                    <textarea class="border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="重要事項" name="remarks"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-4">
        <?= $this->Form->button(__('登録する'), ['class' => 'bg-sky-400 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15 border-none']) ?>
    </div>
<?= $this->Form->end() ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const yearSelect = document.getElementById('year');
        const monthSelect = document.getElementById('month');
        const daySelect = document.getElementById('day');

        // 入力値を残す
        const birthYear = <?= json_encode($data['birth_year'] ?? '') ?>;  
        const birthMonth = <?= json_encode($data['birth_month'] ?? '') ?>;  
        const birthDay = <?= json_encode($data['birth_day'] ?? '') ?>;  

        // 初期Optionのバリュー
        yearSelect.innerHTML = '<option value="">年</option>';
        monthSelect.innerHTML = '<option value="">月</option>';
        daySelect.innerHTML = '<option value="">日</option>';

        //現在の年度
        const currentYear = new Date().getFullYear();
        //年の選択肢を生成 (1940~現在の年度)
        for (let i = 1940; i <= currentYear; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }

        //月の選択肢を生成 (1~12)
        for (let i = 1; i <= 12; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            monthSelect.appendChild(option);
        }

        //日の選択肢を生成 (1~31)
        function fillDays(year, month) {
            daySelect.innerHTML = '<option value="">日</option>';
            const daysInMonth = new Date(year, month, 0).getDate();
            for (let i = 1; i <= daysInMonth; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                daySelect.appendChild(option);
            }
        }

        // 初期日を設定
        fillDays(currentYear, 1);

        // 年が変更されたら日数を更新
        yearSelect.addEventListener('change', function() {
            fillDays(yearSelect.value, monthSelect.value);
        });

        // 月が変更されたら日数を更新
        monthSelect.addEventListener('change', function() {
            fillDays(yearSelect.value, monthSelect.value);
        });

        //カレンダーのOption
        const dateInput = document.getElementById('hospital_date');
                hospital_date.addEventListener('focus', (e) => {
                dateInput.type = 'date';
                
            });
            dateInput.addEventListener('blur', (e) => {
                dateInput.type = 'text';
                dateInput.placeholder = "入院日選択(YYYY-MM-DD)";
        });

        // 入力値を残す
        if (birthYear) yearSelect.value = birthYear;
        if (birthMonth) monthSelect.value = birthMonth;
        if (birthDay) daySelect.value = birthDay;

    });
</script>