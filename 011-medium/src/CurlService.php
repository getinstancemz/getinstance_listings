<?php
namespace getinstance\lazy\medium;

/* listing 011.06 */
class CurlService
{
    private string $baseUrl;
    private array $headers = [];

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->setHeader("Content-Type", "application/json");
    }

    public function setHeader($key, $header): void
    {
        $this->headers[$key] = $header;
    }

/* /listing 011.06 */
    public function unsetHeader($key): void
    {
        unset($this->headers[$key]);
    }

/* listing 011.06 */
    public function getHeaders() {
        $ret = [];
        foreach ($this->headers as $key => $header) {
            $ret[] = "{$key}: $header";
        }
        return $ret;
    }

    public function get(string $endpoint, array $args = []): ?\stdClass
    {
        $url = $this->baseUrl . $endpoint;
        if (!empty($args)) {
            $url .= '?' . http_build_query($args);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] != 200) {
            throw new \Exception("GET error for: $url: $response");
        }
        curl_close($ch);

        return json_decode($response);
    }

/* /listing 011.06 */
/* listing 011.09 */
    // CurlService

    public function postBin(string $endpoint, string $fieldname, string $filepath) {
        if (! file_exists($filepath)) {
            throw new \Exception("no file at '{$filepath}'");
        }
        $cfile = new \CURLFile($filepath, mime_content_type($filepath), basename($filepath));
        $data =[ 
            $fieldname => $cfile
        ];
        $this->setHeader("Content-Type", "multipart/form-data");
        $ret = $this->doPost($endpoint, $data); 
        $this->setHeader("Content-Type", "application/json");
        return $ret;
    }
/* /listing 011.09 */

/* listing 011.06 */
    public function post(string $endpoint, array $data) {
        $data = json_encode($data);
        return $this->doPost($endpoint, $data); 
    }

    private function doPost(string $endpoint, array|string $data): ?\stdClass
    {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] != 201) {
            throw new \Exception("POST error for: $url: $response");
        }
        curl_close($ch);

        return json_decode($response);
    }
}
