<?php

namespace App\Controller;

class PecsfRegionsController extends AppController
{
    public function index()
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer PECSF Regions.'));
            $this->redirect('/');
        }
        $this->loadComponent('Paginator');
        $pecsfregions = $this->Paginator->paginate($this->Pecsfregions->find());
        $this->set(compact('pecsfregions'));
    }

    public function view($id = null)
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer PECSF Regions.'));
            $this->redirect('/');
        }
        $region = $this->Pecsfregions->findById($id)->firstOrFail();
        $this->set(compact('region'));
    }

    public function add()
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer PECSF Regions.'));
            $this->redirect('/');
        }
        $region = $this->Pecsfregions->newEmptyEntity();
        if ($this->request->is('post')) {
            $region = $this->Pecsfregions->patchEntity($region, $this->request->getData());

            if ($this->Pecsfregions->save($region)) {
                $this->Flash->success(__('PECSF region has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add PECSF region.'));
        }
        $this->set('region', $region);
    }

    public function edit($id)
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer PECSF Regions.'));
            $this->redirect('/');
        }
        $region = $this->Pecsfregions->findById($id)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Pecsfregions->patchEntity($region, $this->request->getData());
            if ($this->Pecsfregions->save($region)) {
                $this->Flash->success(__('PECSF region has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update PECSF region.'));
        }

        $this->set('region', $region);
    }


    public function delete($id)
    {
        if (!$this->checkAuthorization(array(1))) {
            $this->Flash->error(__('You are not authorized to administer PECSF Regions.'));
            $this->redirect('/');
        }
        $this->request->allowMethod(['post', 'delete']);

        $region = $this->Pecsfregions->findById($id)->firstOrFail();
        if ($this->Pecsfregions->delete($region)) {
            $this->Flash->success(__('{0} PECSF region has been deleted.', $region->name));
            return $this->redirect(['action' => 'index']);
        }
    }

}

