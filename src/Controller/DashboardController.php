<?php
namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController
{
	public function index()
	{

		/* Users Online */

		$this->loadModel('Users');
		$users = $this->Users->find('all', [
		    'limit' => 13,
		    'order' => 'Users.status DESC'
		]);
		$this->set('users', $users);

		/* Announcements */

		$this->loadModel('Announcements');
		$announcements = $this->Announcements->find('all', [
		    'limit' => 13,
		    'order' => 'Announcements.created DESC'
		])->contain(['Users']);
		$this->set('announcements', $announcements);

		/* Board Activity */

		$this->loadModel('ActivityFeed');
		$boardfeed = $this->ActivityFeed->find('all', [
		    'limit' => 13,
		    'order' => 'ActivityFeed.created DESC'
		])->where(['type' => 'board'])->contain(['Users']);
		$this->set('boardfeed', $boardfeed);

		/* Wiki Activity */

		$wikifeed = $this->ActivityFeed->find('all', [
		    'limit' => 13,
		    'order' => 'ActivityFeed.created DESC'
		])->where(['type' => 'wiki'])->contain(['Users']);
		$this->set('wikifeed', $wikifeed);


	}
}
?>