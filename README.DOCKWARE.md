# Shopware 6 mit Docker Desktop (Dockware)

Diese Umgebung startet dein bestehendes `shopware-backend` in einem Dockware-Container.

## 1) Starten

```bash
cd /home/shopwareuser/Documents/Webseite/shopware-backend
docker compose -f compose.dockware.yaml up -d
```

## 2) Datenbank einmalig anlegen (falls noch nicht vorhanden)

```bash
docker compose -f compose.dockware.yaml exec shopware mysql -h127.0.0.1 -uroot -proot -e "CREATE DATABASE IF NOT EXISTS shopware CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

## 3) Shopware Migrationen ausführen

```bash
docker compose -f compose.dockware.yaml exec shopware bin/console system:install --basic-setup --create-database --force || true
docker compose -f compose.dockware.yaml exec shopware bin/console database:migrate --all
docker compose -f compose.dockware.yaml exec shopware bin/console cache:clear
```

## 4) URLs

- Shopware Storefront: http://localhost:8080
- Admin: http://localhost:8080/admin
- Adminer: http://localhost:8080/adminer
- Mailcatcher: http://localhost:8080/mailcatcher
- MySQL von Host: `127.0.0.1:3307` (User `shopware`, Passwort `DeinPasswort123!`)

## 5) Stoppen

```bash
docker compose -f compose.dockware.yaml down
```

Mit `-v` werden auch die DB-Daten entfernt:

```bash
docker compose -f compose.dockware.yaml down -v
```
