<?php
namespace Katmore\Tokenizer\Token;

interface PtokBuilderInterface extends BuilderInterface {
   
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