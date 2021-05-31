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

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

/** @var array $displayData */
$data = (object) $displayData;
?>

<form action="" method="post">
	<input type="hidden" name="bvi-panel-active"
		   value="<?php echo $data->panel_active ? 0 : 1; ?>">
	<button role="button" type="submit"
			class="uk-button-small uk-button uk-button-text"
			title="<?php echo htmlspecialchars(
		        Text::_(
			        'PLG_SYSTEM_BVI_BUTTON_TEXT_' . ($data->panel_active ? 1 : 0)
		        )
	        ); ?>">
		<?php echo Text::_(
			'PLG_SYSTEM_BVI_BUTTON_TEXT_' . ($data->panel_active ? 1 : 0)
		); ?>
	</button>
</form>

<?php /* Это кАстыль для скрытия стандартных кнопок панели */ ?>
<div style="display: none !important;">
	<a href="#" class="bvi-open"> </a>
</div>