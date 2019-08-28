<?php
namespace Katmore\Tokenizer;

trait TokenizerTrait {
   /**
    * @var int
    */
   private $position = 0;
   
   /**
    * @var array|null
    */
   private $identifiers;
   
   /**
    * @see \Katmore\Tokenizer\TokenizerInterface::enumerateTokenIdentifiers()
    */
   abstract public function enumerateTokenIdentifiers() : array;
   
   /**
    * @see \Katmore\Tokenizer\TokenizerInterface::rewind()
    * @return void
    */
   public function rewind() {
      $this->position = 0;
   }
   
   /**
    * @see \Katmore\Tokenizer\TokenizerInterface::current()
    * @return array|string|null
    */
   public function current() {
      if (!$this->valid()) {
         return null;
      }
      return $this->identifiers[$this->position];
   }
   
   /**
    * @see \Katmore\Tokenizer\TokenizerInterface::key()
    * @return int
    */
   public function key() {
      return $this->position;
   }
   
   /**
    * @see \Katmore\Tokenizer\TokenizerInterface::next()
    * @return void
    */
   public function next() {
      ++$this->position;
   }
   
   /**
    * @see \Katmore\Tokenizer\TokenizerInterface::valid()
    * @return bool
    */
   public function valid() {
      if ($this->identifiers === null) {
         $this->identifiers = $this->enumerateTokenIdentifiers();
      }
      return isset($this->identifiers[$this->position]);
   }
}