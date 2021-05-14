<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<?
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>
<div class="search-form">
<form class="d-flex" action="<?=$arResult["FORM_ACTION"]?>">
	<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
	);?><?else:?><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q" value="" size="15" maxlength="50" /><?endif;?>&nbsp;<input name="s" type="submit" class="btn btn-outline-success" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
</form>
</div>