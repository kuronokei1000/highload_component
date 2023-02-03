<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    "NAME" => Loc::getMessage("ARTBYTE_COMPONENT"),
    "DESCRIPTION" => Loc::getMessage("ARTBYTE_COMPONENT_DESCRIPTION"),
    "COMPLEX" => "N",
    "PATH" => [
        "ID" => Loc::getMessage("ARTBYTE_COMPONENT_PATH_ID"),
        "NAME" => Loc::getMessage("ARTBYTE_COMPONENT_PATH_NAME"),
    ],
];