<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Parser;

trait IteratorTrait
{

   /**
    * @var \Katmore\Tokenizer\Parser\IdentifierParserInterface
    */
   private $identifierParser;

   /**
    * @var \Katmore\Tokenizer\Parser\CharParserInterface
    */
   protected $charParser;

   /**
    * @var \Katmore\Tokenizer\Parser\PtokParserInterface
    */
   protected $ptokParser;
   protected function setIdentifierParser(Parser\IdentifierParserInterface $identifierParser): void {
      $this->identifierParser = $identifierParser;
   }
   protected function getIdentifierParser(): ?Parser\IdentifierParserInterface {
      return $this->identifierParser;
   }
   public function rewind() {
      if ($this->ptokParser instanceof Parser\PtokParserInterface) {
         $this->ptokParser = $this->ptokParser->withContext($this->ptokParser->getContext()
            ->withReset());
      }
      if ($this->charParser instanceof Parser\CharParserInterface) {
         $this->charParser = $this->charParser->withContext($this->charParser->getContext()
            ->withReset());
      }
      $this->identifierParser->rewind();
   }
   abstract public function current();
   public function key() {
      return $this->identifierParser !== null ? $this->identifierParser->key() : null;
   }
   public function next() {
      if ($this->identifierParser !== null) {
         return $this->identifierParser->next();
      }
   }
   public function valid() {
      return $this->identifierParser !== null ? $this->identifierParser->valid() : false;
   }
   public function __clone() {
      if ($this->identifierParser !== null) {
         $this->identifierParser = clone $this->identifierParser;
      }
      if ($this->charParser !== null) {
         $this->charParser = clone $this->charParser;
      }
      if ($this->ptokParser !== null) {
         $this->ptokParser = clone $this->ptokParser;
      }
   }
}