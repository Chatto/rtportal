<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NotesTable extends Table {
	public $associations = [
		'belongsTo' => ['User']
	];
    public function initialize(array $config) {
        //$this->addBehavior('Tree');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('subject', 'Please enter a subject!')
            ->notEmpty('content', 'Please write a note!');
        return $validator;
    }
}

?>