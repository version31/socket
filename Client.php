<?php

/*
   |--------------------------------------------------------------------------
   |  Limits the maximum execution time
   |--------------------------------------------------------------------------
   |
   */
set_time_limit(0);

/*
   |--------------------------------------------------------------------------
   | Set variables
   |--------------------------------------------------------------------------
   |
   | Host: 127.0.0.1 is localhost
   | Port : You can select a custom port, for example we use 25003
   | Message: a custom message
   |
   */
$host = "127.0.0.1";
$port = 25003;
$message = "Hello Mr Aghakhani";
echo "Message To server : " . $message;

/*
   |--------------------------------------------------------------------------
   |  Create socket
   |--------------------------------------------------------------------------
   | socket_create ( int $domain , int $type , int $protocol ) : resource
   | domain = AF_INIT: IPv4 Internet based protocols. TCP and UDP are common protocols of this protocol family.
   | type = SOCK_STREAM: Provides sequenced, reliable, full-duplex, connection-based byte streams. An out-of-band data transmission mechanism may be supported. The TCP protocol is based on this socket type.
   | protocol = 0 , you can use tcp, udp or icmp
   |
   */

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or
die("Could not create socket" . PHP_EOL);


/*
   |--------------------------------------------------------------------------
   |  Initiates a connection on the socket
   |--------------------------------------------------------------------------
   | socket_connect ( resource $socket , string $address [, int $port = 0 ] ) : bool
   | address = localhost
   | port = custom port for example 25003
   |
   */
$result = socket_connect($socket, $host, $port) or
die("Could not connect to server" . PHP_EOL);

/*
   |--------------------------------------------------------------------------
   |   Write to the socket
   |--------------------------------------------------------------------------
   | socket_write ( resource $socket , string $buffer [, int $length = 0 ] ) : int
   | buffer =  The buffer to be written.
   | length =  The optional parameter length can specify an alternate length of bytes written to the socket.
   |
   */

socket_write($socket, $message, strlen($message)) or die("Could not send data to server" . PHP_EOL);
/*
   |--------------------------------------------------------------------------
   |   Read the server message
   |--------------------------------------------------------------------------
   | socket_read ( resource $socket , int $length [, int $type = PHP_BINARY_READ ] ) : string
   | length =  The maximum number of bytes read is specified by the length parameter
   |
   */
$result = socket_read($socket, 1024) or
die("Could not read server response" . PHP_EOL);

echo PHP_EOL . "Reply From Server : " . $result;


/*
   |--------------------------------------------------------------------------
   |   Closes the socket resource
   |--------------------------------------------------------------------------
   | socket_close ( resource $socket ) : void
   | socket_close() closes the socket resource given by socket.
   | This function is specific to sockets and cannot be used on any other type of resources.
   |
   */

socket_close($socket);

