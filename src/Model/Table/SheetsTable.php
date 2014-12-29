<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SheetsTable extends Table {
    public function initialize(array $config) {
        $this->belongsTo('Users');
        $this->belongsTo('Form');
        $this->hasMany('SheetItems');
    }


    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name', 'Please enter a user id');
        return $validator;
    }
}

?>