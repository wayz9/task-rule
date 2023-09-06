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
