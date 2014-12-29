<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FormSectionsTable extends Table {
	public $associations = [
	];
    public function initialize(array $config) {
        $this->belongsTo('Forms');
        $this->hasMany('FormItems');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name', 'Please enter a name!');
        return $validator;
    }
}

?>