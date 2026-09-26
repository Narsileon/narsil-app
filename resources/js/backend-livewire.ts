import registerAlpineComponents from "@narsil-ui/alpine/components";
import registerAlpineStores from "@narsil-ui/alpine/stores";
import { Alpine, Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm.js";

registerAlpineStores(Alpine);
registerAlpineComponents(Alpine);

Livewire.start();
