[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

_s
===

### Quick Start

Node JS muss auf eurem System verfügbar sein. Das prüft ihr über

```sh
$ node -v
```
Wenn es nicht vorhanden ist, installiert es auf eurem System:
https://nodejs.org/en/

Als nächstes müsst ihr euch gulp global im System installieren und anschließend die über die package.json von mir vordefinierten Pakete installieren lassen. Dafür müsst ihr euch im Theme Verzeichnis befinden.

```sh
$ npm install gulp -g
$ npm install
```

### Gulp

Welche Tasks haben wir definiert?

```sh
gulp --tasks
```

Jeden der gelisteten Tasks haben wir public zur Verfügung und können ihn folgend ausführen:

```sh
gulp <taskname>
# z.B.:
gulp styles
```

In der gulpfile.js findet ihr die Beispiele aus dem Unterricht mit weiteren Kommentaren.

Fragen an:
https://properformaplayground.slack.com/archives/C01FYGLAEJZ