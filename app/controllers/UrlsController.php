<?php

class UrlsController extends \BaseController {

	/**
	 * Display a listing of urls
	 *
	 * @return Response
	 */
	public function index()
	{
		$urls = Url::all();

		return View::make('urls.index', compact('urls'));
	}

	/**
	 * Show the form for creating a new url
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('urls.create');
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
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Url::create($data);

		return Redirect::route('urls.index');
	}

	/**
	 * Display the specified url.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$url = Url::findOrFail($id);

		return View::make('urls.show', compact('url'));
	}

	/**
	 * Show the form for editing the specified url.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$url = Url::find($id);

		return View::make('urls.edit', compact('url'));
	}

	/**
	 * Update the specified url in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$url = Url::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Url::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$url->update($data);

		return Redirect::route('urls.index');
	}

	/**
	 * Remove the specified url from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Url::destroy($id);

		return Redirect::route('urls.index');
	}

}
