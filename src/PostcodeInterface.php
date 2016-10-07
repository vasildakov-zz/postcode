<?php
/**
 * This file is part of the Postcode
 *
 * @copyright Copyright (c) Vasil Dakov <vasildakov@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace VasilDakov\Postcode;

interface PostcodeInterface
{
    /**
     * @param  string $value
     * @return static
     */
    public static function fromString($value);

    /**
     * @return string
     */
    public function toString();


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function equals(Postcode $other);


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function compareTo(Postcode $other);


    /**
     * @param  String $value
     * @return bool
     */
    public static function isValid($value);
}
