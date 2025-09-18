My name is Kristian Lalov and this is the implementation of the test project for my interview @Blue Window Ltd. 

Technologies used:
- vanilla PHP
- sql
- html
- css
- docker

In order to run the project you have to have 2 things downloaded. 
- Docker => https://www.docker.com/products/docker-desktop/
- Cloudflared => https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/downloads/

In order to check if they were installed you can run the following commands in the terminal:
- Docker: docker -v
- Clodflared: cloudflared -v

To run the application first start up docker. When docker is runnig you have to do the following steps:
- Open 2 tabs in the terminal and go inside of the project folder in both of them
- In the first terminal run the following command => docker compose up --build. This will start the application on port 8080 and the database on port 8081
- In the second terminal run the following command => cloudflared tunnel --url http://localhost:8080 . This will open a tunnel to the application on port 8080 and make the CF-IPCountry HTTP header available to use for us.
- In the second terminal you will see something like this =>
 +--------------------------------------------------------------------------------------------+
 Your quick Tunnel has been created! Visit it at (it may take some time to be reachable):  |
 https://simpson-stations-sofa-bookmarks.trycloudflare.com                                 |
 +--------------------------------------------------------------------------------------------+

You can visit and use the application when copy-pasting the link from above in your browser. In this case "https://simpson-stations-sofa-bookmarks.trycloudflare.com"
