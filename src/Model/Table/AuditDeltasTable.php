<?php
namespace AuditLog\Model\Table;

use Cake\ORM\Table;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

class AuditDeltasTable extends Table
{
	public function initialize(array $config)
	{
		$this->belongsTo('AuditLog.Audits');
	}
}