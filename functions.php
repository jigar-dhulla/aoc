<?php

function get_input($file): array {
    if (!file_exists($file)) {
        throw new Exception("File not found: $file");
    }
    return explode("\n", trim(file_get_contents($file)));
}
