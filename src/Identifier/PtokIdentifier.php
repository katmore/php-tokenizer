<?php
namespace Katmore\Tokenizer\Identifier;

use Katmore\Tokenizer\Exception;
use Katmore\Tokenizer\Token\IdentifierInterface;

final class PtokIdentifier implements 
   IdentifierInterface
{
   const IDENTIFIER_TYPE = 'parser token';
   
   /**
    * @var int
    */
   private $tokenType;

   /**
    *
    * @var string
    */
   private $contents;

   /**
    * @var string
    */
   private $name;
   public function identifierType() : string {
      return static::IDENTIFIER_TYPE;
   }
   
   public function __toString() {
      return $this->contents;
   }
   public function jsonSerialize() {
      return [
         'contents' => $this->contents,
         'type' => $this->tokenType,
         'name' => $this->name,
      ];
   }

   /**
    * Internal type of the PHP token
    * 
    * @return int The internal type of the PHP token. The value corresponds to element 0 of a token_get_all() return value element with an array value. 
    * @see token_get_all()
    */
   public function getTokenType(): int {
      return $this->tokenType;
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
      return $this->name;
   }

   /**
    * Constructs a Ptok Identifier object
    * 
    * The Ptok Identifier object represents a token_get_all() return value element with an array value.
    * 
    * @param int $tokenType The internal type of the PHP token. The value corresponds to element 0 of a token_get_all() return value element with an array value. 
    * @param string $contents The contents of the PHP token. The value corresponds to element 1 of a token_get_all() return value element with an array value.
    * 
    * @see token_get_all()
    * @throws \Katmore\Tokenizer\Exception\InvalidArgumentException
    */
   public function __construct(int $tokenType, string $contents) {
      if ('UNKNOWN' === ($this->name = token_name($tokenType))) {
         throw new Exception\InvalidArgumentException('unknown token type');
      }
      $this->tokenType = $tokenType;
      $this->contents = $contents;
   }
}