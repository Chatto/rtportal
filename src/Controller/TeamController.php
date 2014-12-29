<?
namespace App\Controller;

use App\Controller\AppController;

class TeamController extends AppController {

    public function index() {
        $this->loadModel('Users');
        $this->loadModel('Meetings');
    	$this->loadModel('Sheets');
        $this->set('meetings', $this->Meetings->find('all')->where(['manager_id' => $this->Auth->user('id')])->contain(['Users']));
        $this->set('team', $this->Users->find('all')->where(['manager_id' => $this->Auth->user('id')]));
        $this->set('sheets', $this->Sheets->find('all')->where(['manager_id' => $this->Auth->user('id')]));
    }
    public function view() {
        //dostff
    }
    public function edit()
    {
        
    }
}
?>