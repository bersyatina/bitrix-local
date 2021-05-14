<?
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<br />
<?if (!empty($arResult["COURSES"])):?>
<div class="container">
    <div class="list-group">
        <?foreach($arResult["COURSES"] as $arCourse):?>

            <a class="list-group-item list-group-item-action list-group-item-light" href="<?=$arCourse["COURSE_DETAIL_URL"]?>" target="_blank">
                <div class="row align-items-center">
                    <?if ($arCourse["PREVIEW_PICTURE_ARRAY"]!==false):?>
                        <div class="col-sm-2">
                        <?echo ShowImage(
                            $arCourse["PREVIEW_PICTURE_ARRAY"],
                            200,
                            200,
                            "hspace='2' vspace='2' align='left' border='0'"
                            . ' alt="' . htmlspecialcharsbx($arCourse['PREVIEW_PICTURE_ARRAY']['DESCRIPTION']) . '"',
                            "",
                            );?>
                        </div>
                    <?endif;?>
                    <div class="col-sm-9">
                        <div class="row align-items-center">
                            <div class="col-8 col-sm-6">
                                <h5><?=$arCourse["NAME"]?>.</h5>
                                <?if($arCourse["PREVIEW_TEXT"] <> ''):?>
                                    <?=$arCourse["PREVIEW_TEXT"]?>
                                <?endif?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?endforeach;?>
    </div>
</div>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
