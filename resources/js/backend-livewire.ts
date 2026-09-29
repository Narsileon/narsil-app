import registerLiveEditor from "@narsil-cms/live-editor/livewire";
import registerAlpineComponents from "@narsil-ui/alpine/components";
import registerAlpineStores from "@narsil-ui/alpine/stores";
import {
  Alpine,
  Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm.js";

registerAlpineStores(Alpine);
registerAlpineComponents(Alpine);
registerLiveEditor(Alpine);

Livewire.start();
