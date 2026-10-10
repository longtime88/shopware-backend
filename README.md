# Shopware Backend

Dieses Repository ist ein Shopware 6 Backend-Projekt mit zusätzlichen Custom-Plugins und einer Docker-/Compose-Umgebung für lokale Entwicklung.

## Überblick

Dieses Projekt enthält:
- die Shopware-Core-Installation
- vorhandene Custom-Plugins im `custom/`-Ordner
- Konfigurations- und Laufzeitdateien
- Docker-Setup für lokale Entwicklung
- Test- und Projektdateien

## Projektstruktur

```text
shopware-backend/
├── .env
├── .env.dev
├── .env.test
├── .gitignore
├── .htaccess
├── LICENSE
├── README.DOCKWARE.md
├── compose.yaml
├── compose.override.yaml
├── compose.dockware.yaml
├── composer.json
├── composer.lock
├── phpunit.dist.xml
├── symfony.lock
├── bin/
│   └── ... Shopware/Symfony-Befehle
├── config/
│   └── ... Projektkonfiguration
├── custom/
│   ├── .htaccess
│   ├── apps/
│   │   └── ... Shopware-App-Implementierungen
│   ├── plugins/
│   │   ├── CheckoutCustomizer/
│   │   │   └── ... eigener Checkout-Plugin
│   │   ├── SwagMigrationAssistant/
│   │   │   └── ... Migrations-Plugin
│   │   └── ...
│   └── static-plugins/
│       └── ... statische Plugins
├── files/
│   └── ... hochgeladene Dateien / Media / Uploads
├── public/
│   └── ... öffentlich zugängliche Dateien, Frontend-Entrypoints
├── src/
│   └── ... eigene PHP-Klassen / Applikationscode
├── tests/
│   └── ... PHPUnit / Test-Umgebungen
├── var/
│   └── cache/, logs/, ...
└── ...
```

## Technologien

- Shopware 6
- PHP
- Symfony
- Composer
- Docker / Docker Compose
- PHPUnit

## Voraussetzungen

- PHP
- Composer
- Docker (falls lokal mit Containern entwickelt werden soll)
- Node.js / npm (falls Frontend-/Admin-Assets verwendet werden)

## Installation

1. Repository klonen
2. Abhängigkeiten installieren:

```bash
composer install
```

3. Umgebung konfigurieren:
   - `.env` anpassen
   - Datenbank- und Shopware-Parameter setzen

4. Shopware starten:

```bash
bin/console system:setup
```

oder mit Docker:

```bash
docker compose up -d
```

## Entwicklung

### Custom Plugins

Die Plugins liegen im Ordner:

```text
custom/plugins/
```

Beispiele:
- `custom/plugins/CheckoutCustomizer`
- `custom/plugins/SwagMigrationAssistant`

### Konfiguration

Die wichtigsten Konfigurationsdateien befinden sich in:

```text
config/
```

## Tests

```bash
./vendor/bin/phpunit
```

## Wichtige Dateien

- `composer.json` – Projektabhängigkeiten und Composer-Config
- `compose.yaml` – Docker-Setup
- `phpunit.dist.xml` – PHPUnit-Konfiguration
- `config/` – Shopware-Konfiguration
- `custom/plugins/` – Erweiterungen und Plugins

## Lizenz

Dieses Projekt steht unter der MIT-Lizenz.
