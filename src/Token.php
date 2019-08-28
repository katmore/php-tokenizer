<?php
namespace Katmore\Tokenizer;

final class Token
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
   
   public static function tokenIdentifier2Token($tokenIdentifier, Parser\PtokParserInterface &$ptokParser = null, Parser\CharParserInterface &$charParser = null): Token {
      if (is_string($tokenIdentifier)) {
         $token = static::stringIdentifier2Token($tokenIdentifier, $charParser);
         if ($ptokParser === null) {
            $ptokParser = new Parser\PtokParser($token->getContext());
         } else {
            $ptokParser = $ptokParser->withContext($token->getContext());
         }
      }
      if (is_array($tokenIdentifier)) {
         $token = static::arrayIdentifier2Token($tokenIdentifier, $ptokParser);
         if ($charParser === null) {
            $charParser = new Parser\CharParser($token->getContext());
         } else {
            $charParser = $charParser->withContext($token->getContext());
         }
      }
      
      throw new Exception\LogicException('token identifier must be a string or array');
   }
   public static function stringIdentifier2Token(string $stringIdentifier, Parser\CharParserInterface $charParser): Token {
      $charParser->createToken();
      $charParser->setCharIdentifier($stringIdentifier);
      return $charParser->getToken();
   }
   public static function arrayIdentifier2Token(array $arrayIdentifier, Parser\PtokParserInterface $ptokParser): Token {
      $ptokParser->createToken();
      $ptokParser->setArrayIdentifier($arrayIdentifier);
      $token = $ptokParser->getToken();
      return $token;
   }
}