# RefereeFootballSystem

RefereeFootballSystem to prosty system obsługi meczów piłki nożnej dla sędziów.

Technologie wykorzystane w projekcie: PHP, framework Symfony 4, MySQL.

## Funkcjonalność administrator

### Dodawanie użytkownika 

Administrator może dodawać nowego użytkownika (sędziego), podając jego podstawowe dane. Loginem jest adres e-mail a hasłem pierwsza litera imienia oraz nazwisko.

### Logowanie

Zarejstrowany wcześniej użytkownik przez administratora ma możliwość zalogowania się poprzez podanie maila oraz hasła.

### Dodawanie/edytowanie klubu

Administrator ma możliwość dodawania klubu podając wszystkie potrzebne dane. Z listy klubów można wybrać klub, który chcemy edytować.

### Dodawanie/edytowanie meczu

Administrator ma możliwość dodawania meczu, w którym musi wybrać drużynę gospodarzy oraz gości z dodanych wcześniej klubów a także sędziego ze wszystkich istniejących w bazie.

## Funkcjonalność użytkownik

### Wyświetlenie i edytowanie profilu

Użytkownik może wyświetlić profil a także edytować wszystkie podstawowe dane.

### Mecze

Sędzia może wyświetlić listę meczów, na które został obsadzony jako sędzia. Sędzia z każdego meczu uzupełnia raport meczowy gdzie informuje ile było żółtych oraz czerwonych kartek a także jaki był wynik spotkania do przerwy oraz końcowy.

### Statystyki

Na podstawie wygenerowanych raportów sędzia może zobaczyć swoje statystyki z meczów, na które został obsadzony.


