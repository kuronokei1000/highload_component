<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class UserAddress extends CBitrixComponent
{
    private $hlbl = 4; // хардкодим номер инфоблока, раз по ТЗ нельзя выбирать из настроек компонента

    /**
     * Проверка наличия модулей требуемых для работы компонента
     * @return bool
     * @throws Exception
     */
    private function _checkModules() {
        if (   !Loader::includeModule('highloadblock') ) {
            throw new \Exception('Не загружены модули необходимые для работы модуля');
        }
        return true;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllUser|CUser
     */
    private function _user() {
        global $USER;
        return $USER;
    }

    /**
     * Точка входа в компонент
     */
    public function executeComponent() {
        $this->_checkModules();
        //Проверим авторизован ли пользователь
        if ($this->_user()->IsAuthorized()) {
            $this->arResult['AUTORIZED'] = 'Y';
            //Если стоит галочка в настройках - выводим только активные адреса
            if ($this->arParams["ONLY_ACTIVE"] == "Y") {
                $filter = array("UF_USER_ID" => $this->_user()->GetID(), "UF_ACTIVE" => '1');
            } else {
                $filter = array("UF_USER_ID" => $this->_user()->GetID());
            }
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($this->hlbl)->fetch();
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $rsData = $entity_data_class::getList(array(
                "select" => array("*"),
                "order" => array("ID" => "ASC"),
                "filter" => $filter
            ));
            //Соберем адреса в массив для вывода в грид
            while ($arData = $rsData->Fetch()) {
                $this->arResult["LIST"][$arData["ID"]] =
                    array(
                            'data'    => [
                                "ADDRESS" => $arData["UF_ADDRESS"],
                            ],
                    );
            }
        }
        $this->includeComponentTemplate();
    }
}