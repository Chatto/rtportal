<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FormItemsTable extends Table {
	public $associations = [
	];
    public function initialize(array $config) {
        $this->belongsTo('FormSections');
        $this->hasMany('FormElements');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name', 'Please enter a name!');
        return $validator;
    }
}

?>