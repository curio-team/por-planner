# por-planner
Snelle en handige planner voor POR gesprekken. Genereert een .csv bestand die je in excel kunt openen en opmaken, en vervolgens als .xlsx kunt delen met de studenten.

## Gebruik
Door de volgende gegevens in te vullen, genereert deze app het .csv bestand.

- Startdatum: De datum vanaf wanneer de planning moet beginnen
- Dagen van de week: Welke dagen de POR-gesprekken plaatsvinden, te vinden op je rooster
- Tijden per dag: Zodra een dag is geselecteerd, verschijnt er voor die dag een tijdselectie waar je de tijden op kunt geven wanneer het POR blok begint en eindigt.
- Lengte gesprekken: Hier vul je in hoe lang elk gesprek zou moeten duren.
- Student / Studentenlijst: Hier vul je de namen in van alle studenten die je in de planning wilt opnemen.
    - Let op: De studenten worden op volgorde van deze lijst ingepland. Als je de volgorde wilt wijzigen, kun je de student in de lijst selecteren, en de knoppen met pijlen onder de lijst gebruiken om deze te verplaatsen. Je kunt ook de geselecteerde student verwijderen uit de lijst met de verwijderen knop.
    - Tip: Door namen te scheiden met een puntkomma zonder spaties (;) kun je meerdere namen tegelijk toevoegen (bijv. Jan Janssen;Piet Paulisma;Carice van houten;etc). Als je vaak een hele klas wilt inplannen, is het misschien handig ergens een lijstje met namen alvast op te slaan.
- Datum uitzonderen: Hier kun je datums selecteren waar geen planning mag plaatsvinden. De app zal deze datums dan overslaan, en doorgaan naar de eerstvolgende datum waar de planning het wel toelaat.

Klik vervolgens op downloaden, en dan zal de download van het bestand starten. Open het bestand vervolgens in excel, maak de tabel op zoals gewenst, en sla deze dan op als een .xlsx bestand. Daarna kun je hem via teams delen met je klas.

LET OP: Dit programma gaat ervan uit dat het standaard scheidingsteken puntkomma is. Dit is standaard in Windows. Als het standaard teken anders is ingesteld op jouw computer, dan kan het zo zijn dat excel de .csv niet automatisch in een tabel zet zodra deze geopend wordt. Dan moet je zelf nog de stappen zetten om de inhoud om te zetten naar een tabel. (in excel, bovenin het menu "Gegevens", en dan de optie "Tekst naar Colommen". Kies in de opties die volgen voor het scheidingsteken puntkomma).

## Screenshot
![Imgur](https://i.imgur.com/IV7chn5.png)

## Lokaal Draaien

- Zorg ervoor dat je de volgende software hebt geïnstalleerd:
    - Git
    - Nodejs
    - Composer (zorg ervoor dat PHP is toegevoegd aan de PATH variabele)
    - Optioneel:
        - Een webserver (zoals Laragon of Herd)

- Clone de repository

- Voer de volgende commando's uit in de project root folder (met Git-Bash, of een andere terminal)

  `cp .example.env .env`
  
  `composer install`
  
  `php artisan key:generate`
  
  `php artisan config:cache`

  `npm install`

  `npm run prod`

- Doe één van de volgende opties:
    - Draai de site met artisan serve:

        - Voer het volgende commando uit in de project root folder om de site te deployen
    
            `php artisan serve`
    
        - Open vervolgens http://127.0.0.1:8000 in je browser. (Let op: als poort 8000 al in gebruik is, probeer dan `php artisan serve --port=8080` en open http://127.0.0.1:8080 in je browser.)

    - Draai de site via je lokale webserver (Laragon/Herd)
       
        - Open http://por-planner.test in je browser.
