import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import.meta.glob(["../images/**"]);
import contextMenu from "./components/context-menu";
import tabs from "./components/tabs";
import markdownRenderer from "./components/markdownRenderer";
import editor from "./components/editor";

window.toast = function (message, options = {}) {
    let description = "";
    let type = "default";
    let position = "top-center";
    let html = "";
    if (typeof options.description != "undefined")
        description = options.description;
    if (typeof options.type != "undefined") type = options.type;
    if (typeof options.position != "undefined") position = options.position;
    if (typeof options.html != "undefined") html = options.html;

    window.dispatchEvent(
        new CustomEvent("toast-show", {
            detail: {
                type: type,
                message: message,
                description: description,
                position: position,
                html: html,
            },
        })
    );
};

Alpine.data("tabs", tabs);
Alpine.data("editor", editor);
Alpine.data("markdown", markdownRenderer);
Alpine.data("contextMenu", contextMenu);

Livewire.start();
