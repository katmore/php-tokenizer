<?php
namespace Katmore\Tokenizer\Parser;

use Katmore\Tokenizer\Identifier\PtokIdentifier;
use Katmore\Tokenizer\Exception;
use Katmore\Tokenizer\Token;

class PtokParser implements 
   PtokParserInterface
{

   /**
    *
    * @var \Katmore\Tokenizer\Identifier\PtokIdentifier|null
    */
   private $ptok;

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
    * Start creating a new Token object representing a Ptok Identifier
    */
   public function createToken(): void {
      $this->ptok = null;
   }
   public function getContext(): Token\ContextInterface {
      return $this->context;
   }
   public function withContext(Token\ContextInterface $context): PtokParserInterface {
      $parser = clone $this;
      $parser->context = $context;
      return $parser;
   }

   /**
    * @throws \Katmore\Tokenizer\Exception\InvalidArgumentException
    */
   public function setArrayIdentifier(array $arrayIdentifier): void {
      if (!isset($arrayIdentifier[0])) {
         throw new Exception\InvalidArgumentException('element 0 of array identifier is missing');
      }
      if (!is_int($arrayIdentifier[0])) {
         throw new Exception\InvalidArgumentException('element 0 of array identifier must be an integer');
      }

      $tokenType = $arrayIdentifier[0];

      if (!isset($arrayIdentifier[1])) {
         throw new Exception\InvalidArgumentException('element 1 of array identifier is missing');
      }
      if (!is_string($arrayIdentifier[1])) {
         throw new Exception\InvalidArgumentException('element 1 of array identifier must be an string');
      }
      $contents = $arrayIdentifier[1];


      if (!isset($arrayIdentifier[2])) {
         throw new Exception\InvalidArgumentException('element 2 of array identifier is missing');
      }
      if (!is_int($arrayIdentifier[2])) {
         throw new Exception\InvalidArgumentException('element 2 of array identifier must be an integer');
      }
      $lineNo = $arrayIdentifier[2];

      try {
         $this->ptok = new PtokIdentifier($tokenType, $contents);
      } catch (Exception\InvalidArgumentException $e) {
         throw new Exception\InvalidArgumentException('element 0 of array identifier: ' . $e->getMessage(), null, $e);
      }

      $this->context = $this->context->withTokenPosIncremented()
         ->withLineNo($lineNo);

      //if ($this->ptok->getTokenType() === T_CLOSE_TAG) {
      if (in_array($this->ptok->getTokenType(), self::INSTRUCTION_DELIM_TOKENS)) {
         $this->context = $this->context->withInstructionPosIncremented();
      }
   }

   /**
    * @throws \Katmore\Tokenizer\Exception\LogicException
    * @see \Katmore\Tokenizer\Parser\CharParser::setArrayIdentifier()
    */
   public function getToken(): Token {
      if ($this->ptok === null) {
         throw new Exception\LogicException('ArrayIdentifier must be specified for each Token created');
      }
      return new Token($this->context, $this->ptok);
   }
}