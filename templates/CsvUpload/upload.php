<?php $this->assign('title', 'CSVマスターデータアップロード'); ?>
<a href="/csv-upload">
    <h1 class="text-5xl font-bold text-center mt-5">CSVマスターデータアップロード</h1>
</a>
<div class="container mt-5">
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="bg-white shadow-md border border-gray-300 rounded-md">
                <div class="p-6">
                    <!-- <form method="post" action="/upload" enctype="multipart/form-data"> -->
                    <?= $this->Form->create(null, ['type' => 'file']) ?>    
                        <div class="mb-5">
                            <label for="csv_file" class="block">CSV ファイル</label>
                            <!-- <input type="file" id="csv_file" name="csv_file" class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md">
                            <button type="submit" class="bg-sky-400 text-white px-4 py-2 rounded-md border-none">Upload</button> -->
                            <?= $this->Form->file('csv_file', ['class' => 'border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md']) ?>
                            <?= $this->Form->button('Upload', ['class' => 'bg-sky-400 text-white px-4 py-2 rounded-md border-none mt-3']) ?>
                        </div>
                    <!-- </form> -->
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>