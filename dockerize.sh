docker rm -f pulpudev
docker rmi pulpudev
docker build -t pulpudev .
docker run -d
-e VIRTUAL_HOST=pulpudev.com
-e LETSENCRYPT_HOST=pulpudev.com
--network net
--name pulpudev
pulpudev
