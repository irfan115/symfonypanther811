<?php

/*
 * This file is part of the Panther project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);
use Symfony\Component\DomCrawler\Crawler;

require __DIR__.'/panther/vendor/autoload.php'; // Composer's autoloader

$client = \Symfony\Component\Panther\Client::createChromeClient();

$crawler = $client->request('GET', 'https://www.google.com/maps/contrib/103188932634246823105/photos/'); // Yes, this website is 100% in JavaScript

#$link    = $crawler->selectButton('.section-profile-stats-points-line');
#$crawler = $client->click($link);

$client->executeScript("document.querySelector('.section-profile-stats-points-line').click();");
#$crawler2  = $client->executeScript("return document.querySelector('#modal-dialog').innerHTML;");
#$client->refreshCrawler();
$client->wait(50000, 500);
$crawler = $client->refreshCrawler();
// Wait for an element to be rendered


$nodeValues = $crawler->filter('span')->each(function (Crawler $node, $i) {
    return $node->text();
});

$nodeValues2 = $crawler->filter('#modal-dialog span')->each(function (Crawler $node, $i) {
    return $node->text();
});

$h1nodes = $crawler->filter('h1')->each(function (Crawler $node, $i) {
    return $node->text();
});
print_r($nodeValues2);
print_r($nodeValues);
print_r($h1nodes);
$client->quit();
