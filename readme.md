# Oversetter - Geir Petter Torgersen

## Beskrivelse

Tradutt er et nettside utviklet for å hjelpe Geir Petter Torfersen med sine kunder, slik kan de logge inn og bestille oversetting av bøker. Applikasjonen gir brukerne muligheten til å legge til bestillinger av oversetting i engelsk, spansk, tysk, fransk og mandarin. Tradutt oppstår fra det italenske ordet traduttore. Det er kommentarer i koden hvis noen skulle ta over prosjektet.

## Funksjoner
- **Legg til bok**: Brukere kan enkelt registrere nye bok oversettting bestillinger ved å fylle ut en enkel form med boktitel og språk.
- **Se henvendelse**: Admin kan se alle henvendelser og brukere i Orders. For å gjøre andre admin må du gå i databasen og skrive:
```sql
UPDATE `users`
SET `role` = 'admin'
WHERE `username` = '(skriv inn brukernavn)';
```


## Teknologier

- PHP for server-side logikk
- MySQL for databaselagring
- HTML/CSS/JavaScript for frontend-design


## Bruk

For å begynne å bruke Tradutt, registrer deg med en e-postadresse og et passord. Etter registreringen kan du logge inn og begynne å legge til bestillinger av oversetting av bøker.


## Database
Alle tabellene ligger inne i table.sql. Dette kan du bare kopiere og paste i databasen. Husk å lage en database med navn "oversetter" først. Hvis du skal ha et annet navn må du endre database navnet i database.php. Hvis du har en annen mariadb bruker enn default root kan du endre det til din preferanse.


## Kontakt

For spørsmål eller tilbakemeldinger, vennligst kontakt phpkuben@gmail.com.
