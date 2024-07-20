<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

/**
 * Qr Controller
 *
 * @method \App\Model\Entity\Qr[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QrCodeController extends AppController
{

    /**
     * 初期化宣言
     * 
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

    }

    /**
     * QRコード登録ロジック
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws NotFoundException
     * @throws \Exception
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \TypeError
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Cake\Http\Exception\NotFoundException
     * @throws \Cake\Http\Exception\BadRequestException
     */
    public function saveQrCode() {
        
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $smartTagsTable = TableRegistry::getTableLocator()->get('SmartTags');
            $smartTag = $smartTagsTable->newEntity($data);

            if ($smartTagsTable->save($smartTag)) {
                $this->Flash->success('QRコードが保存されました。');
            } else {
                $this->Flash->error('QRコードの保存に失敗しました。');
            }

            return $this->redirect(['action' => 'index']);
        }
        throw new NotFoundException('Invalid request method');
    }

    /**
     * validation検証
     * @param mixed $data
     * @return string[]
     */
    private function validateQrData($data)
    {
        $errors = [];
        if (empty($data['tag_id'])) {
            $errors[] = 'SerialNoは必須です。';
        }
        if (empty($data['mac_address'])) {
            $errors[] = 'MAC アドレスは必須です。';
        }
        if (empty($data['tag_type'])) {
            $errors[] = 'タグのタイプは必須です。';
        }
        return $errors;
    }
}
