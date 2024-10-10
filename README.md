# Laravel Binance WebSocket Client

This project provides a simple implementation of a Binance WebSocket client using Laravel. It allows you to connect to the Binance WebSocket API to receive real-time updates on the BTC/USDT ticker.

## Features

- Connects to the Binance WebSocket API
- Retrieves real-time price updates
- Easily integrated into Laravel applications

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.3
- Composer
- Laravel 5.8 or higher

## Installation

Follow these steps to set up the project on your local machine:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/laravel-binance-websocket-client.git
2. **Navigate to the Project Directory**:
   ```bash
   cd laravel-binance-websocket-client
3. **Install Dependencies**:
   ```bash
   composer install
4. **Set Up Your Environment File**:
   ```bash
   cp .env.example .env
5. **Generate the Application Key**:
   ```bash
   php artisan key:generate
6. **Start the Laravel Development Server**:
   ```bash
   php artisan serve

## Usage

Once the project is set up, you can use the Binance WebSocket client by following these steps:

### Step 1: Access the WebSocket Route
 Open your web browser and navigate to the following URL:


### Step 2: Monitor Real-Time Updates

This route will initiate the connection to the Binance WebSocket API. You should see real-time updates for the BTC/USDT ticker in your logs or console.

### Step 3: Customize as Needed

You can customize the WebSocket client and routes in the `app/Ws/BinanceWebSocketClient.php` file as needed to fit your requirements.

## Conclusion

This Laravel Binance WebSocket Client provides a simple and effective way to receive real-time market data from Binance. With easy setup and customization options, you can extend its functionality to fit your specific needs. Whether you're building a trading application or simply monitoring price changes, this client can serve as a solid foundation.

If you have any questions or need further assistance, feel free to reach out or create an issue in the repository. Happy coding!
