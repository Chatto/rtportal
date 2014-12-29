<?
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class Sheet extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];
    // ...

    protected function _getManagerName() {

        $id = $this->_properties['manager_id'];
        $users = TableRegistry::get('Users');
        $manager = $users->get($id)->extract(['full_name']);
        return $manager['full_name'];
    }
    protected function _getEmployeeName() {

        $id = $this->_properties['user_id'];
        $users = TableRegistry::get('Users');
        $employee = $users->get($id)->extract(['full_name']);
        return $employee['full_name'];
    }

    protected function beforeSave()
    {
    }
}
?>