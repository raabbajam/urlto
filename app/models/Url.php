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
	public function getMoment()
	{
		$phpdate = strtotime( $this->created_at );
		$atom = date("Y-m-d\TH:i:s", $phpdate);
		$m = new Moment($atom, 'Asia/Jakarta');
		$this->moment = $m->calendar();
	}

}
