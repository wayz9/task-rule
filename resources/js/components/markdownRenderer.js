import { resolveMarkedInstance } from "../utils/marked";
import DOMPurify from "dompurify";

export default (content) => ({
    content: content ?? "",
    parsedContent: "",
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
});
