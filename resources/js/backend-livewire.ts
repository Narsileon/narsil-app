import anchor from "@alpinejs/anchor";
import collapse from "@alpinejs/collapse";
import sort from "@alpinejs/sort";
import registerAlpineComponents from "@narsil-ui/alpine/components";
import registerAlpineStores from "@narsil-ui/alpine/stores";
import { Alpine, Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

Alpine.plugin([anchor, collapse, sort]);

registerAlpineStores(Alpine);
registerAlpineComponents(Alpine);

Livewire.start();
