<?
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FilesTable extends Table {

    public function initialize(array $config) {
       // $this->belongsTo(['Users']);
    }

    public function validationDefault(Validator $validator) {
        $allowedTypes = [
            'audio/mpeg-3',
            'audio/mp3'
        ];
        $validator
            ->notEmpty('name', 'Please enter a file name!')
            ->notEmpty('description', 'Please write a description!');
        return $validator;
    }
}

?>