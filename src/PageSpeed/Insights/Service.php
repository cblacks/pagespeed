<?php

namespace PageSpeed\Insights;

use PageSpeed\Insights\Exception\InvalidArgumentException;
use PageSpeed\Insights\Exception\RuntimeException;
use GuzzleHttp\Client;

class Service
{
	/**
	 * @var string
	 */
	private $gateway = 'https://www.googleapis.com/pagespeedonline/v5/';

	/**
	 * Returns PageSpeed score, page statistics, and PageSpeed formatted results for specified URL
	 *
	 * @param string $url
	 * @param string $locale
	 * @param string $strategy
	 * @param optional array $extraParams
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 * @throws Exception\RuntimeException
	 */
	public function getResults($url, $locale = 'en_US', $strategy = 'desktop')
	{
		if (0 === preg_match('#http(s)?://.*#i', $url)) {
			throw new InvalidArgumentException('Invalid URL');
		}

		$client = new Client([
            'base_uri' => $this->gateway
        ]);


		try {
		/** @var $request \Guzzle\Http\Message\Request */
		$request = $client->request('GET', 'runPagespeed', [
            'query' => [
                'prettyprint' => false,
                'url' => $url,
                'locale' =>  $locale,
                'strategy' => $strategy
            ]

        ]);

			$response = $request->getBody();
			$response = json_decode($response, true);

			return $response;
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
			$response = $e->getResponse();
			$response = $response->getBody();
			$response = json_decode($response);

			throw new RuntimeException($response->error->message, $response->error->code);
		}
	}
}
