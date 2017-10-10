#!/usr/bin/env php
<?php

require_once 'dictionary.php';

$dictionary_filename = $argv[1];
$doc_filename = $argv[2];

$d = new Dictionary($dictionary_filename);
echo json_encode($d->check($doc_filename), JSON_PRETTY_PRINT);

?>