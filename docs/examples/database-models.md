# Database Integration Examples

## Basic Contact Model

```php
<?php
namespace app\models;

use yii\db\ActiveRecord;
use udokmeci\yii2PhoneValidator\PhoneValidator;
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;

class Contact extends ActiveRecord
{
    public static function tableName()
    {
        return 'contact';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['phone'], PhoneValidator::class, 
                'countryAttribute' => 'country_code'
            ],
            [['country_code'], 'string', 'length' => 2],
        ];
    }
}
```

## E-commerce Order Model

```php
<?php
namespace app\models;

use yii\db\ActiveRecord;
use udokmeci\yii2PhoneValidator\PhoneValidator;
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;

class Order extends ActiveRecord
{
    public function rules()
    {
        return [
            [['shipping_phone'], 'required'],
            [['shipping_phone'], PhoneValidator::class,
                'countryAttribute' => 'shipping_country',
                'format' => PhoneNumberFormat::E164
            ],
            [['billing_phone'], PhoneValidator::class,
                'countryAttribute' => 'billing_country',
                'format' => PhoneNumberFormat::E164,
                'strict' => false
            ],
        ];
    }
}
```

## Search Model for Phone Numbers

```php
<?php
namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Contact;

class ContactSearch extends Contact
{
    public function search($params)
    {
        $query = Contact::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        if (!empty($this->phone)) {
            $cleanPhone = preg_replace('/[^\d+]/', '', $this->phone);
            $query->andWhere(['like', 'phone', $cleanPhone]);
        }
        
        return $dataProvider;
    }
}
```

## Database Schema

### Contact Table
```sql
CREATE TABLE contact (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    country_code CHAR(2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_phone (phone),
    INDEX idx_country (country_code)
);
```

### Order Table  
```sql
CREATE TABLE order (
    id INT PRIMARY KEY AUTO_INCREMENT,
    shipping_phone VARCHAR(20) NOT NULL,
    shipping_country CHAR(2) NOT NULL,
    billing_phone VARCHAR(20),
    billing_country CHAR(2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```