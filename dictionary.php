<?php
class Dictionary {
  /**
   * Key is dictionary word. Value is true.
   */
  private $by_word = array();

  /**
   * Key is metaphone.
   * Value is array of matching dictionary words.
   */
  private $by_metaphone = array();

  /**
   * Constructor takes a filename of correctly spelled words separated by newlines.
   */
  public function __construct($filename) {
    $handle = fopen($filename, "r");
    if ($handle) {
      while (($word = fgets($handle)) !== false) {
        $word = rtrim($word);
        $m = metaphone($word);
        $this->by_word[$word] = true;
        $this->by_metaphone[$m][] = $word;
      }
      fclose($handle);
    }
  }

  /**
   * Reads file, checks against dictionary, and returns array of error results.
   */
  public function check($filename) {
    $results = array();
    $lnum = 0;
    $handle = fopen($filename, "r");
    if ($handle) {
      while (($line = fgets($handle)) !== false) {
        $lnum++;
        $words = str_word_count($line, 2); //php function does more than count
        foreach ($words as $cnum => $word) {
          $lword = strtolower($word);
          if ( ! array_key_exists($lword, $this->by_word)) {
            $result = array();
            $result['word'] = $word;
            $result['line'] = $lnum;
            $result['column'] = $cnum + 1;
            $result['suggestions'] = $this->suggestions($lword);
            $result['context'] = $line;
            $results[] = $result;
          }
        }
      }
      fclose($handle);
    }
    return $results;
  }

  /**
   * Returns an array of suggested words. Assumes word is already in lowercase.
   */
  private function suggestions($lword) {
    $m = metaphone($lword);
    if (array_key_exists($m, $this->by_metaphone)) {
      return $this->by_metaphone[$m];
    }
    //next, maybe could scan for closest words and metaphones
    //using levenshtein() php built-in function
    return array();
  }
}
?>