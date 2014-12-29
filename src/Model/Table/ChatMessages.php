<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChatMessagesTable extends Table {
	public function initialize(array $config) {
    $this->belongsTo('Users');
    }
    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('user_id', 'User ID needs to be sent')
            ->notEmpty('message', 'A message is required.')
           
            
    }
}

?>