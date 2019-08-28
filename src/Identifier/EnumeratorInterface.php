<?php
namespace Katmore\Tokenizer\Identifier;

use Katmore\Tokenizer\Parser;

interface EnumeratorInterface extends 
   Parser\IdentifierParserInterface
{
   /**
    * Enumerates PHP token identifiers
    *
    * Each individual token identifier is either a single char (i.e.: ;, .,
    * >, !, etc...), or a three element array containing the token index in element 0, the string content of the
    * original token in element 1 and the line number in element 2.
    *
    * @return array Each element is a token identifier, which is either a string or an array:
    * <ul>
    *    <li>single char string:
    * <pre><code>string(1) "p"</code></pre>
    *    </li>
    *    <li>three element array:
    * <pre><code>
    * [
    *     <b>[0]</b> => <b>int</b> (token type),
    *     <b>[1]</b> => <b>string</b> (original token content),
    *     <b>[2]</b> => <b>int</b> (line number),
    * ]
    * </code></pre>
    *    </li>
    * </ul>
    * @see token_get_all()
    * @link https://php.net/manual/en/function.token-get-all.php#refsect1-function.token-get-all-returnvalues
    */
   public function enumerateTokenIdentifiers(): array;
}