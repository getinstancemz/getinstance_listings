<?php

namespace getinstance\lazy\medium;

/* listing 011.07 */
class MediumPoster
{
    private CurlService $service;
    private string $workingdir;

    public function __construct($intToken, $workingdir = "")
    {
        $this->intToken = $intToken;
        $this->workingdir = $workingdir;
        $this->service = new CurlService('https://api.medium.com/v1');
        $this->service->setHeader("Authorization", "Bearer {$intToken}");
    }

    public function getMe(): \stdClass
    {
        return $this->service->get("/me");
    }
/* /listing 011.07 */

/* listing 011.08 */
    // MediumPoster

    public function uploadImage(string $imagePath): ?string
    {
        $endpoint = '/images';
        $url = $this->service->postBin($endpoint, "image", $imagePath);
        return $url->data->url ?? null;
    }
/* /listing 011.08 */

/* listing 011.13 */
    public function parseArticle($content): string
    {
/* listing 011.11 */
        $regexp = '!\[(.*?)\]\s*\((\S+)(?:\s+([\'"])(.*?)\3)?\s*\)';
/* /listing 011.11 */

        // this callback will invoke an upload for local files
        // and replace the local path with the uploaded URL
        $func = function ($a) {
            $alt = $a[1];
            $url = $a[2];

            if (preg_match("/^http[s]{0,1}:/i", $url)) {
                // ignore non-local URLs
                return $a[0];
            }
            $path = $this->workingdir . $url;
            if (! file_exists($path)) {
                error_log("unable to locate local file '$path'");
                return $a[0];
            }

            $title = "";
            if (! empty($a[3]) && ! empty($a[4])) {
                // rebuild title
                $title = " {$a[3]}{$a[4]}{$a[3]}";
            }
            $url = $this->uploadImage($path);
            if (is_null($url)) {
                return $a[0];
            }
            return "![{$alt}]({$url}{$title})";
        };
        return preg_replace_callback("/{$regexp}/", $func, $content);
    }
/* listing 011.07 */
/* /listing 011.13 */

/* listing 011.14 */
    public function addArticle(string $title, string $content): \stdClass
    {
/* /listing 011.07 */
        $content = $this->parseArticle($content);
/* listing 011.07 */
        $endpoint = '/users/' . $this->getMe()->data->id . '/posts';
        $data = [
            'title' => $title,
            'contentFormat' => 'markdown',
            'content' => $content,
            'publishStatus' => 'draft'
        ];
        return $this->service->post($endpoint, $data);
    }
/* /listing 011.14 */
}
