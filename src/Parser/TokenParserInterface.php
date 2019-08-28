<?php
namespace Katmore\Tokenizer\Token;

use Katmore\Tokenizer;

interface BuilderInterface {
   /**
    * Get the current Token object being created
    * 
    * @return \Katmore\Tokenizer\Token The Token object.
    */
   public function getToken(): Tokenizer\Token ;
   
   /**
    * Start creating a new Token object
    * 
    * @return void
    */
   public function createToken(): void ;
}