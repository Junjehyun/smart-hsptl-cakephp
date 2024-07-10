<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MedicalComments Model
 *
 * @method \App\Model\Entity\MedicalComment newEmptyEntity()
 * @method \App\Model\Entity\MedicalComment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MedicalComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MedicalComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\MedicalComment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MedicalComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MedicalComment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MedicalComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MedicalComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MedicalComment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MedicalComment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MedicalComment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MedicalComment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MedicalCommentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('medical_comments');
        $this->setDisplayField('customer_no');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('customer_no')
            ->maxLength('customer_no', 32)
            ->requirePresence('customer_no', 'create')
            ->notEmptyString('customer_no');

        $validator
            ->scalar('department_code')
            ->maxLength('department_code', 8)
            ->allowEmptyString('department_code');

        $validator
            ->scalar('employ_id')
            ->maxLength('employ_id', 32)
            ->allowEmptyString('employ_id');

        $validator
            ->scalar('comments')
            ->allowEmptyString('comments');

        $validator
            ->dateTime('create_date')
            ->requirePresence('create_date', 'create')
            ->notEmptyDateTime('create_date');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        $validator
            ->dateTime('deleted_at')
            ->allowEmptyDateTime('deleted_at');

        return $validator;
    }
}
