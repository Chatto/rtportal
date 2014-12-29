<?
namespace App\Controller;

use App\Controller\AppController;

class FormElementsController extends AppController {

    public function index() {
        if ($this->request->is('post')) {
            if($this->request->data['file']['name'])
            {
                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'formelements');
                
            }
            else
            {
                $this->request->data['file'] = null;
            }
            $query = $this->FormElements->newEntity($this->request->data);
            debug($query);
            if ($this->FormElements->save($query))
            {
                $this->Flash->success(__('Form Element Added!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
            $this->Flash->error(__('Form Element could not be added'));
            }
        }
            $query = $this->FormElements->find();
            $this->set('formelements', $query);
              
    }

    public function edit()
    {
        
    }
    public function delete($id) {
    $formelement = $this->FormElements->get($id);
    if ($this->FormElements->delete($formelement)) {
        $this->Flash->success(__('Form Element deleted.'));
        return $this->redirect(['action' => 'index']);
        }
    }
}
?>