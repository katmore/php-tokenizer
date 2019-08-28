<?php declare(strict_types = 1);
namespace Katmore\Tokenizer\Tests\Unit;

use PHPUnit\Framework\TestCase;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Exception;

class ContextTest extends TestCase {
   
   public function lineNoProvider() : array {
      return [
         [10],
         [11],
         [12],
         [13],
         [14],
         [15],
      ];
   }
   
   /**
    * @dataProvider lineNoProvider
    */
   public function testWithLineNo(int $lineNo) {
      
      $context = new Token\Context();
      
      $context = $context->withLineNo($lineNo);
      
      $this->assertEquals($lineNo, $context->getLineNo());
      
   }
   
   public function invalidLineNoProvider() : array {
      return [
         [0],
         [-11],
         [-12],
         [-13],
         [-14],
         [-15],
      ];
   }
   
   /**
    * @dataProvider invalidLineNoProvider
    */
   public function testInvalidWithLineNo(int $lineNo) {
      
      $this->expectException(Exception\InvalidArgumentException::class);
      
      $context = new Token\Context();
      
      $context = $context->withLineNo($lineNo);
      
   }
   
   const INSTRUCTION_POS_CEIL = 100;
   
   public function testWithInstructionPosIncremented() {
      $context = new Token\Context();
      for($instructionPos=1;$instructionPos<=static::INSTRUCTION_POS_CEIL;$instructionPos++) {
         $context = $context->withInstructionPosIncremented();
         $this->assertEquals($instructionPos, $context->getInstructionPos());
      }
   }
   
   const TOKEN_POS_CEIL = 100;
   
   public function testWithTokenPosIncremented() {
      $context = new Token\Context();
      for($tokenPos=1;$tokenPos<=static::INSTRUCTION_POS_CEIL;$tokenPos++) {
         $context = $context->withTokenPosIncremented();
         $this->assertEquals($tokenPos, $context->getTokenPos());
      }
   }
}