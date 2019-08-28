<?php
namespace Katmore\Tokenizer\Identifier;

use Katmore\Tokenizer\Exception;
use Katmore\Tokenizer\Token\IdentifierInterface;

final class CharIdentifier implements 
   IdentifierInterface
{
   /**
    * @var string 
    */
   private $charString;

   /**
    * One character string value of the PHP token
    * 
    * @return string The one character token string value of the PHP token. The value will be exactly one character in length. It corresponds to a token_get_all() return value element with a string value.
    * @see token_get_all()
    */
   public function getCharString(): string {
      return $this->charString;
   }
   public function __toString() {
      return $this->charString;
   }
   public function jsonSerialize() {
      return $this->charString;
   }

   /**
    * Constructs a Char Identifier object
    * 
    * The Char Identifier object represents a token_get_all() return value element with a string value.
    * 
    * @param string $charString The one character token string value of the PHP token. The value must be exactly one character in length. It corresponds to a token_get_all() return value element with a string value.
    * @throws \Katmore\Tokenizer\Exception\InvalidArgumentException 
    * @see token_get_all()
    */
   public function __construct(string $charString) {
      if (strlen($charString) !== 1) {
         throw new Exception\InvalidArgumentException("char string must be exactly one character in length");
      }
      $this->charString = $charString;
   }
}