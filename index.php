<?php

//phpinfo();

$value = 'dsafdsf';
var_dump(strlen(substr(strrchr($value, "."), 1)));
die();

$value = 0;
var_dump((string)$value);
var_dump((string)$value === (string)(int)$value);

$email = 'abcdя@gmail.com';
var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
$x = 'Фискальная кассовая смена';
var_dump(mb_substr($x, 0, 10));
die();

echo json_encode($_POST);
die();

$arr = [
    'name' => 'abcd',
    'emptyItems' => [],
    'items' => [
        [
            'name' => 'first',
            'price' => 12.45,
        ],
        [
            'name' => 'second',
            'price' => 200.45,
        ],
    ],
    'itemsName' => [
        'aaaa',
        'bbbb'
    ]
];
var_dump(http_build_query($arr));

die();

$x = new stdClass();
$x->status = new stdClass();
$x->status->code = 123;
$x->status->message = 'abcd';

$y = clone $x;

var_dump($x === $y);

die();

print_r($_POST);
var_dump(is_array($_POST['PRODS']));
var_dump(count($_POST['PRODS']));

die();


class Foo {
    public $value = 10;
}

$a = new Foo(); // $a is a pointer pointing to Foo object 0
$b = $a; // $b is a pointer pointing to Foo object 0, however, $b is a copy of $a
var_dump($a === $b); // true

$a->value = 11;
var_dump($b->value); // 11

$c = &$a; // $c and $a are now references of a pointer pointing to Foo object 0
var_dump($c->value); // 11
var_dump($b === $c); // true

$a = new Foo(); // $a and $c are now references of a pointer pointing to Foo object 1, $b is still a pointer pointing to Foo object 0
var_dump($a === $c); // true
var_dump($a === $b); // false
var_dump($c === $b); // false

$a->value = 12;
var_dump($b->value); // 11
var_dump($c->value); // 12

unset($a); // A reference with reference count 1 is automatically converted back to a value. Now $c is a pointer to Foo object 1
var_dump($a === $c); // false and PHP Notice:  Undefined variable: a
var_dump($c->value); // 12

$a = &$b; // $a and $b are now references of a pointer pointing to Foo object 0
var_dump($a === $c); // false
var_dump($a->value); // 11

$a = NULL; // $a and $b now become a reference to NULL. Foo object 0 can be garbage collected now
var_dump($b->value); // NULL and Notice: Trying to get property of non-object
// What happens to object Foo#0?

$a = clone $c; // $a is now a pointer to Foo object 2, $c remains a pointer to Foo object 1
var_dump($a === $c); // false
var_dump($a->value); // 12

$a->value = 13;
var_dump($c->value); // 12
var_dump($b->value); // 13

unset($c); // Foo object 1 can be garbage collected now.
// What happens to object Foo#1?

$c = $a; // $c and $a are pointers pointing to Foo object 2
var_dump($a === $c); // true

$c->value = 14;
var_dump($a->value); // 14
var_dump($b->value); // 14

die();

$array = ['amount' => 23.49, 'currency' => 'EUR', 'products' => ['prod1', 'prod2']];
var_dump(http_build_query($array));

$str = 'amount=23.49&currency=EUR&products=prod1&products=prod2';
parse_str($str, $arr);
var_dump($arr);

die();

class Smth {
}
class MyObject{
//    private $x = new Smth();
    public function __construct($x)
    {
        $this->x = $x;
    }
}
$obj1 = new MyObject(1);
$addressOfObj1 = &$obj1;
$obj2 = $obj1;
$addressOfObj1 = null;
var_dump($obj1, $addressOfObj1, $obj2);
//var_dump($obj1 === $addressOfObj1);

die();

//var_dump(ini_get('enable_post_data_reading'));
var_dump(file_get_contents('php://input'));
var_dump(getallheaders());
var_dump($_SERVER);
var_dump($_FILES);
//var_dump(file_get_contents($_FILES['abc']['tmp_name']));

die();

$arr = ['a' => 1, 'b' => 2];
$arr2 = ['a' => 5, 'c' => 3];

var_dump($arr + $arr2); // a => 1, b => 2, c => 3
var_dump(array_merge($arr, $arr2)); // a => 5, b => 2, c => 3

die();

$arr1 = ['a' => 1, 'b' => '2'];
$arr2 = ['b' => '2', 'a' => 1];
echo PHP_EOL . 'Comparing arrays' . PHP_EOL;
var_dump($arr1 == $arr2);
var_dump($arr1 === $arr2);

class MyClass {
    private $priv;
    protected $prot;
    public $pub;

    public function __construct($priv, $prot, $pub)
    {
        $this->priv = $priv;
        $this->prot = $prot;
        $this->pub = $pub;
    }
}
$obj1 = $obj3 = new MyClass(2, 'a', '5');
$obj2 = new MyClass('2', 'a', 5);
echo PHP_EOL . 'Comparing objects' . PHP_EOL;
var_dump($obj1 == $obj2);
var_dump($obj1 === $obj2);
var_dump($obj1 === $obj3);

die();

var_dump(PHP_INT_SIZE);
var_dump(PHP_INT_MAX + 1);
$a = 2.01;
$b = -2;
$c = $a + $b;
var_dump($c);
var_dump(0.1 + 0.2 == 0.3);
var_dump(bccomp(0.1 + 0.2, 0.3));
die();

$write = apcu_store('cocos', ['hello' => 'aaa'], 1);
var_dump($write);

sleep(5);

$read = apcu_fetch('cocos');
var_dump($read);
$read = apcu_fetch('cocos');
var_dump($read);

die();

function callFunc1(Closure $closure) {
    $closure();
}

function callFunc2(callable $callback) {
    $callback();
}

function xy() {
    echo 'Hello, World!';
}

//callFunc1('xy'); // Hello, World!
callFunc2('xy'); // Hello, World!

die();

$str = sprintf('%b', STREAM_CLIENT_CONNECT & STREAM_CLIENT_PERSISTENT);
echo strlen($str) . PHP_EOL;
echo $str . PHP_EOL;

die();

$obj = new DateTime();
echo $obj;

die();

function my_shutdown_function($x, $y)
{
    echo $x . ' - ' . $y;
}

register_shutdown_function('my_shutdown_function', 12, 'cocos');
die();

$x = null;
var_dump($x instanceof Order);

die();

$stringDate = '2016-08-01 20:10:00';
$date = new DateTime($stringDate);
$nextDay = new DateTime($stringDate);
$nextDay->add(new DateInterval('P1D'))->setTime(3, 0, 0);
var_dump($date->format('Y-m-d H:i:s'));
var_dump($nextDay->format('Y-m-d H:i:s'));

$currentTime = strtotime($stringDate);
$tomorrowTime = strtotime('+1 day 03:00:00', $currentTime);
var_dump(date('Y-m-d H:i:s', $tomorrowTime));

var_dump($date->format('D'));
var_dump($nextDay->format('D'));

die();

$arr1 = [
    'toStay' => 'original',
    'toBeReplaced' => 'original'
];
$arr2 = [
    'toBeReplaced' => 'NEW',
    'toBeAdded' => 'I am new'
];
$result = array_replace_recursive($arr1, $arr2);
var_dump($result);

die();

class Order {
    public $amount = 10;
    public $currency = 'RON';
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function __clone()
    {
        // create "deep copy" of the Order object
        $this->product = clone $this->product;
    }
}

class Product {
    public $name = 'default';
}

$o1 = new Order(new Product());
$o2 = clone $o1;

$o1->amount = 599;
$o2->amount = 62;

$o1->product->name = 'prod1';
$o2->product->name = 'prod2';

var_dump($o1);
var_dump($o2);

die();

function rangeWithGenerator($min, $max) {
    for ($i = $min; $i <= $max; $i++) {
        yield $i;
    }
}

$startMemoryUsage = memory_get_usage();
echo "\nStart Memory Usage: " . ($startMemoryUsage/1048576) . " MB \t" . ($startMemoryUsage/1024) . " KB \n";

//TODO commute between plain array and generator usage
//$arr = range(0, 1000000);
$arr = rangeWithGenerator(0, 1000000);

foreach ($arr as $number) {
    // stuff
}
$memoryUsage = memory_get_usage();
$memoryUsageDiff = $memoryUsage - $startMemoryUsage;
echo "Memory Usage: " . ($memoryUsageDiff/1048576) . " MB \t" . ($memoryUsageDiff/1024) . " KB \n";

unset($arr);
unset($number);
unset($startMemoryUsage);
unset($memoryUsage);
unset($memoryUsageDiff);
echo "End Memory Usage: " . (memory_get_usage()/1048576) . " MB \t" . (memory_get_usage()/1024) . " KB \n";

die();

$privateKey = '-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCJZi8yYrfdoSkX69f1V6rMHDNOJxycaJFRHHMerycVLkMWaunT
beVnU2yz6AlSeuI//V7d6rQbGsz18tAz5h9Jow7ublg=
-----END RSA PRIVATE KEY-----';

$pkey = openssl_get_privatekey($privateKey);
var_dump($pkey);

openssl_sign('my secret string', $signature, $privateKey);
var_dump($signature);

die();

abstract class AbstractType{}
class ConcreteType1 extends AbstractType{}
class ConcreteType2 extends AbstractType{}

interface I {
    public function run(AbstractType $type);
}
class Strategy1 implements I {
    public function run(ConcreteType1 $type)
    {
    }
}
class Strategy2 implements I {
    public function run(ConcreteType2 $type)
    {
    }
}

$obj = new Strategy1();
$obj->run(new ConcreteType1());
exit;


$obj = new ArrayObject(['name' => 'mihai', 'age' => '26'], ArrayObject::ARRAY_AS_PROPS);
var_dump($obj->name);
var_dump($obj['name']);
var_dump(array_key_exists('name', $obj));

class Person
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
}
class PersonCollection extends ArrayObject
{
}

$mihai = new Person('mihai');
$vlad = new Person('vlad');
$collection = new PersonCollection();
$collection->append($mihai);
$collection->append($vlad);
//$collection->append(new stdClass());
//var_dump($collection[1]);

foreach ($collection as $item) {
    var_dump($item->getName());
}

die();

echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

class A {
    public $property;
}
class B {
    public $name;
}
class C {
    public function replaceProperty(B $b) {
        $b = new B();
        $b->name = 'replaced';
    }

    public function replacePropertyGivingParent(A $a)
    {
        $b = new B();
        $b->name = 'replaced';
        $a->property = $b;
    }
}

$a = new A();
$b = new B();
$b->name = 'original';
$a->property = $b;
var_dump($a);

(new C())->replaceProperty($a->property);
var_dump($a);

(new C())->replacePropertyGivingParent($a);
var_dump($a);


echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

var_dump(date('Y-m-d H:i:s'));

require_once __DIR__ . '/lib/externals/autoload.php';
var_dump(new \MyCompany\Merchant\MerchantService());
var_dump(new \MyCompany\RabbitMq\RabbitMqService());
echo '<br/>';

echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

$str = "(1,1,'USD','2014-07-11 13:31:12'),(2,1,'EUR','2014-07-11 13:31:12'),(3,1,'GBP','2014-07-11 13:31:12'),(4,1,'RON','2014-07-11 13:31:12'),(5,1,'HUF','2014-07-11 13:31:12'),(6,1,'TRY','2014-07-11 13:31:12'),(7,1,'RUB','2014-07-11 13:31:12'),(8,1,'BGN','2014-07-11 13:31:12')";
$str = explode(")", $str);
foreach ($str as $row) {
    $str = explode(",", $row);
//    echo $str[3] . " => " . $str[4] . ",<br/>";
    echo $str[3] . ",<br/>";
}

//$a = ['IdRomcard','IdOption','IdBusinessCompany','IdBank','Description','ExtendedDescription','CompanyName','CompanyUrl','MerchantID','Terminal','SKey','ExternalTerminal','AcctStatement','Disabled','GatewayCode','ProcessType','DefaultCurrency','HasRenewal','Allow3DSecureBypass','BalancedTerminalsIds','AutoStamp','PaymentType','AllowZeroCommission','AcceptToken','PseudoAuthorization','AllowAutomaticPartialRefundProcessing','AllowAutomaticReverse','AllowMultipleRefund','ReturnFeesAtRefund','ReturnPartialFeesAtRefund','AntifraudBeforeAuthorization','AcceptedCards','SaveInCardKeeper','InternalToken'];
//$b = [1,1,1,4,'Romcard BRD','','','','','543212345','',0,'EPAYMENT.RO',0,'ROMCARD','BOTH','RON',0,'NO','','2014-07-11 13:31:18','ONE_TIME','NO',0,'NO','YES','YES','YES','NO','NO','NO',NULL,'NO','NO'];
//$c = '';
//for ($i = 0; $i < count($a); $i++) {
//    echo "'" . $a[$i] . "' => '" . $b[$i] . "',<br/>";
//}

echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

echo "<h5>Test Memcache</h5>";
$memcache = new Memcache();
$memcache->addserver('localhost', 11211);
$key = 'newKey';
$result = $memcache->get($key);
if ($result) {
    echo $result . "<br/>";
} else {
    echo "No matching key found.  I'll add that now!<br/>" ;
    $value = "I am data!  I am held in memcached! Random new value = " . rand(1, 999);
    var_dump($value);
    $memcache->set($key, $value, 0, 5);
}

echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

list($reasonCode, $reasonCodeDesc, $third) = getMsg();
var_dump($reasonCode, $reasonCodeDesc, $third);

function getMsg() {
    return ['a', 'b', 'c'];
}

echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

if (stripos(php_uname('s'), 'linux') !== false) {
    print("LINUX");
} else {
    print("OTHER OS");
}

echo "------------------------------------------------------------------------------------------------------------<br/><br/>";

class TaskInput {
    private $a1 = 'aaaa11111';
    private $a2 = ['aaaa222' => 2222];
}

class Message {
    const AAA = 'aaa';
    const AAA2 = self::AAA;
    private $body;

    public function __construct($body)
    {
        $this->body = $body;
        var_dump(self::AAA2);
    }

    public function getBody()
    {
        return $this->body;
    }
}

$taskInput = new TaskInput();
$message = new Message(serialize($taskInput));
var_dump($message);
$serializedMessage = serialize($message);
var_dump($serializedMessage);
var_dump(unserialize($serializedMessage));
var_dump(unserialize(unserialize($serializedMessage)->getBody()));
