<?php
namespace Katmore\Tokenizer\Token;

interface IdentifierInterface extends 
   \JsonSerializable
{
   public function __toString();
}