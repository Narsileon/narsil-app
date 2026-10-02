# Structure

The Laravel host app composes Narsil CMS content and app-specific Blade components.

```text
.  # Narsil app root
├── app/  # Host-specific Laravel code
│   ├── Http/  # HTTP request handling
│   │   └── Controllers/  # HTTP controllers
│   ├── Models/  # Eloquent models
│   │   └── Contents/  # Contents models
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
│   └── seeders/  # Database seeders
│       └── Entities/  # Entity seeders
├── docs/  # Documentation
│   ├── commands/  # Command documentation
│   │   ├── index.md  # Command index
│   │   ├── narsil-skills.md  # Narsil Skills check and fix commands
│   │   └── pint.md  # PHP formatting commands
│   ├── index.md  # Documentation index
│   └── structure.md  # Root structure reference
├── public/  # Web root and built assets
├── resources/  # Frontend and Blade resources
│   ├── css/  # Stylesheets
│   │   └── frontend/  # Frontend stylesheets
│   ├── js/  # Frontend and backend Livewire entry points
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
