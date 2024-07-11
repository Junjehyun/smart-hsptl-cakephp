<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facilities Model
 *
 * @method \App\Model\Entity\Facility newEmptyEntity()
 * @method \App\Model\Entity\Facility newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Facility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facility get($primaryKey, $options = [])
 * @method \App\Model\Entity\Facility findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Facility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Facility[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facility|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facility saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facility[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Facility[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Facility[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Facility[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FacilitiesTable extends Table
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

        $this->setTable('facilities');
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
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmptyString('name');

        $validator
            ->scalar('owner_name')
            ->maxLength('owner_name', 50)
            ->allowEmptyString('owner_name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('logo_image_name')
            ->maxLength('logo_image_name', 200)
            ->allowEmptyFile('logo_image_name');

        $validator
            ->scalar('logo_short_image_name')
            ->maxLength('logo_short_image_name', 200)
            ->allowEmptyFile('logo_short_image_name');

        $validator
            ->scalar('background_image_name')
            ->maxLength('background_image_name', 200)
            ->allowEmptyFile('background_image_name');

        $validator
            ->boolean('banner_display_flag')
            ->notEmptyString('banner_display_flag');

        $validator
            ->scalar('layout_no')
            ->maxLength('layout_no', 2)
            ->allowEmptyString('layout_no');

        $validator
            ->scalar('room_layout_no')
            ->maxLength('room_layout_no', 2)
            ->allowEmptyString('room_layout_no');

        $validator
            ->scalar('bed_layout_no')
            ->maxLength('bed_layout_no', 2)
            ->allowEmptyString('bed_layout_no');

        $validator
            ->scalar('status')
            ->maxLength('status', 2)
            ->notEmptyString('status');

        $validator
            ->notEmptyString('license_count');

        $validator
            ->scalar('lang_type')
            ->maxLength('lang_type', 2)
            ->notEmptyString('lang_type');

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
