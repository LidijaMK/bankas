<?php
namespace Bank;
use App\DB\DataBase;
use PDO;

// struktūra: ['id' => 1, 'name' => 'Jonas', 'surname' => 'Jonaitis' 'accountNo' => 'LT12310000000000000000', 'personalNo' => '40003210000', 'balance' => '0'] 

class Maria implements DataBase {

    private static $db;
    private $pdo;

    public static function getMaria() 
    {
        return self::$db ?? self::$db = new self;
    }

    public function __construct() 
    {    
        $host = '127.0.0.1';
        $db   = 'bankas';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //kaip masyvas
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    function create(array $accountData) : void 
    {
        $sql =
        "INSERT INTO accounts (`name`, surname, account_no, personal_no, balance)
        VALUES (?, ?, ?, ?, ?)
        ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$accountData['name'], $accountData['surname'], $accountData['accountNo'], $accountData['personalId'], 0]);
    }
 
    function update(int $accountId, array $accountData) : void
    {
        $sql =
        "UPDATE accounts  
        SET balance = ".$accountData['balance']."  
        WHERE id = ?";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute([$accountId]);
        
    }
 
    function delete(int $accountId) : void
    {
        $sql =
        "DELETE FROM accounts
        WHERE id = ?
        ";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute([$accountId]);
    }
 
    function show(int $accountId) : array
    {
        $sql = 
        "SELECT id, `name`, surname, account_no as accountNo, personal_no as personalId, balance
        FROM accounts
        WHERE id = ?";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute([$accountId]);
        $row = $stmt->fetch();
        return $row;
    }
    
    function showAll() : array
    {
        $sql = 
        "SELECT id, `name`, surname, account_no as accountNo, personal_no as personalId, balance 
        FROM accounts
        ORDER BY surname
        ";
        $all = [];
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute();
        while ($row = $stmt->fetch())
        {
            $all[] = $row;
        }
        return $all;
    } 
    
    public function getUser(string $name, string $passw) : array
    {
        $sql = 
        "SELECT *
        FROM users
        WHERE name = ? AND passw = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $passw]);
        $user = $stmt->fetch();
        return false === $user ? [] : $user;
    }
}