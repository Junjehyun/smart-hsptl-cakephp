<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MainPage Controller
 *
 * @method \App\Model\Entity\MainPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MainPageController extends AppController
{
    /**
     * Index method
     * localhost:8765/index 
     * メイン画面の役割
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        /**
         * コントローラー名とビューのフォルダが一緒の場合、
         * 特に何も指定しなくても自動的にビューが表示される
         */
    }

    /**
     * View method
     *
     * @param string|null $id Main Page id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mainPage = $this->MainPage->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('mainPage'));
    }

    public function test() {
        // css responsive test
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mainPage = $this->MainPage->newEmptyEntity();
        if ($this->request->is('post')) {
            $mainPage = $this->MainPage->patchEntity($mainPage, $this->request->getData());
            if ($this->MainPage->save($mainPage)) {
                $this->Flash->success(__('The main page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main page could not be saved. Please, try again.'));
        }
        $this->set(compact('mainPage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Main Page id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mainPage = $this->MainPage->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mainPage = $this->MainPage->patchEntity($mainPage, $this->request->getData());
            if ($this->MainPage->save($mainPage)) {
                $this->Flash->success(__('The main page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main page could not be saved. Please, try again.'));
        }
        $this->set(compact('mainPage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Main Page id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mainPage = $this->MainPage->get($id);
        if ($this->MainPage->delete($mainPage)) {
            $this->Flash->success(__('The main page has been deleted.'));
        } else {
            $this->Flash->error(__('The main page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
