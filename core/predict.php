<?php

require_once("query.php");
require_once("model.php");

function predictData($input) {
    [$classProbs, $stats] = listModel();
    [$result, $prediction] = predict($stats, $input, $classProbs);
    return [$result, $prediction];
}
