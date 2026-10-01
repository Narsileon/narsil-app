# Structure

The host app bootstraps Laravel and composes the local Narsil packages.

```text
.  # Narsil app root
├── app/  # Host-specific Laravel code
│   ├── Casts/  # Model casts
│   ├── Console/  # Console commands
│   │   └── Commands/  # Console commands
│   ├── Http/  # HTTP request handling
│   │   ├── Controllers/  # HTTP controllers
│   │   ├── Requests/  # HTTP requests
│   │   └── Resources/  # HTTP response resources
│   ├── Jobs/  # Background jobs
│   ├── Models/  # Eloquent models
│   │   └── Contents/  # Contents models
│   ├── Observers/  # Eloquent model observers
│   ├── Policies/  # Eloquent model policies
│   ├── Providers/  # Laravel service providers
│   └── View/  # Blade view components
│       └── Components/  # App Blade components
│           ├── Blocks/  # Feature blocks
│           ├── Contents/  # CMS content components
│           ├── Layout/  # App shell components
│           └── Ui/  # Reusable UI components
├── bootstrap/  # Laravel bootstrap files
├── config/  # Application configuration
├── database/  # Database files
│   ├── factories/  # Eloquent model factories
│   ├── migrations/  # Database migrations
│   └── seeders/  # Database seeders
│       └── Entities/  # Entity seeders
├── docs/  # Documentation
│   ├── commands/  # Command documentation
│   │   ├── index.md  # Command index
│   │   ├── narsil-skills.md  # Narsil Skills check and fix commands
│   │   └── pint.md  # PHP formatting commands
│   ├── index.md  # Documentation index
│   └── structure.md  # Root structure reference
├── lang/  # Translations
│   ├── de/  # German translations
│   ├── en/  # English translations
│   └── fr/  # French translations
├── public/  # Web root and built assets
├── resources/  # Frontend and Blade resources
│   ├── css/  # Stylesheets
│   │   └── frontend/  # Frontend stylesheets
│   ├── js/  # Frontend code
│   │   └── types/  # Frontend TypeScript types
│   └── views/  # Blade views
│       ├── components/  # Blade component categories
│       │   ├── blocks/  # Feature blocks
│       │   ├── contents/  # CMS content components
│       │   ├── layout/  # App shell components
│       │   └── ui/  # Reusable UI components
│       ├── layouts/  # Blade layouts
│       └── pages/  # Frontend pages
└── routes/  # HTTP routes
```
