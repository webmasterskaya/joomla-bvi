<?php defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/** @var array $displayData */
$data = (object) $displayData;
?>
<style>
    .bvi-button-toggle {
        display: flex;
        align-items: center;
        align-content: center;
    }

    .bvi-icon-margin {
        margin-right: 5px;
    }

</style>

<form action="" method="post">
    <input type="hidden" name="bvi-panel-active"
           value="<?php echo $data->panel_active ? 0 : 1; ?>">
    <button role="button" type="submit"
            class="uk-button-small uk-button uk-button-text bvi-button-toggle"
            title="<?php echo htmlspecialchars(
		        Text::_(
			        'PLG_SYSTEM_BVI_BUTTON_TEXT_' . ($data->panel_active ? 1 : 0)
		        )
	        ); ?>">

        <?php if($data->panel_active) : ?>

            <?php if($data->openeye) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" <?php if($data->opentext) : ?>class="bvi-icon-margin"<?php endif; ?>><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24M1 1l22 22"/></svg>
	        <?php endif; ?>

	        <?php if($data->opentext) : ?>
                <span>
                    <?php echo Text::_(
                        'PLG_SYSTEM_BVI_BUTTON_TEXT_1'
                    ); ?>
                </span>
	        <?php endif; ?>

        <?php else: ?>

	        <?php if($data->closeeye) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" <?php if($data->closetext) : ?>class="bvi-icon-margin"<?php endif; ?>><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)"><path d="M0 8s4-8 11-8 11 8 11 8-4 8-11 8S0 8 0 8z"/><circle cx="11" cy="8" r="3"/></g></svg>
	        <?php endif; ?>

	        <?php if($data->closetext) : ?>
                <span>
                    <?php echo Text::_(
                        'PLG_SYSTEM_BVI_BUTTON_TEXT_0'
                    ); ?>
                </span>
	        <?php endif; ?>

        <?php endif; ?>

    </button>
</form>

<?php /* Это кАстыль для скрытия стандартных кнопок панели */ ?>
<div style="display: none !important;">
    <a href="#" class="bvi-open" data-active="<?php echo $data->panel_active ? 1 : 0; ?>"> </a>
</div>