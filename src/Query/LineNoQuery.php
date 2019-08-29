<?php
namespace Katmore\Tokenizer\Query;

use Katmore\Tokenizer\Token;

class LineNoQuery implements
Token\QueryInterface
{
   use Token\QueryTrait;
   /**
    * @var int
    */
   private $lineNo;
   protected function currentMatch(Token\IteratorInterface &$iterator): ?Token {
      $match = null;
      while ($iterator->valid()) {
         /**
          * @var \Katmore\Tokenizer\Token $token
          */
         $token = $iterator->current();
         if ($token->getContext()->getInstructionPos()===$this->lineNo) {
            $match = $token;
         }
         $iterator->next();
         if ($match !== null) {
            return $match;
         }
      }
      return null;
   }
   
   public function __construct(Token\IteratorInterface $iterator, int $lineNo) {
      $this->setIterator($iterator);
      $this->lineNo = $lineNo;
   }
}