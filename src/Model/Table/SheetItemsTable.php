<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SheetItemsTable extends Table {
    public function initialize(array $config) {
        $this->belongsTo('Sheet');

    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('user_id', 'Please enter a user id')
            ->notEmpty('content', 'Please input a manager id');
        return $validator;
    }
}

?>