import sort from "@alpinejs/sort";
import registerAlpineComponents from "@narsil-ui/alpine/components";
import registerAlpineStores from "@narsil-ui/alpine/stores";
import { Alpine, Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

Alpine.plugin(sort);

registerAlpineStores(Alpine);
registerAlpineComponents(Alpine);

Livewire.start();
