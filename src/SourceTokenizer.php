<?php
namespace Katmore\Tokenizer;

class SourceTokenizer implements TokenizerInterface {
   
   use TokenizerTrait;
   
   /**
    *
    * @var string source
    */
   private $source;
   /**
    *
    * @var string
    */
   private $flags;
   
   /**
    * Builds a SourceTokenizer object
    *
    * @param string $source The PHP source to parse.
    * @param int $flags valid flags: <ul> <li><b>TOKEN_PARSE</b> - Recognises the ability to use reserved words in
    *           specific contexts. </li> </ul>
    */
   public function __construct(string $source, int $flags = null) {
      $this->source = $source;
      $this->flags = $flags;
   }
   
   public function enumerateTokenIdentifiers() : array {
      return token_get_all($this->source, $this->flags);
   }
}