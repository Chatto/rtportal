<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
    public function initialize(array $config) {
    $this->hasMany('Notes');
    //$this->belongsToMany('Sheets');
    $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('display_name', 'A display name is required.')
            ->notEmpty('email', 'An email is required.')
            ->notEmpty('employee_number', 'An employee number is required.')
            ->notEmpty('department', 'A department is required.')
            ->notEmpty('position', 'A position is required.');
            //->notEmpty('username', 'A display name is required.')
            //->notEmpty('password', 'A password is required.')
    }
}

?>