<?php

declare(strict_types=1);

echo "Введіть текст для запису в файл: ";
$text = trim(fgets(STDIN));


// Функція для запису аргументів з консолі
function writeToLogFile( string $filename, array &$textArray,string $text):void
{

    $textArray[] = $text;

    if (!file_exists($filename)) {
        touch($filename);
    }

    $file = fopen($filename, 'a');

    if ($file) {
        fwrite($file, $text . PHP_EOL);
        fclose($file);

        echo "Текст успішно записаний в файл '$filename'. \n";
    } else {
        echo "Помилка відкриття файлу для запису.\n";
    }
}

$logArray = [];
$filename = 'output.txt';


writeToLogFile($filename, $logArray, $text);


// Функція для виводу останнього записаного аргументу
function readLastLogArgument(string $filename):void
{

    $fileContent = file_get_contents($filename);

    if ($fileContent !== false) {

        $logArray = explode(PHP_EOL, trim($fileContent));

        $lastArgument = end($logArray);

        echo "Останній введений аргумент : $lastArgument\n";
    } else {
        echo "Файл логу '$filename' порожній або не існує.\n";
    }
}

readLastLogArgument('output.txt');