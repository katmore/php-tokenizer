<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Token;

trait QueryTrait
{
   /**
    * @var int
    */
   private $position = 0;

   /**
    * @var \Katmore\Tokenizer\Token\IteratorInterface
    */
   private $iterator;
   
   protected function onClone() : void {}
   abstract protected function currentMatch(Token\IteratorInterface &$iterator): ?Token;
   protected function setIterator(Token\IteratorInterface $iterator): void {
      $this->iterator = clone $iterator;
      $this->iterator->rewind();
      $this->position = 0;
   }
   public function parent() :? Token\IteratorInterface {
      if ($this->iterator === null) {
         return null;
      }
      $parent = clone $this->iterator;
      $parent->rewind();
      return $parent;
   }
   
   public function __toString() {
      if ($this->iterator === null) {
         return '';
      }
      $string = '';
      $iterator = clone $this;
      foreach($iterator as $token) {
         $string .= (string) $token;
      }
      return $string;
   }
   
   public function __clone() {
      $this->iterator = clone $this->iterator;
      $this->onClone();
   }
   
   public function count() : int {
      if ($this->iterator === null) {
         return 0;
      }
      $count = 0;
      $iterator = clone $this->iterator;
      while ($iterator->valid()) {
         if (null !== $this->currentMatch($iterator)) {
            $count ++;
         }
         $iterator->next();
      }
      return $count;
   }
   public function all() : array {
      return $this->range(0);
   }
   public function range(int $start, int $limit=null): array {
      if ($this->iterator === null) {
         return [];
      }
      /**
       * @var \Katmore\Tokenizer\Token\IteratorInterface $iterator
       */
      $iterator = clone $this->iterator;
      $iterator->rewind();
      $range = [];
      $pos = 0;
      $count = 0;
      while ($iterator->valid()) {
         if ($limit!==null && $count >= $limit) {
            break 1;
         }
         if (null !== ($token = $this->currentMatch($iterator))) {
            if ($pos >= $start) {
               $range[] = $token;
               $count ++;
            }
            $pos ++;
         }
         $iterator->next();
      }
      return $range;
   }
   public function rewind() {
      if ($this->iterator !== null) {
         $this->iterator->rewind();
      }
      $this->position = 0;
   }
   public function first(): ?Token {
      if ($this->iterator === null) {
         return null;
      }
      $iterator = clone $this->iterator;
      $iterator->rewind();
      return $this->currentMatch($iterator);
   }
   public function current() {
      if ($this->iterator === null) {
         return;
      }
      $token = $this->currentMatch($this->iterator);
      
      return $token;
   }
   public function valid() {
      if ($this->iterator === null) {
         return false;
      }
      $iterator = clone $this->iterator;
      $token = $this->currentMatch($iterator);
      return $token !== null;
   }
   public function next() {
      if ($this->iterator === null) {
         return;
      }
      $this->position ++;
   }
   public function key() {
      if ($this->iterator === null) {
         return null;
      }
      return $this->position;
   }
}