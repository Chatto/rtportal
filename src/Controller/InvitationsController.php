<?
namespace App\Controller;

use App\Controller\AppController;

class InvitationsController extends AppController {
    public function admin_add(){
        $this->layout = 'basic';
        $invitation = $this->Invitations->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $this->Invitations['invite_code'] = String::uuid($this->request->data['email']);
            if ($this->Invitations->save($invitation)) {
                $this->Flash->success(__('The invitation has been sent.'));
                return $this->redirect(['action' => 'admin_add']);
            }
            $this->Flash->error(__('Unable to send invite'));
        }
    }




}
?>