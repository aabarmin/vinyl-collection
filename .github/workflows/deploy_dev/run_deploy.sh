#!/bin/bash

home_dir=$(pwd)

function database_migrate()
{
    echo "Running migrations"

    cd $home_dir
    SECRET=$(cat ./storage/app/secret_file.txt)

    curl -X GET \
        --header "Authorization: Secret ${SECRET}" \
        --header "Accept: application/json" \
        ${REMOTE_BASE_URL}/api/admin/migrate

    curl -X DELETE \
        --header "Authorization: Secret ${SECRET}" \
        --header "Accept: application/json" \
        ${REMOTE_BASE_URL}/api/admin/cleanup

    echo "Done"
}

database_migrate