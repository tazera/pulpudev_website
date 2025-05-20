docker rm -f pulpudev
docker rmi pulpudev
docker build -t pulpudev .
docker run -d -p 8080:8080 --name pulpudev pulpudev
