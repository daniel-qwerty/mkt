<?php

class Categories_Helper_Category extends Com_Object
{

    /**
     *
     * @return Categories_Helper_Category
     */
    public static function getInstance()
    {
        return self::_getInstance(__CLASS__);
    }

    public function get($lan, $alias)
    {
        return Categories_Model_Category::getInstance()->getByAlias($lan->LanId, $alias);
    }

    public function getId($lan, $id)
    {
        return Categories_Model_Category::getInstance()->getById($lan->LanId, $id);
    }

    public function getHexa($lan, $id)
    {
        $color = Categories_Model_Category::getInstance()->getById($lan->LanId, $id)->CatClass;
        switch ($color) {
            case 'm_pink':
                return '244,16,105';
            case 'm_fuxia':
                return '216,0,174';
            case 'm_azul':
                return '5,139,224';
            case 'm_aqua':
                return '73,192,188';
            case 'm_purpura':
                return '125,22,238';
            case 'm_verde':
                return '128,182,25';
            case 'm_amarillo':
                return '247,200,0';
            case 'm_naranja':
                return '236,102,37';
            default:
                return '127,127,127';
        }
    }

}
