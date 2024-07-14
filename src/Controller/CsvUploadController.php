<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Http\Exception\NotFoundException;
/**
 * CsvUpload Controller
 *
 * @method \App\Model\Entity\CsvUpload[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CsvUploadController extends AppController
{

    /**
     * 初期化
     * 
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Masters = TableRegistry::getTableLocator()->get('Masters'); 
    }


    /**
     * CSV ファイルアップロード
     * 
     * @return \Cake\Http\Response|null|void
     * @throws \Exception
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \TypeError
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     *
     */
    public function upload() {
        if ($this->request->is('post')) {
            $file = $this->request->getData('csv_file');
            if ($file && $file->getClientFilename()) {
                $fileStream = $file->getStream()->getMetadata('uri');
                $fileHandle = fopen($fileStream, 'r');
                if ($fileHandle !== false) {
                    $mastersTable = TableRegistry::getTableLocator()->get('Masters');
                    while (($data = fgetcsv($fileHandle)) !== false) {
                        $masterData = [
                            'master_key' => $data[0],
                            'master_name' => $data[1],
                            'item_code' => $data[2],
                            'item_name' => $data[3],
                            'item_nm_short' => $data[4] ?? null,
                            'item_nm_eng' => $data[5] ?? null,
                            'sort_order' => isset($data[6]) ? (int)$data[6] : null,
                            'use_flag' => isset($data[7]) ? (bool)$data[7] : true,
                            'remarks' => $data[8] ?? null
                        ];
                        $masterEntity = $mastersTable->newEntity($masterData);
                        $mastersTable->save($masterEntity);
                    }
                    fclose($fileHandle);
                }
                $this->Flash->success(__('CSVファイルがアップロードされ、処理されました。'));
                return $this->redirect(['action' => 'upload']);
            } else {
                $this->Flash->error(__('CSVファイルのアップロードに失敗しました。'));
            }
        }
    }

    /**
     * マスターリスト表示
     * 
     * @return void
     * 
     */
    public function masterList() {
        $masters = $this->Masters->find('list', [
            'keyField' => 'master_name',
            'valueField' => 'master_name'
        ])->toArray();
        $this->set(compact('masters'));
    }

    /**
     * 
     * マスター名に紐づく値を取得
     * 
     * @return void
     */
    public function getValuesByMasterName()
    {
        $this->request->allowMethod(['post']);
        $masterName = $this->request->getData('master_name');

        $values = $this->Masters->find('all')
            ->where(['master_name' => $masterName, 'item_code !=' => '000'])
            ->toArray();

        $this->set('values');
        $this->viewBuilder()->setClassName('Json');
        $this->viewBuilder()->setOption('serialize', ['values']);
        $this->set([
            'values' => $values,
            '_serialize' => ['values']
        ]);
    }
}
