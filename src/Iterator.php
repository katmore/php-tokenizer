<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer;
use Katmore\Tokenizer\Exception;

class BuilderDirector {
   
   /**
    * @var \Katmore\Tokenizer\TokenizerInterface
    */
   private $tokenizer;
   
   /**
    * @var \Katmore\Tokenizer\Token\CharBuilderInterface 
    */
   private $charBuilder;
   
   /**
    * @var \Katmore\Tokenizer\Token\PtokBuilderInterface
    */
   private $ptokBuilder;
   
   /**
    * Construct a Token BuilderDirector object
    * 
    * @param \Katmore\Tokenizer\TokenizerInterface $tokenizer
    * @param \Katmore\Tokenizer\Token\CharBuilderInterface $charBuilder The CharBuilder object.
    * @param \Katmore\Tokenizer\Token\PtokBuilderInterface $ptokBuilder The PtokBuilder object.
    * 
    */
   public function __construct(Tokenizer\TokenizerInterface $tokenizer, Token\CharBuilderInterface $charBuilder, Token\PtokBuilderInterface $ptokBuilder) {
      $charBuilder->setContext($ptokBuilder->getContext());
      $this->tokenizer = $tokenizer;
      $this->charBuilder = $charBuilder;
      $this->ptokBuilder = $ptokBuilder;
   }
   
   public function build() :?Token {
      if (null===($tokenIdentifier = $this->tokenizer->current())) {
         return null;
      }
      if (is_string($tokenIdentifier)) {
         return static::buildCharToken($this->charBuilder, $tokenIdentifier);
      }
      if (is_array($tokenIdentifier)) {
         $token = static::buildPtokToken($this->ptokBuilder, $tokenIdentifier);
         $this->charBuilder->setContext($token->getContext());
      }
      throw new Exception\LogicException('current tokenizer element is not a valid token identifier');
   }

   protected static function buildCharToken(Token\CharBuilderInterface $builder, string $charIdentifier): Token {
      $builder->createToken();
      $builder->setCharIdentifier($charIdentifier);
      return $builder->getToken();
   }
   protected static function buildPtokToken(Token\PtokBuilderInterface $builder, array $arrayIdentifier): Token {
      $builder->createToken();
      $builder->setArrayIdentifier($arrayIdentifier);
      return $builder->getToken();
   }
}