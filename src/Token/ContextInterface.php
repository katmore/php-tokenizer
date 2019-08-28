<?php
namespace Katmore\Tokenizer\Token;

interface ContextInterface extends \JsonSerializable
{
   /**
    * Gets the line number
    *
    * @return int The line number presently encountered, where <i><code>1</code></i> is the first encountered line.
    */
   public function getLineNo(): int;
   /**
    * Gets the instruction position
    *
    * @return int The ordinal position of the presently encountered instruction, where <i><code>1</code></i> is the first encountered statement.
    */
   public function getInstructionPos(): int;
   /**
    * Gets the token position
    *
    * @return int The ordinal position of the presently encountered token, where <i><code>1</code></i> is the first encountered token.
    */
   public function getTokenPos(): int;
   
   public function withReset() : ContextInterface;
   /**
    * Clones the Context object and changes its line number
    *
    * @param int $lineNo The source code line number presently encountered by the tokenizer. Must be a value of 1 or greater.
    *
    * @return \Katmore\Tokenizer\Token\Context An indentical Context object except for having the specified line number.
    *
    * @see \Katmore\Tokenizer\Token\Context::getLineNo()
    * @throws \InvalidArgumentException
    */
   public function withLineNo(int $lineNo): ContextInterface;

   /**
    * Clones the Context object and increments its instruction position by one
    *
    * @return \Katmore\Tokenizer\Token\Context An identical Context object except for having the instruction position incremented by one.
    *
    * @see \Katmore\Tokenizer\Token\Context::getInstructionPos()
    */
   public function withInstructionPosIncremented(): ContextInterface;

   /**
    * Clones the Context object and increments its token position by one
    *
    * @see \Katmore\Tokenizer\Token\Context::getTokenPos()
    *
    * @return \Katmore\Tokenizer\Token\Context An indentical Context object except for having the token position incremented by one.
    */
   public function withTokenPosIncremented(): ContextInterface;
}
