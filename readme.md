
### Nginx configuration

##### nginx.conf

sudo nano /etc/nginx/nginx.conf

###### one of the most important parts to handle (ALL) "wildcard" sub-domains is the period (.) dot in front -> .ads.sempleventures.com

server_name  ***.ads.sempleventures.com*** ads.sempleventures.com;

#### Route 53

You'll need to create two (2) "A" records in Route 53 (AWS) or your own DNS provider.

My example was: ads / A / 15.223.144.20
My example was: *.ads / A / 15.223.144.20

##### Example: stats query to the server

http://hello.ads.sempleventures.com/

##### Example: URL shortener query which redirects to car.com

http://testing.ads.sempleventures.com/car
