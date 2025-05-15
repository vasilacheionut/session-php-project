# session-php-project

Un proiect simplu în PHP care folosește doar $_SESSION (fără baze de date, fără PDO, doar sesiune) poate fi un mic sistem de autentificare cu înregistrare și login. Toate datele vor fi stocate temporar în sesiune, deci se vor pierde după închiderea browserului sau după logout.

✅ Ce va include proiectul:
```
register.php – formular de înregistrare
login.php – formular de login
logout.php – delogare
dashboard.php – pagină vizibilă doar dacă ești autentificat
users.php – fișier pentru stocarea utilizatorilor în sesiune $_SESSION
index.php – redirecționare

```

Structura fișiere:
```
session-project/
├── index.php
├── register.php
├── login.php
├── logout.php
├── dashboard.php
├── change_password.php
├── activity_log.php
├── users.php
├── auth.php
└── logs.php
```


📝 Observații:
```
Nu este sigur (parolele nu sunt criptate).
Util pentru testare sau concepte simple.
Potrivit pentru începători în PHP care învață $_SESSION.
```

🧪 Testare:
```
Deschide register.php, creează un cont.
Mergi la login.php, loghează-te cu „Ține-mă minte” bifat.
Închide browserul și redeschide dashboard.php. Ar trebui să fii logat automat.
Dă logout și asigură-te că nu mai ești logat.

```
