# Project Description

This project is a Laravel, Vue.js application that uses the Last.fm API to provide information about artists and albums. It allows users to search for artists by name and view details about each artist, including a list of albums. The application is styled with Tailwind CSS for a modern and responsive user interface.

The application's architecture follows best practices for Vue.js development, with components organized in a modular and reusable way. It also includes error handling for the API requests to ensure a smooth user experience.

The project also includes a set of unit tests to verify the functionality of the components and the API integration. These tests use the Jest testing framework and Vue Test Utils.

This project is a great example of a modern web application built with Vue.js and Tailwind CSS, and it can serve as a reference or starting point for similar projects.

# Tech stacks versions

Laravel: 11.0
PHP: 8.2
Vite: 5.0
Vue: 3.4.21
TailwindCSS: 3.4.1
Vite plugin vue: 5.0.4

# Installation/Run Guide

Sure, here are the steps in a copy-friendly format:

1. Clone the repository:
2. Navigate to the project directory:
3. Install PHP dependencies:

   composer install

4. Install JavaScript dependencies:

   npm install

5. Compile assets:

   npm run dev

6. Set up environment variables:

   Then, open the `.env` file and set your application's environment variables.

   Google Authentication and Last fm Keys 
   are also set on env file.

   # Example
    GOOGLE_CLIENT_ID=YOUR KEY
    GOOGLE_CLIENT_SECRET=YOUR KEY
    GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/login/google/callback

    LAST_FM_API_URL=http://ws.audioscrobbler.com/2.0/
    LAST_FM_API_KEY=YOUR KEY

7. Run migrations:

    php artisan migrate

8. Start the server:

   php artisan serve

10. to run tests

    php artisan test
 
