<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer\Token;
use Katmore\Tokenizer\Parser;
use Katmore\Tokenizer\Exception;

trait IdentifierConverterTrait
{
   protected static function identifierParser2Token(Parser\IdentifierParserInterface $identifierParser, Parser\PtokParserInterface &$ptokParser = null,
      Parser\CharParserInterface &$charParser = null): ?Token {
      if (null === ($tokenIdentifier = $identifierParser->current())) {
         return null;
      }
      return static::tokenIdentifier2Token($tokenIdentifier, $ptokParser, $charParser);
   }
   protected static function tokenIdentifier2Token($tokenIdentifier, Parser\PtokParserInterface &$ptokParser = null, Parser\CharParserInterface &$charParser = null): Token {
      if (is_string($tokenIdentifier)) {
         if ($charParser === null) {
            $charParser = new Parser\CharParser($ptokParser !== null ? $ptokParser->getContext() : new Token\Context());
         }
         $token = static::stringIdentifier2Token($tokenIdentifier, $charParser);
         if ($ptokParser === null) {
            $ptokParser = new Parser\PtokParser($token->getContext());
         } else {
            $ptokParser = $ptokParser->withContext($token->getContext());
         }
         return $token;
      }
      if (is_array($tokenIdentifier)) {
         if ($ptokParser === null) {
            $ptokParser = new Parser\PtokParser($charParser !== null ? $charParser->getContext() : new Token\Context());
         }
         $token = static::arrayIdentifier2Token($tokenIdentifier, $ptokParser);
         if ($charParser === null) {
            $charParser = new Parser\CharParser($token->getContext());
         } else {
            $charParser = $charParser->withContext($token->getContext());
         }
         return $token;
      }

      throw new Exception\LogicException('token identifier must be a string or array');
   }
   protected static function stringIdentifier2Token(string $stringIdentifier, Parser\CharParserInterface $charParser): Token {
      $charParser->createToken();
      $charParser->setStringIdentifier($stringIdentifier);
      return $charParser->getToken();
   }
   protected static function arrayIdentifier2Token(array $arrayIdentifier, Parser\PtokParserInterface $ptokParser): Token {
      $ptokParser->createToken();
      $ptokParser->setArrayIdentifier($arrayIdentifier);
      return $ptokParser->getToken();
   }
}