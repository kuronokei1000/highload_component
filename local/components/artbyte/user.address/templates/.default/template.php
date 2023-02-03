<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult['AUTORIZED'] == 'Y') {
    //Вырубил практически все функуции, раз их не указано в ТЗ, оставил только необходимый минимум
$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => 'address_list',
        'COLUMNS' => [
            ['id' => 'ADDRESS', 'name' => 'Ваш адрес', 'default' => true],
        ],
        'ROWS' => $arResult["LIST"],
        'SHOW_ROW_CHECKBOXES' => false,
        'NAV_OBJECT' => '',
        'AJAX_MODE' => 'Y',
        'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
        'PAGE_SIZES' => [
            ['NAME' => "5", 'VALUE' => '5'],
            ['NAME' => '10', 'VALUE' => '10'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100']
        ],
        'AJAX_OPTION_JUMP'          => 'N',
        'SHOW_CHECK_ALL_CHECKBOXES' => false,
        'SHOW_ROW_ACTIONS_MENU'     => false,
        'SHOW_GRID_SETTINGS_MENU'   => false,
        'SHOW_NAVIGATION_PANEL'     => true,
        'SHOW_PAGINATION'           => true,
        'SHOW_SELECTED_COUNTER'     => false,
        'SHOW_TOTAL_COUNTER'        => false,
        'SHOW_PAGESIZE'             => true,
        'SHOW_ACTION_PANEL'         => false,
        'ACTION_PANEL'              => false,
        'ALLOW_COLUMNS_SORT'        => true,
        'ALLOW_COLUMNS_RESIZE'      => true,
        'ALLOW_HORIZONTAL_SCROLL'   => true,
        'ALLOW_SORT'                => true,
        'ALLOW_PIN_HEADER'          => true,
        'AJAX_OPTION_HISTORY'       => 'N'
    ]
);
} else {
    //В тз не было, но было бы вежливо дать пользователю понимание, почему он не видит свои адреса
    echo "<b>Для просмотра данной страницы вам необходимо авторизоваться!</b>";
    //А еще предложить сразу авторизоваться
    $APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
            "REGISTER_URL" => "register.php",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => "profile.php",
            "SHOW_ERRORS" => "Y"
        )
    );
}
?>
