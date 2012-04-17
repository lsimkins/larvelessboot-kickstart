<?php

namespace Kickstart;

class Asset extends \Laravel\Asset
{
	/**
	 * Get an asset container instance.
	 *
	 * <code>
	 *		// Get the default asset container
	 *		$container = Asset::container();
	 *
	 *		// Get a named asset container
	 *		$container = Asset::container('footer');
	 * </code>
	 *
	 * @param  string            $container
	 * @return Asset_Container
	 */
	public static function container($container = 'default')
	{
		if ( ! isset(static::$containers[$container]))
		{
			static::$containers[$container] = new Asset_Container($container);
		}

		return static::$containers[$container];
	}
}

class Asset_Container extends \Laravel\Asset_Container
{
	/**
	 * Add an asset to the container.
	 *
	 * The extension of the asset source will be used to determine the type of
	 * asset being registered (CSS or JavaScript). When using a non-standard
	 * extension, the style/script methods may be used to register assets.
	 *
	 * <code>
	 *		// Add an asset to the container
	 *		Asset::container()->add('jquery', 'js/jquery.js');
	 *
	 *		// Add an asset that has dependencies on other assets
	 *		Asset::add('jquery', 'js/jquery.js', 'jquery-ui');
	 *
	 *		// Add an asset that should have attributes applied to its tags
	 *		Asset::add('jquery', 'js/jquery.js', null, array('defer'));
	 * </code>
	 *
	 * @param  string  $name
	 * @param  string  $source
	 * @param  array   $dependencies
	 * @param  array   $attributes
	 * @return void
	 */
	public function add($name, $source, $dependencies = array(), $attributes = array())
	{
		$ext = pathinfo($source, PATHINFO_EXTENSION);
		$type = (($ext == 'css') || ($ext == 'less')) ? 'style' : 'script';
		
		return $this->$type($name, $source, $dependencies, $attributes);
	}
}
