# specify the node base image with your desired version node:<version> //
FROM node:8
WORKDIR /home
EXPOSE 3000
RUN npm install
CMD ["tail", "-f", "/dev/null"]



