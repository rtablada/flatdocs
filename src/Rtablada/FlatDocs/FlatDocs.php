<?php namespace Rtablada\FlatDocs;

use dflydev\markdown\MarkdownParser;

class FlatDocs extends \Controller
{
	public function __construct(\Config $config, \Str $str)
	{
		$this->config = $config;
		$this->str = $str;
		$this->registeredDocs = \Config::get('flat-docs::registeredDocs');
		$this->prefix = \Config::get('flat-docs::routePrefix');
		$this->path = \Config::get('flat-docs::path');
	}

	public function index($uri)
	{
		if ($this->uriExists($uri)) {
			$file = $uri . '.md';
			$content = $this->parseFile($file);
		} else {
			$content = $this->parseFile('404.md');
		}

		$title = \Config::get('flat-docs::title');
		$nav = $this->createNav($uri);

		return \View::make('flat-docs::template', compact('title','content', 'nav'));
	}

	public function uriExists($uri)
	{
		$registeredDocs = $this->registeredDocs;

		$uriSegments = $this->breakSegments($uri);

		while (count($uriSegments) > 1) {
			$found = false;
			foreach ($registeredDocs as $parent => $child) {
				if (is_string($parent)) {
					if ($this->getSlug($parent) == $uriSegments[0]) {
						array_shift($uriSegments);
						$registeredDocs = $registeredDocs[$parent];
						$found = true;
						break;
					}
				}
			}
			if (!$found) {
				return false;
			}
		}
		
		$slugAndPretty = $this->getSlugAndPretty($uriSegments[0]);

		foreach ($registeredDocs as $value) {
			if (is_string($value)) {
				if ($this->getSlug($value) == $uriSegments[0]) {
					return true;
				}
			}
		}

		return false;
	}

	public function breakSegments($uri)
	{

		$break = strpos($uri, '/');

		// Check if we have reached the end?
		if (!$break) {
			return array($uri);
		} else {
			$segment = substr($uri, 0, $break);
			$remaining = substr($uri, $break + 1);
			return array_merge(array($segment), $this->breakSegments($remaining));
		}
	}

	public function getSlugAndPretty($string)
	{
		$break = strpos($string, ':');

		if (!$break) {
			$slug = $this->str->camel($string);
			$pretty = ucwords($string);
		} else {
			$slug = $this->str->camel(substr($string, 0, $break));
			$pretty = ucwords(substr($string, $break + 1));
		}

		return array($slug => $pretty);
	}

	public function getSlug($string)
	{
		$slugAndPretty = $this->getSlugAndPretty($string);
		return array_keys($slugAndPretty)[0];
	}

	public function getPretty($string)
	{
		$slugAndPretty = $this->getSlugAndPretty($string);
		$slug = $this->getSlug($string);
		return $slugAndPretty[$slug];
	}

	public function createNav($uri)
	{
		$registeredDocs = $this->registeredDocs;
		$nav = '<ul class="nav nav-list">';
		$nav .= $this->parseNav($registeredDocs);
		$nav .= '</ul>';
		return $nav;
	}

	public function parseNav($registeredDocs, $prefix = null)
	{
		$nav = '';
		foreach ($registeredDocs as $parent => $child) {
			if (is_string($parent)){
				$pretty = $this->getPretty($parent);
				$slug = $this->getSlug($parent);
				$nav .= '<li class="nav-header">' . $pretty . '</li>';
				$nav .= $this->parseNav($registeredDocs[$parent], "{$slug}/");
			} else {
				$slug = $this->getSlug($child);
				$pretty = $this->getPretty($child);
				$nav .= '<li>' . \HTML::link("{$this->prefix}/{$prefix}{$slug}", $pretty) . '</li>';
			}
		}

		return $nav;
	}

	public function parseFile($filename)
	{
		$mdParser = new MarkdownParser();
		return $mdParser->transformMarkdown(\File::get($this->path . '/' . $filename));
	}
}
/*
docs/api

array(
	'api' => array(
		'v1' => array(
			'acount:A'
		),
		'future'
	),
	'started'
)
*/