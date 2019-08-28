<?php declare(strict_types = 1);
namespace Katmore\Tokenizer\Tests\Unit;

use PHPUnit\Framework\TestCase;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Exception;

class CharTest extends TestCase {
   public function invalidCharStringProvider() : array {
      return [
         ['aa'],
         ['bb'],
         ['cc'],
         ['dd'],
      ];
   }
   
   /**
    * @dataProvider invalidCharStringProvider
    */
   public function testInvalidCharString(string $invalidCharString) {
      $this->expectException(Exception\InvalidArgumentException::class);
      new Token\Identifier\Char($invalidCharString);
      
   }
   
   public function validCharStringProvider() : array {
      return [
         ['a'],
         ['b'],
         ['c'],
         ['d'],
      ];
   }
   
   /**
    * @dataProvider validCharStringProvider
    */
   public function testValidCharString(string $charString) {
      $char = new Token\Identifier\Char($charString);
      $this->assertEquals($charString, $char->getCharString());
   }
   
   /**
    * @dataProvider validCharStringProvider
    * @depends testValidCharString
    */
   public function testToString(string $charString) {
      $char = new Token\Identifier\Char($charString);
      $string = (string) $char;
      $this->assertEquals($charString, $string);
   }
   /**
    * @dataProvider validCharStringProvider
    * @depends testValidCharString
    */
   public function testJsonSerialize(string $charString) {
      $char = new Token\Identifier\Char($charString);
      $json = json_encode($char);
      $this->assertEquals(json_encode($charString), $json);
   }
   
   
}