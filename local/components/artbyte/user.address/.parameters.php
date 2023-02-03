<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if( !Loader::includeModule("highloadblock") ) {
    throw new \Exception('Не загружены модули необходимые для работы компонента');
}

$arComponentParameters = [
    "GROUPS" => [
        "SETTINGS" => [
            "NAME" => Loc::getMessage('ARTBYTE_PROP_SETTINGS'),
            "SORT" => 550,
        ],
    ],
    "PARAMETERS" => [
        "ONLY_ACTIVE" => [
            "PARENT" => "SETTINGS",
            "NAME" => Loc::getMessage('ARTBYTE_PROP_ACTIVE'),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ]
];