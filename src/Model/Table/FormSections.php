<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FormElementTable extends Table {
	public $associations = [
	];
    public function initialize(array $config) {
        $this->belongsTo('Form');
        $this->hasMany('FormItems');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name', 'Please enter a name!')
            ->notEmpty('label', 'Please enter a label');
        return $validator;
    }
}

?>