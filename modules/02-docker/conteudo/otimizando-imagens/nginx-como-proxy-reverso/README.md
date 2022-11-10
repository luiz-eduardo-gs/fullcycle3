* `docker network create laranet`
* `docker build -t gsluizeduardo/laravel:prod laravel -f laravel/prod.Dockerfile`
* `docker build -t gsluizeduardo/nginx:prod nginx -f nginx/prod.Dockerfile`
* `docker run -d --network laranet --name laravel gsluizeduardo/laravel:prod`
* `docker run -d --network laranet --name nginx -p 8080:80 gsluizeduardo/nginx:prod`