<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Token;

interface QueryInterface extends IteratorInterface, \Countable {
   public function parent() :? Token\IteratorInterface;
   /**
    * @return \Katmore\Tokenizer\Token[]
    */
   public function range(int $start, int $limit=null) : array;
   /**
    * @return \Katmore\Tokenizer\Token[]
    */
   public function all() : array;
   /**
    * @return \Katmore\Tokenizer\Token|null
    */
   public function first(): ?Token;
   /**
    * @return \Katmore\Tokenizer\Token|null
    */
   public function current();
   public function __toString();
}