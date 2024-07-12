<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

/**
 * ImgUploadController Controller
 *
 * @method \App\Model\Entity\ImgUploadController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImgUploadController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->Facilities = TableRegistry::getTableLocator()->get('Facilities'); 
    }
    /**
     * イメージロゴ登録画面
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imageUpload()
    {
        $facility = $this->Facilities->find('all', ['order' => ['id' => 'DESC']])->first();
        $logoPath = $facility ? $facility->logo_image_name : null;
        $this->request->getSession()->write('image', $logoPath);
        $this->set(compact('logoPath', 'facility'));
    }

    /**
     * イメージロゴ登録処理
     * 
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Http\Exception\NotFoundException
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function imageToroku()
    {
        // $facility = $this->Facilities->newEmptyEntity();
        // if ($this->request->is('post')) {
        //     $data = $this->request->getData();
        //     $image = $this->request->getData('hsptl_image');

        //     // 画像アップロード
        //     $originalName = pathinfo($image->getClientFilename(), PATHINFO_FILENAME);
        //     $imageName = $originalName . '_' . FrozenTime::now()->format('YmdHis') . '.' . pathinfo($image->getClientFilename(), PATHINFO_EXTENSION);
        //     $image->moveTo(WWW_ROOT . 'img' . DS . $imageName);

        //     $this->request->getSession()->write('image', $imageName);

        //     // Faciliteisテーブルにデータを保存
        //     $data['logo_image_name'] = $imageName;
        //     $facility = $this->Facilities->patchEntity($facility, $data);
        //     if ($this->Facilities->save($facility)) {
        //         $this->Flash->success('画像をアップロードしました。');
        //     } else {
        //         $this->Flash->error('画像のアップロードに失敗しました。');
        //     }
        // }
        // return $this->redirect(['action' => 'image-upload']);
    }

    /**
     * イメージ削除処理
     * 
     * @return \Cake\Http\Response
     * @throws \Cake\Http\Exception\NotFoundException
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * 
     */
    public function imageDelete()
    {
        // $facility = $this->Facilities->find('all')->first();

        // if ($facility && $facility->logo_image_name) {
        //     $imagePath = WWW_ROOT . 'img' . DS . $facility->logo_image_name;
        //     if (file_exists($imagePath)) {
        //         unlink($imagePath);
        //     }
        //     if ($this->Facilities->delete($facility)) {
        //         $this->request->getSession()->delete('image');
        //         return $this->response->withType('application/json')->withStringBody(json_encode(['success' => '画像を削除しました。']));
        //     }
        // }
        // return $this->response->withType('application/json')->withStringBody(json_encode(['error' => '画像の削除が失敗になりました。']));
    }

}
