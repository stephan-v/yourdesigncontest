<?php

namespace App\Services;

class WordPress
{
    /**
     * The WordPress API endpoint.
     *
     * @var string $url
     */
    private $url;

    /**
     * Initialize a new Wordpress service class.
     *
     * @param string $url The WordPress API endpoint.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Fetch a single WordPress post.
     *
     * @param int $id
     * @return mixed
     */
    public function post(int $id)
    {
        $url = $this->url . 'posts/' . $id . '?_embed';

        return $this->toJson($url);
    }

    /**
     * Fetch all WordPress posts.
     *
     * @return mixed
     */
    public function posts()
    {
        $url = $this->url . 'posts?_embed';

        return $this->toJson($url);
    }

    /**
     * Fetch all WordPress categories.
     */
    public function categories()
    {
        $url = $this->url . 'categories';

        return $this->toJson($url);
    }

    /**
     * Fetch the content of the url and format it to JSON.
     *
     * @param string $url The url to retrieve for.
     * @return mixed
     */
    private function toJson(string $url)
    {
        $response = file_get_contents($url);

        return json_decode($response);
    }
}
