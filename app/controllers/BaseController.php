<?php

class BaseController extends Controller {

	public $menu = [];

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	public static function getMenu($sistema_id){
		$menu = Auth::user()->menus()->where('menu_id', $sistema_id)->get();
		return $menu;
	}

}
