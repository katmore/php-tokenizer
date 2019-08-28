<?php
namespace Katmore\Tokenizer;

class Iterator implements 
   \Iterator
{

   /**
    * @var \Katmore\Tokenizer\Parser\IdentifierParserInterface
    */
   private $identifierParser;

   /**
    * @var \Katmore\Tokenizer\Parser\CharParserInterface 
    */
   private $charParser;

   /**
    * @var \Katmore\Tokenizer\Parser\PtokParserInterface
    */
   private $ptokParser;
   public function rewind() {
      if ($this->ptokParser !== null) {
         $this->ptokParser = $this->ptokParser->withContext($this->ptokParser->getContext()
            ->withReset());
      }
      if ($this->charParser !== null) {
         $this->charParser = $this->charParser->withContext($this->charParser->getContext()
            ->withReset());
      }
      $this->identifierParser->rewind();
   }
   public function current() {
      return static::identifierParser2Token($this->identifierParser, $this->ptokParser, $this->charParser);
   }
   public function key() {
      return $this->identifierParser->key();
   }
   public function next() {
      return $this->identifierParser->next();
   }
   public function valid() {
      return $this->identifierParser->valid();
   }
   protected static function identifierParser2Token(Parser\IdentifierParserInterface $identifierParser, Parser\PtokParserInterface &$ptokParser = null,
      Parser\CharParserInterface &$charParser = null): ?Token {
      if (null === ($tokenIdentifier = $identifierParser->current())) {
         return null;
      }
      return Token::tokenIdentifier2Token($tokenIdentifier, $ptokParser, $charParser);
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
      if (is_string($source)) {
         if ($source === '' || false !== strpos('<?php', $source) || !is_file($source)) {
            $source = new SourceParser($source);
         } else {
            $source = new FileParser($source);
         }
      }

      if (!$source instanceof Parser\IdentifierParserInterface) {
         throw new Exception\InvalidArgumentException(
            'source must be one of the following: (string) PHP source, (string) path to a PHP source file, or (' .
            Parser\IdentifierParserInterface::class .
            ') identifier parser object');
      }

      $this->identifierParser = $source;
      $this->charParser = $charParser;
      $this->ptokParser = $ptokParser;
   }
}