<?php
namespace Katmore\Tokenizer\Parser;

interface CharParserInterface extends 
   TokenParserInterface
{
   /**
    * Sets the string token identifier
    * 
    * @param string The string token identifier value must be a string exactly one character in length.
    */
   public function setStringIdentifier(string $stringIdentifier): void;
}