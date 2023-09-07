import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import.meta.glob(["../images/**"]);
import { Marked } from "marked";
import { getHighlighter } from "shikiji";
import { markedHighlight } from "marked-highlight";

let shiki;

async function setupShikiji() {
    shiki = await getHighlighter({
        themes: ["github-dark"],
        langs: ["javascript", "html", "php"],
    });
}

setupShikiji();

const markedInstance = new Marked(
    markedHighlight({
        langPrefix: "shiki language-",
        highlight(code, lang) {
            return shiki.codeToHtml(code, { lang, theme: "github-dark" });
        },
    })
);

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

Livewire.start();
