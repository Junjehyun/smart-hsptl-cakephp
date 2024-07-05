<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MedicalInfos Model
 *
 * @method \App\Model\Entity\MedicalInfo newEmptyEntity()
 * @method \App\Model\Entity\MedicalInfo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MedicalInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MedicalInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\MedicalInfo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MedicalInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MedicalInfo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MedicalInfo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MedicalInfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MedicalInfo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MedicalInfo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MedicalInfo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MedicalInfo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MedicalInfosTable extends Table
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

        $this->setTable('medical_infos');
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
            ->scalar('department')
            ->maxLength('department', 32)
            ->allowEmptyString('department');

        $validator
            ->scalar('doctor_name')
            ->maxLength('doctor_name', 32)
            ->allowEmptyString('doctor_name');

        $validator
            ->scalar('department_code')
            ->maxLength('department_code', 8)
            ->allowEmptyString('department_code');

        $validator
            ->scalar('severity')
            ->maxLength('severity', 8)
            ->allowEmptyString('severity');

        $validator
            ->scalar('fall')
            ->maxLength('fall', 8)
            ->allowEmptyString('fall');

        $validator
            ->boolean('blood_warn')
            ->notEmptyString('blood_warn');

        $validator
            ->boolean('contact_warn')
            ->notEmptyString('contact_warn');

        $validator
            ->boolean('air_warn')
            ->notEmptyString('air_warn');

        $validator
            ->boolean('current_flag')
            ->notEmptyString('current_flag');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->allowEmptyString('creator_id');

        $validator
            ->allowEmptyString('updater_id');

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
