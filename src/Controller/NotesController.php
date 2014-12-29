<?
namespace App\Controller;

use App\Controller\AppController;

class NotesController extends AppController {

    public function index() {
        if ($this->request->is('post')) {
            if($this->request->data['file']['name'])
            {
                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'notes');
                
            }
            else
            {
                $this->request->data['file'] = null;
            }
            $query = $this->Notes->newEntity($this->request->data);
            $query->user_id = $this->Auth->user('id');
            debug($query);
            if ($this->Notes->save($query))
            {
                $this->Flash->success(__('Note Added!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
            $this->Flash->error(__('Note could not be added'));
            }
        }
            $query = $this->Notes->find();
            $query->where(['user_id' => $this->Auth->user('id')]);
            $this->set('notes', $query);
              
    }

    public function edit($id){

    //Throw an error if no id is provided
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Lookup the form
        $note = $this->Notes->get($id);

        if ($this->request->is(['post', 'put'])) {
        //Check if a file has been uploaded.
        debug($this->request->data);
        if($this->request->data['file']['name'])
        {
            $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'forms');
            
        }
        else
        {
            unset($this->request->data['file']);
        }
            $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('Note successfully edited.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to edit note'));
        }
            $query = $this->Notes->find();
            $query->where(['user_id' => $this->Auth->user('id')]);
            $this->set('notes', $query);
    }
        

    public function delete($id) {
    $note = $this->Notes->get($id);
    if ($this->Notes->delete($note)) {
        $this->Flash->success(__('Note deleted.'));
        return $this->redirect(['action' => 'index']);
        }
    }
}
?>