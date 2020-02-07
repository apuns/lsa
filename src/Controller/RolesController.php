<?php

namespace App\Controller;

class RolesController extends AppController
{
    public function index()
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer Roles.'));
            $this->redirect('/');
        }
        $this->loadComponent('Paginator');
        $roles = $this->Paginator->paginate($this->Roles->find());
        $this->set(compact('roles'));
    }

    public function view($id = null)
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer Roles.'));
            $this->redirect('/');
        }
        $role = $this->Roles->findById($id)->firstOrFail();
        $this->set(compact('role'));
    }

    public function add()
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer Roles.'));
            $this->redirect('/');
        }
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());

            if ($this->Roles->save($role)) {
                $this->Flash->success(__('Your role has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your role.'));
        }
        $this->set('role', $role);
    }

    public function edit($id)
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer Roles.'));
            $this->redirect('/');
        }
        $role = $this->Roles->findById($id)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('Role has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update role.'));
        }

        $this->set('role', $role);
    }


    public function delete($id)
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer Roles.'));
            $this->redirect('/');
        }
        $this->request->allowMethod(['post', 'delete']);

        $role = $this->Roles->findById($id)->firstOrFail();
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('{0} role has been deleted.', $role->name));
            return $this->redirect(['action' => 'index']);
        }
    }

}

