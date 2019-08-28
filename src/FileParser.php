<?php
namespace Katmore\Tokenizer;

class FileParser implements 
   Identifier\EnumeratorInterface
{

   use Identifier\EnumeratorTrait;

   /**
    * @var string
    */
   private $source;
   /**
    *
    * @var string
    */
   private $flags;

   /**
    * Builds a FileTokenizer object
    *
    * @param string $path The path to the PHP source file to parse.
    * @param int $flags valid flags: <ul> <li><b>TOKEN_PARSE</b> - Recognises the ability to use reserved words in
    *           specific contexts. </li> </ul>
    * 
    * @throws \Katmore\Tokenizer\Exception\RuntimeException fails to read path
    */
   public function __construct(string $path, int $flags = null) {
      if (false === ($source = file($this->path, FILE_IGNORE_NEW_LINES))) {
         throw new Exception\RuntimeException("failed to read path: $path");
      }
      $this->source = implode("\n", $source);
      $this->flags = $flags;
   }
   public function enumerateTokenIdentifiers(): array {
      return token_get_all($this->source, $this->flags);
   }
}