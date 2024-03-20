# Laravel JWT Starter

[![License](https://img.shields.io/badge/license-GNU-blue.svg)](LICENSE)

## Overview

I was wondering if theres a starter with Roles, Permissions, Logs, DTO, Services, OTP with JWT pattern?   
And here it is, a minimal setup with only just few dependencies.

- [firebase/php-jwt](https://github.com/firebase/php-jwt) - for authentication
- [phpseclib/phpseclib](https://github.com/phpseclib/phpseclib) - for generating RSA256 public/private key
- [pragmarx/google2fa](https://github.com/antonioribeiro/google2fa) - for otp verification
- [ramsey/uuid](https://github.com/ramsey/uuid) - for UUID generation used as slug

Authentication flow login using phone number get the otp and verify account using otp, no more password, but user table still have password we can use later if needed.

#### Note: This starter is intended only for api development purposes, leverage the power of self contained mechanism of jwt for microservices, but feel free to modify.

## Folder structure
Here are the new folders and usages   
<br/>
Docker
- mysql - for database persisting data when container is down
- php - the php env the app is using feel free to change depending on your situation
- src - the entire laravel application   

Use the Docker for Development/Production

#### Note: If you need to add another service to be used just edit ```docker-compose.yml```

App
- Dto - Used to transfer data from controller to services trait
- Enums - Store here the const variables helpers mostly for responses (feel free to change or add)
- Services - Stores all services traits holds the logic
- Libs - Holds the wrapper for thirdparty packages currently used by JWT and Seclib

## Installation

Use docker, the project is inside ```src``` folder just follow command below to run.

```bash
cd <project_root>
# start build
docker-composer build
# install vendor packages
docker-composer run composer composer install
# start running
# open in the browser http://localhost
docker-composer up -d

# run test
docker-composer run php php artisan test
```

## Pre-routes
- users
- roles
- permissions
- logs
- companies

Added route for api ping status ```/healthcheck```

## Contributors

Thank you to all the contributors who have helped improve this project!

- [Rey Mark Engada](https://github.com/fgunz07)

This starter is in early stage, you might find some things that can be improve, feel free to fork and create a pull request.
