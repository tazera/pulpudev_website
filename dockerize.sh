docker rm -f laki
docker rmi laki
docker build -t laki .
docker run -d -p 8080:8080 --name laki laki
