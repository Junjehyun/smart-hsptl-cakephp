<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Masters Model
 *
 * @method \App\Model\Entity\Master newEmptyEntity()
 * @method \App\Model\Entity\Master newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Master[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Master get($primaryKey, $options = [])
 * @method \App\Model\Entity\Master findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Master patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Master[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Master|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Master saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Master[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Master[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Master[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Master[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MastersTable extends Table
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

        $this->setTable('masters');
        $this->setDisplayField('master_key');
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
            ->scalar('master_key')
            ->maxLength('master_key', 3)
            ->requirePresence('master_key', 'create')
            ->notEmptyString('master_key');

        $validator
            ->scalar('master_name')
            ->maxLength('master_name', 128)
            ->requirePresence('master_name', 'create')
            ->notEmptyString('master_name');

        $validator
            ->scalar('item_code')
            ->maxLength('item_code', 5)
            ->requirePresence('item_code', 'create')
            ->notEmptyString('item_code');

        $validator
            ->scalar('item_name')
            ->maxLength('item_name', 128)
            ->requirePresence('item_name', 'create')
            ->notEmptyString('item_name');

        $validator
            ->scalar('item_nm_short')
            ->maxLength('item_nm_short', 64)
            ->allowEmptyString('item_nm_short');

        $validator
            ->scalar('item_nm_eng')
            ->maxLength('item_nm_eng', 128)
            ->allowEmptyString('item_nm_eng');

        $validator
            ->integer('sort_order')
            ->allowEmptyString('sort_order');

        $validator
            ->boolean('use_flag')
            ->notEmptyString('use_flag');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
