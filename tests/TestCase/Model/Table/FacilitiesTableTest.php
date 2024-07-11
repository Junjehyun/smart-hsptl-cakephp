<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacilitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacilitiesTable Test Case
 */
class FacilitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FacilitiesTable
     */
    protected $Facilities;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Facilities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Facilities') ? [] : ['className' => FacilitiesTable::class];
        $this->Facilities = $this->getTableLocator()->get('Facilities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Facilities);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FacilitiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
