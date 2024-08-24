#!/bin/bash

# Define your environment variables
APP_NAME="YourAppName"
ZENOPAY_SECRET_KEY="your_zenopay_secret_key"
DB_HOST="external-db-host.com"
DB_USER="your_database_user"
DB_PASS="your_database_password"
DB_NAME="your_database_name"
DB_PORT="3306"

# Path to the .env file
ENV_FILE=".env"

# Create or overwrite the .env file
cat <<EOL > $ENV_FILE
APP_NAME=$APP_NAME
ZENOPAY_SECRET_KEY=$ZENOPAY_SECRET_KEY
DB_HOST=$DB_HOST
DB_USER=$DB_USER
DB_PASS=$DB_PASS
DB_NAME=$DB_NAME
DB_PORT=$DB_PORT
EOL

echo ".env file has been created or updated."
