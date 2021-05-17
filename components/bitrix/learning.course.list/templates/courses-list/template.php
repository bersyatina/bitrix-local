<?
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<br />
<?if (!empty($arResult["COURSES"])):?>
<div class="container-fluid">
    <div class="list-group">
        <?foreach($arResult["COURSES"] as $arCourse):?>
            <div class="row align-items-center">
            <a class="list-group-item list-group-item-action list-group-item-light" href="<?=$arCourse["COURSE_DETAIL_URL"]?>" target="_blank">
                <?if ($arCourse["PREVIEW_PICTURE_ARRAY"]!==false):?>
                    <div class="col-sm-3">
                        <p>
                            <?echo ShowImage(
                                $arCourse["PREVIEW_PICTURE_ARRAY"],
                                200,
                                200,
                                "hspace='2' vspace='2' align='left' border='0'"
                                . ' alt="' . htmlspecialcharsbx($arCourse['PREVIEW_PICTURE_ARRAY']['DESCRIPTION']) . '"',
                                "",
                                );?>
                        </p>
                    </div>
                <?endif;?>
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <h5 class="text-primary"><?=$arCourse["NAME"]?>.</h5>
                        <p class="text-dark">
                            <?if($arCourse["PREVIEW_TEXT"] <> ''):?>
                                <?=$arCourse["PREVIEW_TEXT"]?>
                            <?endif?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?endforeach;?>
    </div>
</div>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
