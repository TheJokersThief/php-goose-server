# Gaggle
An API server for article extraction using php-goose


## Deploy

```
PROJECT_ID=example-project make publish
```

## Usage

```
curl -X POST -d '{"url": "https://www.attack-gecko.net/2018/06/25/building-a-first-team-mindset/"}' http://localhost:8080/
```

## Run locally

```
make run
```
