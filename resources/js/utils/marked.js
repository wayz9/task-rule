import { Marked } from "marked";
import { getHighlighter } from "shikiji";
import { markedHighlight } from "marked-highlight";

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

export { resolveMarkedInstance };
