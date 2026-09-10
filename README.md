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
