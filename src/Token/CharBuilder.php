<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Exception;

class CharBuilder
implements CharBuilderInterface
{
   
   /**
    *
    * @var \Katmore\Tokenizer\Token\Context
    */
   private $context;

   /**
    *
    * @var \Katmore\Tokenizer\Token\Identifier\Char|null
    */
   private $char;
   
   /**
    * Start creating a new Token object representing a Char Identifier
    */
   public function createToken(): void {
      $this->char = null;
   }
   
   /**
    * Specify the Context object for any Token object that will be created
    */
   public function setContext(Context $context) : void {
      $this->context = $context;
   }
   /**
    * Specify the CharIdentifier for the current Token object being created
    */
   public function setCharIdentifier(string $charIdentifier): void {
      $this->char = new Identifier\Char($charIdentifier);
   }
   
   /**
    * @throws \Katmore\Tokenizer\Exception\LogicException
    * @see \Katmore\Tokenizer\Token\CharBuilder::setCharIdentifier()
    * @see \Katmore\Tokenizer\Token\CharBuilder::setContext()
    */
   public function getToken(): Token {
      if ($this->char===null) {
         throw new Exception\LogicException('CharIdentifier must be specified for each Token created');
      }
      if ($this->context===null) {
         throw new Exception\LogicException('Context must be specified at least one time');
      }
      return new Token($this->context,$this->char);
   }
}