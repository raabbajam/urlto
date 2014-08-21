<?php
use Moment\Moment;
class Url extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'to' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['to'];

	public function getNewUrl()
	{
		return substr(md5(microtime()),rand(0,26),5);
	}
	
	public function getDates(){
		return ['created_at'];
	}
}
