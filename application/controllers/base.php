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

    /**
     * Execute a controller action and return the response.
     *
     * Unlike the "execute" method, no filters will be run and the response
     * from the controller action will not be changed in any way before it
     * is returned to the consumer.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function response($method, $parameters = array())
    {
        // The developer may mark the controller as being "RESTful" which
        // indicates that the controller actions are prefixed with the
        // HTTP verb they respond to rather than the word "action".
        if ($this->restful)
        {
            if (method_exists($this, 'all_' . $method)) {
                $action = 'all_' . $method;
            } else {
                $action = strtolower(Request::method()).'_'.$method;
            }
        }
        else
        {
            $action = "action_{$method}";
        }

        $response = call_user_func_array(array($this, $action), $parameters);

        // If the controller has specified a layout view. The response
        // returned by the controller method will be bound to that
        // view and the layout will be considered the response.
        if (is_null($response) and ! is_null($this->layout))
        {
            $response = $this->layout;
        }

        return $response;
    }

}
