import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import.meta.glob(["../images/**"]);
import { Marked } from "marked";

window.Marked = Marked;

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
            window.innerHeight <
            clickEvent.clientY + this.$refs.contextmenu.offsetHeight
        ) {
            this.$refs.contextmenu.style.top =
                window.innerHeight - this.$refs.contextmenu.offsetHeight + "px";
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
    },
}));

Alpine.data("editor", () => ({
    content: "",
    init() {
        this.$refs.editorArea.addEventListener("keydown", (event) => {
            if (event.ctrlKey) {
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
    },
}));

Livewire.start();
