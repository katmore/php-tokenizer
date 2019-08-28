<?php
namespace Katmore\Tokenizer;

interface TokenizerInterface extends \Iterator {
   
   /**
    * Rewind PHP token identifier iteration position to the first element
    *
    * @return void
    * @see \Iterator::rewind()
    */
   public function rewind();
   
   /**
    * Return the current PHP token identifier iteration element
    *
    * @return array|string|null The PHP token identifier of the current iteration position, which is either a string or an array:
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
    * @see \Iterator::current()
    */
   public function current();
   
   /**
    * Return the key of current PHP token identifier iteration element
    *
    * @return int The key of current PHP token identifier, first key starting with <code>0</code>.
    * @see \Iterator::key()
    */
   public function key();
   
   /**
    * Move forward to next PHP token identifier iteration element
    *
    * @return void
    * @see \Iterator::next()
    */
   public function next();
   
   /**
    * Checks if current PHP token identifier iteration position is valid
    *
    * @return bool
    * @see \Iterator::valid()
    */
   public function valid();
   
   /**
    * Enumerates Token Identifiers
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
   public function enumerateTokenIdentifiers() : array;
}