<?php
namespace Katmore\Tokenizer\Token\Identifier;

use Katmore\Tokenizer\Exception;
use Katmore\Tokenizer\Token;

final class Ptok implements 
   Token\IdentifierInterface
{
   /**
    *
    * @var int
    */
   private $type;

   /**
    *
    * @var string
    */
   private $contents;

   /**
    * @var string
    */
   private $name;
   public function __toString() {
      return $this->contents;
   }
   public function jsonSerialize() {
      return [
         'contents' => $this->contents,
         'token' => $this->tokenValue
      ];
   }

   /**
    * Internal type of the PHP token
    * 
    * @return int The internal type of the PHP token. The value corresponds to element 0 of a token_get_all() return value element with an array value. 
    * @see token_get_all()
    */
   public function getTokenType(): int {
      return $this->type;
   }

   /**
    * Contents of the PHP token
    * 
    * @return string The contents of the PHP token. The value corresponds to element 1 of a token_get_all() return value element with an array value.
    * @see token_get_all()
    */
   public function getContents(): string {
      return $this->contents;
   }

   /**
    * Symbolic name of the PHP token
    *
    * @return string The symbolic name of the PHP token.
    * @see token_name()
    */
   public function getTokenName(): string {
      return token_name($this->tokenValue);
   }
   
   /**
    * Get the symbolic name of a given PHP token
    * 
    * @param int $tokenType The internal type of a PHP token.
    * 
    * @return string The symbolic name of the PHP token.
    * 
    * @static
    * @throws \Katmore\Tokenizer\Exception\InvalidArgumentException unknown token type
    */
   public static function tokenType2TokenName(int $tokenType) : void {
      if (token_name($tokenType) === 'UNKNOWN') {
         throw new Exception\InvalidArgumentException('unknown token type');
      }
   }

   /**
    * Constructs a Ptok Identifier object
    * 
    * The Ptok Identifier object represents a token_get_all() return value element with an array value.
    * 
    * @param int $type The internal type of the PHP token. The value corresponds to element 0 of a token_get_all() return value element with an array value. 
    * @param string $contents The contents of the PHP token. The value corresponds to element 1 of a token_get_all() return value element with an array value.
    * 
    * @see token_get_all()
    * @throws \Katmore\Tokenizer\Exception\InvalidArgumentException
    */
   public function __construct(int $type, string $contents) {
      $this->name = static::tokenType2TokenName($type);
      $this->type = $type;
      $this->contents = $contents;
   }
}