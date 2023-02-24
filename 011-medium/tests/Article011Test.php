<?php

declare(strict_types=1);

namespace getinstance\lazy\medium;

use PHPUnit\Framework\TestCase;
use getinstance\lazy\medium\HelloMe;
use getinstance\lazy\medium\MediumPoster;

final class Article011Test extends TestCase
{
    private function getToken(): string
    {
        /* listing 011.02 */
        $path = __DIR__ . "/../conf/conf.json";
        $conf = json_decode(file_get_contents($path), true);
        $token = $conf['medium']['token'];
        /* /listing 011.02 */
        return $token;
    }

    public function testHelloMe(): void
    {
        $token = $this->getToken();
        /* listing 011.02 */
        /* listing 011.05 */
        $hellome = new HelloMe($token);
        /* /listing 011.05 */
        $me = $hellome->getMe();
        /* /listing 011.02 */

        $this->assertEquals("getinstance_mz", $me->data->username);

        /* listing 011.05 */
        $article = <<<ARTICLE
# Welcome
This is an article

```php
print "with a hello world";
```
## And a sub head

> with a blockquote containing something **bold**.

## Thank you
ARTICLE;
        $resp = $hellome->addArticle("A test article", $article);
        /* /listing 011.05 */
        $this->assertEquals($resp->data->title, "A test article");
    }

    public function testImageRegexp(): void
    {
        $token = $this->getToken();
/* listing 011.10 */
        $img1 = realpath(__DIR__ . "/../res/medium1.png");
        $poster = new MediumPoster($token);
        $url = $poster->uploadImage($img1);
/* /listing 011.10 */
        $this->assertNotNull($url);
    }


    public function testImagesMediumPoster(): void
    {

        $img1 = realpath(__DIR__ . "/../res/medium1.png");
        $img2 = realpath(__DIR__ . "/../res/medium2.png");
        $img3 = realpath(__DIR__ . "/../res/medium3.png");

        $token = $this->getToken();
        $hellome = new MediumPoster($token);
        $article = <<<ARTICLE

# Welcome 3
This is another article

```php
print "with a hello world";
```
## And a sub head

![first]($img1 "the other")
![second]($img2 "if you say")
![third]($img3 "oh right")

## Thank you
ARTICLE;
        $resp = $hellome->addArticle("An imagey article", $article);
        $this->assertEquals($resp->data->title, "An imagey article");
    }

    public function testMediumPoster(): void
    {
        $token = $this->getToken();
        $hellome = new MediumPoster($token);
        $me = $hellome->getMe();
        $this->assertEquals("getinstance_mz", $me->data->username);

        $article = <<<ARTICLE
# Welcome 2
This is another article

```php
print "with a hello world";
```
## And a sub head

> with a blockquote containing something **bold**.

## Thank you
ARTICLE;
        $resp = $hellome->addArticle("A test article2", $article);
        $this->assertEquals($resp->data->title, "A test article2");
    }
}
