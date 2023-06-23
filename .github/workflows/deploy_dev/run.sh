#!/bin/bash

function frontend_build() 
{
    echo "Building the frontend"

    cd ./frontend
    npm install
    npm run build

    echo "Done"
}

function frontend_copy()
{
    echo "Copy frontend to backend"

    rm -rf ./backend/public/css
    rm -rf ./backend/public/js
    rm -f ./backend/public/favicon.ico

    ls ./frontend
    ls ./frontend/build
    ls ./frontend/build/static

    cp -R ./frontend/build/static/css ./backend/public/css
    cp -R ./frontend/build/static/js ./backend/public/js
    cp ./frontend/build/favicon.ico ./backend/public/favicon.ico
    cp ./frontend/build/manifest.json ./backend/public/manifest.json
    cp ./frontend/build/logo192.png ./backend/public/logo192.png
    cp ./frontend/build/logo512.png ./backend/public/logo512.png

    echo "Done"
}

function frontend_integrate()
{
    echo "Integrate frontend and backend"

    JS_FILE=$(ls -1 ./backend/public/js | grep "main" | grep ".js" | grep -v ".js.")
    CSS_FILE=$(ls -1 ./backend/public/css | grep "main" | grep ".css" | grep -v ".css.")

    TEMPLATE_FILE=$(pwd)/backend/resources/views/welcome.blade.php
    python3 $(pwd)/.github/workflows/deploy_dev/replace.py $TEMPLATE_FILE "<--js-resource-->" "{{ asset('js/${JS_FILE}') }}"
    python3 $(pwd)/.github/workflows/deploy_dev/replace.py $TEMPLATE_FILE "<--css-resource-->" "{{ asset('css/${CSS_FILE}') }}"

    echo "Done"
}

function backend_build() 
{
    echo "Building the backend"

    cd ./backend
    composer install

    echo "Done"
}

backend_build

frontend_build
frontend_copy
frontend_integrate