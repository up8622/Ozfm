# Ordinacija za fizikalnu medicinu – Dokumentacija implementacije

## Pregled projekta
Ozfm je sistem za upravljanje radom ordinacije za fizikalnu medicinu baziran na Laravel okviru, namenjen za vodjenje termina, pacijenata, terapeuta i usluga. Sistem koristi autentifikaciju zasnovanu na ulogama i podrzava tri tipa korisnika: Administratore, Terapeute i Pacijente.

## Preduslovi
- PHP 8.2 ili noviji
- Composer
- Node.js i npm
- MySQL ili kompatibilna baza podataka

## Instalacija

1. **Klonirajte repozitorijum** ili se pozicionirajte u direktorijum projekta.

2. **Instalacija PHP zavisnosti:**
   composer install

3. **Instalacija Node.js zavisnosti:**
    npm install

4. **Podesavanje okruzenja:**
- Kopiraj .env.example u .env fail
- Generisi aplikacioni kljuc:
    php artisan key:generate
- Podesi parametre za pristup bazi u .env failu

5. **Podesavanje baze podataka:**
    php artisan migrate

6. **Build statickih resursa:**
    npm run build



### Development
    composer run dev

### Production
    php artisan serve
    npm run build