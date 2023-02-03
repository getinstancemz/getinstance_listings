<?php

/* listing 008.03 */
namespace getinstance\utils\apitools;

use Unsplash\HttpClient;
use Unsplash\Photo;

class UnsplashWriter
{
    private Photo $photo;

    public function __construct(string $photoid, string $access, string $appname)
    {
        HttpClient::init([
            'applicationId' => $access,
            'utmSource' => $appname
        ]);
        $photo = $this->switchPhoto($photoid);
    }
/* /listing 008.03 */


        //$imageid = "HsTnjCVQ798";
/* listing 008.04 */
    public function switchPhoto(string $imageid): Photo
    {
        $this->photo = Photo::find($imageid);
        return $this->photo;
    }
/* /listing 008.04 */

/* listing 008.05 */
    public function getSizedUrl(int $width): string
    {
        $urlparts = $this->getUrlParts();
        $quarr = $urlparts['query_array'];
        $quarr['w'] = $width;
        $ret = "{$urlparts['scheme']}://{$urlparts['host']}{$urlparts['path']}?" . http_build_query($quarr);
        return $ret;
    }

    public function getUrlParts(): array
    {
        $url =  $this->photo->urls['regular'];
        $urlparts = parse_url($url);
        parse_str($urlparts['query'], $qs);
        $urlparts['query_array'] = $qs;
        return $urlparts;
    }
/* /listing 008.05 */

/* listing 008.07 */
    public function getAttrib()
    {
        $username =  $this->photo->user['username'];
        $name =  $this->photo->user['name'];
        $ret  = "*Photo by <a href=\"https://unsplash.com/@{$username}?utm_source=unsplash&";
        $ret .= "utm_medium=referral&utm_content=creditCopyText\">{$name}</a> on ";
        $ret .= "<a href=\"https://unsplash.com/?utm_source=unsplash&utm_medium=referral&";
        $ret .= "utm_content=creditCopyText\">Unsplash</a>*";
        return $ret;
    }

    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    public function getDescription(): string
    {
        return $this->photo->description ?? $this->photo->id;
    }
/* /listing 008.07 */

/* listing 008.06 */
    public function writeImage(string $dir, int $width, string $sizename): string
    {
        // get remote url for image
        $url = $this->getSizedUrl($width, $sizename);

        // create directory
        $date = new \DateTime("now");
        $year = $date->format("Y");
        $dir = "{$dir}/wp-content/uploads/{$year}";
        if (! file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        // work out paths and names
        $id = $this->photo->id;

        $urlparts = $this->getUrlParts();
        $ext = $urlparts['query_array']['fm'];

        $filename = "{$id}-x-{$sizename}.{$ext}";
        $urlpath = "/wp-content/uploads/{$year}";
        $newurl = "{$urlpath}/{$filename}";

        // get and write data
        $contents = file_get_contents($url);
        file_put_contents("{$dir}/{$filename}", $contents);
        return $newurl;
    }
/* /listing 008.06 */
/* listing 008.03 */
}
/* /listing 008.03 */
