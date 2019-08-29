<?php
namespace Katmore\Tokenizer\Query;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Identifier;

class ClassNameQuery implements
Token\QueryInterface
{
   use Token\QueryTrait;
   /**
    * @var string
    */
   private $className;
   protected function currentMatch(Token\IteratorInterface &$iterator): ?Token {
      $class = null;
      while ($iterator->valid()) {
         $token = $iterator->current();
         $identifier = $token->getIdentifier();
         if ($identifier instanceof Identifier\PtokIdentifier) {
            $tokenType = $identifier->getTokenType();
            if ($class !== null) {
               if ($tokenType === T_STRING) {
                  if ($identifier->getContents() === $this->className) {
                     return $class;
                  }
               } else if ($tokenType !== T_WHITESPACE) {
                  $class = null;
               }
            } else if ($tokenType === T_CLASS) {
               $class = $token;
            }
         }
         $iterator->next();
      }
      return null;
   }
   
   public function __construct(Token\IteratorInterface $iterator, string $className) {
      $this->setIterator($iterator);
      $this->className = $className;
   }
}