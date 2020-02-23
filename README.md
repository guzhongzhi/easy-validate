# Easy Validate for PHP

php array data validation

### Installation:

composer require guzhongzhi/easy-validate


### Usage

```php
require 'vendor/autoload.php';

use Guz\EasyValidate\Validate;

$data = [
    "name"=>"",
    "password"=>"",
];

$rules = [
    "name"=>[
        "label"=>"Username",
        "rules"=>[
            [
                "type"=>"required",
            ],
            [
                "type"=>"length",
                "min"=> 6,
                "max"=> 15,
            ]
        ],
    ]
];

$validator = new Validate($data,$rules);
if(!$validator->validate()) {
    $errors = $validator->getErrors();
}

```



