<?
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class Form extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];
    // ...

    protected function _getTreeList()
    {
        $list = $this->find('treeList');
        return $list;
    }

    protected function beforeSave()
    {

    }
}
?>