<?php defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/** @var array $displayData */
$data = (object) $displayData;
?>

<style>

    .bvi-icon-margin {
        margin-right: 5px;
    }

</style>

<a href="#" class="bvi-open">
	<?php if($data->openeye) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" <?php if($data->opentext) : ?>class="bvi-icon-margin"<?php endif; ?>><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)"><path d="M0 8s4-8 11-8 11 8 11 8-4 8-11 8S0 8 0 8z"/><circle cx="11" cy="8" r="3"/></g></svg>
	<?php endif; ?>

	<?php if($data->opentext) : ?>
        <span>
                <?php echo Text::_(
	                'PLG_SYSTEM_BVI_BUTTON_TEXT_1'
                ); ?>
            </span>
	<?php endif; ?>
</a>