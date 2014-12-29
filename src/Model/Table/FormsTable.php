<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FormsTable extends Table {
    public function initialize(array $config) {
        $this->hasMany('FormSections');
        $this->hasMany('Sheets');
        $this->addbehavior('Tree');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('subject', 'Please enter a subject!')
            ->notEmpty('content', 'Please write a note!');
        return $validator;
    }
}

?>