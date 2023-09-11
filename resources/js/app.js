import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import.meta.glob(["../images/**"]);
import { Marked } from "marked";
import { getHighlighter } from "shikiji";
import { markedHighlight } from "marked-highlight";
import DOMPurify from "dompurify";

let shiki;
const supportedLanguages = ["javascript", "html", "php", "json", "bash"];

async function setupShikiji() {
    if (!shiki) {
        shiki = await getHighlighter({
            themes: ["github-light"],
            langs: supportedLanguages,
        });
    }
}

async function resolveMarkedInstance() {
    const markedInstance = new Marked(
        markedHighlight({
            async: true,
            langPrefix: "shiki language-",
            async highlight(code, lang) {
                await setupShikiji();

                if (!supportedLanguages.includes(lang)) {
                    return code;
                }

                return shiki.codeToHtml(code, { lang, theme: "github-light" });
            },
        })
    );

    const renderer = new markedInstance.Renderer();
    renderer.text = (text) => {
        return text.replace(/:poo:/g, "💩");
    };

    markedInstance.use({ renderer });
    return markedInstance;
}

Alpine.data("editor", (content = "") => ({
    content: content,
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
}));

Alpine.data("markdown", (content = "") => ({
    content: content,
    parsedContent: "",
    markedInstance: null,
    isLoading: true,
    async init() {
        const markedInstance = await resolveMarkedInstance();

        if (!this.content) {
            this.content =
                "This task has no description, enhance it with Markdown ✨";
        }

        markedInstance.parse(this.content ?? "").then((html) => {
            this.parsedContent = DOMPurify.sanitize(html);
            this.isLoading = false;
        });
    },
}));

Alpine.data("tabs", (data) => ({
    tabs: data,
    init() {
        const tabs = this.$refs.tabs;
        const leftShadow = this.$refs.leftShadow;
        const rightShadow = this.$refs.rightShadow;

        function updateShadows() {
            const scrollLeft = tabs.scrollLeft;
            const maxScrollLeft = tabs.scrollWidth - tabs.clientWidth;

            leftShadow.style.opacity = scrollLeft > 0 ? 1 : 0;
            rightShadow.style.opacity = scrollLeft < maxScrollLeft ? 1 : 0;
        }

        this.$refs.tabs.addEventListener("scroll", updateShadows);
        Livewire.hook("commit", ({ succeed }) => {
            succeed(({ snapshot, effect }) => {
                this.$nextTick(() => {
                    updateShadows();
                });
            });
        });

        this.$nextTick(() => {
            updateShadows();
        });
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

Alpine.data("contextMenu", () => ({
    contextMenuOpen: false,
    contextMenuToggle: function (event) {
        this.contextMenuOpen = true;
        event.preventDefault();
        this.$refs.contextmenu.classList.add("opacity-0");
        let that = this;
        this.$nextTick(function () {
            that.calculateContextMenuPosition(event);
            that.calculateSubMenuPosition(event);
            that.$refs.contextmenu.classList.remove("opacity-0");
        });
    },
    calculateContextMenuPosition(clickEvent) {
        if (
            window.innerHeight - 80 <
            clickEvent.clientY + this.$refs.contextmenu.offsetHeight
        ) {
            this.$refs.contextmenu.style.top =
                window.innerHeight -
                80 -
                this.$refs.contextmenu.offsetHeight +
                "px";
        } else {
            this.$refs.contextmenu.style.top = clickEvent.clientY + "px";
        }
        if (
            window.innerWidth <
            clickEvent.clientX + this.$refs.contextmenu.offsetWidth
        ) {
            this.$refs.contextmenu.style.left =
                clickEvent.clientX - this.$refs.contextmenu.offsetWidth + "px";
        } else {
            this.$refs.contextmenu.style.left = clickEvent.clientX + "px";
        }
    },
    calculateSubMenuPosition(clickEvent) {
        let submenus = document.querySelectorAll("[data-submenu]");
        let contextMenuWidth = this.$refs.contextmenu.offsetWidth;
        for (let i = 0; i < submenus.length; i++) {
            if (
                window.innerWidth <
                clickEvent.clientX + contextMenuWidth + submenus[i].offsetWidth
            ) {
                submenus[i].classList.add("left-0", "-translate-x-full");
                submenus[i].classList.remove("right-0", "translate-x-full");
            } else {
                submenus[i].classList.remove("left-0", "-translate-x-full");
                submenus[i].classList.add("right-0", "translate-x-full");
            }
            if (
                window.innerHeight <
                submenus[i].previousElementSibling.getBoundingClientRect().top +
                    submenus[i].offsetHeight
            ) {
                let heightDifference =
                    window.innerHeight -
                    submenus[i].previousElementSibling.getBoundingClientRect()
                        .top -
                    80 -
                    submenus[i].offsetHeight;
                submenus[i].style.top = heightDifference + "px";
            } else {
                submenus[i].style.top = "";
            }
        }
    },
    init() {
        this.$watch("contextMenuOpen", function (value) {
            if (value === true) {
                document.body.classList.add("overflow-hidden");
            } else {
                document.body.classList.remove("overflow-hidden");
            }
        });

        window.addEventListener("resize", function (event) {
            contextMenuOpen = false;
        });

        Livewire.hook("commit", ({ succeed }) => {
            succeed(({ snapshot, effect }) => {
                this.$nextTick(() => {
                    if (this.contextMenuToggle) this.contextMenuOpen = false;
                });
            });
        });
    },
}));

Livewire.start();
