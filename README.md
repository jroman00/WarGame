# jroman00/war-game

## Build

To build the image:

```bash
docker-compose build
```

## Run

To run the web server:

```bash
docker-compose up -d war-game
```

## In Action

To see it in action, point your browser to https://localhost:8080

## Cleanup

To stop and remove the container, run:

```bash
docker-compose down
```

## Debug

To connect to a running instance:

```bash
docker-run run --rm war-game bash
```
