<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MeetingsTable extends Table {
    public function initialize(array $config) {
        //$this->addBehavior('Tree');
        $this->belongsToMany('Users');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('time', 'Please enter a time!')
            ->notEmpty('user_id', 'Please enter a user id!')
            ->notEmpty('manager_id', 'Please write a manager id!');
        return $validator;
    }
}

?>