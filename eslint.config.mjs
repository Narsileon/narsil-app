import tseslint from "@typescript-eslint/eslint-plugin";
import tsParser from "@typescript-eslint/parser";

const eslintConfig = [
  {
    ignores: ["vendor/**/*.d.ts"],
  },
  {
    files: ["resources/js/**/*.ts", "vendor/narsil/cms/resources/js/**/*.ts"],
    languageOptions: {
      parser: tsParser,
      parserOptions: {
        ecmaVersion: "latest",
        sourceType: "module",
        project: "./tsconfig.json",
      },
    },
    plugins: {
      "@typescript-eslint": tseslint,
    },
    rules: {
      // Code quality rules
      eqeqeq: ["warn", "always", { null: "ignore" }],
      "no-eval": "error",
      "no-implied-eval": "error",
      "no-multiple-empty-lines": ["warn", { max: 1, maxEOF: 0, maxBOF: 0 }],
      "no-new-func": "error",
      "no-script-url": "error",
      "no-self-compare": "error",
      "no-throw-literal": "error",
      "no-useless-concat": "warn",
      "no-useless-return": "warn",
      "prefer-arrow-callback": "warn",
      "prefer-destructuring": ["warn", { object: true, array: false }],

      // JavaScript/ES6 rules
      "no-console": ["error", { allow: ["warn", "error"] }],
      "no-debugger": "warn",
      "no-var": "error",
      "no-duplicate-imports": "error",
      "no-unused-expressions": "warn",
      "object-shorthand": "off",
      "prefer-const": "warn",
      "prefer-template": "warn",

      // Typescript rules
      "@typescript-eslint/ban-ts-comment": "warn",
      "@typescript-eslint/no-empty-object-type": "warn",
      "@typescript-eslint/no-explicit-any": "warn",
      "@typescript-eslint/no-var-requires": "error",
      "@typescript-eslint/no-unused-vars": [
        "warn",
        {
          vars: "all",
          args: "after-used",
          ignoreRestSiblings: false,
          argsIgnorePattern: "^_",
          varsIgnorePattern: "^_",
          destructuredArrayIgnorePattern: "^_",
          caughtErrorsIgnorePattern: "^(_|ignore)",
        },
      ],
    },
  },
];

export default eslintConfig;
