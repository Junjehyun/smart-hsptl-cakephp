<?php $this->assign('title', 'CSVマスターデータアップロード'); ?>
<a href="/csv-upload">
    <h1 class="text-4xl font-semi-bold text-center mt-5">CSVマスターデータアップロード</h1>
</a>
<div class="container mt-8">
    <div class="flex justify-center">
        <div class="w-half">
            <div class="bg-white shadow-md border border-gray-300 rounded-md">
                <div class="p-6 flex justify-center">
                    <?= $this->Form->create(null, ['type' => 'file']) ?>    
                        <div class="mb-5">
                            <label for="csv_file" class="block text-center">CSV ファイル</label>
                            <?= $this->Form->file('csv_file', 
                            [
                                'class' => 'bg-gray-100 border-sky-300 text-2xl focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md'
                            ]) ?>
                            <?= $this->Form->button('Upload', 
                            [
                                'class' => 'bg-sky-400 hover:bg-sky-600 text-xl text-white px-3 h-11 rounded-md border-none mt-3'
                            ]) ?>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>