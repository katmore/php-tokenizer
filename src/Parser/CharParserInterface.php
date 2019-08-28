<?php
namespace Katmore\Tokenizer\Parser;

use Katmore\Tokenizer\Token\ContextInterface;

interface CharParserInterface extends 
   TokenParserInterface
{
   
   public function withContext(ContextInterface $context) : CharParserInterface;
   
   /**
    * Sets the string token identifier
    * 
    * @param string The string token identifier value must be a string exactly one character in length.
    */
   public function setStringIdentifier(string $stringIdentifier): void;
}