# Postcode

[![Build Status](https://travis-ci.org/vasildakov/postcode.svg?branch=master)](https://travis-ci.org/vasildakov/postcode)
[![Coverage Status](https://coveralls.io/repos/github/vasildakov/postcode/badge.svg?branch=master)](https://coveralls.io/github/vasildakov/postcode?branch=master)
[![HHVM Status](http://hhvm.h4cc.de/badge/vasildakov/postcode.svg?style=flat)](http://hhvm.h4cc.de/package/vasildakov/postcode)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vasildakov/postcode/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vasildakov/postcode/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/vasildakov/postcode/v/stable)](https://packagist.org/packages/vasildakov/postcode)
[![Total Downloads](https://poser.pugx.org/vasildakov/postcode/downloads)](https://packagist.org/packages/vasildakov/postcode)
[![License](https://poser.pugx.org/vasildakov/postcode/license)](https://packagist.org/packages/vasildakov/postcode)

## Synopsis

[Value Object](http://martinfowler.com/bliki/ValueObject.html) that represents an UK postcode

## Installation

Here is a minimal example of a `composer.json` file that just defines a dependency on Postcode:

    {
        "require": {
            "vasildakov/postcode": "^1.1"
        }
    }

## Code Example

#### Creating a Postcode object

```php
use VasilDakov\Postcode\Postcode;
use VasilDakov\Postcode\Validator;

// Create a Postcode
$postcode = new Postcode('EC1V 9LB', new Validator('UK'));

```

#### Perform simple validations, parsing and normalisation

```php
$postcode->normalise()    // => "EC1V 9LB"

$postcode->outcode()      // => "EC1V"
$postcode->incode()       // => "9LB"
$postcode->area()         // => "EC"
$postcode->district()     // => "EC1"
$postcode->subdistrict()  // => "EC1V"
$postcode->sector()       // => "EC1V 9"
$postcode->unit()         // => "LB"

```

### Method Overview

| Postcode | outcode()  | incode()  | area()  | district()  | subdistrict()  | sector()  | unit()  |
|----------|------------|-----------|---------|-------------|----------------|-----------|---------|
| AA9A 9AA | AA9A       | 9AA       | AA      | AA9         | AA9A           | AA9A 9    | AA      |
| A9A 9AA  | A9A        | 9AA       | A       | A9          | A9A            | A9A 9     | AA      |
| A9 9AA   | A9         | 9AA       | A       | A9          | null           | A9 9      | AA      |
| A99 9AA  | A99        | 9AA       | A       | A99         | null           | A99 9     | AA      |
| AA9 9AA  | AA9        | 9AA       | AA      | AA9         | null           | AA9 9     | AA      |
| AA99 9AA | AA99       | 9AA       | AA      | AA99        | null           | AA99 9    | AA      |

## Definitions

### Outcode

The outward code is the part of the postcode before the single space in the middle. It is between two and four characters long. A few outward codes are non-geographic, not divulging where mail is to be sent. Examples of outward codes include "L1", "W1A", "RH1", "RH10" or "SE1P".

### Incode

The inward part is the part of the postcode after the single space in the middle. It is three characters long. The inward code assists in the delivery of post within a postal district. Examples of inward codes include "0NY", "7GZ", "7HF", or "8JQ".

### Area

The postcode area is part of the outward code. The postcode area is between one and two characters long and is all letters. Examples of postcode areas include "L" for Liverpool, "RH" for Redhill and "EH" Edinburgh. A postal area may cover a wide area, for example "RH" covers north Sussex, (which has little to do with Redhill historically apart from the railway links), and "BT" (Belfast) covers the whole of Northern Ireland.

### District

The district code is part of the outward code. It is between two and four characters long. It does not include the trailing letter found in some outcodes. Examples of district codes include "L1", "W1", "RH1", "RH10" or "SE1".

### Sub-District

The sub-district code is part of the outward code. It is often not present, only existing in particularly high density London districts. It is between three and four characters long. It does include the trailing letter omitted from the district. Examples of sub-district codes include "W1A", "EC1A", "NW1W", "E1W" or "SE1P".


### Sector

The postcode sector is made up of the postcode district, the single space, and the first character of the inward code. It is between four and six characters long (including the single space). Examples of postcode sectors include "SW1W 0", "PO16 7", "GU16 7", or "L1 8", "CV1 4".

### Unit

The postcode unit is two characters added to the end of the postcode sector. Each postcode unit generally represents a street, part of a street, a single address, a group of properties, a single property, a sub-section of the property, an individual organisation or (for instance Driver and Vehicle Licensing Agency) a subsection of the organisation. The level of discrimination is often based on the amount of mail received by the premises or business. Examples of postcode units include "NY" (from "SW1W 0NY"), "GZ" (from "PO16 7GZ"), "HF" (from "GU16 7HF"), or "JQ" (from "L1 8JQ").


Sources:

- https://en.wikipedia.org/wiki/Postcodes_in_the_United_Kingdom#Formatting
- https://en.wikipedia.org/wiki/London_postal_district#Numbered_divisions



## Note on Postcode Validation

Postcodes cannot be validated just with a regular expression. Proper postcode validation requires having a full list of postcodes to check against. Relying on a regex will produce false postives/negatives.

A complete list of Postcodes can be obtained from the ONS Postcode Directory, which is updated every 3 months.


## License

Code released under [the MIT license](https://github.com/vasildakov/postcode/blob/master/LICENSE)