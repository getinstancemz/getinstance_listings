<?php

namespace getinstance\utils\apitools;

/* listing 008.12 */
class UnsplashWriterCurl
{
    private object $photo;
    private string $host = "https://api.unsplash.com";

    // ...

/* /listing 008.12 */
    private string $appname;
    private string $access;

    public function __construct(string $photoid, string $access, string $appname)
    {
        $this->access = $access;
        $this->appname = $appname;
        $this->photo = $this->switchPhoto($photoid);
    }

/* listing 008.12 */
    public function get($endpoint, array $args = []): string
    {
        $url = $this->host . $endpoint;

        if (count($args)) {
            $qs = http_build_query($args);
            $url .= "?{$qs}";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
           "Accept: application/json",
           "Accept-Version: v1",
           "Authorization: Client-ID {$this->access}",
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] != 200) {
            throw new \Exception("GET error for: $url: $output");
        }
        curl_close($ch);

        return json_decode($output);
    }

    public function switchPhoto(string $imageid): object
    {
        $this->photo = $this->get("/photos/{$imageid}");
        return $this->photo;
    }

// ...

/* /listing 008.12 */
    public function getPhoto(): object
    {
        return $this->photo;
    }

    public function getDescription(): string
    {
        return $this->photo->description ?? $this->photo->id;
    }


    public function getUrlParts(): array
    {
        $url =  $this->photo->urls->regular;
        $urlparts = parse_url($url);
        parse_str($urlparts['query'], $qs);
        $urlparts['query_array'] = $qs;
        return $urlparts;
    }

    public function getSizedUrl($width, $sizename): string
    {
        $urlparts = $this->getUrlParts();
        $quarr = $urlparts['query_array'];
        $quarr['w'] = $width;
        $ret = "{$urlparts['scheme']}://{$urlparts['host']}{$urlparts['path']}?" . http_build_query($quarr);
        return $ret;
    }

    public function getAttrib(): string
    {
        $username =  $this->photo->user->username;
        $name =  $this->photo->user->name;
        $ret  = "*Photo by <a href=\"https://unsplash.com/@{$username}?utm_source=unsplash&";
        $ret .= "utm_medium=referral&utm_content=creditCopyText\">{$name}</a> on ";
        $ret .= "<a href=\"https://unsplash.com/?utm_source=unsplash&utm_medium=referral&";
        $ret .= "utm_content=creditCopyText\">Unsplash</a>*";
        return $ret;
    }

    public function writeImage($dir, $width, $sizename): string
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
/* listing 008.12 */
}
/* /listing 008.12 */
