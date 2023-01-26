<?php

class UrlVerifier
{
    protected $strangeParameters = [
        '__hstc',
        '__hsfp',
        'wtime',
        'seek_to_second_number',
        'wordfence_lh',
        'search',
        '_ga'
    ];

    protected $knownSearchEngines = [
        'Googlebot',
        'Bingbot',
        'Slurp',
        'DuckDuckBot',
        'Baiduspider',
        'YandexBot',
        'Sogou',
        'Exabot',
        'facebot',
        'ia_archiver',
    ];

    public function initialize()
    {
        add_action('init', array($this, 'verifyUrl'));
    }

    /**
     * Checks the user agent and dumps urls with malformed parameters in them
     *
     * @return void
     */
    public function verifyUrl()
    {
        // If this is a regular user or no get parameters are present, do nothing
        if(empty($_GET) || is_admin() || !$this->isSearchEngine()) {
            return;
        }

        foreach($_GET as $parameterName => $value) {
            if(in_array($parameterName, $this->strangeParameters, true)) {
                $this->issue404();
                break;
            }
            // sometimes, a broken GET param value will have { and } in it, in this case, 404.
            if(strpos($value, '{') !== false && strpos($value, '}') !== false) {
                $this->issue404();
                break;
            }
        }
    }

    /**
     * Issues a 404 status header and uses the set 404 template
     *
     * @return void
     */
    public function issue404()
    {
        status_header(404);
        nocache_headers();

        global $wp_query;
        $wp_query->set_404();
        $wp_query->posts = [];

        die();
    }

    /**
     * Checks if the UA if the user looks like a search engine to return a 404
     *
     * @return bool
     */
    public function isSearchEngine()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        foreach($this->knownSearchEngines as $searchEngine) {
            if(strpos($userAgent, $searchEngine) !== false) {
                return true;
            }
        }
        return false;
    }
}