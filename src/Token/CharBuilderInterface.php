<?php
namespace Katmore\Tokenizer\Token;

interface CharBuilderInterface extends BuilderInterface {
   /**
    * Specify the Context object for any Token object that will be created
    */
   public function setContext(Context $context) : void;
   /**
    * Specify the CharIdentifier for the current Token object being created
    */
   public function setCharIdentifier(string $charIdentifier): void ;
}