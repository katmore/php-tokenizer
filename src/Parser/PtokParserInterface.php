<?php
namespace Katmore\Tokenizer\Parser;

use Katmore\Tokenizer\Token\ContextInterface;

interface PtokParserInterface extends 
   TokenParserInterface
{
   const INSTRUCTION_DELIM_TOKENS = [
      T_OPEN_TAG,
      T_OPEN_TAG_WITH_ECHO,
      T_CLOSE_TAG,
      T_CONST,
      T_PUBLIC,
      T_PRIVATE,
      T_VAR,
      T_CLASS,
      T_DOC_COMMENT,
      T_COMMENT,
   ];
   public function withContext(ContextInterface $context) : PtokParserInterface;

   /**
    * Sets the array token identifier
    *
    * @param array $arrayIdentifier The array token identifier value matches a token_get_all() return value element having an array value: 
    * a three element array containing the token type in element 0, the string content of the original token in element 1 and the line number in element 2. 
    * <pre><code>
    * [
    *     <b>[0]</b> => <b>int</b> (token type),
    *     <b>[1]</b> => <b>string</b> (original token content),
    *     <b>[2]</b> => <b>int</b> (line number),
    * ]
    * </code></pre>
    *
    * @see token_get_all()
    */
   public function setArrayIdentifier(array $arrayIdentifier): void;

}