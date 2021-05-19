<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php if (sizeof($arResult["ACCESS_ERRORS"])):?>

	<?php foreach ($arResult["ACCESS_ERRORS"] as $error):?>
        <div class="alert alert-danger" role="alert"><?php echo $error?></div>
	<?php endforeach?>

<?php else:?>

	<?if (!empty($arResult["QUESTION"])):?>
	<?php if (is_array($arResult["INCORRECT_QUESTION"])):?>
		<div class="alert alert-danger" role="alert">
            <?php if ($arResult["INCORRECT_QUESTION"]["ID"] != $arResult["QUESTION"]["ID"]):?>
				<?=GetMessage("INCORRECT_QUESTION_NAME");?>: <?php echo $arResult["INCORRECT_QUESTION"]["NAME"]?><br />
			<?php endif?>
			<?=GetMessage("INCORRECT_QUESTION_MESSAGE");?>: <?php echo $arResult["INCORRECT_QUESTION"]["INCORRECT_MESSAGE"]?>
		</div>
	<?php endif?>
	<div ><?=GetMessage("LEARNING_QUESTION_TITLE");?>&nbsp;

	<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2 && $arResult["NAV"]["PREV_NOANSWER"] != $arResult["NAV"]["PREV_QUESTION"] && $arResult["NAV"]["PREV_NOANSWER"]):?>

		<a class="previous" href="<?=$arResult["QBAR"][$arResult["NAV"]["PREV_NOANSWER"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_PREVIOUS_NOANSWER_TITLE")?>">&lsaquo;&lsaquo;</a>
		<a class="first" href="<?=$arResult["QBAR"][$arResult["NAV"]["PREV_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_PREVIOUS_TITLE")?>">&lsaquo;</a>

	<?elseif ($arResult["NAV"]["PREV_QUESTION"]):?>
		<a class="previous" href="<?=$arResult["QBAR"][$arResult["NAV"]["PREV_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_PREVIOUS_TITLE")?>">&lsaquo;</a>
	<?endif?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
        <?while($arResult["NAV"]["START_PAGE"] <= $arResult["NAV"]["END_PAGE"]):?>

                <?if ($arResult["NAV"]["START_PAGE"] == $arResult["NAV"]["PAGE_NUMBER"]):?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link" title="<?=GetMessage("LEARNING_QBAR_CURRENT_TITLE")?>"><?=$arResult["NAV"]["START_PAGE"]?></span>
                    </li>
                <?elseif ($arResult["QBAR"][$arResult["NAV"]["START_PAGE"]]["ANSWERED"] == "Y"):?>

                    <?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2):?>
                        <li class="page-item" aria-current="page">
                            <a href="<?=$arResult["QBAR"][$arResult["NAV"]["START_PAGE"]]["URL"]?>" class="page-link" title="<?=GetMessage("LEARNING_QBAR_ANSWERED_TITLE")?>"><?=$arResult["NAV"]["START_PAGE"]?></a>
                        </li>
                    <?else:?>
                        <li class="page-item disabled" aria-current="page">
                            <a class="page-link" title="<?=GetMessage("LEARNING_QBAR_ANSWERED_TITLE")?>"><?=$arResult["NAV"]["START_PAGE"]?></a>
                        </li>
                    <?endif?>

                <?else:?>

                    <?if ($arResult["TEST"]["PASSAGE_TYPE"] == 0):?>
                        <li class="page-item" aria-current="page">
                            <a class="page-link" title="<?=GetMessage("LEARNING_QBAR_NOANSWERED_TITLE")?>"><?=$arResult["NAV"]["START_PAGE"]?></a>
                        </li>
                    <?else:?>
                        <li class="page-item" aria-current="page">
                            <a class="page-link" title="<?=GetMessage("LEARNING_QBAR_NOANSWERED_TITLE")?>" href="<?=$arResult["QBAR"][$arResult["NAV"]["START_PAGE"]]["URL"]?>"><?=$arResult["NAV"]["START_PAGE"]?></a>
                        </li>
                    <?endif?>

                <?endif;?>

        <?
        $arResult["NAV"]["START_PAGE"]++;
        endwhile;
        ?>
        </ul>
    </nav>
	<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2 && $arResult["NAV"]["NEXT_NOANSWER"] != $arResult["NAV"]["NEXT_QUESTION"] && $arResult["NAV"]["NEXT_NOANSWER"]):?>

		<a class="last" href="<?=$arResult["QBAR"][$arResult["NAV"]["NEXT_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_NEXT_TITLE")?>">&rsaquo;</a>
		<a class="next" href="<?=$arResult["QBAR"][$arResult["NAV"]["NEXT_NOANSWER"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_NEXT_NOANSWER_TITLE")?>">&rsaquo;&rsaquo;</a>

	<?elseif ($arResult["NAV"]["NEXT_QUESTION"]):?>
		<a class="next" href="<?=$arResult["QBAR"][$arResult["NAV"]["NEXT_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_NEXT_TITLE")?>">&rsaquo;</a>
	<?endif?>

	<?if ($arResult["TEST"]["TIME_LIMIT"]>0 && $arParams["SHOW_TIME_LIMIT"] == "Y"):?>
		<div id="learn-test-timer" title="<?=GetMessage("LEARNING_TEST_TIME_LIMIT");?>"><?=$arResult["SECONDS_TO_END_STRING"]?></div>
		<script type="text/javascript">
			var clockID = null; clockID = setTimeout("UpdateClock(<?=$arResult["SECONDS_TO_END"]?>)", 950);
		</script>
	<?endif?>

	</div>

	<div class="alert alert-primary" role="alert">
        <h6><b><?=GetMessage("LEARNING_QUESTION_TITLE")?>
            <?=$arResult["NAV"]["PAGE_NUMBER"]?> <?=GetMessage("LEARNING_QUESTION_OF");?> <?=$arResult["NAV"]["PAGE_COUNT"]?></b>
        </h6>
        <hr>
		<div class="learn-question-name"><?=$arResult["QUESTION"]["NAME"]?>

			<?if ($arResult["QUESTION"]["DESCRIPTION"] <> ''):?>
				<br /><br /><?=$arResult["QUESTION"]["DESCRIPTION"]?>
			<?endif?>

			<?if ($arResult["QUESTION"]["FILE"] !== false):?>
				<br /><br /><img src="<?=$arResult["QUESTION"]["FILE"]["SRC"]?>" width="<?=$arResult["QUESTION"]["FILE"]["WIDTH"]?>" height="<?=$arResult["QUESTION"]["FILE"]["HEIGHT"]?>" />
			<?endif?>
		</div>
	</div>

	<br /><b><?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "T"):?><?=GetMessage("LEARNING_INPUT_ANSWER")?><?php else:?><?=GetMessage("LEARNING_CHOOSE_ANSWER")?><?php endif?>:</b>

	<form name="learn_test_answer" action="<?=$arResult["ACTION_PAGE"]?>" method="post">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="TEST_RESULT" value="<?=$arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["ID"]?>">
		<input type="hidden" name="<?=$arParams["PAGE_NUMBER_VARIABLE"]?>" value="<?=($arResult["NAV"]["PAGE_NUMBER"] + 1)?>">
		<input type="hidden" name="back_page" value="<?=$arResult["SAFE_REDIRECT_PAGE"]?>" />

		<?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "T"):?>
			<textarea name="answer" rows="5" cols="60"><?php echo (isset($arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"]) ? implode(',', $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"]) : "")?></textarea><br />
		<?php elseif ($arResult["QUESTION"]["QUESTION_TYPE"] == "R"):?>
			<?php for ($i = 0; $i < sizeof($arResult["QUESTION"]["ANSWERS"]); $i++):?>
				<div class="sorting">
				<?php echo $i+1?>.
				<select name="answer[]">
					<option value="0">&nbsp;</option>
					<?php for ($j = 0; $j < sizeof($arResult["QUESTION"]["ANSWERS"]); $j++):?>
						<option value="<?php echo $arResult["QUESTION"]["ANSWERS"][$j]["ID"]?>" <?php echo ($arResult["QUESTION"]["ANSWERS"][$j]["ID"] == $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"][$i] ? " selected" : "")?>><?php echo $arResult["QUESTION"]["ANSWERS"][$j]["ANSWER"]?></option>
					<?php endfor?>
				</select>
				</div>
			<?php endfor?>
		<?php else:?>
			<?foreach($arResult["QUESTION"]["ANSWERS"] as $arAnswer):?>

				<?if ($arResult["QUESTION"]["QUESTION_TYPE"] == "M"):?>
					<label><input type="checkbox" name="answer[]" value="<?=$arAnswer["ID"]?>" <?if (in_array($arAnswer["ID"], $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"])):?>checked <?endif?>/>&nbsp;<?=$arAnswer["ANSWER"]?></label><br />
				<?elseif ($arResult["QUESTION"]["QUESTION_TYPE"] == "S"):?>
					<label><input type="radio" name="answer" value="<?=$arAnswer["ID"]?>" <?if (in_array($arAnswer["ID"], $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"])):?>checked <?endif?>/>&nbsp;<?=$arAnswer["ANSWER"]?></label><br />
				<?endif?>

			<?endforeach?>
		<?php endif?>

		<br />

		<?if ($arResult["TEST"]["PASSAGE_TYPE"] > 0 && $arResult["NAV"]["PREV_QUESTION"]):?>
			<input type="submit" name="previous" onClick="javascript:window.location='<?=CUtil::JSEscape($arResult["QBAR"][$arResult["NAV"]["PREV_QUESTION"]]["URL"])?>'; return false;" value="<?=GetMessage("LEARNING_BTN_PREVIOUS")?>" />
		<?endif?>

            <input type="submit" name="next" class="btn btn-outline-primary btn-sm" value="<?=GetMessage("LEARNING_BTN_NEXT")?>"<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 0):?> OnClick="return <?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "R"):?>checkSorting('<?=GetMessage("LEARNING_INVALID_SORT_CONFIRM")?>');<?php else:?>checkForEmpty('<?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "T"):?><?=GetMessage("LEARNING_EMPTY_RESPONSE_CONFIRM")?><?php else:?><?=GetMessage("LEARNING_NO_RESPONSE_CONFIRM")?><?php endif?>');<?php endif?>"<?endif?>>

            <?php
            {
                ?>
                <input type="submit" name="finish" class="btn btn-outline-primary btn-sm" value="<?=GetMessage("LEARNING_BTN_FINISH")?>" onClick="return confirm('<?=GetMessage("LEARNING_BTN_CONFIRM_FINISH")?>')">
                <?php
            }
            ?>
            <input type="hidden" name="ANSWERED" value="Y">

	</form>
	<?php if (intval($arResult["TEST"]["CURRENT_INDICATION"]) > 0):?>
		<div><?php if ($arResult["TEST"]["CURRENT_INDICATION_PERCENT"] == "Y"):?><?=GetMessage("LEARNING_CURRENT_RIGHT_COUNT")?> - <?php echo $arResult["COMPLETE_PERCENT"]?>%.<?php endif?><?php if ($arResult["TEST"]["CURRENT_INDICATION_MARK"] == "Y" && $arResult["CURRENT_MARK"]):?> <?=GetMessage("LEARNING_CURRENT_MARK")?> - <?php echo $arResult["CURRENT_MARK"]?>.<?php endif?></div>
	<?php endif?>

	<?elseif ($arResult["TEST_FINISHED"] === true):?>

		<?ShowError($arResult["ERROR_MESSAGE"]);?>

		<?php if ($arResult["ATTEMPT"]["COMPLETED"]):?>
			<?php if ($arResult["ATTEMPT"]["COMPLETED"] == "N"):?>
                <div class="alert alert-danger" role="alert">
				    <?php ShowError(GetMessage("LEARNING_TEST_FAILED"))?>
                </div>
			<?php elseif ($arResult["ATTEMPT"]["COMPLETED"] == "Y"):?>
                <div class="alert alert-primary" role="alert">
				    <b><?php ShowNote(GetMessage("LEARNING_TEST_PASSED"));?></b>
                </div>
			<?php endif?>
		<?php endif?>
		<?php if (intval($arResult["TEST"]["FINAL_INDICATION"]) > 0):?>
			<table class="table table-bordered">
				<?php if ($arResult["TEST"]["FINAL_INDICATION_CORRECT_COUNT"] == "Y"):?>
					<tr class="table-primary">
						<th ><?php echo GetMessage("LEARNING_RESULT_QUESTIONS_COUNT")?></th>
						<td ><?php echo $arResult["ATTEMPT"]["QUESTIONS"]?></td>
					</tr>
					<tr class="table-primary">
						<th ><?php echo GetMessage("LEARNING_RESULT_RIGHT_COUNT")?></th>
						<td ><?php echo $arResult["ATTEMPT"]["CORRECT_COUNT"]?></td>
					</tr>
				<?php endif?>

				<?
				$percent = round($arResult["ATTEMPT"]["SCORE"] / $arResult["ATTEMPT"]["MAX_SCORE"] * 100, 2);
				?>

				<?php if ($arResult["TEST"]["FINAL_INDICATION_SCORE"] == "Y"):?>
				<tr class="table-primary">
					<th ><?php echo GetMessage("LEARNING_RESULT_MAX_SCORE")?></th>
					<td ><?php echo $arResult["ATTEMPT"]["MAX_SCORE"]?></td>
				</tr>
				<tr class="table-primary">
					<th ><?php echo GetMessage("LEARNING_RESULT_SCORE")?></th>
					<td ><?php echo $arResult["ATTEMPT"]["SCORE"]?> (<?=$percent?>%)</td>
				</tr>
				<?php endif?>
				<?php if (
					$arResult["ATTEMPT"]["MARK"] &&
					(
						$arResult["ATTEMPT"]["COMPLETED"] === "Y" ||
						(
							$arResult["ATTEMPT"]["COMPLETED"] === "N" &&
							$percent < $arResult["TEST"]["COMPLETED_SCORE"]
						)
					)
				):?>
					<?php if ($arResult["TEST"]["FINAL_INDICATION_MARK"] == "Y"):?>
						<tr class="table-primary">
							<th class="table-primary"><?php echo GetMessage("LEARNING_RESULT_MARK")?></th>
							<td class="table-primary"><?php echo $arResult["ATTEMPT"]["MARK"]?></td>
						</tr>
					<?php endif?>
					<?php if ($arResult["ATTEMPT"]["MESSAGE"] && $arResult["TEST"]["FINAL_INDICATION_MESSAGE"] == "Y"):?>
						<tr class="table-primary">
							<th class="table-primary"><?php echo GetMessage("LEARNING_RESULT_MESSAGE")?></th>
							<td class="table-primary"><?php echo $arResult["ATTEMPT"]["MESSAGE"]?></td>
						</tr>
					<?php endif?>
				<?php endif?>
			</table>
		<?php endif?>

        <br>
		<?php if ($arResult["GRADEBOOK_URL"]):?>
		<a type="button" class="btn btn-outline-primary btn-sm" href="<?=$arResult["GRADEBOOK_URL"]?>"><?=GetMessage("LEARNING_PROFILE")?></a>
		<?php endif?>

	<?elseif ($arResult["ERROR_MESSAGE"] <> ''):?>

		<?ShowError($arResult["ERROR_MESSAGE"]);?>
		<br />
		<form name="learn_test_start" method="post" action="<?=$arResult["ACTION_PAGE"]?>">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="back_page" value="<?=$arResult["SAFE_REDIRECT_PAGE"]?>" />
		<input type="submit" name="next" value="<?=GetMessage("LEARNING_BTN_CONTINUE")?>">
		</form>

	<?else:?>
<br>
        <p style="text-align: center;">
            <span style="font-family: 'Times New Roman', Times; font-size: 14pt;">
		<b><?=GetMessage("LEARNING_TEST_NAME")?>: <?=$arResult["TEST"]["NAME"];?></b><br />
    </span>
        </p>
        <br>
		<?if ($arResult["TEST"]["DESCRIPTION"] <> ''):?>
			<?=$arResult["TEST"]["DESCRIPTION"]?><br />
		<?endif?>
        <span style="font-family: 'Times New Roman', Times; font-size: 12pt;">
            <?if ($arResult["TEST"]["ATTEMPT_LIMIT"] > 0):?>
                <b><?=GetMessage("LEARNING_TEST_ATTEMPT_LIMIT")?>:</b> <?=$arResult["TEST"]["ATTEMPT_LIMIT"]?>
            <?else:?>
                <b><?=GetMessage("LEARNING_TEST_ATTEMPT_LIMIT")?>:</b> <?=GetMessage("LEARNING_TEST_ATTEMPT_UNLIMITED")?>
            <?endif?>
        </span>
		<br />
        <span style="font-family: 'Times New Roman', Times; font-size: 12pt;">
            <?if ($arResult["TEST"]["TIME_LIMIT"] > 0):?>
                <b><?=GetMessage("LEARNING_TEST_TIME_LIMIT")?>:</b> <?=$arResult["TEST"]["TIME_LIMIT"]?> <?=GetMessage("LEARNING_TEST_TIME_LIMIT_MIN")?>
            <?else:?>
                <b><?=GetMessage("LEARNING_TEST_TIME_LIMIT")?>:</b> <?=GetMessage("LEARNING_TEST_TIME_LIMIT_UNLIMITED")?>
            <?endif?>
        </span>
        <br />
        <span style="font-family: 'Times New Roman', Times; font-size: 12pt;">
            <b><?=GetMessage("LEARNING_PASSAGE_TYPE")?>:</b>
            <?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2):?>
                <?=GetMessage("LEARNING_PASSAGE_FOLLOW_EDIT")?>
            <?elseif ($arResult["TEST"]["PASSAGE_TYPE"] == 1):?>
                <?=GetMessage("LEARNING_PASSAGE_FOLLOW_NO_EDIT")?>
            <?else:?>
                <?=GetMessage("LEARNING_PASSAGE_NO_FOLLOW_NO_EDIT")?>
            <?endif?>
        </span>
        <br />

		<?if ($arResult["TEST"]["PREVIOUS_TEST_ID"] > 0 && $arResult["TEST"]["PREVIOUS_TEST_SCORE"] > 0 && $arResult["TEST"]["PREVIOUS_TEST_LINK"]):?>
			<?=str_replace(array("#TEST_LINK#", "#TEST_SCORE#"), array('"'.$arResult["TEST"]["PREVIOUS_TEST_LINK"].'"', $arResult["TEST"]["PREVIOUS_TEST_SCORE"]), GetMessage("LEARNING_PREV_TEST_REQUIRED"))?>
			<br />
		<?endif?>

		<br />
		<form name="learn_test_start" method="post" action="<?=$arResult["ACTION_PAGE"]?>">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="back_page" value="<?=$arResult["SAFE_REDIRECT_PAGE"]?>" />
		<input type="submit" name="next" class="btn btn-outline-primary btn-sm" value="<?=GetMessage("LEARNING_BTN_START")?>">
		</form>

	<?endif?>
<?php endif?>