<?php

class UserController extends \BaseController {

	private $usuario;
	private $rules = array(
		'nome' => 'required',
	);

	public function __construct(User $usuario) {
		$this->usuario = $usuario;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function getLogin() {
		if (Auth::check()) {
			return Redirect::to('/dashboard');
		} else {
			return Redirect::route('users.login');
		}
	}

	public function postLogin() {

		if (!Input::all()) {
			return View::make('login.login');
		} else {
			$input = array_except(Input::all(), '_token');

			if (Auth::attempt($input)) {
				return Redirect::route('users.users.index');
			} else {
				return Redirect::route('users.login')
					->with('message', 'Erro na validação dos dados!');
			}
		}
	}

	public function index() {
		$usuario = User::find(Auth::user()->id);

		return View::make('dashboard.index', compact('usuario'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$usuario = $this->usuario->find($id);

		return View::make('users.index', compact('usuario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
