<?php
namespace AuditLog\Model\Table;

use Cake\ORM\Table;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

class AuditsTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
		$this->hasMany('AuditLog.AuditDeltas');
		
		if(Configure::check('Audits.sourceClassName')){
			$this->belongsTo('CreatedBy', [
				'foreignKey' => 'source_id',
				'className' => Configure::read('Audits.sourceClassName')
			]);
		}
	}
}