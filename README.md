# Number-Decoder


## Description

A very simple tool to "decode" numbers. For example: 

  * OUI from a MAC address
  * OS error codes
  * 74-series logic parts

## Internals

It uses a very simple plugin-system to adapt for multiple codes.


## Installation

Go into your WEBROOT directory.

Extract the zip-file into `numberdecoder` or clone the repository
```
$ git clone https://github.com/rstephan/numberdecoder.git
```

Create a configuration ...
```
$ cd numberdecoder
$ cp config.example.inc.php config.inc.php
```

... and configure your plugins.
```
$ editor config.inc.php
```

## Examples

### mac_oui

```
$ wget -O manuf "https://code.wireshark.org/review/gitweb?p=wireshark.git;a=blob_plain;f=manuf;hb=HEAD"
```

## License

GNU Public License V2 (GPLv2)

