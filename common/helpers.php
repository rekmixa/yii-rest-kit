<?php

function env(?string $varName = null, $defaultValue = null, bool $localOnly = false) {
    $varValue = getenv($varName, $localOnly);

    if ($varValue === false) {
        if ($varName === null) {
            $varValue = $_ENV ?? $_SERVER ?? [];

            return $varValue;
        } else {
            $varValue = $_ENV[$varName] ?? $_SERVER[$varName] ?? false;
        }
    }

    if ($varValue === false) {
        return $defaultValue;
    }

    if (is_numeric($varValue)) {
        $varValue = $varValue;

        if (ctype_digit($varValue)) {
            return (int)$varValue;
        }

        return (float)$varValue;
    }

    switch (strtolower($varValue)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
    }
    
    return $varValue;
}
