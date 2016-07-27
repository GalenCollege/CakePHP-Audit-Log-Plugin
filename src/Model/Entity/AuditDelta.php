<?php
namespace AuditLog\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\ORM\TableRegistry;

class AuditDelta extends Entity
{
	
	protected function _getOldLookup()
	{

		$config = Configure::read('Audits.lookups');


		if(array_key_exists($this->property_name, $config)){
			try {
				$result = TableRegistry::get($config[$this->property_name]['className'])->get($this->old_value);
				$output = $result->{$config[$this->property_name]['field']};
			} catch(\Cake\Datasource\Exception\InvalidPrimaryKeyException $ex){
				$output = $this->old_value;
			} catch(\Cake\Datasource\Exception\RecordNotFoundException $ex){
				$output = $this->old_value;
			}
			
		} else {
			$output = $this->old_value;
		}
		
		return $output;
	}
	
	protected function _getNewLookup()
	{

		$config = Configure::read('Audits.lookups');

		if(array_key_exists($this->property_name, $config)){
			try {
				$result = TableRegistry::get($config[$this->property_name]['className'])->get($this->new_value);
				$output = $result->{$config[$this->property_name]['field']};
			} catch(\Cake\Datasource\Exception\InvalidPrimaryKeyException $ex){
				$output = $this->new_value;
			} catch(\Cake\Datasource\Exception\RecordNotFoundException $ex){
				$output = $this->old_value;
			}
		} else {
			$output = $this->new_value;
		}
		
		return $output;
	}
}