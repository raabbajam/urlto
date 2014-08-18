<?php

class UrlsController extends \BaseController {

	/**
	 * Display a listing of urls
	 *
	 * @return Response
	 */
	public function index()
	{
		$urls = Url::take(10)->orderBy('created_at', 'desc')->get();
		foreach ($urls as $url) {
			$url->getMoment();
		}
		return View::make('urls.index', compact('urls'));
	}

	/**
	 * Store a newly created url in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Url::$rules);

		if ($validator->fails())
		{
			$response = [
				'error' => true,
				'message' => $validator->messages()
			];
			return Response::json($response, 200);
		}
		$to = strtolower(Input::get('to'));
		$url = Url::whereTo($to)->first();
		if(!$url) {
			$url = new Url;
			$url->to = $to;
			$unique = false;
			while(!$unique){
				$url->from = $url->getNewUrl();
				$unique = Url::whereFrom($url->from)->first() == null ? true: false;
			}
			$url->save();
		}
		$url->getMoment();
		$response = [
			'error' => false,
			'data' => $url->toArray()
		];

		return Response::json($response, 200);
	}

	public function to($any)
	{
		$url = Url::where('from', '=', $any)->first();
		if(!$url){
			$urls = Url::all()->take(5);
			return Redirect::to('/')
				->with('any', json_encode($any));
		}
		return Redirect::away($url->to);
	}
}
