# Narsil App Agents

This repository is a Laravel + React Inertia application that acts as the host app for the Narsil workspace.
The app provides the frontend shell, the backend shell, and the wiring that mounts the CMS packages.

## Project

- Root app: `/home/narsilien/dev/narsil-app`
- Stack: Laravel, Inertia, React, TypeScript, Vite, Tailwind, PHP
- Frontend entry: `resources/js/frontend.tsx`
- Backend entry: `resources/js/backend.tsx`
- Shared Inertia page resolution is configured in `config/inertia.php`

The app is a headless CMS host. Public pages live under `resources/js/pages/frontend/`, while admin pages are resolved from the app and from the CMS workspace package.

## Workspace

This repository is wired to the local Narsil workspace packages:

- `vendor/narsil/base`
- `vendor/narsil/cms`
- `vendor/narsil/cms-form`

Composer and Node workspaces are aligned to these packages in:

- `composer.json`
- `composer.prod.json`
- `package.json`
- `pnpm-workspace.yaml`

### Base

`narsil/base` is the shared foundation package for the workspace. Treat it as the common UI/runtime layer that other Narsil packages build on.
When you are changing shared presentation or foundation behavior, check whether the same change belongs in the base package rather than in the app layer.

### CMS

`narsil/cms` is the main backend package.

- Its pages are loaded by the backend Inertia resolver in `resources/js/backend.tsx`
- Its CSS is imported by `resources/css/backend.css` and `resources/css/frontend.css`
- Its resources are exposed through the Inertia page path list in `config/inertia.php`

The CMS owns the admin experience, page components, and shared backend UI that the app consumes.

### Form

`narsil/cms-form` provides the CMS form plugin.

- It is booted in `resources/js/backend.tsx`
- It extends the backend experience rather than the public frontend

Use this package when the change is form-specific and belongs to the CMS plugin layer.

## Skill Binding

Use the `narsil-skills` repo as the source of truth for stack-specific agent instructions.
The skill files live at:

- `../narsil-skills/skills/general/SKILL.md`
- `../narsil-skills/skills/php/SKILL.md`
- `../narsil-skills/skills/laravel/SKILL.md`
- `../narsil-skills/skills/blade/SKILL.md`
- `../narsil-skills/skills/react/SKILL.md`
- `../narsil-skills/skills/html/SKILL.md`
- `../narsil-skills/skills/tailwind/SKILL.md`
- `../narsil-skills/skills/eslint/SKILL.md`

Binding guidance:

- PHP and Laravel edits should follow the PHP/Laravel skills first.
- Blade components should follow the Blade skill and its PHP/HTML/Tailwind references.
- React and TypeScript edits should follow the React skill, then HTML/Tailwind, then ESLint.
- General refactors and bug fixes should follow the General skill.

## Working Rules

- Prefer changing the app layer only when the behavior is specific to this repository.
- If the change belongs in `base`, `cms`, or `cms-form`, make it there instead of duplicating logic in the app.
- Keep imports and page resolution consistent with the current workspace aliases and vendor package paths.
- Avoid editing generated files unless the task explicitly requires it.

## Testing

- When browser or feature testing is blocked by authentication, temporarily bypass login through the Laravel gate in the local testing environment so the protected page can be exercised.
- Keep authentication bypasses explicitly limited to testing and do not leave them enabled in production or committed as runtime behavior.
