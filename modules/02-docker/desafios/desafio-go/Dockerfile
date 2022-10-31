FROM golang:1.17.6-alpine AS builder

WORKDIR /app

COPY . .

RUN go build -o hello

FROM scratch

WORKDIR /app

COPY --from=builder /app/hello /app/hello

ENTRYPOINT [ "/app/hello" ]