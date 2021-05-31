<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.BVI
 *              
 * @version    1.0.0
 * @author     Artem Vasilev - webmasterskaya.xyz
 * @copyright  Copyright (c) 2021 Webmasterskaya. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link       https://webmasterskaya.xyz/
 */

defined('_JEXEC') or die;

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

	protected $bvi_panel_active = false;

	/**
	 * onAfterInitialise.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onAfterInitialise()
	{
		if (!$this->app->isClient('site'))
		{
			return;
		}

		$bvi_cookie = $this->app->input->cookie->get('bvi-panel-active', null, 'cmd');
		$bvi_request = $this->app->input->get('bvi-panel-active', null, 'int');

		if ($bvi_request !== null)
		{
			$this->bvi_panel_active = (bool)$bvi_request;
		} else {
			if($bvi_cookie !== null){
				$this->bvi_panel_active = ($bvi_cookie == 'true');
			}
			else {
				$this->bvi_panel_active = false;
			}
		}

		$this->app->input->cookie->set(
			'bvi-panel-active',
			$this->bvi_panel_active ? 'true' : 'false',
			time() + 86400, // Живёт сутки
			$this->app->get('cookie_path', '/'),
			$this->app->get('cookie_domain'),
			$this->app->isSSLConnection()
		);

	}

	/**
	 * onAfterCompileHead.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onBeforeCompileHead()
	{
		if ($this->bvi_panel_active)
		{
			HTMLHelper::_(
				'stylesheet', 'plg_system_bvi/bvi.min.css',
				['relative' => true, 'version' => 'auto']
			);
			HTMLHelper::_(
				'script', 'plg_system_bvi/bvi.min.js',
				['relative' => true, 'version' => 'auto'],
				['defer' => true]
			);
			HTMLHelper::_(
				'script', 'plg_system_bvi/js.cookie.min.js',
				['relative' => true, 'version' => 'auto'],
				['defer' => true]
			);
			HTMLHelper::_(
				'script', 'plg_system_bvi/bvi-init.min.js',
				['relative' => true, 'version' => 'auto'],
				['defer' => true]
			);
		}
	}

	public function onContentPrepare($context, &$item, &$params, $page = 0)
	{
		// If the item has a context, overwrite the existing one
		if ($context == 'com_finder.indexer' && !empty($item->context))
		{
			$context = $item->context;
		}
		elseif ($context == 'com_finder.indexer')
		{
			// Don't run this plugin when the content is being indexed and we have no real context
			return;
		}

		// Don't run if there is no text property (in case of bad calls) or it is empty
		if (empty($item->text))
		{
			return;
		}

		// Simple performance check to determine whether bot should process further
		if (strpos($item->text, 'bvi_target') === false)
		{
			return;
		}

		// Prepare the text
		if (isset($item->text))
		{
			$item->text = $this->prepare($item->text);
		}

		// Prepare the intro text
		if (isset($item->introtext))
		{
			$item->introtext = $this->prepare($item->introtext);
		}
	}

	protected function prepare($string)
	{
		ob_start();
		echo LayoutHelper::render(
			'plugins.system.bvi.toolbar.link',
			['panel_active' => $this->bvi_panel_active]
		);
		$target_template = ob_get_clean();

		$string = str_replace('{bvi_target}', $target_template, $string);

		return $string;
	}

	public function onAfterRender()
	{
		// TODO: Вынести все скрипты в подвал
		// TODO: Сделать все скрипты отложенными
		// TODO: Сделать init через wait
		return true;

		if (!$this->bvi_panel_active)
		{
			return true;
		}
		$bvi_scripts = '';

		$bvi_scripts_paths = [
			'bvi'    => HTMLHelper::_(
				'script', 'plg_system_bvi/bvi.min.js',
				['relative' => true, 'version' => 'auto', 'pathOnly' => true]
			),
			'cookie' => HTMLHelper::_(
				'script', 'plg_system_bvi/js.cookie.min.js',
				['relative' => true, 'version' => 'auto', 'pathOnly' => true]
			),
			'init'   => HTMLHelper::_(
				'script', 'plg_system_bvi/bvi-init.min.js',
				['relative' => true, 'version' => 'auto', 'pathOnly' => true]
			),
		];
		// Embed the code before the closing tag </body>.
		$body = $this->app->getBody();
		$body = str_replace("</body>", $bvi_scripts . "</body>", $body);

		$this->app->setBody($body);

		return true;
	}
}
