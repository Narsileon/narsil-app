# Narsil App

Laravel, Blade, and Livewire host app for users building sites with Narsil CMS. This is the user-owned application repository; sibling workspace links and shared contributor skills apply only during local Narsil development.

For local contributor conventions, follow the shared [General](../narsil-skills/skills/general/SKILL.md), [PHP](../narsil-skills/skills/php/SKILL.md), [Laravel](../narsil-skills/skills/laravel/SKILL.md), [Blade](../narsil-skills/skills/blade/SKILL.md), [HTML](../narsil-skills/skills/html/SKILL.md), [Tailwind](../narsil-skills/skills/tailwind/SKILL.md), and [ESLint](../narsil-skills/skills/eslint/SKILL.md) skills.

- Preserve the local Composer and Node workspace wiring used during Narsil development.
- Use DDEV for app runtime and browser checks. Keep generated files out of changes unless required.
- If authentication blocks local feature/browser checks, bypass the gate only for that local test and remove the bypass afterward.
