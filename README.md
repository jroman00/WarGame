# jroman00/war-game

## Build

To build the image:

```bash
docker image build -t war-game:latest .
```

## Run

To run the web server:

```bash
docker container run --publish 8000:8080 --detach --name war-game war-game:latest
```

## In Action

To see it in action, point your browser to https://localhost:8000

## Cleanup

To stop and remove the container, run:

```bash
docker stop $(docker ps -aqf "name=war-game"); docker rm $(docker ps -aqf "name=war-game")
```

## Debug

To connect to a running instance:

```bash
docker run -it war-game bash
```
