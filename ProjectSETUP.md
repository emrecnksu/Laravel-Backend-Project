TR:

Öncelikle projeyi Github'dan çekebilmek için git komutları kullanacağımızdan dolayı, Git Bash kurulumu yapılır. İşletim sistemine uygun kurulum yapmak için bu linkten ulaşabilirsiniz:
https://git-scm.com/downloads 

Adımlar
1. Bu Depoyu Klonlama
Bu GitHub deposunu yerel bilgisayarınıza klonlayın:

https://github.com/emrecnksu/Laravel-Backend-Project.git


2. Proje Dizinine Girme
Klonlama işlemini yaptıktan sonra yeni komut satırında proje klasörüne girmek için şu komutu yazmanız gerekiyor:

cd Laravel-Backend-Project


3. Laravel ile Proje Oluşturma ve Kurma:
Laravel projesini çalıştırabilmek için ihtiyacınız olan composer kurulumunu şu komutla yapın:

composer install

VEYA;

Laravel yükleyicisini Composer aracılığıyla global olarak yükleyerek yeni Laravel projeleri oluşturabilirsiniz::

composer global require laravel/installer
 
laravel new Laravel-Backend-Project

Bu adımları uyguladıktan sonra dosyanın bulunduğu path'e girmeniz gerekiyor:

- cd Laravel-Backend-Project


4. Gerekli olan dosyaları yapılandırma:
Kurulum tamamlandıktan sonra, proje için yapılandırma ayarlarını içeren ve veri tabanı bağlantıları gibi hassas bilgileri içeren '.env' dosyasını ekleyeceğiz.

Bunun için proje kurulduğunda otomatik olarak gelen '.env.example' dosyasının içerisindeki örnek yapılandırma ayarlarını, .env dosyasına kopyalayacağız.

Bunun için şu komutu kullanın:
cp .env.example .env

Güvenlik açısından yeni bir uygulama anahtarı oluşturmak için şu komutu çalıştırın:
php artisan key:generate

Laravel'de kullanıcıların yüklediği dosyaları depolamak için genellikle storage/app/public dizini kullanılır. 

Ancak bu dosyalara doğrudan URL üzerinden erişilemez. 
Bu nedenle, public/storage dizinine bir sembolik bağlantı oluşturmak ve bu sayede storage/app/public dizinindeki dosyaları, 
web tarayıcıları üzerinden erişilebilir hale getirebilmek için şu komut kullanılır:

php artisan storage:link

Daha sonra 'php artisan migrate:fresh --seed' komutunu çalıştırın.
Bu komut, veri tabanını sıfırlar ve yeni projeyi çalıştırmak için başlangıç durumuna getirir.


5. Docker Kurulumu
Öncelikle, Docker'ın kurulu olduğundan emin olun. Docker Desktop gibi bir araç kullanarak Docker'ı yükleyebilirsiniz. Kurulum için resmi Docker belgelerine başvurabilirsiniz: https://www.docker.com/products/docker-desktop/


6. Dockerfile ve yml dosyalarını oluşturma:
Projenin çalışabilmesi ve docker ile iletişime geçebilmesi için Dockerfile ve docker-compose.yml dosyalarını oluşturmanız ve içeriğini projeye uygun bir şekilde düzenlemeniz gerekiyor.


7. Docker Compose ile Uygulamayı Başlatma
Yüklemiş olduğunuz docker uygulaması üzerinden projenizi başlatabilmeniz için docker üzerinden kurmanız gerekmektedir.

Docker Compose kullanarak uygulamayı başlatmak için aşağıdaki komutu çalıştırın:

- docker-compose up -d


Yukarıdaki adımlardan sonra backend projesinin bağlanacağı frontend projesini kurmak için GitHub üzerinden "Laravel-Backend-Project" isimli projeyi alabilirsiniz.


Kurulum adımları bu projede olduğu gibi Frontend projesinde de ProjectSETUP dosyasında anlatılmıştır.



ENG:

First of all, since we will use git commands to pull the project from Github, Git Bash is installed. You can access this link to install according to the operating system:
https://git-scm.com/downloads

Steps
1. Cloning This Repository
Clone this GitHub repository to your local computer:

https://github.com/emrecnksu/Laravel-Backend-Project.git


2. Entering the Project Directory
After cloning, you need to type the following command to enter the project folder in the new command line:

cd Laravel-Backend-Project


3. Creating and Installing a Project with Laravel:
Install the composer you need to run the Laravel project with the following command:

composer install

OR;

You can create new Laravel projects by installing the Laravel installer globally via Composer:

composer global require laravel/installer
 
laravel Laravel-Backend-Project

After following these steps, you need to enter the path where the file is located:

- cd Laravel-Backend-Project


4. Configuring the required files:
Once the installation is complete, we will add the '.env' file, which contains the configuration settings for the project and contains sensitive information such as database connections.

To do this, we will copy the sample configuration settings in the '.env.example' file, which comes automatically when the project is installed, to the .env file.

To do this, use the command:
cp .env.example .env

For security purposes, run this command to create a new application key:
php artisan key:generate

In Laravel, the storage/app/public directory is usually used to store files uploaded by users.

However, these files cannot be accessed directly via URL.
Therefore, we want to create a symlink to the public/storage directory and thus save the files in the storage/app/public directory.
To make it accessible via web browsers, the following command is used:

php artisan storage:link

Then run 'php artisan migrate:fresh --seed' command.
This command resets the database and initializes it to run the new project.


5. Docker Installation
First, make sure Docker is installed. You can install Docker using a tool like Docker Desktop. You can refer to the official Docker documentation for installation: https://www.docker.com/products/docker-desktop/


6. Creating Dockerfile and yml files:
In order for the project to run and communicate with Docker, you need to create Dockerfile and docker-compose.yml files and edit their contents according to the project.


7. Launching the Application with Docker Compose
In order to start your project via the docker application you have installed, you need to install it via docker.

Run the following command to start the application using Docker Compose:

- docker-compose up -d


After the above steps, you can get the project named "Laravel-Backend-Project" from GitHub to install the frontend project to which the backend project will be connected.


Installation steps are explained in the ProjectSETUP file in the Frontend project as well as in this project.
