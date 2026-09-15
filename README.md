## Перед релизом
Отключить debug в .env
Указань корректную БД


## Общие команды

Запустить всё           sail up -d
Остановить всё          sail down
Перезапустить           sail down && sail up -d
Посмотреть логи         sail logs
Зайти в контейнер       sail shell
Выполнить artisan       sail artisan migrate
Установить npm пакеты   sail npm install
Запустить Vite          sail npm run dev


Стар работ работы над проектом
1) запустить докер приложение
2) открыть vsCode и перейти в wsl (через коннект)
3) перейти в директорию проекта
4) запустить докер через ./vendon/bin/sail up -d
5) запустить vite через  ./vendon/bin/sail npm run dev (в отдельном терминале)

Окончание работ
1) останавливаем vite . В терминале вита  CTRL + C
2) в общем терминале с докером ./vendon/bin/sail down
3) закрыть приложение докер
4) выйти с wsl

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).





Инструкция по поднятию проекта на нулевом компьютере (установка окружения)

1) устанавливаем wsl. в консоли пишем wsl --install , происходитс качиваение дистрибутива. После перезагрузить комп. Если в консоли нет wsl (ошибка при вызове), запускаем повторно wsl --install
2) устанавливаем докер (скачиваем дистрибутив). Запускаем и в Settings\ Resourses во вкладке WSL включаем настройку и ставим галочку, наждимаем Apply and restart
3) В vsCode устанавливаем плагин WSL. Далее shift+ctrl+P WSL connect
4) проверяем установился ли докер docker ps . Если видим ошибку прав, то sudo usermod -aG docker $USER  (Вводим пароль при создании ubuntu) , далее перезагрузаем wsl wsl --shutdown   . Перезаходим, проверяем
5) Если в этом процессе сам докер начнет выдавать ошибку, то делаем следующее: заходим в wsl и пишем 
	sudo mkdir -p /run/docker-desktop
	sudo chmod 755 /run/docker-desktop
После чего  wsl --shutdown  и перезаходим
6) wsl    docker ps  - должнно пояявиться список пусток докеров.
7) далее копируем проект через git clone
8) устанавливаем в wsl php и композер
	# Обновляем пакеты и ставим нужный минимум PHP
	sudo apt update
	sudo apt install php-cli php-xml php-mbstring unzip curl -y

	# Скачиваем и устанавливаем Composer глобально
	curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

	# Проверяем, что Composer работает
	composer --version

Если версия php не та, что в проекте (я использовал 8.3), то

		# Устанавливаем утилиту для добавления PPA
		sudo apt install software-properties-common -y

		# Добавляем репозиторий с PHP
		sudo add-apt-repository ppa:ondrej/php -y

		# Обновляем списки пакетов
		sudo apt update

9) устанавливаем все пакеты и зависимости docker run --rm -v $(pwd):/app -w /app composer install --ignore-platform-req=php

10) пробуем поднять докер и запустить проект  ./vendor/bin/sail up -d

11) если все запустилось, но по localhost ошибка vendor/laravel/framework/src/Illuminate/Encryption/EncryptionServiceProvider.php:83 
	генерируем ключ ./vendor/bin/sail artisan key:generate

12) если ошибка БД, то проверяем .env
	DB_CONNECTION=mysql
	DB_HOST=mysql
	DB_PORT=3306
	DB_DATABASE=laravel
	DB_USERNAME=sail
	DB_PASSWORD=password

13) прогоняем все миграции и сиды
	./vendor/bin/sail artisan config:clear
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan db:seed

Если при миграции  Illuminate\Database\QueryException 

  SQLSTATE[HY000] [1045] Access denied for user 'sail'@'172.18.0.5' (using password: YES) (Connection: mysql, Ho

то
	./vendor/bin/sail down
	docker volume rm $(docker volume ls -q | grep mysql)
	docker compose down -v




14) устанавливаем окружение для vite
		# Скачиваем скрипт установки Node.js 20 LTS
		curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -

		# Устанавливаем Node.js (npm идёт в комплекте)
		sudo apt install nodejs -y

		# Проверяем версии
		node -v
		npm -v
	
