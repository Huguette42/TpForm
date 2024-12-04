
# 📜 Gestion des Contrats de Partenariat

Une application Laravel complète pour la gestion des contrats de partenariat, avec des fonctionnalités avancées telles que la signature électronique, la gestion des comptes utilisateurs et la génération de PDF. L'interface est moderne, responsive et agrémentée d'animations CSS et JavaScript.

---

## 🌟 Fonctionnalités

### 🔒 Gestion des utilisateurs
- **Création de compte** avec vérification par e-mail.
- **Connexion sécurisée** pour accéder aux fonctionnalités.
- Modification et mise à jour des informations du compte.

### ✍️ Gestion des contrats
- **Création de contrats** avec un éditeur intuitif.
- **Signature électronique** des contrats directement dans l'application.
- **Modification** et **suppression** des contrats existants.
- **Téléchargement des contrats en PDF** pour un usage hors ligne.

### 🤝 Gestion des partenaires
- **Création de partenaires** : Ajout facile de nouveaux partenaires avec un formulaire dédié.
- **Recherche de partenaires** : Moteur de recherche pour retrouver rapidement un partenaire spécifique.
- **Sélection de partenaires** : Possibilité de sélectionner un ou plusieurs partenaires pour effectuer des actions groupées.
- **Suppression de partenaires** : Gestion des partenaires en permettant leur suppression de manière sécurisée.

### 💻 Interface utilisateur
- **Design moderne** grâce à Bootstrap.
- **Animations CSS et interactions JavaScript** pour une expérience utilisateur fluide et agréable.

---

## 📂 Technologies utilisées

### 🛠 Backend
- **Laravel** : Framework PHP pour une gestion robuste et sécurisée.

### 🎨 Frontend
- **Bootstrap** : Mise en page élégante et responsive.
- **CSS/Animations** : Effets visuels modernes.
- **JavaScript** : Fonctionnalités interactives.

### 📄 PDF
- **Génération de PDF** : Conversion des contrats en documents téléchargeables.

---

## 🚀 Installation

### Prérequis

- Docker et Docker Compose.

### Étapes

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/votre-repository/nom-du-projet.git
   cd nom-du-projet
   ```

2. **Configurer l'environnement**
   Copiez le fichier `.env.example` pour créer un fichier `.env` :
   ```bash
   cp .env.example .env
   ```
   Configurez vos informations de base de données dans le fichier `.env`.

3. **Démarrer le conteneur Docker**
   ```bash
   ./vendor/bin/sail up -d
   ```

4. **Exécuter les migrations**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

5. **Démarrer le serveur de développement**
   Accédez à l'application via [http://localhost](http://localhost).

### 🔧 En cas de problème
Si vous rencontrez des erreurs de permissions, exécutez la commande suivante pour attribuer les droits d'écriture sur tous les fichiers du projet :

```bash
sudo chmod -R 777 .
```

---

## 📊 Structure du projet

### Routes
Les routes sont définies dans le fichier `routes/web.php`. Chaque route est associée à un contrôleur qui gère la logique métier.

### Contrôleurs
Les controlleurs sont définies dans le dossier `app/Http/Controllers`

- **AuthController** : Gère la gestion des utilisateurs (inscription, connexion, mise à jour des informations).
- **ContractController** : Gère la création, la modification, la suppression et le téléchargement des contrats.
- **HomeController** : Gère l'affichage de la page Home.
- **SignatureController** : Gestion des signatures (stockage, affichage dans les pages et page de signature).

### Modèles
- **User** : Modèle représentant les utilisateurs de l'application.
- **Contract** : Modèle pour la gestion des contrats.
- **Partenaire** : Modèle pour la gestion des partenaires

### Middleware
Les middlewares utilisés sont :
- `auth` pour restreindre l'accès aux fonctionnalités aux utilisateurs connectés.
- `signed` qui permet de restreindre l'accès au Url signé uniquement

### Base de données
La base de donnée est generé a partir des fichier de migration dans `/database/migrations`

Le schéma de la base de données inclut les tables suivantes :
- **users** : Informations sur les utilisateurs.
- **contracts** : Information sur les contrats créés.
- **partners** : Informations sur les partenaire.
- **contract_partner** : Table pivot reliant les deux tables

<p align="center">
  <img src="chemin/vers/schema_base_donnees.png" alt="Schéma de la base de données" width="75%">
</p>

---

## 📸 Aperçu

<p align="center">
  <img src="public/img/pres1.png" alt="Présentation 1" width="45%" style="margin-right: 5px;">
  <img src="public/img/pres2.png" alt="Présentation 2" width="45%" style="margin-left: 5px;">
</p>

---

## 📄 Licence
Ce projet est sous licence **MIT**. Consultez le fichier `LICENSE` pour plus d'informations.

---

## 👨‍💻 Auteur
**Hugo Jeanselme**  
Passionné de développement web.
