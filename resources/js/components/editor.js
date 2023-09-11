import { resolveMarkedInstance } from "../utils/marked";
import DOMPurify from "dompurify";

export default (content) => ({
    content: content ?? "",
    parsedContent: "",
    markedInstance: null,
    async init() {
        this.markedInstance = await resolveMarkedInstance();
        this.updateParsedContent();

        this.$watch("content", (value) => {
            this.updateParsedContent();
        });

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

            this.handleFileUpload(file);
        });

        this.$refs.editorArea.addEventListener("paste", (event) => {
            const items = event.clipboardData.items;
            let isImagePresent = false;
            for (let i = 0; i < items.length; i++) {
                if (items[i].type.indexOf("image") === 0) {
                    isImagePresent = true;
                    const file = items[i].getAsFile();

                    this.handleFileUpload(file);

                    event.preventDefault();
                    break;
                }
            }

            if (!isImagePresent) {
                return;
            }
        });

        window.Livewire.on("image-uploaded", (data) => {
            this.content = this.content.replace(
                /\[Image]\(Uploading\.\.\.\)/g,
                `![Image](${data.url})`
            );
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
        if (!["image/png", "image/jpg", "image/jpeg"].includes(file.type)) {
            toast("You can only upload images.", {
                type: "danger",
            });
            return;
        }

        if (file.size > 6 * 1024 * 1024) {
            toast("File size should be less than 2MB.", { type: "danger" });
            return;
        }

        this.$refs.editorArea.disabled = true;

        const placeholder = "[Image](Uploading...)";
        this.insertAtCursor(placeholder);

        this.$wire.upload(
            "image",
            file,
            () => {},
            (event) => {
                console.log(event);
            }
        );

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
        this.markedInstance.parse(this.content ?? "").then((html) => {
            this.parsedContent = DOMPurify.sanitize(html);
        });
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

        // Defer setting a Livewire property to a specific value
        this.content = this.$refs.editorArea.value;
    },
    updateChanges() {
        this.$refs.editorArea.dispatchEvent(new Event("input"));
        this.$wire.call("save");
    },
});
