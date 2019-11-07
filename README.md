yii2-phone-validator
==============

Yii2 phone validator is a validator uses phone number util to validate and format the phone number attribute of model.


How to use?
==============
##Installation with Composer
Just add the line under `require` object in your `composer.json` file.
``` json
{
  "require": {
    "udokmeci/yii2-phone-validator" : "~1.0.3"
  }
}
```
then run 

``` console
$> composer update
```

##Configuration
Now add following in to your `model` rules. 
###Note: ISO 3166-1 alpha-2 codes are required for country attribute. You can use [db-regions](https://github.com/udokmeci/db-regions) for countries list.

``` php
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['name', 'country'], 'string', 'max' => 50],
          // add this line
          [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator'],
        ];
    }
```
##Advanced
The `country` and `country_code` attributes are tried if `country` or `countryAttribute` is not specified.

``` php
  // All phones will be controlled according to Turkey and formatted to TR Phone Number
  [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator','country'=>'TR'],// 

  //All phones will be controlled according to value of $model->country_code
  [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator','countryAttribute'=>'country_code'],

  //All phones will be controlled according to value of $model->country_code
  //If model has not a country attribute then phone will not be validated
  //If phone is a valid one will be formatted for International Format. default behavior.
  [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator','countryAttribute'=>'country_code','strict'=>false,'format'=>true],  

```

Any forks are welcome.
