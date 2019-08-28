<?php
namespace Katmore\Tokenizer;

class Iterator implements 
   Token\IteratorInterface
{

   use Token\IteratorTrait;
   use Token\IdentifierConverterTrait;
   use Parser\SourceConverterTrait;
   public function current() {
      if ($this->getIdentifierParser()!==null) {
         return static::identifierParser2Token($this->getIdentifierParser(), $this->ptokParser, $this->charParser);
      }
   }


   /**
    * Construct a Token BuilderDirector object
    * 
    * @param \Katmore\Tokenizer\Parser\IdentifierParserInterface|string $source The PHP source representation.
    *    The value may be an identifier parser object or a string. 
    *    If the value is a string, it must be either a PHP source string, or a path to a PHP source file.
    * <ul> 
    *    <li><b>string $source</b> The PHP source to parse.</li>
    *    <li><b>string $source</b> The path to the PHP source file to parse.</li>
    *    <li><b>\Katmore\Tokenizer\Parser\IdentifierParserInterface $source</b> The identifier parser object.</li>
    * </ul>  
    * @param \Katmore\Tokenizer\Parser\CharParserInterface $charParser Optionally specify a CharParser object.
    * @param \Katmore\Tokenizer\Parser\PtokParserInterface $ptokParser Optionally specify a PtokParser object.
    * 
    */
   public function __construct($source, Parser\PtokParserInterface $ptokParser = null, Parser\CharParserInterface $charParser = null) {
      $this->setIdentifierParser(static::source2IdentifierParser($source));
      $this->charParser = $charParser;
      $this->ptokParser = $ptokParser;
   }
}