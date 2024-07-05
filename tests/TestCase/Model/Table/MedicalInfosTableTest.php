<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MedicalInfosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MedicalInfosTable Test Case
 */
class MedicalInfosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MedicalInfosTable
     */
    protected $MedicalInfos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MedicalInfos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MedicalInfos') ? [] : ['className' => MedicalInfosTable::class];
        $this->MedicalInfos = $this->getTableLocator()->get('MedicalInfos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MedicalInfos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MedicalInfosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
