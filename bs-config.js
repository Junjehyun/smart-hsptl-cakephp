module.exports = {
    proxy: "http://localhost:8765", // your local server
    files: ["webroot/css/*.css", "templates/**/*.php"],
    reloadDelay: 500,
    browser: "chrome"
};