import Alpine from "alpinejs";

Alpine.start();

function initializeEditorBridge(): void {
  if (document.body.dataset.editorMode !== "true") {
    return;
  }

  import("@narsil-cms/live-editor/core/preview-bridge").then(({
    initPreviewBridge,
  }): void => {
    initPreviewBridge();
  });
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initializeEditorBridge);
} else {
  initializeEditorBridge();
}
