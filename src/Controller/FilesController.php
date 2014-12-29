<?
namespace App\Controller;

use App\Controller\AppController;

class FilesController extends AppController {

    public function index() {
        if ($this->request->is('post')) {
            if($this->request->data['file']['name'])
            {
                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'uploads');
                
            }
            else
            {
                $this->request->data['file'] = null;
            }
            $query = $this->Files->newEntity($this->request->data);
            $query->user_id = $this->Auth->user('id');
            $query->url = $this->request->data['file'];
            if ($this->Files->save($query))
            {
                $this->Flash->success(__('File Added!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
            $this->Flash->error(__('File could not be added'));
            }
        }
        $this->loadModel('Users');
        $users = $this->Users->find('all', [
            'order' => 'Users.status DESC'
        ]);
        $this->set('users', $users);

            $query = $this->Files->find('all');
            $this->set('files', $query);
              
    }

    public function edit()
    {
        
    }
    public function delete($id) {
    $file = $this->Files->get($id);
    if ($this->Files->delete($file)) {
        $this->Flash->success(__('File deleted.'));
        return $this->redirect(['action' => 'index']);
        }
    }
}
?>