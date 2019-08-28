<?php
namespace Katmore\Tokenizer;

final class Token {
   
   /**
    * @var \Katmore\Tokenizer\Token\Context
    */
   private $context;
   
   /**
    * @var \Katmore\Tokenizer\Token\IdentifierInterface
    */
   private $identifier;
   
   /**
    * @return \Katmore\Tokenizer\Token\Context The token context object.
    */
   public function getContext() : Token\Context {
      return $this->context;
   }
   
   /**
    * @return \Katmore\Tokenizer\Token\IdentifierInterface The token type object.
    */
   public function getIdentifier() : Token\IdentifierInterface {
      return $this->identifier;
   }
   
   /**
    * Constructs a Token object
    * 
    * @param \Katmore\Tokenizer\Token\Context $tokenizerContext The token context object.
    * @param \Katmore\Tokenizer\Token\TypeInterface The token type object.
    */
   public function __construct(Token\Context $context, Token\IdentifierInterface $identifier) {
      $this->context = $context;
      $this->identifier = $identifier;
   }
}