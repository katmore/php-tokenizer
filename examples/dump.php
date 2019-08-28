<?php
use Katmore\Tokenizer;

require __DIR__.'/../vendor/autoload.php';

$source = isset($argv[1])?$argv[1]:'<?php echo "hello world";';

$tokenIterator = new Tokenizer\Iterator($source);

foreach($tokenIterator as $token) {
   echo "token identifier: {$token->getIdentifier()->identifierType()}\n";
   echo json_encode([
      'context'=>$token->getContext(),
      'token'=>$token->getIdentifier(),
   ],JSON_PRETTY_PRINT)."\n";
}