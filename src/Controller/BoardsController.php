<?
namespace App\Controller;

use App\Controller\AppController;

class BoardsController extends AppController {

    public function index() {
        if ($this->request->is('post')) {
            if($this->request->data['file']['name'])
            {
                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'boards');
                
            }
            else
            {
                $this->request->data['file'] = null;
            }
            $query = $this->Boards->newEntity($this->request->data);
            if ($this->Boards->save($query))
            {
                $this->Flash->success(__('Board Added!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
            $this->Flash->error(__('Board could not be added'));
            }
        }
        $this->loadModel('Users');
        $users = $this->Users->find('all', [
            'order' => 'Users.status DESC'
        ]);
        $this->set('users', $users);

            $query = $this->Boards->find();
            $this->set('boards', $query);
              
    }

    public function edit()
    {
        
    }
    public function delete($id) {
    $board = $this->Boards->get($id);
    if ($this->Boards->delete($board)) {
        $this->Flash->success(__('Board deleted.'));
        return $this->redirect(['action' => 'index']);
        }
    }
}
?>