<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Exception;

class Context implements 
   ContextInterface
{

   /**
    * @var int The instruction position.
    * @see \Katmore\Tokenizer\Token\Context::getInstructionPos()
    */
   protected $instructionPos = 0;

   /**
    * @var int The token position.
    * @see \Katmore\Tokenizer\Token\Context::getTokenPos()
    */
   protected $tokenPos = 0;

   /**
    * @var int The line number.
    * @see \Katmore\Tokenizer\Token\Context::getLineNo()
    */
   protected $lineNo = 0;
   public function getLineNo(): int {
      return $this->lineNo;
   }
   public function getInstructionPos(): int {
      return $this->instructionPos;
   }
   public function getTokenPos(): int {
      return $this->tokenPos;
   }
   public function withLineNo(int $lineNo): Context {
      if ($lineNo < 1) {
         throw new Exception\InvalidArgumentException('lineNo must be a value of 1 or greater');
      }
      $context = clone $this;
      $context->lineNo = $lineNo;
      return $context;
   }
   public function withInstructionPosIncremented(): Context {
      $context = clone $this;
      $context->instructionPos ++;
      return $context;
   }
   public function withTokenPosIncremented(): Context {
      $context = clone $this;
      $context->tokenPos ++;
      return $context;
   }
}