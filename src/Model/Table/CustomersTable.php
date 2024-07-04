<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('name');
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
            ->notEmptyString('customer_no')
            ->add('customer_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 32)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 2)
            ->notEmptyString('sex');

        $validator
            ->scalar('birthdate')
            ->maxLength('birthdate', 8)
            ->allowEmptyString('birthdate');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 32)
            ->allowEmptyString('telephone');

        $validator
            ->scalar('address')
            ->maxLength('address', 200)
            ->allowEmptyString('address');

        $validator
            ->scalar('ward_code')
            ->maxLength('ward_code', 10)
            ->allowEmptyString('ward_code');

        $validator
            ->scalar('room_code')
            ->maxLength('room_code', 10)
            ->allowEmptyString('room_code');

        $validator
            ->scalar('bed_no')
            ->maxLength('bed_no', 5)
            ->allowEmptyString('bed_no');

        $validator
            ->scalar('blood_type')
            ->maxLength('blood_type', 2)
            ->allowEmptyString('blood_type');

        $validator
            ->scalar('severity')
            ->maxLength('severity', 8)
            ->allowEmptyString('severity');

        $validator
            ->scalar('fall')
            ->maxLength('fall', 8)
            ->allowEmptyString('fall');

        $validator
            ->dateTime('hospitalized_date')
            ->allowEmptyDateTime('hospitalized_date');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->scalar('old_ward_code')
            ->maxLength('old_ward_code', 10)
            ->allowEmptyString('old_ward_code');

        $validator
            ->scalar('old_room_code')
            ->maxLength('old_room_code', 10)
            ->allowEmptyString('old_room_code');

        $validator
            ->scalar('old_bed_no')
            ->maxLength('old_bed_no', 5)
            ->allowEmptyString('old_bed_no');

        $validator
            ->scalar('status')
            ->maxLength('status', 2)
            ->notEmptyString('status');

        $validator
            ->allowEmptyString('device_seq');

        $validator
            ->scalar('device_name')
            ->maxLength('device_name', 100)
            ->allowEmptyString('device_name');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(\Cake\Datasource\RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['customer_no']), ['errorField' => 'customer_no']);

        return $rules;
    }
}
