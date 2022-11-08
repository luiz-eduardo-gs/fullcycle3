* `cd node`
* `docker run --rm -it -v $(pwd)/:/usr/src/app -p 3000:3000 node:15 bash`
* `docker build -t gsluizeduardo/node . -f node/Dockerfile`
* `docker run --rm -p 3000:3000 gsluizeduardo/node`