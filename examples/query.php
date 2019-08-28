<?php
use Katmore\Tokenizer;

require __DIR__.'/../vendor/autoload.php';

$source = __DIR__.'/../src/Identifier/CharIdentifier.php';

$tokenIterator = new Tokenizer\Iterator(new Tokenizer\Parser\FileParser($source));

$query = new Tokenizer\Query\ConstName('IDENTIFIER_TYPE');

$token = $query->first($tokenIterator);

echo json_encode($token,JSON_PRETTY_PRINT)."\n";