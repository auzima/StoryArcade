# ✨ Sauvage & Lune – Laravel 12 × Vue 3 SPA ✨

> **Fiction interactive** : vos choix font et défont le destin de Luna, créatrice de mode éthique.
>
> 🔗 Démo locale : [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📚 Sommaire

1. [À propos](#-à-propos)
2. [Pile technologique](#-pile-technologique)
3. [Installation pas‑à‑pas](#-installation-pas-à-pas)
4. [Commandes utiles](#-commandes-utiles)
5. [Architecture & arborescence](#-architecture--arborescence)
6. [API REST v1](#-api-rest-v1)
7. [Contribuer](#-contribuer)
8. [Licence](#-licence)

---

## 🔎 À propos

Sauvage & Lune est un **jeu narratif** : chaque scène propose plusieurs choix qui modifient les points
`career`, `relationship` et `burnout` de Luna. Le backend Laravel expose l’histoire via une
**API RESTful versionnée** (`/api/v1/*`). Le frontend Vue 3 consomme cette API pour afficher la page
d’accueil, la liste des scènes (`/play`) et le gameplay (`/play/:id`).

Le projet répond au cahier des charges *WebMobUi* : routes REST, authentification, middleware admin,
SPA responsive et README détaillé.

---

## 🛠️ Pile technologique

| Couche       | Choix                | Pourquoi ?                                             |
| ------------ | -------------------- | ------------------------------------------------------ |
| **Backend**  | Laravel 12 (PHP 8.4) | Rapidité de prototypage, Eloquent, migrations, Sanctum |
| **Frontend** | Vue 3 + Vite         | HMR ultra‑rapide, Composition API                      |
| **Styling**  | Tailwind CSS 4       | Design cohérent, classes utilitaires                   |
| **DB**       | SQLite par défaut    | Zéro config pour tester vite (MySQL/PG possibles)      |
| **Tests**    | Pest + Vitest        | DX moderne, snapshots rapides                          |
| **CI**       | GitHub Actions       | Lint + tests sur push PR                               |

---

## ⚙️ Installation pas‑à‑pas

> Temps total ≈ 2 minutes avec une connexion moyenne.

### 1. Cloner le dépôt 🔄

```bash
git clone https://github.com/YourGitHubUsername/sauvage-lune.git
cd sauvage-lune
```

### 2. Installer les dépendances 📦

```bash
# PHP
composer install

# Node
npm install
```

### 3. Configurer l’environnement 📝

```bash
cp .env.example .env
```

> Modifie au besoin `DB_CONNECTION`, `DB_DATABASE`, `APP_URL`…
> *Par défaut, SQLite utilise `database/database.sqlite` (créé automatiquement).*

### 4. Générer la clé et migrer 🔑

```bash
php artisan key:generate
php artisan migrate --seed   # charge l’histoire de base
```

### 5. Lancer les serveurs ▶️

```bash
# Backend (port 8000)
php artisan serve

# Frontend + Vite (port 5173 → proxy sur 8000)
npm run dev
```

Ouvre [http://127.0.0.1:8000](http://127.0.0.1:8000) → page d’accueil puis **Découvrir les jeux**.

### 6. Créer un compte admin (facultatif) 👤

* Inscris‑toi via */register* puis, dans SQLite :

```sql
UPDATE users SET is_admin = 1 WHERE email = 'ton@mail.com';
```

* Accède à */login* → 🔐 Administration.

### 7. Build production (facultatif) 🏗️

```bash
npm run build   # assets versionnés dans public/build
```

---

## 🏃 Commandes utiles

| Action               | Commande                      |
| -------------------- | ----------------------------- |
| Lancer tests backend | `php artisan test`            |
| Lancer tests front   | `npm run test`                |
| Linter PHP           | `composer pint`               |
| Linter JS/TS         | `npm run lint`                |
| Générer docs API     | `php artisan scribe:generate` |

---

## 🗂️ Architecture & arborescence

```
├─ app/
│  ├─ Http/
│  │   ├─ Controllers/
│  │   │   ├─ Web/               # HomeController
│  │   │   └─ Api/V1/           # GameController (index/show)
│  │   └─ Middleware/Admin.php
│  ├─ Repositories/             # GameRepository (JSON → collection)
│  ├─ Services/                 # GameService (logique métier)
│  └─ Models/ (Game, Scene, Choice)  # si stockage SQL
├─ database/
│  ├─ migrations/
│  └─ seeders/GameSeeder.php
├─ resources/
│  ├─ js/
│  │   ├─ router.js             # /, /play, /play/:id
│  │   ├─ app.js
│  │   └─ components/
│  │       ├─ Layout.vue        # nav + fond noir
│  │       ├─ HomePage.vue
│  │       ├─ GameList.vue
│  │       ├─ Scene.vue
│  │       └─ SceneChoices.vue
│  └─ views/
│      └─ play.blade.php        # point d’entrée SPA
└─ storage/app/database/data/game.json  # histoire brute (JSON)
```

---

## 📡 API REST v1

| Verbe | URL                  | Rôle                                    |
| ----- | -------------------- | --------------------------------------- |
| `GET` | `/api/v1/games`      | Liste \<id,title> des scènes            |
| `GET` | `/api/v1/games/{id}` | Détail (description, image, choices\[]) |

Réponses JSON standardisées via **Laravel Resource**.
Routes protégées par middleware `auth:api` et/ou `admin` lorsque l’on crée/édite.

---

## 🤝 Contribuer

1. Fork → branche feature → PR.
2. Respecte les conventions **Conventional Commits**.
3. Vérifie `composer test && npm run test` avant push.

---

## 📄 Licence

Images de l’histoire : © Aurélia Zima — usage pédagogique uniquement.
