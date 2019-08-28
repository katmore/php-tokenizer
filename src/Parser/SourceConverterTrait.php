<?php
namespace Katmore\Tokenizer\Parser;

use Katmore\Tokenizer\Parser;
use Katmore\Tokenizer\Exception;

trait SourceConverterTrait {
   /**
    *
    * @param \Katmore\Tokenizer\Parser\IdentifierParserInterface|string $source The PHP source representation.
    *    The value may be an identifier parser object or a string.
    *    If the value is a string, it must be either a PHP source string, or a path to a PHP source file.
    * <ul>
    *    <li><b>string $source</b> The PHP source to parse.</li>
    *    <li><b>string $source</b> The path to the PHP source file to parse.</li>
    *    <li><b>\Katmore\Tokenizer\Parser\IdentifierParserInterface $source</b> The identifier parser object.</li>
    * </ul>
    */
   protected static function source2IdentifierParser($source) : Parser\IdentifierParserInterface {
      if (is_string($source)) {
         if ($source === '' || false !== strpos('<?php', $source) || !is_file($source)) {
            $source = new Parser\SourceParser($source);
         } else {
            $source = new Parser\FileParser($source);
         }
      }
      
      if (!$source instanceof Parser\IdentifierParserInterface) {
         throw new Exception\InvalidArgumentException(
         'source must be one of the following: (string) PHP source, (string) path to a PHP source file, or (' .
         Parser\IdentifierParserInterface::class .
         ') identifier parser object');
      }
      
      return $source;
   }
}