<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ]
            ]
        ]);

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted_at'
        ]);

        $this->hasOne('WardManagers', [
            'foreignKey' => 'user_id', 
            'bindingKey' => 'id',
            'joinType' => 'LEFT'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('email_verified_at')
            ->allowEmptyDateTime('email_verified_at');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('two_factor_secret')
            ->allowEmptyString('two_factor_secret');

        $validator
            ->scalar('two_factor_recovery_codes')
            ->allowEmptyString('two_factor_recovery_codes');

        $validator
            ->dateTime('two_factor_confirmed_at')
            ->allowEmptyDateTime('two_factor_confirmed_at');

        $validator
            ->scalar('remember_token')
            ->maxLength('remember_token', 100)
            ->allowEmptyString('remember_token');

        $validator
            ->allowEmptyString('current_team_id');

        $validator
            ->scalar('profile_photo_path')
            ->maxLength('profile_photo_path', 2048)
            ->allowEmptyFile('profile_photo_path');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 16)
            ->allowEmptyString('telephone');

        $validator
            ->scalar('department')
            ->maxLength('department', 32)
            ->allowEmptyString('department');

        $validator
            ->scalar('employ_id')
            ->maxLength('employ_id', 32)
            ->allowEmptyString('employ_id');

        $validator
            ->scalar('roles')
            ->maxLength('roles', 3)
            ->allowEmptyString('roles');

        $validator
            ->scalar('user_type')
            ->maxLength('user_type', 3)
            ->notEmptyString('user_type');

        $validator
            ->dateTime('approval_date')
            ->allowEmptyDateTime('approval_date');

        $validator
            ->allowEmptyString('approval_user');

        $validator
            ->dateTime('last_activity_date')
            ->allowEmptyDateTime('last_activity_date');

        $validator
            ->allowEmptyString('visit_count');

        $validator
            ->scalar('wards_in_charge')
            ->maxLength('wards_in_charge', 1024)
            ->allowEmptyString('wards_in_charge');

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
    //     $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

    //     return $rules;
    // }
}
