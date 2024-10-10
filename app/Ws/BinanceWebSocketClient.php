<?php

namespace App\Ws;

use React\EventLoop\Loop;
use \Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * Class BinanceWebSocketClient
 *
 * This class manages the WebSocket connection to the Binance WS API to receive real-time updates on the BTC/USDT ticker.
 * It utilizes the Ratchet library for WebSocket communication and the ReactPHP event loop for asynchronous handling.
 */
class BinanceWebSocketClient
{
    protected $loop; // Event loop instance for handling asynchronous events.

    /**
     * Initiates the WebSocket connection process.
     *
     * This method creates a new Connector instance and starts the connection to the WebSocket server.
     */
    public function connect()
    {
        $connector = new Connector($this->loop);
        return $this->connectToWs($connector); // Calls the method to establish the WebSocket connection.
    }

    /**
     * Handles incoming messages from the WebSocket connection.
     *
     * @param string $msg The message received from the WebSocket.
     */
    private function onMessage($msg)
    {
        $data = json_decode($msg);
        dump([
            'price_change'       => abs($data->c), // Absolute price change.
            'percent_change_24h' => $data->P // Percentage change over the last 24 hours.
        ]);
    }

    /**
     * Reconnects to the WebSocket server after disconnection.
     *
     * @param Connector $connector The connector instance used to re-establish the connection.
     */
    private function reconnect($connector)
    {
        Loop::get()->addTimer(1, function () use ($connector) {
            $this->connectToWs($connector); // Attempts to reconnect after a 1-second delay.
        });
    }

    /**
     * Establishes the WebSocket connection to the Binance ticker endpoint.
     *
     * @param Connector $connector The connector instance used for connecting to the WebSocket.
     */
    public function connectToWs($connector)
    {
        $url = "wss://stream.binance.com:9443/ws/BTCUSDT@ticker"; // WebSocket URL for BTC/USDT ticker.

        $connector($url)
            ->then(function (WebSocket $conn) use ($connector) {
                // Set up message and close event handlers for the WebSocket connection.
                $conn->on('message', function (MessageInterface $msg) use ($conn) {
                    $this->onMessage($msg); // Process incoming messages.
                });
                $conn->on('close', function ($code = null, $reason = null) use ($connector) {
                    $this->reconnect($connector); // Attempt to reconnect on close.
                });
            }, function (\Exception $e) {
                dump("Could not connect" . $e->getMessage()); // Log connection errors.
                $this->loop->stop(); // Stop the event loop on connection failure.
            });
    }
}
