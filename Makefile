.PHONY: test coverage lint docs clean dev install help export_conf create_pubsub_topic deploy_to_gfunctions

PROJECT_NAME = gaggleApiServer
PROJECT_ID ?= example-project

help: ## Show help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

dev:  ## Install project and dev dependencies
	composer install

install:  ## Install project without dev dependencies
	composer install --no-dev

run:  ## Start the local dev server
	php -S localhost:8080 vendor/bin/router.php

deploy_to_gfunctions:
	gcloud functions deploy ${PROJECT_NAME} \
		--region europe-west1 \
		--project ${PROJECT_ID} \
		--runtime php74 \
		--memory 256MB \
		--entry-point helloHttp \
		--trigger-http \
		--timeout 60s \
		--max-instances 1

publish: deploy_to_gfunctions  ## Publish project to google cloud functions
	@echo "Published"

