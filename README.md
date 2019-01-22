# RefereeFootballSystem

RefereeFootballSystem to prosty system obsługi meczów piłki nożnej dla sędziów.

Technologie wykorzystane w projekcie: PHP, framework Symfony 4, MySQL.

# Funkcjonalność administrator

## Dodawanie użytkownika 

Administrator może dodawać nowego użytkownika (sędziego), podając jego podstawowe dane. Loginem jest adres e-mail a hasłem pierwsza litera imienia oraz nazwisko.

## Logowanie

Zarejstrowany wcześniej użytkownik przez administratora ma możliwość zalogowania się poprzez podanie maila oraz hasła.

## Dodawanie/edytowanie klubu

Administrator ma możliwość dodawania klubu podając wszystkie potrzebne dane. Z listy klubów można wybrać klub, który chcemy edytować.

## Dodawanie/edytowanie meczu

Administrator ma możliwość dodawania meczu, w którym musi wybrać drużynę gospodarzy oraz gości z dodanych wcześniej klubów a także sędziego ze wszystkich istniejących w bazie.

# Funkcjonalność użytkownik

## Wyświetlenie i edytowanie profilu

Użytkownik może wyświetlić profil a także edytować wszystkie podstawowe dane.

## Mecze

Sędzia może wyświetlić listę meczów, na które został obsadzony jako sędzia. Sędzia z każdego meczu uzupełnia raport meczowy gdzie informuje ile było żółtych oraz czerwonych kartek a także jaki był wynik spotkania do przerwy oraz końcowy.

## Statystyki

Na podstawie wygenerowanych raportów sędzia może zobaczyć swoje statystyki z meczów, na które został obsadzony.

# Wymagania

* PHP >= 7.1
* MySQL

# Instalacja

1. Sklonowanie repozytorium przez wydanie polecenia
```
git clone https://github.com/wojtekogieglo/symfony-referee-system.git
```
2. Przejście do katalogu z projektem, zmodyfikowanie pliku .env w celu połączenie z odpowiednią bazą danych
3. Instalacja zależności poprzez wydanie polecenia w katalogu z projektem
```
composer install
```
4. Utworzenie schematu bazy danych
```
php bin/console doctrine:migrations:diff
```
5. Migracja bazy danych 
```
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
6. Uruchomienie serwera poprzez wydanie polecenia
```
php bin/console server:run
```
7. Aplikacja jest dostępna pod [127.0.0.1:8000](http://127.0.0.1:8000). Dane do konta administratora
```
e-mail: admin@gmail.com
password: admin
```

# Zewnętrzne biblioteki

* [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle)
* [CMENGoogleChartsBundle](https://github.com/cmen/CMENGoogleChartsBundle)

# Jak używać?

## Logowanie

Użytkownik loguje się poprzez podanie adresu e-mail oraz hasła. Jeżeli dane są nieprawidłowe wyświetla się komunikat o błędzie.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/login.PNG)

## Dodawanie ligi

Administrator ma możliwość dodania ligi podając jej nazwę. 

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/add_league.png)

Po przejściu walidacji i dodaniu rekordu administrator zostaje przekierowany na stronę z listą lig.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/league_list.PNG)

## Dodawanie klubu

Administrator ma możliwość dodawania klubu podając jego nazwę a następnie wybierając ligę, w której gra. 

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/add_club.PNG)

Administrator zostaje przekierowany na stronę z listą klubów.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/club_list.PNG)

## Dodawanie sędziego

Administrator ma możliwość dodawania sędziego podając wszystkie dane: imię, nazwisko, datę urodzenia, kategorię. Po dodaniu sędziego zostaje utworzone jego konto w systemie. Dane do logowania
```
login: e-mail sędziego
password: pierwsza litera imienia oraz nazwisko
```

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/add_referee.PNG)

Administrator zostaje przekierowany na stronę z listami sędziów

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/referee_list.PNG)

## Dodawanie meczu

Administrator ma możliwość dodawania meczu. Na początku wybiera ligę i następnie ładowane są wszystkie kluby grające w tej lidze, po wybraniu zespołu gospodarzy i gości wybiera sędziego, datę meczu, sezon, runda oraz kolejke. 

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/add_game.PNG)

Po dodaniu meczu administrator zostaje przekierowany na stronę z listami gier.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/game_list.PNG)

## Szczegóły meczu

Użytkownik systemu ma możliwość wyświetlenia wszystkich szczegółowych informacji na temat meczu. 

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/game_details.PNG)

## Raport

Sędzia po meczu może wypełnić raport dotyczący spotkania, w którym podaję wszystkie informacje dotyczące meczu: wynik, żółte kartki, czerwone kartki, karne.

## Informacje o profilu

Sędzia może zobaczyć wszystkie informacje o swoim profilu.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/profile_information.PNG)

## Statystyki

Sędzia może sprawdzić statystki meczowe czyli ilość żółtych kartek, czerwonych kartek, karnych.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/statistics.PNG)

## Zmiana hasła

Użytkownik systemu może zmienić hasło, na początku podaję stare hasło a następnie nowe hasło oraz powtórzone nowe hasło, jeżeli wszystko się zgadza, hasło zostaje zmienione.

![alt text](https://github.com/wojtekogieglo/symfony-referee-system/blob/master/images/change_password.PNG)
