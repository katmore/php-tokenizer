<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Exception;
use Katmore\Tokenizer\Token;

class PtokBuilder implements 
   PtokBuilderInterface
{

   /**
    *
    * @var \Katmore\Tokenizer\Token\Identifier\Ptok|null
    */
   private $ptok;

   /**
    *
    * @var \Katmore\Tokenizer\Token\Context
    */
   private $context;

   /**
    *
    * @param \Katmore\Tokenizer\Token\Context $context The Context object
    */
   public function __construct(Context $context) {
      $this->context = $context;
   }
   
   /**
    * Start creating a new Token object representing a Ptok Identifier
    */
   public function createToken(): void {
      $this->ptok = null;
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
      try {
         Identifier\Ptok::validateTokenType($arrayIdentifier[0]);
      } catch (Exception\InvalidArgumentException $e) {
         throw new Exception\InvalidArgumentException('element 0 of array identifier: '.$e->getMessage(),null,$e);
      }
      $token = $arrayIdentifier[0];

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

      $this->context = $this->context->withTokenPosIncremented()->withLineNo($lineNo);

      $this->ptok = new Identifier\Ptok($token, $contents);
   }

   /**
    * @throws \Katmore\Tokenizer\Exception\LogicException
    * @see \Katmore\Tokenizer\Token\CharBuilder::setArrayIdentifier()
    */
   public function getToken(): Token {
      if ($this->ptok === null) {
         throw new Exception\LogicException('ArrayIdentifier must be specified for each Token created');
      }
      return new Token($this->context, $this->ptok);
   }
}