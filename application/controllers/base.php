<?php

use Laravel\View;
use Laravel\Response;

/**
 * Base Controller.
 * 
 */
class Base_Controller extends Controller {

	/**
	 * Load the default layout.
	 * @var string|View
	 */
	public $layout = 'layouts.default';
	
	/**
	 * Sets a view response.
	 * 
	 * @param string|View $layout
	 * @return Base_Controller
	 */
	public function set_layout($layout = null)
	{
		if (is_string($layout)) {
			$this->layout = $layout;
			$layout = $this->layout();
		}
		
		$this->layout = $layout;
		return $this;
	}
	
	/**
	 * Wraps the layout around the response.
	 * 
	 * @param Response $response
	 * @return void
	 */
	public function after($response)
	{
		if (!$this->layout instanceof View) {
			return;
		}
		$response->content = $this->layout->with('content', $response->content);
	}
	
	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}
