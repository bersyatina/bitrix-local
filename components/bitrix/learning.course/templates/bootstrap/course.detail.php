<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    use Bitrix\Main\UI\Extension;
    Extension::load('ui.bootstrap4');
?>
<div>ТЕСТ3</div>
<div class="container">
    <table class="learn-work-table">
        <tr class="learn-left-data">

            <?if (intval($arParams["COURSE_ID"]) > 0):?>
                <?$APPLICATION->IncludeComponent("bitrix:learning.course.tree", "", Array(
                    "COURSE_ID"	=> $arParams["COURSE_ID"],
                    "COURSE_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["course.detail"],
                    "CHAPTER_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["chapter.detail"],
                    "LESSON_DETAIL_TEMPLATE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["lesson.detail"],
                    "SELF_TEST_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test.self"],
                    "TESTS_LIST_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test.list"],
                    "TEST_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test"],
                    "CHECK_PERMISSIONS"	=> $arParams["CHECK_PERMISSIONS"],
                    "SET_TITLE"	=> $arParams["SET_TITLE"],
                    'LEARNING_GROUP_ACTIVE_FROM'          => $arResult['LEARNING_GROUP_ACTIVE_FROM'],
                    'LEARNING_GROUP_ACTIVE_TO'            => $arResult['LEARNING_GROUP_ACTIVE_TO'],
                    'LEARNING_GROUP_CHAPTERS_ACTIVE_FROM' => $arResult['LEARNING_GROUP_CHAPTERS_ACTIVE_FROM']
                ),
                    $component
                );?>
            <?endif?>

        </tr>
        <tr>

            <td class="learn-right-data" valign="top">


            <?$APPLICATION->IncludeComponent("bitrix:learning.course.detail", "", Array(
                "COURSE_ID" => $arParams["COURSE_ID"],
                "CHECK_PERMISSIONS" => $arParams["CHECK_PERMISSIONS"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                ),
                $component
            );?>

            <?if (intval($arParams["COURSE_ID"]) > 0):?>
                <br /><br />
                <?$APPLICATION->IncludeComponent("bitrix:learning.course.tree", "navigation", Array(
                    "COURSE_ID"	=> $arParams["COURSE_ID"],
                    "COURSE_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["course.detail"],
                    "CHAPTER_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["chapter.detail"],
                    "LESSON_DETAIL_TEMPLATE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["lesson.detail"],
                    "SELF_TEST_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test.self"],
                    "TESTS_LIST_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test.list"],
                    "TEST_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test"],
                    "CHECK_PERMISSIONS"	=> $arParams["CHECK_PERMISSIONS"],
                    'LEARNING_GROUP_ACTIVE_FROM'          => $arResult['LEARNING_GROUP_ACTIVE_FROM'],
                    'LEARNING_GROUP_ACTIVE_TO'            => $arResult['LEARNING_GROUP_ACTIVE_TO'],
                    'LEARNING_GROUP_CHAPTERS_ACTIVE_FROM' => $arResult['LEARNING_GROUP_CHAPTERS_ACTIVE_FROM'],
                    "SET_TITLE" => "N",
                    ),
                    $component
                );?>
            <?endif?>
            </td>
        </tr>
    </table>
</div>
