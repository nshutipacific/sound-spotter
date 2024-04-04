# Project Description

This project is a Laravel, Vue.js application that uses the Last.fm API to provide information about artists and albums.
It allows users to search for artists by name and view details about each artist, including a list of albums.
It also allows users to search fro albums by name and view details including artits, release data etc.

Logged in users use only Google Integrated Authenntication and are able to save edit delete a list of albums and artists that are saved from last fm

The application is styled with Tailwind CSS, responsive but optimumly running on large devices.

The project also includes a set of unit tests.


# Tech stacks versions

Laravel: 11.0
PHP: 8.2
Vite: 5.0
Vue: 3.4.21
TailwindCSS: 3.4.1
Vite plugin vue: 5.0.4
FontAwesome Free 6.5.1

# Installation/Run Guide 
# DOCKER USAGE

1. CHECK YOUR .env file and build it based on .env.example
2. FIll in API KEYS MISSING(Google and last FM)
3. A Copy of ENV is also shared

Download Docker Desktop v 4.28.0
Install necessary packages including enabling WSL for windows
Make sure docker is up and running.

1. Clone the repo (master branch)

2. Open project folder 

3. open your terminal (Git bash recommended)

4. RUN Command 

docker compose up --build

5. Compile your packages (local )

npm run dev 

6. Acces the project on 

http://localhost:8000


