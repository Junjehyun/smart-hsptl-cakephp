<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MedicalCommentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MedicalCommentsTable Test Case
 */
class MedicalCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MedicalCommentsTable
     */
    protected $MedicalComments;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MedicalComments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MedicalComments') ? [] : ['className' => MedicalCommentsTable::class];
        $this->MedicalComments = $this->getTableLocator()->get('MedicalComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MedicalComments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MedicalCommentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
