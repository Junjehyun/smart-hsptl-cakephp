<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmartTags Model
 *
 * @method \App\Model\Entity\SmartTag newEmptyEntity()
 * @method \App\Model\Entity\SmartTag newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SmartTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SmartTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\SmartTag findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SmartTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SmartTag[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SmartTag|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmartTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmartTag[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SmartTag[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SmartTag[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SmartTag[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SmartTagsTable extends Table
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

        $this->setTable('smart_tags');
        $this->setDisplayField('tag_id');
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
            ->scalar('tag_id')
            ->maxLength('tag_id', 16)
            ->requirePresence('tag_id', 'create')
            ->notEmptyString('tag_id')
            ->add('tag_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('mac_address')
            ->maxLength('mac_address', 32)
            ->allowEmptyString('mac_address')
            ->add('mac_address', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('tag_location')
            ->maxLength('tag_location', 32)
            ->allowEmptyString('tag_location');

        $validator
            ->scalar('tag_location_nm')
            ->maxLength('tag_location_nm', 128)
            ->allowEmptyString('tag_location_nm');

        $validator
            ->scalar('tag_type')
            ->maxLength('tag_type', 2)
            ->allowEmptyString('tag_type');

        $validator
            ->scalar('gateway_ip')
            ->maxLength('gateway_ip', 32)
            ->allowEmptyString('gateway_ip');

        $validator
            ->scalar('job_type')
            ->maxLength('job_type', 16)
            ->allowEmptyString('job_type');

        $validator
            ->scalar('job_result')
            ->maxLength('job_result', 16)
            ->allowEmptyString('job_result');

        $validator
            ->scalar('battery_charge_rate')
            ->maxLength('battery_charge_rate', 8)
            ->allowEmptyString('battery_charge_rate');

        $validator
            ->scalar('temperature')
            ->maxLength('temperature', 8)
            ->allowEmptyString('temperature');

        $validator
            ->scalar('receive_power')
            ->maxLength('receive_power', 8)
            ->allowEmptyString('receive_power');

        $validator
            ->scalar('version')
            ->maxLength('version', 8)
            ->allowEmptyString('version');

        $validator
            ->boolean('use_flag')
            ->notEmptyString('use_flag');

        $validator
            ->scalar('old_tag_location')
            ->maxLength('old_tag_location', 32)
            ->allowEmptyString('old_tag_location');

        $validator
            ->scalar('old_tag_location_nm')
            ->maxLength('old_tag_location_nm', 128)
            ->allowEmptyString('old_tag_location_nm');

        $validator
            ->dateTime('latest_update')
            ->allowEmptyDateTime('latest_update');

        $validator
            ->integer('creator_id')
            ->allowEmptyString('creator_id');

        $validator
            ->integer('updater_id')
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
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->isUnique(['tag_id']), ['errorField' => 'tag_id']);
    //     $rules->add($rules->isUnique(['mac_address'], ['allowMultipleNulls' => true]), ['errorField' => 'mac_address']);

    //     return $rules;
    // }
}
