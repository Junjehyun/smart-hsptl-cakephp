<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * CsvUpload Controller
 *
 * @method \App\Model\Entity\CsvUpload[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CsvUploadController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $csvUpload = $this->paginate($this->CsvUpload);

        $this->set(compact('csvUpload'));
    }

    /**
     * View method
     *
     * @param string|null $id Csv Upload id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $csvUpload = $this->CsvUpload->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('csvUpload'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $csvUpload = $this->CsvUpload->newEmptyEntity();
        if ($this->request->is('post')) {
            $csvUpload = $this->CsvUpload->patchEntity($csvUpload, $this->request->getData());
            if ($this->CsvUpload->save($csvUpload)) {
                $this->Flash->success(__('The csv upload has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The csv upload could not be saved. Please, try again.'));
        }
        $this->set(compact('csvUpload'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Csv Upload id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $csvUpload = $this->CsvUpload->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $csvUpload = $this->CsvUpload->patchEntity($csvUpload, $this->request->getData());
            if ($this->CsvUpload->save($csvUpload)) {
                $this->Flash->success(__('The csv upload has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The csv upload could not be saved. Please, try again.'));
        }
        $this->set(compact('csvUpload'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Csv Upload id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $csvUpload = $this->CsvUpload->get($id);
        if ($this->CsvUpload->delete($csvUpload)) {
            $this->Flash->success(__('The csv upload has been deleted.'));
        } else {
            $this->Flash->error(__('The csv upload could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
}
