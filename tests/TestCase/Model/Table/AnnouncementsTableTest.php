<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\AnnouncementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnnouncementsTable Test Case
 */
class AnnouncementsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Announcements') ? [] : ['className' => 'App\Model\Table\AnnouncementsTable'];
		$this->Announcements = TableRegistry::get('Announcements', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Announcements);

		parent::tearDown();
	}

}
