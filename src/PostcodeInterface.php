<?php
/**
 * This file is part of the vasildakov/postcode library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Vasil Dakov <vasildakov@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://github.com/vasildakov/lendinvest GitHub
 */

namespace VasilDakov\Postcode;

/**
 * PostcodeInterface
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 */
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
