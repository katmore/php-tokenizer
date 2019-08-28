<?php
namespace Katmore\Tokenizer\Identifier;

trait EnumeratorTrait
{
   /**
    * @var int
    */
   private $position = 0;

   /**
    * @var array|null
    */
   private $identifier;

   /**
    * @see \Katmore\Tokenizer\Identifier\EnumeratorInterface::enumerateTokenIdentifiers()
    */
   abstract public function enumerateTokenIdentifiers(): array;

   /**
    * @see \Katmore\Tokenizer\Parser\IdentifierParserInterface::rewind()
    * @return void
    */
   public function rewind() {
      $this->position = 0;
   }

   /**
    * @see \Katmore\Tokenizer\Parser\IdentifierParserInterface::current()
    * @return array|string|null
    */
   public function current() {
      if (!$this->valid()) {
         return null;
      }
      return $this->identifier[$this->position];
   }

   /**
    * @see \Katmore\Tokenizer\Parser\IdentifierParserInterface::key()
    * @return int
    */
   public function key() {
      return $this->position;
   }

   /**
    * @see \Katmore\Tokenizer\Parser\IdentifierParserInterface::next()
    * @return void
    */
   public function next() {
      ++ $this->position;
   }

   /**
    * @see \Katmore\Tokenizer\Parser\IdentifierParserInterface::valid()
    * @return bool
    */
   public function valid() {
      if ($this->identifier === null) {
         $this->identifier = $this->enumerateTokenIdentifiers();
      }
      return isset($this->identifier[$this->position]);
   }
}