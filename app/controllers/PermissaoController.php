<?php

class PermissaoController extends \BaseController {

	private $usuario;
	private $rules = array(
		'nome'     => 'required',
		'user'     => 'required',
		'password' => 'required',
	);

	public function __construct(User $usuario) {
		$this->beforeFilter('permissao');
		$this->usuario = $usuario;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$usuarios = $this->usuario->all();

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

		$validation = Validator::make($input, $this->rules);

		if ($validation->passes()) {
			$input['password'] = Hash::make($input['password']);

			$this->usuario->create($input);

			return Redirect::route('acesso.user.index');
		}

		return Redirect::route('acesso.user.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
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

		$input = array_except(Input::all(), '_method');

		unset($input['_token']);
		$this->rules = array('nome' => 'required');

		if ($input['password'] == null) {
			unset($input['password']);
		} else {
			$input['password'] = Hash::make($input['password']);
		}

		if ($input['avatar'] == null) {
			unset($input['avatar']);
		}

		$validador = Validator::make($input, $this->rules);

		if ($validador->passes()) {
			if (isset($input['avatar'])) {
				Input::file('avatar')->move('img/users', $input['avatar']->getClientOriginalName());
				$input['avatar'] = $input['avatar']->getClientOriginalName();
			}

			$usuario = $this->usuario->find($id);

			$usuario->update($input);

			return Redirect::route('acesso.user.edit', $id);
		}

		return Redirect::route('acesso.user.index')
			->withInput()
			->withErrors($validador)
			->with('message', 'Houve erros na validação dos dados.');
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

	public function getSistema($idUsuario) {
		$usuario = $this->usuario->find($idUsuario);

		$menus = Menu::whereRaw('menu_pai is null')
			->orderBy('indice')
			->get();

		return View::make('users.sistema', compact('usuario'), compact('menus'));

	}

	public function postMenu() {
		$input = Input::all();

		$res = UsuarioPermissao::where('usuario_id', '=', $input['usuario_id'])
			->where('menu_id', '=', $input['menu_id'])	->count();

		if ($res == 0) {
			$return = UsuarioPermissao::create($input);
		} else {
			$return = UsuarioPermissao::where('usuario_id', '=', $input['usuario_id'])
				->where('menu_id', '=', $input['menu_id'])	->delete();
		}

		return $return;
	}
}
