# toy-spellchecker
Just a simple spellchecker in answer to an online interview question

You can run it like this:

```bash
./toy-spellchecker.php dictionary.txt file-to-check.txt
```

The output is a json string sent to stdout.

## specs
[yours.co interview challenge](https://github.com/yoursco/interview/blob/master/SPELL_CHECK.md)

## notes

dictionary.txt came straight from [yours.co repository](https://github.com/yoursco/interview). Apparently the word "a" is not a word.

I can already think of many ways to do this better.

First version finds spelling suggestions by using the PHP built-in function `metaphone`. The next improvement I was thinking about would use another PHP built-in function `levenshtein` as well.

Another performance improvement would be caching spelling suggestions, since the same unknown word tends to come up more than once.

First version doesn't do anything special about proper nouns.
