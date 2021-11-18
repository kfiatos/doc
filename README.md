###Założenia:


### Uruchamianie aplikacji
1. Klonujemy repozytorium
2. Uruchamiamy aplikację poleceniem `docker compose up` lub `docker-compose up -d`
3. Wchodzimy do kontenera api używając komendy `docker exec -it api bash`
4. Po wejściu do kontenera uruchamiamy komendę `composer install` w celu pobrania zewnętrznych bibliotek
5. Następnie uruchamiamy komendę `php bin/console d:d:c` w celu utworzenia bazy danych `docplanner`
6. Kolejna komenda to `php bin/console d:s:c` w celu utworzenia struktury bazy danych

Aplikacja powinna być dostępna pod adresem `localhost:8081` lub `app.localhost:8081`
