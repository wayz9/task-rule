/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        "h2, h3, h4": {
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
    plugins: [require("@tailwindcss/typography")],
};
