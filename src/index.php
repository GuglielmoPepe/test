<?php 

declare(strict_types = 1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

setlocale(LC_ALL, 'it_IT.UTF-8');

$root = realpath(dirname(__FILE__));

define('ROOT_PATH', $root);
$_ENV['ROOT_PATH'] = $root;
$_SERVER['ROOT_PATH'] = $root;
putenv("ROOT_PATH=$root");


// phpinfo();

/*
$pdo = new PDO("mysql:host=localhost;dbname=piva", 'root', 'Demo123');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$unbufferedResult = $pdo->query("SELECT subject, body FROM ps_wysija_email WHERE subject NOT LIKE '%Novità dal blog%' ");
foreach ($unbufferedResult as $row) {
    echo $row['subject'] . '<br />';
    // Write the contents back to the file
    file_put_contents(ROOT_PATH . '/mailpoet/' . str_replace(' ', '-', $row['subject']) . '.html', $row['body']);
}
*/

// exit();


$sites = [];

foreach (new DirectoryIterator('/etc/apache2/sites-enabled') as $fileInfo)
{
    if ($fileInfo->isDot())
    {
        continue;   
    }

    $sites[] = trim($fileInfo->getFilename(), '.conf');
}



$dirs = [];

foreach (new DirectoryIterator('.') as $fileInfo)
{
    if ($fileInfo->isDot())
    {
        continue;
    }
    
    if ($fileInfo->isDir())
    {
        $dirs[] = $fileInfo->getFilename();
    }
}

sort($dirs);

echo '<ul>';

foreach ($dirs as $value)
{
    $href = in_array($value, $sites) ? 'https://localhost.' . $value : $value;

    echo '<li><a href="' . $href . '">' . $value . '</a></li>';
}


echo '</ul>';










