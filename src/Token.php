<?php
namespace Katmore\Tokenizer;

final class Token implements 
   \JsonSerializable
{

   /**
    * @var \Katmore\Tokenizer\Token\ContextInterface
    */
   private $context;

   /**
    * @var \Katmore\Tokenizer\Token\IdentifierInterface
    */
   private $identifier;

   /**
    * @return \Katmore\Tokenizer\Token\ContextInterface The token context object.
    */
   public function getContext(): Token\ContextInterface {
      return $this->context;
   }

   /**
    * @return \Katmore\Tokenizer\Token\IdentifierInterface The token type object.
    */
   public function getIdentifier(): Token\IdentifierInterface {
      return $this->identifier;
   }

   /**
    * Constructs a Token object
    * 
    * @param \Katmore\Tokenizer\Token\Context $tokenizerContext The token context object.
    * @param \Katmore\Tokenizer\Token\TypeInterface The token type object.
    */
   public function __construct(Token\ContextInterface $context, Token\IdentifierInterface $identifier) {
      $this->context = $context;
      $this->identifier = $identifier;
   }
   public function jsonSerialize() {
      return [
         'context'=>$this->getContext(),
         'token'=>$this->getIdentifier(),
      ];
   }
}