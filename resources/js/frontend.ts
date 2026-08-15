import { initPreviewBridge } from "@narsil-cms/live-editor/core/preview-bridge";

if (document.body.dataset.editorMode === "true") {
  initPreviewBridge();
}
