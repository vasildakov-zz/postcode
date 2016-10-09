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
}
