## CMDs

- docker build -t apache-server-php .
- docker run -d -p 8081:80 apache-server-php

## To stop and remove the Docker container running your PHP project, you can use the following commands:

- docker ps

# Using the container ID:
- docker stop <container_id>
- docker rm <container_id>

# Using the container name:
- docker stop <container_name>
- docker rm <container_name>

# Additionally, if you want to remove the Docker image that was built
- docker image rm my-php-app

## Same port already in use issue e.g. 8080: bind: address already in use.

- sudo lsof -i :8080

This command will display the process ID (PID) of the process using the port. Once you have the PID, you can terminate the process using the kill command:

- sudo kill <PID>

Or using different port
- docker run -d -p 8081:80 apache-server-php

# Rebuild .php file (if file newly changes)
- docker build -t my-php-app .
- docker stop <container_id>
- docker rm <container_id>
- docker run -d -p 8080:80 my-php-app

# Running server URL
- http://localhost:8080
or 
- http://localhost:8081




