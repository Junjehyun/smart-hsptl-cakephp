<?php $this->assign('title', '患者情報編集'); ?>
<a href="/kanjaEdit">
    <h1 class="text-5xl font-bold text-center mt-5">患者情報編集</h1>
</a>
<?= $this->Form->create($customer, ['url' => ['action' => 'kanjaEdit', $customer->customer_no], 'type' => 'post']) ?>
    <div class="container mx-auto max-w-6xl flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
        <!-- 個人情報Section -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">患者情報</h2>   
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">氏名 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('name', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:bg-gray-200 cursor-not-allowed',
                        'placeholder' => '氏名',
                        'disabled' => true
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
                        <?php
                            $birthYear = substr($customer->birthdate, 0, 4);
                            $birthMonth = (int) substr($customer->birthdate, 4, 2);
                            $birthDay = (int) substr($customer->birthdate, 6, 2);
                        ?>
                        <?= $this->Form->control('birth_year', [
                            'type' => 'select',
                            'options' => array_combine(range(1900, date('Y')), range(1900, date('Y'))),
                            'label' => false,
                            'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                            'value' => $birthYear
                        ]) ?>
                        <?= $this->Form->control('birth_month', [
                            'type' => 'select',
                            'options' => array_combine(range(1, 12), range(1, 12)),
                            'label' => false,
                            'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                            'value' => $birthMonth
                        ]) ?>
                        <?= $this->Form->control('birth_day', [
                            'type' => 'select',
                            'options' => array_combine(range(1, 31), range(1, 31)),
                            'label' => false,
                            'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                            'value' => $birthDay
                        ]) ?>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">性別 <span class="text-red-500">必須</span></label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="sex" value="M" class="form-radio" <?= $customer->sex === 'M' ? 'checked' : '' ?>>
                            <span class="ml-2">男</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="sex" value="F" class="form-radio" <?= $customer->sex === 'F' ? 'checked' : '' ?>>
                            <span class="ml-2">女</span>
                        </label>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">入院日付 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('hospitalized_date', [
                        'label' => false,
                        'type' => 'date',
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '入院日選択(YYYY-MM-DD)'
                    ]) ?>
                    <?php if (!empty($errors['hospitalized_date'])): ?>
                        <?php foreach ($errors['hospitalized_date'] as $error): ?>
                            <div class="text-red-500"><?= h($error) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">血液型 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('blood_type', [
                        'type' => 'select',
                        'options' => $bloodTypes,
                        'empty' => false,
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400'
                    ]) ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">電話番号 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('telephone', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '電話番号'
                    ]) ?>
                </div>
                <div class="flex flex-col col-span-2">
                    <label class="mb-1 text-sm text-gray-600">住所</label>
                    <?= $this->Form->control('address', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '住所'
                    ]) ?>
                </div>
            </div>
        </div>
        <!-- 診療情報Section -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
            <h3 class="text-2xl font-bold mb-4">診療情報</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">診療科 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('medical_info.department', [
                        'type' => 'select',
                        'options' => $departments,
                        'empty' => false,
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400'
                    ]) ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">担当医名 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('medical_info.doctor_name', [
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '担当医名'
                    ]) ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">重症度 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('severity', [
                        'type' => 'select',
                        'options' => $severities,
                        'empty' => false,
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'value' => $customer->severity
                    ]) ?>
                </div>
                <div class="flex flex-col">
                    <label class="mb-1 text-sm text-gray-600">落傷 <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('fall', [
                        'type' => 'select',
                        'options' => $falls,
                        'empty' => false,
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'value' => $customer->fall
                    ]) ?>
                </div>
                <div class="flex flex-col col-span-2">
                    <label class="mb-1 text-sm text-gray-600">注意事項</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="medical_info[blood_warn]" <?= $customer->medical_info->blood_warn ? 'checked' : '' ?>>
                            <span class="ml-2">血液</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="medical_info[contact_warn]" <?= $customer->medical_info->contact_warn ? 'checked' : '' ?>>
                            <span class="ml-2">接触主義</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="medical_info[air_warn]" <?= $customer->medical_info->air_warn ? 'checked' : '' ?>>
                            <span class="ml-2">空気注意</span>
                        </label>
                    </div>
                </div>
                <div class="flex flex-col col-span-2">
                    <label class="mb-1 text-sm text-gray-600">重要事項</label>
                    <?= $this->Form->control('medical_info.remarks', [
                        'type' => 'textarea',
                        'label' => false,
                        'class' => 'border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400',
                        'placeholder' => '重要事項'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-4">
        <?= $this->Form->button(__('修正'), [
                'class' => 'bg-sky-400 hover:bg-sky-600 text-white font-bold h-15 py-2 px-4 rounded focus:outline-none focus:shadow-outline border-none'
            ]) ?>
    </div>
<?= $this->Form->end() ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const yearSelect = document.getElementById('year');
    const monthSelect = document.getElementById('month');
    const daySelect = document.getElementById('day');

    yearSelect.innerHTML = '<option value="">年</option>';
    monthSelect.innerHTML = '<option value="">月</option>';
    daySelect.innerHTML = '<option value="">日</option>';

    const currentYear = new Date().getFullYear();
    for (let i = 1940; i <= currentYear; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        yearSelect.appendChild(option);
    }

    for (let i = 1; i <= 12; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        monthSelect.appendChild(option);
    }

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

    fillDays(currentYear, 1);

    yearSelect.addEventListener('change', function() {
        fillDays(yearSelect.value, monthSelect.value);
    });

    monthSelect.addEventListener('change', function() {
        fillDays(yearSelect.value, monthSelect.value);
    });

    const dateInput = document.getElementById('hospitalized_date');
    dateInput.addEventListener('focus', (e) => {
        dateInput.type = 'date';
    });
    dateInput.addEventListener('blur', (e) => {
        dateInput.type = 'text';
        dateInput.placeholder = "入院日選択(YYYY-MM-DD)";
    });
});
</script>
