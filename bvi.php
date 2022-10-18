<?php defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Plugin\CMSPlugin;

/**
 * Bvi plugin.
 *
 * @package   bvi
 * @since     1.0.0
 */
class plgSystemBvi extends CMSPlugin
{
	/**
	 * Application object
	 *
	 * @var    CMSApplication
	 * @since  1.0.0
	 */
	protected $app;

	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	protected $autoloadLanguage = true;


	/**
	 * onAfterCompileHead.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onBeforeCompileHead()
	{

		if (!$this->app->isClient('site'))
		{
			return;
		}

		HTMLHelper::_(
			'stylesheet', 'plg_system_bvi/bvi.css',
			['relative' => true, 'version' => 'auto']
		);

		HTMLHelper::_(
			'script', 'plg_system_bvi/bvi.js',
			['relative' => true, 'version' => 'auto'],
			['defer' => true]
		);

		HTMLHelper::_(
			'script', 'plg_system_bvi/bvi-init.min.js',
			['relative' => true, 'version' => 'auto'],
			['defer' => true]
		);

	}


	public function onAfterRender()
	{
		if (!$this->app->isClient('site'))
		{
			return;
		}

		$body = $this->app->getBody();

		if (strpos($body, '{bvi_target}') === false)
		{
			return true;
		}

		$body = str_replace('{bvi_target}', LayoutHelper::render(
			'plugins.system.bvi.toolbar.link',
			[
				'panel_active' => $this->bvi_panel_active,
				'openeye'      => (int) $this->params->get('openeye', 1),
				'opentext'     => (int) $this->params->get('opentext', 0),
				'closeeye'     => (int) $this->params->get('closeeye', 1),
				'closetext'    => (int) $this->params->get('closetext', 0),
			]
		), $body);

		$this->app->setBody($body);

		return true;
	}


}
