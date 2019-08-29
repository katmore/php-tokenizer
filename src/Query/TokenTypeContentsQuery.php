<?php
namespace Katmore\Tokenizer\Query;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Identifier;

class TokenTypeContentsQuery implements
Token\QueryInterface
{
   use Token\QueryTrait;
   /**
    * @var int
    */
   private $tokenType;
   /**
    * @var string
    */
   private $contents;
   protected function currentMatch(Token\IteratorInterface &$iterator): ?Token {
      $match = null;
      while ($iterator->valid()) {
         $token = $iterator->current();
         $identifier = $token->getIdentifier();
         if ($identifier instanceof Identifier\PtokIdentifier) {
            $tokenType = $identifier->getTokenType();
            if ($match !== null) {
               if ($tokenType === T_STRING) {
                  if ($identifier->getContents() === $this->contents) {
                     return $match;
                  }
               } else if ($tokenType !== T_WHITESPACE) {
                  $match = null;
               }
            } else if ($tokenType === $this->tokenType) {
               $match = $token;
            }
         }
         $iterator->next();
      }
      return null;
   }
   
   public function __construct(Token\IteratorInterface $iterator, int $tokenType, string $contents) {
      $this->setIterator($iterator);
      $this->tokenType = $tokenType;
      $this->contents = $contents;
   }
}