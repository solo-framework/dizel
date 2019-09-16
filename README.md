# Dizel: PHP framework for web and CLI

## Установка и запуск

Для запуска тестов и разработки требуется php7

### Сборка docker-контейнера с php7

Можно использовать этот образ:
https://github.com/solo-framework/docker-php7

Если используете PhpStorm, то настроить интерпретатор php, указав собранный контейнер:

![Alt text](interpreter.png?raw=true "Title")

Для выполнения команд в контейнере, нужно использовать скрипт *./run-in-container.sh*


### Установка пакетов Composer
```
./run-in-container.sh 'cd /app && composer install'
```

### Запуск сервера для разработки
```
./run-web-server.sh
```

### Получение IP адреса web-сервера
```
./get-container-ip.sh
```
Запуск этого скрипта выведет что-то похожеее на http://172.17.0.2:9191,
этот адрес нужно открыть в браузере.

### Запуск консольных задач

```
./run-in-container.sh 'cd /app && php cli.php'
```


