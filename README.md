caliper-php
================

caliper-php is a php client for [Caliper](http://www.imsglobal.org) that provides an implementation of the Caliper SensorAPI™.

## Getting Started

### Pre-requisites for development

* PHP 5.4 required (PHP 5.6 recommended)
* Ensure you have php5 and php5-json installed:  ```sudo apt-get install php5 php5-json```
* Install Composer (for dependency management):  ```curl -sS https://getcomposer.org/installer | php```
* Install dependencies:  ```php composer.phar install```
* Run tests using the Makefile

### Installing the Library:

#### Using Composer

Add the following entry to the require element of the composer.json file for your web application:

```
  "require" : {
    "IMSGlobal/Caliper" : "*"
  },
```

In a command-line interface, change directory to the root of your web application and run the following command:

```
composer install
```

Then, add the following to your PHP script:

```
require_once 'vendor/autoload.php';
```

#### Manual installation

To install the library, clone the repository from GitHub into your desired application directory.

```
git clone https://github.com/IMSGlobal/caliper-php.git
```

Then, add the following to your PHP script:

```
require_once '/path/to/caliper-php/autoload.php';
```

### Using the Library

Now you're ready to initialize Caliper and send an event as follows:

```
use \IMSGlobal\Caliper\Sensor;
use \IMSGlobal\Caliper\Options;
use \IMSGlobal\Caliper\Client;

$sensor = new Sensor('id');

$options = (new Options())
    ->setApiKey('org.imsglobal.caliper.php.apikey')
    ->setDebug(true)
    ->setHost('http://example.org/dataStoreURI');

$sensor->registerClient('http', new Client('clientId', $options));

// TODO: Define $event to be sent
$sensor->send($sensor, $event);
```

You only need to create a single instance of a Sensor object which can be then used for sending all messages.

### Running an example

A simple example program can be found in:

  examples/SessionEventSampleApp.php

It will attempt to send an event to a data store listener on localhost:8000.  If you have a data store on some other host or port, you can edit the program to point to it.  If you don't have a data store, you can run a simple listener included in:

```
examples/tools/testListener.sh [optional_port]
```

That will start a simple PHP web server (on port 8000 by default) that listens for POST requests and dumps the raw contents to the terminal.  If you run this in one terminal window and the example program in another terminal window, you will see the request received in the first window.

## Documentation
Documentation is available at [http://www.imsglobal.org/caliper](https://www.imsglobal.org/caliper).

## Credits

A very special thank you to each of the developers that contributed to this project:

* Prashant Nayak, Intellify Learning
* balachandiran.v / Yoganand-htc
* Lance E Sloan (lsloan at umich dot edu), University of Michigan

©2016 IMS Global Learning Consortium, Inc. All Rights Reserved.
Trademark Information - http://www.imsglobal.org/copyright.html

For license information contact, info@imsglobal.org and read the LICENSE file contained in the repository.
