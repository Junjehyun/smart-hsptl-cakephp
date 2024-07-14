<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Exception;

use function Cake\Error\dd;

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
        if ($this->request->is('post')) 
        {
            // formのデータを取得
            $data = $this->request->getData();

            //アップデート処理
            $image = $this->request->getData('hsptl_image');

            // 保存先のパス
            /**
             * @var string
             * $uploadPath webroot/uploads/images/に保存される。
             */
            $uploadPath = WWW_ROOT . 'uploads' . DS . 'images' . DS;

            if ($image && $image->getError() === UPLOAD_ERR_OK) {
                $originalName = pathinfo($image->getClientFilename(), PATHINFO_FILENAME);
                $extension = pathinfo($image->getClientFilename(), PATHINFO_EXTENSION);

                 // 画像の拡張子をチェック
                $validExtensions = ['png', 'jpg', 'jpeg', 'gif'];
                if (!in_array($extension, $validExtensions)) {
                    $this->Flash->error('PNG、JPGまたはGIF形式の画像をアップロードしてください。');
                    return $this->redirect(['action' => 'imageUpload']);
                }
                 // 画像の大きさをチェック
                list($width, $height) = getimagesize($image->getStream()->getMetadata('uri'));
                if ($width > 800 || $height > 400) {
                    $this->Flash->error('画像の大きさは800x400pxです。');
                    return $this->redirect(['action' => 'imageUpload']);
                }

                $imageName = $originalName . '_' . FrozenTime::now()->format('YmdHis') . '.' . $extension;
                $imagePath = $uploadPath . $imageName;

                //画像を保存
                $image->moveTo($imagePath);
                //画像のパスをセッションに保存
                $data['logo_image_name'] = 'uploads/images/' . $imageName;
                } else {
                    $imageName = null; // 画像がアップロードされなかった場合
            }
            
             // Facilityテーブルにデータを保存
            $facility = $this->Facilities->newEntity($data);

            if ($this->Facilities->save($facility)) {
                // Headerに画像を表示するためのセッションを保存
                $this->request->getSession()->write('headerImage', 'uploads/images/' . $imageName);

                $this->Flash->success('画像をアップロードしました。');
                return $this->redirect(['action' => 'imageUpload']);
            } else {
                $this->Flash->error('画像のアップロードに失敗しました。もう一度お試しください。');
            }
        }
    }

    /**
     * イメージ削除処理
     * 
     * @throws \Cake\Http\Exception\NotFoundException
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @return \Cake\Http\Response|null|void
     * 
     */
    public function imageDelete()
    {
        $this->request->allowMethod(['delete']);

        file_put_contents(WWW_ROOT . 'debug.log', 'imageDelete method called' . PHP_EOL, FILE_APPEND);

        $facility = $this->Facilities->find()->order(['id' => 'DESC'])->first();
        
        if ($facility && $facility->logo_image_name) {
            $imagePath = WWW_ROOT . 'uploads' . DS . 'images' . DS . basename($facility->logo_image_name);
    
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } 

            if ($this->Facilities->delete($facility)) {
                $this->request->getSession()->delete('image');

                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['success' => 'イメージを削除しました。']));
            } else {
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['error' => 'イメージの削除に失敗しました。']));
            }
        } else {
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['error' => 'イメージが見つかりません。']));
        }

    }

}
