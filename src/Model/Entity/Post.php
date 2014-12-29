<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity.
 */
class Post extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'title' => true,
		'user_id' => true,
		'body' => true,
		'views' => true,
		'user' => true,
		'comments' => true,
		'tags' => true,
	];

}
