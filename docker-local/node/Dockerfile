FROM node:14.17.3-alpine


RUN apk upgrade --update-cache --available && \
    apk add openssl ca-certificates && \
    rm -rf /var/cache/apk/*
