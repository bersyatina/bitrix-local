<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$found = false;
?>
<div class="btn-group" role="group" aria-label="Basic example">
<?
    foreach ($arResult["ITEMS"] as $key => $arItem):

	if ($arItem["SELECTED"]):?>

		<?if ($arItem["TYPE"] == "CD"):?>
            <a type="button" class="btn btn-outline-info btn-sm" href="<?=$arResult["ITEMS"][1]["URL"]?>"><?=GetMessage("LEARNING_START_COURSE")?></a>
		<?return;endif?>

		<?if (isset($arResult["ITEMS"][$key-1]) && $key > 1):?>
			<a type="button" class="btn btn-outline-info btn-sm" href="<?=$arResult["ITEMS"][$key-1]["URL"]?>"><?=$arResult["ITEMS"][$key-1]["NAME"]?></a>
		<?endif?>

            <a type="button" class="btn btn-outline-info btn-sm" href="<?=$arResult["ITEMS"][0]["URL"]?>"><?=$arResult["ITEMS"][0]["NAME"]?></a>

		<?if (isset($arResult["ITEMS"][$key+1])):?>
			<a type="button" class="btn btn-outline-info btn-sm" href="<?=$arResult["ITEMS"][$key+1]["URL"];?>"> <?=$arResult["ITEMS"][$key+1]["NAME"]?></a>
		<?endif?>

		<?
		$found = true;
		break;

	endif;

endforeach;?>
</div>
<?if ($found === false):?>
    &nbsp;<a type="button" class="btn btn-outline-info btn-sm" href="<?=$arResult["ITEMS"][1]["URL"]?>"><?=GetMessage("LEARNING_START_COURSE")?></a>
<?endif?>