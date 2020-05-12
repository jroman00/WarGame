.DEFAULT_GOAL := help

init:
	bash ./bin/local-init.sh

lint:
	docker-compose run --rm war-game composer run lint

lint-fix:
	docker-compose run --rm war-game composer run lint-fix

log:
	docker-compose logs -f war-game

run:
	docker-compose run --rm war-game $(cmd)

shell:
	docker-compose run --rm war-game bash

start:
	docker-compose up -d

stop:
	docker-compose stop

#############################################################
# Help Documentation
#############################################################

help:
	@echo "  War Game Application Commands"
	@echo "  |"
	@echo "  |_ help (default)        - Show this message"
	@echo "  |_ init                  - Initialize the local env, install dependencies, and build all containers"
	@echo "  |_ lint                  - Run lint checks"
	@echo "  |_ lint-fix              - Run lint checks and fix issues"
	@echo "  |_ log                   - Tail container logs"
	@echo "  |_ run                   - Run an arbitrary command in the web container. Ex usage: make run cmd=\"your command\""
	@echo "  |_ shell                 - Start a shell session in a new container"
	@echo "  |_ start                 - Start containers and run the application"
	@echo "  |_ stop                  - Stop containers and the application"
	@echo "  |__________________________________________________________________________________________"
	@echo " "

.PHONY:
	init
	lint
	lint-fix
	log
	run
	shell
	start
	stop
