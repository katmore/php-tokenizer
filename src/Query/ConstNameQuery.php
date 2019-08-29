<?php
namespace Katmore\Tokenizer\Query;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Identifier;

class ConstNameQuery implements 
   Token\QueryInterface
{
   use Token\QueryTrait;
   /**
    * @var string
    */
   private $constName;
   protected function currentMatch(Token\IteratorInterface &$iterator): ?Token {
      $const = null;
      while ($iterator->valid()) {
         $token = $iterator->current();
         $identifier = $token->getIdentifier();
         if ($identifier instanceof Identifier\PtokIdentifier) {
            $tokenType = $identifier->getTokenType();
            if ($const !== null) {
               if ($tokenType === T_STRING) {
                  if ($identifier->getContents() === $this->constName) {
                     return $const;
                  }
               } else if ($tokenType !== T_WHITESPACE) {
                  $const = null;
               }
            } else if ($tokenType === T_CONST) {
               $const = $token;
            }
         }
         $iterator->next();
      }
      return null;
   }

   public function __construct(Token\IteratorInterface $iterator, string $constName) {
      $this->setIterator($iterator);
      $this->constName = $constName;
   }
}