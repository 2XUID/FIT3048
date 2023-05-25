<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Event\EventInterface;
use App\Model\Table\InspectionsTable;
use App\Model\Table\ApartmentTable;


/**
 * Emails Controller
 * @property \App\Model\Table\EmailsTable $Emails
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\ApartmentsTable $Apartments
 * @method \App\Model\Entity\Email[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $email = $this->Emails->newEmptyEntity();
        $this->Authorization->authorize($email);
        $emails = $this->paginate($this->Emails, [
            'limit' => 100
        ]);
        $this->set(compact('emails'));
    }


    /**
     * View method
     *
     * @param string|null $id Email id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $email = $this->Emails->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('email'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $email = $this->Emails->newEmptyEntity();
        $this->Authorization->authorize($email);
        $users = $this->Users->find('all')->where(['user_type' => 'admin']);
        foreach ($users as $user) {
            if ($this->request->is('post')) {
                $email = $this->Emails->patchEntity($email, $this->request->getData());
                if ($email = $this->Emails->save($email)) {
                    //Send email
                    $mailer = new Mailer('default');
                    //set up email parameters
                    $mailer
                        ->setEmailFormat('html')
                        #->setTo(Configure::read('InspectionEmail.to'))
                        ->setTo($user->email)
                        ->setFrom(Configure::read('InspectionEmail.from'))
                        ->setReplyTo($email->email_address)
                        ->setSubject('New Inspection Email from ' . h($email->email_name) . "<" . h($email->email_address) . ">")
                        ->viewBuilder()
                        ->disableAutoLayout()
                        ->setTemplate('email');
                    //->setLayout('fancy');
                    //send date the email template
                    $mailer->setViewVars([
                        'email_body' => $email->email_body,
                        'email_name' => $email->email_name,
                        'email_address' => $email->email_address,
                        'email_created' => $email->email_created,
                        'email_id' => $email->email_id
                    ]);
                    //send email
                    $email_result = $mailer->deliver();
                    if ($email_result) {
                        $email->email_sent = ($email_result) ? true : false;
                        $this->Emails->save($email);
                        $this->Flash->success(__('The inspection has been saved. Email has been saved and sent.'));
                    } else {
                        $this->Flash->error(__('Email failed to send. Please check the enquiry in the system later.'));
                    }
                    return $this->redirect(['controller' => 'Inspections', 'action' => 'index']);
                }
            }
        }
        $this->set(compact('email'));
    }

    public function contractorask($id = null)
    {
        $apartment_address='';
        $email = $this->Emails->newEmptyEntity();
        $this->Authorization->authorize($email);
        $user = $this->Authentication->getIdentity();
        $userName = $user->user_fname;
        $inspection_id = $this->request->getQuery('inspection_id');
        $this->set(compact('inspection_id'));
        $inspection = $this->Inspections->find()->where(['inspection_id' => $inspection_id])->first();
        if ($inspection) {
            $inspectionaddress = $inspection->apartment_id;
        }
        $apartment_id = $this->request->getQuery('apartment_id');
        $apartment = $this->Apartments->find()->where(['apartment_id' => $apartment_id])->first();
        if ($apartment) {
            $apartment_address = $apartment->apartment_address;
        }
        $users = $this->Users->find('all')->where(['user_type' => 'admin']);
        foreach ($users as $user) {
            if ($this->request->is('post')) {
                $email = $this->Emails->patchEntity($email, $this->request->getData());
                if ($email = $this->Emails->save($email)) {
                    //Send email
                    $mailer = new Mailer('default');
                    //set up email parameters
                    $mailer
                        ->setEmailFormat('html')
                        #->setTo(Configure::read('InspectionEmail.to'))
                        ->setTo($user->email)
                        ->setFrom(Configure::read('InspectionEmail.from'))
                        ->setReplyTo($email->email_address)
                        ->setSubject('New Inspection Email from ' . h($email->email_name) . "<" . h($email->email_address) . ">")
                        ->viewBuilder()
                        ->disableAutoLayout()
                        ->setTemplate('questionemail');
                    //->setLayout('fancy');
                    //send date the email template
                    $mailer->setViewVars([
                        'email_body' => $email->email_body,
                        'email_name' => $email->email_name,
                        'email_address' => $email->email_address,
                        'email_created' => $email->email_created,
                        'email_id' => $email->email_id,
                        'user_id' => $userName,
                        'inspection_id' => $apartment_address
                    ]);
                    //send email
                    $email_result = $mailer->deliver();
                    if ($email_result) {
                        $email->email_sent = ($email_result) ? true : false;
                        $this->Emails->save($email);
                        $this->Flash->success(__('The Inspection query email has been saved and sent.'));
                    } else {
                        $this->Flash->error(__('Email failed to send. Please check the enquiry in the system later.'));
                    }
                    return $this->redirect(['controller' => 'Inspections', 'action' => 'view', $inspection_id]);
                }
            }
        }
        $this->set(compact('email'));
    }

    public function respond($id = null)
    {
        $email = $this->Emails->newEmptyEntity();
        $this->Authorization->authorize($email);
        $email_address = $this->request->getQuery('email');
        $email_id = $this->request->getQuery('email_id');
        $this->set(compact('email_id'));
        $user = $this->Authentication->getIdentity();
        $userName = $user->user_fname;
        if ($this->request->is('post')) {
            $email = $this->Emails->patchEntity($email, $this->request->getData());
            if ($email = $this->Emails->save($email)) {
                //Send email
                $mailer = new Mailer('default');
                //set up email parameters
                $mailer
                    ->setEmailFormat('html')
                    ->setTo($email_address)
                    ->setFrom(Configure::read('InspectionEmail.from'))
                    ->setReplyTo($email->email_address)
                    ->setSubject('New Inspection Email from ' . h($email->email_name) . "<" . h($email->email_address) . ">")
                    ->viewBuilder()
                    ->disableAutoLayout()
                    ->setTemplate('respond');
                //->setLayout('fancy');
                //send date the email template
                $mailer->setViewVars([
                    'email_body' => $email->email_body,
                    'email_name' => $email->email_name,
                    'email_address' => $email->email_address,
                    'email_created' => $email->email_created,
                    'email_id' => $email->email_id,
                    'user_id' => $userName
                ]);
                //send email
                $email_result = $mailer->deliver();
                if ($email_result) {
                    $email->email_sent = ($email_result) ? true : false;
                    $this->Emails->save($email);
                    $this->Flash->success(__('The Inspection Email has been saved and sent via email.'));
                } else {
                    $this->Flash->error(__('Email failed to send. Please check the enquiry in the system later.'));
                }
                return $this->redirect(['controller' => 'Inspections', 'action' => 'index']);
            }
        }
        $this->set(compact('email'));
    }

    public function adminadd()
    {
        $email = $this->Emails->newEmptyEntity();
        $this->Authorization->authorize($email);
        if ($this->request->is('post')) {
            $email = $this->Emails->patchEntity($email, $this->request->getData());
            if ($email = $this->Emails->save($email)) {
                //Send email
                $mailer = new Mailer('default');
                //set up email parameters
                $mailer
                    ->setEmailFormat('html')
                    ->setTo($email->email_address)
                    ->setFrom(Configure::read('InspectionEmail.from'))
                    ->setReplyTo($email->email_address)
                    ->setSubject('New Inspection Email from ' . h($email->email_name) . "<" . h($email->email_address) . ">")
                    ->viewBuilder()
                    ->disableAutoLayout()
                    ->setTemplate('adminemail');
                //->setLayout('fancy');
                //send date the email template
                $mailer->setViewVars([
                    'email_body' => $email->email_body,
                    'email_name' => $email->email_name,
                    'email_address' => $email->email_address,
                    'email_created' => $email->email_created,
                    'email_id' => $email->email_id
                ]);
                //send email
                $email_result = $mailer->deliver();
                if ($email_result) {
                    $email->email_sent = ($email_result) ? true : false;
                    $this->Emails->save($email);
                    $this->Flash->success(__('The Inspection Email has been saved and sent via email.'));
                } else {
                    $this->Flash->error(__('Email failed to send. Please check the enquiry in the system later.'));
                }
                return $this->redirect(['control' => 'inspection', 'action' => 'index']);
            }
        }
        $this->set(compact('email'));
    }

    public function mark($id = null)
    {
        $this->Authorization->skipAuthorization();
        $email = $this->Emails->get($id);
        if ($email->email_sent) {
            $this->Flash->error(__('This enquiry is already marked as sent. '));
        } else {
            $email->email_sent = true;
            if ($this->Emails->save($email)) {
                $this->Flash->success(__('The enquiry has been marked as sent. '));
            } else {
                $this->Flash->error(__('The enquiry could not be marked as sent. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $email = $this->Emails->get($id);
        if ($this->Emails->delete($email)) {
            $this->Flash->success(__('The email has been deleted.'));
        } else {
            $this->Flash->error(__('The email could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Users');
        $this->loadModel('Inspections');
        $this->loadModel('Apartments');
    }

    public function sendemailtoallcontractor()
    {
        $this->Authorization->skipAuthorization();
        $users = $this->Users->find('all')->where(['user_type' => 'contractor']);
        foreach ($users as $user) {
            $email = new Mailer('default');
            $email->setTo($user->email)
                ->setSubject('Mono Apartments, Inspection Task Notification')
                ->deliver('Hi, there has been a new inspection task that has been created. Please go to the Mono System site to view the job -> https://production.u22s2110.monash-ie.me/inspections .');
        }
        $this->Flash->success(__('An email has been sent to all contractors.'));
        return $this->redirect(['controller' => 'Inspections', 'action' => 'index']);
    }

    public function sendemailtoadmin()
    {
        $this->Authorization->skipAuthorization();
        $users = $this->Users->find('all')->where(['user_type' => 'admin']);
        foreach ($users as $user) {
            $email = new Mailer('default');
            $email->setTo($user->email)
                ->setSubject('Mono Apartments, Inspection Task Notification')
                ->deliver('Hi, there has been a inspection task that has been accepted. Please go to the Mono System site to view the job -> https://production.u22s2110.monash-ie.me/inspections .');
        }
        return $this->redirect(['controller' => 'Inspections', 'action' => 'index']);
    }

    public function edit()
    {
        $this->Authorization->skipAuthorization();
        $user_id = $this->request->getQuery('user_id');
        $inspection_id = $this->request->getQuery('inspection_id');
        $users = $this->Users->find('all')->where(['user_id' => $user_id]);
        foreach ($users as $user) {
            $email = new Mailer('default');
            $email->setTo($user->email)
                ->setSubject('Mono Apartments, Inspection Task Notification')
                ->deliver('Hi, there has been a inspection that has been edited by admin. Please go to the Mono System site to view the job -> https://production.u22s2110.monash-ie.me/inspections .');
        }
        return $this->redirect(['controller' => 'Inspections', 'action' => 'view', $inspection_id]);
    }

    public function inspected()
    {
        $this->Authorization->skipAuthorization();
        $users = $this->Users->find('all')->where(['user_type' => 'admin']);
        foreach ($users as $user) {
            $email = new Mailer('default');
            $email->setTo($user->email)
                ->setSubject('Mono Apartments, Inspection Task Notification')
                ->deliver('Hi, there has been a property that has been inspected. Please go to the Mono System site to view the job -> https://production.u22s2110.monash-ie.me/inspections .');
        }
        return $this->redirect(['controller' => 'Inspections', 'action' => 'index']);
    }

    public function reject()
    {
        $inspectionaddress='';
        $email = $this->Emails->newEmptyEntity();
        $this->Authorization->authorize($email);
        //$this->Authorization->skipAuthorization();
        $id = $this->request->getQuery('user_id');
        $inspection_id = $this->request->getQuery('inspection_id');
        $this->set(compact('inspection_id'));
        $inspection = $this->Inspections->find()->where(['inspection_id' => $inspection_id])->first();
        if ($inspection) {
            $inspectionaddress = $inspection->apartment_id;
        }
        $apartment = $this->Apartments->find()->where(['apartment_id' => $inspectionaddress])->first();
        if ($apartment) {
            $apartment_address = $apartment->apartment_address;
        }
        $users = $this->Users->find('all')->where(['user_id' => $id]);
        foreach ($users as $user) {
            if ($this->request->is('post')) {
                $email = $this->Emails->patchEntity($email, $this->request->getData());
                if ($email = $this->Emails->save($email)) {
                    //Send email
                    $mailer = new Mailer('default');
                    //set up email parameters
                    $mailer
                        ->setEmailFormat('html')
                        #->setTo(Configure::read('InspectionEmail.to'))
                        ->setTo($user->email)
                        ->setFrom(Configure::read('InspectionEmail.from'))
                        ->setReplyTo($email->email_address)
                        ->setSubject('New Inspection Email from ' . h($email->email_name) . "<" . h($email->email_address) . ">")
                        ->viewBuilder()
                        ->disableAutoLayout()
                        ->setTemplate('rejectemail');
                    //->setLayout('fancy');
                    //send date the email template
                    $mailer->setViewVars([
                        'email_body' => $email->email_body,
                        'email_name' => $email->email_name,
                        'email_address' => $email->email_address,
                        'email_created' => $email->email_created,
                        'email_id' => $email->email_id,
                        'inspection_id' => $apartment_address
                    ]);
                    //send email
                    $email_result = $mailer->deliver();
                    if ($email_result) {
                        $email->email_sent = ($email_result) ? true : false;
                        $this->Emails->save($email);
                        $this->Flash->success(__('The email has been send.'));
                    } else {
                        $this->Flash->error(__('Email failed to send.'));
                    }
                    return $this->redirect(['controller' => 'Inspections', 'action' => 'index']);
                }
            }
        }
        $this->set(compact('email'));
    }
}
