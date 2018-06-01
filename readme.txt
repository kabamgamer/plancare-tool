PlanCare implementation tool to add and configure PlanCare services
*****************************

# Get the tool running on your PC
$ docker pull alankhaar/plancare-tool
$ docker images
$ docker run --name plancare-implementationtool -p 8000:80 <image id>

# Add your own .env file to the container
At first, create a .env file. You can download a .env.example from https://lankhaardesign.nl/downloads/.env.example but you need a username and password for this. To get this, ask the owner of the domain. If you have this file, save it with the name of .env and edit all the rules as you would like. After this, run your commandline in the directory where you stored your .env and run the following command:

$ docker cp ./.env plancare-implementationtool:/var/www/html.env

Now go to localhost:8000 and see the app running.