<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Inspections Controller
 *
 * @property \App\Model\Table\InspectionsTable $Inspections
 * @property \App\Controller\Component\EmailsController $emails
 * @property \App\Model\Table\EmailsTable $emailsTable
 * @method \App\Model\Entity\Inspection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InspectionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $identity = $this->Authentication->getIdentity();
        if ($identity) {
            $role = $identity->user_type;
            if ($role === 'admin') {
                $this->viewBuilder()->setLayout('default');
            } else {
                $this->viewBuilder()->setLayout('contractor_default');
            }
        }
    }
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $inspections = $this->Inspections->find()->contain(['Users', 'Apartments', 'Images']);
        $this->set(compact('inspections'));
    }

    /**
     * View method
     *
     * @param string|null $id Inspection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inspection = $this->Inspections->get($id, [
            'contain' => ['Users', 'Apartments', 'Images']
        ]);
        $this->Authorization->authorize($inspection);
        $users = $this->Inspections->Users->find('list', ['limit' => 200])->all();
        $apartments = $this->Inspections->Apartments->find('list', ['limit' => 200])->all();
        $this->set(compact('inspection', 'users', 'apartments'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inspection = $this->Inspections->newEmptyEntity();
        $this->Authorization->authorize($inspection);
        if ($this->request->is('post')) {
            $inspection = $this->Inspections->patchEntity($inspection, $this->request->getData());
            if ($this->Inspections->save($inspection)) {
                return $this->redirect(['controller' => 'Emails', 'action' => 'sendemailtoallcontractor']);
            }
            $this->Flash->error(__('The inspection could not be saved. Please, try again.'));
        }
        $users = $this->Inspections->Users->find('list', ['limit' => 200])->all();
        $apartments = $this->Inspections->Apartments->find('list', ['limit' => 200])->all();
        $this->set(compact('inspection', 'users', 'apartments'));
    }

    public function edit($id = null)
    {
        $inspection = $this->Inspections->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($inspection);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inspection = $this->Inspections->patchEntity($inspection, $this->request->getData());
            if ($this->Inspections->save($inspection)) {
                $this->Flash->success(__('The inspection has been saved.'));
                if ($this->Authentication->getIdentity()->user_type === 'admin') {
                    return $this->redirect(['controller' => 'Emails', 'action' => 'edit', '?' => ['user_id' => $inspection->user_id, 'inspection_id' => $inspection->inspection_id]]);
                }else{
                    return $this->redirect(['action' => 'view', $inspection->inspection_id]);
                }
            }
            $this->Flash->error(__('The inspection could not be saved. Please, try again.'));
        }
        $users = $this->Inspections->Users->find('list', ['limit' => 200])->all();
        $apartments = $this->Inspections->Apartments->find('list', ['limit' => 200])->all();
        $this->set(compact('inspection', 'users', 'apartments'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inspection = $this->Inspections->get($id);
        $this->Authorization->authorize($inspection);
        if ($this->Inspections->delete($inspection)) {
            $this->Flash->success(__('The inspection has been deleted.'));
        } else {
            $this->Flash->error(__('The inspection could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function accept($id = null)
    {
        $this->Authorization->skipAuthorization();
        $inspection = $this->Inspections->get($id);
        $inspection->inspection_status = 'Accepted';
        $inspection->user_id = $this->Authentication->getIdentity()->user_id; // Set user_id to currently logged in user's ID
        if ($this->Inspections->save($inspection)) {
            $this->Flash->success(__('The inspection has been accepted.'));
            return $this->redirect(['controller' => 'Emails', 'action' => 'sendemailtoadmin']);
        }
        $this->Flash->error(__('The inspection could not be saved. Please, try again.'));
    }

    public function complete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $inspection = $this->Inspections->get($id);
        $inspection->inspection_status = 'Inspected';
        $inspection->user_id = $this->Authentication->getIdentity()->user_id; // Set user_id to currently logged in user's ID
        if ($this->Inspections->save($inspection)) {
            $this->Flash->success(__('The inspection has been set inspected.'));
            return $this->redirect(['controller' => 'Emails', 'action' => 'inspected']);
        }
        $this->Flash->error(__('The inspection could not be saved. Please, try again.'));
    }

    public function reject($id = null)
    {
        $inspection = $this->Inspections->get($id);
        $inspection_user_id = $inspection->user_id;
        $inspection_id=$inspection->inspection_id;
        $this->Authorization->authorize($inspection);
        $inspection->inspection_status = 'Rejected';
        if ($this->Inspections->save($inspection)) {
            $this->Flash->success(__('The inspection has been rejected. Using edit if you want to undo this.'));
            return $this->redirect(['controller' => 'Emails', 'action' => 'reject', '?' => ['user_id' => $inspection_user_id,'inspection_id'=>$inspection_id]]);
        }
        $this->Flash->error(__('The inspection could not be saved. Please, try again.'));
    }

    public function finish($id = null)
    {
        $inspection = $this->Inspections->get($id);
        $this->Authorization->authorize($inspection);
        $inspection->inspection_status = 'Finished';
        if ($this->Inspections->save($inspection)) {
            $this->Flash->success(__('The inspection has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The inspection could not be saved. Please, try again.'));
    }

}
