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

use VasilDakov\Postcode\ValidatorInterface;
use VasilDakov\Postcode\Exception;

/**
 * Postcode
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 */
class Postcode implements PostcodeInterface, \Serializable, \JsonSerializable
{
    /**
     * @var string $value
     */
    protected $value;

    /**
     * @var ValidatorInterface $value
     */
    protected $validator;

    /**
     * Constructor
     *
     * @param  string|integer            $value
     * @param  ValidatorInterface        $validator
     * @throws InvalidArgumentException
     */
    public function __construct($value, ValidatorInterface $validator)
    {
        $this->validator = $validator;

        if (!$this->validator->isValid($value)) {
            throw new Exception\InvalidArgumentException;
        }

        $this->value = $value;
    }


    /**
     * Returns TRUE if this Postcode object equals to another.
     *
     * @param  Postcode $other
     * @return boolean
     */
    public function equals(Postcode $other)
    {
        return $this->compareTo($other) == 0;
    }


    /**
     * Compare two Postcodes and tells whether they can be considered equal
     *
     * @param  Postcode $other
     * @return bool
     */
    public function compareTo(Postcode $other)
    {
        return (strcmp($this->toString(), $other->toString()) !== 0);
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toString()
    {
        return (string) $this->value;
    }


    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }


    /**
     * Generates a storable representation of a value
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this->value);
    }

    /**
     * Creates a PHP value from a stored representation
     *
     * @param  string $serialized
     * @return string $value
     */
    public function unserialize($serialized)
    {
        $this->value = unserialize($serialized);

        return $this->value;
    }


    /**
     * Specify data which should be serialized to JSON
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * @link   http://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize()
    {
        return [
            'postcode' => $this->toString()
        ];
    }
}
