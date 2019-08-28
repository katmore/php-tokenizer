<?php
namespace Katmore\Tokenizer\Query;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Identifier;

class ConstName
{

   /**
    * @var string
    */
   private $constName;
   public function first(Token\IteratorInterface $iterator): ?Token {
      $const = null;
      foreach ($iterator as $token) {
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
      }
      return null;
   }
   public function __construct(string $constName) {
      $this->constName = $constName;
   }
}