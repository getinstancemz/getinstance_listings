<?php
/* listing 011.15 */
$token = getToken();
$poster = new MediumPoster($token, $basedir);
$contents = file_get_contents($basedir . "/_posts/2023-02-03-automate-unsplash-with-php-and-api.md");
$poster->addArticle("Automating Unsplash for attribution", $contents);
/* /listing 011.15 */
