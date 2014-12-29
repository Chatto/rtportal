<?
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class User extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];
    // ...

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
    protected function _getManagerName() {

        $id = $this->_properties['manager_id'];
        $users = TableRegistry::get('Users');
        $manager = $users->get($id)->extract(['display_name']);
        return $manager['display_name'];
    }
    protected function _getStatus() {
        return 'online';
    }
    protected function beforeSave()
    {
        //$this->user_id = $this->Auth->user('id');
    	return 1;
    }
}
?>