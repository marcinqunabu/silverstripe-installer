<?php

use SilverStripe\CMS\Controllers\ContentController;

class PageController extends ContentController
{
	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array(
	);

	public function init()
	{
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
		/** Auto-load JS files from $ThemeDir/javascript directory */
		$ThemeDir = $this->ThemeDir();
		$js_folder = $ThemeDir.DIRECTORY_SEPARATOR.'javascript'.DIRECTORY_SEPARATOR;
		$files = glob(BASE_PATH.DIRECTORY_SEPARATOR.$js_folder.'*.js');
		$files = array_map(function($file) use($ThemeDir) {
			return $ThemeDir.DIRECTORY_SEPARATOR.'javascript'.DIRECTORY_SEPARATOR.pathinfo($file, PATHINFO_BASENAME);
		},$files);
		Requirements::combine_files(SSViewer::current_theme().'js', $files);
	}

	/** Check if environment is in dev mode */
	public function isDev()	{
		return Director::get_environment_type() == 'dev';
	}
}
