<?php
/**
 * Created by PhpStorm.
 * User2: Nico
 * Date: 12/04/2018
 * Time: 08:52
 */

namespace App\Controller;


abstract class CategoryEnum
{

    const CAT_CONSOMABLE = "consomable";
    const CAT_TEXTILE = "textile";
    const CAT_GOODIES = "goodies";


    protected static $categoryName = [

        self::CAT_CONSOMABLE => "consomable",
        self::CAT_TEXTILE => "textile",
        self::CAT_GOODIES => "goodies",

    ];

    public static function getCategoryName($category)
    {
        if (!isset(static::$categoryName[$category])) {
            return "Unknown type ($category)";
        }
        return static::$categoryName[$category];
    }

    public static function getAvailableCategory(){

        return[
            self::CAT_CONSOMABLE,
            self::CAT_GOODIES,
            self::CAT_TEXTILE
        ];
    }
}