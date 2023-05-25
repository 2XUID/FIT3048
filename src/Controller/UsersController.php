<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

/**
 * Users Controller
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);
        $users = $this->paginate($this->Users, [
            'limit' => 100
        ]);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $image_file = $this->request->getData('user_image');
            unset($formData['user_image']);
            $user = $this->Users->patchEntity($user, $formData);;
            if (!$user->getErrors()) {
                $name = $image_file->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . $name;
                if ($name) {
                    $image_file->moveTo($targetPath);
                    $user->user_image = $name;
                }
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formData = $this->request->getData();
            $image_file = $this->request->getData('user_image');
            unset($formData['user_image']);
            $user = $this->Users->patchEntity($user, $formData);;
            if (!$user->getErrors()) {
                $name = $image_file->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . $name;
                if ($name) {
                    $image_file->moveTo($targetPath);
                    $user->user_image = $name;
                }
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'view', $user->user_id]);
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'forgotpassword', 'resetpassword']);
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

    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Inspections',
                'action' => 'index',
            ]);
            return $this->redirect($redirect);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect('/inspections');
        }
    }

    public function forgotpassword()
    {
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $userTable = TableRegistry::get('Users');
            if ($email == NULL) {
                $this->Flash->error(__('Please insert your email address'));
                return $this->redirect(['action' => 'forgotpassword']);
            }
            $user = $userTable->find('all')->where(['email' => $email])->first();
            if ($user) {
                $expirationTime = new FrozenTime('10 minute');
                $token = Security::hash($user->id . $expirationTime->getTimestamp() . Security::randomBytes(25));
                $user->token = $token;
                $user->token_expiration = $expirationTime;
                if ($userTable->save($user)) {
                    $mailer = new Mailer('default');
                    $mailer->setFrom(Configure::read('InspectionEmail.from'))
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Forgot Password Request')
                        ->deliver('Hello<br/>Please click link below to reset your password<br/><br/><a href="https://production.u22s2110.monash-ie.me/users/resetpassword/' . $token . '">Reset Password</a>');
                }
                $this->Flash->success('Reset password link has been sent to your email (' . $email . '), please check your email');
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Email is not registered in system'));
                return $this->redirect(['action' => 'forgotpassword']);
            }
        }
    }

    public function resetpassword($token)
    {
        $this->Authorization->skipAuthorization();
        $now = FrozenTime::now();
        //$expirationTime = $now->modify('-1 minutes');

        if ($this->request->is('post')) {
            $newPass = $this->request->getData('password');
            $userTable = TableRegistry::get('Users');
            $user = $userTable->find('all')->where(['token' => $token])->first();
            if ($user->token_expiration < $now) {
                $this->Flash->error(__('Link expired. Please try again.'));
                return $this->redirect(['action' => 'forgotpassword']);
            }
            $user->password = $newPass;
            if ($userTable->save($user)) {
                $this->Flash->success('Password successfully reset. Please login using your new password');
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Password do not reset. Please try again.'));
            }
        }

        // Render the reset password form
        $this->set('token', $token);
        $this->set('_serialize', ['token']);
    }
}
