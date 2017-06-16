<?php
namespace Common\Model;

class SpecItemsModel extends \Think\Model{
	
	protected $_link = [
		'Spec'=> [
			'mapping_type'=>self::BELONGS_TO,
			'foreign_key'=>'spec_id',
		],
	];
}