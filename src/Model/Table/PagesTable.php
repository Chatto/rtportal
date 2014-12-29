<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pages Model
 */
class PagesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('pages');
		$this->displayField('name');
		$this->primaryKey('id');

	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->validatePresence('name', 'create')
			->notEmpty('name')
			->validatePresence('title', 'create')
			->notEmpty('title')
			->validatePresence('description', 'create')
			->notEmpty('description')
			->validatePresence('content', 'create')
			->notEmpty('content');

		return $validator;
	}

}
