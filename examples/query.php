<?php
use Katmore\Tokenizer;

require __DIR__ . '/../vendor/autoload.php';

$source = __DIR__ . '/../src/Identifier/CharIdentifier.php';

$tokenIterator = new Tokenizer\Iterator(new Tokenizer\Parser\FileParser($source));

$query = new Tokenizer\Query\ConstNameQuery($tokenIterator, 'IDENTIFIER_TYPE');

echo "const name query match count: " . count($query) . "\n";

foreach ($query as $k => $token) {
   echo "query match #$k:\n";
   echo json_encode($token, JSON_PRETTY_PRINT) . "\n";
   echo "full instruction for const name query match #$k:\n";
   $instruction = new Tokenizer\Query\InstructionPosQuery($query->parent(), $token->getContext()
      ->getInstructionPos());
   echo "".$instruction."\n";
}
unset($token);

echo "\n";

$query = new Tokenizer\Query\ClassNameQuery($tokenIterator, 'CharIdentifier');

echo "class name query match count: " . count($query) . "\n";
$token = $query->first();
echo json_encode($token, JSON_PRETTY_PRINT) . "\n";
echo "full instruction for class name query match:\n";
$instruction = new Tokenizer\Query\InstructionPosQuery($query->parent(), $token->getContext()
->getInstructionPos());
echo "".$instruction."\n";

$query = new Tokenizer\Query\TokenTypeContentsQuery($tokenIterator, T_FUNCTION, 'jsonSerialize');
echo "token type query match count: " . count($query) . "\n";
$token = $query->first();
echo json_encode($token, JSON_PRETTY_PRINT) . "\n";
echo "full instruction for token type query match:\n";
$instruction = new Tokenizer\Query\InstructionPosQuery($query->parent(), $token->getContext()
->getInstructionPos());
echo "".$instruction."\n";