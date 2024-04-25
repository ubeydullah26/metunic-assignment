<?php
// implement cacheContents function accoding to assignment
function cacheContents(array $callLogs):array
{

    $cache = [];
    $priority = [];
    foreach ($callLogs as $log) {
        $time = $log[0];
        $item = $log[1];
        if (!isset($priority[$item])) {
            $priority[$item] = 0;
        }
        $priority[$item] += 2;
        if ($priority[$item] > 5 && !in_array($item, $cache)) {
            $cache[] = $item;
        }
        foreach ($cache as $key => $cachedItem) {
            $priority[$cachedItem]--;
            if ($priority[$cachedItem] <= 3) {
                unset($cache[$key]);
            }
        }
    }
    sort($cache);
    return $cache;
}

$outputPath = getenv("OUTPUT_PATH") && getenv("OUTPUT_PATH") !=='' ? getenv("OUTPUT_PATH") : "output.txt";
$fptr = fopen($outputPath, "w");

$callLogs_rows = intval(trim(fgets(STDIN)));
$callLogs_columns = intval(trim(fgets(STDIN)));

$callLogs = array();

for ($i = 0; $i < $callLogs_rows; $i++) {
    $callLogs_temp = rtrim(fgets(STDIN));

    $callLogs[] = array_map('intval', preg_split('/ /', $callLogs_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = cacheContents($callLogs);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
