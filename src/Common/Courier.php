<?php
/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Common;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Sabre\Xml\LibXMLException;
use Sabre\Xml\Reader;

/**
 * Class Courier
 * @package CodeBureau\Pitu\Common
 */
class Courier
{
    private $client;

    /**
     * Courier constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://194.177.238.132:4400/service/',
            'verify' => false
        ]);
    }

    /**
     * @param $message
     * @return array|string
     * @throws GuzzleException
     */
    public function sendMessage($message)
    {
        $response = $this->client->post('', [
            'headers' => [
                'content-type' => 'text/xml',
            ],
            'body' => $message
        ]);

        if (200 === $response->getStatusCode()) {
            try {
                $reader = new Reader();
                $reader->XML($response->getBody()->getContents());
                return $reader->parse();
            } catch (LibXMLException $exception) {
                return $exception->getMessage();
            }
        }
    }
}
