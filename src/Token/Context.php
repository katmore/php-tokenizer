<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Exception;

final class Context implements 
   ContextInterface
{

   /**
    * @var int The instruction position.
    * @see \Katmore\Tokenizer\Token\Context::getInstructionPos()
    */
   protected $instructionPos = 0;

   /**
    * @var int The instruction position.
    * @see \Katmore\Tokenizer\Token\Context::getInstructionPos()
    */
   protected $tokenPos = 0;

   /**
    * @var int The line number.
    */
   protected $lineNo = 0;
   public function jsonSerialize() {
      return [
         'instruction'=>$this->instructionPos,
         'token'=>$this->tokenPos,
         'line'=>$this->lineNo,
      ];
   }
   public function getLineNo(): int {
      return $this->lineNo;
   }
   public function getInstructionPos(): int {
      return $this->instructionPos;
   }
   public function getTokenPos(): int {
      return $this->tokenPos;
   }
   public function withReset() : ContextInterface {
      $context = clone $this;
      $context->lineNo = 0;
      $context->instructionPos = 0;
      $context->tokenPos = 0;
      return $context;
   }
   public function withLineNo(int $lineNo): ContextInterface {
      if ($lineNo < 1) {
         throw new Exception\InvalidArgumentException('lineNo must be a value of 1 or greater');
      }
      $context = clone $this;
      $context->lineNo = $lineNo;
      return $context;
   }
   public function withInstructionPosIncremented(): ContextInterface {
      $context = clone $this;
      $context->instructionPos ++;
      return $context;
   }
   public function withTokenPosIncremented(): ContextInterface {
      $context = clone $this;
      $context->tokenPos ++;
      return $context;
   }
}