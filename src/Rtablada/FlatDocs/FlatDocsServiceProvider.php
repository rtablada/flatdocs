<?php namespace Rtablada\FlatDocs;

use Illuminate\Support\ServiceProvider;

class FlatDocsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('rtablada/flat-docs');


	    include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['markdown'] = $this->app->share(function($app)
		{
			$str = new \Str();
			$config = new \Config();
			return new FlatDocs($config, $str);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}