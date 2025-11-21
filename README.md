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

## How To Run (local only)

- Make sure you have installed the following sofware:
    - Git
    - Nodejs
    - Composer (make sure PHP is added to the PATH variable)
    - Optional:
        - A webserver (like XAMPP or Laragon)

- Clone the repo

- Execute the following commands in the project root folder (using Git-Bash, or another terminal)

  `cp .example.env .env`
  
  `composer install`
  
  `php artisan key:generate`
  
  `php artisan config:cache`

  `npm install`

  `npm run prod`

- Do either one of the following:
    - Run the site with artisan serve:

        - Execute the following command in the project root folder to deploy the site
    
            `php artisan serve`
    
        - Then open http://127.0.0.1:8000 in your browser. (Note: if port 8000 is already in use, try `php artisan serve --port=8080` and open http://127.0.0.1:8080 in your browser instead.)

    - Run the site through your local Webserver (XAMPP/Laragon)
       
        - Open http://localhost/por-planner (XAMPP) or http://por-planner.test (Laragon) in your browser.,
