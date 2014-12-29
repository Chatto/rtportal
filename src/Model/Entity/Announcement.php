<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Announcement Entity.
 */
class Announcement extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'user_id' => true,
		'title' => true,
		'content' => true,
		'user' => true,
	];

}
