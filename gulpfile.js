let gulp = require("gulp");
let sass = require("gulp-sass");
let clean = require("gulp-clean-css");
let inputPath = "resources/sass";
let outputPath = "public/css";

gulp.task("default", function(done) {
    console.log("Generating CSS files...");
    gulp.src(inputPath + "/app.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(gulp.dest(outputPath))
        .pipe(clean({debug: true}, (details) => {
            console.log(`${details.name} : ${details.stats.originalSize} => ${details.stats.minifiedSize}`);
        }))
        .pipe(gulp.dest(`${outputPath}/dist`));
    gulp.src(inputPath + "/print.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(gulp.dest(outputPath));
    done();
});
