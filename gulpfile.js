let gulp = require("gulp");
let sass = require("gulp-sass");
let inputPath = "resources/sass";
let outputPath = "public/css";

gulp.task("default", function(done) {
    console.log("Generating CSS files...");
    gulp.src(inputPath + "/app.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(gulp.dest(outputPath));
    done();
});
