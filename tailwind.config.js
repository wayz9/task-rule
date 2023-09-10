/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        "bg-violet-500/10",
        "text-violet-800",
        "bg-yellow-500/10",
        "text-yellow-700",
        "bg-gray-100",
        "text-gray-700",
    ],
    theme: {
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        "h1, h2, h3, h4": {
                            fontWeight: theme("fontWeight.medium"),
                        },
                        strong: {
                            fontWeight: theme("fontWeight.medium"),
                        },
                        pre: {
                            backgroundColor: "transparent",
                            fontSize: theme("fontSize.sm")[0],
                            marginTop: 0,
                            marginBottom: 0,
                            borderRadius: 0,
                            padding: 0,
                            overflowX: "auto",
                            border: "none",
                        },
                        "pre code": {
                            color: "inherit",
                            fontSize: "inherit",
                            fontWeight: "inherit",
                            backgroundColor: "transparent",
                            borderRadius: 0,
                            padding: 0,
                        },
                        ul: {
                            listStyleType: "disc",
                        },
                        ol: {
                            listStyleType: "decimal",
                        },
                        "ul, ol": {
                            paddingLeft: theme("spacing.6"),
                        },
                        li: {
                            marginTop: theme("spacing.0"),
                            marginBottom: theme("spacing.0"),
                            paddingLeft: theme("spacing[1.5]"),
                        },
                        "li::marker": {
                            fontSize: theme("fontSize.sm")[0],
                            fontWeight: theme("fontWeight.semibold"),
                        },
                        "ol > li::marker": {
                            color: "var(--tw-prose-counters)",
                        },
                        "ul > li::marker": {
                            color: "var(--tw-prose-bullets)",
                        },
                        "li :is(ol, ul)": {
                            marginTop: theme("spacing.4"),
                            marginBottom: theme("spacing.4"),
                        },
                        "li :is(li, p)": {
                            marginTop: theme("spacing.3"),
                            marginBottom: theme("spacing.3"),
                        },
                    },
                },
            }),
            fontFamily: {
                sans: [
                    "Inter var",
                    {
                        fontFeatureSettings: '"salt", "cpsp", "cv11"',
                    },
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                primary: colors.violet,
            },
            minHeight: {
                "100svh": "100svh",
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("tailwind-scrollbar"),
    ],
};
