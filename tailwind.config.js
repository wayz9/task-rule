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
                primary: colors.yellow,
            },
            minHeight: {
                "100svh": "100svh",
            },
        },
    },
    plugins: [],
};
