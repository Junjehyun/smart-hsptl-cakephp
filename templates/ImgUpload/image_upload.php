<?php $this->assign('title', 'イメージロゴ登録'); ?>
<a href="/image-upload">
    <h1 class="text-5xl font-bold text-center mt-5">イメージロゴ登録</h1>
</a>
<?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'imageToroku']]) ?>
    <div class="container flex justify-center max-w-8xl p-5 py-8">
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
            <div class="flex flex-col">
                <label class="mb-1 text-m text-gray-600">施設名 <span class="text-red-500 text-sm">必須</span></label>
                <?= $this->Form->input('name', [
                    'id' => 'facility_name',
                    'type' => 'text', 'class' => 
                    'mt-1 p-2 w-full border border-gray-300 rounded', 
                    'placeholder' => '施設名を入力して下さい', 
                    'value' => $facility->name ?? ''
                    ]) ?>
            </div>
            <div class="flex flex-col mt-5">
                <label class="mb-1 text-m text-gray-600">ロゴファイル <span class="text-red-500 text-sm">必須</span></label>
                <?= $this->Form->file('hsptl_image', [
                    'id' => 'hsptl_image',
                    'class' => 'block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded', 
                    'aria-describedby' => 'file_input_help'
                    ]) ?>
                <p class="text-sm text-gray-500 mt-2" id="file_input_help">PNG, JPG, or GIF (MAX, 800x400px).</p>
            </div>
            <div class="flex flex-col sm:flex-row items-center mt-5">
                <div class="w-full sm:w-2/3 lg:w-1/2 sm-flex mt-5" id="logoImageContainer">
                    <?php if ($logoPath): ?>
                        <img src="<?= $this->Url->assetUrl($logoPath) ?>" alt="Logo" 
                        class="w-full h-auto max-h-40 object-contain" 
                        id="logoImage">
                    <?php else: ?>
                        <span class="ml-3 text-sm" id="defaultText">画像を選択してください</span>
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <button type="button" id="imgDelBtn" class="bg-red-400 hover:bg-red-500 font-bold text-center text-white p-2 my-2 sm:my-0 sm:mx-2 rounded w-14 sm:w-16 h-10 sm:h-12 shrink-0">삭제</button>
                </div>
            </div>
            <div class="sm:grid grid-cols-2 gap-4 mt-5">
                <div class="flex flex-col mb-4">
                    <label class="mb-1 text-lg text-gray-600">ライセンス数 <span class="text-red-500 text-sm">必須</span></label>
                    <?= $this->Form->input('license_count', 
                    ['type' => 'text',
                    'class' => 'mt-1 p-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent', 
                    'value' => $facility->license_count ?? 100]) 
                    ?>
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-1 text-lg text-gray-600">言語 <span class="text-red-500 text-sm">必須</span></label>
                    <?= $this->Form->select('lang_type', [
                        '01' => '韓国語', 
                        '02' => '英語', 
                        '03' => '日本語'
                        ], [
                        'class' => 'mt-1 p-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent',
                        'value' => $facility->lang_type ?? '01']) ?>
                </div>
            </div>
            <div class="flex justify-center space-x-4 mt-8">
                <?= $this->Form->button(__('適用'), [
                    'type' => 'submit',
                    'id' => 'applyImg',
                    'class' => 'rounded-lg font-bold shadow my-4 px-16 py-2 mt-8 text-white bg-sky-400 hover:bg-sky-500 focus:bg-sky-600 border-none']) 
                ?>
            </div>
        </div>
    </div>
<?= $this->Form->end() ?>
<script>
    $(document).ready(function() {
        // 画像選択したとき、プレビュー表示
        var hsptlImage = document.getElementById('hsptl_image');

        if (hsptlImage) {
            hsptlImage.addEventListener('change', function (event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var newSrc = e.target.result + '?t=' + new Date().getTime();
                        if (document.getElementById('logoImage')) {
                            document.getElementById('logoImage').setAttribute('src', e.target.result);
                        } else {
                            document.getElementById('defaultText').style.display = 'none';
                            document.getElementById('logoImageContainer').innerHTML = '<img src="' + e.target.result + '" alt="Logo" class="w-full h-auto max-h-40 object-contain" id="logoImage">';
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        }
        // 画像削除
        $('#imgDelBtn').on('click', function () {
            $.ajax({
                url: '<?= $this->Url->build(['action' => 'imageDelete']) ?>',
                type: 'DELETE',
                headers: {
                    'X-CSRF-Token': '<?= $this->request->getAttribute('csrfToken') ?>'
                },
                success: function (response) {
                    if (response.success) {
                        $('#logoImage').remove();
                        $('#logoImageContainer').html('<span class="ml-3 text-sm" id="defaultText">イメージをアップロードしてください。</span>');
                        $('#hsptl_image').val('');
                    } else {
                        alert('画像削除が失敗しました。: ' + response.error);
                    }
                },
                error: function (xhr, status, error) {
                    alert('エラーが発生しました。: ' + error);
                }
            });
        });
        // 画像適用
        $('#applyImg').on('click', function () {
            $('#imageForm').submit();
        });
        // 画像が選択された場合、デフォルトテキストを非表示
        if ($('#logoImage').length > 0) {
            $('#defaultText').hide();
        }
    });
</script>