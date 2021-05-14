<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>

<?if (!empty($arResult["ITEMS"])):?>

<div>
    <ul сlass="list-group">
	<?
		$bracketLevel = 0;
		foreach ($arResult["ITEMS"] as $arItem):
			if ( $arItem["DEPTH_LEVEL"] <= $bracketLevel )
			{
				$deltaLevel = $bracketLevel - $arItem['DEPTH_LEVEL'] + 1;
				echo str_repeat("</ul></li>", $deltaLevel);
				$bracketLevel -= $deltaLevel;
			}
		?>

		<?if ($arItem["TYPE"] == "CH"):
			$bracketLevel++;
		?>
			<li<?if($arItem["CHAPTER_OPEN"] === false):?> class="close"<?elseif($arItem["SELECTED"] === true):?> class="selected"<?endif?>>
				<div class="chapter" <?php if (!$arItem['DELAYED']) { ?>onClick="JMenu.OpenChapter(this,'<?=$arItem["ID"]?>')"<?php } ?>></div>
				<div class="item-text"><a
					<?php if ($arItem['DELAYED']) echo 'style="color:gray;"'; ?>
					href="<?php
					if ( ! $arItem['DELAYED'] )
						echo $arItem["URL"];
					else
						echo 'javascript:void(0);';
				?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>><?php
					echo $arItem["NAME"];
					if ($arItem['DELAYED'])
					{
						echo ' (' 
							. str_replace(
								'#DATE#',
								$arItem['DELAYED'],
								GetMessage('LEARNING_AVAILABLE_SINCE')
							)
							. ')';
					}
					?></a>Тест4</div>
				<ul>
		<?elseif($arItem["TYPE"] == "LE"):?>
			<li>
				<div class="item-text"><a <?php if ($arItem['DELAYED']) echo 'style="color:gray;"'; ?>
					href="<?php
					if ( ! $arItem['DELAYED'] )
						echo $arItem["URL"];
					else
						echo 'javascript:void(0);';
				?>"<?if($arItem["SELECTED"]):?> class="list-group-item list-group-item-action list-group-item-secondary"<?else:?> class="list-group-item list-group-item-action list-group-item-secondary" <?endif?>><?php
					echo $arItem["NAME"];
					if ($arItem['DELAYED'])
					{
						echo ' (' 
							. str_replace(
								'#DATE#',
								$arItem['DELAYED'],
								GetMessage('LEARNING_AVAILABLE_SINCE')
							)
							. ')';
					}
					?></a></div>
			</li>
		<?elseif($arItem["TYPE"] == "CD"):?>
			<li>
				<div class="item-text list-group"><a href="<?=$arItem["URL"]?>"<?if($arItem["SELECTED"]):?> class="list-group-item list-group-item-action list-group-item-secondary"<?else:?> class="list-group-item list-group-item-action list-group-item-secondary"<?endif?>><?=$arItem["NAME"]?></a></div>
			</li>
		<?elseif($arItem["TYPE"] == "TL"):?>
			<li>
				<div class="item-text"><a href="<?=$arItem["URL"]?>"<?if($arItem["SELECTED"]):?> class="list-group-item list-group-item-action list-group-item-secondary"<?else:?> class="list-group-item list-group-item-action list-group-item-secondary"<?endif?>><?=$arItem["NAME"]?></a></div>
			</li>
		<?endif?>

	<?endforeach?>

	</ul>
</div>

<script type="text/javascript">
	var JMenu = new JCMenu('<?=(array_key_exists("LEARN_MENU_".$arParams["COURSE_ID"],$_COOKIE ) ? CUtil::JSEscape($_COOKIE["LEARN_MENU_".$arParams["COURSE_ID"]]) :"")?>', '<?=$arParams["COURSE_ID"]?>');
</script>

<?endif?>