# jroman00/WarGame

To build the image, run:

```bash
docker image build -t war-game:latest .
```

To run the container, run:

```bash
docker container run --publish 8000:8080 --detach --name war-game war-game:latest
```

To see it in action, hit https://localhost:8000

To stop and remove the container, run:

```bash
docker stop $(docker ps -aqf "name=war-game"); docker rm $(docker ps -aqf "name=war-game")
```
