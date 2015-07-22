<?php

class UserController extends \BaseController {

	private $usuario;
	private $users;

	public function __construct(User $usuario) {
		$this->usuario = $usuario;
		$this->users   = $usuario;

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
				return Redirect::to('/');
			} else {
				return Redirect::route('users.login')
					->with('message', 'Erro na validação dos dados!')
					->withInput(Input::all());
			}
		}
	}

	public function index() {
		$usuarios = User::all();

		return View::make('users.index', compact('usuarios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->usuario->rules);

		if ($validate->passes()) {
			$id = $this->usuario->create($input);
			return Redirect::route('users.edit', $id->id);
		} else {
			return "Erro";
		}
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
		$user = $this->usuario->find($id);
		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$this->usuario->rules = ['nome' => 'required|unique:usuarios,nome,'.$id];

		$validate = Validator::make($input, $this->usuario->rules);

		if ($validate->passes()) {
			if (empty($input['password'])) {
				unset($input['password']);
			}

			$user = $this->users->find($id);
			$user->update($input);

			return Redirect::route('users.edit', $id);
		} else {
			print_r($validate->errors());
		}
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
