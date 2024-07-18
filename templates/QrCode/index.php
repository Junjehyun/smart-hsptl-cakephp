<?php $this->assign('title', 'QRコード登録'); ?>
<a href="/qr-index">
    <h1 class="text-5xl font-bold text-center mt-5">QRコード登録</h1>
</a>
<div class="container p-6 py-8">
    <div class="flex-grow text-left mt-5">
        <button id="startReaderBtn" type="button" class="border-none bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15">QReader開始</button>
        <button id="restartReaderBtn" type="button" class="border-none bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15">再開始</button>
        <button id="stopReaderBtn" type="button" class="border-none bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15">STOP</button>
    </div>
    <h2 class="mt-3 font-semibold">
        [QRreader開始]ボタンでReaderが起動されます。
    </h2>
</div>
<div id="qr-reader" style="width:500px; transform: scaleX(-1);"></div>  
<div id="qr-reader-results"></div>  
<button id="fillDetailsBtn" type="button" class="border-none bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15">
    反映
</button>
<?= $this->Form->create(null, ['url' => ['action' => 'saveQrCode']]); ?>
    <div class="container flex justify-left max-w-8xl p-5 py-8">
        <div class="bg-white p-6 rounded-lg shadow space-y-3 w-1/2">
            <h2 class="font-bold text-xl text-gray-800">基本情報</h2>
            <hr class="mb-4 border-sky-200">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">SerialNo <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('tag_id', ['type' => 'text', 'id' => 'serialNoInput', 'label' => false, 'placeholder' => 'Serial No', 'class' => 'rounded']); ?>
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">MAC アドレス <span class="text-red-500">必須</span></label>
                    <?= $this->Form->control('mac_address', ['id' => 'macAddressInput', 'label' => false, 'placeholder' => 'MAC アドレス', 'class' => 'rounded']); ?>
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div class="flex flex-col">
                    <label class="mb-1 text-m text-gray-600">タグのタイプ <span class="text-red-500">必須</span></label>
                    <div class="flex flex-row">
                        <div>
                            <?= $this->Form->radio('tag_type', [['value' => '1', 'text' => '病室', 'id' => 'roomType'], ['value' => '2', 'text' => 'ベッド', 'id' => 'bedType']]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <?= $this->Form->button('登録', ['class' => 'border-none bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline h-15']); ?>
            </div>
        </div>
    </div>
<?= $this->Form->end(); ?>
<script>
    const startReaderBtn = document.getElementById('startReaderBtn');
    const restartReaderBtn = document.getElementById('restartReaderBtn');
    const stopReaderBtn = document.getElementById('stopReaderBtn');
    const qrCodeReader = new Html5Qrcode("qr-reader");
    const qrReaderElement = document.getElementById('qr-reader');
    let qrCodeData = '';
    //反映ボタン
    const fillDetailsBtn = document.getElementById('fillDetailsBtn');
    fillDetailsBtn.style.display = 'none';

    // 撮影スタート
    startReaderBtn.addEventListener('click', () => {
        qrReaderElement.style.display = 'block';
        startReaderBtn.style.display = 'none';
        fillDetailsBtn.style.display = 'block';
        //撮影スタート
        qrCodeReader.start(
            { facingMode: 'environment' },
            { fps: 10, qrbox: 250 },
            (decodedText, decodedResult) => {
                document.getElementById('qr-reader-results').innerHTML = `QRコードの情報: <span style="color: red;">${decodedText}</span>`;
                console.log(`QRコードの取得に成功しました: ${decodedText}`);
                qrCodeData = decodedText;
            },
            (errorMessage) => {
            }
        ).catch((err) => {
            console.log(`スキャニングができません。 エラーメッセージ: ${err}`);
        });
    });

    // 停止ボタンの機能
    stopReaderBtn.addEventListener('click', () => {
        qrCodeReader.stop().then((ignore) => {
            console.log("QRコードスキャニングが停止しました。");
            qrReaderElement.style.display = 'none';
            fillDetailsBtn.style.display = 'none';
        }).catch((err) => {
            console.log(`QRコードスキャニングが停止できません。 エラーメッセージ: ${err}`);
        });
    });

    // 再開ボタンの機能
    restartReaderBtn.addEventListener('click', () => {
        qrReaderElement.style.display = 'block';
        fillDetailsBtn.style.display = 'block';
        qrCodeReader.start(
            { facingMode: 'environment' },
            { fps: 10, qrbox: 250 },
            ( decodedText, decodedResult ) => {
                document.getElementById('qr-code-results').innerHTML = `QR Code detected: ${decodedText}`;
                console.log(`QRコードの取得に成功しました: ${decodedText}`);
            },
            (errorMessage) => {
            }
        ).catch((err) => {
            console.log('スキャニングができません。 エラーメッセージ: ${err}');
        });
    });

    // 反映ボタンの機能
    fillDetailsBtn.addEventListener('click', () =>{
        if(qrCodeData) {
            const url = new URL(qrCodeData);
            const params= new URLSearchParams(url.search);

            document.getElementById('serialNoInput').value = params.get('serial_no') || '';
            document.getElementById('macAddressInput').value = params.get('mac_address') || '';
            const tagType = params.get('tag_type');
            if (tagType === '01') {
                document.getElementById('roomType').checked = true;
            } else if (tagType === '02') {
                document.getElementById('bedType').checked = true;
            }
        } else {
            alert('QRコードがまだスキャンされていません。');
        }
    });
</script>