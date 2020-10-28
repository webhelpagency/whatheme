# WHATHEME

[![Web Help Agency](https://webhelpagency.com/imagens/WHA_logo.svg)](https://webhelpagency.com/)

WHATHEME is a WordPress starter theme with bootstrap 4 + sass + browsersync.

### Installation

Dillinger requires [Node.js](https://nodejs.org/) v4+ to run.

Install the dependencies and devDependencies and start the server.

```sh
$ cd whatheme
$ npm install
$ gulp default
```

For production environments...

```sh
$ gulp build
```

Edit gulpfile.js

Replace 

```sh
42    proxy: '192.168.64.2/wordpress', // Change this value to match your local URL.
43    socket: {
44      domain: 'localhost:3000'
45    }
```
With real data
