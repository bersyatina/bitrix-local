<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?ShowError($arResult["ERROR_MESSAGE"]);?>

<?if ($arResult["TESTS_COUNT"] > 0):?>

	<?foreach ($arResult["TESTS"] as $arTest):?>
        <br>
        <p style="text-align: center;">
            <span style="font-family: 'Times New Roman', Times; font-size: 14pt;">
                <b><?=GetMessage("LEARNING_TEST_NAME")?>: <?=$arTest["NAME"];?></b><br />
            </span>
        </p>
        <br>
		<?if ($arTest["DESCRIPTION"] <> ''):?>
			<?=$arTest["DESCRIPTION"]?><br />
		<?endif?>
        <span style="font-family: 'Times New Roman', Times; font-size: 12pt;">
            <?if ($arTest["ATTEMPT_LIMIT"] > 0):?>
                <b><?=GetMessage("LEARNING_TEST_ATTEMPT_LIMIT")?>:</b> <?=$arTest["ATTEMPT_LIMIT"]?>
            <?else:?>
                <b><?=GetMessage("LEARNING_TEST_ATTEMPT_LIMIT")?>:</b> <?=GetMessage("LEARNING_TEST_ATTEMPT_UNLIMITED")?>
            <?endif?>
        </span>
		<br />
        <span style="font-family: 'Times New Roman', Times; font-size: 12pt;">
            <?if ($arTest["TIME_LIMIT"] > 0):?>
                <b><?=GetMessage("LEARNING_TEST_TIME_LIMIT")?>:</b> <?=$arTest["TIME_LIMIT"]?> <?=GetMessage("LEARNING_TEST_TIME_LIMIT_MIN")?>
            <?else:?>
                <b><?=GetMessage("LEARNING_TEST_TIME_LIMIT")?>:</b> <?=GetMessage("LEARNING_TEST_TIME_LIMIT_UNLIMITED")?>
            <?endif?>
        </span>
		<br />

        <span style="font-family: 'Times New Roman', Times; font-size: 12pt;">
            <b><?=GetMessage("LEARNING_PASSAGE_TYPE")?>:</b>
            <?if ($arTest["PASSAGE_TYPE"] == 2):?>
                <?=GetMessage("LEARNING_PASSAGE_FOLLOW_EDIT")?>
            <?elseif ($arTest["PASSAGE_TYPE"] == 1):?>
                <?=GetMessage("LEARNING_PASSAGE_FOLLOW_NO_EDIT")?>
            <?else:?>
                <?=GetMessage("LEARNING_PASSAGE_NO_FOLLOW_NO_EDIT")?>
            <?endif?>
        </span>
		<br />

		<?if ($arTest["PREVIOUS_TEST_ID"] > 0 && $arTest["PREVIOUS_TEST_SCORE"] > 0 && $arTest["PREVIOUS_TEST_LINK"]):?>
			<?=str_replace(array("#TEST_LINK#", "#TEST_SCORE#"), array('"'.$arTest["PREVIOUS_TEST_LINK"].'"', $arTest["PREVIOUS_TEST_SCORE"]), GetMessage("LEARNING_PREV_TEST_REQUIRED"))?>
			<br />
		<?endif?>

		<br />
		<form action="<?=$arTest["TEST_DETAIL_URL"]?>" method="post">
			<input type="hidden" name="COURSE_ID" value="<?=$arTest["COURSE_ID"]?>" />
			<input type="hidden" name="ID" value="<?=$arTest["ID"]?>" />
			<?if ($arTest["ATTEMPT"] === false):?>
				<input type="submit" name="next" class="btn btn-outline-primary btn-sm" value="<?=GetMessage("LEARNING_BTN_START")?>"<?php echo isset($arTest["PREVIOUS_NOT_COMPLETE"]) ? " disabled=\"1\"" : ""?> />
			<?else:?>
				<input type="submit" name="next" class="btn btn-outline-primary btn-sm" value="<?=GetMessage("LEARNING_BTN_CONTINUE")?>"<?php echo isset($arTest["PREVIOUS_NOT_COMPLETE"]) ? " disabled=\"1\"" : ""?> />
			<?endif?>
		</form>
		<div class="test-list-hr"></div>

	<?endforeach?>

	<?=$arResult["NAV_STRING"];?>

<?endif?>