<?php

namespace getinstance\lazy\medium;

/* listing 011.01 */
class HelloMe
{
    private $intToken;
    private $baseUrl = 'https://api.medium.com/v1/';

    public function __construct($intToken)
    {
        $this->intToken = $intToken;
    }

    public function getMe(): \stdClass
    {
        $url = $this->baseUrl . 'me';
        $headers = array(
            'Authorization: Bearer ' . $this->intToken,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] != 200) {
            throw new \Exception("GET error for: $url: $response");
        }
        curl_close($ch);

        return json_decode($response);
    }
/* /listing 011.01 */

/* listing 011.04 */
    public function addArticle(string $title, string $content): \stdClass
    {
        $endpoint = 'users/' . $this->getMe()->data->id . '/posts';
        $url = $this->baseUrl . $endpoint;
        $data = [
            'title' => $title,
            'contentFormat' => 'markdown',
            'content' => $content,
            'publishStatus' => 'draft'
        ];

        $ch = curl_init();
        $headers = array(
            'Authorization: Bearer ' . $this->intToken,
            'Content-Type: application/json'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] != 201) {
            throw new \Exception("POST error for: $url: $response");
        }

        return json_decode($response);
    }
/* /listing 011.04 */
/* listing 011.01 */
}
