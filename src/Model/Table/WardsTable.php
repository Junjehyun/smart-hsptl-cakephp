<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Wards Model
 *
 * @method \App\Model\Entity\Ward newEmptyEntity()
 * @method \App\Model\Entity\Ward newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ward[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ward get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ward findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ward patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ward[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ward|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ward saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ward[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ward[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ward[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ward[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class WardsTable extends Table
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

        $this->setTable('wards');
        $this->setDisplayField('ward_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ]
            ]
        ]);
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
            ->scalar('ward_type')
            ->maxLength('ward_type', 2)
            ->notEmptyString('ward_type');

        $validator
            ->scalar('ward_code')
            ->maxLength('ward_code', 10)
            ->requirePresence('ward_code', 'create')
            ->notEmptyString('ward_code');

        $validator
            ->scalar('ward_name')
            ->maxLength('ward_name', 100)
            ->requirePresence('ward_name', 'create')
            ->notEmptyString('ward_name');

        $validator
            ->scalar('ward_description')
            ->allowEmptyString('ward_description');

        $validator
            ->scalar('coordinator_code')
            ->maxLength('coordinator_code', 5)
            ->allowEmptyString('coordinator_code');

        $validator
            ->scalar('bgcolor')
            ->maxLength('bgcolor', 7)
            ->allowEmptyString('bgcolor');

        $validator
            ->scalar('image_name')
            ->maxLength('image_name', 200)
            ->allowEmptyFile('image_name');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 200)
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
