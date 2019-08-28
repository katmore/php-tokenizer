<?php
declare(strict_types = 1);

namespace Katmore\Tokenizer\Tests\Unit\Token;

use PHPUnit\Framework\TestCase;
use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Exception;

class ContextTest extends TestCase
{
   protected function assertInitialValues(Token\ContextInterface $context): void {
      $this->assertEquals(0, $context->getLineNo(), 'initial line number must be 0');
      $this->assertEquals(0, $context->getTokenPos(), 'initial token position must be 0');
      $this->assertEquals(0, $context->getInstructionPos(), 'initial instruction position must be 0');
   }
   public function testInstantiate(): Token\ContextInterface {
      $context = new Token\Context();
      $this->assertInitialValues($context);
      return $context;
   }
   const LINE_NO_CEIL = 100;

   /**
    * @depends testInstantiate
    */
   public function testWithLineNo(Token\ContextInterface $context): Token\ContextInterface {
      //$context = new Token\Context();
      for($lineNo = 1;$lineNo <= static::LINE_NO_CEIL;$lineNo ++) {
         $context = $context->withLineNo($lineNo);

         $this->assertEquals($lineNo, $context->getLineNo());
      }
      return $context;
   }

   /**
    * @depends testInstantiate
    */
   public function testInvalidWithLineNo(Token\ContextInterface $context): void {
      for($lineNo = 1;$lineNo <= static::LINE_NO_CEIL;$lineNo ++) {
         $this->expectException(Exception\InvalidArgumentException::class);
         $context = $context->withLineNo($lineNo * -1);
      }
   }
   const INSTRUCTION_POS_CEIL = 100;

   /**
    * @depends testWithLineNo
    */
   public function testWithInstructionPosIncremented(Token\ContextInterface $context): Token\ContextInterface {
      //$context = new Token\Context();
      for($instructionPos = 1;$instructionPos <= static::INSTRUCTION_POS_CEIL;$instructionPos ++) {
         $context = $context->withInstructionPosIncremented();
         $this->assertEquals($instructionPos, $context->getInstructionPos());
      }
      return $context;
   }
   const TOKEN_POS_CEIL = 100;
   /**
    * @depends testWithInstructionPosIncremented
    */
   public function testWithTokenPosIncremented(Token\ContextInterface $context): Token\ContextInterface {
      //$context = new Token\Context();
      for($tokenPos = 1;$tokenPos <= static::INSTRUCTION_POS_CEIL;$tokenPos ++) {
         $context = $context->withTokenPosIncremented();
         $this->assertEquals($tokenPos, $context->getTokenPos());
      }
      return $context;
   }
   /**
    * @depends testWithInstructionPosIncremented
    */
   public function testWithReset(Token\ContextInterface $context): Token\ContextInterface {
      $context = $context->withReset();
      $this->assertInitialValues($context);
      return $context;
   }
}