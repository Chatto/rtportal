<?php

namespace App\Controller;

use App\Controller\AppController;

class ChatController extends AppController
{
	public function messages(){
		$this->loadModel('ChatMessages');
		$this->loadModel('Users');
		$this->layout="json";

		//$this->autoRender = false; 
		//$this->viewClass = 'Tools.Ajax';
		//$this->RequestHandler->renderAs($this, 'json');
		$users = $this->Users->find('all');
		$chatMessages = $this->ChatMessages->find('all',['limit' => 100,	'order' => 'ChatMessages.timestamp DESC']);
		$chatMessages->contain(['Users']);
		$this->set(compact('chatMessages')); // Pass $data to the view
		$this->set('_serialize', 'chatMessages'); 
	}
	public function index()
	{
		// Load User List
		$this->loadModel('Users');
		$users = $this->Users->find('all', [
		    'order' => 'Users.status DESC'
		]);
		$this->set('users', $users);

		//Load Message List
		$this->loadModel('ChatMessages');
		$chatMessages = $this->ChatMessages->find('all', [
		    'order' => 'ChatMessages.timestamp DESC'
		]);
		$this->set('chatMessages', $chatMessages);
	}
	public function addMessage(){
		if ($this->request->is('json')) {
                if($this->request->data['chatMessage']['file'])
                {
                    $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'chat-uploads');
                    
                }
                $chatMessage = $this->ChatMessages->newEntity($this->request->data);
                $this->ChatMessages->save($chatMessage);
            }
    }

	public function logs($logId = null)
	{
		//Logging code
	}
}
?>