import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import.meta.glob(["../images/**"]);
import { Marked } from "marked";
import { getHighlighter } from "shikiji";
import { markedHighlight } from "marked-highlight";
import axios from "axios";

let shiki;
const supportedLanguages = ["javascript", "html", "php", "json"];

async function setupShikiji() {
    shiki = await getHighlighter({
        themes: ["github-light", "github-dark"],
        langs: supportedLanguages,
    });
}

setupShikiji();

const markedInstance = new Marked(
    markedHighlight({
        langPrefix: "shiki language-",
        highlight(code, lang) {
            if (!supportedLanguages.includes(lang)) {
                return code;
            }

            const theme =
                window.parent.document.documentElement.classList.contains(
                    "dark"
                )
                    ? "github-dark"
                    : "github-light";

            return shiki.codeToHtml(code, { lang, theme: theme });
        },
    })
);

const renderer = new markedInstance.Renderer();
renderer.text = (text) => {
    return text.replace(/:poo:/g, "💩");
};

markedInstance.use({ renderer });

Alpine.data("editor", () => ({
    content: "",
    parsedContent: "",
    init() {
        this.updateParsedContent();

        this.$refs.editorArea.addEventListener("keydown", (event) => {
            if (event.ctrlKey || event.metaKey) {
                switch (event.key) {
                    case "b":
                        event.preventDefault();
                        this.applyFormatting("bold");
                        break;
                    case "i":
                        event.preventDefault();
                        this.applyFormatting("italic");
                        break;
                    case "u":
                        event.preventDefault();
                        this.applyFormatting("underline");
                        break;
                }
            }

            if (event.key === "Tab") {
                event.preventDefault();
                this.insertAtCursor("\t");
            }
        });

        this.$refs.editorArea.addEventListener("drop", (event) => {
            event.preventDefault();

            const files = event.dataTransfer.files;

            if (files.length > 1) {
                toast("Please drop one file at a time.", {
                    type: "warning",
                });
                return;
            }

            const file = files[0];

            if (!["image/png", "image/jpg", "image/jpeg"].includes(file.type)) {
                toast("Only PNG, JPG, and JPEG files are allowed.", {
                    type: "error",
                });
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                toast("File size should be less than 2MB.", { type: "error" });
                return;
            }

            this.handleFileUpload(file);
        });

        window.Livewire.on("image-uploaded", (data) => {
            this.content = this.content.replace(
                /\[Image]\(Uploading\.\.\.\)/g,
                `![Image](${data.url})`
            );
            this.updateParsedContent();
        });
    },
    insertCodeBlock() {
        const codeBlockSyntax = "```\n\n```";
        const newPosition = this.insertAtCursor(codeBlockSyntax);
        this.updateParsedContent();

        this.$refs.editorArea.setSelectionRange(
            newPosition + 3,
            newPosition + 3
        );
        this.$refs.editorArea.focus();
    },
    handleFileUpload(file) {
        this.$refs.editorArea.disabled = true;

        const placeholder = "[Image](Uploading...)";
        this.insertAtCursor(placeholder);

        this.$wire.upload("image", file);

        this.content = this.$refs.editorArea.value;
        this.updateParsedContent();
    },
    insertAtCursor(text) {
        const textarea = this.$refs.editorArea;
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;

        textarea.value =
            textarea.value.substring(0, start) +
            text +
            textarea.value.substring(end);

        textarea.selectionStart = textarea.selectionEnd = start + text.length;

        return start;
    },
    insertUrlSyntax() {
        const newPosition = this.insertAtCursor("[]()");
        this.updateParsedContent();

        this.$refs.editorArea.setSelectionRange(
            newPosition + 1,
            newPosition + 1
        );
        this.$refs.editorArea.focus();
    },
    insertTableSyntax() {
        const tableSyntax = `|  |  |\n|--|--|\n|  |  |\n`;
        const newPosition = this.insertAtCursor(tableSyntax);

        this.updateParsedContent();

        this.$refs.editorArea.setSelectionRange(
            newPosition + 2,
            newPosition + 2
        );
        this.$refs.editorArea.focus();
    },
    updateParsedContent() {
        this.parsedContent = markedInstance.parse(this.content);
    },
    getSelection() {
        const editorArea = this.$refs.editorArea;
        return {
            start: editorArea.selectionStart,
            end: editorArea.selectionEnd,
            text: editorArea.value.substring(
                editorArea.selectionStart,
                editorArea.selectionEnd
            ),
        };
    },
    applyFormatting(type) {
        const selection = this.getSelection();
        const editorArea = this.$refs.editorArea;

        if (!selection.text.trim()) {
            return;
        }

        const formattingOptions = {
            bold: {
                prefix: "**",
                suffix: "**",
            },
            italic: {
                prefix: "*",
                suffix: "*",
            },
            underline: {
                prefix: "<u>",
                suffix: "</u>",
            },
        };

        const { prefix, suffix } = formattingOptions[type];

        const trimmedText = selection.text.trim();

        if (trimmedText.startsWith(prefix) && trimmedText.endsWith(suffix)) {
            // Remove formatting
            const unformattedText = trimmedText.slice(
                prefix.length,
                -suffix.length
            );
            editorArea.setRangeText(
                unformattedText,
                selection.start,
                selection.end
            );
            // Move the cursor to the end of the unformatted text
            editorArea.setSelectionRange(
                selection.start + unformattedText.length,
                selection.start + unformattedText.length
            );
        } else {
            // Apply formatting
            const formattedText = `${prefix}${trimmedText}${suffix}`;
            editorArea.setRangeText(
                formattedText,
                selection.start,
                selection.end
            );
            // Move the cursor to the end of the formatted text
            editorArea.setSelectionRange(
                selection.start + formattedText.length,
                selection.start + formattedText.length
            );
        }
    },
}));

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

Livewire.start();
