<?
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class ChatMessage extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];
    protected function _getLatestMessages($limit) {
        $users = TableRegistry::get('Users');
        $messages =  $this->ChatMessages->find('all',
            [
                'limit' => 25
            ]);
        return $messages
    }

    protected function beforeSave()
    {

    	return 1;
    }
}
?>