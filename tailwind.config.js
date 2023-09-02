/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

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
            minHeight: {
                "100svh": "100svh",
            },
        },
    },
    plugins: [],
};
