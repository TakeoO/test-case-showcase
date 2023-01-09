<?php

require_once "./vendor/autoload.php";


$stuff = DependencyContainer::getInstance()->get(Foo::class);
$result = $stuff->bar();

echo "I'm a little teapot.\n";
echo "Result: " . $result . "\n";