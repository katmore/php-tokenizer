<?php
namespace Katmore\Tokenizer\Parser;

use Katmore\Tokenizer\Identifier\CharIdentifier;
use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Exception;

class CharParser implements 
   CharParserInterface
{

   /**
    *
    * @var \Katmore\Tokenizer\Identifier\CharIdentifier|null
    */
   private $char;

   /**
    *
    * @var \Katmore\Tokenizer\Token\ContextInterface
    */
   protected $context;

   /**
    *
    * @param \Katmore\Tokenizer\Token\ContextInterface $context The Context object
    */
   public function __construct(Token\ContextInterface $context) {
      $this->context = $context;
   }

   /**
    * Start creating a new Token object representing a Char Identifier
    */
   public function createToken(): void {
      $this->char = null;
   }
   public function withContext(Token\ContextInterface $context): CharParserInterface {
      $parser = clone $this;
      $parser->context = $context;
      return $parser;
   }
   public function getContext(): Token\ContextInterface {
      return $this->context;
   }

   /**
    * @throws \Katmore\Tokenizer\Exception\InvalidArgumentException
    */
   public function setStringIdentifier(string $stringIdentifier): void {
      $this->char = new CharIdentifier($stringIdentifier);

      try {
         $this->char = new CharIdentifier($stringIdentifier);
      } catch (Exception\InvalidArgumentException $e) {
         throw new Exception\InvalidArgumentException('string identifier: ' . $e->getMessage(), null, $e);
      }

      $this->context = $this->context->withTokenPosIncremented();
      
      if (false!==strpos(self::INSTRUCTION_DELIM_CHARS,$stringIdentifier)) {
         $this->context = $this->context->withInstructionPosIncremented();
      }
   }

   /**
    * @throws \Katmore\Tokenizer\Exception\LogicException
    * @see \Katmore\Tokenizer\Parser\CharParser::setCharIdentifier()
    * @see \Katmore\Tokenizer\Parser\CharParser::setContext()
    */
   public function getToken(): Token {
      if ($this->char === null) {
         throw new Exception\LogicException('string identifier must be specified for each Token created');
      }
      return new Token($this->context, $this->char);
   }
}