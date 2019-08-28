<?php declare(strict_types = 1);
namespace Katmore\Tokenizer\Tests\Unit;

use PHPUnit\Framework\TestCase;

use Katmore\Tokenizer\Identifier;
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
      new Identifier\CharIdentifier($invalidCharString);
      
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
      $char = new Identifier\CharIdentifier($charString);
      $this->assertEquals($charString, $char->getCharString());
   }
   
   /**
    * @dataProvider validCharStringProvider
    * @depends testValidCharString
    */
   public function testToString(string $charString) {
      $char = new Identifier\CharIdentifier($charString);
      $string = (string) $char;
      $this->assertEquals($charString, $string);
   }
   /**
    * @dataProvider validCharStringProvider
    * @depends testValidCharString
    */
   public function testJsonSerialize(string $charString) {
      $char = new Identifier\CharIdentifier($charString);
      $json = json_encode($char);
      $this->assertEquals(json_encode($charString), $json);
   }
   
   
}