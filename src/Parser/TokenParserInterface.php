<?php
namespace Katmore\Tokenizer\Parser;

use Katmore\Tokenizer\Token;

interface TokenParserInterface
{
   
   /**
    * Gets the Context object
    *
    * @return \Katmore\Tokenizer\Token\ContextInterface
    */
   public function getContext(): Token\ContextInterface;
   
   /**
    * Get the current Token object being created
    * 
    * @return \Katmore\Tokenizer\Token The Token object.
    */
   public function getToken(): Token;

   /**
    * Start creating a new Token object
    * 
    * @return void
    */
   public function createToken(): void;
}