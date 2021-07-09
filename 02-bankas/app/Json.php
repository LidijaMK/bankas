<?php
namespace Bank;
use App\DB\DataBase;

class Json implements DataBase {

    private $data;
    private static $obj;

    public static function getJson() 
    {
        return self::$obj ?? self::$obj = new self;
    }

    public function __construct() 
    {
        if (!file_exists(DIR. '/saskaitos.json')) 
        {
            file_put_contents(DIR. '/saskaitos.json', json_encode([]));
        }
        $this->data = json_decode(file_get_contents(DIR.'/saskaitos.json'), 1);
    }

    public function __destruct()
    {
        file_put_contents(DIR. '/saskaitos.json', json_encode($this->data));
    }

// vienos sąskaitos struktūra: ['id' => 1, 'name' => 'Jonas', 'surname' => 'Jonaitis' 'accountNo' => 'LT12310000000000000000', 'personalNo' => '40003210000', 'balance' => '0'] 

    public function create(array $accountData) : void
    {
        $this->data[] = $accountData;
    }
 
    public function update(int $accountId, array $accountData) : void
    {
        foreach ($this->data as $index => $account) {
            if ($account['id'] == $accountId) {
                $this->data[$index] = $accountData;
                return;
            }
        }

    }
 
    public function delete(int $accountId) : void
    {
        foreach ($this->data as $index => $account) {
            if ($account['id'] == $accountId) {
               unset($this->data[$index]);
                return;
            }
        }
    }
 
    public function show(int $accountId) : array 
    {
        foreach ($this->data as $index => $account) {
            if ($account['id'] == $accountId) {
               return $this->data[$index];
            }
        }
    }
       
    public function showAll() : array
    {
        return $this->data; 
    }
}